<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    //

    //display all products
    public function index(){
        $products = Product::paginate(10);
        return view("admin.displayProducts",['products'=>$products]);

    }

    //display create product form
    public function createProdcutForm(){
        return view("admin.createProductForm");
    }


    //store new product to database
    public function sendCreateProductForm(Request $request){

        $name =  $request->input('name');
        $slug =  $request->input('slug');
        $category_id = $request->input('category_id');
        $brand_id = $request->input('brand_id');
        $special_id = null;
        if($request->has('special_id'))
          $special_id = $request->input('special_id');
        $shortDescription =  $request->input('short-description');
        $description =  $request->input('description');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $popular = $request->input('popular');
        $publish = $request->input('publish');

        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();
        $ext =  $request->file("image")->getClientOriginalExtension();
        $stringImageReFormat = str_replace(" ","",$request->input('name'));

        $imageName = $stringImageReFormat.".".$ext; //blackdress.jpg
        $imageEncoded = File::get($request->image);

        $newProductArray = array("name"=>$name, "slug"=>$slug, "short_description"=> $shortDescription,"description"=> $description, "image"=> $imageName,"price"=>$price, "quantity"=>$quantity,"popular"=>$popular,"publish"=>$publish,"category_id"=>$category_id, "brand_id"=>$brand_id, "special_id"=>$special_id);

        $created = DB::table("products")->insert($newProductArray);
        $id = DB::getPdo()->lastInsertId();
        Storage::disk('local')->put('public/product_images/'.$id.'/'.$imageName, $imageEncoded);

        // Закачиваем в папку дополнительные файлы
        if($request->hasFile('additional_images')) {
          $additional_images = $request->file('additional_images');

          $rules = [
              'additional_images' => 'file|image|mimes:jpg,png,jpeg|max:5000',
          ];          
          foreach ($additional_images as $addimage) {
            $data = ['additional_images' => $addimage];
              $validator = Validator::make($data, $rules);
              if ($validator->passes()) {
                $imageEncoded = File::get($addimage);
                Storage::disk('local')->put(
                  'public/product_images/'.$id.'/additional_images/'.$addimage->getClientOriginalName(), $imageEncoded);
              }
          }
        }             

        if($created){
            return redirect()->route("adminDisplayProducts");
        }else{
           return "Товар не был добавлен";
        }
    }

    //display edit product form
    public function editProductForm($id){
        $product = Product::find($id);
         return view('admin.editProductForm',['product'=>$product]);

    }


    //display edit product image form
    public function editProductImageForm($id){
        $product = Product::find($id);
        return view('admin.editProductImageForm',['product'=>$product]);
    }

    //update product Image
    public function updateProductImage(Request $request,$id){


        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();


        if($request->hasFile("image")){

          $product = Product::find($id);
          $exists = Storage::disk('local')->exists("public/product_images/".$id."/".$product->image);

          //delete old image
          if($exists){
             Storage::delete('public/product_images/'.$id."/".$product->image);

          }

          //upload new image
            $ext = $request->file('image')->getClientOriginalExtension(); //jpg

            $request->image->storeAs("public/product_images/".$id."/",$product->image);

            $arrayToUpdate = array('image'=>$product->image);
            DB::table('products')->where('id',$id)->update($arrayToUpdate);


            return redirect()->route("adminDisplayProducts");

        }else{

           $error = "Не было выбрано ни одного файла";
           return $error;

        }
    }

    //update product fields (name,description....)
    public function updateProduct(Request $request,$id){

      $name =  $request->input('name');
      $slug =  $request->input('slug');
      $category_id = $request->input('category_id');
      $brand_id = $request->input('brand_id');
      $shortDescription =  $request->input('short-description');
      $description =  $request->input('description');
      $price = $request->input('price');
      $quantity = $request->input('quantity');
      $popular = $request->input('popular');
      $publish = $request->input('publish');
      $special_id = null;
        if($request->has('special_id'))
          $special_id = $request->input('special_id');

      $updateArray = array("name"=>$name, "slug"=>$slug, "short_description"=> $shortDescription,"description"=> $description, "price"=>$price, "quantity"=>$quantity,"popular"=>$popular,"publish"=>$publish,"category_id"=>$category_id, "brand_id"=>$brand_id, "special_id"=>$special_id);

      DB::table('products')->where('id',$id)->update($updateArray);

      return redirect()->route("adminDisplayProducts");

    }

    //delete product
    public function deleteProduct($id){

      $product = Product::find($id);

      $exists =  Storage::disk("local")->exists("public/product_images/".$id."/".$product->image);

      //if old image exists
      if($exists){
          //delete folder with it
          Storage::deleteDirectory('public/product_images/'.$product->id);
      }
      Product::destroy($id);
      return redirect()->back()->with('productDeletionStatus', 'Товар был успешно удален');

    }

    public function popular(Request $request, Product $product)
    {
      $product->popular = request('popular');
      $product->save();
      return back();
    }

    public function publish(Request $request, Product $product)
    {
      $product->publish = request('publish');
      $product->save();
      return back();
    }    

}

