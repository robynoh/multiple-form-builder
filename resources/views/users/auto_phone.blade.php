<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | List detail </title>
@endsection
@section('content')
<?php $senderids= UserController::pullsenderid();?>


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Phonebook<i data-feather="chevron-right" class="breadcrumb__icon"></i><a href="" class="breadcrumb--active"></a> {{$lists->name}} </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                 
                    <!-- END: Notifications -->
                 <!-- BEGIN: Account Menu -->
                 <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                         </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium"> {{ ucwords(Auth::user()->name) }}</div>
                                    <div class="text-xs text-theme-41">Manage Account</div>
                                 </div>
                              
                                 <div class="p-2">
                                    <a href="/user/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile</a>
                                    <a href="/user/updatePassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password</a>
                               
                                </div>
                                <div class="p-2 border-t border-theme-40">
                                
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->
                <br/>
                <h1 class="text-lg font-medium mr-auto">
                    Phone numbers
                    </h1>
               <br/>
               
                    <br/>    
                    
                    @if($errors->any())
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
      <li>  {{$errors->first()}}</li>
        </Ol>
    </div>

@endif


                    @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11" style="font-size:16px">
Auto scheduled SMS will be sent at the time you schedule to contacts in this list.
</div>

<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                    
<div class="w-full sm:w-auto flex mt-0 sm:mt-0">

<a href="/users/scheduleList" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white">
                                               <i data-feather="clock" class="breadcrumb__icon"></i>  All Schedule list </a>
 
                              
                       
<a href="javascript:;" data-toggle="modal" data-target="#medium-modal-size-preview" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Schedule SMS</a>             

                      
                                              
                                                                
                                           </div>
                                          
       

                                           
                </div>   
                <br/>


                <!-- BEGIN: Delete Confirmation Modal -->




                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New contact</h2> 
             
         </div>
         </div>
 </div>

 <div class="modal" id="medium-modal-size-preview">
     <div class="modal__content p-10 "> 
         
    
     <form action="/users/schedulesms2/{{$lists->id}}" method="POST">
                {{ csrf_field() }} 
                <div class="col-span-12 sm:col-span-12"><label><b>Sender ID</b></label> 
              <input name="listid" type="hidden"  value="{{ $lists->id }}">
             <select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
             
            </div>
            
           

            <div class="relative w-full mx-auto mt-5">
            <label><b>Date to Send SMS</b></label>    </div>
            <div class="relative w-full mx-auto">
            
     <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"> <i data-feather="calendar" class="w-4 h-4"></i> </div>
     
     <input name="sendDate" type="text" class="datepicker input pl-12 border">
 </div>

 <div class="relative w-full mx-auto mt-5">
            <label><b>Time to Send</b></label>    </div>


 <div class="col-span-12 sm:col-span-12"> 
              
             <select name="sendTime" class="input w-20 border mt-2 flex-1 bg-gray-200" required>
             <option>1:00</option>
<option>2:00</option>
<option>3:00</option>
<option>4:00</option>
<option>5:00</option>
<option>6:00</option>
<option>7:00</option>
<option>8:00</option>
<option>9:00</option>
<option>10:00</option>
<option>11:00</option>
<option>12:00</option>
</select>

<select name="sendPeriod" class="input w-20 border mt-2 flex-1 bg-gray-200" required>

<option>PM</option>
<option>AM</option>
</select>
             
            </div>

             <div class="news__input relative mt-5"> 
                            <label><b>Message</b></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in SMS here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
        <br/><br/>
        <div class="intro-y  datatable-wrapper box p-5" style="float:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>






        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                       <i data-feather="clock" class="w-4 h-4 mr-2"></i>     Schedule </button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 <div class="modal" id="medium-modal-size-preview3">
     <div class="modal__content p-10 "> 

     <div class="col-span-12 sm:col-span-12"><label>Sender ID:</label> 
              <input id="senderid2" class="input w-full border mt-2 flex-1 bg-gray-200" type="text" disabled>
            
            </div>
            <div class="col-span-12 sm:col-span-12"><label>Send Date:</label> 
              <input id="sendDate2" type="text" class="input w-full border mt-2 flex-1 bg-gray-200" disabled>
            
            </div>
            <div class="col-span-12 sm:col-span-12"><label>Send Time:</label> 
              <input id="sendTime2" type="text" class="input w-full border mt-2 flex-1 bg-gray-200" disabled >
            
            </div>
         
    
     <form action="/users/nameschedulesms/{{$lists->id}}" method="POST">
                {{ csrf_field() }} 
                {{ method_field("PUT")}}

                <div class="news__input relative mt-5"> 
                            <label>Message</label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea disabled required id="message2"  class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in SMS here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
                        <br/>
      
<div style="padding-bottom:10px;font-weight:bold;color:orangered">EDIT SMS INFO BELOW</div><br/>

                <div class="col-span-12 sm:col-span-12"><label><b>Sender ID</b></label> 
              <input name="listid" type="hidden"  value="{{ $lists->id }}">
             <select id="senderid" name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
             
            </div>
            
           

            <div class="relative w-full mx-auto mt-5">
            <label><b>Date to Send SMS</b></label>    </div>
            <div class="relative w-full mx-auto">
            
     <div class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600"> <i data-feather="calendar" class="w-4 h-4"></i> </div>
     
     <input  id="sendDate" name="sendDate" type="text" class="datepicker input pl-12 border">
     <input  id="smsid" name="smsid" type="hidden" class="datepicker input pl-12 border">
 </div>

 <div class="relative w-full mx-auto mt-5">
            <label><b>Time to Send</b></label>    </div>


 <div class="col-span-12 sm:col-span-12"> 
              
             <select  id="sendTime" name="sendTime" class="input w-20 border mt-2 flex-1 bg-gray-200" required>
             <option>1:00</option>
<option>2:00</option>
<option>3:00</option>
<option>4:00</option>
<option>5:00</option>
<option>6:00</option>
<option>7:00</option>
<option>8:00</option>
<option>9:00</option>
<option>10:00</option>
<option>11:00</option>
<option>12:00</option>
</select>

<select id="sendPeriod" name="sendPeriod" class="input w-20 border mt-2 flex-1 bg-gray-200" required>

<option>PM</option>
<option>AM</option>
</select>
             
            </div>

            



            <div class="news__input relative mt-5"> 
                            <label>Message</label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea id="message" name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in SMS here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
        <br/>
        <div class="intro-y  datatable-wrapper box p-2" style="float:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>
<br/>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-7 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                            Update</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Basic Table -->
                        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                                <div class="intro-x flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Autoscheduled SMS
                                    </h2>
                                  
                                </div>
                                <?php if($smss->count()<1) {?>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 ">
You have not auto schedule any SMS to send to your contact list !!
</div>
    <?php }?>

                                <div class="report-timeline mt-5 relative">





                                @foreach($smss as $sms)

                                <div class="intro-x relative flex items-center mb-3">
                                        <div class="report-timeline__image">
                                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                <img alt="Midone Tailwind HTML Admin Template" <?php if(UserController::smsstatus($sms->id,$sms->sendDate,$sms->sendTime)==0){?>src="{{ asset('dist/images/profile-4.jpg') }}" <?php }?> <?php if(UserController::smsstatus($sms->id,$sms->sendDate,$sms->sendTime)==1){?>src="{{ asset('dist/images/profile-4good.jpg') }}" <?php }?><?php if(UserController::smsstatus($sms->id,$sms->sendDate,$sms->sendTime)==2){?>src="{{ asset('dist/images/profile-4bad.jpg') }}" <?php }?>>
                                            </div>
                                        </div>
                                         
                                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                           

                                       <div class="ml-auto" style="float:right;padding-left:10px">
                                                <a  id="deleteUser{{ $sms->id}}" data-userid="{{$sms->id}}" href="javascript:void(0)" onclick="showAlert({{ $sms->id}});" > <i data-feather="trash-2" class="report-box__icon text-theme-6"></i></a> 
                                                <a  id="deleteUser{{ $sms->id}}" data-userid="{{$sms->id}}" href="javascript:void(0)" onclick="showAlert3({{ $sms->id}});" > <i data-feather="edit" class="report-box__icon text-theme-7"></i></a> 
                                     
                                            </div>
                                      <!--  <div class="ml-auto" style="float:right;padding-left:10px">    
                                                <a  id="deleteUser" data-userid="" href="javascript:void(0)" onclick="" > <i data-feather="edit" class="report-box__icon text-theme-7"></i></a>
                                            </div>-->
                                            <div class="flex items-center">
                                                <div class="font-medium">{{  UserController::showHumanTime($sms->sendDate,$sms->sendTime) }}</div>
                                                <div class="text-xs text-gray-500 ml-auto">{{$sms->sendTime}}</div>
                                            </div>
                                            <div class="text-gray-600 mt-1">{{$sms->sms}}</div>
                                       
                                
                                        </div>
                                    </div>


                                @endforeach
                                   
                                   
                                   
                                   
                                </div>
                            </div>
                        <!-- END: Basic Table -->
                        <!-- BEGIN: Bordered Table -->
                       
                        <!-- END: Bordered Table -->
                        <!-- BEGIN: Hoverable Table -->
                       
                        <!-- END: Hoverable Table -->
                        <!-- BEGIN: Table Row States -->
                      
                        <!-- END: Table Row States -->
                    </div>
                    <div class="intro-y col-span-12 lg:col-span-6">
                        <!-- BEGIN: Table Head Options -->
                        <div class="intro-y box">
                        
                            <div class="p-5" id="head-options-table">

                            <div class="intro-x flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                     Contacts
                                    </h2>
                                  
                                </div>
                                <div class="preview">
                                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">NUMBERS</th>
        
                              
                               
                            </tr>
                        </thead>
                        <tbody>
                      
                            <tr>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $contactlists->numbers }}</div>
                                    
                                </td>
                               
                               
                                
                                
                            </tr>
                          
                     
                        </tbody>
                    </table>
                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <!-- END: Table Head Options -->
                        <!-- BEGIN: Responsive Table -->
                       
                        <!-- END: Responsive Table -->
                        <!-- BEGIN: Small Table -->
                        
                        <!-- END: Small Table -->
                        <!-- BEGIN: Striped Rows -->
                      
                        <!-- END: Striped Rows -->
                    </div>
                </div>













                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2">Do you really want to delete these scheduled SMS? This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>

               <div class="modal" id="button-modal-preview">
     <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Update Successful</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>
 </div>

                </form>
                <!-- END: Delete Confirmation Modal -->
            
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script>

    $(document).ready(function() {
       
var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var tab= $("#tableCol"); //Add button ID
var removal = $(".remove"); //Add button ID
var x = 1; //initlal text box count

$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<tr><td><input name="name[]" type="text" class="input w-full border col-span" placeholder="Name" required></td><td><input name="phone[]" type="text" class="input w-full border col-span" placeholder="phone" required></td><td><td class="remove_field button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-14" style="font-size:12px"> <img class="w-3" src="{{ asset('dist/images/delete-icon.png') }}"> Remove</td></tr>'); //add input box
}
});


$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
 $(this).parent('tr').remove(); 
 x--;
})


});

function dropField(){

    alert(5);

}

function removeField(){

var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var tab= $("#tableCol"); //Add button ID
var x = 1; //initlal text box count

e.preventDefault(); $(this).parent('div').remove(); x--;

}


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}

function showAlert2(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id2').val(userID); 

    $.get('/users/pullcontactdetail/'+id,function(contact){
        $("#contactid").val(contact.id);
       $("#firstname2").val(contact.firstName);
        $("#lastname2").val(contact.lastName);
        $("#phone2").val(contact.phone);
        $("#remark2").val(contact.remarks);
        $("#month").val(contact.birthMonth);
        $("#day").val(contact.birthDay);


});


  $('#superlarge-modal-size-preview2').modal('show'); 
   
}



function showAlert3(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
    $.get('/users/pullsmsdetail/'+id,function(auto){
        $("#senderid2").val(auto.senderID);
       $("#sendDate2").val(auto.sendDate);
       $("#sendTime2").val(auto.sendTime);
      //  $("#sendPeriod2").val(auto.sendPeriod);
        $("#message2").val(auto.sms);


        $("#smsid").val(auto.id);
       $("#sendDate").val(auto.sendDate);
        $("#message").val(auto.sms);
       


});


   $('#medium-modal-size-preview3').modal('show'); 
   
}




function senddel(){
    
    window.location="/users/schedulesms/delete/"+$('#app_id').val();
   
}


function submitContact(){

      var id=$("#contactid").val();
      var firstname=$("#firstname2").val();
      var lastname=$("#lastname2").val();
      var phone= $("#phone2").val();
      var remark= $("#remark2").val();
      var month=$("#month").val();
      var day= $("#day").val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
            url:'/users/submitcontactupdate',
                  method: 'POST',
                  data: {
					id:id,firstname:firstname,lastname:lastname,phone:phone,remark:remark,month:month,day:day,_token:_token
                  },
                  
                  success:function(result){
                    $('#superlarge-modal-size-preview2').modal('hide'); 
                    $('#button-modal-preview').modal('show'); 
                  }});


    
}

function show_file_box(){

    $('#superlarge-modal-size-preview').modal('hide'); 
     $('#superlarge-modal-size-preview3').modal('show'); 

}

function back_to_add_field(){

$('#superlarge-modal-size-preview3').modal('hide'); 
 $('#superlarge-modal-size-preview').modal('show'); 

}



    $(document).ready(function(){

        var fileName;

        $('input[type="file"]').change(function(e){

        fileName = e.target.files[0].name;
                  
        });


        $('#submit').click(function(){

        var id =$("#listId").val();
        var _token = $('input[name="_token"]').val();
        var file=fileName;

        $.ajax({
            url:"/users/fileupload",
                  method: 'POST',
                  data: {
					id:id,filename:file,_token:_token
                  },
                  
                  success:function(result){
                   // $('#superlarge-modal-size-preview3').modal('hide'); 
                   // $('#success').modal('show'); 
                   alert(result);
                  }});

        });


    });




    function selectAll(source) {
    checkboxes = document.getElementsByName('contacts[]');
    for(var i in checkboxes)
        checkboxes[i].checked = source.checked;
}


function showMsg(){
    $('#sms').show();
    $('#swishes').hide();
    $('#cswishes').show();

}

function hideMsg(){
    $('#sms').hide();
    $('#swishes').show();
    $('#cswishes').hide();

}

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }
</script>