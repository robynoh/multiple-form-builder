<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use \App\Http\Controllers\MailController;
use App\models\lists;
use App\models\page_div;
use App\models\buttons;
use App\models\bg_theme;
use App\models\content_type;
use App\Imports\contactlists;
use App\Imports\phonelistname;
use App\models\visitor_download_files;
use App\Exports\ResponseExport;
use App\models\contactlist;
use App\models\landing_pages;
use App\models\auto_send_phone_name;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


use App\models\autosend;
use App\models\autosendlist;
use Illuminate\Http\Request;
use App\models\sendmsg;
use App\models\interface_list;
use App\models\feature_request;
use App\models\phone_only;
use App\models\anniversary;
use App\models\user_info;
use App\models\entry_stat;
use App\models\view_stat;
use App\models\anniversarylist;
use App\models\phonenamelist;
use App\models\phone_schedule_sms;
use App\models\form_track;
use App\models\table_list;
use App\Models\User;
use DB;
use DateTime;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    //


    public function price()
    {
        
        return view('how');

    }


    public function about()
    {

        
        $blogs= DB::table('blog')->paginate(9);
        return view('blog',['blogs'=>$blogs]);

    }

    public function solution()
    {
        
        return view('solution');

    }


    public function helpvideos()
    {
        $videos= DB::table('help_videos')->get();
        return view('users.help_videos',['videos'=>$videos]);

    }



    public function pdf_download($user,$id)
    {
        $pdf= DB::table('visitor_download_files')->where('interfaceID',$id)->get();
        return view('file_access',['files'=>$pdf]);

    }



    public function index()
    {
        $conlist= DB::table('lists')->where('userID',auth()->user()->id)->get();
        $msg= DB::table('sendmsg')->where('userID',auth()->user()->id)->get();
        $id= DB::table('senderids')
        ->where('userID',auth()->user()->id)
        ->where('status',2)
        ->get(); 

        $board= DB::table('form_track')
        ->where('form','form_'.auth()->user()->id)
        ->where('userID',auth()->user()->id)        
        ->get(); 
        
        $videos= DB::table('help_videos') ->orderBy('vid_id','desc')->paginate(3);; 


        $optin= DB::table('interface_list')
        ->where('userID', auth()->user()->id)
        ->get();

        $payments= DB::table('subscriptions')
        ->where('userID', auth()->user()->id)
        ->get();

        $status= DB::table('user_package')
        ->where('userID', auth()->user()->id)
        ->first();



        // $conlist= DB::table('contactlist')->get(); 
         $auto= DB::table('lists')
         ->select('lists.id','lists.name','lists.userID','autosend.id','autosend.listID','autosend.created_at','autosend.sendtype')
         ->join('autosend','autosend.listID','=','lists.id')
         ->get();

         $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
         $brand= DB::table('brand_logo')->where('userID', auth()->user()->id)->get(); 
         if($checkprofile->count()<1){

            return view('users.moreinfo');
         }
         
         else if($checkprofile->count()>0 && $brand->count()<1){

            return view('users.upload_logo');

         }
         
         else{

            //treat package
            $type=$this->userpackage();

            //subscription status

           $subscription=$this->subStatus();

           //sub switch

           $subswitchx=$this->subswitch(auth()->user()->id);

         return view('users.index',['contactlist'=>$conlist,'auto'=>$auto,'ids'=>$id,'msgs'=>$msg,'boards'=>$board ,'optins'=>$optin,'package'=>$type,'submsg'=>$this->subMsg($this->subCheck(),$this->userpackage(),$this->packagetype()),'payments'=>$payments,'status'=>$status,'videos'=>$videos]);
         }
    }


    public function viewvideo($id){

        $video= DB::table('help_videos')->where('vid_id', $id)->first(); 
    
        return view('users.view_video',['video'=>$video]);
    }




    public function subStatus(){
        $submsg=0;
        $date=Carbon::now();

        $subcnt= DB::table('subscriptions')->where('userID', auth()->user()->id)->get();
        $subcnt->count();
        if($subcnt->count()>0){
        $sub= DB::table('subscriptions')->where('userID', auth()->user()->id)->first();
        if($sub->start_warning_at>=$date->toDateString() && $date->toDateString()< $sub->ends_at){
            $submsg=1;

        }
        if($sub->start_warning_at>=$date->toDateString() && $date->toDateString()>= $sub->ends_at){

        $submsg=2;
    }

    return  $submsg;
}

    }

    public function subStatusMsg($val){
        $msg="";
        $date=Carbon::now();

        if($val==1){

            $sub= DB::table('subscriptions')->where('userID', auth()->user()->id)->first();
            $to=Carbon::createFromFormat('Y-m-d H:s:i',$sub->end_at);
            $from=Carbon::createFromFormat('Y-m-d H:s:i',$date);
            $days=$to->diffInDays($from);
            $msg.="Your Subscription will be due in".$days." day(s)";
        }

        if($val==2){

            $msg.="Your Subscription has expired";
        }

    return  $msg;

    }

    public static function userpackageNosession($userid){

        //  check if user if new
  
        $checkpackage= DB::table('user_package')->where('userID', $userid)->get();
        if($checkpackage->count()<1){
  
          $insquery="insert into user_package (id,userID,type,start_warning_at,ends_at,status,level) values(NULL,'".$userid."','free',NULL,NULL,'1',NULL)";
          $insert = DB::insert($insquery);
  
  
        }
  
        
  
        
  
        $package= DB::table('user_package')->where('userID', $userid)->first();
        return  $package->type;
  
      }


    public static function userpackage(){

      //  check if user if new

      $checkpackage= DB::table('user_package')->where('userID', auth()->user()->id)->get();
      if($checkpackage->count()<1){

        $insquery="insert into user_package (id,userID,type,start_warning_at,ends_at,status,level) values(NULL,'".auth()->user()->id."','free',NULL,NULL,'1',NULL)";
        $insert = DB::insert($insquery);


      }

      

      

      $package= DB::table('user_package')->where('userID', auth()->user()->id)->first();
      return  $package->type;

    }

    public static function packagetypeNosession($userid){

        //  check if user if new
  
        $packagetype= DB::table('user_package')->where('userID', $userid)->first();
        
        return  $packagetype->level;
  
      }


    public static function packagetype(){

        //  check if user if new
  
        $packagetype= DB::table('user_package')->where('userID', auth()->user()->id)->first();
        
        return  $packagetype->level;
  
      }


      public static function mypackageannual(){

        //  check if user if new
  
        $packagetype= DB::table('user_package')->where('userID', auth()->user()->id)->first();
        if($packagetype->status==2){

            return view('users.showpackage',['package'=>$packagetype->type,'plan'=>$packagetype->level]); 

        }
        if($packagetype->status==1){

            return view('users.showpackage',['package'=>$packagetype->type,'plan'=>$packagetype->level]); 


        }
        if($packagetype->status==0){

            return view('users.price_package_annual',['submsg'=>UserController::subMsg(UserController::subCheck(),UserController::userpackage(),UserController::packagetype())]);


        }
  
      }


      public static function mypackage(){

        //  check if user if new
  
        $packagetype= DB::table('user_package')->where('userID', auth()->user()->id)->first();
        if($packagetype->status==2){

            return view('users.showpackage',['package'=>$packagetype->type,'plan'=>$packagetype->level]); 

        }
        if($packagetype->status==1){

            return view('users.showpackage',['package'=>$packagetype->type,'plan'=>$packagetype->level]); 


        }
        if($packagetype->status==0){

            return view('users.price_package',['submsg'=>UserController::subMsg(UserController::subCheck(),UserController::userpackage(),UserController::packagetype())]);


        }
  
      }


      public function visitordownload(){  

        $list= DB::table('visitor_download_files')
        ->select('visitor_download_files.pdf_title','visitor_download_files.pdf_cover','visitor_download_files.downloads','interface_list.description','visitor_download_files.created_at')
        ->join('interface_list','interface_list.id','=','visitor_download_files.interfaceID')
        ->where('interface_list.userID', auth()->user()->id)
        ->get();
        

        return view('users.visitor_downloads',['downloads'=>$list]); 

          }


    public static function subCheck(){

        $subIndex="";

        //  check if user if new
  
          $subcheck= DB::table('user_package')->where('userID', auth()->user()->id)->first();

        if(empty($subcheck->start_warning_at)){

            $subIndex="3";
        }
        else{
        if($subcheck->start_warning_at<=Carbon::now() && $subcheck->ends_at>Carbon::now()){
  
            $subIndex="1";
          
  
  
        }
        else if($subcheck->start_warning_at<Carbon::now() && $subcheck->ends_at<Carbon::now()){
  
            $subIndex="2";
          
  
  
        }

    }
      
      return   $subIndex;

    }


    public static function subCheckNosession($userid){

        $subIndex="";

        //  check if user if new
  
        $subcheck= DB::table('user_package')->where('userID', $userid)->first();
        if($subcheck->start_warning_at<=Carbon::now() && $subcheck->ends_at>Carbon::now()){
  
            $subIndex="1";
          
  
  
        }
        else if($subcheck->start_warning_at<Carbon::now() && $subcheck->ends_at<Carbon::now()){
  
            $subIndex="2";
          
  
  
        }

       
      
      return   $subIndex;

    }


    public static function subswitch($userid){

        

        //  check if user if new
  
        $subcheck= DB::table('user_package')->where('userID', $userid)->first();
        if($subcheck->type!='free'){
         if($subcheck->start_warning_at<Carbon::now() && $subcheck->ends_at<Carbon::now()){

        $insquery="update user_package set status=0 where userID='".$userid."'";
        DB::insert($insquery);
  
           // DB::table('user_package')->where('userID',$userid)->update(['type'=>'essential']);
          
  
  
        }
    }

    }



    public static function subMsg($val,$pac,$mon){

       $msg="";
       $date=Carbon::now();
if($pac!='free'){
       $sub= DB::table('user_package')->where('userID', auth()->user()->id)->first();
       $to=Carbon::createFromFormat('Y-m-d H:s:i',$sub->ends_at);
       $from=Carbon::createFromFormat('Y-m-d H:s:i',$date);
       $days=$to->diffInDays($from);

       

       
        if($val==1){
  
            $msg=" <div class=\"rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-6\"> 
            Your subscription for ".ucwords($pac)." ".$mon."  package will expire in ".$days." day(s).
                </div>";
          
  
  
        }

        if($val==2){
  
            $msg="<div class=\"rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-6\"> 
            Your subscription for ".ucwords($pac)." ".$mon." package has expired.
                </div>";
          
  
  
        }

        
    }else{
        $msg="";

    }
       
      
      return   $msg;

    }

    public function getstarted()
    {
        
        return view('users.get_started');

    }

    public function getstartednicheboard()
    {
        
        return view('users.getting_started_niche_board');

    }

    public function getstartedinterface()
    {
        
        return view('users.getting_started_interface');

    }


    public function getstartedshare(){


        return view('users.getting_started_share');

    }

    public function accesslead(){


        return view('users.getting_started_access_lead');

    }
    
    
    public static function subMsgformNosession($val,$pac,$mon,$user){

        $msg="";
        $date=Carbon::now();
 if($pac !='free'){
        $sub= DB::table('user_package')->where('userID', $user)->first();
        $to=Carbon::createFromFormat('Y-m-d H:s:i',$sub->ends_at);
        $from=Carbon::createFromFormat('Y-m-d H:s:i',$date);
        $days=$to->diffInDays($from);
 
        
 
        
         if($val==1){
   
             $msg=" <div class=\"alert alert-warning\"> 
             Your subscription for ".ucwords($pac)." ".$mon."  package will expire in ".$days." day(s).
                 </div>";
           
   
   
         }
         else if($val==2){
   
             $msg="<div class=\"alert alert-warning\" style=\"text-align:center\"> 
             Your subscription for <b>".ucwords($pac)." ".$mon." package </b>has expired. Visitors of this interface will no longer have access to the sign up form. to renew you subscription click the renew my subscripton button.
            <br/>
             <a href=\"https://www.watawazi.com/users/my-package\" class=\"btn btn-modern btn-dark mr-1\" >RENEW MY SUBSCRIPTION</a>
											
             </div>";
           
   
                
         }
 
 }
 else{

    $msg="";

 }
       
       return   $msg;
 
     }



public function buttonupdate(){

    $content=DB::table('content_type')->where('div_id',request()->input('id'))->first();
    
    DB::table('buttons')->where('id',$content->source)->update(['type' =>request()->input('buttonType'),'text' =>request()->input('buttonText'),'link' =>request()->input('buttonLink')]);
    return redirect()->back()->withSuccess('Button row updated');
                       

}


    public static function subMsgform($val,$pac,$mon){

        $msg="";
        $date=Carbon::now();
 
        $sub= DB::table('user_package')->where('userID', auth()->user()->id)->first();
        $to=Carbon::createFromFormat('Y-m-d H:s:i',$sub->ends_at);
        $from=Carbon::createFromFormat('Y-m-d H:s:i',$date);
        $days=$to->diffInDays($from);
 
        
 
        
         if($val==1){
   
             $msg=" <div class=\"alert alert-warning\"> 
             Your subscription for ".ucwords($pac)." ".$mon."  package will expire in ".$days." day(s).
                 </div>";
           
   
   
         }
         else if($val==2){
   
             $msg="<div class=\"alert alert-warning\" style=\"text-align:center\"> 
             Your subscription for <b>".ucwords($pac)." ".$mon." package </b>has expired. Visitors of this interface will no longer have access to the sign up form. to renew you subscription click the renew my subscripton button.
            <br/>
             <a href=\"http://watawazi.com/users/my-package\" class=\"btn btn-modern btn-dark mr-1\" >RENEW MY SUBSCRIPTION</a>
											
             </div>";
           
   
                
         }
 
        
       
       return   $msg;
 
     }

    public static function userpackagebrand($val){

        //  check if user if new
  
        $checkpackage= DB::table('user_package')->where('userID', $val)->get();
        if($checkpackage->count()<1){
  
          $insquery="insert into user_package (id,userID,type,start_warning_at,ends_at,status,level) values(NULL,'".$val."','free',NULL,NULL,'1',NULL)";
          $insert = DB::insert($insquery);
  
  
        }
  
        
  
        
  
        $package= DB::table('user_package')->where('userID', $val)->first();
        return  $package->type;
  
      }



    public function list()
    {
        $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 

        $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
        if($checkprofile->count()<1){

           return view('users.moreinfo');
        }else{
        return view('users.list',['lists'=>$list]);
        }

    }

    public function addrowvideo(){ 

        
        $div= DB::table('page_div')
        ->where('id',request()->input('id'))
        ->first();
        
        $content = new content_type();
        $content->div_id=request()->input('id');
        $content->page_id= $div->page_id;
        $content->type='video';
        $content->source=request()->input('video');
        $content->save();

        DB::table('page_div')->where('id',request()->input('id'))->update(['status' =>1]);

        return redirect()->back()->withSuccess('You have uploaded a video in a row');



    }

    public function postcontent($id){

        $page = new page_div();
        $page->page_id=$id;
        $page->status=0;
        $page->save();

        $name= DB::table('landing_pages')
        ->where('id',$id)
        ->first(); 
        $div= DB::table('page_div')
        ->where('page_id',$id)
        ->get(); 
        return redirect()->back()->withSuccess('You have created a new row');

    }


    public function posttext(){

        if(count(request()->all()) > 0){

            $div= DB::table('page_div')
        ->where('id',request()->input('type'))
        ->first();

            $content = new content_type();
            $content->div_id=request()->input('type');
            $content->page_id=$div->page_id;
            $content->type='text';
            $content->source=request()->input('text-content');
            $content->save();

            DB::table('page_div')->where('id',request()->input('type'))->update(['status' =>1]);

            return redirect()->back()->withSuccess('Text updated successfully');





        }
    }

    public function deletecontenttext($id){
        $content= DB::table('content_type')->where('div_id',$id)->first(); 
        if($content->type=='button'){

            DB::table('buttons')->where('id',$content->source)->delete();
            DB::table('content_type')->where('div_id',$id)->delete();


        }else{
        DB::table('content_type')->where('div_id',$id)->delete();
    }

        DB::table('page_div')->where('id',$id)->update(['status' =>0]);
        return redirect()->back()->withSuccess('one row deleted');

    }


    public function deleteboard($id){


        $board= DB::table('form_track')->where('table_id', $id)->first(); 

        if(file_exists(public_path('photos/'.basename($board->logo)))){
     
            unlink(public_path('photos/'.basename($board->logo)));
      
          }

          $table= DB::table('table_list')->where('id', $id)->first(); 
         

          DB::table('DROP TABLE form_'.auth()->user()->id.'_store_'.$table->tablename.'');

        DB::table('form_track')->where('table_id',$id)->delete();
        DB::table('interface_list')->where('table_id',$id)->delete();

        return redirect()->back()->withSuccess('board deleted succesfully');

    }

    public function addrowimage(){

        if(count(request()->all()) > 0){


            $div= DB::table('page_div')
            ->where('id',request()->input('img'))
            ->first();
            
         

            $fileName = md5(Str::random(30).time().'_'.request()->file('file')).'.'.request()->file('file')->getClientOriginalExtension();

           

           // $original_filename = strtolower(trim($imgfile->getClientOriginalName()));
           // $extension = $imgfile->getClientOriginalExtension();
           // $fileName =  time().rand(100,999).Hash::make($original_filename).'.'. $extension;
             $filePath = 'landingPagePhotos';
             $filePathdb = asset('/landingPagePhotos/'.$fileName);
             request()->file('file')->move($filePath,$fileName);
    
           
            $content = new content_type();
            $content->div_id=request()->input('img');
            $content->page_id=$div->page_id;
            $content->type="image";
            $content->source=$filePathdb;
            $content->save();

             DB::table('page_div')->where('id',request()->input('img'))->update(['status' =>1]);

            return redirect()->back()->withSuccess('Image Uploaded in row successfully');
    
    
        
    }


    }

    public function posttextupdate(){

        DB::table('content_type')->where('div_id', request()->input('type'))->update(['source' => request()->input('text-content')]);
        return redirect()->back()->withSuccess('one row updated successfully');

        echo request()->input('text-content');
    } 



    public function postbodyupdate(){

        if(request()->input('borderoption')==1){

        DB::table('bg_theme')->where('page_id', request()->input('pageid'))->update(['bgcolor' => request()->input('bgcolor'),'border_option' => request()->input('borderoption'),'border_color' => request()->input('bordercolor')]);
        }else{

            DB::table('bg_theme')->where('page_id', request()->input('pageid'))->update(['bgcolor' => request()->input('bgcolor'),'border_option' => request()->input('borderoption'),'border_color' =>"nil"]);
      

        }
        
        
        return redirect()->back()->withSuccess('page body updated successfully');
    }

    public function posttitleupdate(){

        DB::table('landing_pages')->where('id', request()->input('pageid'))->update(['page_title' => request()->input('page-title'),'color' => request()->input('textcolor')]);
        return redirect()->back()->withSuccess('one row updated successfully');
    }

    public function pulltextcontent($id)
    {
        
      
       
        $events= DB::table('content_type')->where('div_id', $id)->first(); 
        return response()->json($events);
   
            
    }

    public function filterContent($val){

        $output="";
        $contents= DB::table('content_type')->where('div_id',$val)->get(); 
        $content= DB::table('content_type')->where('div_id',$val)->first(); 
        if($contents->count()>0){
        if($content->type=='text'){

            $output="<div>".$content->source."</div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left\"><i data-feather=\"edit\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConEdit($content->div_id);\">Edit</a></span> <span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";

        }
        else if($content->type=='image'){

            $output="<div style=\"width:100%\"><img src=".$content->source."  class=\"img\" /> </div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";

            
        }
        else if($content->type=='button'){

            $buttons= DB::table('buttons')->where('id',$content->source)->first(); 
            $output="<br/><div style=\"text-align:center\">".UserController::showButtons($buttons->type, $buttons->text,$buttons->link)."</div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left\"><i data-feather=\"edit\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertButtonEdit($content->div_id);\">Edit</a></span> <span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";

            
        }
        else if($content->type=='signup'){


            $output="<div style=\"width:100%;horizontal-align:middle\"><iframe src=\"$content->source\" title=\"W3Schools Free Online Web Tutorials\" style=\"width:100%;height:600px\"></iframe> </div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";



            
        }
        else if($content->type=='video'){

            $output="<div  style=\"width:100%;horizontal-align:middle\"><div class=\"img\">'.$content->source.'</div> </div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";

            
        }

    }

       return $output;

    

    }






    public function filterContent2($val){

        $output="";
        $contents= DB::table('content_type')->where('div_id',$val)->get(); 
        $content= DB::table('content_type')->where('div_id',$val)->first(); 
        if($contents->count()>0){
        if($content->type=='text'){

            $output="<div>".$content->source."</div>";

        }
        else if($content->type=='image'){

            $output="<div  ><img src=".$content->source." class=\"img-fluid img-thumbnail img-thumbnail-no-borders rounded-0\"  /> </div>";

            
        }
        else if($content->type=='button'){

            $buttons= DB::table('buttons')->where('id',$content->source)->first(); 
            $output="<br/><div style=\"text-align:center\">".UserController::showButtons2($buttons->type, $buttons->text,$buttons->link)."</div>";

            
        }
        else if($content->type=='signup'){


            $output="<div style=\"width:100%;horizontal-align:middle\"><iframe src=\"$content->source\" title=\"W3Schools Free Online Web Tutorials\" style=\"width:100%;height:600px\"></iframe> </div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span><span style=\"float:left\"><a id=\"deleteUser$content->div_id\" data-userid=\"$content->div_id\" href=\"javascript:void(0)\" onclick=\"showAlertConDel($content->div_id);\">Delete</a></span> </div>";



            
        }
        else if($content->type=='video'){

            $output="<div  style=\"width:100%;horizontal-align:middle\"><div class=\"img\">'.$content->source.'</div> </div>"."<div style=\"color:#0033FF;padding-top:10px\"><span style=\"float:left;padding-left:20px\"><i data-feather=\"trash-2\" class=\"w-4 h-4 mr-2\"></i></span> </div>";

            
        }

    }

       return $output;

    

    }



public static function showButtons($type,$text,$link){
$output="";

$output='<a href="'.$link.'" class="button button--lg w-40 mr-1 mb-2 bg-theme-'.$type.' text-white">'.$text.'</a>';
  

return $output;

}


public static function showButtons2($type,$text,$link){
    $output="";

    if($type==1){


        $output='<a href="'.$link.'" class="btn btn-info btn-xl mb-2">'.$text.'</a>';
      
    

    }

    if($type==6){


        $output='<a href="'.$link.'" class="btn btn-danger btn-xl mb-2">'.$text.'</a>';
      
    

    }

    if($type==7){


        $output='<a href="'.$link.'" class="btn btn-info btn-xl mb-2">'.$text.'</a>';
      
    

    }

    if($type==9){


        $output='<a href="'.$link.'" class="btn btn-success btn-xl mb-2">'.$text.'</a>';
      
    

    }
    
    
    return $output;
    
    }
    public function addrowsbutton(){


 if(count(request()->all()) > 0){

    $div= DB::table('page_div')
    ->where('id',request()->input('id'))
    ->first();

    $buttons = new buttons();
        
            $buttons->type=request()->input('buttonType');;
            $buttons->text=request()->input('buttonText');
            $buttons->link=request()->input('buttonLink');
            $buttons->save();


    $content = new content_type();
    $content->div_id=request()->input('id');
    $content->page_id=$div->page_id;
    $content->type="button";
    $content->source=$buttons->id;
    $content->save();

    DB::table('page_div')->where('id',request()->input('id'))->update(['status' =>1]);


            return redirect()->back()->withSuccess(' button added to rows successfully');





        }

    }

public function addrowsignup(){

    $div= DB::table('page_div')
    ->where('id',request()->input('id'))
    ->first();

    $content = new content_type();
    $content->div_id=request()->input('id');
    $content->page_id=$div->page_id;
    $content->type="signup";
    $content->source=request()->input('interfaceLink');
    $content->save();


    DB::table('page_div')->where('id',request()->input('id'))->update(['status' =>1]);


    return redirect()->back()->withSuccess(' You have added a sign up board to rows successfully');

}


public function newpage(){

    DB::table('page_div')->where('id',request()->input('pageid'))->update(['status' =>1]);
    DB::table('landing_pages')->where('id',request()->input('pageid'))->update(['status' =>1]);
    $page= DB::table('landing_pages') 
    ->where('userID',auth()->user()->id)
    ->get();

    return view('users.all_pages',['pages'=>$page]);

}

public function landinpagetrim($user,$userid,$title,$id){

    $pageCount= DB::table('page_view_count')
    ->where('page_id',$id)
    ->get(); 
    $pageCounts= DB::table('page_view_count')
    ->where('page_id',$id)
    ->first(); 
   if(!Auth::check()){
    if($pageCount->count()<1){

        $insquery="insert into page_view_count (id,page_id,visit_count) values(NULL,'".$id."','1')";
        $insert = DB::insert( $insquery);
    }
    else{

        DB::table('page_view_count')->where('page_id',$id)->update(['visit_count' =>$pageCounts->visit_count+1]);

    }
}

  $namecount= DB::table('landing_pages')
   ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
  ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
  ->where('landing_pages.id',$id)
  ->get();



    //$name= DB::table('landing_pages')
    //->where('id',$id)
   // ->first();
   if(empty($namecount->count())){

    $brandx= DB::table('users_info')->where('userID',$userid)->first(); 
return view('error_page',['userid'=>$userid,'brandx'=>$brandx->brand_name]);

   }else{
   
   $statusx= DB::table('user_package')->where('userID',$userid)->first(); 
   if($statusx->status!=0){

    $name= DB::table('landing_pages')
   ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
  ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
  ->where('landing_pages.id',$id)
  ->first();

    $interfacex= DB::table('interface_list')
    ->where('userID', $userid)
    ->get();
   
    $div= DB::table('page_div')
    ->where('page_id',$id)
    ->orderBy('id','asc')
    ->get(); 

    return view('lpage',['divs'=>$div,'page'=>$name,'interfaces'=>$interfacex,'title'=>$title]);
    
    
}else{



$brandx= DB::table('users_info')->where('userID',$userid)->first(); 
return view('error_page',['userid'=>$userid,'brandx'=>$brandx->brand_name]);

}

}

   



}

public function pageviewCount($id){
$ouput="";
    $count= DB::table('page_view_count')
    ->where('page_id',$id)
    ->get(); 

    foreach($count as $co){
        $ouput=$co->visit_count;

    }

    return   $ouput;


}


public function landinpagetrim2($id,$userid,$businessname,$title){

    $pageCount= DB::table('page_view_count')
    ->where('page_id',$id)
    ->get(); 
    $pageCounts= DB::table('page_view_count')
    ->where('page_id',$id)
    ->first(); 
   if(!Auth::check()){
    if($pageCount->count()<1){

        $insquery="insert into page_view_count (id,page_id,visit_count) values(NULL,'".$id."','1')";
        $insert = DB::insert( $insquery);

        $insquery="insert into land_count (id,page_id,visit_count,year,day,month) values(NULL,'".$id."','1','".date('Y')."','".date('d')."','".date('m')."')";
        $insert = DB::insert( $insquery);
    }
    else{

        DB::table('page_view_count')->where('page_id',$id)->update(['visit_count' =>$pageCounts->visit_count+1]);

    }
}

  $namecount= DB::table('landing_pages')
   ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
  ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
  ->where('landing_pages.id',$id)
  ->get();



    //$name= DB::table('landing_pages')
    //->where('id',$id)
   // ->first();
   if(empty($namecount->count())){

    $brandx= DB::table('users_info')->where('userID',$userid)->first(); 
return view('error_page',['userid'=>$userid,'brandx'=>$brandx->brand_name]);

   }else{
   
   $statusx= DB::table('user_package')->where('userID',$userid)->first(); 
   if($statusx->status!=0){

    $name= DB::table('landing_pages')
   ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
  ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
  ->where('landing_pages.id',$id)
  ->first();

    $interfacex= DB::table('interface_list')
    ->where('userID', $userid)
    ->get();
   
    $div= DB::table('page_div')
    ->where('page_id',$id)
    ->orderBy('id','asc')
    ->get(); 

    return view('lpage',['divs'=>$div,'page'=>$name,'interfaces'=>$interfacex,'title'=>$title]);
    
    
}else{



$brandx= DB::table('users_info')->where('userID',$userid)->first(); 
return view('error_page',['userid'=>$userid,'brandx'=>$brandx->brand_name]);

}

}

   



}





public function landingpage($id){

     //$name= DB::table('landing_pages')
        //->where('id',$this->encrypt_decrypt($id,false))
        //->first(); 

        $name= DB::table('landing_pages')
        ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
       ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
       ->where('landing_pages.id',$this->encrypt_decrypt($id,false))
       ->first();




    $interfacex= DB::table('interface_list')
       ->where('userID', $name->userID)
       ->get();
       
      $div= DB::table('page_div')
       ->where('page_id',$this->encrypt_decrypt($id,false))
       ->orderBy('id','asc')
       ->get(); 
       return view('lpage',['divs'=>$div,'page'=>$name,'interfaces'=>$interfacex]);

    
}

    public function pagecontent($id){
        $interfacex= DB::table('interface_list')
        ->where('userID', auth()->user()->id)
        ->get();

        //$name= DB::table('landing_pages')
        //->where('id',$id)
        //->first(); 

        $name= DB::table('landing_pages')
   ->select('landing_pages.id','landing_pages.page_title','landing_pages.color','landing_pages.status','landing_pages.userID','bg_theme.bgcolor','bg_theme.border_option','bg_theme.border_color')
  ->join('bg_theme','bg_theme.page_id','=','landing_pages.id')
  ->where('landing_pages.id',$id)
  ->first();



        $div= DB::table('page_div')
        ->where('page_id',$id)
        ->orderBy('id','asc')
        ->get(); 
        return view('users.lpcontent',['divs'=>$div,'page'=>$name,'interfaces'=>$interfacex]);
    }

public function postpages(){

    $pages= DB::table('landing_pages')
->where('userID',auth()->user()->id)
->get();

if($this->subCheck()!=2){

    if($pages->count()<1 && $this->userpackage()=='free' || $pages->count()<5 && $this->userpackage()=='essential'|| $this->userpackage()=='pro'){

    $lists = new landing_pages();
    $lists->page_title=request()->input('page-name');
    $lists->color='#000';
    $lists->userID=auth()->user()->id;
    $lists->status=0;
    $lists->save();

    $bgtheme= new bg_theme();
    $bgtheme->page_id=$lists->id;
    $bgtheme->bgcolor='#fff';
    $bgtheme->border_option=0;
    $bgtheme->border_color='nil';
    $bgtheme->save();

    return redirect()->back()->withSuccess('page name created succesfully.');

    }
}else{



    return redirect()->back()->withErrors('Sorry! your subscription for the '.$this->userpackage().' package has expired')->withInput();
   

}  
}


    public function allpages()
    {
        $page= DB::table('landing_pages') 
        ->where('userID',auth()->user()->id)
        ->orderBy('id','desc')
        ->get();

        return view('users.all_pages',['pages'=>$page]);

    }





    public function choosepackage(Request $request)
    {
       
     $date=Carbon::now();
    $package=$request->input('package');
    $price= $request->input('price');
    $user_id=auth()->user()->id;
    $type= $request->input('type');

    switch($type){
        case 'monthly':


            $date=Carbon::now();
            $date2=Carbon::now();
           $expiry_date=$date->addMonths('1');
           $warning_date=$date2->addDays('23');
           
            break;



        case 'yearly':

            $date=Carbon::now();
            $date2=Carbon::now();
            $expiry_date=$date->addYears('1');
            
            $warning_date=$date2->addDays('358');
            
            

            break;

    }


    }





    public function optinlist(){



        $interfacex= DB::table('interface_list')
        ->where('userID', auth()->user()->id)
        ->get();

        return view('users.interface-list',['interfaces'=>$interfacex]);
       

    }




    public function optininterface($id)
    {
        $record= DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($this->encrypt_decrypt($id,false)))
        ->get();

        $formsx= DB::table('form_track')
        ->where('userID', auth()->user()->id)
        ->where('table_id',$this->encrypt_decrypt($id,false))
        ->first();

        $interfacex= DB::table('interface_list')
        ->where('userID', auth()->user()->id)
        ->where('table_id',$this->encrypt_decrypt($id,false))
        ->orderBy('id','desc')
        ->get();

        return view('users.optin_interface',['form'=>$formsx,'interfaces'=>$interfacex,'records'=>$record]);
       

    }


    public function requestfeature(){

        return view('users.request_feature');
       
    }



    public function postrequest()    
    {
        $validator=$this->validate(request(),[
            'request-type'=>'required|string',
            'request-summary'=>'required|string',
            'request-description'=>'required|string',   
           
            ],
            [
                'request-type.required'=>'Choose type of request ',
                'request-summary.required'=>'Enter summary of the feature ',
                'request-description.required'=>'Enter a detail description of feature ',
                
                   
                ]);
    
                if(count(request()->all()) > 0){

                    $features = new feature_request();
                    $features->request_type=request()->input('request-type');
                    $features->request_summary=request()->input('request-summary');
                    $features->request_description=request()->input('request-description');
                    $features->userID=auth()->user()->id;
                    $features->request_status=1;
                    $features->save();

                    
                   return redirect()->back()->withSuccess('Your request has been recieved. Thank you '.ucwords(auth()->user()->name)); 


}}


    public function formpage()
    {
       // $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 

             

           return view('formpage');
        

    }

    public function senderid()
    {
        $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
        if($checkprofile->count()<1){

           return view('users.moreinfo');
        }else{
        return view('users.senderid');
        }
    }


public function moreinfo(){

    return view('users.moreinfo');

}

public function pricepackage(){

    return view('users.price_package',['submsg'=>$this->subMsg($this->subCheck(),$this->userpackage(),$this->packagetype())]);
}


public function displayform($name,$user,$title){
    $title="";
    $description="";

    $forms= DB::table('form_track')
    ->where('userID', $user)
   ->first(); 

   $title=$forms->title;
    $description=$forms->note;
    $organisation=$forms->company_name;
    $logo=$forms->logo;


   $allfield= DB::table('form_'.$user)
  ->get(); 

    return view('formpage',['users'=>$user,'title'=>$title,'notes'=>$description,'company_name'=>$organisation,'logos'=>$logo,'fields'=>$allfield]);

}







public function deleterecord(Request $request){

    switch ($request->input('action')) {
        case 'delete':


            if(count(request()->all()) > 0){

                if(isset($_POST['res'])){


                    if (is_array($_POST['res'])) {
                        foreach($_POST['res'] as $value){
                            

                            DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name(request()->input('tableid')))->where('id',$value)->delete();
                           

                       
                        }
                    
                        return redirect()->back()->withSuccess('Record deleted succesfully');
                    
                    }
                
                
                }
                        else{

                            return redirect()->back()->withErrors('You have not checked any record to delete')->withInput();
         
                        }

            }else{



            }
        }

}

public function postcustomdetail($id){

    $validator=$this->validate(request(),[
        'bgcolor'=>'required|string',
        'tcolor'=>'required|string',
        'bcolor'=>'required|string',
        'dcolor'=>'required|string',
        'titleftsize'=>'required|string',
        'desFtsize'=>'required|string',
        'font_type'=>'required|string',
        'tfcolor'=>'required|string',
        'buttonTxt'=>'required|string',
    ]);
    if(count(request()->all()) > 0){


        switch (request()->input('customize')) {

            case 'save':


        //$insquery="insert into form_styles (id,table_id,title_color,description_color,bgcolor,bcolor,title_size,description_size,font_type) 
        //values(NULL,'".$this->encrypt_decrypt($id,false)."','".request()->input('tcolor')."','".request()->input('dcolor')."','".request()->input('bgcolor')."','".request()->input('bcolor')."','".request()->input('titleftsize')."','".request()->input('desFtsize')."','".request()->input('font_type')."')";
        //$insert = DB::insert( $insquery);

        DB::table('form_styles')->where('table_id',$this->encrypt_decrypt($id,false))
        ->update([
            
            'title_color' =>request()->input('tcolor'),
            'description_color' =>request()->input('dcolor'),
            'bgcolor' =>request()->input('bgcolor'),
            'bcolor' =>request()->input('bcolor'),
            'btcolor' =>request()->input('btcolor'),
            'title_size' =>request()->input('titleftsize'),
            'description_size' =>request()->input('desFtsize'),
            'font_type' =>request()->input('font_type'),
            'tfcolor' =>request()->input('tfcolor'),
            'buttonText' =>request()->input('buttonTxt')
    ]);

        $list= DB::table('form_styles')->where('table_id', $this->encrypt_decrypt($id,false))->first();
        
        $allfield= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 

        //return view('customise_sign_up',['tableid'=>$this->encrypt_decrypt($id,false),'style'=>$list,'fields'=> $allfield]);
        return redirect()->back()->withSuccess('Your form has been customized succesfully')->with('style',$list);   
    break;

    case 'default':

        DB::table('form_styles')->where('table_id',$this->encrypt_decrypt($id,false))
        ->update([
            
            'title_color' =>'#fefefe',
            'description_color' =>'#fefefe',
            'bgcolor' =>'#0088cc',
            'bcolor' =>'#0f0511',
            'btcolor' =>'#fff',
            'title_size' =>'25',
            'description_size' =>'18',
            'font_type' =>'"Poppins", Arial, sans-serif',
            'tfcolor' =>'#fff',
            'buttonText' =>'SIGN UP'

    ]);

   
    $list= DB::table('form_styles')->where('table_id', $this->encrypt_decrypt($id,false))->first();
        
        $allfield= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 

        //return view('customise_sign_up',['tableid'=>$this->encrypt_decrypt($id,false),'style'=>$list,'fields'=> $allfield]);
        return redirect()->back()->withSuccess('Your form has been customized succesfully')->with('style',$list);   
    
        break;


    }

   
        
    }

}


public function noprofile(Request $request){

    $insqueryx="insert into no_profile_visibility (id,table_id) values(NULL,'".$request->input('table_id')."')";
    $insertx= DB::insert($insqueryx);

    return redirect()->back()->withSuccess('Your profile panel has been set to private');

}

public function bringprofile($id){

    $delete="delete from no_profile_visibility where table_id='".$this->encrypt_decrypt($id,false)."' ";
    $insert = DB::insert($delete);

    return redirect()->back()->withSuccess('Your profile panel has been set to public');

}

public function customform($id){


    $allfield= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 

    $list= DB::table('form_styles')->where('table_id', $this->encrypt_decrypt($id,false))->first();
       

    return view('customise_sign_up',['fields'=>$allfield,'niche'=>$this->get_niche_name($this->encrypt_decrypt($id,false)),'tableid'=>$this->encrypt_decrypt($id,false),'style'=>$list]);


}

public function usersettings($id){

    return view('users.user_settings',['tableid'=>$this->encrypt_decrypt($id,false),'niche'=>$this->get_niche_name($this->encrypt_decrypt($id,false)),'package'=>$this->userpackage()]);

}


public static function get_niche_name($id)
    {
        $tname= DB::table('form_track')->where('table_id',$id)->first();
        return $tname->niche;

    }


    public static function get_niche_logo($id)
    {
        $tname= DB::table('form_track')->where('table_id',$id)->first();
        return $tname->logo;

    }

public static function get_table_name($id)
    {
        $tname= DB::table('table_list')->where('id',$id)->first();
        return $tname->tablename;

    }

    
public function response($id){


    $fromlist= DB::table('form_track')->where('table_id',$this->encrypt_decrypt($id,false))->first(); 


    $scountrowsx= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 
    $ascountx=$scountrowsx->count();

    $srowsx=DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acountx=$srowsx->count();
    
    
    
    
    $srows1x=DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acount1x= $srows1x->count();
    
    $srows2x=DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($this->encrypt_decrypt($id,false)))
    ->orderBy('id','desc')
    ->get() ;
    $acount2x=$srows2x->count();

    return view('users.response',['scountrows'=> $scountrowsx,'ascount'=> $ascountx,'srows'=> $srowsx,'acount'=>$acountx,'srows1'=>$srows1x,'acount1'=> $acount1x,'srows2'=>$srows2x,'acount2'=>$acount2x,'tableid'=>$this->encrypt_decrypt($id,false),'niche'=>$fromlist->niche]);

}



public function responseboard($id){


    $fromlist= DB::table('form_track')->where('table_id',$this->encrypt_decrypt($id,false))->first(); 


    $scountrowsx= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 
    $ascountx=$scountrowsx->count();

    $srowsx=DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acountx=$srowsx->count();
    
    
    
    
    $srows1x=DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acount1x= $srows1x->count();
    
    $srows2x=DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($this->encrypt_decrypt($id,false)))
    ->orderBy('id','desc')
    ->get() ;
    $acount2x=$srows2x->count();

    return view('users.response_board',['scountrows'=> $scountrowsx,'ascount'=> $ascountx,'srows'=> $srowsx,'acount'=>$acountx,'srows1'=>$srows1x,'acount1'=> $acount1x,'srows2'=>$srows2x,'acount2'=>$acount2x,'tableid'=>$this->encrypt_decrypt($id,false),'niche'=>$fromlist->niche]);

}



public function resdelete($id,$tableid){

    DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($tableid))->where('id',$id)->delete();
    return redirect()->back()->withSuccess('Record has been removed successfully.');

}

public function resdetail($id,$table){

    $srowsx=DB::table('form_'.auth()->user()->id)
    ->where('table_name',$this->get_table_name($this->encrypt_decrypt($table,false)))
    ->get() ;
    $acountx=$srowsx->count();

   

   $srows1=DB::table('form_'.auth()->user()->id)
   ->where('table_name',$this->get_table_name($this->encrypt_decrypt($table,false)))
   ->get();
    $acount1x=$srows1->count();
    
    

    $srows2x=DB::table('form_'.auth()->user()->id.'_store_'.$this->get_table_name($this->encrypt_decrypt($table,false)))
    ->where('id',$this->encrypt_decrypt($id,false))
    ->get() ;
    $acount2x=$srows2x->count();
    return view('users.response_detail',['srows'=>$srowsx,'acount'=>$acountx,'srows2'=>$srows2x,'acount2'=>$acount2x,'fieldid'=>$this->encrypt_decrypt($id,false),'tableid'=>$this->encrypt_decrypt($table,false)]);

}


public function payhistory()
{
   
   $users= DB::table('users') 
       ->select('users.name','users.email','users.id','subscriptions.userpackage','subscriptions.type','subscriptions.created_at','subscriptions.ends_at','subscriptions.invoiceID','subscriptions.amount','subscriptions.status')
       ->join('subscriptions','subscriptions.userID','=','users.id')
       ->where('subscriptions.userID',auth()->user()->id)
       ->get();

       return view('users.pay_history',['users'=>$users]); 
       
  
}



public static function getResponseValue($fieldname,$id,$table){
   
    
    $output="";
    
    $rows=DB::table('form_'.auth()->user()->id.'_store_'.UserController::get_table_name($table))
    ->where('id',$id)
    ->get() ;
    foreach($rows as $row){
        
 if ($fieldname=='state'){ 
 
 $output.=UserController::get_state_name($row->$fieldname);
 
 }
else{
     $output.=ucwords(str_replace('/', ' ,',$row->$fieldname));
     }  	
    //$output.=str_replace('/', ' ,',$row[$fieldname]);
        
    }
    return $output;
}




public function customfield($id){

    return view('users.create_custom_field',['tableid'=>$id]);

}


public function customfieldnew(){

    return view('users.create_custom_field_new');

}

public function customfieldedit($id){

    return view('users.create_custom_field_edit',['tableid'=>$this->encrypt_decrypt($id,false)]);

}


public static function pull_business($id){

    $fdata= DB::table('form_track')
    ->where('table_id',  UserController::encrypt_decrypt($id,false))
    ->first();
    
    return $fdata->company_name;


}

public static function pull_description($id){

    $fdata= DB::table('form_track')
    ->where('table_id',  UserController::encrypt_decrypt($id,false))
    ->first();
    
    return $fdata->note;


}


public function acknowledgement($id){

    $ack= DB::table('acknowledgement_msg')
    ->where('table_id',  UserController::encrypt_decrypt($id,false))
    ->first();
    return view('users.confrim_msg',['tableid'=>$id,'acknowledge'=>$ack]);
}


public static function pull_logo($id){

    $fdata= DB::table('form_track')
    ->where('table_id',  UserController::encrypt_decrypt($id,false))
    ->first();
    
    return $fdata->logo;


}



public function form_step2($id){

    $fdata= DB::table('form_'.auth()->user()->id)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->orderBy('fieldord','asc')
    ->get(); 

    return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>$this->encrypt_decrypt($id,false)]);

}

public function form_step_sheet(){

    $fdata= DB::table('form_'.auth()->user()->id)
    ->orderBy('fieldord','asc')
    ->get(); 

    

    return view('users.create_form_sheet',['fields'=>$fdata]);

    

}

    public function mysender()
    {
        $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
        
        return view('users.my_senderid',['ids'=>$idsx]);

    }


    public function donelist($id)
    {
        $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
        return view('users.donelist',['list'=>$id]);

    }

    public function form_create()
    {
        
        return view('users.done_form_create');

    }

    public function collectinfo()
    {
        $chk="";
        $title="";
        $chckcnt=0;

        $nulled= DB::table('form_track')
        ->where('form','form_'.auth()->user()->id)
        ->where('title','=','')
        ->where('logo','=','')
        ->where('company_name','=','')
        ->get(); 


       $frmchks= DB::table('form_track')
       ->where('form','form_'.auth()->user()->id)
       ->where('title','!=','')
       ->where('logo','!=','')
       ->where('company_name','!=','')
       ->orderBy('track_id','desc')
       ->paginate(5); 
       foreach($frmchks as $frmchk){
        $title.=$frmchk->title;

        if(empty($frmchk->title)){
            $chckcnt=$chckcnt+1;
        }
       }


       if($frmchks->count()<1){

        $chk=0;
       }
       else if($frmchks->count()>0 &&  $chckcnt>0){

        $chk=1;
       }

       else if($frmchks->count()>0 &&  $chckcnt==0 ){

        $chk=2;
       }

       $formsx= DB::table('sms_for_phone')
       ->where('form','form_'.auth()->user()->id)
       ->where('userID',auth()->user()->id)
       ->get();





       $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
        $brand= DB::table('brand_logo')->where('userID', auth()->user()->id)->get();
        foreach($brand as $brando){

            $logo=$brando->logo;
        }
        if($checkprofile->count()<1){

            return view('users.moreinfo');
         }
         
         else if($checkprofile->count()>0 && $brand->count()<1){

            return view('users.upload_logo');

         }else{
      
        

            return view('users.collect_info',['filter'=>$chk,'datas'=>$frmchks,'forms'=>$formsx,'empty'=>$nulled]);


       }
       
       
     
    }

    public function createform()
    {
       // $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
        return view('users.create_form');

    }

    public function newfieldedit($id)
    {
       // $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
        return view('users.add_new_field_edit',['tableid'=>$id]);

    }


    public function formedit($id)
    {
       // $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$this->get_table_name($this->encrypt_decrypt($id,false)))
    ->orderBy('fieldord','asc')
    ->get();
        return view('users.create_form_edit',['fields'=>$fdata,'tableid'=>$this->encrypt_decrypt($id,false)]);

    }


    public function forminfoedit($id)
    {
        $infos= DB::table('form_track')
        ->where('userID',auth()->user()->id)
        ->where('form',"form_".auth()->user()->id)
        ->where('table_id',$this->encrypt_decrypt($id,false))
        ->first(); 
       // $smsinfo= DB::table('sms_for_phone')->where('userID',auth()->user()->id)->first(); 
        return view('users.form_info_edit',['info'=>$infos,'tableid'=>$this->encrypt_decrypt($id,false)]);

    }

    public function optinInfoedit($id)
    {
        $infos= DB::table('interface_list')
        ->where('id',$this->encrypt_decrypt($id,false))
        ->first(); 
       // $smsinfo= DB::table('sms_for_phone')->where('userID',auth()->user()->id)->first(); 
        return view('users.edit_optin_info',['info'=>$infos]);

    }


    public static  function showHumanTime($date,$time){
    $timeVariable= $date." ".$time;
    $time=  date("D, d M Y", strtotime($timeVariable));
    return $time;

    }

public function updateacknowledgement($id){

    $validator=$this->validate(request(),[
        'thank'=>'required|string',
        'email'=>'required|string',
      
        ]);


        if(count(request()->all()) > 0){


            DB::table('acknowledgement_msg')->where('table_id',$this->encrypt_decrypt($id,false))
        ->update([
            
            'thankMsg' =>request()->input('thank'),
            'respEmail' =>request()->input('email'),
    ]);


    return redirect()->back()->withSuccess('Update saved successfully.');
        }




}

    public function optin_info_update($id){
        $table=$this->encrypt_decrypt($id,false);

        $infos= DB::table('form_track')
        ->where('userID',auth()->user()->id)
        ->where('form',"form_".auth()->user()->id)
        ->where('table_id',$table)
        ->first(); 

        return view('users.form_info_optin',['tableid'=>$table,'info'=>$infos]);

    }




    public function form_info_update(){

        //1.validate data
           
        $validator=$this->validate(request(),[
           'organisation'=>'required|string',
           'title'=>'required|string',
           'niche'=>'required|string',
           'note'=>'required|string',
          
          
           ]);
   
               if(count(request()->all()) > 0){
   
                  
   
   
                   if(empty( request()->file('file'))){
   
                    
                         
                DB::table('form_track')
                ->where('userID',auth()->user()->id)
                ->where('table_id',request()->input('tableid'))
                ->update(['company_name' => request()->input('organisation'),'niche'=>request()->input('niche'),'title' => request()->input('title'), 'note' => request()->input('note')]);
                //DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
               
                    
                   
                       return redirect()->back()->withSuccess('Update succesful.');
                   
                   }
                   else{ 
   
   
   
   
   
                         ///// remove the existing file from folder /////////
   
                         $existFile=""; 
   
                         $info= DB::table('form_track')->where('userID',auth()->user()->id)->first(); 
                         $existFile.=$info->logo; 
                               
                        
   
     
                         if(file_exists(public_path('photos/'.basename($existFile)))){
     
                             unlink(public_path('photos/'.basename($existFile)));
                       
                           }
                        
                       
                         //////// move file to upload folder ////////////////
                   $file=request()->file('file');
                 $original_name = strtolower(trim($file->getClientOriginalName()));
                 $fileName =  time().rand(100,999).$original_name;
                 $filePathdb = asset('/photos/'.$fileName);
                 $filePath = 'photos';
                 $file->move($filePath,$fileName);
                     
     
                 //////////////// update database with new information ///////
     
                 DB::table('form_track')->where('userID',auth()->user()->id)->update(['company_name' => request()->input('organisation'), 'title' => request()->input('title'), 'logo' => $filePathdb, 'note' => request()->input('note')]);
               // DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
               
                          
     
                return redirect()->back()->withSuccess('Update succesful.');
                       
                  
               
                   }}
   
   }


public function upload_brand(){

    


      

    $file=request()->file('file');
    $original_name = strtolower(trim($file->getClientOriginalName()));
    $fileName =  time().rand(100,999).$original_name;
    $filePathdb = asset('/photos/'.$fileName);
    $filePath = 'photos';
    $file->move($filePath,$fileName);
        

    //////////////// update database with new information ///////

  $insquery="insert into brand_logo (id,userID,logo) values(NULL,'".auth()->user()->id."','". $filePathdb."')";
     $insert = DB::insert( $insquery);
             
     return redirect()->back()->withSuccess('Thanks for updating you business information');
}


public function update_brand(){

    $file=request()->file('file');
    $original_name = strtolower(trim($file->getClientOriginalName()));
    $fileName =  time().rand(100,999).$original_name;
    $filePathdb = asset('/photos/'.$fileName);
    $filePath = 'photos';
    $file->move($filePath,$fileName);

    if(file_exists(public_path('photos/'.basename(request()->input('oldimage'))))){
 
        unlink(public_path('photos/'.basename(request()->input('oldimage'))));
  
      }
        

    //////////////// update database with new information ///////
    DB::table('brand_logo')->where('userID', auth()->user()->id)
    ->update(['logo' =>$filePathdb]);
    return redirect()->back()->withSuccess('Your image has been changed succesfully');

}

   public function editInterface(){

    //1.validate data
       
    $validator=$this->validate(request(),[
       
       'title'=>'required|string',
       'redirect'=>'required|string',
       'description'=>'required|string',
      
      
       ]);

           if(count(request()->all()) > 0){

              


               if(empty( request()->file('file'))){

                
                     
            DB::table('interface_list')
            ->where('id',request()->input('interfaceid'))
            ->update(['title' => request()->input('title'),'description' => request()->input('description'),'redirect_link'=>request()->input('redirect')]);
            //DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
           
                
               
                   return redirect()->back()->withSuccess('Update succesful.');
               
               }
               else{ 





                     ///// remove the existing file from folder /////////

                     $existFile=""; 

                     $info= DB::table('interface_list')->where('id',request()->input('interfaceid'))->first(); 
                     $existFile.=$info->img; 
                           
                    

 
                     if(file_exists(public_path('photos/'.basename($existFile)))){
 
                         unlink(public_path('photos/'.basename($existFile)));
                   
                       }
                    
                   
                     //////// move file to upload folder ////////////////
               $file=request()->file('file');
             $original_name = strtolower(trim($file->getClientOriginalName()));
             $fileName =  time().rand(100,999).$original_name;
             $filePathdb = asset('/photos/'.$fileName);
             $filePath = 'photos';
             $file->move($filePath,$fileName);
                 
 
             //////////////// update database with new information ///////
 
            // DB::table('form_track')->where('userID',auth()->user()->id)->update(['company_name' => request()->input('organisation'), 'title' => request()->input('title'), 'logo' => $filePathdb, 'note' => request()->input('note')]);
            
             DB::table('interface_list')
            ->where('id',request()->input('interfaceid'))
            ->update(['title' => request()->input('title'),'description' => request()->input('description'),'redirect_link'=>request()->input('redirect'),'img' => $filePathdb]);
          
                      
 
            return redirect()->back()->withSuccess('Update succesful.');
                   
              
           
               }}

}


public function entry_statistic($month,$year,$id){


    $one="";
    $two="";
    $three="";
    $four="";
    $five="";
    $six="";
    $seven="";
    $eight="";
    $nine="";
    $ten="";
    $eleven="";
    $twelve="";
    $thirteen="";
    $fourteen="";
    $fifteen="";
    $sixteen="";
    $seventeen="";
    $eighteen="";
    $nineteen="";
    $twenty="";
    $twentyone="";
    $twentytwo="";
    $twentythree="";
    $twentyfour="";
    $twentyfive="";
    $twentysix="";
    $twentyseven="";
    $twentyeight="";
    $twentynine="";
    $thirty="";
    $thirtyone="";

    $cnt1= DB::table('entry_stat')
    ->where('day','1')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $one=$cnt1->count();

    $cnt2= DB::table('entry_stat')
    ->where('day','2')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $two=$cnt2->count();


    $cnt3= DB::table('entry_stat')
    ->where('day','3')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $three=$cnt3->count();

    $cnt4= DB::table('entry_stat')
    ->where('day','4')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $four=$cnt4->count();

    $cnt5= DB::table('entry_stat')
    ->where('day','5')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $five=$cnt5->count();

    $cnt6= DB::table('entry_stat')
    ->where('day','6')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $six=$cnt6->count();


    $cnt7= DB::table('entry_stat')
    ->where('day','7')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $seven=$cnt7->count();

    $cnt8= DB::table('entry_stat')
    ->where('day','8')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eight=$cnt8->count();

    $cnt9= DB::table('entry_stat')
    ->where('day','9')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $nine=$cnt9->count();


    $cnt10= DB::table('entry_stat')
    ->where('day','10')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $ten=$cnt10->count();

    $cnt11= DB::table('entry_stat')
    ->where('day','11')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eleven=$cnt11->count();

    $cnt12= DB::table('entry_stat')
    ->where('day','12')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twelve=$cnt12->count();

    $cnt13= DB::table('entry_stat')
    ->where('day','13')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirteen=$cnt13->count();

    $cnt14= DB::table('entry_stat')
    ->where('day','14')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $fourteen=$cnt14->count();

    $cnt15= DB::table('entry_stat')
    ->where('day','15')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $fifteen=$cnt15->count();

    $cnt16= DB::table('entry_stat')
    ->where('day','16')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $sixteen=$cnt16->count();

    $cnt17= DB::table('entry_stat')
    ->where('day','17')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $seventeen=$cnt17->count();

    $cnt18= DB::table('entry_stat')
    ->where('day','18')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eighteen=$cnt18->count();


    $cnt19= DB::table('entry_stat')
    ->where('day','19')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $nineteen=$cnt19->count();

    $cnt20= DB::table('entry_stat')
    ->where('day','20')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twenty=$cnt20->count();


    $cnt21= DB::table('entry_stat')
    ->where('day','21')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyone=$cnt21->count();

    $cnt22= DB::table('entry_stat')
    ->where('day','22')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentytwo=$cnt22->count();


    $cnt23= DB::table('entry_stat')
    ->where('day','23')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentythree=$cnt23->count();

    $cnt24= DB::table('entry_stat')
    ->where('day','24')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyfour=$cnt24->count();

    $cnt25= DB::table('entry_stat')
    ->where('day','25')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyfive=$cnt25->count();

    $cnt26= DB::table('entry_stat')
    ->where('day','26')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentysix=$cnt26->count();

    $cnt27= DB::table('entry_stat')
    ->where('day','27')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyseven=$cnt27->count();

    $cnt28= DB::table('entry_stat')
    ->where('day','28')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();

    $twentyeight=$cnt28->count();
    
    $cnt29= DB::table('entry_stat')
    ->where('day','29')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentynine=$cnt29->count();


    $cnt30= DB::table('entry_stat')
    ->where('day','30')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirty=$cnt30->count();


    $cnt31= DB::table('entry_stat')
    ->where('day','31')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirtyone=$cnt31->count();


return $one.','.$two.','.$three.','.$four.','.$five.','.$six.','.$seven.','.$eight.','.$nine.','.$ten.','.$eleven.','.$twelve.','.$thirteen.','.$fourteen.','.$fifteen.','.$sixteen.','.$seventeen.','.$eighteen.','.$nineteen.','.$twenty.','.$twentyone .','.$twentytwo.','.$twentythree.','.$twentyfour.','.$twentyfive.','.$twentysix.','.$twentyseven.','.$twentyeight.','.$twentynine.','.$thirty.','.$thirtyone;
}


public function view_statistic($month,$year,$id){


    $one="";
    $two="";
    $three="";
    $four="";
    $five="";
    $six="";
    $seven="";
    $eight="";
    $nine="";
    $ten="";
    $eleven="";
    $twelve="";
    $thirteen="";
    $fourteen="";
    $fifteen="";
    $sixteen="";
    $seventeen="";
    $eighteen="";
    $nineteen="";
    $twenty="";
    $twentyone="";
    $twentytwo="";
    $twentythree="";
    $twentyfour="";
    $twentyfive="";
    $twentysix="";
    $twentyseven="";
    $twentyeight="";
    $twentynine="";
    $thirty="";
    $thirtyone="";

    $cnt1= DB::table('view_stat')
    ->where('day','1')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $one=$cnt1->count();

    $cnt2= DB::table('view_stat')
    ->where('day','2')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $two=$cnt2->count();


    $cnt3= DB::table('view_stat')
    ->where('day','3')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $three=$cnt3->count();

    $cnt4= DB::table('view_stat')
    ->where('day','4')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $four=$cnt4->count();

    $cnt5= DB::table('view_stat')
    ->where('day','5')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $five=$cnt5->count();

    $cnt6= DB::table('view_stat')
    ->where('day','6')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $six=$cnt6->count();


    $cnt7= DB::table('view_stat')
    ->where('day','7')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $seven=$cnt7->count();

    $cnt8= DB::table('view_stat')
    ->where('day','8')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eight=$cnt8->count();

    $cnt9= DB::table('view_stat')
    ->where('day','9')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $nine=$cnt9->count();


    $cnt10= DB::table('view_stat')
    ->where('day','10')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $ten=$cnt10->count();

    $cnt11= DB::table('view_stat')
    ->where('day','11')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eleven=$cnt11->count();

    $cnt12= DB::table('view_stat')
    ->where('day','12')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twelve=$cnt12->count();

    $cnt13= DB::table('view_stat')
    ->where('day','13')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirteen=$cnt13->count();

    $cnt14= DB::table('view_stat')
    ->where('day','14')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $fourteen=$cnt14->count();

    $cnt15= DB::table('view_stat')
    ->where('day','15')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $fifteen=$cnt15->count();

    $cnt16= DB::table('view_stat')
    ->where('day','16')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $sixteen=$cnt16->count();

    $cnt17= DB::table('view_stat')
    ->where('day','17')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $seventeen=$cnt17->count();

    $cnt18= DB::table('view_stat')
    ->where('day','18')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $eighteen=$cnt18->count();


    $cnt19= DB::table('view_stat')
    ->where('day','19')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $nineteen=$cnt19->count();

    $cnt20= DB::table('view_stat')
    ->where('day','20')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twenty=$cnt20->count();


    $cnt21= DB::table('view_stat')
    ->where('day','21')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyone=$cnt21->count();

    $cnt22= DB::table('view_stat')
    ->where('day','22')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentytwo=$cnt22->count();


    $cnt23= DB::table('view_stat')
    ->where('day','23')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentythree=$cnt23->count();

    $cnt24= DB::table('view_stat')
    ->where('day','24')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyfour=$cnt24->count();

    $cnt25= DB::table('view_stat')
    ->where('day','25')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyfive=$cnt25->count();

    $cnt26= DB::table('view_stat')
    ->where('day','26')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentysix=$cnt26->count();

    $cnt27= DB::table('view_stat')
    ->where('day','27')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentyseven=$cnt27->count();

    $cnt28= DB::table('view_stat')
    ->where('day','28')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();

    $twentyeight=$cnt28->count();
    
    $cnt29= DB::table('view_stat')
    ->where('day','29')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $twentynine=$cnt29->count();


    $cnt30= DB::table('view_stat')
    ->where('day','30')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirty=$cnt30->count();


    $cnt31= DB::table('view_stat')
    ->where('day','31')
    ->where('month',$month)
    ->where('year',$year)
    ->where('interfaceID',$this->encrypt_decrypt($id,false))
    ->get();
    $thirtyone=$cnt31->count();


return $one.','.$two.','.$three.','.$four.','.$five.','.$six.','.$seven.','.$eight.','.$nine.','.$ten.','.$eleven.','.$twelve.','.$thirteen.','.$fourteen.','.$fifteen.','.$sixteen.','.$seventeen.','.$eighteen.','.$nineteen.','.$twenty.','.$twentyone .','.$twentytwo.','.$twentythree.','.$twentyfour.','.$twentyfive.','.$twentysix.','.$twentyseven.','.$twentyeight.','.$twentynine.','.$thirty.','.$thirtyone;
}

public function openstatfilter(){

    $validator=$this->validate(request(),[
        'year'=>'required|string',
        'month'=>'required|string',
        ],
        [
            'year.required'=>'.Please choose year ',
            'month.required'=>'.Please choose month',
            
            
            ]);
            if(count(request()->all()) > 0){

               
            

               $entryStatistic=$this->entry_statistic(request()->input('month'),request()->input('year'),$this->encrypt_decrypt(request()->input('interfaceid'),true));
               $viewStatistic=$this->view_statistic(request()->input('month'),request()->input('year'),$this->encrypt_decrypt(request()->input('interfaceid'),true));

                $monthx=$this->monthNumber(request()->input('month')); //Sep


                $optinx= DB::table('interface_list')->where('id', request()->input('interfaceid'))->first(); 
                $viewx= DB::table('view_stat')->where('interfaceID', request()->input('interfaceid'))->get(); 
                $entryx= DB::table('entry_stat')->where('interfaceID', request()->input('interfaceid'))->get(); 
                return view('users.stat',['tableid'=>request()->input('tableid'),'optin'=>$optinx,'view'=>$viewx,'entry'=>$entryx,'entrystat'=>$entryStatistic,'viewstat'=>$viewStatistic,'months'=>$monthx,'year'=>request()->input('year')]);
            



            }

}


public static function monthNumber($month)
{
    $fullmonth="";
    if($month=='1'){

    $fullmonth="Jan";

    }

    if($month=='2'){

        $fullmonth="Feb";

        }


    if($month=='3'){

            $fullmonth="Mar";
    
            }

    if($month=='4'){

                $fullmonth="Apr";
        
                }

    if($month=='5'){

                    $fullmonth="May";
            
                    }

    if($month=='6'){

                        $fullmonth=="Jun";
                
                        }

     if($month=='7'){

                            $fullmonth="Jul";
                    
                            }

    if($month=='8'){

                                $fullmonth="Aug";
                        
                                }

    if($month=='9'){

                                    $fullmonth="Sep";
                            
                                    }

    if($month=='10'){

                                        $fullmonth="Oct";
                                
                                        }

    if($month=='11'){

                                            $fullmonth="Nov";
                                    
                                            }

    if($month=='12'){

                                                $fullmonth="Dec";
                                        
                                                }

    
    return $fullmonth;


}


public function openstat($id,$id2,$table){


    $entryStatistic=$this->entry_statistic(date('m'),date('Y'),$id);
    $viewStatistic=$this->view_statistic(date('m'),date('Y'),$id);

    $monthx= date("M", strtotime(date('m'))); //Sep


    $optinx= DB::table('interface_list')->where('id', $this->encrypt_decrypt($id,false))->first(); 
    $viewx= DB::table('view_stat')->where('interfaceID', $this->encrypt_decrypt($id,false))->get(); 
    $entryx= DB::table('entry_stat')->where('interfaceID', $this->encrypt_decrypt($id,false))->get(); 
    return view('users.stat',['tableid'=>$table,'optin'=>$optinx,'view'=>$viewx,'entry'=>$entryx,'entrystat'=>$entryStatistic,'viewstat'=>$viewStatistic,'months'=>$monthx,'year'=>date('Y')]);

}


public function landingstat($id,$user){


    $entryStatistic=$this->entry_statistic(date('m'),date('Y'),$id);
    $viewStatistic= DB::table('landing_pages')->where('id', $this->encrypt_decrypt($id,false))->first(); 

    $monthx= date("M", strtotime(date('m'))); //Sep

    $pages= DB::table('landing_pages')->where('id', $this->encrypt_decrypt($id,false))->first(); 

    $viewx= DB::table('land_count')->where('page_id', $this->encrypt_decrypt($id,false))->get(); 
    return view('users.landing_page_stat',['page'=>$pages,'view'=>$viewx,'entry'=>$entryx,'entrystat'=>$entryStatistic,'viewstat'=>$viewStatistic,'months'=>$monthx,'year'=>date('Y')]);

}


public function optin_signup($id,$id2,$user){

    $optinx= DB::table('interface_list')->where('id', $this->encrypt_decrypt($id2,false))->first(); 
    $allfield= DB::table('form_'.$this->encrypt_decrypt($user,false))
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 

    $intList= DB::table('interface_list')
         ->where('id',$this->encrypt_decrypt($id2,false))
         ->first(); 


    $businessx= DB::table('users_info')
         ->where('userID',$this->encrypt_decrypt($user,false))
         ->first();
         
         
         $businessLogox= DB::table('brand_logo')
         ->where('userID',$this->encrypt_decrypt($user,false))
         ->first();

    $insqueryx="update interface_list set no_view = no_view+1 where id='".$this->encrypt_decrypt($id2,false)."'";
    $insertx= DB::insert($insqueryx);

    $list= DB::table('form_styles')->where('table_id', $this->encrypt_decrypt($id,false))->first();

    if(!Auth::check()){

/////////////////////// store view //////////////////////
    $view_stat = new view_stat();
    $view_stat->count=1;
    $view_stat->interfaceID=$this->encrypt_decrypt($id2,false);
    $view_stat->table_id=$this->encrypt_decrypt($id,false);
    $view_stat->day=date('d');
    $view_stat->month=date('m');
    $view_stat->year=date('Y');
    $view_stat->save();

    }
    $vis= DB::table('no_profile_visibility')->where('table_id', $this->encrypt_decrypt($id,false))->get();

    return view('sign_up',['optin'=>$optinx,'fields'=>$allfield,'tableid'=>$id,'userid'=>$user,'style'=>$list,'business'=>$businessx,'businesslogo'=>$businessLogox,'no_visibility'=>$vis,'submsg'=>$this->subMsgformNosession($this->subCheckNosession($this->encrypt_decrypt($user,false)),$this->userpackageNosession($this->encrypt_decrypt($user,false)),$this->packagetypeNosession($this->encrypt_decrypt($user,false)),$this->encrypt_decrypt($user,false)) ]);

}


public static function getbusinessname(){
    $user= DB::table('users_info')->where('userID',auth()->user()->id)->first();
    return  str_replace(' ', '-',strtolower($user->brand_name));


}

public static function getbusinessnamePage($user){
    $user= DB::table('users_info')->where('userID',$user)->first();
    return  str_replace(' ', '-',strtolower($user->brand_name));


}


public static function totalViews($val){
    $views="";
    $views= DB::table('view_stat')->where('table_id',$val)->get()->count();

    return $views;

}


public static function showsubdomain($user){

    $info= DB::table('users_info')->where('userID',$user)->first();

    return $info->subdomain;

}

public static  function totalEntry($val){
    $entry="";
    $entry= DB::table('entry_stat')->where('table_id',$val)->get()->count();

    return $entry;

}


   public function insert_optin($id){

    $redirect="";
    $DesignfilePathdb="";
    $pdffilePathdb="";
    $dodwnloadOption="";
    //1.validate data
       
    $validator=$this->validate(request(),[
       'title'=>'required|string',
       'description'=>'required|string',
       //'redirect'=>'required|string',
       'no_redirect'=>'required|string',
       
      
      
    ],

       [
        'title.required'=>'Please enter title of optin form ',
        'description.required'=>'Please enter description for this opting form',
       // 'redirect.required'=>'Please enter a link to direct visitors to',
        'no_redirect.required'=>'Please indicate wether to redirect visitors or not',
       
          
        
        ]
    
    );

           if(count(request()->all()) > 0){

              if(request()->input('no_redirect')=='yes'){

               

                if(empty(request()->input('redirect'))){

                    return redirect()->back()->withErrors('You did not include the link you want to redirect visitors to in the optin interface you want to create')->withInput();
                   
                }else{

                    $redirect=request()->input('redirect');
                }
                  
              }
     else if(request()->input('no_redirect')=='no'){

                $redirect="";
                  
            }

        if(request()->input('pdfoption')=='yes'){

            $dodwnloadOption='yes';



            $validator=$this->validate(request(),[
                
                'coverDesign'=>'required|mimes:jpeg,JPEG,png',
                'pdfFile' => 'required|mimes:pdf,docx,doc',
               
               
             ]
             
             );


                if(empty(request()->file('coverDesign')) || empty(request()->file('pdfFile'))){

                    return redirect()->back()->withErrors('Please ensure you upload the cover design and the PDF file you want visitors to download')->withInput();
               
                }



                 //////// move pdf cover design file to upload folder ////////////////
             $designfile=request()->file('coverDesign');
             $design_original_name = strtolower(trim($designfile->getClientOriginalName()));
             $DesignfileName =  time().rand(100,999).$design_original_name;
             $DesignfilePathdb= asset('/pdf_cover_designs/'.$DesignfileName);
             $DesignfilePath = 'pdf_cover_designs';
             $designfile->move($DesignfilePath,$DesignfileName);

              //////// move pdf file to upload folder ////////////////
              $pdffile=request()->file('pdfFile');
              $pdf_original_name = strtolower(trim($pdffile->getClientOriginalName()));
              $file_extension = $pdffile->getClientOriginalExtension();
              $PdffileName =  time().rand(100,999).$pdf_original_name;
              $pdffilePathdb= asset('/pdf_files/'.$PdffileName);
              $pdffilePath = 'pdf_files';
              $pdffile->move($pdffilePath,str_replace(' ','-',strtolower(request()->input('title').'.'.$file_extension)));

             





            }


            if(request()->input('pdfoption')=='no'){

                $dodwnloadOption='no';
            
            
            }

            $optins= DB::table('interface_list')->where('userID',auth()->user()->id)->get(); 


if($this->subCheck()!=2){
            if($optins->count()<2 && $this->userpackage()=='free' || $optins->count()<10 && $this->userpackage()=='essential'|| $this->userpackage()=='pro'){


            

                     //////// move file to upload folder ////////////////
             $file=request()->file('file');
             $original_name = strtolower(trim($file->getClientOriginalName()));
             $fileName =  time().rand(100,999).$original_name;
             $filePathdb = asset('/photos/'.$fileName);
             $filePath = 'photos';
             $file->move($filePath,$fileName);

            
                 
 
             //////////////// update database with new information ///////
 
             //DB::table('form_track')->where('userID',auth()->user()->id)->update(['company_name' => request()->input('organisation'), 'title' => request()->input('title'), 'logo' => $filePathdb, 'note' => request()->input('note')]);
           // DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
           $counttable= DB::table('interface_list')
           ->where('userID', auth()->user()->id)
           ->where('table_id',$id)
           ->get(); 


if($counttable->count()<1){
    $newinterface="optin 1";
    
           $interface = new interface_list();
           $interface->interface_name=$newinterface;
           $interface->userID=auth()->user()->id;
           $interface->title=request()->input('title');
           $interface->description=request()->input('description');
           $interface->redirect_link= $redirect;
           $interface->img=$filePathdb;
           $interface->no_view='0';
           $interface->no_entry='0';
           $interface->downloads=$dodwnloadOption;
           $interface->table_id=$id;
           $interface->save();

           if(request()->input('pdfoption')=='yes'){

           $downloads = new visitor_download_files();
           $downloads->interfaceID=$interface->id;
           $downloads->pdf_title=request()->input('title');
           $downloads->pdf_cover=$DesignfilePathdb;
           $downloads->pdf_filename= $pdffilePathdb;
           $downloads->post_date=date('m-d-Y');
           $downloads->downloads=0;
           $downloads->save();

           }

           return redirect()->back()->withSuccess('Optin Interface created succesful.');
}
else if($counttable->count()>0){

    $joint=$counttable->count()+1;
    $newinterface= 'Optin '.$joint; 
    
    $interface = new interface_list();
    $interface->interface_name=$newinterface;
    $interface->userID=auth()->user()->id;
    $interface->title=request()->input('title');
    $interface->description=request()->input('description');
    $interface->redirect_link= $redirect;
    $interface->img=$filePathdb;
    $interface->no_view='0';
    $interface->no_entry='0';
    $interface->downloads=$dodwnloadOption;
    $interface->table_id=$id;
    $interface->save();

    if(request()->input('pdfoption')=='yes'){

    $downloads = new visitor_download_files();
    $downloads->interfaceID=$interface->id;
    $downloads->pdf_title=request()->input('title');
    $downloads->pdf_cover=$DesignfilePathdb;
    $downloads->pdf_filename= $pdffilePathdb;
    $downloads->post_date=date('m-d-Y');
    $downloads->downloads=0;
    $downloads->save();
    }

 
            return redirect()->back()->withSuccess('Optin Interface created succesful.');
                   
              
}

           }else if($this->userpackage()=='expired'){

            return redirect()->back()->withErrors('Sorry your subscription has expired')->withInput();
     

        }

        else{

            return redirect()->back()->withErrors('You have reached the limit of the number of optin form you can create in your subscribed plan.')->withInput();
     

        }

    }else{

        return redirect()->back()->withErrors('Sorry! your subscription for the '.$this->userpackage().' package has expired')->withInput();
    
    }
               }
            

}

    public function removefield($id,$table){

        $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
        $replacement=array(' ');// you can enter more replacements.


        $others= DB::table("form_".auth()->user()->id)->where('id',$id)->where('table_name',$this->get_table_name($table))->first(); 


////////////// also remove column from store table
    $querystore="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name($table)." DROP ".str_replace($symbols,$replacement,$others->fields);
    $insertstore = DB::insert($querystore);

if($others->type=='radio' || $others->type=='checkbox'){
    
    $deletequery1="delete from options  where user_table='form_".auth()->user()->id."' and fieldname='".$others->fields."' and type='".$others->type."' " ;	
    $insertdelete = DB::insert( $deletequery1);


    }
    

    /////// delete field from table ///////////////////////////
    

    $insquery="delete from form_".auth()->user()->id." where id='".$id."'";
    $insert = DB::insert( $insquery);


    return redirect()->back();

    }


    public function removefield2($id,$table){

        $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
        $replacement=array(' ');// you can enter more replacements.


        $others= DB::table("form_".auth()->user()->id)->where('id',$id)->where('table_name',$this->get_table_name($table))->first(); 


////////////// also remove column from store table
    $querystore="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name($table)." DROP ".str_replace($symbols,$replacement,$others->fields);
    $insertstore = DB::insert($querystore);

if($others->type=='radio' || $others->type=='checkbox'){
    
    $deletequery1="delete from options  where user_table='form_".auth()->user()->id."' and fieldname='".$others->fields."' and type='".$others->type."' " ;	
    $insertdelete = DB::insert( $deletequery1);


    }
    

    /////// delete field from table ///////////////////////////
    

    $insquery="delete from form_".auth()->user()->id." where id='".$id."'";
    $insert = DB::insert( $insquery);


    $fdata= DB::table("form_".auth()->user()->id)
    ->where('table_name', $this->get_table_name($table))
    ->orderBy('id','asc')
    ->get(); 
    //return redirect()->route('formstp2', ['fields'=>$fdata]);
    
    return redirect('/users/create_form_stp2/'.$this->encrypt_decrypt($table,true))->with('fields',$fdata)->with('tableid',$table);

    }

    public function deleteinterface($id){

        $insquery="delete from interface_list where id='".$id."'";
        $insert = DB::insert( $insquery);
    
        return redirect()->back()->withSuccess('Optin interface deleted succesfully.');
    }


    public function deletefrm($id){

        

        $insquery="delete from landing_pages where id='".$id."'";
         DB::insert($insquery);


        $pdiv="delete from page_div where page_id='".$id."'";
        DB::insert( $pdiv);

        $pdiv2="delete from content_type where page_id='".$id."'";
        DB::insert($pdiv2);

        
           
    
        return redirect()->back()->withSuccess('Landing page deleted succesfully.');


    }


    public function deletepagerow($id){

        $insquery="delete from page_div where id='".$id."'";
        $insert = DB::insert( $insquery);
        $imgcount= DB::table('content_type')->where('div_id', $id)->get();
        if($imgcount->count()>0){
        $img= DB::table('content_type')->where('div_id', $id)->first();
        if($img->type=='image'){

            if(file_exists(public_path('page_photos/'.$img->source))){

                unlink(public_path('page_photos/'.$img->source));
          
              }
            }

           
        }


        $insquerycon="delete from content_type where div_id='".$id."'";
        $insertcon = DB::insert($insquerycon);
        return redirect()->back()->withSuccess('You have deleted a row succesfully from this landing page');
    }


    public function form_info(){

        $brandx= DB::table('users_info')->where('userID', auth()->user()->id)->first(); 
        return view('users.form_info',['brand'=> $brandx]);

    }

    public function showerror($val,$val2){
        $brandx= DB::table('users_info')->where('userID',$val2)->first(); 
        return view('error_page',['userid'=>$val2,'brandx'=>$brandx->subdomain]);

    }



    




    public function store_form_info()    
{
    $validator=$this->validate(request(),[
        'organisation'=>'required|string',
        'title'=>'required|string',
        'note'=>'required|string',
        'niche'=>'required|string',
        'imgfile'=>'required|mimes:jpeg,JPEG,png',
      
       
        
        
        ],
        [
            'organisation.required'=>'Type in the name of your organisation ',
            'title.required'=>'Enter the title of form ',
            'note.required'=>'Enter a brief description of your title ',
            'niche.required'=>'Enter the niche of this form ',
            'imgfile.required'=>'Upload image for this form',
               
            ]);

            if(count(request()->all()) > 0){
     
        $imgfile= request()->file('imgfile');
        $original_filename = strtolower(trim($imgfile->getClientOriginalName()));
        $fileName =  time().rand(100,999).$original_filename;
        $filePath = 'photos';
        $filePathdb = asset('/photos/'.$fileName);
        $imgfile->move($filePath,$fileName);

        $upinfo=DB::table('form_track')->where('userID',auth()->user()->id)->where('title','')->where('form','form_'.auth()->user()->id)->update(['title' =>request()->input('title'), 'logo' => $filePathdb,'company_name' =>request()->input('organisation'),'note' =>request()->input('note'),'niche' =>request()->input('niche')]);
    
        //$insquery="insert into sms_for_phone (id,sms,form,userID,senderID) values(NULL,'".request()->input('sms')."','form_".auth()->user()->id."','".auth()->user()->id."','".request()->input('senderid')."')";
        //$insert = DB::insert( $insquery);


        return redirect()->route('collectinfo');
        //return redirect()->back()->withSuccess('form created succesfully. Click <\B>Collect information<\/B> on the navigational bar at the left');

}

}

    public function processstate(Request $request){
        

        $output="";
        $states= DB::table('lgas')->where('states_id',$request->id)->get(); 
       
        $output.='<br/>';
        
        foreach($states as $row){
            
        
        $output.='<option>'.$row->lga_name.'</option>';
            
            
            
        }
        
        echo  $output;


    }


    


    public function pullfieldname(Request $request){
        

        
        $fieldname= DB::table('form_'.auth()->user()->id)->where('id',$request->fieldId)->first(); 
       
       
        echo  str_replace('_', ' ',$fieldname->fields); 


    }


    public function pullnichename(Request $request){
        

        
        $fieldname= DB::table('form_track')->where('table_id',$request->tableId)->first(); 
       
       
        echo  $fieldname->niche;


    }


    public function processoptiontemprary(Request $request){

        $output="";

        $insquery="insert into options_temprary  (id,user_table,form_serial,fieldname,user_id,option_item,type ) values(NULL,'form_".auth()->user()->id."','".$request->_token."','".$request->fieldname."','".auth()->user()->id."','".$request->optionValue."','".$request->option_type."')";
        $insert = DB::insert($insquery);

        $options= DB::table('options_temprary')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('form_serial',$request->_token)
        ->where('fieldname',$request->fieldname)
        ->where('type',$request->option_type)
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteOptions('.$row->id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }

    public function processoption(Request $request){

        $output="";

        $insquery="insert into options (option_id,user_table,table_id,fieldname,userid,option_item,type )values(NULL,'form_".auth()->user()->id."','".$request->tableid."','".$request->title."','".auth()->user()->id."','".$request->optionValue."','".$request->option_type."')";
        $insert = DB::insert($insquery);

        $options= DB::table('options')
        ->where('user_table','form_'.auth()->user()->id)
        ->where('table_id',$request->tableid)
        ->where('fieldname',$request->title)
        ->where('type',$request->option_type)
        ->orderBy('option_id','desc')
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteOptions('.$row->option_id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }


    public function displayprocessoption(Request $request){

        $output="";

        
        $options= DB::table('options')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('table_id', $request->tableid)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->get();

        foreach($options as $row){

            $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
            $output.='<tr>';
             
            $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteOptions('.$row->option_id.')"><b>x</b></a></td>';
             
            $output.='</tr>';
             
             
            $output.='</table>';
 
         }


           return $output;

    }




    public function processmenuoption(Request $request){

        $output="";

        $insquery="insert into menuoptions  (menuid,user_table,fieldname,userid,option_item,type ) values(NULL,'form_".auth()->user()->id."','".$request->title."','".auth()->user()->id."','".$request->optionMenuValue."','".$request->option_type."')";
        $insert = DB::insert($insquery);

        $options= DB::table('menuoptions')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteMenuOptions('.$row->menuid.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }


    public function processmenuoptiontemprary(Request $request){

        $output="";

        $insquery="insert into temprary_menu_options  (id,user_table,form_serial,fieldname,user_id,option_item,type )
         values(NULL,'form_".auth()->user()->id."','".$request->_token."','".$request->fieldname."','".auth()->user()->id."','".$request->optionMenuValue."','".$request->option_type."')";
        $insert = DB::insert($insquery);

        $options= DB::table('temprary_menu_options')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->fieldname)
        ->where('form_serial', $request->_token)
        ->orderBy('id','desc')
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteMenuOptions('.$row->id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }


    public function displayprocessmenuoption(Request $request){

        $output="";
        $options= DB::table('menuoptions')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteMenuOptions('.$row->menuid.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }



    public function deletemenuoption(Request $request){

        $output="";

        $insquery="delete from menuoptions where menuid='". $request->menuid."' ";
        $insert = DB::insert($insquery);

        $options= DB::table('menuoptions')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->get();

        foreach($options as $row){

            $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
            $output.='<tr>';
             
            $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteMenuOptions('.$row->menuid.')"><b>x</b></a></td>';
             
            $output.='</tr>';
             
             
            $output.='</table>';
 
         }


           return $output;

    }


    public function deleteoption(Request $request){

        $output="";

        $insquery="delete from options where option_id='". $request->optionid."' ";
        $insert = DB::insert($insquery);

        $options= DB::table('options')
        ->where('table_id',$request->tableid)
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->orderBy('option_id','desc')
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteOptions('.$row->option_id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }


    public function deleteoptiontemprary(Request $request){

        $output="";

        $insquery="delete from options_temprary where id='".$request->optionid."' ";
        $insert = DB::insert($insquery);

        $options= DB::table('options_temprary')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('form_serial', $request->_token)
        ->where('fieldname', $request->title)
        ->where('type', $request->option_type)
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteOptions('.$row->id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }





    public function deleteMenuoptiontemprary(Request $request){

        $output="";

        $insquery="delete from temprary_menu_options where id='".$request->menuid."' ";
        $insert = DB::insert($insquery);

        $options= DB::table('temprary_menu_options')
        ->where('user_table', 'form_'.auth()->user()->id)
        ->where('fieldname', $request->title)
        ->where('form_serial', $request->_token)
        ->orderBy('id','desc')
        ->get();

        foreach($options as $row){

           $output.='<table style="width:100%;padding:20px;background:#F0F0F0;paddding-bottom:10px;margin-top:10px"  >';
           $output.='<tr>';
            
           $output.='<td style="padding:10px">'.$row->option_item.'</td><td style="float:right;padding:10px"><a href="javascript:void(0);" onClick="deleteMenuOptions('.$row->id.')"><b>x</b></a></td>';
            
           $output.='</tr>';
            
            
           $output.='</table>';

        }


           return $output;

    }




    public function newfield($id){

        // $idsx= DB::table('senderids')->where('userID',auth()->user()->id)->get(); 
        return view('users.add_new_field',['tableid'=> $id]);
    }

    public static function selectedField($field,$tableid){
		$output="";

        $tablename= DB::table('table_list')
    ->where('id', $tableid)
    ->first();

    $fieldchk= DB::table("form_".auth()->user()->id)
    ->where('fields', $field)
    ->where('table_name', $tablename->tablename)
    ->get();
    
		if($fieldchk->count()<1){
			$output.=0;
		}
		else if($fieldchk->count()>0){
			
			$output.=1;
		}
		
		return $output;
	} 



    



    public function addfield($id)
    {
        
        $tablename='form_'.auth()->user()->id;
        $tablename2='form_'.auth()->user()->id.'_store';
   
       

       if(isset($_POST['fields'])){ 
            

        $input =request()->all();  
        $condition = $input['fields'];
        foreach ($condition as $key => $condition) {

            if(UserController::selectedField($input['fields'][$key],request()->input('table'))!=1){

          

            if($input['fields'][$key]=='state' || $input['fields'][$key]=='country' || $input['fields'][$key]=='lga'){
		
                $fieldchk= DB::table($tablename)->where('fields', $input['fields'][$key])
                ->get();
                if($fieldchk->count()<1){
                 $insquery="insert into ".$tablename." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$this->get_table_name(request()->input('table'))."',0,'yes','".$input['fields'][$key]."','','menu')";
                 $insert = DB::insert( $insquery);
              
                }
                    }else{

                        $fieldchk= DB::table($tablename)
                        ->where('table_name',$this->get_table_name(request()->input('table')))
                        ->where('fields', $input['fields'][$key])
                        ->get();
                        if($fieldchk->count()<1){
                        
                        $insquery="insert into ".$tablename." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$this->get_table_name(request()->input('table'))."',0,'yes','".$input['fields'][$key]."','','text')";
                        $insert = DB::insert( $insquery);
                        }
                        
                    }	

                   

                   


            }



            if (Schema::hasTable($tablename2."_".$this->get_table_name(request()->input('table')))){


                if (!Schema::hasColumn($tablename2."_".$this->get_table_name(request()->input('table')),str_replace(' ', '',$input['fields'][$key]))) {
                    $fcquery2='ALTER TABLE '.$tablename2."_".$this->get_table_name(request()->input('table')).' ADD '.str_replace(' ', '',$input['fields'][$key]).' VARCHAR( 200 ) NOT NULL AFTER id ';
                    $insert = DB::insert($fcquery2); 
                      } 
                   

                
         
        }  


    }

   

    $fdata= DB::table($tablename)
    ->where('table_name',$this->get_table_name(request()->input('table')))
    ->orderBy('id','asc')
    ->get(); 
    //return redirect()->route('formedit', ['fields'=>$fdata]);
    
    return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>request()->input('table')]);


}else{

        return redirect()->back()->withErrors('You have not checked any field to add to form')->withInput();
     

    }

    }

   

    public function addfieldedit()
    {
        
        $tablename='form_'.auth()->user()->id;
        $tablename2='form_'.auth()->user()->id.'_store';
   
       

       if(isset($_POST['fields'])){ 
            

        $input =request()->all();  
        $condition = $input['fields'];
        foreach ($condition as $key => $condition) {

            if(UserController::selectedField($input['fields'][$key],request()->input('table'))!=1){

          

            if($input['fields'][$key]=='state' || $input['fields'][$key]=='country' || $input['fields'][$key]=='lga'){
		
                $fieldchk= DB::table($tablename)->where('fields', $input['fields'][$key])
                ->get();
                if($fieldchk->count()<1){
                 $insquery="insert into ".$tablename." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$this->get_table_name(request()->input('table'))."',0,'yes','".$input['fields'][$key]."','','menu')";
                 $insert = DB::insert( $insquery);
              
                }
                    }else{

                        $fieldchk= DB::table($tablename)
                        ->where('table_name',$this->get_table_name(request()->input('table')))
                        ->where('fields', $input['fields'][$key])
                        ->get();
                        if($fieldchk->count()<1){
                            
                    
                            if($input['fields'][$key]=='email'){

                                $insquery="insert into ".$tablename." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$this->get_table_name(request()->input('table'))."',0,'yes','".$input['fields'][$key]."','','email')";
                                $insert = DB::insert( $insquery);
                               
                            }else{
                        $insquery="insert into ".$tablename." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$this->get_table_name(request()->input('table'))."',0,'yes','".$input['fields'][$key]."','','text')";
                        $insert = DB::insert( $insquery);
                            }

                        }
                        
                    }	

                   

                   


            }



            if (Schema::hasTable($tablename2."_".$this->get_table_name(request()->input('table')))){


                if (!Schema::hasColumn($tablename2."_".$this->get_table_name(request()->input('table')),str_replace(' ', '',$input['fields'][$key]))) {
                    $fcquery2='ALTER TABLE '.$tablename2."_".$this->get_table_name(request()->input('table')).' ADD '.str_replace(' ', '',$input['fields'][$key]).' VARCHAR( 200 ) NOT NULL AFTER id ';
                    $insert = DB::insert($fcquery2); 
                      } 
                   

                
         
        }  


    }

   

    $fdata= DB::table($tablename)
    ->where('table_name',$this->get_table_name(request()->input('table')))
    ->orderBy('id','asc')
    ->get(); 
    //return redirect()->route('formedit', ['fields'=>$fdata]);
    
    return view('users.create_form_edit',['fields'=>$fdata,'tableid'=>request()->input('table')]);


}else{

        return redirect()->back()->withErrors('You have not checked any field to add to form')->withInput();
     

    }

    }



    


    public function updatefielddetail(){

        $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`','))',);
        $replacement=array('');// you can enter more replacements.

        $alteredColumn="";


        $validator=$this->validate(request(),[

            'fieldname'=>'required|string',
            'option'=>'required|string',
            'required_option'=>'required|string',
         
            ],
            [
                'fieldname.required'=>'Please type in the question you want to create in form ',
                'option.required'=>'Please choose the kind of answer you want to create',
                'required_option.required'=>'Please thick wether answer to this question is required or optional',
               
                  
                
                ]);
    
                if(count(request()->all()) > 0){
    
               $oldcolumn= DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))->first();
               $alteredColumn= $oldcolumn->fields;
        
            ///////////////////////////////////// create table ///////////////////////////////////////////////////////
            $insquery='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.' (
            id INT AUTO_INCREMENT,fields VARCHAR(255),description VARCHAR(300) NULL,fieldord VARCHAR(255) NOT NULL,required_type VARCHAR(255) NOT NULL,type VARCHAR(255) NOT NULL, PRIMARY KEY (id))  ENGINE=INNODB';
            $insert = DB::insert( $insquery);
            
            
            
            ///////////////////////////////////// create table ///////////////////////////////////////////////////////
            $fcquery1='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.'_store (
            id INT AUTO_INCREMENT,enter_date VARCHAR(255) NOT NULL ,PRIMARY KEY (id))  ENGINE=INNODB';
            $insert = DB::insert($fcquery1);
            
    
            $formChk= DB::table('form_track')->where('table_id',request()->input('table'))->where('form', "form_".auth()->user()->id)->get();
           // $queryfm= "select * from form_track where form='form_".$_SESSION['ID']."' ";
           // $resultfm=$connect->retrieve($queryfm);
            $numfm= $formChk->count();
            if($numfm<1){
    
    
                $form_track = new form_track();
                $form_track ->table_id=request()->input('table');
                $form_track ->form='form_'.auth()->user()->id;
                $form_track ->userID=auth()->user()->id;
                $form_track ->title='';
                $form_track ->logo='';
                $form_track ->company_name='';
                $form_track ->note='';
                $form_track ->save();
    
    
           // $insquerytrack="insert into form_track (track_id,form,userID,title,logo,company_name,note,date_created ) values(NULL,'form_".auth()->user()->id."','".auth()->user()->id."','','','','','".date('d-M-Y')."')";
           // $insert = DB::insert($insquerytrack);
    
            }
    
            $options= DB::table('options')
            ->where('user_table', "form_".auth()->user()->id)
            ->where('fieldname', request()->input('fieldname'))
            ->where('type', request()->input('option'))
            ->get();
    
            //$query="SELECT * FROM options where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
            //$result=$connect->retrieve($query);
            $num=$options->count();
    
           $menuoptions= DB::table('menuoptions')
           ->where('user_table', "form_".auth()->user()->id)
           ->where('fieldname', request()->input('fieldname'))
           ->where('type', request()->input('option'))
           ->get();
            
           // $query="SELECT * FROM menuoptions where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
           // $result=$connect->retrieve($query);
            $num2= $menuoptions->count();
            
            if(!empty( request()->input('fieldname')) && !empty(request()->input('option'))){
                
                if(request()->input('option')=='radio' || request()->input('option')=='checkbox'  ){
                if($num<1){

                        // return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered.')->withInput();


                       // DB::table('options')
                         //   ->where('fieldname', request()->input('oldfieldname'))
                          //  ->where('user_table', 'form_' . auth()->user()->id)
                           // ->where('userid', auth()->user()->id)
                           // ->update([

                            //    'fieldname' => request()->input('fieldname'),

                           // ]);

               $insqueryx="update options set fieldname='".str_replace('_', ' ',request()->input('fieldname'))."' where fieldname='".str_replace('_', ' ',request()->input('oldfieldname'))."' and  user_table ='form_".auth()->user()->id."' and userid='".auth()->user()->id."' and type='".request()->input('option')."'";
               DB::insert($insqueryx);
             
                   
        
        
        if(request()->input('option')=='textfield'){
                    
            // $insqueryx="insert into form_".auth()->user()->id." (id,fieldord,required_type,fields,description,type) values(NULL,0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
            // $insertx= DB::insert($insqueryx);

             DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
             ->update([
                 
                 'required_type' =>request()->input('required_option'),
                 'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                 'description' =>request()->input('description'),
                 'type' =>request()->input('input_type'),
         ]);
     
         }else{
             
        // $insqueryx="insert into form_".auth()->user()->id." (id,fieldord,required_type,fields,description,type) values(NULL,0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
        // $insertx= DB::insert($insqueryx);
       



         DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
         ->update([
             
             'required_type' =>request()->input('required_option'),
             'fields' =>str_replace(' ', '_',request()->input('fieldname')),
             'description' =>request()->input('description'),
             'type' =>request()->input('option'),
     ]);


         
         }
         //ALTER TABLE form_".auth()->user()->id."_store ADD ".$alteredColumn." TO ".str_replace(' ', '_',request()->input('fieldname')).";   
     
  //   $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store ADD ".str_replace(' ', '_',request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
  //$fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ". $alteredColumn." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
  //$insert1x= DB::insert($fcquery1x);


  $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
  $insert1x= DB::insert($fcquery1x);
     
  return redirect()->back()->withSuccess(' update successful.');     
        
      
               
               
               
                }
                
                
                else{
                    
                    
                    //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
                   // $resultfmt=$connect->retrieve($queryfmt);
                   // $numfmt=$connect->numRows($resultfmt);
    
                   
        
        
        if(request()->input('option')=='textfield'){
                    
                   // $insqueryx="insert into form_".auth()->user()->id." (id,fieldord,required_type,fields,description,type) values(NULL,0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                   // $insertx= DB::insert($insqueryx);

                    DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
                    ->update([
                        
                        'required_type' =>request()->input('required_option'),
                        'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                        'description' =>request()->input('description'),
                        'type' =>request()->input('input_type'),
                ]);
            
                }else{
                    
               // $insqueryx="insert into form_".auth()->user()->id." (id,fieldord,required_type,fields,description,type) values(NULL,0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
               // $insertx= DB::insert($insqueryx);
              



                DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
                ->update([
                    
                    'required_type' =>request()->input('required_option'),
                    'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                    'description' =>request()->input('description'),
                    'type' =>request()->input('option'),
            ]);


                
                }
                //ALTER TABLE form_".auth()->user()->id."_store ADD ".$alteredColumn." TO ".str_replace(' ', '_',request()->input('fieldname')).";   
           
         //   $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store ADD ".str_replace(' ', '_',request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        // $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ". $alteredColumn." ".$changeColumn." varchar(255)";
        // $insert1x= DB::insert($fcquery1x);

         $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
         $insert1x= DB::insert($fcquery1x);
            
         return redirect()->back()->withSuccess('update successful.');     
               
                    
                    
                }	
                    
                }
                else if(request()->input('option')=='textfield' && empty(request()->input('input_type')) ){
                    
                    
                    return redirect()->back()->withErrors('Select input type for textfield')->withInput();
             
                    
                    
                    
                }
                
                else if(request()->input('option')=='selectMenu'){
                    
                    
                if($num2<1){

                    if(request()->input('oldoption')=='radio' || request()->input('oldoption')=='checkbox' ){

                        $options= DB::table('options')
                        ->where('user_table', "form_".auth()->user()->id)
                        ->where('fieldname', request()->input('fieldname'))
                        ->where('userid',auth()->user()->id)
                        ->where('type',request()->input('oldoption'))
                        ->get();

                        foreach($options as  $option){

                     $insquerya="insert into menuoptions (user_table,fieldname,userid,option_item,type ) 
                     values('form_'".auth()->user()->id."','".request()->input('fieldname')."','".auth()->user()->id."','".$option->option_item."','selectMenu')";
                    DB::insert($insquerya);

                        }

                    DB::table('options') 
                    ->where('user_table', "form_".auth()->user()->id)
                    ->where('fieldname', request()->input('fieldname'))
                    ->where('userid',auth()->user()->id)
                    ->where('type',request()->input('oldoption'))
                    ->delete();


                    }

                   
    
                   
        if(request()->input('option')=='textfield'){
                    
            //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
            //$connect->insertion($insquery);

            DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
            ->update([
                
                'required_type' =>request()->input('required_option'),
                'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                'description' =>request()->input('description'),
                'type' =>request()->input('input_type'),
        ]);
    
        }else{

            DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
            ->update([
                
                'required_type' =>request()->input('required_option'),
                'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                'description' =>request()->input('description'),
                'type' =>request()->input('option'),
        ]);
            
       // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
   // $connect->insertion($insquery);
        
        }

    
    //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
    //$connect->insertion($fcquery1);
    $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
    $insert1x= DB::insert($fcquery1x);

    //$fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".$alteredColumn." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
    //$insert1x= DB::insert($fcquery1x);
    
    return redirect()->back()->withSuccess(' update successful.');  	
                    
                }
        else{
            
            
                   // $queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
                   // $resultfmt=$connect->retrieve($queryfmt);
                   // $numfmt=$connect->numRows($resultfmt);
    
                  
        
        
        if(request()->input('option')=='textfield'){
                    
                    //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
                    //$connect->insertion($insquery);
    
                    DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
                    ->update([
                        
                        'required_type' =>request()->input('required_option'),
                        'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                        'description' =>request()->input('description'),
                        'type' =>request()->input('input_type'),
                ]);
            
                }else{
    
                    DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
                    ->update([
                        
                        'required_type' =>request()->input('required_option'),
                        'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                        'description' =>request()->input('description'),
                        'type' =>request()->input('option'),
                ]);
                    
               // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
           // $connect->insertion($insquery);
                
                }
        
            
            //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
            //$connect->insertion($fcquery1);
    
            $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
            $insert1x= DB::insert($fcquery1x);
            
           // $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ". $alteredColumn." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
           // $insert1x= DB::insert($fcquery1x);
            
            return redirect()->back()->withSuccess(' update successful.');  
    
           // header('location:custom_field_create?status=created');
           
                }		
                    
                    
                }
                
                
                else{
                    
                    
                 //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
                  //  $resultfmt=$connect->retrieve($queryfmt);
                  //  $numfmt=$connect->numRows($resultfmt);
    
                   	
                    
                if(request()->input('option')=='textfield'){
    
                    DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
                    ->update([
                        
                        'required_type' =>request()->input('required_option'),
                        'fields' =>str_replace(' ', '_',request()->input('fieldname')),
                        'description' =>request()->input('description'),
                        'type' =>request()->input('input_type'),
                ]);
            
                    
                  //  $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
           // $connect->insertion($insquery);
            
                }else{
                    
                //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
           // $connect->insertion($insquery);
    
           DB::table('form_'.auth()->user()->id)->where('id', request()->input('id'))
           ->update([
               
               'required_type' =>request()->input('required_option'),
               'fields' =>str_replace(' ', '_',request()->input('fieldname')),
               'description' =>request()->input('description'),
               'type' =>request()->input('option'),
       ]);
    
                
                }
            
            if($_POST['option']=='textarea'){
                $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
                $insert1x= DB::insert($fcquery1x);
            }
            else{
                
                $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$this->get_table_name(request()->input('table'))." CHANGE ".str_replace($symbols,$replacement,$alteredColumn)." ".str_replace($symbols,$replacement,request()->input('fieldname'))." varchar(255)";
                $insert1x= DB::insert($fcquery1x);
            }
    
    
            if($_POST['option']=='image'||$_POST['option']=='imagelive'){
    
                $folder = public_path('/photos_'.auth()->user()->id. '/');
    
    
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
    
    
                 }
    
                 if($_POST['option']=='file'){
    
                    $folder = public_path('/documents_'.auth()->user()->id. '/');
        
        
                    if (! File::exists($folder)) {
                        File::makeDirectory($folder);
                    }
        
        
                     }
            
                     return redirect()->back()->withSuccess(' update successful.');  
           
                
           	}	
            
                
                
            }
            
            
            
            
        
        
        }
        
    
    }





public function savecustomfield(){

    

    $validator=$this->validate(request(),[
        'fieldname'=>'required|string',
        'option'=>'required|string',
        'required_option'=>'required|string',
     
        ],
        [
            'fieldname.required'=>'Please type in the question you want to create in form ',
            'option.required'=>'Please choose the kind of answer you want to create',
            'required_option.required'=>'Please thick wether answer to this question is required or optional',
           
              
            
            ]);

            if(count(request()->all()) > 0){


        $newtable="";
        $tableID="";

        $counttable= DB::table('table_list')->where('userID', auth()->user()->id)->get(); 
       if($counttable->count()<1){

    $newtable="table1";

    $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();

    //$insquery="insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','".auth()->user()->id."')";
    //$insert = DB::insert( $insquery);
    $tableID=$table_list->id;

}
else if($counttable->count()>0){

            $joint=$counttable->count()+1;
            $newtable= 'table'.$joint;

            $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();
    $tableID=$table_list->id;

            //$insquery = "insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','" . auth()->user()->id . "')";
            //$insert = DB::insert($insquery);

}

	
	
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $insquery='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.' (
        id INT AUTO_INCREMENT,table_name VARCHAR(255),fields VARCHAR(255),description VARCHAR(300),fieldord VARCHAR(255) NOT NULL,required_type VARCHAR(255) NOT NULL,type VARCHAR(255) NOT NULL, PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert( $insquery);
        
        
        
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $fcquery1='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.'_store_'.$newtable.' (
        id INT AUTO_INCREMENT,enter_date VARCHAR(255) NOT NULL ,PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert($fcquery1);
        

        $formChk= DB::table('form_track')->where('table_id',$tableID)->where('form', "form_".auth()->user()->id)->get();
       // $queryfm= "select * from form_track where form='form_".$_SESSION['ID']."' ";
       // $resultfm=$connect->retrieve($queryfm);
        $numfm= $formChk->count();
        if($numfm<1){


            $form_track = new form_track();
            $form_track ->table_id=$tableID;
            $form_track ->form='form_'.auth()->user()->id;
            $form_track ->userID=auth()->user()->id;
            $form_track ->title='';
            $form_track ->logo='';
            $form_track ->niche='';
            $form_track ->company_name='';
            $form_track ->note='';
            $form_track ->save();


       // $insquerytrack="insert into form_track (track_id,form,userID,title,logo,company_name,note,date_created ) values(NULL,'form_".auth()->user()->id."','".auth()->user()->id."','','','','','".date('d-M-Y')."')";
       // $insert = DB::insert($insquerytrack);

        }

        $options= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        //$query="SELECT * FROM options where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
        //$result=$connect->retrieve($query);
        $num=$options->count();

       $menuoptions= DB::table('temprary_menu_options')
       ->where('user_table', "form_".auth()->user()->id)
       ->where('form_serial', request()->input('_token'))
       ->get();
        
       // $query="SELECT * FROM menuoptions where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
       // $result=$connect->retrieve($query);
        $num2= $menuoptions->count();
        
        if(!empty( request()->input('fieldname')) && !empty(request()->input('option'))){
            
            if(request()->input('option')=='radio' || request()->input('option')=='checkbox'  ){
            if($num<1){
                
                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered.')->withInput();
            
            }
            
            
            else{
                
                
                //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
                
            if($numfmt<1){
    
    
    if(request()->input('option')=='textfield'){
                
                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{
                
            $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
            
            }
    
            
        
        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace(' ', '_',request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into options (option_id,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('options_temprary')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();
        
        return redirect()->route('donefield');         
            }else{
                
                
                 return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
         
                
                
            }
                
                
            }	
                
            }
            else if(request()->input('option')=='textfield' && empty(request()->input('input_type')) ){
                
                
                return redirect()->back()->withErrors('Select input type for textfield')->withInput();
         
                
                
                
            }
            
            else if(request()->input('option')=='selectMenu'){
                
                
            if($num2<1){

                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered')->withInput();
         
                
                //header('location:custom_field_create?update=NO_OPTIONSii');	
                
            }
    else{
        
        
               // $queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();

        
        if($numfmt<1){	
    
    
    if(request()->input('option')=='textfield'){
                
                //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
                //$connect->insertion($insquery);

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
                $insertx= DB::insert($insqueryx);
                
           // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);
            
            }
    
        
        //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
        //$connect->insertion($fcquery1);

        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace(' ', '_',request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('temprary_menu_options')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into  menuoptions (menuid,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('temprary_menu_options')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();
        
        //return redirect()->route('donefield');

       // header('location:custom_field_create?status=created');

       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$newtable)
       ->orderBy('fieldord','asc')
       ->get(); 
   
       return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>$tableID]);



        }	
        else{
                
                
            //header('location:custom_field_create?status=already_exist');	
            return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
           
                
            }		
            }		
                
                
            }
            
            
            else{
                
                
             //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
              //  $resultfmt=$connect->retrieve($queryfmt);
              //  $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
        
        if($numfmt<1){		
                
            if(request()->input('option')=='textfield'){

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
                
              //  $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
       // $connect->insertion($insquery);
        
            }else{
                
            //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);

        $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
        $insertx= DB::insert($insqueryx);

            
            }
        
        if($_POST['option']=='textarea'){
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace(' ', '_',request()->input('fieldname'))." TEXT NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }
        else{
            
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace(' ', '_',request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }


        if($_POST['option']=='image'||$_POST['option']=='imagelive'){

            $folder = public_path('/photos_'.auth()->user()->id. '/');


            if (! File::exists($folder)) {
                File::makeDirectory($folder);
            }


             }

             if($_POST['option']=='file'){

                $folder = public_path('/documents_'.auth()->user()->id. '/');
    
    
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
    
    
                 }
        
       // return redirect()->route('donefield');

       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$newtable)
       ->orderBy('fieldord','asc')
       ->get(); 
   
       return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>$tableID]);

       
            
        }
            else{
                
                
                return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
          	
                
                
            }	}	
        
            
            
        }
        
        
        
        
    
    
    }
    

}






public function postform($id,$interfaceid,$user){


    $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $replacement=array(' ');// you can enter more replacements.


    $fields="";
	$postfields="";
	$chkvalue="";
	$chkpostfields="";
	$chkfields="";
	$chkvalueformat="";
    $email="";
    $emailcount="";
    $message="";
    $brand="";
    $replyTo="";
    

            if(count(request()->all()) > 0){

                //$squery="SELECT * FROM form_".$id." where type!='checkbox'";

                //$sresult=$connect->retrieve($squery);
                //$srows=$connect->arrayFetch($sresult);

                $brands= DB::table('users_info')
                ->where('userID',request()->input('usrid'))
                ->first();

                $brand= $brands->brand_name;

                $replyTo=$brands->business_email;


                
                $msgs= DB::table('acknowledgement_msg')
                ->where('table_id',request()->input('tableid'))
                ->first();

                $message=$msgs->respEmail;



                $srows= DB::table('form_'.request()->input('usrid'))
                ->where('type','!=', 'checkbox')
                ->where('table_name', $this->get_table_name(request()->input('tableid')))
                ->get();

                $chrows= DB::table('form_'.request()->input('usrid'))
                ->where('table_name',$this->get_table_name(request()->input('tableid')))
                ->where('type','checkbox')
                ->get();

               





                
               // $chquery="SELECT * FROM form_".$id." where type ='checkbox'";
                
               // $chresult=$connect->retrieve($chquery);
               // $chrows=$connect->arrayFetch($chresult);
                
                foreach($chrows as $chrow){
                    
                    $chkfields.= ','.$chrow->fields;
                    
                    
                    foreach(request()->input(str_replace('_','',$chrow->fields))  as  $key ){
                    
                    
                    $chkvalue.='/'.$key;
                    
                    
                    }
                    
                    $chkpostfields.=",'".$chkvalue."'";
                }
                
                foreach($srows as $srow){
                     
                    $fields.= ','.str_replace($symbols,$replacement,$srow->fields);
                    $postfields.= ',"'.request()->input($srow->fields).'"';
    
                   $emailrows= DB::table('form_'.request()->input('usrid'))
                   ->where('type','email')
                   ->where('table_name', $this->get_table_name(request()->input('tableid')))
                   ->first();

                   $emailrows2= DB::table('form_'.request()->input('usrid'))
                   ->where('type','email')
                   ->where('table_name', $this->get_table_name(request()->input('tableid')))
                   ->get();
 
                   $emailcount=$emailrows2->count();

                   if($emailcount<1){
                    $email="";

                   }else{
                    $email=request()->input($emailrows->fields);
                   }
                   
                
                }
                
                 ///////////////////send email here ////////

                 if(!empty($email)){
                    if($emailcount>0 && $emailcount<2){
                        /////// send to visitor ///////
                        if($this->userpackagebrand(request()->input('usrid'))=='pro'){
                     MailController::basic_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                   
                        }
                        if ($this->userpackagebrand(request()->input('usrid'))=='pro'||$this->userpackagebrand(request()->input('usrid'))=='essential'){
                     //////////////////////////// send notification to owner /////
                     MailController::notification_sign_up_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                        }
                   }
               }else{

                   if ($this->userpackagebrand(request()->input('usrid'))=='pro'||$this->userpackagebrand(request()->input('usrid'))=='essential'){
                       //////////////////////////// send notification to owner /////
                       MailController::notification_sign_up_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                          }

               }
                 
                  $query="INSERT INTO form_".request()->input('usrid')."_store_".$this->get_table_name(request()->input('tableid'))." (id".$fields.$chkfields.",enter_date) VALUES(NULL$postfields $chkpostfields,'".date('d-M-Y')."')";
                  $insert = DB::insert( $query);

                 

                  $insqueryx="update interface_list set  no_entry= no_entry+1 where id='".$this->encrypt_decrypt($interfaceid,false)."'";
                  $insertx= DB::insert($insqueryx);

                  $optinx= DB::table('interface_list')->where('id', $this->encrypt_decrypt($interfaceid,false))->first();
                  $allfield = DB::table('form_' .request()->input('usrid'))
                ->where('table_name', $this->get_table_name(request()->input('tableid')))
                ->get(); 

                $list= DB::table('form_styles')->where('table_id',request()->input('tableid'))->first();
                $ack= DB::table('acknowledgement_msg')->where('table_id',request()->input('tableid'))->first();

                if(!Auth::check()){
                    ////////////////////////// store entry ///////////////////
                        $entry_stat = new entry_stat();
                        $entry_stat->count=1;
                        $entry_stat->interfaceID=$this->encrypt_decrypt($interfaceid,false);
                        $entry_stat->table_id=request()->input('tableid');
                        $entry_stat->day=date('d');
                        $entry_stat->month=date('m');
                        $entry_stat->year=date('Y');
                        $entry_stat->save();
                    
                    }

                   
                return view('sign_up_success',['optin'=>$optinx,'brandx'=> $brand,'fields'=>$allfield,'tableid'=>request()->input('tableid'),'userid'=>request()->input('usrid'),'style'=>$list,'acknowledge'=>$ack]);
                 
                
            }}



    public function postform2($subdomain,$interfaceid){


                $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
                $replacement=array(' ');// you can enter more replacements.
            
            
                $fields="";
                $postfields="";
                $chkvalue="";
                $chkpostfields="";
                $chkfields="";
                $chkvalueformat="";
                $email="";
                $emailcount="";
                $message="";
                $brand="";
                $replyTo="";
                
            
                        if(count(request()->all()) > 0){
            
                            //$squery="SELECT * FROM form_".$id." where type!='checkbox'";
            
                            //$sresult=$connect->retrieve($squery);
                            //$srows=$connect->arrayFetch($sresult);
            
                            $brands= DB::table('users_info')
                            ->where('userID',request()->input('usrid'))
                            ->first();
            
                            $brand= $brands->brand_name;
            
                            $replyTo=$brands->business_email;
            
            
                            
                            $msgs= DB::table('acknowledgement_msg')
                            ->where('table_id',request()->input('tableid'))
                            ->first();
            
                            $message=$msgs->respEmail;
            
            
            
                            $srows= DB::table('form_'.request()->input('usrid'))
                            ->where('type','!=', 'checkbox')
                            ->where('table_name', $this->get_table_name(request()->input('tableid')))
                            ->get();
            
                            $chrows= DB::table('form_'.request()->input('usrid'))
                            ->where('table_name',$this->get_table_name(request()->input('tableid')))
                            ->where('type','checkbox')
                            ->get();
            
                           
            
            
            
            
            
                            
                           // $chquery="SELECT * FROM form_".$id." where type ='checkbox'";
                            
                           // $chresult=$connect->retrieve($chquery);
                           // $chrows=$connect->arrayFetch($chresult);
                            
                            foreach($chrows as $chrow){
                                
                                $chkfields.= ','.$chrow->fields;
                                
                                
                                foreach(request()->input(str_replace('_','',$chrow->fields))  as  $key ){
                                
                                
                                $chkvalue.='/'.$key;
                                
                                
                                }
                                
                                $chkpostfields.=",'".$chkvalue."'";
                            }
                            
                            foreach($srows as $srow){
                                 
                                $fields.= ','.str_replace($symbols,$replacement,$srow->fields);
                                $postfields.= ',"'.request()->input($srow->fields).'"';
                
                               $emailrows= DB::table('form_'.request()->input('usrid'))
                               ->where('type','email')
                               ->where('table_name', $this->get_table_name(request()->input('tableid')))
                               ->first();
            
                               $emailrows2= DB::table('form_'.request()->input('usrid'))
                               ->where('type','email')
                               ->where('table_name', $this->get_table_name(request()->input('tableid')))
                               ->get();
             
                               $emailcount=$emailrows2->count();
                               if($emailcount<1){
                                $email="";

                               }else{
                                $email=request()->input($emailrows->fields);
                               }
                            
                            }
                            
                             ///////////////////send email here ////////
            if(!empty($email)){
                             if($emailcount>0 && $emailcount<2){
                                 /////// send to visitor ///////
                                 if($this->userpackagebrand(request()->input('usrid'))=='pro'){
                              MailController::basic_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                               UserController::CheckandSendPdfLink($interfaceid,$email,request()->input('usrid'));

                                 }
                                 if ($this->userpackagebrand(request()->input('usrid'))=='pro'||$this->userpackagebrand(request()->input('usrid'))=='essential'){
                              //////////////////////////// send notification to owner /////
                              MailController::notification_sign_up_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                              UserController::CheckandSendPdfLink($interfaceid,$email,request()->input('usrid')); 
                            }
                            }
                        }else{

                            if ($this->userpackagebrand(request()->input('usrid'))=='pro'||$this->userpackagebrand(request()->input('usrid'))=='essential'){
                                //////////////////////////// send notification to owner /////
                                MailController::notification_sign_up_email($email,$brand,$message,$replyTo,request()->input('usrid'));  
                                UserController::CheckandSendPdfLink($interfaceid,$email,request()->input('usrid')); 
                            }

                        }
                             
                              $query="INSERT INTO form_".request()->input('usrid')."_store_".$this->get_table_name(request()->input('tableid'))." (id".$fields.$chkfields.",enter_date) VALUES(NULL$postfields $chkpostfields,'".date('d-M-Y')."')";
                              $insert = DB::insert( $query);
            
                             
            
                              $insqueryx="update interface_list set  no_entry= no_entry+1 where id='".$interfaceid."'";
                              $insertx= DB::insert($insqueryx);
            
                              $optinx= DB::table('interface_list')->where('id',$interfaceid)->first();
                              $allfield = DB::table('form_' .request()->input('usrid'))
                            ->where('table_name', $this->get_table_name(request()->input('tableid')))
                            ->get(); 
            
                            $list= DB::table('form_styles')->where('table_id',request()->input('tableid'))->first();
                            $ack= DB::table('acknowledgement_msg')->where('table_id',request()->input('tableid'))->first();
            
                            if(!Auth::check()){
                                ////////////////////////// store entry ///////////////////
                                    $entry_stat = new entry_stat();
                                    $entry_stat->count=1;
                                    $entry_stat->interfaceID=$interfaceid;
                                    $entry_stat->table_id=request()->input('tableid');
                                    $entry_stat->day=date('d');
                                    $entry_stat->month=date('m');
                                    $entry_stat->year=date('Y');
                                    $entry_stat->save();
                                
                                }
            
                               
                            return view('sign_up_success',['optin'=>$optinx,'brandx'=> $brand,'fields'=>$allfield,'tableid'=>request()->input('tableid'),'userid'=>request()->input('usrid'),'style'=>$list,'acknowledge'=>$ack]);
                             
                            
                        }}
            
            
            
            
            
public function CheckandSendPdfLink($id,$email,$user){

    $message="";
    $list= DB::table('interface_list')->where('id',$id)->first();
    $downloadlist= DB::table('visitor_download_files')->where('interfaceID',$id)->first(); 
    if($list->downloads=='yes'){
        $message.='<b>'.ucwords($downloadlist->pdf_title).'</b>';
      $message.='<p>Hi, thanks for finding this ebook useful. Click here to download it.</p>';

        MailController::basic_pdf__email($email,$downloadlist->pdf_title,$id,$user);  
                            

    }



}


public function getsubdomain($id){

    $subs= DB::table('users_info')->where('userID',$id)->first();
    return $subs->subdomain;
}


public function savecustomfield2(){


    $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $replacement=array('_');// you can enter more replacements.


    $validator=$this->validate(request(),[
        'fieldname'=>'required|string',
        'option'=>'required|string',
        'required_option'=>'required|string',
     
        ],
        [
            'fieldname.required'=>'Please type in the question you want to create in form ',
            'option.required'=>'Please choose the kind of answer you want to create',
            'required_option.required'=>'Please thick wether answer to this question is required or optional',
           
              
            
            ]);

            if(count(request()->all()) > 0){


        $newtable=$this->get_table_name(request()->input('tableid'));
        $tableID=request()->input('tableid');

        

	
	
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $insquery='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.' (
        id INT AUTO_INCREMENT,table_name VARCHAR(255),fields VARCHAR(255),description VARCHAR(300),fieldord VARCHAR(255) NOT NULL,required_type VARCHAR(255) NOT NULL,type VARCHAR(255) NOT NULL, PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert( $insquery);
        
        
        
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $fcquery1='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.'_store_'.$newtable.' (
        id INT AUTO_INCREMENT,enter_date VARCHAR(255) NOT NULL ,PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert($fcquery1);
        

      

        $options= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        //$query="SELECT * FROM options where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
        //$result=$connect->retrieve($query);
        $num=$options->count();

       $menuoptions= DB::table('temprary_menu_options')
       ->where('user_table', "form_".auth()->user()->id)
       ->where('form_serial', request()->input('_token'))
       ->get();
        
       // $query="SELECT * FROM menuoptions where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
       // $result=$connect->retrieve($query);
        $num2= $menuoptions->count();
        
        if(!empty( request()->input('fieldname')) && !empty(request()->input('option'))){
            
            if(request()->input('option')=='radio' || request()->input('option')=='checkbox'  ){
            if($num<1){
                
                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered.')->withInput();
            
            }
            
            
            else{
                
                
                //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
                
            if($numfmt<1){
    
    
    if(request()->input('option')=='textfield'){
                
                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{
                
            $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
            
            }
    
            
        
        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into options (option_id,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('options_temprary')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();


        $fdata= DB::table("form_".auth()->user()->id)
        ->where('table_name', $newtable)
        ->orderBy('id','asc')
        ->get(); 

        return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
        
        //return view('users.create_form_edit',['fields'=>$fdata,'tableid'=>request()->input('table')]);
        
        
            }else{
                
                
                 return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
         
                
                
            }
                
                
            }	
                
            }
            else if(request()->input('option')=='textfield' && empty(request()->input('input_type')) ){
                
                
                return redirect()->back()->withErrors('Select input type for textfield')->withInput();
         
                
                
                
            }
            
            else if(request()->input('option')=='selectMenu'){
                
                
            if($num2<1){

                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered')->withInput();
         
                
                //header('location:custom_field_create?update=NO_OPTIONSii');	
                
            }
    else{
        
        
               // $queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();

        
        if($numfmt<1){	
    
    
    if(request()->input('option')=='textfield'){
                
                //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
                //$connect->insertion($insquery);

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
                $insertx= DB::insert($insqueryx);
                
           // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);
            
            }
    
        
        //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
        //$connect->insertion($fcquery1);

        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('temprary_menu_options')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into  menuoptions (menuid,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('temprary_menu_options')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();
        
        //return redirect()->route('donefield');

       // header('location:custom_field_create?status=created');

        return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
                       



        }	
        else{
                
                
            //header('location:custom_field_create?status=already_exist');	
            return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
           
                
            }		
            }		
                
                
            }
            
            
            else{
                
                
             //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
              //  $resultfmt=$connect->retrieve($queryfmt);
              //  $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
        
        if($numfmt<1){		
                
            if(request()->input('option')=='textfield'){

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
                
              //  $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
       // $connect->insertion($insquery);
        
            }else{
                
            //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);

        $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
        $insertx= DB::insert($insqueryx);

            
            }
        
        if($_POST['option']=='textarea'){
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." TEXT NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }
        else{
            
       $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
       $insertx1= DB::insert($fcquery1);
        }


        if($_POST['option']=='image'||$_POST['option']=='imagelive'){

            $folder = public_path('/photos_'.auth()->user()->id. '/');


            if (! File::exists($folder)) {
                File::makeDirectory($folder);
            }


             }

             if($_POST['option']=='file'){

                $folder = public_path('/documents_'.auth()->user()->id. '/');
    
    
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
    
    
                 }
        
       // return redirect()->route('donefield');

       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$newtable)
       ->orderBy('fieldord','asc')
       ->get(); 
   
      // return view('users.create_form_stp2',['fields'=>$fdata]);
       return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
            
        }
            else{
                
                
                return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
          	
                
                
            }	}	
        
            
            
        }
        
        
        
        
    
    
    }
}





public function savecustomfield3(){

     $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $replacement=array(' ');// you can enter more replacements.

    $validator=$this->validate(request(),[
        'fieldname'=>'required|string',
        'option'=>'required|string',
        'required_option'=>'required|string',
     
        ],
        [
            'fieldname.required'=>'Please type in the question you want to create in form ',
            'option.required'=>'Please choose the kind of answer you want to create',
            'required_option.required'=>'Please thick wether answer to this question is required or optional',
           
              
            
            ]);

            if(count(request()->all()) > 0){


        $newtable=$this->get_table_name(request()->input('tableid'));
        $tableID=request()->input('tableid');

        

	
	
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $insquery='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.' (
        id INT AUTO_INCREMENT,table_name VARCHAR(255),fields VARCHAR(255),description VARCHAR(300),fieldord VARCHAR(255) NOT NULL,required_type VARCHAR(255) NOT NULL,type VARCHAR(255) NOT NULL, PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert( $insquery);
        
        
        
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $fcquery1='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.'_store_'.$newtable.' (
        id INT AUTO_INCREMENT,enter_date VARCHAR(255) NOT NULL ,PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert($fcquery1);
        

      

        $options= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        //$query="SELECT * FROM options where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
        //$result=$connect->retrieve($query);
        $num=$options->count();

       $menuoptions= DB::table('temprary_menu_options')
       ->where('user_table', "form_".auth()->user()->id)
       ->where('form_serial', request()->input('_token'))
       ->get();
        
       // $query="SELECT * FROM menuoptions where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
       // $result=$connect->retrieve($query);
        $num2= $menuoptions->count();
        
        if(!empty( request()->input('fieldname')) && !empty(request()->input('option'))){
            
            if(request()->input('option')=='radio' || request()->input('option')=='checkbox'  ){
            if($num<1){
                
                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered.')->withInput();
            
            }
            
            
            else{
                
                
                //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
                
            if($numfmt<1){
    
    
    if(request()->input('option')=='textfield'){
                
                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{
                
            $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
            
            }
    
            
        
        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into options (option_id,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('options_temprary')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();


        $fdata= DB::table("form_".auth()->user()->id)
        ->where('table_name', $newtable)
        ->orderBy('id','asc')
        ->get(); 

        
        return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>request()->input('table')]);
        
        
            }else{
                
                
                 return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
         
                
                
            }
                
                
            }	
                
            }
            else if(request()->input('option')=='textfield' && empty(request()->input('input_type')) ){
                
                
                return redirect()->back()->withErrors('Select input type for textfield')->withInput();
         
                
                
                
            }
            
            else if(request()->input('option')=='selectMenu'){
                
                
            if($num2<1){

                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered')->withInput();
         
                
                //header('location:custom_field_create?update=NO_OPTIONSii');	
                
            }
    else{
        
        
               // $queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();

        
        if($numfmt<1){	
    
    
    if(request()->input('option')=='textfield'){
                
                //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
                //$connect->insertion($insquery);

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
                $insertx= DB::insert($insqueryx);
                
           // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);
            
            }
    
        
        //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
        //$connect->insertion($fcquery1);

        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('temprary_menu_options')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into  menuoptions (menuid,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('temprary_menu_options')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();
        
        //return redirect()->route('donefield');

       // header('location:custom_field_create?status=created');

        return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
                       



        }	
        else{
                
                
            //header('location:custom_field_create?status=already_exist');	
            return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
           
                
            }		
            }		
                
                
            }
            
            
            else{
                
                
             //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
              //  $resultfmt=$connect->retrieve($queryfmt);
              //  $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
        
        if($numfmt<1){		
                
            if(request()->input('option')=='textfield'){

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
                
              //  $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
       // $connect->insertion($insquery);
        
            }else{
                
            //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);

        $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
        $insertx= DB::insert($insqueryx);

            
            }
        
        if($_POST['option']=='textarea'){
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." TEXT NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }
        else{
            
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }


        if($_POST['option']=='image'||$_POST['option']=='imagelive'){

            $folder = public_path('/photos_'.auth()->user()->id. '/');


            if (! File::exists($folder)) {
                File::makeDirectory($folder);
            }


             }

             if($_POST['option']=='file'){

                $folder = public_path('/documents_'.auth()->user()->id. '/');
    
    
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
    
    
                 }
        
       // return redirect()->route('donefield');

       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$newtable)
       ->orderBy('fieldord','asc')
       ->get(); 
   
      // return view('users.create_form_stp2',['fields'=>$fdata]);
       return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
            
        }
            else{
                
                
                return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
          	
                
                
            }	}	
        
            
            
        }
        
        
        
        
    
    
    }
}




public function savecustomfieldx(){

    $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $replacement=array(' ');// you can enter more replacements.

    $validator=$this->validate(request(),[
        'fieldname'=>'required|string',
        'option'=>'required|string',
        'required_option'=>'required|string',
     
        ],
        [
            'fieldname.required'=>'Please type in the question you want to create in form ',
            'option.required'=>'Please choose the kind of answer you want to create',
            'required_option.required'=>'Please thick wether answer to this question is required or optional',
           
              
            
            ]);

            if(count(request()->all()) > 0){

$boards= DB::table('form_track')
->where('userID',auth()->user()->id)
->get();

if($this->subCheck()!=2){
            if($boards->count()<1 && $this->userpackage()=='free' || $boards->count()<5 && $this->userpackage()=='essential'|| $this->userpackage()=='pro'){

        $trackFields="";
        $track="";
        $inserttrack="";
        $tablename='form_'.auth()->user()->id;
        $tablename2='form_'.auth()->user()->id.'_store';
        $newtable="";
        $tableID="";

        if (!Schema::hasTable($tablename)){
        Schema::create($tablename, function($table)
{
         $table->increments('id');
         $table->string('fields', 255);
         $table->string('type', 255);
});


$fcquery2='ALTER TABLE '.$tablename.' ADD fieldord INT(11) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery2); 

$fcquery3='ALTER TABLE '.$tablename.' ADD required_type VARCHAR(255) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery3); 

$fcquery4='ALTER TABLE '.$tablename.' ADD description VARCHAR(255) NULL AFTER id ';
                            $insert = DB::insert($fcquery4); 

 $fcquery4='ALTER TABLE '.$tablename.' ADD table_name VARCHAR(255) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery4); 
                            
}      



$counttable= DB::table('table_list')->where('userID', auth()->user()->id)->get(); 
if($counttable->count()<1){

    $newtable="table1";

    $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();

    //$insquery="insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','".auth()->user()->id."')";
    //$insert = DB::insert( $insquery);
    $tableID=$table_list->id;

}
else if($counttable->count()>0){

            $joint=$counttable->count()+1;
            $newtable= 'table'.$joint;

            $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();
    $tableID=$table_list->id;

            //$insquery = "insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','" . auth()->user()->id . "')";
            //$insert = DB::insert($insquery);

}

        

	
	
        
        
        ///////////////////////////////////// create table ///////////////////////////////////////////////////////
        $fcquery1='CREATE TABLE IF NOT EXISTS form_'.auth()->user()->id.'_store_'.$newtable.' (
        id INT AUTO_INCREMENT,enter_date VARCHAR(255) NOT NULL ,PRIMARY KEY (id))  ENGINE=INNODB';
        $insert = DB::insert($fcquery1);
        

      

        $options= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        //$query="SELECT * FROM options where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
        //$result=$connect->retrieve($query);
        $num=$options->count();

       $menuoptions= DB::table('temprary_menu_options')
       ->where('user_table', "form_".auth()->user()->id)
       ->where('form_serial', request()->input('_token'))
       ->get();
        
       // $query="SELECT * FROM menuoptions where user_table= 'form_".$_SESSION['ID']."' and fieldname='".$_POST['fieldname']."' and type='".$_POST['option']."' " ;
       // $result=$connect->retrieve($query);
        $num2= $menuoptions->count();
        
        if(!empty( request()->input('fieldname')) && !empty(request()->input('option'))){
            
            if(request()->input('option')=='radio' || request()->input('option')=='checkbox'  ){
            if($num<1){
                
                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered.')->withInput();
            
            }
            
            
            else{
                
                
                //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
                
            if($numfmt<1){
    
    
    if(request()->input('option')=='textfield'){
                
                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{
                
            $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
            
            }
    
            
        
        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('options_temprary')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into options (option_id,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('options_temprary')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();

        $font='"Poppins" Arial sans-serif';
    
        $styles= DB::table('form_styles')->where('table_id',$tableID)->get(); 
        $acknowledge= DB::table('acknowledgement_msg')->where('table_id',$tableID)->get(); 

if($styles->count()<1){
        $insquery="insert into form_styles (id,table_id,title_color,tfcolor,buttonText,description_color,bgcolor,bcolor,btcolor,title_size,description_size,font_type) 
        values(NULL,'".$tableID."','#fefefe','#fff','SIGN UP','#fefefe','#0088cc','#0d0c0c','#fff','30','18','".$font."')";
        $insert = DB::insert( $insquery);
}
if($styles->count()<1){
        $ack="insert into acknowledgement_msg (id,thankMsg,respEmail,table_id) 
        values(NULL,'Thank you for sign in up for our update messages','Thank you for sign in up for our update messages','".$tableID."')";
         DB::insert($ack);
}


        $fdata= DB::table("form_".auth()->user()->id)
        ->where('table_name', $newtable)
        ->orderBy('id','asc')
        ->get(); 


        $form_track = new form_track();
    $form_track ->table_id=$tableID;
    $form_track ->form=$tablename;
    $form_track ->userID=auth()->user()->id;
    $form_track ->title='';
    $form_track ->logo='';
    $form_track ->company_name='';
    $form_track ->note='';
    $form_track ->niche='';
    $form_track ->save();
        
        return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>$tableID]);
        
        
            }else{
                
                
                 return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
         
                
                
            }
                
                
            }	
                
            }
            else if(request()->input('option')=='textfield' && empty(request()->input('input_type')) ){
                
                
                return redirect()->back()->withErrors('Select input type for textfield')->withInput();
         
                
                
                
            }
            
            else if(request()->input('option')=='selectMenu'){
                
                
            if($num2<1){

                return redirect()->back()->withErrors('Please ensure  the options of the answer type you have checked are entered')->withInput();
         
                
                //header('location:custom_field_create?update=NO_OPTIONSii');	
                
            }
    else{
        
        
               // $queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
               // $resultfmt=$connect->retrieve($queryfmt);
               // $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();

        
        if($numfmt<1){	
    
    
    if(request()->input('option')=='textfield'){
                
                //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
                //$connect->insertion($insquery);

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
            }else{

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
                $insertx= DB::insert($insqueryx);
                
           // $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);
            
            }
    
        
        //$fcquery1="ALTER TABLE form_".$_SESSION['ID']."_store ADD ".str_replace(' ', '_',$_POST['fieldname'])." VARCHAR( 600 ) NOT NULL AFTER id " ;
        //$connect->insertion($fcquery1);

        $fcquery1x="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insert1x= DB::insert($fcquery1x);


        $optionstemps= DB::table('temprary_menu_options')
        ->where('user_table', "form_".auth()->user()->id)
        ->where('form_serial', request()->input('_token'))
        ->get();

        foreach($optionstemps as $optionstemp){

            $insqueryx="insert into  menuoptions (menuid,user_table,table_id,fieldname,userid,option_item,type) 
            values(NULL,'"."form_".auth()->user()->id."','".$tableID."','".$optionstemp->fieldname."','".auth()->user()->id."','".$optionstemp->option_item."','".request()->input('option')."')";
            $insertx= DB::insert($insqueryx);
        }

        DB::table('temprary_menu_options')
        ->where('user_table',"form_".auth()->user()->id)
        ->where('form_serial',request()->input('_token'))
        ->where('fieldname',$optionstemp->fieldname)
        ->delete();
        

        //return redirect()->route('donefield');

        $form_track = new form_track();
    $form_track ->table_id=$tableID;
    $form_track ->form=$tablename;
    $form_track ->userID=auth()->user()->id;
    $form_track ->title='';
    $form_track ->logo='';
    $form_track ->company_name='';
    $form_track ->note='';
    $form_track ->niche='';
    $form_track ->save();



    $font='"Poppins" Arial sans-serif';
    
        $styles= DB::table('form_styles')->where('table_id',$tableID)->get(); 
        $acknowledge= DB::table('acknowledgement_msg')->where('table_id',$tableID)->get(); 

if($styles->count()<1){
        $insquery="insert into form_styles (id,table_id,title_color,tfcolor,buttonText,description_color,bgcolor,bcolor,btcolor,title_size,description_size,font_type) 
        values(NULL,'".$tableID."','#fefefe','#fff','SIGN UP','#fefefe','#0088cc','#0d0c0c','#fff','30','18','".$font."')";
        $insert = DB::insert( $insquery);
}
if($styles->count()<1){
        $ack="insert into acknowledgement_msg (id,thankMsg,respEmail,table_id) 
        values(NULL,'Thank you for sign in up for our update messages','Thank you for sign in up for our update messages','".$tableID."')";
         DB::insert($ack);
}


       // header('location:custom_field_create?status=created');

       // return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
          return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=> $tableID]);              



        }	
        else{
                
                
            //header('location:custom_field_create?status=already_exist');	
            return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
           
                
            }		
            }		
                
                
            }
            
            
            else{
                
                
             //$queryfmt= "select * from form_".$_SESSION['ID']." where fields='".str_replace(' ', '_',$_POST['fieldname'])."' ";
              //  $resultfmt=$connect->retrieve($queryfmt);
              //  $numfmt=$connect->numRows($resultfmt);

                $formcheckx= DB::table("form_".auth()->user()->id)
                ->where('table_name',$newtable)
                ->where('fields', str_replace(' ', '_',request()->input('fieldname')))
                ->get();
                $numfmt=$formcheckx->count();
        
        if($numfmt<1){		
                
            if(request()->input('option')=='textfield'){

                $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('input_type')."')";
                $insertx= DB::insert($insqueryx);
        
                
              //  $insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['input_type']."')";
       // $connect->insertion($insquery);
        
            }else{
                
            //$insquery="insert into form_".$_SESSION['ID']." (form_id,fields,type ) values(NULL,'".str_replace(' ', '_',$_POST['fieldname'])."','".$_POST['option']."')";
       // $connect->insertion($insquery);

        $insqueryx="insert into form_".auth()->user()->id." (id,table_name,fieldord,required_type,fields,description,type ) values(NULL,'".$newtable."',0,'".request()->input('required_option')."','".str_replace(' ', '_',request()->input('fieldname'))."','".request()->input('description')."','".request()->input('option')."')";
        $insertx= DB::insert($insqueryx);

            
            }
        
        if($_POST['option']=='textarea'){
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." TEXT NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }
        else{
            
        $fcquery1="ALTER TABLE form_".auth()->user()->id."_store_".$newtable." ADD ".str_replace($symbols,$replacement,request()->input('fieldname'))." VARCHAR( 600 ) NOT NULL AFTER id " ;
        $insertx1= DB::insert($fcquery1);
        }


        if($_POST['option']=='image'||$_POST['option']=='imagelive'){

            $folder = public_path('/photos_'.auth()->user()->id. '/');


            if (! File::exists($folder)) {
                File::makeDirectory($folder);
            }


             }

             if($_POST['option']=='file'){

                $folder = public_path('/documents_'.auth()->user()->id. '/');
    
    
                if (! File::exists($folder)) {
                    File::makeDirectory($folder);
                }
    
    
                 }
        
       // return redirect()->route('donefield');

       $form_track = new form_track();
    $form_track ->table_id=$tableID;
    $form_track ->form=$tablename;
    $form_track ->userID=auth()->user()->id;
    $form_track ->title='';
    $form_track ->logo='';
    $form_track ->company_name='';
    $form_track ->note='';
    $form_track ->niche='';
    $form_track ->save();


    $font='"Poppins" Arial sans-serif';
    
    $styles= DB::table('form_styles')->where('table_id',$tableID)->get(); 
    $acknowledge= DB::table('acknowledgement_msg')->where('table_id',$tableID)->get(); 

if($styles->count()<1){
    $insquery="insert into form_styles (id,table_id,title_color,tfcolor,buttonText,description_color,bgcolor,bcolor,btcolor,title_size,description_size,font_type) 
    values(NULL,'".$tableID."','#fefefe','#fff','SIGN UP','#fefefe','#0088cc','#0d0c0c','#fff','30','18','".$font."')";
    $insert = DB::insert( $insquery);
}
if($styles->count()<1){
    $ack="insert into acknowledgement_msg (id,thankMsg,respEmail,table_id) 
    values(NULL,'Thank you for sign in up for our update messages','Thank you for sign in up for our update messages','".$tableID."')";
     DB::insert($ack);
}


       $fdata= DB::table('form_'.auth()->user()->id)
       ->where('table_name',$newtable)
       ->orderBy('fieldord','asc')
       ->get(); 
   
       return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=> $tableID]);
      // return redirect()->back()->withSuccess('Your have added a new field to your form successfuly');
            
        }
            else{
                
                
                return redirect()->back()->withErrors('You have already created this question in form. <a href="cform"> View</a>')->withInput();
          	
                
                
            }	}	
        
            
            
        }
        
        
        
        
            }else{

                
                return redirect()->back()->withErrors('You can not create more than the number of niche board(s) you have created in the plan you paid for')->withInput();
 


            }
        }else{

            return redirect()->back()->withErrors('Sorry! your subscription for the '.$this->userpackage().' package has expired')->withInput();
   

        }



    
    }
}



public function donefield(){

    return view('users.done_field_create');  
}

public function donefieldedit(){

    return view('users.done_field_create_edit');  
}


    public function submitformfield()
    {
        $trackFields="";
        $track="";
        $inserttrack="";
        $tablename='form_'.auth()->user()->id;
        $tablename2='form_'.auth()->user()->id.'_store';
        $newtable="";
        $tableID="";


/////////////////////// subscription filter ////////////////////////////

///----------1. Count  board ----------------------------------------
$boards= DB::table('form_track')
->where('userID',auth()->user()->id)
->get();

if($this->subCheck()!=2){
if($boards->count()<1 && $this->userpackage()=='free' || $boards->count()<5 && $this->userpackage()=='essential'|| $this->userpackage()=='pro'){


        if (!Schema::hasTable($tablename)){
        Schema::create($tablename, function($table)
{
         $table->increments('id');
         $table->string('fields', 255);
         $table->string('type', 255);
});


$fcquery2='ALTER TABLE '.$tablename.' ADD fieldord INT(11) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery2); 

$fcquery3='ALTER TABLE '.$tablename.' ADD required_type VARCHAR(255) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery3); 

$fcquery4='ALTER TABLE '.$tablename.' ADD description VARCHAR(255) NULL AFTER id ';
                            $insert = DB::insert($fcquery4); 

 $fcquery4='ALTER TABLE '.$tablename.' ADD table_name VARCHAR(255) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery4); 
                            
}      
       
$counttable= DB::table('table_list')->where('userID', auth()->user()->id)->get(); 
if($counttable->count()<1){

    $newtable="table1";

    $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();

    //$insquery="insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','".auth()->user()->id."')";
    //$insert = DB::insert( $insquery);
    $tableID=$table_list->id;

}
else if($counttable->count()>0){

            $joint=$counttable->count()+1;
            $newtable= 'table'.$joint;

            $table_list = new table_list();
    $table_list->tablename=$newtable;
    $table_list->userID=auth()->user()->id;
    $table_list->save();
    $tableID=$table_list->id;
    $type="";
            //$insquery = "insert into table_list (id,tablename,userID) values(NULL,'".$newtable."','" . auth()->user()->id . "')";
            //$insert = DB::insert($insquery);

}

       if(isset($_POST['fields'])){ 
            

        $input =request()->all();  
        $condition = $input['fields'];
        foreach ($condition as $key => $condition) {

          

            if($input['fields'][$key]=='state' || $input['fields'][$key]=='country' || $input['fields'][$key]=='lga'){
		
                $fieldchk= DB::table($tablename)
                ->where('fields', $input['fields'][$key])
                ->where('table_name', $newtable)
                ->get();
                if($fieldchk->count()<1){
                 $insquery="insert into ".$tablename." (id,fieldord,required_type,fields,description,table_name,type) values(NULL,0,'yes','".$input['fields'][$key]."','','".$newtable."','menu')";
                 $insert = DB::insert( $insquery);
              
                }
                    }else{

                        $fieldchk= DB::table($tablename)
                        ->where('fields', $input['fields'][$key])
                        ->where('table_name', $newtable)
                        ->get();
                        if($fieldchk->count()<1){

                            if($input['fields'][$key]=='email'){
                                $type='email';
                            }else{
                                $type='text';

                            }
                        
                        $insquery="insert into ".$tablename." (id,fieldord,required_type,fields,description,table_name,type) values(NULL,0,'yes','".$input['fields'][$key]."','','".$newtable."','".$type."')";
                        $insert = DB::insert( $insquery);
                        }
                        
                    }	

                    $trackFields.=str_replace(' ', '',$input['fields'][$key]).' VARCHAR(255) NOT NULL,';
                   

                    if (Schema::hasTable($tablename2.'_'.$newtable)){


                        if (!Schema::hasColumn($tablename2.'_'.$newtable,str_replace(' ', '',$input['fields'][$key]))) {
                            $fcquery2='ALTER TABLE '.$tablename2.'_'.$newtable.' ADD '.str_replace(' ', '',$input['fields'][$key]).' VARCHAR( 200 ) NOT NULL AFTER id ';
                            $insert = DB::insert($fcquery2); 
                              } 
                           
       
                        
                 
                }  

    }

    $fcquery1='CREATE TABLE IF NOT EXISTS '.$tablename2.'_'.$newtable.' (id INT AUTO_INCREMENT,'.$trackFields.'enter_date VARCHAR(255) NOT NULL, PRIMARY KEY (id))  ENGINE=INNODB';
    $insert = DB::insert($fcquery1);


    $form_track = new form_track();
    $form_track ->table_id=$tableID;
    $form_track ->form=$tablename;
    $form_track ->userID=auth()->user()->id;
    $form_track ->title='';
    $form_track ->logo='';
    $form_track ->company_name='';
    $form_track ->note='';
    $form_track ->niche='';
    $form_track ->save();

    $font='"Poppins" Arial sans-serif';
    
    $styles= DB::table('form_styles')->where('table_id',$tableID)->get(); 
    $acknowledge= DB::table('acknowledgement_msg')->where('table_id',$tableID)->get(); 

if($styles->count()<1){
    $insquery="insert into form_styles (id,table_id,title_color,tfcolor,buttonText,description_color,bgcolor,bcolor,btcolor,title_size,description_size,font_type) 
    values(NULL,'".$tableID."','#fefefe','#fff','SIGN UP','#fefefe','#0088cc','#0d0c0c','#fff','30','18','".$font."')";
    $insert = DB::insert( $insquery);
}
if($styles->count()<1){
    $ack="insert into acknowledgement_msg (id,thankMsg,respEmail,table_id) 
    values(NULL,'Thank you for sign in up for our update messages','Thank you for sign in up for our update messages','".$tableID."')";
     DB::insert($ack);
}


    $fdata= DB::table($tablename)
    ->where('table_name', $newtable)
    ->orderBy('id','asc')
    ->get(); 
    //return redirect()->route('formstp2', ['fields'=>$fdata]);
    
    return view('users.create_form_stp2',['fields'=>$fdata,'tableid'=>$tableID]);


}else{

        return redirect()->back()->withErrors('You have not checked any field to add to form')->withInput();
     

    }
}else{

    return redirect()->back()->withErrors('You can not create more than the number of niche board(s) you have created in the plan you paid for')->withInput();
       
}

    }else{

        
        return redirect()->back()->withErrors('Sorry! your subscription for the '.$this->userpackage().' package has expired')->withInput();
   

    }



    }


   
    
    public function profileview(){
        $logo="";
        $data= DB::table('users_info') 
        ->select('users_info.brand_name','users_info.business_email','users_info.about_business','users_info.subdomain','users_info.business_area','users.created_at')
        ->join('users','users.id','=','users_info.userID')
        ->where('userID',auth()->user()->id)->get();
        
        $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
        $brand= DB::table('brand_logo')->where('userID', auth()->user()->id)->get();
        foreach($brand as $brando){

            $logo=$brando->logo;
        }
        if($checkprofile->count()<1){

            return view('users.moreinfo');
         }
         
         else if($checkprofile->count()>0 && $brand->count()<1){

            return view('users.upload_logo');

         }else{
        return view('users.profile_view',['datas'=>$data,'logos'=>$logo]);
        }
    }


    public static function country(){
        
   $output='';
   $rows= DB::table('countries')->get();
   foreach($rows as $row){
   
       $output.='<option value="'.$row->country_name.'">'. $row->country_name.'</option>';
       }
       
       return $output;
   }


   public static function getOptionsItem($val,$val2,$sessid,$tableid){
    $output="";
    
    if($val=='radio'){
       


        
      //  $query="select * from options where fieldname='".$val2."' and type='".$val."' and user_table='form_".$sessid."' ";
    //$result=$this->retrieve($query);
    //$rows=$this->arrayFetch($result);

    $options= DB::table('options')->where('fieldname', $val2)
    ->where(['type' => $val])
    ->where('table_id', $tableid)
    ->where(['user_table' => 'form_'.$sessid])
    ->get();


    
        $output.='<table><tr>';
        foreach($options as $option){
            $output.='<td style="padding-right:20px"> <input type='.$val.' name='.str_replace(' ', '.',$val2).' value='.$option->option_item.' required /> '.ucwords($option->option_item).' </td>';
        }
        $output.='</tr></table>';
    
}
    else if($val=='checkbox'){
        
      //  $query="select * from options where fieldname='".$val2."' and type='".$val."' and user_table='form_".$_SESSION['ID']."' ";
    //$result=$this->retrieve($query);
    //$rows=$this->arrayFetch($result);

    $options= DB::table('options')
    ->where('fieldname', $val2)
    ->where('type', $val)
    ->where('table_id', $tableid)
    ->where('user_table','form_'.$sessid)
    ->get();
        
    $output.='<table>';
        foreach($options as $option){
            $output.='<tr><td style="padding-right:20px"> <input type='.$val.' name="'.str_replace(' ', '',$val2).'[]" value='.str_replace(' ', '-',$option->option_item).' /> '.ucwords($option->option_item).' </td></tr>';
        }
        $output.='</table>';
    }
    return $output;
}

    public static function verifyField($field,$type,$sessid,$tableid){
        $output="";	
        
            
        if($field=='country'){
            
                              
                      $output='<select name="country" class="input w-full border mt-2" required>'.
                      
                      Usercontroller::country()
                      
                     .' </select>';	
                
        
            
        }		
            
        if($field=='state'){
            
    
                      
                      $output='<select id="state" name="state" class="input w-full border mt-2" onChange="popProvince()" >'.
                     
                      Usercontroller::states2()
                      
                     .' </select>';	
                
        
            
        }
        
        if($field=='lga'){
           
                      
                      $output='<select id="province" name="lga" class="input w-full border mt-2" ></select>';	
                
        
            
        }
        
        
        
        if($type=='email'){
            
             
                      
                      $output='<input name="'.$field.'" class="input w-full border mt-2" type="email" required>';	
            
            
        }		
        else if($field !='email' || $field !='state'|| $field !='country' ){
            
             if($type=='radio'){
                $output=UserController::getOptionsItem($type,$field,$sessid,$tableid);
                 
             }
             else if($type=='checkbox'){
                 
                $output=UserController::getOptionsItem($type,$field,$sessid,$tableid);
             }
            else if($type=='textarea'){
                   $output='<textarea name="'.str_replace(' ', '.',$field).'" class="input w-full border mt-2" required></textarea>';	
                 
             }
             else if($type=='text'){

                if($field=="date of birth"){

                    $output='<input name="'.str_replace(' ', '.',$field).'"  class="datepicker input w-full border block mx-auto mt-2" type="'.$type.'" required>'; 
              
                }else{
                 
                 $output='<input name="'.str_replace(' ', '.',$field).'" class="input w-full border mt-2" type="'.$type.'" required>'; 
                }
                }

                 else if($type=='date'){

               

                    $output='<input name="'.str_replace(' ', '.',$field).'"  class="datepicker input w-full border block mx-auto mt-2" type="'.$type.'" required>'; 
              
                }
             else if($type=='number'){
                 
                 $output='<input name="'.str_replace(' ', '.',$field).'" class="input w-full border mt-2" type="'.$type.'" required>'; 
             }
                    
            else if($type=='selectMenu'){
                
               // $result= "select * from  menuoptions where user_table ='form_".$_SESSION['ID']."' and fieldname='".$field."' ";
               // $result=$this->retrieve($result);
               // $rows=$this->arrayFetch($result);

                $options= DB::table('menuoptions')
                ->where('fieldname', $field)
                ->where('table_id', $tableid)
                ->where(['user_table' => 'form_'.auth()->user()->id])
                ->get();
                 
                 $output.='<select name="'.str_replace(' ', '.',$field).'" class="input w-full border mt-2">';
                 
                 foreach($options as $option){
                  $output.='<option>'.$option->option_item.'</option>';
                 }
                  
                  $output.='</select>';
                 
             }	

             else if($type=='image'||$type=='file'){
                
                   $output.='<input name="'.str_replace(' ', '.',$field).'" type="file" />';
                   
                   return $output;
                  
              }	

              else if($type=='imagelive'){
                
                $output.=' <button onClick="take_snapshot()" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-34 text-white"> <i data-feather="camera" class="w-4 h-4 mr-2"></i> Snap</button>
                <input type="hidden" name="image" class="image-tag"> ';
                
                return $output;
               
           }	
            
            
        }
    return $output;	
        }




        public static function verifyField2($field,$required,$type,$sessid,$tableid,$description,$fieldcolor){
            $output="";	
            $required_type="";
            if($required=='yes'){

                $required_type="required";  
            }
            
                
            if($field=='country'){
                
                                  
                          $output='<select style="background-color:'.$fieldcolor.'" name="country" class="form-control" data-plugin-multiselect data-plugin-options=\'{ "maxHeight": 200 }\' id="ms_example1"  '.$required_type.'>'.
                          
                          Usercontroller::country()
                          
                         .' </select>';	
                    
            
                
            }		
                
            if($field=='state'){
                
        
                          
                          $output='<select id="state" style="background-color:'.$fieldcolor.'" name="state" class="form-control" data-plugin-multiselect data-plugin-options=\'{ "maxHeight": 200 }\' id="ms_example1" onChange="popProvince()"  '.$required_type.'>'.
                         
                          Usercontroller::states2()
                          
                         .' </select>';	
                    
            
                
            }
            
            if($field=='lga'){
               
                          
                          $output='<select id="province" style="background-color:'.$fieldcolor.'" name="lga" class="form-control"  '.$required_type.'></select>';	
                    
            
                
            }
            
            
            
            if($type=='email'){
                
                 
                          
                          $output='<input name="'.$field.'" style="background-color:'.$fieldcolor.'" class="form-control" type="email" placeholder="'.$description.'"  '.$required_type.'>';	
                
                
            }		
            else if($field !='email' || $field !='state'|| $field !='country' ){
                
                 if($type=='radio'){
                    $output=UserController::getOptionsItem($type,$field,$sessid,$tableid);
                     
                 }
                 else if($type=='checkbox'){
                     
                    $output=UserController::getOptionsItem($type,$field,$sessid,$tableid);
                 }
                else if($type=='textarea'){
                       $output='<textarea style="background-color:'.$fieldcolor.'" name="'.str_replace(' ', '.',$field).'" class="form-control"    '.$required_type.'></textarea>';	
                     
                 }
                 else if($type=='text'){
    
                    if($field=="date of birth"){
    
                        $output='<input style="background-color:'.$fieldcolor.'" name="'.str_replace(' ', '.',$field).'" data-plugin-datepicker class="form-control"  placeholder="'.$description.'" type="text"  '.$required_type.'>'; 
                  
                    }else{
                     
                     $output='<input style="background-color:'.$fieldcolor.'" name="'.str_replace(' ', '.',$field).'" class="form-control" type="'.$type.'" style="background-color:#ccc" placeholder="'.$description.'"  '.$required_type.'>'; 
                    }
                    }
    
                     else if($type=='date'){
    
                   
    
                        $output='<input style="background-color:'.$fieldcolor.'" name="'.str_replace(' ', '.',$field).'" data-plugin-datepicker  class="form-control" placeholder="'.$description.'" type="text"  '.$required_type.'>'; 
                  
                    }
                 else if($type=='number'){
                     
                     $output='<input style="background-color:'.$fieldcolor.'"  name="'.str_replace(' ', '.',$field).'" class="form-control" type="'.$type.'" placeholder="'.$description.'"  '.$required_type.'>'; 
                 }
                        
                else if($type=='selectMenu'){
                    
                   // $result= "select * from  menuoptions where user_table ='form_".$_SESSION['ID']."' and fieldname='".$field."' ";
                   // $result=$this->retrieve($result);
                   // $rows=$this->arrayFetch($result);
    
                    $options= DB::table('menuoptions')
                    ->where('fieldname', $field)
                    ->where('table_id', $tableid)
                    ->where(['user_table' => 'form_'.$sessid])
                    ->get();
                     
                     $output.='<select style="background-color:'.$fieldcolor.'" name="'.str_replace(' ', '.',$field).'" class="form-control" data-plugin-multiselect data-plugin-options=\'{ "maxHeight": 200 }\' id="ms_example1"  '.$required_type.'>';
                     
                     foreach($options as $option){
                      $output.='<option>'.$option->option_item.'</option>';
                     }
                      
                      $output.='</select>';
                     
                 }	
                
                
            }
        return $output;	
            }



    public function smsdetail($id)
    {
        $smsdetail= DB::table('sendmsg')->where('id',$id)->first(); 
        return view('users.smsdetail',['smsx'=>$smsdetail]);

    }


    public static function get_list_type($id)
    {
        $listtype= DB::table('lists')->where('id',$id)->first(); 
        
        return $listtype->type;

    }


    public static function get_list_type_brand($id)
    {
        $output="";
        $listtype= DB::table('lists')->where('id',$id)->first(); 
        if($listtype->type=='other'){
            $output=' Anniversary List';
        }
        else if($listtype->type=='phonebook'){
            $output=' Phone Book';
        }
        else{

            $output=' Birthday List';

        }
        
        return $output;

    }

    public function resend(){

        $phone=request()->input('phone');
        $msg=request()->input('message');
        $senderid=request()->input('senderid');
        $id=request()->input('id');

        $response=$this->CURLsendsms($phone,$msg,$senderid);
        DB::table('sendmsg')->where('id', $id)->update([
                    
            'status' => $response
            
        ]);
        return redirect()->back()->withSuccess('SMS re-sent succesfully');     


    }

    public function schedule()
    {
        $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
        return view('users.scheduler',['lists'=>$list]);

    }

    public function smsallcontact($id,$type)
    {
        $list= DB::table('lists')->where('id', $id)->first(); 
        if($type=='other'){

            $contactlistx= DB::table('anniversarylist')->where('listID',$id)->get(); 
            return view('users.smsallcontactsother',['lists'=>$list,'contactlists'=> $contactlistx]);
        }

        if($type=='birthday'){
            $contactlistx= DB::table('contactlist')->where('listID',$id)->get(); 
            return view('users.smsallcontacts',['lists'=>$list,'contactlists'=> $contactlistx]);

        }
        
       
       

    }


    
public function customarrange($id){

    $fdata="";
   
    if (Schema::hasColumn('form_'.auth()->user()->id,'fieldord')) {

        $fdata= DB::table('form_'.auth()->user()->id)
        ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
        ->orderBy('fieldord','ASC')
        ->get(); 

          }else{


            $fdata= DB::table('form_'.auth()->user()->id)
            ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
            ->get();

          }

    
    return view('users.custom_form_arrange',['fields'=>$fdata,'tableid'=>$this->encrypt_decrypt($id,false)]);
}


    
public function customarrangeedit($id){

    $fdata="";
   
    if (Schema::hasColumn('form_'.auth()->user()->id,'fieldord')) {

        $fdata= DB::table('form_'.auth()->user()->id)
        ->where('table_name',$this->get_table_name($this->encrypt_decrypt($id,false)))
        ->orderBy('fieldord','ASC')
        ->get(); 

          }else{


            $fdata= DB::table('form_'.auth()->user()->id)
            ->where('table_name',$this->get_table_name($this->encrypt_decrypt($id,false)))
            ->get();

          }

    
    return view('users.custom_form_arrange_edit',['fields'=>$fdata,'tableid'=>$this->encrypt_decrypt($id,false)]);
}

public static function encrypt_decrypt ($data, $encrypt) {
    if ($encrypt == true) {
        $output = base64_encode (convert_uuencode ($data));
    } else {
        $output = convert_uudecode(base64_decode ($data));
    }
    return $output;
}


public function fieldarrange($id)
{
    
            if(count(request()->all()) > 0){

                $tablename2='form_'.auth()->user()->id;

            

                   

                    $input =request()->all();  
                    $condition = $input['id'];
                    foreach ($condition as $key => $condition) {
                        $insquery="update ".$tablename2." set fieldord='".$input['order'][$key]."' where id='".$input['id'][$key]."' and table_name='".$this->get_table_name(request()->input('tableid'))."'";
                        $insert = DB::insert( $insquery);
       
    
                    }
                
                          


                          return redirect()->back()->withSuccess('Field rearranged sucessful.');
               


            }
}


public function fieldarrangeedit()
{
    
            if(count(request()->all()) > 0){

                $tablename2='form_'.auth()->user()->id;

            

                   

                    $input =request()->all();  
                    $condition = $input['id'];
                    foreach ($condition as $key => $condition) {
                        $insquery="update ".$tablename2." set fieldord='".$input['order'][$key]."' where id='".$input['id'][$key]."' and table_name='".$this->get_table_name(request()->input('tableid'))."'";
                        $insert = DB::insert( $insquery);
       
    
                    }
                
                          


                          return redirect()->back()->withSuccess('Field rearranged sucessful.');
               


            }
}


    public function scheduleList()
    {
        $list= DB::table('lists')
        ->select('lists.id','lists.name','autosend.id','autosend.listID','autosend.created_at','autosend.sendtype')
        ->join('autosend','autosend.listID','=','lists.id')
        ->where(['autosend.userID' => auth()->user()->id])
        ->get();


        $checkprofile= DB::table('users_info')->where('userID', auth()->user()->id)->get(); 
        if($checkprofile->count()<1){

           return view('users.moreinfo');
        }else{
        return view('users.autoscheduleList',['lists'=>$list]);
        }

    }

    public function deactivateauto($id)

    {
        DB::table('autosend_list')->where('listID',$id)->delete();
        DB::table('autosend')->where('listID',$id)->delete();
        //$resources = DB::delete('delete from autosend where id='.$id);
        return redirect()->back()->withSuccess('list deactivated sucessfuly');
          

    }



    public function changesenderid($id){

        if(count(request()->all()) > 0){


            DB::table('autosend_list')->where('listID', $id)->update(['senderID'=>request()->input('senderid')]);

            return redirect()->back()->withSuccess('Sender ID updated succesfully');


        }

    }


    public function changesenderid2($id){

        if(count(request()->all()) > 0){

            

            DB::table('autosend')->where('id', $id)->update(['senderID'=>request()->input('senderid')]);



            DB::table('autosend_list')->where('listID', UserController::getListIdFromAutosend($id))->update(['senderID'=>request()->input('senderid')]);

            return redirect()->back()->withSuccess('Sender ID updated succesfully');


        }

    }

    public function scheduleupdate($id,$id2,$extra)
    {
            if($id2=='single'){

             $list= DB::table('autosend')->where('id',$id)->first(); 
            $contactlist= DB::table('contactlist')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
            return redirect('users/singleupdate/'.$id);
        //return view('users.updateschedule',['list'=>$list,'contactlist'=>$contactlist]);
        
        } 
        if($id2=='multiple'){

            if($extra=="other"){
              $names= DB::table('lists')->where('id',UserController::getListIdFromAutosend($id))->first(); 
               
              $list= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
              //$senders= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->first(); 
             return redirect('users/multipleupdate/'.$id);
              // return view('users.list_contacts_other_exit',['contactlists'=>$list,'lists'=>$names,'sender'=>$senders]);
                
            }
else{
            $list= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
           // return view('users.updateschedulemultiple',['list'=>$list]);
           return redirect('users/multipleupdate/'.$id);
        }
        }
        if($id2=='phonebook'){

            $auto= DB::table('autosend')->where('id',$id)->first(); 

            $list= DB::table('lists')->where('id',  $auto->listID)->first(); // return view('users.updateschedulemultiple',['list'=>$list]);
           if($list->filter==1){
            $contactlistx= DB::table('phonenamelist')->where('listID', $auto->listID)->get();
            $smsx= DB::table('phone_schedule_sms')->where('listID', $auto->listID)->get();
           
            return view('users.auto_name_phone',['lists'=>$list,'contactlists'=>$contactlistx,'smss'=> $smsx]);
    
           }
           else if($list->filter==2){
            $contactlistx= DB::table('phoneonly')->where('listID', $auto->listID)->first();
            $smsx= DB::table('phone_schedule_sms')->where('listID', $auto->listID)->get();
            return view('users.auto_phone',['lists'=>$list,'contactlists'=>$contactlistx,'smss'=> $smsx]);
        
           }

        }

    }


    public function singleupdate($id)
    {
          

         $list= DB::table('autosend')->where('id',$id)->first(); 
         $contactlist= DB::table('contactlist')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
         $senderids= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->first();
         
       return view('users.updateschedule',['list'=>$list,'contactlist'=>$contactlist,'sendero'=>$senderids]);
        

        

    }

    

    public function multipleupdate($id)
    {
          $listids=UserController::getListIdFromAutosend($id);
        $senderid= DB::table('senderids')->where('userID',auth()->user()->id)->get();
        $senderids= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->first();
         $lists= DB::table('autosend_list')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
        // $contactlist= DB::table('contactlist')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
            
         return view('users.updateschedulemultiple',['lists'=>$lists,'sender'=>$senderid,'listid'=>$listids,'sendero'=>$senderids]);
        

        

    }


    public static function pullsenderid()
    {
          
        $senderids= DB::table('senderids')
        ->where('userID',auth()->user()->id)
        ->where('status',2)
        ->get();
         return $senderids;
        

    }




    public function getListIdFromAutosend($id)
    {
        $list= DB::table('autosend')->where('id',$id)->first(); 
        return $list->listID;

    }


    public function scheduleupdate2($id)
    {
        $validator=$this->validate(request(),[
            
            'message'=>'required|string',
            'time'=>'required|string',
            ],
            [
                  'message.required'=>'.Please enter message you want to send',
                'time.required'=>'.Please choose the time you want the message to be sent',
                  
                
                ]);
                if(count(request()->all()) > 0){

                DB::table('autosend')->where('id', $id)->update([
                    
                  
                    'message' => request()->input('message'),
                    'sendtime' => request()->input('time')
                
                
                ]);

                $auto=DB::table('autosend')->where('id',$id)->first(); 

                DB::table('autosend_list')->where('listID', $auto->listID)->update([
                    
                   
                    'msg' => request()->input('message'),
                    'send_time' => request()->input('time'),
                    'send_timeString' => strtotime(request()->input('time'))
                ]);

                return redirect()->back()->withSuccess('Update sucessful.');
          
                }
          

    }

    public static function listname($id)
    {
        $list= DB::table('lists')->where('id',$id)->first(); 
        return $list->name;
          

    }


    public  function filtermessage(){

if(request()->input('action')==='delete'){



    if(isset($_POST['contacts'])){

        if(is_array($_POST['contacts'])) {
            foreach($_POST['contacts'] as $value){

          
            DB::table('sendmsg')->where('id',$value)->delete();

           


            }

            return redirect()->back()->withSuccess('Message deleted successfuly.');
        }else{

            DB::table('sendmsg')->where('id',$value)->delete();
            return redirect()->back()->withSuccess('Message deleted successfully.');

        }

       
       
   }else{


   return redirect()->back()->withErrors('Please select atleast one message to delete ')->withInput();
 
   }


}else{

        if(empty(request()->input('month')) || empty(request()->input('year'))){

 return redirect()->back()->withErrors('Please select month and year to filter ')->withInput();
        }else{
   $month=request()->input('month');
   $year=request()->input('year');
         
    $msgs= DB::table('sendmsg')
   ->where('month',$month)
   ->where('year',$year)
   ->paginate(10);; 

   return view('users.message_filter',['smss'=>$msgs,'filtermonth'=>$month,'filteryear'=>$year]);
        }
    }
    }



    public function userProfile()
    {
        return view('users.userProfile');
    }

    public function pricing()
    {
        return view('users.price');
    }

    public function updatePassword()
    {
        return view('profile.updatePassword');
    }

    public function createList()
    {

        if(request()->input('type')=='phonebook'){


            $lists = new lists();
            $lists->name=request()->input('title');
            $lists->type=request()->input('type');
            $lists->filter=request()->input('booktype');
            $lists->userID=auth()->user()->id;
            $lists->save();


        }else{

            $lists = new lists();
            $lists->name=request()->input('title');
            $lists->type=request()->input('type');
            $lists->filter="";
            $lists->userID=auth()->user()->id;
            $lists->save();
       
       
        }
 return redirect()->back()->withSuccess('New list created successfully');

    }


    public function createAnniversary()
    {

        $anniversary = new anniversary();
        $anniversary->name=request()->input('name');
        $anniversary->listID=request()->input('listid');
        $anniversary->save();
        return redirect()->back()->withSuccess('Anniversary created successfully');

    }


    public function deleteList($id)
    {

        $resources = DB::delete('delete from lists where id='.$id);
       // $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
        return redirect()->back();

    }

    public function deleteContact($id)
    {

        $resources = DB::delete('delete from contactlist where id='.$id);
       // $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
        return redirect()->back();

    }

    public function deleteContactname($id)
    {

        $resources = DB::delete('delete from phonenamelist where id='.$id);
       // $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
       return redirect()->back()->withSuccess('phone number deleted successfully');
    }


    public static function anniversaryname($id)
    {
        $list= DB::table('anniversary')->where('id',$id)->first(); 
        return $list->name;
          

    }

    public function deleteAnniversary($id,$list)
    {

        
        
        $annlist = DB::delete('delete from anniversarylist where anniversary="'.$this->anniversaryname($id).'" and listID='.$list);
        $ann = DB::delete('delete from anniversary where id='.$id);
        return redirect()->back()->withSuccess('Anniversary deleted successfully');

    }
    
    public function deleteanniversarylist($id)
    {

        $resources = DB::delete('delete from anniversarylist where id='.$id);
        return redirect()->back()->withSuccess('Contact deleted successfully');

    }



    public function deletecontactphone($id)
    {

        $resources = DB::delete('delete from phoneonly where listID='.$id);
        return redirect()->back()->withSuccess('Contact list deleted successfully');

    }


    public static function showvariedImage($number,$list,$message){
$output="";
        $sms= DB::table('sendmsg')
        ->where('phone', $number)
        ->where('listID', $list)
        ->where('message', $message)
        ->first();

        if( $sms->count()<1){
            $output=0;

        }

       else if( $sms->status==0){

        $output=1 ; 
        }

        else if( $sms->status==1){
            $output=2;
            
        }

        return $output;
    }


    public function deleteschedulesms($id)
    {

        $resources = DB::delete('delete from phone_schedule_sms where id='.$id);
        $resources = DB::delete('delete from auto_send_phone_name where autosmsID='.$id);
        return redirect()->back()->withSuccess('SMS deleted successfully');

    }


    public function anniversaryexc($list,$ann,$annid){

        $month=Carbon::now()->format('M');
        $day=Carbon::now()->format('d');
        $tomorrow=Carbon::now()->addHours(24)->format('d');

        $listsx= DB::table('lists')
         ->where('id', $list)
         ->first();
         
         $todayAnn= DB::table('anniversarylist')
         ->where('listID',$list)
         ->where('annmonth',$month)
         ->where('annday',$day)
         ->get();

         $tomorrowAnn= DB::table('anniversarylist')
         ->where('listID',$list)
         ->where('annmonth',$month)
         ->where('annday',$tomorrow)
         ->get();

         $monthAnn= DB::table('anniversarylist')
         ->where('listID',$list)
         ->where('annmonth',$month)
         ->get();

         return view('users.anniversaryEx',['lists'=>$listsx,'todayanniversary'=>$todayAnn],['tomorrowanniversary'=>$tomorrowAnn,'monthanniversary'=>$monthAnn,'anns'=>$ann,'annids'=>$annid]);
     
    }


    public function listDetail($id,$type)    
    {

        $month=Carbon::now()->format('M');
        $day=Carbon::now()->format('d');
        $tomorrow=Carbon::now()->addHours(24)->format('d');

        $anniversary= DB::table('anniversary')
        ->where('listID', $id)
        ->get(); 

 
         $list= DB::table('lists')
         ->where('userID', auth()->user()->id)
         ->where('id', $id)
         ->first(); 
 
          $contactlist= DB::table('contactlist')
          ->where('listID', $id)
          ->get(); 

          $anniversarylist= DB::table('anniversarylist')
          ->where('listID', $id)
          ->get(); 
 
          $todayBirth= DB::table('contactlist')
          ->where('listID',$id)
          ->where('birthMonth',$month)
          ->where('birthDay',$day)
          ->get();
 
          $tomorrowBirth= DB::table('contactlist')
          ->where('listID',$id)
          ->where('birthMonth',$month)
          ->where('birthDay',$tomorrow)
          ->get();

      if($type=='birthday'){

        return view('users.listDetail',['lists'=>$list,'birthcount'=>$todayBirth,'tomorrowbirthcount'=>$tomorrowBirth],['contactlists'=>$contactlist]);
      
    }
    if($type=='phonebook'){

        if($list->filter==1){

            $contactlist= DB::table('phonenamelist')->where('listID', $id)->get(); 
        return view('users.name_phone_only',['lists'=>$id,'listsname'=>$list->name,'contactlists'=>$contactlist]);

        }
        else if($list->filter==2){

            $contactlist= DB::table('phoneonly')->where('listID', $id)->get(); 
            $countcontactlist= DB::table('phoneonly')->where('listID', $id)->get(); 
            return view('users.phone_only',['lists'=>$id,'listsname'=>$list->name,'contactlists'=>$contactlist,'countphone'=>$countcontactlist->count()]);

        }

       
      
    }
    else{

        return view('users.otherAnniversary',['lists'=>$list,'anniversaries'=>$anniversary],['contactlists'=>$anniversarylist]);
     



      }
    }


    public function phone_name($id){

       
        $contactlist= DB::table('phonenamelist')->where('listID', $id)->get(); 
        return view('users.name_phone_only',['lists'=>$id,'contactlists'=>$contactlist]);
    }

    public function phone_only($id){

        $phone_only = new phone_only();
        $phone_only->title=request()->input('title');
        $phone_only->numbers=request()->input('numbers');
        $phone_only->listID=$id;
        $phone_only->save();


        return redirect()->back()->withSuccess('Contact list created succesfully');
    }

    public function phone_update($id){

        $upinfo=DB::table('phoneonly')->where('listID',$id)->update(['title' =>request()->input('title'),'numbers'=>request()->input('numbers')]);
        return redirect()->back()->withSuccess('Contact updated successfully');

    }

    public function phone_edit($id){

        $contactlist= DB::table('phoneonly')->where('listID', $id)->get();
        return view('users.edit_phone',['lists'=>$id,'contactlists'=>$contactlist,'listname'=>$this->listname($id)]);

    }



    public function todayBirthday($id)
    {
        $month=Carbon::now()->format('M');
       $day=Carbon::now()->format('d');
       $tomorrow=Carbon::now()->addHours(24)->format('d');

        $list= DB::table('lists')
        ->where('userID', auth()->user()->id)
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('contactlist')
         ->where('listID', $id)
         ->where('birthMonth', $month)
         ->where('birthDay', $day)
         ->get();

         
      return view('users.todayBirthday',['lists'=>$list],['contactlists'=>$contactlist]);

    }


    public function tomorrowBirthday($id)
    {

        $month=Carbon::now()->format('M');
        $tomorrow=Carbon::now()->addHours(24)->format('d');

        $list= DB::table('lists')
        ->where('userID', auth()->user()->id)
        ->where('id', $id)
        ->first(); 

         $contactlist=  DB::table('contactlist')
         ->where('listID', $id)
         ->where('birthMonth', $month)
         ->where('birthDay', $tomorrow)
         ->get();

        return view('users.tomorrowBirthday',['lists'=>$list],['contactlists'=>$contactlist]);

    }

    public function todayannivlist($listID,$ann,$annid)
    {

       $month=Carbon::now()->format('M');
       $day=Carbon::now()->format('d');
      

        $list= DB::table('lists')
        ->where('id', $listID)
        ->first(); 

        $annlist=  DB::table('anniversarylist')
        ->where('anniversary', $ann)
        ->where('annmonth', $month)
        ->where('annday', $day)
        ->where('listID', $listID)
        ->get();
         
      
         return view('users.todayAnniversary',['lists'=>$list,'contactlists'=>$annlist,'anns'=>$ann,'annids'=>$annid]);

    }

    public function tomorrowannivlist($listID,$ann,$annid)
    {

       $month=Carbon::now()->format('M');
       $tomorrow=Carbon::now()->addHours(24)->format('d');
      

        $list= DB::table('lists')
        ->where('id', $listID)
        ->first(); 

        $annlist=  DB::table('anniversarylist')
        ->where('anniversary', $ann)
        ->where('annmonth', $month)
        ->where('annday', $tomorrow)
        ->where('listID', $listID)
        ->get();
         
      
         return view('users.tomorrowAnniversary',['lists'=>$list,'contactlists'=>$annlist,'anns'=>$ann,'annids'=>$annid]);

    }



    public function addContact($id)
    {

        $contactlist = new contactlist();
        $contactlist->firstName=request()->input('firstname');
        $contactlist->lastName=request()->input('lastname');
        $contactlist->birthmonth=request()->input('birthmonth');
        $contactlist->birthday=request()->input('birthday');
        $contactlist->phone=request()->input('phone');
        $contactlist->remarks=request()->input('remark');
        $contactlist->listID=$id;
        $contactlist->save();

        return redirect()->back();
    


    }

    

    public function sentMessages()
    {

       // $list= DB::table('lists')
       // ->where('id', $id)
       // ->first(); 

        $message= DB::table('sendmsg')
       ->where('userID', auth()->user()->id)
       ->orderBy('created_at','desc')
       ->paginate(10); 
       return view('users.sent_messages',['smss'=>$message]);


    }


    public function celebByMonth($id)
    {

        $list= DB::table('lists')
        ->where('userID', auth()->user()->id)
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('contactlist')
         ->where('listID', $id)
         ->get(); 
        return view('users.celebrantsByMonths',['lists'=>$list],['contactlists'=>$contactlist]);


    }

    public function anniversaryByMonth($id,$ann,$annid)
    {

        $list= DB::table('lists')
        ->where('userID', auth()->user()->id)
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('anniversarylist')
         ->where('listID', $id)
         ->where('anniversary',$ann)
         ->get(); 

       return view('users.anniversaryByMonths',['lists'=>$list,'anns'=>$ann,'annids'=>$annid],['contactlists'=>$contactlist]);


    }

    public static function permonth($listID,$month)
    {

        $listrows= DB::table('contactlist')
        ->where('listID', $listID)
        ->where('birthMonth', $month)
        ->get(); 

        
        return $listrows;


    }

    public static function annpermonth($listID,$month,$ann)
    {

        $listrows= DB::table('anniversarylist')
        ->where('listID', $listID)
        ->where('annmonth', $month)
        ->where('anniversary',$ann)
        ->get(); 

        
        return $listrows;


    }


    public static function anniversaryCount($anniversary,$list)
    {

        $rows= DB::table('anniversarylist')
        ->where('anniversary', $anniversary)
        ->where('listID', $list)
        ->get(); 

        
        return $rows->count();


    }

    public static function autostatus($id)
    {
        $output="";
        $listrows= DB::table('autosend')
        ->where('listID', $id)
        ->first();

        if(isset($listrows)){
       

        $output.=1;

       
    }
    else{

        $output.="";  
    }
        return $output;

    }


    public static function fullmonth($month)
    {
        $fullmonth="";
        if($month=='Jan'){

        $fullmonth="January";

        }

        if($month=='Feb'){

            $fullmonth="February";
    
            }


        if($month=='Mar'){

                $fullmonth="March";
        
                }

        if($month=='Apr'){

                    $fullmonth="April";
            
                    }

        if($month=='May'){

                        $fullmonth="May";
                
                        }

        if($month=='Jun'){

                            $fullmonth=="June";
                    
                            }

         if($month=='Jul'){

                                $fullmonth="July";
                        
                                }

        if($month=='Aug'){

                                    $fullmonth="August";
                            
                                    }

        if($month=='Sep'){

                                        $fullmonth="September";
                                
                                        }

        if($month=='Oct'){

                                            $fullmonth="October";
                                    
                                            }

        if($month=='Nov'){

                                                $fullmonth="November";
                                        
                                                }

        if($month=='Dec'){

                                                    $fullmonth="December";
                                            
                                                    }

        
        return $fullmonth;


    }





    public function autosms(Request $request){
        switch ($request->input('action')) {
            case 'activate':

                $validator=$this->validate(request(),[
                    'senderid'=>'required|string',
                    'message'=>'required|string',
                    'time'=>'required|string',
                    ],
                    [
                        'senderid.required'=>'.Please type in name you  want celebrants to see as the sender ',
                        'message.required'=>'.Please enter message you want to send',
                        'time.required'=>'.Please choose the time you want the message to be sent',
                          
                        
                        ]);
        
                        if(count(request()->all()) > 0){
                
    
                if(isset($_POST['listid'])){


                    if (is_array($_POST['listid'])) {
                        foreach($_POST['listid'] as $value){

                        $autosend = new autosend();
                        $autosend->userID=auth()->user()->id;
                        $autosend->listID=$value;
                        $autosend->senderID=request()->input('senderid');
                        $autosend->message=request()->input('message');
                        $autosend->sendtime=request()->input('time');
                        $autosend->sendtype='single';
                            if($autosend->save()){



                                $list= DB::table('contactlist')
                                ->where('listID', $value)
                                ->get(); 

                             foreach($list as $row){

                            $autosendlist = new autosendlist();
                            $autosendlist->userID=auth()->user()->id;
                            $autosendlist->listID=$value;
                            $autosendlist->senderID=request()->input('senderid');
                            $autosendlist->msg=request()->input('message');
                            $autosendlist->reciever=$row->phone;
                            $autosendlist->reciever_name=ucwords($row->firstName).' '.ucwords($row->lastName);
                            $autosendlist->birthDay=$row->birthDay;
                            $autosendlist->birthMonth=$row->birthMonth;
                            $autosendlist->send_time=request()->input('time');
                            $autosendlist->birthMonthString=strtotime($row->birthMonth);
                            $autosendlist->send_timeString=strtotime(request()->input('time'));
                            $autosendlist->save();
                            
                        
                        }

                        return redirect()->back()->withSuccess('Auto send SMS has been activated for list successfuly.');
                           
                        }
                        }
   
                       
   
                     } else {

                        $autosend = new autosend();
                        $autosend->userID=auth()->user()->id;
                        $autosend->listID=$value;
                        $autosend->senderID=request()->input('senderid');
                        $autosend->message=request()->input('message');
                        $autosend->sendtime=request()->input('time');
                        $autosend->sendtype='single';
                        if($autosend->save()){



                            $list= DB::table('contactlist')
                            ->where('listID', $value)
                            ->get(); 

                         foreach($list as $row){

                        $autosendlist = new autosendlist();
                        $autosendlist->userID=auth()->user()->id;
                        $autosendlist->listID=$value;
                        $autosendlist->senderID=request()->input('senderid');
                        $autosendlist->msg=request()->input('message');
                        $autosendlist->reciever=$row->phone;
                        $autosendlist->reciever_name=ucwords($row->firstName);
                        $autosendlist->birthDay=$row->birthDay;
                        $autosendlist->birthMonth=$row->birthMonth;
                        $autosendlist->send_time=request()->input('time');
                        $autosendlist->birthMonthString=strtotime($row->birthMonth);
                        $autosendlist->send_timeString=strtotime(request()->input('time'));
                        $autosendlist->save();
                        
                    
                    }

                    return redirect()->back()->withSuccess('Auto send SMS has been activated for list successfuly.');
                       
                    }  }


                    
               }else{
    
    
                return redirect()->back()->withErrors('Please scroll down and check the list you want to automate ')->withInput();
               }
    
                       
            }
    
                break;
    
            case 'deactivate':
                
                if(isset($_POST['listid'])){

                    if(is_array($_POST['listid'])) {
                        foreach($_POST['listid'] as $value){

                        DB::table('autosend_list')->where('listID',$value)->delete();
                        DB::table('autosend')->where('listID',$value)->delete();

                        return redirect()->back()->withSuccess('list deactivated succesfuly.');


                        }
                    }else{

                        DB::table('autosend_list')->where('listID',$value)->delete();
                        DB::table('autosend')->where('listID',$value)->delete();
                        return redirect()->back()->withSuccess('list deactivated succesfuly.');

                    }

                   
                   
               }else{
    
    
               return redirect()->back()->withErrors('Please scroll down and check the list you want to deactivate ')->withInput();
             
               }
    
    
                break;
    
            
        }
    }









    public function monthExtract($month,$listID)
    {

        $list= DB::table('lists')
        ->where('id', $listID)
       ->first(); 

       $contactlist= DB::table('contactlist')
       ->where('birthMonth', $month)
       ->where('listID', $listID)
        ->get(); 

      
      return view('users.extractMonth',['lists'=>$list,'month'=>$month],['contactlists'=>$contactlist]);


    }

    public function annmonthExtract($month,$listID,$ann,$annid)
    {

        $list= DB::table('lists')
        ->where('id', $listID)
       ->first(); 

       $contactlist= DB::table('anniversarylist')
       ->where('annmonth', $month)
       ->where('listID', $listID)
       ->where('anniversary', $ann)
        ->get(); 

      
      return view('admin.annextractMonth',['lists'=>$list,'month'=>$month,'anns'=>$ann,'annids'=>$annid],['contactlists'=>$contactlist]);


    }

    public function smstocontacts3(){

        $validator=$this->validate(request(),[
            'senderid'=>'required|string',
            'message'=>'required|string',
            ],
            [
                'senderid.required'=>'.Please type in name you  want celebrants to see as the sender ',
                'message.required'=>'.Please enter message you want to send',
                  
                
                ]);

                if(count(request()->all()) > 0){

        if(isset($_POST['contacts'])){ 
            

            $input =request()->all();  
            $condition = $input['contacts'];
            foreach ($condition as $key => $condition) {
                
              $response=$this->CURLsendsms($input['contacts'][$key],request()->input('message'),request()->input('senderid'));
              $sentmsg = new sendmsg();
              $sentmsg ->userID=auth()->user()->id;
              $sentmsg ->name=$input['name'][$key];
              $sentmsg ->phone=$input['contacts'][$key];
              $sentmsg ->listID=request()->input('listid');
              $sentmsg ->senderID=request()->input('senderid');
              $sentmsg ->message=request()->input('message');
              $sentmsg ->status=$response;
              $sentmsg ->year=Carbon::now()->format('Y');
              $sentmsg ->month=Carbon::now()->format('M');
              $sentmsg ->day=Carbon::now()->format('d');
              $sentmsg ->time=date('H:i:s');
              $sentmsg ->save();
          
            }

            return redirect()->back()->withSuccess('SMS sent succesfully.');

           // $senderid=request()->input('senderid');
           // $message=request()->input('message');
           // $mobile=$_POST['contacts'];
           // $mobileNumbers= implode('',$mobile);
           // $arr=str_split($mobileNumbers,'12');
           // $numbers=implode(',',$arr);
           // print_r($numbers);
           // echo $message;
           // echo $senderid;
            
       }else{


        return redirect()->back()->withErrors('Please scroll down and check atleast one contact to send message to')->withInput();
       }

       
    }
    }



    public static function CURLsendsms($phone,$message,$senderid){ 
 
         $msg=urlencode(ucwords($message));
		 $url='https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=ZR3eJEIlCdsHh3mcchZy38OX20qNzlpyklN4ZfBTjbNgQZTRZ0yJiwzaOqX2&from='.urlencode($senderid).'&to='.urlencode($phone).'&body='.$msg.'&dnd=2';
         $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, TRUE);
            curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		    curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch); 
		
        // $response = json_decode($url, true);
        return $httpCode; 
 

       

    }




    public function smstocontacts2(){

        $validator=$this->validate(request(),[
            'senderid'=>'required|string',
            'message'=>'required|string',
            ],
            [
                'senderid.required'=>'.Please type in name you  want celebrants to see as the sender ',
                'message.required'=>'.Please enter message you want to send',
                  
                
                ]);

                if(count(request()->all()) > 0){

        if(isset($_POST['contacts'])){ 
            
            $senderid=request()->input('senderid');
            $message=request()->input('message');
            $mobile=$_POST['contacts'];
            $mobileNumbers= implode('',$mobile);
            $arr=str_split($mobileNumbers,'12');
            $numbers=implode(',',$arr);
            print_r($numbers);
            echo $message;
            echo $senderid;
            
       }else{


        return redirect()->back()->withErrors('Please scroll down and check atleast one contact to send message to')->withInput();
       }

       
    }
    }


    public function smstocontactsphone(){

        $validator=$this->validate(request(),[
            'senderid'=>'required|string',
            'message'=>'required|string',
            ],
            [
                'senderid.required'=>'.Please type in name you  want celebrants to see as the sender ',
                'message.required'=>'.Please enter message you want to send',
                  
                
                ]);

                if(count(request()->all()) > 0){

        if(isset($_POST['ids'])){ 
            
           // $senderid=request()->input('senderid');
           // $message=request()->input('message');
           // $mobile=$_POST['contacts'];
           
            $numbers = explode(",", request()->input('numbers'));
            foreach($numbers as $number){


                $response=$this->CURLsendsms($number,request()->input('message'),request()->input('senderid'));
                $sentmsg = new sendmsg();
                $sentmsg ->userID=auth()->user()->id;
                $sentmsg ->name=$number;
                $sentmsg ->phone=$number;
                $sentmsg ->listID=request()->input('listid');
                $sentmsg ->senderID=request()->input('senderid');
                $sentmsg ->message=request()->input('message');
                $sentmsg ->status=$response;
                $sentmsg ->year=Carbon::now()->format('Y');
                $sentmsg ->month=Carbon::now()->format('M');
                $sentmsg ->day=Carbon::now()->format('d');
                $sentmsg ->time=date('H:i:s');
                $sentmsg ->save();
            }
            return redirect()->back()->withSuccess('SMS sent successfully.');
            
       }else{


        return redirect()->back()->withErrors('Please scroll down and check the contact list to send SMS to')->withInput();
       }

       
    }
    }


    public function create_contact_list(){

        $fieldsx=DB::table('form_'.auth()->user()->id)->get(); 
        return view('users.create_contact_list',['fields'=> $fieldsx]);

    }

public function create_phone_list(){


    $validator=$this->validate(request(),[
        'listname'=>'required|string',
        ],
        [
            'listname.required'=>'Please ensure you include the name of the contact list',
            
              
            
            ]);

            if(count(request()->all()) > 0){

                $listsid="";

                $names=request()->input('names');
                $phones=request()->input('phones');


    $lists = new lists();
    $lists->name=request()->input('listname');
    $lists->type='phonebook';
    $lists->filter='1';
    $lists->userID=auth()->user()->id;
    $lists->save();

    $listsid=$lists->id;

    $allrecords= DB::table('form_'.auth()->user()->id.'_store')->get();
    foreach($allrecords as $allrecord){

        $phonenamelist = new phonenamelist();
        $phonenamelist->name=$allrecord->$names;
        $phonenamelist->phone=$allrecord->$phones;
        $phonenamelist->listID=$lists->id;
        $phonenamelist->save();


    }

    return redirect('users/list_created/'.$listsid);
            }
    
    

}

public function export($id) 
    {
        $list= DB::table('form_track')->where('table_id',$this->encrypt_decrypt($id,false))->first(); 
        return Excel::download(new ResponseExport($this->encrypt_decrypt($id,false)),$list->niche.'EmailList.xlsx');
    }


public function listcreated($id){


    return view('users.done_create_con_list',['list'=>$this->listname($id),'listid'=>$id]);


}

    public function smstocontacts(){

        $validator=$this->validate(request(),[
            'senderid'=>'required|string',
            'message'=>'required|string',
            ],
            [
                'senderid.required'=>'.Please type in name you  want celebrants to see as the sender ',
                'message.required'=>'.Please enter message you want to send',
                  
                
                ]);

                if(count(request()->all()) > 0){

        if(isset($_POST['contacts'])){ 
            
            $senderid=request()->input('senderid');
            $message=request()->input('message');
            $mobile=$_POST['contacts'];
            $mobileNumbers= implode('',$mobile);
            $arr=str_split($mobileNumbers,'12');
            $numbers=implode(',',$arr);
            print_r($numbers);
            echo $message;
            echo $senderid;
            
       }else{


        return redirect()->back()->withErrors('Please scroll down and check atleast one contact to send message to')->withInput();
       }

       
    }
    }


    public function multiplecontact($id)
{
    
$input =request()->all();  
$condition = $input['firstname'];
foreach ($condition as $key => $condition) {
    $contactlist = new contactlist();
                            $contactlist->firstName=$input['firstname'][$key];
                            $contactlist->lastName=$input['lastname'][$key];
                            $contactlist->birthMonth=$input['birthmonth'][$key];
                            $contactlist->birthDay=$input['birthday'][$key];
                            $contactlist->phone=$input['phone'][$key];
                            $contactlist->remarks=$input['remark'][$key];
                            $contactlist->listID=$id;
                            $contactlist->save();

    }


    return redirect()->back()->withSuccess('Contacts added succesfully.');
        
   
}


public function multiplenamecontact($id)
{
    
$input =request()->all();  
$condition = $input['name'];
foreach ($condition as $key => $condition) {
    $phonenamelist = new phonenamelist();
    $phonenamelist->phone=$input['phone'][$key];
    $phonenamelist->name=$input['name'][$key];
    $phonenamelist->listID=$id;
    $phonenamelist->save();

    }


    return redirect()->back()->withSuccess('Contacts added succesfully.');
        
   
}


public function multipleanniversary($id)
{
    
$input =request()->all();  
$condition = $input['firstname'];
foreach ($condition as $key => $condition) {
    $contactlist = new anniversarylist();
                            $contactlist->firstname=$input['firstname'][$key];
                            $contactlist->lastname=$input['lastname'][$key];
                            $contactlist->annmonth=$input['annmonth'][$key];
                            $contactlist->annday=$input['annday'][$key];
                            $contactlist->contact=$input['phone'][$key];
                            $contactlist->anniversary=$input['anniversary'][$key];
                            $contactlist->listID=$id;
                            $contactlist->save();

    }


    return redirect()->back()->withSuccess('Contacts added succesfully.');
        
   
}

public function autosendtype(Request $request)
{

if($request->input('autotype')=="1"){

    $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
    return view('users.scheduler',['lists'=>$list]);

}
if($request->input('autotype')=="2"){
    $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
    
    return view('users.multiplemessage',['lists'=>$list]);
}

if($request->input('autotype')=="3"){
    $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
    
    return view('users.multiplemessage',['lists'=>$list]);
}
        
   
}

public function listcontacts($id,$type)
    {
        $list= DB::table('lists')->where('id', $id)->first(); 
        

        if($type=='birthday'){
            $contactlist= DB::table('contactlist')->where('listID', $id)->get();
           
            return view('users.list_contacts',['lists'=>$list],['contactlists'=>$contactlist]);
        }
        else if($type=='other'){

            $contactlist= DB::table('anniversarylist')->where('listID', $id)->get();
            return view('users.list_contacts_other',['lists'=>$list],['contactlists'=>$contactlist]);
      
        }

        else if($type=='phonebook'){

            // this will display the listname, listid and count of contacts in the list

            if($list->filter==1){
                $contactlistx= DB::table('phonenamelist')->where('listID', $id)->get();
                $smsx= DB::table('phone_schedule_sms')->where('listID', $id)->get();
               
                return view('users.auto_name_phone',['lists'=>$list,'contactlists'=>$contactlistx,'smss'=> $smsx]);
        

            }
           else if($list->filter==2){

            $contactlistx= DB::table('phoneonly')->where('listID', $id)->first();
            $smsx= DB::table('phone_schedule_sms')->where('listID', $id)->get();
            return view('users.auto_phone',['lists'=>$list,'contactlists'=>$contactlistx,'smss'=> $smsx]);
        
                
            }

      
        }
       
    }


    public function nameschedulesms($id){

        

        $sendtime=request()->input('sendTime')." ".request()->input('sendPeriod');

        $updatepsms=DB::table('phone_schedule_sms')->where('id',request()->input('smsid'))->update(['senderID' =>request()->input('senderid'), 'sendDate' => request()->input('sendDate'),'sendTime' => $sendtime, 'sendDateString' => strtotime(request()->input('sendDate')),'sendTimeString' => strtotime($sendtime),'sms' => request()->input('message')]);
        $updatepsms2=DB::table('auto_send_phone_name')->where('autosmsID',request()->input('smsid'))->update(['senderID' =>request()->input('senderid'), 'sendDate' => request()->input('sendDate'),'sendTime' => $sendtime, 'sendDateString' => strtotime(request()->input('sendDate')),'sendTimeString' => strtotime($sendtime),'sms' => request()->input('message')]);
       
        return redirect()->back()->withSuccess('Update sucessful');

    }


    public function schedulesms2($id){

        $lastid="";
        $send= DB::table('autosend')
        ->where('userID', auth()->user()->id)
        ->where('listID', $id)
        ->get(); 


        $sms= new phone_schedule_sms();
    $sms->senderID=request()->input('senderid');
    $sms->sendDate=request()->input('sendDate');
    $sms->sendTime=request()->input('sendTime').request()->input('sendPeriod');
    $sms->sendDateString=strtotime(request()->input('sendDate'));
    $sms->sendTimeString=strtotime(request()->input('sendTime').request()->input('sendPeriod'));
    $sms->sms=request()->input('message');
    $sms->listID=$id;
    $sms->status=0;
    $sms->save();

    $lastid=$sms->id;


        $phonenames= DB::table('phoneonly')
        ->where('listID', $id)
        ->first(); 
        
        foreach(explode(',', $phonenames->numbers) as $phonename){


        $sms= new auto_send_phone_name();
        $sms->senderID=request()->input('senderid');
        $sms->sendDate=request()->input('sendDate');
        $sms->sendTime=request()->input('sendTime').request()->input('sendPeriod');
        $sms->sendDateString=strtotime(request()->input('sendDate'));
        $sms->sendTimeString=strtotime(request()->input('sendTime').request()->input('sendPeriod'));
        $sms->sms=request()->input('message');
        $sms->name=$phonename;
        $sms->phone=$phonename;
        $sms->listID=$id;
        $sms->userID=auth()->user()->id;
        $sms->autosmsID=$lastid;
        $sms->save();

    }

    

if($send->count()<1){
        $autosend = new autosend();
        $autosend->userID=auth()->user()->id;
        $autosend->listID=$id;
        $autosend->senderID=request()->input('senderid');
        $autosend->message="message";
        $autosend->sendtime=request()->input('sendTime').request()->input('sendPeriod');
        $autosend->sendtype='phonebook';
        $autosend->save();
}
        return redirect()->back()->withSuccess('SMS Scheduled successfully');

    }



    public function schedulesms($id){

        $lastid="";
        $send= DB::table('autosend')
        ->where('userID', auth()->user()->id)
        ->where('listID', $id)
        ->get(); 


        $sms= new phone_schedule_sms();
    $sms->senderID=request()->input('senderid');
    $sms->sendDate=request()->input('sendDate');
    $sms->sendTime=request()->input('sendTime').request()->input('sendPeriod');
    $sms->sendDateString=strtotime(request()->input('sendDate'));
    $sms->sendTimeString=strtotime(request()->input('sendTime').request()->input('sendPeriod'));
    $sms->sms=request()->input('message');
    $sms->listID=$id;
    $sms->status=0;
    $sms->save();

    $lastid=$sms->id;


        $phonenames= DB::table('phonenamelist')
        ->where('listID', $id)
        ->get(); 
        
        foreach($phonenames as $phonename){


        $sms= new auto_send_phone_name();
        $sms->senderID=request()->input('senderid');
        $sms->sendDate=request()->input('sendDate');
        $sms->sendTime=request()->input('sendTime').request()->input('sendPeriod');
        $sms->sendDateString=strtotime(request()->input('sendDate'));
        $sms->sendTimeString=strtotime(request()->input('sendTime').request()->input('sendPeriod'));
        $sms->sms=request()->input('message');
        $sms->name=$phonename->name;
        $sms->phone=$phonename->phone;
        $sms->listID=$id;
        $sms->userID=auth()->user()->id;
        $sms->autosmsID=$lastid;
        $sms->save();

    }

    

if($send->count()<1){
        $autosend = new autosend();
        $autosend->userID=auth()->user()->id;
        $autosend->listID=$id;
        $autosend->senderID=request()->input('senderid');
        $autosend->message="message";
        $autosend->sendtime=request()->input('sendTime').request()->input('sendPeriod');
        $autosend->sendtype='phonebook';
        $autosend->save();
}
        return redirect()->back()->withSuccess('SMS Scheduled successfully');

    }


    public static function smsstatus($id,$date,$stime){
        $output="";
        $list= DB::table('phone_schedule_sms')->where('id', $id)->first(); 
        $time=$date." ".$stime;
        $todayTime=date("Y-m-d H:m");

        $strtime=strtotime($time);
        $strtimetoday=strtotime($todayTime);

        $date = new DateTime($date);
        $now = new DateTime();
       
      if($strtime>$strtimetoday && $list->status==0){
        $output=0;

      }
      if($list->status==1){

        $output=1;
    }

    if($strtime<$strtimetoday && $list->status==0){

        $output=2;
    }

    return  $output; 
    }
   
    public static function pullcontact($id)
 {
    
    $contact= DB::table('contactlist')->where('id', $id)->first(); 
    return response()->json($contact);
        
   
 }

 public static function pullinterface($id)
 {
    
    $detail= DB::table('interface_list')->where('id', $id)->first(); 
    return response()->json($detail);
        
   
 }

 public static function pullimagerow($id)
 {
    
    $detail= DB::table('content_type')->where('div_id', $id)->first(); 
    return response()->json($detail);
        
   
 }


 public static function pullrowbutton($id)
 {
    
    $contents= DB::table('content_type')->where('div_id', $id)->first(); 
    $buttons= DB::table('buttons')->where('id', $contents->source)->first(); 
    return response()->json($buttons);
        
   
 }


 public static function pullsms($id)
 {
    
    $auto= DB::table('phone_schedule_sms')->where('id', $id)->first(); 
    return response()->json($auto);
        
   
 }

 public static function  pullanniversary($id)
 {
    
    $contact= DB::table('anniversarylist')->where('id', $id)->first(); 
    return response()->json($contact);
        
   
 }

 public static function listAnniversary($id)
 {
    
    $anns= DB::table('anniversary')->where('listID', $id)->get(); 
    return $anns;
        
   
 }

 
 public static function states()
 {
    
    $states= DB::table('states')->get(); 
    foreach($states as $state){

echo '<option>'. $state->states_name.'</option>';

    }
    
        
   
 }

 public static function states2()
 {
    $output="";
    $states= DB::table('states')->get(); 
    foreach($states as $state){

        $output.='<option value="'.$state->states_id.'">'. $state->states_name.'</option>';

    }
    
   return $output;     
   
 }


 public function get_state_name($id){
        
$output='';

$states= DB::table('states')->where('state_id', $id)
->get(); 
foreach($states as $state){

    $output.= $state->states_name;

}

    
    return $output;
}  


public static function fieldValue($value,$value2){

return $value->$value2;
}



public function submitinfoupdate()
 {
   
    $validator=$this->validate(request(),[
        'brand_name'=>'required|string',
        'about_business'=>'required|string',
        'email'=>'required|string',
        ],
        [
            'brand_name.required'=>'Enter your brand or business name ',
            'about_business.required'=>'Provide business information',
            'email.required'=>'Select the type of usage',
              
            
            ]);

            if(count(request()->all()) > 0){

                $category  = request()->input('category');
                $category = implode(',', $category);

            $input = request()->except('category');
            //Assign the "mutated" news value to $input
            $input['category'] = $category;

                $user_info = new user_info();
                $user_info->userID=auth()->user()->id;
                $user_info->brand_name=request()->input('brand_name');
                $user_info->business_area= $input['category'];
                $user_info->business_email=request()->input('email');
                $user_info->about_business=request()->input('about_business');
                $user_info->save();

                //return view('users.upload_logo');
                return redirect('users/uploadlogo');

            } 
        
   
 }


 public function submitinfo()
 {
    $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $validator=$this->validate(request(),[
        'brand_name'=>'required|string',
        'about_business'=>'required|string',
        'email'=>'required|string',
        ],
        [
            'brand_name.required'=>'Enter your brand or business name ',
            'about_business.required'=>'Provide business information',
            'email.required'=>'Select the type of usage',
              
            
            ]);

            if(count(request()->all()) > 0){

                $category  = request()->input('category');
                $category = implode(',', $category);

            $input = request()->except('category');
            //Assign the "mutated" news value to $input
            $input['category'] = $category;

                $user_info = new user_info();
                $user_info->userID=auth()->user()->id;
                $user_info->brand_name=request()->input('brand_name');
                $user_info->business_area= $input['category'];
                $user_info->business_email=request()->input('email');
                $user_info->about_business=request()->input('about_business');
                $user_info->subdomain=str_replace($symbols,'-',Str::lower(request()->input('brand_name')));
                $user_info->save();

                //return view('users.upload_logo');
                return redirect('users/uploadlogo');

            } 
        
   
 }


 public function uploadlogo()
 {
     
     return view('users.upload_logo');

 }

 public function  profilesubmit()
 {
   
    $symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
    $replacement=array('-');// you can enter more replacements.

    $validator=$this->validate(request(),[
        'business_name'=>'required|string',
        'about_business'=>'required|string',
        'business_email'=>'required|string',
        ],
        [
            'business_name.required'=>'Enter your brand or business name ',
            'about_business.required'=>'Provide business information',
            'business_email.required'=>'Select the type of usage',
              
            
            ]);


            if(count(request()->all()) > 0){

               

                $category  = request()->input('category');
                $category = implode(',', $category);

            $input = request()->except('category');
            //Assign the "mutated" news value to $input
            $input['category'] = $category;



                $updateprofile=DB::table('users_info')->where('userID',auth()->user()->id)->update(['brand_name' =>request()->input('business_name'), 'business_email' => request()->input('business_email'),'business_area' => $input['category'],'about_business' => request()->input('about_business'),'subdomain' =>str_replace($symbols,'-',Str::lower(request()->input('business_name')))]);
    
               return redirect()->back()->withSuccess('Profile Updated successfully');

            } 
        
   
 }



 public static function pulllistdetail($id)
 {
    
    $list= DB::table('lists')->where('id', $id)->first(); 
    return response()->json($list);
        
   
 }


 public static function pulllfielddetail($id)
 {
    
    $field= DB::table('form_'.auth()->user()->id)->where('id', $id)->first(); 
    return response()->json($field);
        
   
 }

 public static function submitconfirmsms($id)
 {
    
    $field= DB::table('form_'.auth()->user()->id)->where('id', $id)->first(); 
    return response()->json($field);
        
   
 }


 public function editfielddetail($id,$tableid){

    $realid=$this->encrypt_decrypt($id,false);
    $realtable=$this->encrypt_decrypt($tableid,false);

    $fields= DB::table('form_'.auth()->user()->id)
    ->where('id', $realid)
    ->where('table_name', $this->get_table_name($realtable))
    ->first();
    return view('users.edit_field',['field'=>$fields,'table'=>$realtable]); 


 }


 public function editfielddetail2($id,$tableid){

    $realid=$this->encrypt_decrypt($id,false);
    $realtable=$this->encrypt_decrypt($tableid,false);

    $fields= DB::table('form_'.auth()->user()->id)
    ->where('id', $realid)
    ->where('table_name', $this->get_table_name($realtable))
    ->first();
    return view('users.editfield',['field'=>$fields,'table'=>$realtable]); 


 }

 public function updatecomfirmsms(Request $request)
 {
     $output="";  
      $sms=DB::table('sms_for_phone')->where('form','form_'.auth()->user()->id)->update(['sms' =>$request->message, 'senderID' => $request->senderid]);
              
     //$insquery="update sms_for_phone set sms='".$request->message."', senderID ='".$request->senderid."' where form='form_'".auth()->user()->id."'";
     // DB::insert( $insquery);
     
     $output='success';
     echo $output;
 }


 public function submitcomfirmsms(Request $request)
 {
     $output="";
     //$departments=DB::table('sms_for_phone')->where('id',$request->id)->update(['firstName' =>$request->firstname, 'lastName' => $request->lastname,'phone' => $request->phone,'remarks' => $request->remark,'birthMonth' => $request->month,'birthDay' => $request->day]);
                
     $insquery="insert into sms_for_phone (id,sms,form,userID,senderID,send_status) values(NULL,'".$request->message."','form_".auth()->user()->id."','".auth()->user()->id."','".$request->senderid."','1')";
     $insert = DB::insert( $insquery);
     
     $output='success';
     echo $output;
 }

 public function submitcontactupdate(Request $request)
 {
     $output="";
     $departments=DB::table('contactlist')->where('id',$request->id)->update(['firstName' =>$request->firstname, 'lastName' => $request->lastname,'phone' => $request->phone,'remarks' => $request->remark,'birthMonth' => $request->month,'birthDay' => $request->day]);
                
     $output='success';
     echo $output;
 }


 public function submitanniversaryupdate(Request $request)
 {
     $output="";
     $departments=DB::table('anniversarylist')->where('id',$request->id)->update(['firstname' =>$request->firstname, 'lastname' => $request->lastname,'contact' => $request->phone,'anniversary' => $request->anniversary,'annmonth' => $request->month,'annday' => $request->day]);
                
     $output='success';
     echo $output;
 }

 public function submitlistupdate(Request $request)
 {
     $output="";
     $departments=DB::table('lists')->where('id',$request->id)->update(['name' =>$request->title,'type' => $request->type]);
                
     $output='success';
     echo $output;
 }


 


 public function fileupload(){

    $validator=$this->validate(request(),[
            'file' => 'required|mimes:csv,txt',        
        ],
        [
           'file.required'=>'Please Upload excel file of csv format ',
            
            
            ]);


         if(count(request()->all()) > 0){

           
           
            $id=request()->input('listId');
        
            

             //////////// create data //////////////////////

            

             Excel::import(new contactlists($id),request()->file('file'));
           

             return redirect()->back()->withSuccess('Contact uploaded sucessfully');
           
           

         }




}



public function fileuploadname(){

    $validator=$this->validate(request(),[
            'file' => 'required|mimes:csv,txt',        
        ],
        [
           'file.required'=>'Please Upload excel file of csv format ',
            
            
            ]);


         if(count(request()->all()) > 0){

           
           
            $id=request()->input('listId');
        
            

             //////////// create data //////////////////////

            

             Excel::import(new phonelistname($id),request()->file('file'));
           

             return redirect()->back()->withSuccess('Contact uploaded sucessfully');
           
           

         }




}

 

 public function download($file_name,$path) {
    $file_path = public_path($path.'/'.$file_name);
    return response()->download($file_path);
    
  }

  public function file_download($file_name) 
  {


    $file_path = public_path($file_name);

    return Storage::download($file_path);
    
  }


 public static function showoptions($id)
    {
        $count=0;
        $list= DB::table('autosend')->where('listID', $id)->get(); 
        $count= $list->count();
        return $count;
    }

    public function multipleupdateinfo(){

        $input =request()->all();  
        $condition = $input['contact'];
        foreach ($condition as $key => $condition) {

            DB::table('autosend_list')->where('id', $input['contact'][$key])
            ->update(['msg' =>$input['msg'][$key], 'send_time' =>$input['sendtime'][$key]]);
        }

        return redirect()->back()->withSuccess('Infomation updated succesfully.');

    }


    public function multipleprocessmsgedit($id){



        $input =request()->all();  
        $condition = $input['contactid'];
        foreach ($condition as $key => $condition) {
           
           
            DB::table('autosend_list')->where('id',$input['contactid'][$key])->update(['msg' =>$input['msg'][$key], 'send_time' =>$input['sendtime'][$key],'senderID' =>$input['senderid']]);
       

        
            }

           
        
           
            return redirect()->back()->withSuccess('Infomation updated succesfully.');

    }

    public function multipleprocessmsg($id){



        $input =request()->all();  
        $condition = $input['contactid'];
        foreach ($condition as $key => $condition) {
           
            $autosendlist = new autosendlist();
            $autosendlist->userID=auth()->user()->id;
            $autosendlist->listID=$id;
            $autosendlist->senderID=$input['senderid'];
            $autosendlist->msg=$input['msg'][$key];
            $autosendlist->reciever=$input['phone'][$key];
            $autosendlist->reciever_name=ucwords($input['firstname'][$key]).' '.ucwords($input['lastname'][$key]);
            $autosendlist->birthDay=$input['birthday'][$key];
            $autosendlist->birthMonth=$input['birthmonth'][$key];
            $autosendlist->send_time=$input['sendtime'][$key];
            $autosendlist->birthMonthString=strtotime($input['birthmonth'][$key]);
            $autosendlist->send_timeString=strtotime($input['sendtime'][$key]);
            $autosendlist->save();

        
            }

            $autosend = new autosend();
            $autosend->userID=auth()->user()->id;
            $autosend->listID=$id;
            $autosend->senderID=$input['senderid'];
            $autosend->message="multiple";
            $autosend->sendtime=$input['sendtime'][$key];
            $autosend->sendtype='multiple';
            $autosend->save();
        
           
            return redirect('users/done_list/'.$id);

    }


  
public function howworks(){

    return view('how-it-works');
}

 
public function blogdetail($tag){
    $blog= DB::table('blog')->where('seo', $tag)->first();
    $blogs= DB::table('blog')
    ->where('category',  $blog->category)
    ->where('id','!=',  $blog->id)->get(); 
    return view('blog_detail',['blogs'=>$blogs,'bdetail'=>$blog]);


}



public function paginate(){
    $output='';
    $page_number=0;

    if (isset($_GET['pageno'])) {
        $page_number = $_GET['pageno'];
    } else {
         $page_number = 1;
    }

    $no_of_records_per_page = 2;
    $offset = ($page_number-1) * $no_of_records_per_page;

    $allblog= DB::table('blog')->get(); 
   $countrows=$allblog->count();
   $total_pages = ceil($countrows/$no_of_records_per_page);
   $to = min( ($page_number * $no_of_records_per_page), $countrows );
   $from = (($page_number * $no_of_records_per_page) - $no_of_records_per_page + 1);
   
   $previous_page = $page_number - 1;
   $next_page = $page_number + 1;

   $links="";

   if(isset($_GET['pageno']) && $_GET['pageno'] > 1){

    $links='href="?pageno='.$previous_page.'"';
   }



    if($countrows>0){

                   $output.='<ul class="pagination pagination-lg">';
                 $output.='<li class="page-item"><a class="page-link"';
                 
                 if(isset($_GET['pageno']) && $_GET['pageno'] > 1){
                    $output.='href="?pageno='.$previous_page.'"'; }
                    
                    $output.='<i class="fas fa-angle-left"></i></a></li>';

                    for($page_number = 1; $page_number<= $total_pages; $page_number++){
                        
                 $output.='<li class="page-item active"><a class="page-link" href="blog?pageno='.$page_number.'">'.$page_number.'</a></li>';
                

                    }

                 $output.='<a class="page-link"';
                 if(isset($_GET['pageno']) && $_GET['pageno'] < $total_pages){
                    
                    $output.='href="?pageno='.$next_page.'"'; 
                    
                    }
                    $output.='><i class="fas fa-angle-right"></i></a>';

                 $output.='</ul>';





                 return $output;
     }








}

public function sitemap(){
    return view('sitemap');

}

public function page(){

    $page= DB::table('landing_pages') 
    ->select('landing_pages.id','landing_pages.page_title','landing_pages.userID','landing_pages.page_description','landing_pages.created_at','page_view_count.visit_count')
    ->join('page_view_count','page_view_count.page_id','=','landing_pages.id')
    ->orderBy('landing_pages.id','desc')
    ->paginate(10);

    



    return view('pages',['pages'=>$page]);

}



public function pagefilt(){

     $output="";

     $blogs= DB::table('blog')->where('status','1')->orderBy('id','desc')->paginate(3);
     foreach($blogs as  $blog){

        $output.='<a href="#" class="text-color-default text-uppercase text-1 mb-0 d-block text-decoration-none">'.date('j F, Y', strtotime($blog->date)).'</a>'; 
        $output.='<a href="/blog/'.$blog->seo.'/" class="text-color-dark text-hover-primary font-weight-bold text-3 d-block pb-3 line-height-4">'.$blog->title.'</a>';
											
     } 


return  $output;
    

}

public static function blogcoverphoto($pageid){
$t="";
    $covers= DB::table('content_type')
    ->where('page_id', $pageid)
    ->where('type', 'image')
    ->orderBy('id','desc')
    ->paginate(1);
    
    if($covers->count()<1){

        $t= asset('/photos/placeholder-image.jpg');;

    }
    else{
foreach($covers as $cover){
    $t=$cover->source;
}
    }
return $t;

}

public function pagesearch(Request $request){

    $pagecount= DB::table('landing_pages')
    ->select('landing_pages.id','landing_pages.page_title','landing_pages.userID','landing_pages.page_description','landing_pages.created_at','page_view_count.visit_count')
    ->join('page_view_count','page_view_count.page_id','=','landing_pages.id')
   ->where('page_title', 'LIKE', "%{$request->input('search-term')}%") 
   ->orwhere('page_description', 'LIKE', "%{$request->input('search-term')}%") 
    ->get();

    $page= DB::table('landing_pages')
    ->select('landing_pages.id','landing_pages.page_title','landing_pages.userID','landing_pages.page_description','landing_pages.created_at','page_view_count.visit_count')
    ->join('page_view_count','page_view_count.page_id','=','landing_pages.id')
   ->where('page_title', 'LIKE', "%{$request->input('search-term')}%") 
   ->orwhere('page_description', 'LIKE', "%{$request->input('search-term')}%") 
   ->orderBy('landing_pages.id','desc')
   ->paginate(10);

  
  return view('search_page',['pages'=>$page,'pagecount'=>$pagecount->count()]);

}


}
