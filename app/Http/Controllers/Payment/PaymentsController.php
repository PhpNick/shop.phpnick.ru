<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;




class PaymentsController extends Controller{

    public function showPaymentPage(){

     $payment_info = Session::get('payment_info');

        //has not paied
        if($payment_info['status'] == 'Не оплачен'){
            return view('payment.paymentpage',['payment_info'=> $payment_info]);
         
        }else{
             return redirect()->route("allProducts");
           }
    }

    public function showPaymentReceipt($paypalPaymentID,$paypalPayerID){

        if(!empty($paypalPaymentID) && !empty($paypalPayerID)){
                  //will return json -> contains transaction status
                $this->validate_payment($paypalPaymentID,$paypalPayerID);

                $this->storePaymentInfo($paypalPaymentID,$paypalPayerID);

                 $payment_receipt = Session::get('payment_info');

                 $payment_receipt['paypal_payment_id'] = $paypalPaymentID;
                 $payment_receipt['paypal_payer_id'] = $paypalPayerID;

                //remove session

                  //delete payment_info from session
                    Session::forget("payment_info");
                    //Session::flush();
           
                //return and pass relevant info

             return view('payment.paymentreceipt',['payment_receipt' => $payment_receipt]);

        }else{
               return redirect()->route("allProducts");

        }
    }

    //Код в функции может не работать на локальном сервере
    private function validate_payment($paypalPaymentID, $paypalPayerID){

        $paypalEnv       = 'sandbox'; // Or 'production'
        $paypalURL       = 'https://api.sandbox.paypal.com/v1/'; //change this to paypal live url when you go live
        $paypalClientID  = 'AfmX5EFaDCZcU6ztCrvh3fr0y9bnjlPj7X0g81tMZhcWLPFqfI84l75UZunkhO9pjfoFrsQtHFaCTaf8';
        $paypalSecret   = 'ENLc2aSttRJrc0VhmCeoscpUhYUtEjJaT9ctp-6WsKxW0s-vs4iltY1kk8WGewFQx2yvcVshVJGLnfPH';

        //Здесь получаем access token от paypal,
        //ЧТобы получить доступ к paypal
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2/token');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $paypalClientID.":".$paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);
        
        if(empty($response)){
            return false;
        }else{
            //Используя access token для того
            //Чтобы проверить, что пользователь действительно
            //Оплатил покупку (для этого здесь используется paypalPaymentID)
            $jsonData = json_decode($response);
            $curl = curl_init($paypalURL.'payments/payment/'.$paypalPaymentID);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $jsonData->access_token,
                'Accept: application/json',
                'Content-Type: application/xml'
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            
            // Transaction data
            $result = json_decode($response);
            
            return $result;
        }
    
    }

    private function storePaymentInfo($paypalPaymentID,$paypalPayerID){

           $payment_info = Session::get('payment_info');
           $order_id = $payment_info['order_id'];
           $status = $payment_info['status'];
           $paypal_payment_id = $paypalPaymentID;
           $paypal_payer_id = $paypalPayerID;


       if($status == 'Не оплачен'){
       
        //create (issue) a new payment row in payments table
            $date = date('Y-m-d H:i:s');
            $newPaymentArray = array("order_id"=>$order_id,"date"=>$date,"amount"=>$payment_info['price'],
                "paypal_payment_id"=>$paypal_payment_id, "paypal_payer_id" => $paypal_payer_id);

            $created_order = DB::table("payments")->insert($newPaymentArray);
           

       //update payment status in orders table to "paid"
       
       DB::table('orders')->where('order_id', $order_id)->update(['status' => 'Оплачен']);
       
      }
    }    

    public function getPaymentInfoByOrderId($order_id){
   
        $paymentInfo = DB::table('payments')->where('order_id', $order_id)->get();
         return json_encode($paymentInfo[0]);

   }

}



