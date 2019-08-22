<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Special;

class AdminSpecialsController extends Controller
{
    //display create special form
    public function createSpecialForm(){
        return view("admin.createSpecialForm");
    }

    //store new special to database
    public function sendCreateSpecialForm(Request $request){
        $name =  $request->input('name');
        $type =  $request->input('type');
        $discount_amount =  $request->input('discount_amount');
		$start_date = null;
		$end_date = null;
		if($request->has('start_date'))
			$start_date = $request->input('start_date');
		if($request->has('end_date'))
		$end_date = $request->input('end_date');

        $newSpecialArray = array("name"=>$name, 
        	"type"=>$type, "discount_amount"=>$discount_amount,
        	"start_date"=>$start_date,
        	"end_date"=>$end_date);

        $created = DB::table("specials")->insert($newSpecialArray);

        if($created){
            return redirect()->route("specialsPanel");
        }else{
           return "Акция не была создана";
        }
    }

    //specials control panel (display all specials)
    public function specialsPanel(){
      $specials = Special::paginate(10);
      return view('admin.specialsPanel', ["specialsAdmin" => $specials]);
    }

    //delete special
    public function deleteSpecial($id){

      $special = Special::find($id);
      Special::destroy($id);
      return redirect()->back()->with('specialDeletionStatus', 'Акция была успешно удалена');
    }

    //display edit special form
    public function editSpecialForm($id){
       
          $special =  Special::where("id",$id)->firstOrFail();
          return view('admin.editSpecialForm',['special'=>$special]);

    }

    //update special fields
    public function updateSpecial(Request $request,$id){

       $name =  $request->input('name');
       $type = $request->input('type');
       $discount_amount = $request->input('discount_amount');
       $start_date = null;
       $end_date = null;
       if($request->has('start_date'))
       	$start_date = $request->input('start_date');
       if($request->has('end_date'))
       $end_date = $request->input('end_date');

       $updateArray = array("name"=>$name, "type"=>$type, "discount_amount"=>$discount_amount,"start_date"=>$start_date,"end_date"=>$end_date);

        DB::table('specials')->where('id',$id)->update($updateArray);

        return redirect()->route("specialsPanel");
    }                
}
