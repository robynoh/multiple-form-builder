<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\models\view_stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
{

    Route::any('/page/{userid}/{title}/{id}', 'App\Http\Controllers\UserController@landinpagetrim');  



});



Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
{
    Route::any('/{list}', function($subdomain,$list)
    {
       
        $userinfo= DB::table('users_info')->where('subdomain', $subdomain)->first();

        if(empty($userinfo)){

            abort(404);

        }else{
        
       
            $optincount= DB::table('interface_list')->where('id',$list)->get();
            if(empty($optincount->count())){

        $brandx= DB::table('users_info')->where('userID',$userinfo->userID)->first(); 
        return view('error_page',['userid'=>$userinfo->userID,'brandx'=>$brandx->brand_name]);
    
    
            }else{

        

        $optinx= DB::table('interface_list')->where('id',$list)->first(); 
        $allfield= DB::table('form_'.$userinfo->userID)
        ->where('table_name', Usercontroller::get_table_name($optinx->table_id))
        ->get(); 
    
        $intList= DB::table('interface_list')
             ->where('id',$list)
             ->first(); 


        $Listcount= DB::table('interface_list')
             ->where('id',$list)
             ->get(); 
    
    
        $businessx= DB::table('users_info')
             ->where('userID',$userinfo->userID)
             ->first();
             
             
             $businessLogox= DB::table('brand_logo')
             ->where('userID',$userinfo->userID)
             ->first();
    
        $insqueryx="update interface_list set no_view = no_view+1 where id='".$list."'";
        $insertx= DB::insert($insqueryx);
    
        $list2= DB::table('form_styles')->where('table_id', $optinx->table_id)->first();
    
        if(!Auth::check()){
    
    /////////////////////// store view //////////////////////
        $view_stat = new view_stat();
        $view_stat->count=1;
        $view_stat->interfaceID=$list;
        $view_stat->table_id=$optinx->table_id;
        $view_stat->day=date('d');
        $view_stat->month=date('m');
        $view_stat->year=date('Y');
        $view_stat->save();
    
        }

        $vis= DB::table('no_profile_visibility')->where('table_id', $optinx->table_id)->get();

        $statusx= DB::table('user_package')->where('userID',$userinfo->userID)->first(); 

         //sub switch

         $subswitchx=UserController::subswitch($userinfo->userID);

if($statusx->status!=0){

    
    
        return view('sign_up',['optin'=>$optinx,'fields'=>$allfield,'tableid'=>Usercontroller::encrypt_decrypt($optinx->table_id,true),'userid'=>Usercontroller::encrypt_decrypt($userinfo->userID,true),'style'=>$list2,'business'=>$businessx,'businesslogo'=>$businessLogox,'no_visibility'=>$vis,'submsg'=>UserController::subMsgformNosession(UserController::subCheckNosession($userinfo->userID),UserController::userpackageNosession($userinfo->userID),UserController::packagetypeNosession($userinfo->userID),$userinfo->userID) ]);
}else{

    

    $brandx= DB::table('users_info')->where('userID',$userinfo->userID)->first(); 
    return view('error_page',['userid'=>$userinfo->userID,'brandx'=>$brandx->brand_name]);
   
}

        }
    }


    });
});

Route::group(['domain' => parse_url(config('app.url'), PHP_URL_HOST)], function()
    {
    Route::any('/', function()
    {
        return view('welcome');
    }); 

    Route::get('blog', 'App\Http\Controllers\UserController@about'); 
    Route::get('blog/{tag}', 'App\Http\Controllers\UserController@blogdetail'); 
    Route::get('solution', 'App\Http\Controllers\UserController@solution');
    Route::get('pricing', 'App\Http\Controllers\UserController@price');
    
});

Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
    {
    Route::post('/{list}', 'App\Http\Controllers\UserController@postform2'); 
}); 

Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
    {
    Route::any('/{user}/something-went-wrong', 'App\Http\Controllers\UserController@showerror'); 
}); 

Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
    {
    Route::any('file/{list}', 'App\Http\Controllers\UserController@pdf_download'); 
}); 

Route::group(['domain' => '{subdomain}.'.parse_url(config('app.url'), PHP_URL_HOST)], function()
    {
    Route::any('/download/file/{file}', 'App\Http\Controllers\UserController@file_download'); 
}); 




Route::get('redirect', 'App\Http\Controllers\HomeController@index');
Route::get('formpage', 'App\Http\Controllers\UserController@formpage');

Route::get('pages', 'App\Http\Controllers\UserController@page');

Route::get('how-it-works', 'App\Http\Controllers\UserController@howworks');

Route::get('page/{id}', 'App\Http\Controllers\UserController@landingpage');

Route::get('/page-search-results','App\Http\Controllers\UserController@pagesearch')->name('pagesearch');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('users', 'App\Http\Controllers\UserController@index');
Route::middleware(['auth:sanctum', 'verified'])->get('users/list', 'App\Http\Controllers\UserController@list');


Route::middleware(['auth:sanctum', 'verified'])->get('users/all_pages', 'App\Http\Controllers\UserController@allpages');
Route::middleware(['auth:sanctum', 'verified'])->post('users/all_pages', 'App\Http\Controllers\UserController@postpages')->name('postpagenow');
Route::middleware(['auth:sanctum', 'verified'])->get('users/lpage_content/{id}', 'App\Http\Controllers\UserController@pagecontent');

Route::middleware(['auth:sanctum', 'verified'])->post('users/save-new-page', 'App\Http\Controllers\UserController@newpage');

Route::middleware(['auth:sanctum', 'verified'])->post('users/add-row-button', 'App\Http\Controllers\UserController@addrowsbutton');

Route::middleware(['auth:sanctum', 'verified'])->post('users/add-row-signup', 'App\Http\Controllers\UserController@addrowsignup');


Route::middleware(['auth:sanctum', 'verified'])->post('users/lpage_content/{id}', 'App\Http\Controllers\UserController@postcontent')->name('postcontent');

Route::middleware(['auth:sanctum', 'verified'])->post('users/createlist', 'App\Http\Controllers\UserController@createList');
Route::middleware(['auth:sanctum', 'verified'])->get('users/lists/delete/{list}', 'App\Http\Controllers\UserController@deleteList');
Route::middleware(['auth:sanctum', 'verified'])->get('users/listDetail/{list}/{type}', 'App\Http\Controllers\UserController@listDetail');
Route::middleware(['auth:sanctum', 'verified'])->post('users/addcontact/{list}', 'App\Http\Controllers\UserController@addContact');
Route::middleware(['auth:sanctum', 'verified'])->get('users/contact/delete/{list}', 'App\Http\Controllers\UserController@deleteContact');

Route::get('users/contactname/delete/{list}', 'App\Http\Controllers\UserController@deleteContactname');


Route::get('users/todayBirthday/{list}', 'App\Http\Controllers\UserController@todayBirthday');
Route::get('users/tomorrowBirthday/{list}', 'App\Http\Controllers\UserController@tomorrowBirthday');
Route::get('users/celebrantsByMonths/{list}', 'App\Http\Controllers\UserController@celebByMonth');
Route::get('users/monthExtract/{month}/{list}', 'App\Http\Controllers\UserController@monthExtract');
Route::get('users/name_phone_only/{list}', 'App\Http\Controllers\UserController@phone_name');
Route::middleware(['auth:sanctum', 'verified'])->post('users/phone_only/{list}', 'App\Http\Controllers\UserController@phone_only');
Route::middleware(['auth:sanctum', 'verified'])->get('users/phone_edit/{list}', 'App\Http\Controllers\UserController@phone_edit');
Route::middleware(['auth:sanctum', 'verified'])->put('users/phone_edit/{list}', 'App\Http\Controllers\UserController@phone_update');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_contact_list', 'App\Http\Controllers\UserController@create_contact_list');
Route::middleware(['auth:sanctum', 'verified'])->post('users/create_contact_list', 'App\Http\Controllers\UserController@create_phone_list');

Route::middleware(['auth:sanctum', 'verified'])->get('users/sentMessages', 'App\Http\Controllers\UserController@sentMessages');
Route::middleware(['auth:sanctum', 'verified'])->get('users/userProfile', 'App\Http\Controllers\UserController@userProfile');
Route::middleware(['auth:sanctum', 'verified'])->get('user/updatePassword', 'App\Http\Controllers\UserController@updatePassword');
Route::middleware(['auth:sanctum', 'verified'])->get('users/pricing', 'App\Http\Controllers\UserController@pricing');
Route::post('users/smstocontacts', 'App\Http\Controllers\UserController@smstocontacts');
Route::post('users/smstocontactsphone', 'App\Http\Controllers\UserController@smstocontactsphone');
Route::get('users/contactphone/delete/{list}', 'App\Http\Controllers\UserController@deletecontactphone');
Route::get('users/schedulesms/delete/{id}', 'App\Http\Controllers\UserController@deleteschedulesms');


Route::post('users/smstocontactstomorrow', 'App\Http\Controllers\UserController@smstocontacts2');
Route::post('users/smstocontactsmonth', 'App\Http\Controllers\UserController@smstocontacts3');
Route::get('users/schedule', 'App\Http\Controllers\UserController@schedule');
Route::post('users/autosms', 'App\Http\Controllers\UserController@autosms');
Route::get('users/scheduleList', 'App\Http\Controllers\UserController@scheduleList');
Route::get('users/deactivate/{list}', 'App\Http\Controllers\UserController@deactivateauto');
Route::get('users/scheduleUpdate/{list}/{type}/{extra}', 'App\Http\Controllers\UserController@scheduleupdate');
Route::post('users/scheduleUpdate/{list}', 'App\Http\Controllers\UserController@scheduleupdate2');
Route::post('users/multiplecontact/{list}', 'App\Http\Controllers\UserController@multiplecontact');
Route::post('users/multiplenamecontact/{list}', 'App\Http\Controllers\UserController@multiplenamecontact');
Route::post('users/schedulesms/{list}', 'App\Http\Controllers\UserController@schedulesms');
Route::post('users/schedulesms2/{list}', 'App\Http\Controllers\UserController@schedulesms2');

Route::post('users/changesenderid/{list}', 'App\Http\Controllers\UserController@changesenderid');
Route::post('users/changesenderid2/{list}', 'App\Http\Controllers\UserController@changesenderid2');

Route::put('users/nameschedulesms/{list}', 'App\Http\Controllers\UserController@nameschedulesms');

Route::post('users/multipleanniversary/{list}', 'App\Http\Controllers\UserController@multipleanniversary');
Route::get('users/autosendtype', 'App\Http\Controllers\UserController@autosendtype');
Route::get('users/contacts/{list}/{type}', 'App\Http\Controllers\UserController@listcontacts');
Route::get('users/done_list/{list}', 'App\Http\Controllers\UserController@donelist');
Route::get('users/singleupdate/{list}', 'App\Http\Controllers\UserController@singleupdate');
Route::get('users/multipleupdate/{list}', 'App\Http\Controllers\UserController@multipleupdate');
Route::put('users/updatemultipleinfo', 'App\Http\Controllers\UserController@multipleupdateinfo');
Route::get('users/pullcontactdetail/{contact}', 'App\Http\Controllers\UserController@pullcontact');

Route::middleware(['auth:sanctum', 'verified'])->get('users/pullinterfacedetail/{interface}', 'App\Http\Controllers\UserController@pullinterface');
Route::middleware(['auth:sanctum', 'verified'])->get('users/pullrowimage/{id}', 'App\Http\Controllers\UserController@pullimagerow');

Route::middleware(['auth:sanctum', 'verified'])->get('users/pullrowbutton/{id}', 'App\Http\Controllers\UserController@pullrowbutton');


Route::middleware(['auth:sanctum', 'verified'])->post('users/post-text', 'App\Http\Controllers\UserController@posttext');

Route::middleware(['auth:sanctum', 'verified'])->put('users/add-row-button-update', 'App\Http\Controllers\UserController@buttonupdate');

Route::middleware(['auth:sanctum', 'verified'])->post('users/add-row-video', 'App\Http\Controllers\UserController@addrowvideo');



Route::middleware(['auth:sanctum', 'verified'])->get('users/pullsmsdetail/{contact}', 'App\Http\Controllers\UserController@pullsms');
Route::middleware(['auth:sanctum', 'verified'])->get('users/pullanniversarydetail/{contact}', 'App\Http\Controllers\UserController@pullanniversary');
Route::middleware(['auth:sanctum', 'verified'])->post('users/submitcontactupdate', 'App\Http\Controllers\UserController@submitcontactupdate');
Route::middleware(['auth:sanctum', 'verified'])->post('users/submitlistupdate', 'App\Http\Controllers\UserController@submitlistupdate');
Route::middleware(['auth:sanctum', 'verified'])->post('users/fileupload', 'App\Http\Controllers\UserController@fileupload');
Route::middleware(['auth:sanctum', 'verified'])->post('users/fileuploadname', 'App\Http\Controllers\UserController@fileuploadname');
Route::middleware(['auth:sanctum', 'verified'])->get('users/pulllistdetail/{list}', 'App\Http\Controllers\UserController@pulllistdetail');
Route::middleware(['auth:sanctum', 'verified'])->get('users/pullfielddetail/{list}', 'App\Http\Controllers\UserController@pulllfielddetail');
Route::middleware(['auth:sanctum', 'verified'])->post('users/addconfirmsms', 'App\Http\Controllers\UserController@submitcomfirmsms');
Route::middleware(['auth:sanctum', 'verified'])->post('users/updateconfirmsms', 'App\Http\Controllers\UserController@updatecomfirmsms');


Route::middleware(['auth:sanctum', 'verified'])->get('users/edit_field/{fieldid}/{tableid}', 'App\Http\Controllers\UserController@editfielddetail');
Route::middleware(['auth:sanctum', 'verified'])->put('users/edit_field/{fieldid}/{tableid}', 'App\Http\Controllers\UserController@updatefielddetail');

Route::middleware(['auth:sanctum', 'verified'])->get('users/editfield/{fieldid}/{tableid}', 'App\Http\Controllers\UserController@editfielddetail2');
Route::middleware(['auth:sanctum', 'verified'])->put('users/editfield/{fieldid}/{tableid}', 'App\Http\Controllers\UserController@updatefielddetail');


Route::get('users/context/delete/{content}', 'App\Http\Controllers\UserController@deletecontenttext');

Route::get('users/senderid', 'App\Http\Controllers\UserController@senderid');
Route::post('users/processmultiplemsg/{list}', 'App\Http\Controllers\UserController@multipleprocessmsg');

Route::put('users/processmultiplemsgedit/{list}', 'App\Http\Controllers\UserController@multipleprocessmsgedit');

Route::middleware(['auth:sanctum', 'verified'])->put('users/post-text-update', 'App\Http\Controllers\UserController@posttextupdate');

Route::middleware(['auth:sanctum', 'verified'])->put('users/post-body-update', 'App\Http\Controllers\UserController@postbodyupdate');


Route::middleware(['auth:sanctum', 'verified'])->put('users/post-title-update', 'App\Http\Controllers\UserController@posttitleupdate');


Route::middleware(['auth:sanctum', 'verified'])->post('users/add-row-image', 'App\Http\Controllers\UserController@addrowimage');

Route::middleware(['auth:sanctum', 'verified'])->get('users/pulltextcontent/{id}', 'App\Http\Controllers\UserController@pulltextcontent');

Route::get('users/download/{filename}/folder/{path}', 'App\Http\Controllers\UserController@download')->name('download');
Route::get('users/smsallcontacts/{list}/{type}', 'App\Http\Controllers\UserController@smsallcontact')->name('smsallcontacts');
Route::get('users/my_senderid', 'App\Http\Controllers\UserController@mysender');
Route::get('users/anniversary/delete/{ann}/{list}', 'App\Http\Controllers\UserController@deleteAnniversary');
Route::get('users/anniversarylist/delete/{list}', 'App\Http\Controllers\UserController@deleteanniversarylist');
Route::post('users/submitanniversaryupdate', 'App\Http\Controllers\UserController@submitanniversaryupdate');
Route::get('users/{list}/anniversary/{anntype}/{annid}', 'App\Http\Controllers\UserController@anniversaryexc');
Route::get('users/anniversary/today/{list}/{ann}/{annid}', 'App\Http\Controllers\UserController@todayannivlist');
Route::get('users/anniversary/tomorrow/{list}/{ann}/{annid}', 'App\Http\Controllers\UserController@tomorrowannivlist');
Route::get('users/anniversaryByMonths/{list}/{ann}/{annid}', 'App\Http\Controllers\UserController@anniversaryByMonth');
Route::get('users/annmonthExtract/{month}/{list}/{ann}/{annid}', 'App\Http\Controllers\UserController@annmonthExtract');

Route::get('admin/anniversary/today/{list}/{ann}/{annid}', 'App\Http\Controllers\AdminController@todayannivlist');
Route::get('admin/anniversary/tomorrow/{list}/{ann}/{annid}', 'App\Http\Controllers\AdminController@tomorrowannivlist');
Route::get('admin/anniversaryByMonths/{list}/{ann}/{annid}', 'App\Http\Controllers\AdminController@anniversaryByMonth');
Route::get('admin/annmonthExtract/{month}/{list}/{ann}/{annid}', 'App\Http\Controllers\AdminController@annmonthExtract');

Route::middleware(['auth:sanctum', 'verified'])->post('users/submitinfo', 'App\Http\Controllers\UserController@submitinfo');

Route::middleware(['auth:sanctum', 'verified'])->get('users/uploadlogo', 'App\Http\Controllers\UserController@uploadlogo');


Route::middleware(['auth:sanctum', 'verified'])->get('users/exportresponse/{tableid}', 'App\Http\Controllers\UserController@export');
Route::middleware(['auth:sanctum', 'verified'])->get('users/moreinfo', 'App\Http\Controllers\UserController@moreinfo');
Route::middleware(['auth:sanctum', 'verified'])->get('users/profile_view', 'App\Http\Controllers\UserController@profileview');
Route::middleware(['auth:sanctum', 'verified'])->post('users/profile_view', 'App\Http\Controllers\UserController@profilesubmit');
Route::middleware(['auth:sanctum', 'verified'])->get('users/create_form_stp2/{id}', 'App\Http\Controllers\UserController@form_step2')->name('formstp2');
Route::middleware(['auth:sanctum', 'verified'])->get('users/create_done_field', 'App\Http\Controllers\UserController@donefield')->name('donefield');
Route::middleware(['auth:sanctum', 'verified'])->get('users/create_done_field_edit', 'App\Http\Controllers\UserController@donefieldedit')->name('donefieldedit');

Route::middleware(['auth:sanctum', 'verified'])->get('users/custom_form_arrange/{id}', 'App\Http\Controllers\UserController@customarrange')->name('customarrange');
Route::middleware(['auth:sanctum', 'verified'])->post('users/custom_form_arrange/{id}', 'App\Http\Controllers\UserController@fieldarrange')->name('fieldarrange');

Route::middleware(['auth:sanctum', 'verified'])->get('users/custom_form_arrange_edit/{id}', 'App\Http\Controllers\UserController@customarrangeedit')->name('customarrangeedit');
Route::middleware(['auth:sanctum', 'verified'])->post('users/custom_form_arrange_edit/{id}', 'App\Http\Controllers\UserController@fieldarrangeedit')->name('fieldarrangeedit');

Route::middleware(['auth:sanctum', 'verified'])->get('users/custom_form_arrange_edit', 'App\Http\Controllers\UserController@customarrangeedit')->name('customarrangeedit');
Route::middleware(['auth:sanctum', 'verified'])->get('users/list_created/{list}', 'App\Http\Controllers\UserController@listcreated')->name('listcreated');

Route::middleware(['auth:sanctum', 'verified'])->get('users/form/delete/{id}', 'App\Http\Controllers\UserController@deletefrm');

Route::middleware(['auth:sanctum', 'verified'])->get('users/board/delete/{id}', 'App\Http\Controllers\UserController@deleteboard');


Route::middleware(['auth:sanctum', 'verified'])->get('users/pagerow/delete/{id}', 'App\Http\Controllers\UserController@deletepagerow');


Route::middleware(['auth:sanctum', 'verified'])->get('users/interface/delete/{id}', 'App\Http\Controllers\UserController@deleteinterface');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/user/delete/{id}', 'App\Http\Controllers\AdminController@deleteuser');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/blogpost/delete/{id}', 'App\Http\Controllers\AdminController@deleteblogpost');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/category/delete/{id}', 'App\Http\Controllers\AdminController@deletecategorysingle');


Route::middleware(['auth:sanctum', 'verified'])->get('admin/subscribers', 'App\Http\Controllers\AdminController@subscribers');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/video/delete/{id}', 'App\Http\Controllers\AdminController@deletevideo');


Route::middleware(['auth:sanctum', 'verified'])->get('admin/help-videos', 'App\Http\Controllers\AdminController@helpvideos');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/addvideo', 'App\Http\Controllers\AdminController@addvideos');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/addvideo', 'App\Http\Controllers\AdminController@postvideos');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/view-video/{id}', 'App\Http\Controllers\AdminController@viewvideo');


Route::middleware(['auth:sanctum', 'verified'])->get('users/create_form_edit/{id}', 'App\Http\Controllers\UserController@formedit')->name('formedit');
Route::middleware(['auth:sanctum', 'verified'])->get('users/form_info_edit/{id}', 'App\Http\Controllers\UserController@forminfoedit')->name('forminfoedit');
Route::middleware(['auth:sanctum', 'verified'])->post('users/form_info_edit/{id}', 'App\Http\Controllers\UserController@form_info_update')->name('formupdate');
Route::middleware(['auth:sanctum', 'verified'])->post('users/process_optin/{id}', 'App\Http\Controllers\UserController@insert_optin')->name('insertoptin');
Route::middleware(['auth:sanctum', 'verified'])->post('users/upload_brand/', 'App\Http\Controllers\UserController@upload_brand')->name('uploadbrand');
Route::middleware(['auth:sanctum', 'verified'])->post('users/changeimage/', 'App\Http\Controllers\UserController@update_brand')->name('uploadbrand');



Route::middleware(['auth:sanctum', 'verified'])->get('users/interface_edit/{id}', 'App\Http\Controllers\UserController@optinInfoedit')->name('optinedit');
Route::middleware(['auth:sanctum', 'verified'])->post('users/interface_edit/{id}', 'App\Http\Controllers\UserController@editInterface')->name('editInter');

Route::middleware(['auth:sanctum', 'verified'])->post('users/interface_edit/{id}', 'App\Http\Controllers\UserController@editInterface')->name('editInter');

Route::get('interface/optin/{id}/{id2}/{user}', 'App\Http\Controllers\UserController@optin_signup')->name('optinsignup');
Route::post('interface/optin/{id}/{id2}/{user}', 'App\Http\Controllers\UserController@postform')->name('post_form');



Route::middleware(['auth:sanctum', 'verified'])->get('users/interface/customise/{id}', 'App\Http\Controllers\UserController@customform')->name('custom_form');

Route::middleware(['auth:sanctum', 'verified'])->get('interface/stat/{id}/{user}/{tableid}', 'App\Http\Controllers\UserController@openstat')->name('open_stat');
Route::middleware(['auth:sanctum', 'verified'])->post('interface/stat/{id}/{user}/{tableid}', 'App\Http\Controllers\UserController@openstatfilter')->name('open_stat');


Route::middleware(['auth:sanctum', 'verified'])->get('landing/stat/{user}/{id}', 'App\Http\Controllers\UserController@landingstat')->name('landing_stat');






Route::middleware(['auth:sanctum', 'verified'])->get('/users/no-profile', 'App\Http\Controllers\UserController@noprofile')->name('noprofile');
Route::middleware(['auth:sanctum', 'verified'])->get('/users/bringprofile/{table}', 'App\Http\Controllers\UserController@bringprofile')->name('bringprofile');


Route::middleware(['auth:sanctum', 'verified'])->post('users/interface/customise/{id}', 'App\Http\Controllers\UserController@postcustomdetail')->name('post_custom_form');
Route::middleware(['auth:sanctum', 'verified'])->get('users/acknowledgement/{id}', 'App\Http\Controllers\UserController@acknowledgement')->name('acknowledgement');
Route::middleware(['auth:sanctum', 'verified'])->post('users/acknowledgement/{id}', 'App\Http\Controllers\UserController@updateacknowledgement')->name('updateacknowledgement');


Route::middleware(['auth:sanctum', 'verified'])->get('users/form_info_optin/{id}', 'App\Http\Controllers\UserController@optin_info_update')->name('optinupdate');
Route::middleware(['auth:sanctum', 'verified'])->post('users/form_info_optin/{id}', 'App\Http\Controllers\UserController@form_info_update')->name('formupdate');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_form_sheet', 'App\Http\Controllers\UserController@form_step_sheet');
Route::middleware(['auth:sanctum', 'verified'])->get('users/removefield/{id}/{table}', 'App\Http\Controllers\UserController@removefield');
Route::middleware(['auth:sanctum', 'verified'])->get('users/removefield2/{id}/{table}', 'App\Http\Controllers\UserController@removefield2');

Route::middleware(['auth:sanctum', 'verified'])->post('users/processstate', 'App\Http\Controllers\UserController@processstate');
Route::middleware(['auth:sanctum', 'verified'])->post('users/pullfieldname', 'App\Http\Controllers\UserController@pullfieldname');

Route::middleware(['auth:sanctum', 'verified'])->post('users/pullnichename', 'App\Http\Controllers\UserController@pullnichename');

Route::middleware(['auth:sanctum', 'verified'])->get('users/new_field/{id}', 'App\Http\Controllers\UserController@newfield');
Route::middleware(['auth:sanctum', 'verified'])->post('users/new_field/{id}', 'App\Http\Controllers\UserController@addfield');
Route::middleware(['auth:sanctum', 'verified'])->get('users/response/{id}', 'App\Http\Controllers\UserController@response');
Route::middleware(['auth:sanctum', 'verified'])->get('users/responseboard/{id}', 'App\Http\Controllers\UserController@responseboard');
Route::middleware(['auth:sanctum', 'verified'])->post('users/responseboard/{id}', 'App\Http\Controllers\UserController@deleterecord');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/responseboard/{id}/{user}', 'App\Http\Controllers\AdminController@responseboard');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/request-feature/', 'App\Http\Controllers\AdminController@deletefeature');


Route::middleware(['auth:sanctum', 'verified'])->post('users/response/{id}', 'App\Http\Controllers\UserController@deleterecord');

Route::middleware(['auth:sanctum', 'verified'])->get('users/resdetail/{id}/{table}', 'App\Http\Controllers\UserController@resdetail');
Route::middleware(['auth:sanctum', 'verified'])->get('users/response/delete/{id}/{tableid}', 'App\Http\Controllers\UserController@resdelete');



Route::middleware(['auth:sanctum', 'verified'])->get('users/user_settings/{table}', 'App\Http\Controllers\UserController@usersettings');


Route::middleware(['auth:sanctum', 'verified'])->get('users/new_field_edit/{tableid}', 'App\Http\Controllers\UserController@newfieldedit');
Route::middleware(['auth:sanctum', 'verified'])->post('users/new_field_edit/{tableid}', 'App\Http\Controllers\UserController@addfieldedit');

Route::get('form/{name}/{user}/{title}', 'App\Http\Controllers\UserController@displayform');
Route::post('form/{name}/{user}/{title}', 'App\Http\Controllers\UserController@postform');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_custom_field/{id}', 'App\Http\Controllers\UserController@customfield');
Route::middleware(['auth:sanctum', 'verified'])->post('users/create_custom_field/{id}', 'App\Http\Controllers\UserController@savecustomfield3');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_custom_field_new', 'App\Http\Controllers\UserController@customfieldnew');
Route::middleware(['auth:sanctum', 'verified'])->post('users/create_custom_field_new', 'App\Http\Controllers\UserController@savecustomfieldx');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_custom_field_edit/{tableid}', 'App\Http\Controllers\UserController@customfieldedit');
Route::middleware(['auth:sanctum', 'verified'])->post('users/create_custom_field_edit/{tableid}', 'App\Http\Controllers\UserController@savecustomfield2');

Route::get('admin/sent_messages', 'App\Http\Controllers\AdminController@sentMessages');
Route::get('admin/smsdetail/{sms}', 'App\Http\Controllers\AdminController@smsdetail');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/user-list', 'App\Http\Controllers\AdminController@userlist');

Route::middleware(['auth:sanctum', 'verified'])->post('admin/pullusername', 'App\Http\Controllers\AdminController@pullusername');

Route::middleware(['auth:sanctum', 'verified'])->post('admin/pullblogpost', 'App\Http\Controllers\AdminController@pullblogpost');


Route::middleware(['auth:sanctum', 'verified'])->post('admin/pullcategory', 'App\Http\Controllers\AdminController@pullcategory');


Route::middleware(['auth:sanctum', 'verified'])->post('admin/pullblogpostdetail', 'App\Http\Controllers\AdminController@pullblogpostdetail');


Route::middleware(['auth:sanctum', 'verified'])->post('admin/pullvideotitle', 'App\Http\Controllers\AdminController@pullvideotitle');



Route::middleware(['auth:sanctum', 'verified'])->post('users/processoption', 'App\Http\Controllers\UserController@processoption');
Route::middleware(['auth:sanctum', 'verified'])->post('users/processoptiontemprary', 'App\Http\Controllers\UserController@processoptiontemprary');
Route::middleware(['auth:sanctum', 'verified'])->post('users/displayprocessoption', 'App\Http\Controllers\UserController@displayprocessoption');
Route::middleware(['auth:sanctum', 'verified'])->post('users/processmenuoption', 'App\Http\Controllers\UserController@processmenuoption');

Route::middleware(['auth:sanctum', 'verified'])->get('users/interface/{id}', 'App\Http\Controllers\UserController@optininterface');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/interface/{id}/{user}', 'App\Http\Controllers\AdminController@optininterface');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/optin-list', 'App\Http\Controllers\AdminController@optinlist');
Route::middleware(['auth:sanctum', 'verified'])->get('users/optin-list', 'App\Http\Controllers\UserController@optinlist');
Route::middleware(['auth:sanctum', 'verified'])->post('users/processmenuoptiontemprary', 'App\Http\Controllers\UserController@processmenuoptiontemprary');

Route::middleware(['auth:sanctum', 'verified'])->post('users/displayprocessmenuoption', 'App\Http\Controllers\UserController@displayprocessmenuoption');

Route::middleware(['auth:sanctum', 'verified'])->post('users/deleteoption', 'App\Http\Controllers\UserController@deleteoption');
Route::middleware(['auth:sanctum', 'verified'])->post('users/deleteoptiontemprary', 'App\Http\Controllers\UserController@deleteoptiontemprary');
Route::middleware(['auth:sanctum', 'verified'])->post('users/deletemenuoption', 'App\Http\Controllers\UserController@deletemenuoption');
Route::middleware(['auth:sanctum', 'verified'])->post('users/deletemenuoptiontemprary', 'App\Http\Controllers\UserController@deleteMenuoptiontemprary');

Route::get('admin/{list}/anniversary/{anntype}/{annid}', 'App\Http\Controllers\AdminController@anniversaryexc');


Route::middleware(['auth:sanctum', 'verified'])->get('users/collect_information', 'App\Http\Controllers\UserController@collectinfo')->name('collectinfo');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/boards', 'App\Http\Controllers\AdminController@collectboards')->name('collectboards');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/profile', 'App\Http\Controllers\AdminController@showprofile')->name('showprofile');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create_form', 'App\Http\Controllers\UserController@createform');
Route::middleware(['auth:sanctum', 'verified'])->post('users/create_form', 'App\Http\Controllers\UserController@submitformfield');
Route::middleware(['auth:sanctum', 'verified'])->get('users/form_info', 'App\Http\Controllers\UserController@form_info');
Route::middleware(['auth:sanctum', 'verified'])->post('users/form_info', 'App\Http\Controllers\UserController@store_form_info');

Route::middleware(['auth:sanctum', 'verified'])->get('users/form_create', 'App\Http\Controllers\UserController@form_create')->name('form_create');

Route::middleware(['auth:sanctum', 'verified'])->get('admin', 'App\Http\Controllers\AdminController@index');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/list', 'App\Http\Controllers\AdminController@list');
Route::get('admin/listDetail/{list}/{type}', 'App\Http\Controllers\AdminController@listDetail');
Route::get('admin/todayBirthday/{list}', 'App\Http\Controllers\AdminController@todayBirthday');
Route::get('admin/tomorrowBirthday/{list}', 'App\Http\Controllers\AdminController@tomorrowBirthday');
Route::get('admin/celebrantsByMonths/{list}', 'App\Http\Controllers\AdminController@celebByMonth');
Route::get('admin/scheduleList', 'App\Http\Controllers\AdminController@scheduleList');
Route::post('admin/createlist', 'App\Http\Controllers\AdminController@createList');
Route::post('admin/multiplecontact/{list}', 'App\Http\Controllers\AdminController@multiplecontact');
Route::get('admin/monthExtract/{month}/{list}', 'App\Http\Controllers\AdminController@monthExtract');
Route::get('admin/smsallcontacts/{list}/{type}', 'App\Http\Controllers\AdminController@smsallcontact')->name('smsallcontacts');
Route::get('admin/multipleupdate/{list}', 'App\Http\Controllers\AdminController@multipleupdate');
Route::get('admin/autosendtype', 'App\Http\Controllers\AdminController@autosendtype');
Route::post('admin/autosms', 'App\Http\Controllers\AdminController@autosms');
Route::get('admin/contacts/{list}/{type}', 'App\Http\Controllers\AdminController@listcontacts');
Route::post('admin/processmultiplemsg/{list}', 'App\Http\Controllers\AdminController@multipleprocessmsg');
Route::get('admin/done_list/{list}', 'App\Http\Controllers\AdminController@donelist');
Route::get('admin/scheduleUpdate/{list}/{type}', 'App\Http\Controllers\AdminController@scheduleupdate');
Route::get('admin/singleupdate/{list}', 'App\Http\Controllers\AdminController@singleupdate');
Route::get('admin/multipleupdate/{list}', 'App\Http\Controllers\AdminController@multipleupdate');
Route::put('admin/updatemultipleinfo', 'App\Http\Controllers\AdminController@multipleupdateinfo');
Route::post('admin/scheduleUpdate/{list}', 'App\Http\Controllers\AdminController@scheduleupdate2');
Route::get('admin/task/', 'App\Http\Controllers\AdminController@todaytask');
Route::get('admin/senderid/', 'App\Http\Controllers\AdminController@senderid');
Route::post('admin/senderidprocess', 'App\Http\Controllers\AdminController@processsenderid');
Route::get('admin/insertname/{sender}', 'App\Http\Controllers\AdminController@insertname');
Route::get('users/smsdetail/{sms}', 'App\Http\Controllers\UserController@smsdetail');
Route::post('users/resendsms', 'App\Http\Controllers\UserController@resend');
Route::post('users/createAnniversary', 'App\Http\Controllers\UserController@createAnniversary');

Route::middleware(['auth:sanctum', 'verified'])->post('users/sentMessages', 'App\Http\Controllers\UserController@filtermessage');

Route::middleware(['auth:sanctum', 'verified'])->get('users/package', 'App\Http\Controllers\UserController@pricepackage');

Route::middleware(['auth:sanctum', 'verified'])->get('users/my-package', 'App\Http\Controllers\UserController@mypackage');

Route::middleware(['auth:sanctum', 'verified'])->get('users/my-package-annual', 'App\Http\Controllers\UserController@mypackageannual');

Route::middleware(['auth:sanctum', 'verified'])->get('users/process-package', 'App\Http\Controllers\UserController@choosepackage');
Route::middleware(['auth:sanctum', 'verified'])->get('users/request-feature', 'App\Http\Controllers\UserController@requestfeature');
Route::middleware(['auth:sanctum', 'verified'])->post('users/request-feature', 'App\Http\Controllers\UserController@postrequest');

Route::middleware(['auth:sanctum', 'verified'])->get('users/pay-history', 'App\Http\Controllers\UserController@payhistory');

Route::middleware(['auth:sanctum', 'verified'])->get('users/get-started', 'App\Http\Controllers\UserController@getstarted');
Route::middleware(['auth:sanctum', 'verified'])->get('users/getting-started-niche-board', 'App\Http\Controllers\UserController@getstartednicheboard');
Route::middleware(['auth:sanctum', 'verified'])->get('users/getting-started-interface', 'App\Http\Controllers\UserController@getstartedinterface');

Route::middleware(['auth:sanctum', 'verified'])->get('users/getting-started-share', 'App\Http\Controllers\UserController@getstartedshare');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/blog', 'App\Http\Controllers\AdminController@blog');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/articles', 'App\Http\Controllers\AdminController@articles');

Route::middleware(['auth:sanctum', 'verified'])->post('admin/articles', 'App\Http\Controllers\AdminController@postarticles');

Route::middleware(['auth:sanctum', 'verified'])->post('admin/deleteblog', 'App\Http\Controllers\AdminController@deleteblog')->name('deleteblog');

Route::middleware(['auth:sanctum', 'verified'])->post('admin/deletecategory', 'App\Http\Controllers\AdminController@deletecategory')->name('deletecategory');


Route::middleware(['auth:sanctum', 'verified'])->get('users/getting-started-access-lead', 'App\Http\Controllers\UserController@accesslead');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/request-feature', 'App\Http\Controllers\AdminController@requestfeature');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/show-request', 'App\Http\Controllers\AdminController@showrequest');

Route::middleware(['auth:sanctum', 'verified'])->get('sendbasicemail','App\Http\Controllers\MailController@basic_email');
Route::middleware(['auth:sanctum', 'verified'])->get('sendhtmlemail','App\Http\Controllers\MailController@html_email');
Route::middleware(['auth:sanctum', 'verified'])->get('sendattachmentemail','App\Http\Controllers\MailController@attachment_email');


// Laravel 8
Route::post('/pay', [App\Http\Controllers\PaymentController::class, 'redirectToGateway'])->name('pay');
// Laravel 8
Route::get('/payment/callback', [App\Http\Controllers\PaymentController::class, 'handleGatewayCallback']);


Route::middleware(['auth:sanctum', 'verified'])->get('users/visitors-download', 'App\Http\Controllers\UserController@visitordownload');
Route::get('/{userid}/{id}/pages/{business}/{title}/', 'App\Http\Controllers\UserController@landinpagetrim2');

Route::middleware(['auth:sanctum', 'verified'])->get('users/view-video/{id}', 'App\Http\Controllers\UserController@viewvideo');
Route::middleware(['auth:sanctum', 'verified'])->get('users/help-videos', 'App\Http\Controllers\UserController@helpvideos');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/blog/{id}', 'App\Http\Controllers\AdminController@blogdetail');
Route::middleware(['auth:sanctum', 'verified'])->put('admin/blogupdate/{id}', 'App\Http\Controllers\AdminController@blogpostupdate');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/categories', 'App\Http\Controllers\AdminController@categorylist');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/categories', 'App\Http\Controllers\AdminController@addcategory');

