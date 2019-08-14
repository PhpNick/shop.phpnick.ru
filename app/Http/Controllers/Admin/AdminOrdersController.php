<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Order;

class AdminOrdersController extends Controller
{
    //orders control panel (display all orders)
    
    public function ordersPanel(){
    
      $orders = Order::paginate(10);
      //print_r($orders);
      return view('admin.ordersPanel', ["orders" => $orders]);
   
    }

    public function deleteOrder(Request $request, $id){

        $deleted =  DB::table('orders')->where("order_id",$id)->delete();    
        if($deleted){ 
           return redirect()->back()->with('orderDeletionStatus', 'Заказ №'.$id. ' был успешно удален');   
        }else{

          return redirect()->back()->with('orderDeletionStatus', 'Заказ №'.$id. ' не удалось удалить');   
        }

    }

    //display edit order form
       public function editOrderForm($order_id){
       
          $order =  Order::where("order_id",$order_id)->firstOrFail();
        
          return view('admin.editOrderForm',['order'=>$order]);

    }

    //update order fields (status,date,....)
    public function updateOrder(Request $request,$order_id){

       $date =  $request->input('date');
       $del_date =  $request->input('del_date');
       $status = $request->input('status');
       $price = $request->input('price');

       $updateArray = array("date"=>$date, "del_date"=> $del_date,"status"=>$status,"price"=>$price);

        DB::table('orders')->where('order_id',$order_id)->update($updateArray);

        return redirect()->route("ordersPanel");
    }
}
