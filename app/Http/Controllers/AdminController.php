<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use App\models\lists;
use App\models\contactlist;
use App\models\category_list;
use App\models\autosendlist;
use App\models\autosend;
use App\models\senderid;
use App\models\videos;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //


    public function index()
    {
        $conlist= DB::table('lists')->get(); 
        $user= DB::table('users')->get(); 
        $msg= DB::table('sendmsg')->get();
        $id= DB::table('senderids')->get(); 
       // $conlist= DB::table('contactlist')->get(); 
        $auto= DB::table('lists')
        ->select('lists.id','lists.name','lists.userID','autosend.id','autosend.listID','autosend.created_at','autosend.sendtype')
        ->join('autosend','autosend.listID','=','lists.id')
        ->get();


        $board= DB::table('form_track')       
        ->get();  


        $optin= DB::table('interface_list')
        ->get();

        $payments= DB::table('subscriptions')
        ->get();

        $requests= DB::table('feature_request')
        ->select('feature_request.request_type','feature_request.request_summary','feature_request.created_at','users.name','feature_request.id','feature_request.request_status')
        ->join('users','users.id','=','feature_request.userID')
        ->orderBy('id','desc')
        ->get();

        return view('admin.index',['contactlist'=>$conlist,'auto'=>$auto,'users'=>$user,'msgs'=>$msg,'ids'=>$id,'boards'=>$board,'optins'=>$optin,'payments'=>$payments,'request'=>$requests]);

    }

    public function optinlist(){



        $interfacex= DB::table('interface_list')
        ->paginate(6);

        return view('admin.interface-list',['interfaces'=>$interfacex]);
       

    }

    
    public function blog(){


        return view('admin.blog');

    }

    public function articles(){

        $blog= DB::table('blog')->get(); 
        return view('admin.articles',['blogs'=>$blog]);

    }

    public function list()
    {
        $list= DB::table('lists')->get(); 
        return view('admin.list',['lists'=>$list]);

    }

    public function senderid()
    {
        $idxx= DB::table('senderids')->get(); 
        return view('admin.senderid',['ids'=>$idxx]);

    }

    public static function showusername($id)
    {
        $count=0;
        $list= DB::table('users')->where('id', $id)->first(); 
       
        return  ucwords($list->name);
    }

    public function sentMessages()
    {

       // $list= DB::table('lists')
       // ->where('id', $id)
       // ->first(); 

        $message= DB::table('sendmsg')
       ->orderBy('created_at','desc')
       ->paginate(10); 
       return view('admin.sent_messages',['smss'=>$message]);


    }




    public function userlist(){

        $user= DB::table('users')->get(); 
        return view('admin.userlist',['users'=>$user]);

    }

    public function smsdetail($id)
    {
        $smsdetail= DB::table('sendmsg')->where('id',$id)->first(); 
        return view('admin.smsdetail',['smsx'=>$smsdetail]);

    }


    public function postarticles()    
    {
        $validator=$this->validate(request(),[
            'title'=>'required|string',
            'seo'=>'required|string',
            'content'=>'required|string',
            'status'=>'required|string',
            'file'=>'required|mimes:jpeg,JPEG,png',
            'category'=>'required|string',
           
            
            
            ],
            [
                
                'title.required'=>'Enter the title of  your article ',
                'seo.required'=>'Enter the link phrase ',
                'content.required'=>'Enter the content of this article ',
                'status.required'=>'tick the status of articles',
                'file.required'=>'Upload image for this content',
                'category.required'=>'select category',
                   
                ]);
    
                if(count(request()->all()) > 0){
         
            $imgfile= request()->file('file');
            $original_filename = strtolower(trim($imgfile->getClientOriginalName()));
            $fileName =  time().rand(100,999).$original_filename;
            $filePath = 'blogphotos';
            $filePathdb = asset('/blogphotos/'.$fileName);
            $imgfile->move($filePath,$fileName);

            $seo=str_replace(' ', '-',strtolower(request()->input('seo')));
    
           
            $insquery="insert into blog (id,title,seo,content,category,status,img,date) values(NULL,'".request()->input('title')."','".$seo."','".filter_var(request()->input('content'), FILTER_SANITIZE_STRING)."','".request()->input('category')."','".request()->input('status')."','".$filePathdb ."','".date('d-m-Y')."')";
            $insert = DB::insert( $insquery);
    
    
          //  return redirect()->route('collectinfo');
        return redirect()->back()->withSuccess('Article posted succesfully.');
    
    }
    
    }




    public function deleteblog(Request $request){

        switch ($request->input('action')) {
            case 'delete':
    
    
                if(count(request()->all()) > 0){
    
                    if(isset($_POST['blog'])){
    
    
                        if (is_array($_POST['blog'])) {
                            foreach($_POST['blog'] as $value){
                                
    
                                DB::table('blog')->where('id',$value)->delete();
                               
    
                           
                            }
                        
                            return redirect()->back()->withSuccess('Record deleted succesfully');
                        
                        }
                    
                    
                    }
                            else{
    
                                return redirect()->back()->withErrors('You have not checked any record to delete')->withInput();
             
                            }
    
                }else{
    
    
    
                }

                break;

                case 'status':


                    if(count(request()->all()) > 0){
    
                        if(isset($_POST['blog'])){
        
        
                            if (is_array($_POST['blog'])) {
                                foreach($_POST['blog'] as $value){

                                    
                                    
        
                                    $insquery="update blog set status='".request()->input('activity')."' where id='".$value."'";
                                    DB::insert($insquery);
                                   
        
                               
                                }
                            
                                return redirect()->back();
                            
                            }
                        
                        
                        }
                                else{
        
                                    return redirect()->back()->withErrors('You have not checked any blog post')->withInput();
                 
                                }
        
                    }else{
        
        
        
                    }


                    break;
            }
    
    }

    public function deletecategory(Request $request){

        switch ($request->input('action')) {
            case 'delete':
    
    
                if(count(request()->all()) > 0){
    
                    if(isset($_POST['category'])){
    
    
                        if (is_array($_POST['category'])) {
                            foreach($_POST['category'] as $value){
                                
    
                                DB::table('categorylist')->where('id',$value)->delete();
                               
    
                           
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




    public function listDetail($id,$type)
    {
       $month=Carbon::now()->format('M');
       $day=Carbon::now()->format('d');
       $tomorrow=Carbon::now()->addHours(24)->format('d');

        $list= DB::table('lists')
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('contactlist')
         ->where('listID', $id)
         ->get(); 

         $anniversary= DB::table('anniversary')
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

            return view('admin.listDetail',['lists'=>$list,'birthcount'=>$todayBirth,'tomorrowbirthcount'=>$tomorrowBirth],['contactlists'=>$contactlist]);
          
        }else{
    
            return view('admin.otherAnniversary',['lists'=>$list,'anniversaries'=>$anniversary],['contactlists'=>$anniversarylist]);
         
    
    
    
          }
    }

    public static function listAnniversary($id)
 {
    
    $anns= DB::table('anniversary')->where('listID', $id)->get(); 
    return $anns;
        
   
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
     ->get();

     return view('admin.anniversaryEx',['lists'=>$listsx,'todayanniversary'=>$todayAnn],['tomorrowanniversary'=>$tomorrowAnn,'monthanniversary'=>$monthAnn,'anns'=>$ann,'annids'=>$annid]);
 
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
     
  
     return view('admin.todayAnniversary',['lists'=>$list,'contactlists'=>$annlist,'anns'=>$ann,'annids'=>$annid]);

}

public function anniversaryByMonth($id,$ann,$annid)
{

    $list= DB::table('lists')
    ->where('id', $id)
    ->first(); 

     $contactlist= DB::table('anniversarylist')
     ->where('listID', $id)
     ->where('anniversary',$ann)
     ->get(); 

   return view('admin.anniversaryByMonths',['lists'=>$list,'anns'=>$ann,'annids'=>$annid],['contactlists'=>$contactlist]);


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


public static function pullsenderid()
    {
          
        $senderids= DB::table('senderids')
        ->where('userID',auth()->user()->id)
        ->where('status',2)
        ->get();
         return $senderids;
        

    }

    public function collectboards()
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
       ->where('title','!=','')
       ->where('logo','!=','')
       ->where('company_name','!=','')
       ->orderBy('track_id','desc')
       ->paginate(10);  
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





      
        

            return view('admin.collect_info',['filter'=>$chk,'datas'=>$frmchks,'forms'=>$formsx,'empty'=>$nulled]);


       
       
       
     
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

public function showprofile(Request $request){
    $logo="";
    $data= DB::table('users_info') 
    ->select('users_info.brand_name','users_info.business_email','users_info.about_business','users_info.subdomain','users_info.business_area','users.created_at')
    ->join('users','users.id','=','users_info.userID')
    ->where('userID',$request->user)->get();


    $frmchks= DB::table('form_track')
    ->where('userID',$request->user)
    ->where('title','!=','')
    ->where('logo','!=','')
    ->where('company_name','!=','')
    ->orderBy('track_id','desc')
    ->paginate(10); 

    
    $checkprofile= DB::table('users_info')->where('userID', $request->user)->get(); 
    $brand= DB::table('brand_logo')->where('userID', $request->user)->get();
    foreach($brand as $brando){

        $logo=$brando->logo;
    }
   
    return view('admin.showprofile',['datas'=>$data,'logos'=>$logo,'boards'=>$frmchks]);
    
}


public function responseboard($id,$user){


    $fromlist= DB::table('form_track')->where('table_id',$this->encrypt_decrypt($id,false))->first(); 


    $scountrowsx= DB::table('form_'.$user)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get(); 
    $ascountx=$scountrowsx->count();

    $srowsx=DB::table('form_'.$user)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acountx=$srowsx->count();
    
    
    
    
    $srows1x=DB::table('form_'.$user)
    ->where('table_name', $this->get_table_name($this->encrypt_decrypt($id,false)))
    ->paginate(4);
    $acount1x= $srows1x->count();
    
    $srows2x=DB::table('form_'.$user.'_store_'.$this->get_table_name($this->encrypt_decrypt($id,false)))
    ->orderBy('id','desc')
    ->get() ;
    $acount2x=$srows2x->count();

    return view('admin.response_board',['scountrows'=> $scountrowsx,'ascount'=> $ascountx,'srows'=> $srowsx,'acount'=>$acountx,'srows1'=>$srows1x,'acount1'=> $acount1x,'srows2'=>$srows2x,'acount2'=>$acount2x,'tableid'=>$this->encrypt_decrypt($id,false),'niche'=>$fromlist->niche,'user'=>$user]);

}

public function requestfeature(){

    $request= DB::table('feature_request')
    ->select('feature_request.request_type','feature_request.request_summary','feature_request.created_at','users.name','feature_request.id','feature_request.request_status')
    ->join('users','users.id','=','feature_request.userID')
    ->orderBy('id','desc')
    ->get();

    return view('admin.requestFeature',['requests'=>$request]);
   
}


public function deletefeature(Request $request){

    switch ($request->input('action')) {
        case 'delete':


            if(count(request()->all()) > 0){

                if(isset($_POST['request'])){


                    if (is_array($_POST['request'])) {
                        foreach($_POST['request'] as $value){
                            

                            DB::table('feature_request')->where('id',$value)->delete();
                           

                       
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

public function showrequest(Request $request){

    DB::table('feature_request')->where('id',$request->req)->update(['request_status' =>0]);
       

    $requestx= DB::table('feature_request')
    ->select('feature_request.request_type','feature_request.request_summary','feature_request.created_at','users.name','feature_request.id','feature_request.request_description','feature_request.request_status')
    ->join('users','users.id','=','feature_request.userID')
    ->where('feature_request.id', $request->req)
    ->get();

   // $requestx= DB::table('feature_request')->where('id', $request->req)->get();

    return view('admin.showrequest',['requests'=>$requestx]);
   
}

public function optininterface($id,$user)
{
    $record= DB::table('form_'.$user.'_store_'.$this->get_table_name($this->encrypt_decrypt($id,false)))
    ->get();

    $formsx= DB::table('form_track')
    ->where('userID', $user)
    ->where('table_id',$this->encrypt_decrypt($id,false))
    ->first();

    $interfacex= DB::table('interface_list')
    ->where('userID', $user)
    ->where('table_id',$this->encrypt_decrypt($id,false))
    ->orderBy('id','desc')
    ->get();

    return view('admin.optin_interface',['form'=>$formsx,'interfaces'=>$interfacex,'records'=>$record]);
   

}

public static function get_table_name($id)
    {
        $tname= DB::table('table_list')->where('id',$id)->first();
        return $tname->tablename;

    }

public static function encrypt_decrypt ($data, $encrypt) {
    if ($encrypt == true) {
        $output = base64_encode (convert_uuencode ($data));
    } else {
        $output = convert_uudecode(base64_decode ($data));
    }
    return $output;
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
         
      
         return view('admin.tomorrowAnniversary',['lists'=>$list,'contactlists'=>$annlist,'anns'=>$ann,'annids'=>$annid]);

    }

 public static function anniversaryCount($anniversary,$list)
 {

     $rows= DB::table('anniversarylist')
     ->where('anniversary', $anniversary)
     ->where('listID', $list)
     ->get(); 

     
     return $rows->count();


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

    public function todayBirthday($id)
    {
        $month=Carbon::now()->format('M');
       $day=Carbon::now()->format('d');
       $tomorrow=Carbon::now()->addHours(24)->format('d');

        $list= DB::table('lists')
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('contactlist')
         ->where('listID', $id)
         ->where('birthMonth', $month)
         ->where('birthDay', $day)
         ->get();

         
      return view('admin.todayBirthday',['lists'=>$list],['contactlists'=>$contactlist]);

    }

    public function tomorrowBirthday($id)
    {

        $month=Carbon::now()->format('M');
        $tomorrow=Carbon::now()->addHours(24)->format('d');

        $list= DB::table('lists')
        ->where('id', $id)
        ->first(); 

         $contactlist=  DB::table('contactlist')
         ->where('listID', $id)
         ->where('birthMonth', $month)
         ->where('birthDay', $tomorrow)
         ->get();

        return view('admin.tomorrowBirthday',['lists'=>$list],['contactlists'=>$contactlist]);

    }


    public function autosendtype(Request $request)
{

if($request->input('autotype')=="1"){

    $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
    return view('admin.scheduler',['lists'=>$list]);

}
if($request->input('autotype')=="2"){
    $list= DB::table('lists')->where('userID', auth()->user()->id)->get(); 
    
    return view('admin.multiplemessage',['lists'=>$list]);
}
        
   
}

    public function scheduleList()
    {
        $list= DB::table('lists')
        ->select('lists.id','lists.name','lists.userID','autosend.id','autosend.listID','autosend.created_at','autosend.sendtype')
        ->join('autosend','autosend.listID','=','lists.id')
        ->get();
        return view('admin.autoscheduleList',['lists'=>$list]);

    }

    public function multipleupdate($id)
    {
          
        $senderid= DB::table('autosend')->where('listID',AdminController::getListIdFromAutosend($id))->first();
         $lists= DB::table('autosend_list')->where('listID',AdminController::getListIdFromAutosend($id))->get(); 
        // $contactlist= DB::table('contactlist')->where('listID',UserController::getListIdFromAutosend($id))->get(); 
            
         return view('admin.updateschedulemultiple',['lists'=>$lists,'sender'=>$senderid]);
        

        

    }

    public function createList()
    {

        $lists = new lists();
        $lists->name=request()->input('title');
        $lists->type=request()->input('type');
        $lists->userID=auth()->user()->id;
        $lists->save();
        return redirect()->back()->withSuccess('New list created successfully');

    }

       public function listcontacts($id,$type)
    {
        $list= DB::table('lists')->where('id', $id)->first(); 
        

        if($type=='birthday'){
            $contactlist= DB::table('contactlist')->where('listID', $id)->get();
           
            return view('admin.list_contacts',['lists'=>$list],['contactlists'=>$contactlist]);
        }
        else if($type=='other'){

            $contactlist= DB::table('anniversarylist')->where('listID', $id)->get();
            return view('admin.list_contacts_other',['lists'=>$list],['contactlists'=>$contactlist]);
      
        }
       
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




    public function celebByMonth($id)
    {

        $list= DB::table('lists')
        ->where('id', $id)
        ->first(); 

         $contactlist= DB::table('contactlist')
         ->where('listID', $id)
         ->get(); 
        return view('admin.celebrantsByMonths',['lists'=>$list],['contactlists'=>$contactlist]);


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

      
      return view('admin.extractMonth',['lists'=>$list,'months'=>$month],['contactlists'=>$contactlist]);


    }

    public function smsallcontact($id,$type)
    {
        $list= DB::table('lists')->where('id', $id)->first(); 
        if($type=='other'){

            $contactlistx= DB::table('anniversarylist')->where('listID',$id)->get(); 
            return view('admin.smsallcontactsother',['lists'=>$list,'contactlists'=> $contactlistx]);
        }

        if($type=='birthday'){
            $contactlistx= DB::table('contactlist')->where('listID',$id)->get(); 
            return view('admin.smsallcontacts',['lists'=>$list,'contactlists'=> $contactlistx]);

        }
        
       
       

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
        
           
            return redirect('admin/done_list/'.$id);

    }

    public static function getListIdFromAutosend($id)
    {
        $list= DB::table('autosend')->where('id',$id)->first(); 
        return $list->listID;

    }

    public function singleupdate($id)
    {
          

         $list= DB::table('autosend')->where('id',$id)->first(); 
         $contactlist= DB::table('contactlist')->where('listID',AdminController::getListIdFromAutosend($id))->get(); 
            
       return view('admin.updateschedule',['list'=>$list,'contactlist'=>$contactlist]);
        

        

    }


    public function todaytask()
    {
        $month=Carbon::now()->format('M');
       $day=Carbon::now()->format('d');
      

         $contactlist= DB::table('contactlist')
         ->where('birthMonth', $month)
         ->where('birthDay', $day)
         ->get();

         
      return view('admin.todaytask',['contactlists'=>$contactlist]);

    }

    public function subscribers()
 {
    
    $users= DB::table('users') 
        ->select('users.name','users.email','users.id','subscriptions.userpackage','subscriptions.type','subscriptions.created_at','subscriptions.ends_at','subscriptions.invoiceID','subscriptions.amount','subscriptions.status')
        ->join('subscriptions','subscriptions.userID','=','users.id')
        ->get();

        return view('admin.subscribers',['users'=>$users]); 
        
   
 }

 public static function pulllistauthor($id)
 {
    
    $list= DB::table('lists')->where('id', $id)->first(); 
    $users= DB::table('users')->where('id', $list->userID)->first();
    return  $users->name;
        
   
 }


 public function pullusername(Request $request){
        

        
    $fieldname= DB::table('users')->where('id',$request->userId)->first(); 
   
   
    echo  $fieldname->name;


}


public function pullblogpost(Request $request){
        

        
    $post= DB::table('blog')->where('id',$request->userId)->first(); 
   
   
    echo  $post->title;


}

public function pullcategory(Request $request){
        

        
    $category= DB::table('categorylist')->where('id',$request->userId)->first(); 
   
   
    echo  $category->category_name;


}


public function pullblogpostdetail(Request $request){
        

        
    $post= DB::table('blog')->where('id',$request->userId)->first(); 
   
   
    echo  $post;


}

public function pullvideotitle(Request $request){
        

        
    $fieldname= DB::table('help_videos')->where('vid_id',$request->userId)->first(); 
   
   
    echo  $fieldname->title;


}

public function deleteblogpost($id){

    $blog= DB::table('blog')->where('id', $id)->first(); 
    unlink(public_path('blogphotos/'.basename($blog->img)));

    $insquery="delete from blog where id='".$id."'";
    $insert = DB::insert( $insquery);

    return redirect('admin/articles');
}

public function deletecategorysingle($id){

    $insquery="delete from categorylist where id='".$id."'";
    $insert = DB::insert($insquery);
    return redirect()->back()->withSuccess('Category deleted successfully');

}


public function deleteuser($id){

    $insquery="delete from users where id='".$id."'";
    $insert = DB::insert( $insquery);

    return redirect('admin/user-list');
}

public function deletevideo($id){

    $insquery="delete from help_videos where vid_id='".$id."'";
    $insert = DB::insert($insquery);

    return redirect('admin/help-videos');
}

public function viewvideo($id){

    $video= DB::table('help_videos')->where('vid_id', $id)->first(); 

    return view('admin.view_video',['video'=>$video]);
}


    

    public function scheduleupdate($id,$id2)
    {
            if($id2=='single'){

             $list= DB::table('autosend')->where('id',$id)->first(); 
            $contactlist= DB::table('contactlist')->where('listID',AdminController::getListIdFromAutosend($id))->get(); 
            return redirect('admin/singleupdate/'.$id);
        
        
        } 
        if($id2=='multiple'){

            $list= DB::table('autosend_list')->where('listID',AdminController::getListIdFromAutosend($id))->get(); 
           
           return redirect('admin/multipleupdate/'.$id);

        }

    }

    
    public function scheduleupdate2($id)
    {
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

                DB::table('autosend')->where('id', $id)->update([
                    
                    'senderID' => request()->input('senderid'),
                    'message' => request()->input('message'),
                    'sendtime' => request()->input('time')
                
                
                ]);

                $auto=DB::table('autosend')->where('id',$id)->first(); 

                DB::table('autosend_list')->where('listID', $auto->listID)->update([
                    
                    'senderID' => request()->input('senderid'),
                    'msg' => request()->input('message'),
                    'send_time' => request()->input('time')
                ]);

                return redirect()->back()->withSuccess('Update sucessful.');
          
                }
          

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

    



    public function donelist($id)
    {
        
        return view('admin.donelist',['list'=>$id]);

    }

    public function processsenderid(){

       
        if(count(request()->all()) > 0){
       

        if(isset($_POST['ids'])){

            if (is_array($_POST['ids'])) {

            foreach($_POST['ids'] as $value){
                DB::table('senderids')->where('id', $value)
                ->update(['status' =>request()->input('status')]);
        }

        return redirect()->back()->withSuccess('sender ID updated successfuly.');
                      

    }else{

        DB::table('senderids')->where('id', $value)
        ->update(['status' =>request()->input('status')]);

        return redirect()->back()->withSuccess('sender ID updated successfuly.');
                      

    }     

           


            
       }else{


        return redirect()->back()->withErrors('Please scroll down and check atleast one sender ID to process ')->withInput();
       }

    }
}



public function insertname($name){

    $senderid = new senderid();
    $senderid->userID=auth()->user()->id;
    $senderid->status=0;
    $senderid->name=$name;
    if($senderid->save()){

        echo"good";
    }


}



public function helpvideos(){

    $videos= DB::table('help_videos')->get();
    return view('admin.help_videos',['videos'=>$videos]);


}

public function addvideos(){

    return view('admin.add_video');
}


public function postvideos(){

    $validator=$this->validate(request(),[
        'title'=>'required|string',
        'url'=>'required|string',
        'file'=>'required|mimes:jpeg,JPEG,png',
        
        ],
        [
            'title.required'=>'Type in title of help video ',
            'url.required'=>'Enter the the embed script of video ',
            'file.required'=>'Upload image for this video',
               
            ]);

            if(count(request()->all()) > 0){
     
                $imgfile= request()->file('file');
                $original_filename = strtolower(trim($imgfile->getClientOriginalName()));
                $fileName =  time().rand(100,999).$original_filename;
                $filePath = 'photos';
                $filePathdb = asset('/photos/'.$fileName);
                $imgfile->move($filePath,$fileName);

                $videos = new videos();
                $videos->title=request()->input('title');
                $videos->video_url=request()->input('url');
                $videos->view_count=0;
                $videos->video_img=$filePathdb;
                $videos->save();
        
        
                
        
                return redirect()->back()->withSuccess('You have succesfully added a video');
         
        }
}



public function blogdetail($id){
    $blogs= DB::table('blog')
    ->where('id',$id)
    ->first(); 
   // $smsinfo= DB::table('sms_for_phone')->where('userID',auth()->user()->id)->first(); 
    return view('admin.edit_blog_post',['blog'=>$blogs]);

}

public function blogpostupdate(){

    //1.validate data
       
    $validator=$this->validate(request(),[
       'title'=>'required|string',
       'description'=>'required|string',
      
      
      
       ]);

           if(count(request()->all()) > 0){

              


               if(empty( request()->file('file'))){

                
                     
            DB::table('blog')
            ->where('id',request()->input('blogid'))
            ->update(['title' => request()->input('title'),'category' => request()->input('category'),'content'=>request()->input('description')]);
            //DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
           
                
               
                   return redirect()->back()->withSuccess('Update succesful.');
               
               }
               else{ 





                     ///// remove the existing file from folder /////////

                     $existFile=""; 

                     $info= DB::table('blog')->where('id',request()->input('blogid'))->first(); 
                     $existFile.=$info->img; 
                           
                    

 
                     if(file_exists(public_path('blogphotos/'.basename($existFile)))){
 
                         unlink(public_path('blogphotos/'.basename($existFile)));
                   
                       }
                    
                   
                     //////// move file to upload folder ////////////////
               $file=request()->file('file');
             $original_name = strtolower(trim($file->getClientOriginalName()));
             $fileName =  time().rand(100,999).$original_name;
             $filePathdb = asset('/blogphotos/'.$fileName);
             $filePath = 'blogphotos';
             $file->move($filePath,$fileName);
                 
 
             //////////////// update database with new information ///////
 
             DB::table('blog')
             ->where('id',request()->input('blogid'))
             ->update(['title' => request()->input('title'),'category' => request()->input('category'),'content'=>request()->input('description'),'img'=> $filePathdb]);
             // DB::table('sms_for_phone')->where('userID', auth()->user()->id)->update(['sms' => request()->input('sms'), 'senderID' => request()->input('senderid')]);
           
                      
 
            return redirect()->back()->withSuccess('Update succesful.');
                   
              
           
               }}

}

function categorylist(){

    $categories= DB::table('categorylist')->get();
    return view('admin.category_list',['categories'=>$categories]);
}


public static function pullallcategory(){

    $output="";

    $catlists= DB::table('categorylist')->get();
    foreach($catlists as $catlist){

$output.="<option>".$catlist->category_name."</option>";


    }
return $output;
   
}

function addcategory(){

    $category = new category_list();
    $category ->category_name=request()->input('category');
    $category->save();

    return redirect()->back()->withSuccess('A category name has been added'); 

}

}
