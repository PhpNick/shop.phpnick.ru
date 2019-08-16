<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Coupon;

class AdminCouponsController extends Controller
{
    //display create coupon form
    public function createCouponForm(){
        return view("admin.createCouponForm");
    }

    //store new coupon to database
    public function sendCreateCouponForm(Request $request){
        $code =  $request->input('code');
        $type =  $request->input('type');
        $discount_amount =  $request->input('discount_amount');
        $max_number_of_uses = null;
        if($request->has('max_number_of_uses'))
        	$max_number_of_uses = $request->input('max_number_of_uses');
        $start_date =  $request->input('start_date');
        $end_date =  $request->input('end_date');
        $publish =  $request->input('publish');

        $newCouponArray = array("code"=>$code, 
        	"type"=>$type, "discount_amount"=>$discount_amount,
        	"max_number_of_uses"=>$max_number_of_uses, "start_date"=>$start_date,
        	"end_date"=>$end_date, "publish"=>$publish);

        $created = DB::table("coupons")->insert($newCouponArray);

        if($created){
            return redirect()->route("couponsPanel");
        }else{
           return "Купон не был создан не был создан";
        }
    }

    //coupons control panel (display all coupons)
    
    public function couponsPanel(){
    
      $coupons = Coupon::paginate(10);
      //print_r($coupons);
      return view('admin.couponsPanel', ["coupons" => $coupons]);
   
    }

    public function publish(Request $request, Coupon $coupon)
    {
      $coupon->publish = request('publish');
      $coupon->save();
      return back();
    }

    //delete coupon
    public function deleteCoupon($id){

      $coupon = Coupon::find($id);
      Coupon::destroy($id);
      return redirect()->back()->with('couponDeletionStatus', 'Купон был успешно удален');
    }

    //display edit coupon form
    public function editCouponForm($id){
       
          $coupon =  Coupon::where("id",$id)->firstOrFail();
          return view('admin.editCouponForm',['coupon'=>$coupon]);

    }

    //update coupon fields
    public function updateCoupon(Request $request,$id){

       $code =  $request->input('code');
       $type = $request->input('type');
       $discount_amount = $request->input('discount_amount');
       $max_number_of_uses = $request->input('max_number_of_uses');
       $start_date = $request->input('start_date');
       $end_date = $request->input('end_date');
       $publish = $request->input('publish');

       $updateArray = array("code"=>$code, "type"=>$type, "discount_amount"=>$discount_amount, "max_number_of_uses"=>$max_number_of_uses,"start_date"=>$start_date,"end_date"=>$end_date,"publish"=>$publish);

        DB::table('coupons')->where('id',$id)->update($updateArray);

        return redirect()->route("couponsPanel");
    }    


}
