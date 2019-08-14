<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use App\Shipment;
use Illuminate\Support\Facades\DB;

class AdminShipmentController extends Controller
{
    //display create shipment form
    public function createShipmentForm(){
        return view("admin.createShipmentForm");
    }

    //store new shipment to database
    public function sendCreateShipmentForm(Request $request){
        $name =  $request->input('name');
        $price =  $request->input('price');

        $newBrandArray = array("name"=>$name, "price"=>$price);

        $created = DB::table("shipments")->insert($newBrandArray);

        if($created){
            return redirect()->route("shipmentsPanel");
        }else{
           return "Бренд не был создан";
        }
    }

    //shipments control panel (display all shipment)
    
    public function shipmentsPanel(){
    
      $shipments = DB::table('shipments')->paginate(15);
      return view('admin.shipmentsPanel', ["shipments" => $shipments]);
    }

    public function deleteShipment(Request $request, $id){

        $deleted =  DB::table('shipments')->where("id",$id)->delete();    
        if($deleted){ 
           return redirect()->back()->with('shipmentDeletionStatus', 'Метод доставки был успешно удален');   
        }else{

          return redirect()->back()->with('shipmentDeletionStatus', 'Метод доставки не удалось удалить');   
        }

    }

    //display edit shipment form
    public function editShipmentForm($id){
       
          $shipment =  Shipment::where("id",$id)->firstOrFail();
        
          return view('admin.editShipmentForm',['shipment'=>$shipment]);

    }

    //update shipment fields
    public function updateShipment(Request $request,$id){

       $name =  $request->input('name');
       $price = $request->input('price');

       $updateArray = array("name"=>$name, "price"=>$price);

        DB::table('shipments')->where('id',$id)->update($updateArray);

        return redirect()->route("shipmentsPanel");
    }                    
}
