<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Brand;
use App\Coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Mail\OrderCreatedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller
{
  private $paginateMax = 10;
  private $paginateMaxSearch = 5;
  private $allcategories;

  public function index(Request $request, Category $category, Brand $brand){
      $products = $this->getProducts($category, $brand);
      if($request->ajax()){
        return view("layouts.productsList",
          ["products" => $products]
        );
      }
      else {
        return view("allproducts",
          ["products" => $products]
        );
      }

  }

  protected function getProducts(Category $category, Brand $brand)
  {
      if ($category->exists) {
          $this->allcategories = collect();
          $this->allcategories->push($category);
          $this->getAllCategories($category);
          $products = $this->allcategories->pluck('products')->flatten();
          $paginatedAllProducts = new \Illuminate\Pagination\LengthAwarePaginator(
          $products->forPage(1, $this->paginateMax), 
          $products->count(), 
          $this->paginateMax, 
          1
          );          
          return $paginatedAllProducts;
      }
      if ($brand->exists) {
          return Product::where('brand_id', $brand->id)->published()->paginate($this->paginateMax);
      }
      else
          return Product::published()->paginate($this->paginateMax);
  }

  //Рекурсивная функция, чтобы получить все категории
  //в коллекцию $this->allcategories
  private function getAllCategories(Category $category) {
      if($category->children()) {
        $categories = $category->allchildren()->with('products')->get();
        foreach ($categories as $kat) {
          $this->allcategories->push($kat);
          $this->getAllCategories($kat);
        }
      }
  }

  public function price(Request $request){
      if($request->has('price'))
        $minPrice = $request->input('price')['0'];
        $maxPrice = $request->input('price')['1'];
        $products = Product::where('price', '<=', $maxPrice)->
        where('price', '>=', $minPrice)->paginate($this->paginateMax);
        return view("layouts.productsList",
          ["products" => $products]
        );
        //return response()->json(['success'=>$request->input('price')]);
  }        

  public function search(Request $request){

      //живой поиск
      if($request->ajax()) {
        $output="";
        $searchText = $request->get('searchText');
        $products = Product::search($searchText)->published()->paginate($this->paginateMaxSearch);

        if(count($products)) {
          foreach ($products as $key => $product) {
          $output.='<a class="line" 
          href="'.route('productDetailsPage',['product'=>$product->slug]).'"><div>'.
          '<img width="100" style="float: left; margin-right: 5px" src="'.asset ('storage').'/product_images/'.$product['image'].'" alt="" />'.
          '<p>'.$product->name.'</p>'.
          '<p>'.$product->brand->name.' | '.$product->category->name.'</p>';
          if($product->special) {
            $priceWithDiscount = $product->price - $product->special->discount($product->price);
            $output .='<h4 style="display: inline-block">'.$priceWithDiscount.' <i class="fa fa-rub" aria-hidden="true"></i></h4> <s>'.$product->price.'</s> <i class="fa fa-rub" aria-hidden="true"></i></div></a>';
          }
          else
            $output .='<h4>'.$product->price.' <i class="fa fa-rub" aria-hidden="true"></i></h4>'.'</div></a>';
          }
        }
        else 
          $output ='<div style="text-align: center">Ничего не найдено</div>';
        return Response($output);
      }

      $searchText = $request->get('searchText');
      $products = Product::search($searchText)->published()->paginate($this->paginateMax);
      return view("allproducts",compact("products"));
  }

  public function showProduct(Product $product){
      $check = function ($arg) {
        if(!auth()->check()) {
            if($arg->publish == 0) {
                abort(403, 'Переход запрещён.');
            }    
        }
        elseif(!auth()->user()->isAdmin()) {
            if($arg->publish == 0) {
                abort(403, 'Переход запрещён.');
            }          
        }
      };
      $check($product);
      $path = 'public/product_images/'.$product->slug.'/additional_images/';
      if(Storage::disk('local')->exists($path)) {
        $files = Storage::disk('local')->files($path);
        return view("productDetailsPage",compact("product", "files"));
      }
      else
        return view("productDetailsPage",compact("product"));
  }    

  public function addProductToCart(Request $request,$id){

      //$request->session()->forget("cart");
      //$request->session()->flush();
      $quantity = 1;
      if($request->has('quantity')) {
        $quantity = $request->input('quantity');
      }

      $prevCart = $request->session()->get('cart');
      $cart = new Cart($prevCart);

      $product = Product::find($id);
      $cart->addItem($id,$product,$quantity);
      $request->session()->put('cart', $cart);

      //dump($cart);
      if($request->ajax()) {
        return array($cart->items[$id]['quantity'], $cart->itemsNumber);
      }
      else {
        return back()->with('status', 'success');
      }
  }

  public function showCart(){

      $cart = Session::get('cart');

      //cart is not empty
      if($cart){
          return view('cartproducts',['cartItems'=> $cart]);
       //cart is empty
      }else{
          return redirect()->route("allProducts");
      }

  }

  public function deleteItemFromCart(Request $request,$id){

      $cart = $request->session()->get("cart");

      if(array_key_exists($id,$cart->items)){
          unset($cart->items[$id]);
      }

      $prevCart = $request->session()->get("cart");
      $updatedCart = new Cart($prevCart);
      $updatedCart->updatePriceAndQunatity();

      if($updatedCart->totalQuantity == 0) {
        $request->session()->forget("cart");
        return redirect()->route("allProducts");
      }

      $request->session()->put("cart",$updatedCart);


      return redirect()->route('cartproducts');

  }

   public function increaseSingleProduct(Request $request,$id){

      $prevCart = $request->session()->get('cart');
      $cart = new Cart($prevCart);

      $product = Product::find($id);
      $cart->addItem($id,$product);
      $request->session()->put('cart', $cart);

      //dump($cart);

      return redirect()->route("cartproducts");

  }

     public function decreaseSingleProduct(Request $request,$id){
      $prevCart = $request->session()->get('cart');
      $cart = new Cart($prevCart);

      if( $cart->items[$id]['quantity'] > 1){
                $product = Product::find($id);
                $cart->removeItem($id, $product);
            
                $request->session()->put('cart', $cart);
                
        }
      return redirect()->route("cartproducts");
  }

  public function checkoutProducts(){

     $shipments = DB::table('shipments')->get();
     return view('checkoutproducts', compact('shipments'));

  }

  public function createNewOrder(Request $request){

    $recaptcha = parent::getCaptcha($_POST['g-recaptcha-response']);
    if($recaptcha->success == true && $recaptcha->score > 0.5){

      $cart = Session::get('cart');

      $fio = $request->input('fio');
      $email = $request->input('email');
      $phone = $request->input('phone');
      $address = $request->input('address');
      $orderDescription = $request->input('orderDescription');
      $payment_type = $request->input('payment_type');
      $shipment_id = $request->input('shipment_id');


      //check if user is logged in or not
      $isUserLoggedIn = Auth::check();

      if($isUserLoggedIn){
      	//get user id
         $user_id = Auth::id();  //OR $user_id = Auth:user()->id;

      }else{
      	//user is guest (not logged in OR Does not have account)
        $user_id = 0;
      }

      //cart is not empty
      if($cart) {

        //Цена вместе со стоимостью доставки
        $shipment_price = DB::table('shipments')->where('id', '=', $shipment_id)->first()->price;
        $price = $cart->totalPrice + $shipment_price;

        //Работаем с купоном
        if($request->has('coupon_code')) {
          $coupon = Coupon::where('code', $request->coupon_code)->first();
          if ($coupon) {
            $price -= $coupon->discount($cart->totalPrice);
          }

        }

        $date = \Carbon\Carbon::now();
        $newOrderArray = array("user_id" => $user_id, "status"=>"Не оплачен","date"=>$date,"del_date"=>$date,"price"=>$price,
        "fio"=>$fio, "address"=> $address, 'email'=>$email,'phone'=>$phone, "orderDescription"=>$orderDescription, "payment_type"=>$payment_type, "shipment_id"=>$shipment_id);
          
        $created_order = DB::table("orders")->insert($newOrderArray);
        $order_id = DB::getPdo()->lastInsertId();


        foreach ($cart->items as $cart_item){
            $item_id = $cart_item['data']['id'];
            $item_name = $cart_item['data']['name'];
            $item_price = $cart_item['data']['price'];
            $newItemsInCurrentOrder = array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
            $created_order_items = DB::table("order_items")->insert($newItemsInCurrentOrder);
        }

        //send the email
        $this->sendMail($email, $order_id);

        //delete cart
        Session::forget("cart");

        $payment_info =  $newOrderArray;
        $payment_info['order_id'] = $order_id;
        $payment_info['shipment_price'] = $shipment_price;

        $request->session()->put('payment_info',$payment_info);

        //   print_r($newOrderArray);
          
       return redirect()->route("showPaymentPage");

      }else{

        return redirect()->route("allProducts");

      }
    }
  }

  private function sendMail($email, $order_id){
      
      $cart = Session::get('cart');
      
      if($cart != null){
         Mail::to($email)->send(new OrderCreatedEmail($cart, $order_id));
      }

  } 

}






































