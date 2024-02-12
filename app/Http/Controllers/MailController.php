<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
class MailController extends Controller
{
    //



    public static function basic_email($email,$brands,$msgs,$replyTo,$userid) {
        $data = array('name'=>$email,'msg'=>$msgs,'userid'=>$userid);
     
        Mail::send('mail', $data, function($message) use($email,$brands,$replyTo) {
           $message->to($email, $email)->subject('Sign Up Notification');
           $message->from('paradisekolosi@gmail.com','Watawazi');
           $message->replyTo($replyTo, ucwords($brands));
        });
       // echo "Basic Email Sent. Check your inbox.";
     }

     public static function basic_pdf__email($email,$msgs,$id,$user) {
      $data = array('name'=>$email,'msg'=>$msgs,'id'=>$id,'user'=>$user);
   
      Mail::send('mail_pdf', $data, function($message) use($email) {
         $message->to($email, $email)->subject('eBook Download Notification');
         $message->from('paradisekolosi@gmail.com','Watawazi');
     
      });
     // echo "Basic Email Sent. Check your inbox.";
   }


     public static function notification_sign_up_email($email,$brands,$msgs,$replyTo,$userid) {
      $data = array('name'=>$brands,'email'=>$email,'userid'=>$userid);
   
      Mail::send('mail2', $data, function($message) use($email,$brands,$replyTo) {
         $message->to($replyTo, $replyTo)->subject('You have 1 new  lead Sign Up');
         $message->from('paradisekolosi@gmail.com',ucwords($brands));
        
      });
     // echo "Basic Email Sent. Check your inbox.";
   }



     
     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
     }


    // public function basic_email() {
    //  $data = array('name'=>"Virat Gandhi");
    //  Mail::send(['text'=>'mail'], $data, function($message) {
     //    $message->to('abc@gmail.com', 'Tutorials Point')->subject
     //       ('Laravel HTML Testing Mail');
     //    $message->from('xyz@gmail.com','Virat Gandhi');
    //  });
    //  echo "HTML Email Sent. Check your inbox.";
   //}


     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
           $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }





}
