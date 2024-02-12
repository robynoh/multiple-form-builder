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
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Phonebook<i data-feather="chevron-right" class="breadcrumb__icon"></i><a href="" class="breadcrumb--active">{{$listsname}}</a> </div>
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



<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                    
<div class="w-full sm:w-auto flex mt-0 sm:mt-0">

<a href="/users/list" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white">
                                               <i data-feather="chevron-left" class="breadcrumb__icon"></i>    Go Back </a>
                              
  <?php if($countphone<1){ ?>                     
<a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Add Contact </a>             
<?php }?>
                       <a id="cswishes" href="javasrcipt:void(0);" onclick="hideMsg()" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white" <?php if (empty($errors->any())){ ?> style="display:none"<?php } ?>>
                                               <i data-feather="x" class="w-4 h-4 mr-2"></i>  Close message box </a>
                              
                       
                                               <a id="swishes" href="javasrcipt:void(0);" onclick="showMsg()" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white" <?php if ($errors->any()){ ?> style="display:none"<?php } ?>>
                                               <i data-feather="message-circle" class="w-4 h-4 mr-2"></i>     Send SMS </a>
                              
                       
                                              
                                                                
                                           </div>
                                          
       

                                           
                </div>   
                <br/>

                
<form action="/users/smstocontactsphone" method="POST">
                <div class="intro-y datatable-wrapper box p-5 mb-5" id="sms" <?php if (empty($errors->any())){ ?> style="display:none" <?php }?>>
                
                <br/>
                 <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
Select contacts you want to send SMS to from the list bellow.
</div>
                <br/>  
                
                

                {{ csrf_field() }} 

                <div class="col-span-12 sm:col-span-12"><label><b>Sender ID</b></label> 
              <input name="listid" type="hidden"  value="{{ $lists }}">
             <select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
            </div>
            
            
            

             <div class="news__input relative mt-5"> 
                            <label><b>Message</b></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in message here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
        <br/><br/>
        <div class="intro-y  datatable-wrapper box p-5" style="float:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-7 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                       <i data-feather="send" class="w-4 h-4 mr-2"></i>     Send </button>
      
                   
                   </div>
    
    
</div>




   

<div class="intro-y flex flex-col sm:flex-row items-center mt-2">


<table width="100%"><tr>
                            <td width="60%">
                    <h1 style="font-size:18px;font-weight:bold">Contacts </h1><td>
                       
</tr>
                        </table>  

                </div>      
                <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap"><input id='selectall' type="checkbox" class="input border mr-2" onClick="selectAll(this,'color')"  > Select all</th>
                                <th class="border-b-2 whitespace-no-wrap">TITLE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">NUMBERS</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                            
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($contactlists as $contactlist) 
                            <tr>
                            <td class="border-b"> 
                                
                            <input type="checkbox" name="ids[]" class="input border mr-2" value="{{$contactlist->id}}" >
                            <input type="hidden" name="numbers" class="input border mr-2" value="{{$contactlist->numbers}}" >
                              
                           
                        
                        </td>
                             
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ucwords($contactlist->title)}}</div>
                                    
                                </td>
                                
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{substr( $contactlist->numbers,0,30)}}...</div>
                                </td>
                               


                               
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                   
                                   
                                     
                                    <a class="button button--sm w-8 mr-1 mb-2 bg-theme-7 text-white" href="/users/phone_edit/{{ $lists}}" > <i data-feather="edit" class="w-4 h-4 mr-1"></i></a>
                                     
                                         
                                    <a class="button button--sm w-8 mr-1 mb-2 bg-theme-6 text-white" id="deleteUser{{$lists}}" data-userid="{{ $lists }}" href="javascript:void(0)" onclick="showAlert({{ $lists }});" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
                                       
                             
                                  
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    </div>

                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
            </form>
                <!-- BEGIN: Delete Confirmation Modal -->




                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New contact</h2> 
             
         </div>
         <form  action="/users/addcontact/" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label><b>Firstname</b></label> 
             <input name="firstname" type="text" class="input w-full border mt-2 flex-1" placeholder="firstname" required> </div>
            
             <div class="col-span-12 sm:col-span-12"><label><b>Lastname</b></label> 
             <input name="lastname" type="text" class="input w-full border mt-2 flex-1" placeholder="lastname" required> </div>
            
           

         <div class="p-5 grid grid-cols-12 gap-8 row-gap-2">
             
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Month</b></label>
                                                    <select name="birthmonth" class="input border mr-2 w-full">
                                                    <option>Month</option>
                                                    <option value="Jan">Jan</option>
             <option value="Feb">Feb</option>
             <option value="Mar">Mar</option>
             <option value="Apr">Apr</option>
             <option value="May">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="Aug">Aug</option>
             <option value="Sep">Sep</option>
             <option value="Oct">Oct</option>
             <option value="Nov">Nov</option>
             <option value="Dec">Dec</option>
         </select>     </div>
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Day</b></label>
                                                    <select name="birthday" class="input border mr-2 w-full">
                                                    <option>Day</option>
                     @for($i=1; $i<=32; $i++ )
             <option>{{$i}}</option>
             
             @endfor
         </select>   </div>
                                            </div>

         <div class="col-span-12 sm:col-span-12"><label><b>Phone</b></label> 
             <input name="phone" type="text" class="input w-full border mt-2 flex-1" placeholder="Phone number" > </div>
            
             <div class="col-span-12 sm:col-span-12"><label><b>Remark</b></label> 
             <input name="remark" type="text" class="input w-full border mt-2 flex-1" placeholder="remark" > </div>
            
              
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button> </div>
    </form>  </div>
 </div>

 <div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10 text-center">
         

    <div class="">
      
        <form action="/users/phone_only/{{$lists}}" method="POST">
        {{ csrf_field() }}
            
        <table  style="width:100%">

  
                        <tbody class="input_fields_wrap">
       <tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label>Title</label> 
    <input name="title" type="text" class="input w-full border col-span mt-2" placeholder="Give a name to your contact list" required>
  </div>
</td>
</tr>

<tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label>Contacts</label> 
  <textarea name="numbers" class="input w-full border col-span mt-2" placeholder="Enter phone numbers separated with commas e.g 09012345678, 07012345678, 08012345678,..."></textarea>
  </div>
</td>
</tr>
</tbody>
  </table>
<br/>
  <table>
<tr>
<td> <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Save </button></td>
                            <td> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button> </td>
</tr>

                     </table>
</form>
    </div>
    
         
        
    
    </div>
 </div>



 <div class="modal" id="superlarge-modal-size-preview3">
     <div class="modal__content modal__content--xl p-10 text-center">
         

    <div class="">
        <table>
             <tr>
                 <td>
                     <table>
                         <tr>
                         <td>
                     <a href="javascript:void(0);" onclick="back_to_add_field();" class=" button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-14"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i> Go back</a>
                   </td>
                         <td><a href="/users/download/phoneList.csv/folder/{{'uploadFormat'}}" class=" button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-2"> <i data-feather="download" class="w-4 h-4 mr-2"></i> Download format</a></td>
                         </tr>
                         
</table>  
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
First download the format for upload by clicking the "download format" button above and enter all your contacts following the column arrangement then save and upload.
</div>
                     <br/>

<h2 class="text-lg font-medium mr-auto" style="float:left">
            Upload contact list
            </h2>
            <br/> <br/>
   </td>
<td> 
      
</td>
    </tr>           
         </table>
        
        
        <form action="/users/fileuploadname" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
            
        <table>
            <tr>
           
            <td>
                <input type="file" name="file" id="file"  />
                <input type="hidden" name="listId" id="listId" value="{{$lists}}" />
        </td>
            </tr>
            

                     </table>

                     

<br/>
<br/>
<table>
    <tr>
        <td>
<button class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Upload</button>
</td>
<td>

                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button> 
</td>
    </tr>
</table>
          </form>              </div>
    
         
        
    
    </div>
 </div>





 <div class="modal" id="superlarge-modal-size-preview2">
     <div class="modal__content modal__content--xl p-10 text-center">
         <table>
             <tr>
                 <td>
   </td>
<td> 
</td>
    </tr>           
         </table>

    <div class="">
       
        <br/>
        <form id="form2" action="" method="POST">
        {{ method_field("PUT")}}
{{ csrf_field() }} 
            
        <table id="table2" >

  <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">Firstname</th>
                                <th class="border-b-2 whitespace-no-wrap">Lastname</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">birthMonth</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">birthDay</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CONTACT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">REMARKS</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                            </tr>
                        </thead>
                        <tbody class="input_fields_wrap">
       <tr>
<td>
<input type="hidden", name="id" id="app_id2">
<input type="hidden", name="contactid" id="contactid" >
<input name="firstname[]" id="firstname2" type="text" class="input w-full border col-span" placeholder="Firstname" required>

</td>
<td><input name="lastname[]" id="lastname2" type="text" class="input w-full border col-span" placeholder="Lastname" required></td>
<td> <select name="birthmonth[]" id="month" class="input border mr-2 w-full" required>
                                                    <option>Choose Month</option>
                                                    <option value="Jan">Jan</option>
             <option value="Feb">Feb</option>
             <option value="Mar">Mar</option>
             <option value="Apr">Apr</option>
             <option value="May">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="Aug">Aug</option>
             <option value="Sep">Sep</option>
             <option value="Oct">Oct</option>
             <option value="Nov">Nov</option>
             <option value="Dec">Dec</option>
         </select> </td>
<td><select name="birthday[]" id="day" class="input border mr-2 w-full">
                                                    <option>Choose Day</option>
                     @for($i=1; $i<=32; $i++ )
             <option>{{$i}}</option>
             
             @endfor
         </select></td>
<td><input name="phone[]" id="phone2" type="text" class="input w-full border col-span" placeholder="Phone" required></td>
<td><input name="remark[]" id="remark2" type="text" class="input w-full border col-span" placeholder="remark"></td>
<td  >   
   
  </td>


</tr>
</tbody>
  </table>
<br/>
  <table>
<tr>
<td> <a  href="javascript:void(0);" onclick="submitContact();"  class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Save</a></td>
                            <td> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>  </td>
</tr>

                     </table>
</form>
    </div>
    
         
        
    
    </div>
 </div>










                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2">Do you really want to delete these contact? This process cannot be undone.</div>
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

function senddel(){
    
    window.location="/users/contactphone/delete/"+$('#app_id').val();
   
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
    checkboxes = document.getElementsByName('ids[]');
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