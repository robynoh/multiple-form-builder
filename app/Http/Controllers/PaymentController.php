<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Subscriptions;
use App\Models\Userpackages;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use DB;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $paymentDetails = Paystack::getPaymentData(); //this comes with all the data needed to process the transaction
        // Getting the value via an array method
        $package = $paymentDetails['data']['metadata']['package'];// Getting InvoiceId I passed from the form
        $type= $paymentDetails['data']['metadata']['type'];// Getting InvoiceId I passed from the form
       
        $status = $paymentDetails['data']['status']; // Getting the status of the transaction
        $amount = $paymentDetails['data']['amount']; //Getting the Amount
        $number = $randnum = rand(1111111111,9999999999);// this one is specific to application
        $invoice = date('Y').$number;

        if($status =='success'){


            $date=Carbon::now();
            $package=$package;
            $price= $amount;
            $user_id=auth()->user()->id;
            $type= $type;
        
            switch($type){
                case 'monthly':
        
        
                    $date=Carbon::now();
                    $date2=Carbon::now();
                   $expiry_date=$date->addMonths('1');
                   $warning_date=$date2->addDays('23');

                   
            Subscriptions::create(['userID' => $user_id,'userpackage'=>$package,'amount'=>$amount,'start_warning_at'=>$warning_date,'ends_at'=> $expiry_date,'invoiceID'=> $invoice,'type'=> $type,'status'=>1]); // Storing the payment in the database
           // Userpackages::where('userID', $user_id)->update(['type' => $package,'start_warning_at'=>$warning_date,'ends_at'=> $expiry_date,'status'=> 2,'level'=> $type]);
            $userpackage="update user_package set type='".$package."',level='".$type."',start_warning_at='".$warning_date."',ends_at='".$expiry_date."',status=2 where userID='".$user_id."'";
            DB::insert( $userpackage); 

            return view('users.new_subscriber',['package'=>$package,'type'=>$type,'expire'=> $expiry_date]);
    
                   
                    break;
        
        
        
                case 'annual':
        
                    $date=Carbon::now();
                    $date2=Carbon::now();
                    $expiry_date=$date->addYears('1');
                    $warning_date=$date2->addDays('358');
                    
                    Subscriptions::create(['userID' => $user_id,'userpackage'=>$package,'amount'=>$amount,'start_warning_at'=>$warning_date,'ends_at'=> $expiry_date,'invoiceID'=> $invoice,'type'=> $type,'status'=>1]); // Storing the payment in the database
           // Userpackages::where('userID', $user_id)->update(['type' => $package,'start_warning_at'=>$warning_date,'ends_at'=> $expiry_date,'status'=> 2,'level'=> $type]);
            $userpackage="update user_package set type='".$package."',level='".$type."',start_warning_at='".$warning_date."',ends_at='".$expiry_date."',status=2 where userID='".$user_id."'";
            DB::insert( $userpackage);   
                    return view('users.new_subscriber',['package'=>$package,'type'=>$type,'expire'=> $expiry_date]); 
        
                    break;
        
            }

        }
        
    

        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}