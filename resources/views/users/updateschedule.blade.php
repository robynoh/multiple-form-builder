<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | today birthday </title>
@endsection
@section('content')

<?php $senderids= UserController::pullsenderid();?>

                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Scheduler</a><i data-feather="chevron-right" class="breadcrumb__icon"></i><?php echo UserController::listname($list->listID); ?> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/profile-12.jpg') }}">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium"> {{ Auth::user()->name }}</div>
                                    <div class="text-xs text-theme-41"> <?php



if(Auth::user()->role=="manage"){ echo"Super Admin"; }else if(Auth::user()->role=="manage-sub"){ echo"Admin";} ?></div>
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
                <h1 class="text-lg font-medium mr-auto" style="font-size:23px">
                   List Info
                    </h1>
              
                                 
                    
               
<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                    <table>
<tr>
<td>  <a href="/users/scheduleList" class="button box bg-theme-1 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="chevron-left" class="breadcrumb__icon"></i>     Back  </a>

       </td>
                            <td>
                                
                            <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="button box bg-theme-12 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="user-check" class="breadcrumb__icon"></i>    Contacts of this list  </a> 
                    
                    
                    
                        <div class="modal" id="superlarge-modal-size-preview"> 
                            <h1>List Contacts</h1>
                                        <div class="modal__content modal__content--xl p-10 text-center"> 
                                            
                                   <span style="font-weight:bold;float:left;font-size:x-large">    <?php echo ucwords(UserController::listname($list->listID)); ?></span>
                                        <br/>
                                   <div class="intro-y datatable-wrapper box p-5 mt-5">

                    
                                        

<table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">

         <thead>
             <tr>
                
                 <th class="border-b-2 whitespace-no-wrap">First Name</th>
                 <th class="border-b-2 whitespace-no-wrap">Last Name</th>
                  <th class="border-b-2 whitespace-no-wrap">Birthmonth</th>
                 <th class="border-b-2 whitespace-no-wrap">Birthday</th>
                 <th class="border-b-2 whitespace-no-wrap">Contact</th>
                 <th class="border-b-2 whitespace-no-wrap">Remark</th>
                
             </tr>
         </thead>
                                    
                                      
                      <tbody>
       
         
     @foreach($contactlist as $contact)
<tr> 

                        <td class="border-b">{{ ucwords($contact->firstName)}}</td>
                        <td class="border-b">{{ ucwords($contact->lastName) }} </td>
                        <td class="border-b">{{ $contact->birthMonth }}</td>
                        <td class="border-b">{{ $contact->birthDay }}</td>
                        <td class="border-b">{{ $contact->phone }}</td>
                        <td class="border-b">{{ ucwords($contact->remarks) }}</td>
                        </tr>


                        
                        @endforeach

     
                      </tbody>
                                       </table>
</div>
        
    


                                      
                                    
                                    
                                    </div>
                                    </div>
                    </td>
</tr>

                     </table> 
                    <div class="w-full sm:w-auto flex sm:mt-0">
                    <form action="/users/scheduleUpdate/{{$list->id}}" method="POST">
                    

       

                       
       

                      
       
                                         
                    </div>
                </div>   
                <br/>
                <br/>  

                @if ($errors->any())

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </Ol>
    </div>
@endif


@if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif

<div class="intro-y datatable-wrapper box p-5 mb-5" id="sms" >
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> The message bellow will be sent automatically to all contacts in this list using the stated user ID at the time ticked bellow whenever it is their birthday. To update the message and time of the day to send it for individual contact click the contacts button above and edit  </div>
               
                {{ csrf_field() }} 
                <div class="col-span-12 sm:col-span-12"><label><b>User ID</b>  <a style="color:royalblue" href="javascript:void()" data-toggle="modal" data-target="#header-footer-modal-previewx" > 
               ( Click to change User ID ) </a></label> 
             <input disabled name="senderid" type="text" class="input w-full border mt-2 flex-1 bg-gray-200" placeholder="Enter the name you want to send this message as" value="{{$sendero->senderID}}">
           
             
            </div>
            
            
            

             <div class="news__input relative mt-5"> 
                            <label><b>Message</b></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in birthday wishes here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ $list->message }}</textarea>
                        </div>
        <br/><br/>
        <div class="intro-y  datatable-wrapper box p-1" style="float:right;color:red">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>




 <div class="mt-3"> <label><b>Time to send SMS on birthday</b> </label>
     <div class="flex flex-col sm:flex-row mt-2">
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-chris-evans" name="time" value="12:00 AM" <?php if($list->sendtime=="12:00 AM"){ echo "checked";}?>> <label class="cursor-pointer select-none" for="vertical-radio-chris-evans" style="padding-right:20px"> 12:00 AM</label> </div>
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-liam-neeson" name="time" value="05:00 AM" <?php if($list->sendtime=="05:00 AM"){ echo "checked";}?>> <label class="cursor-pointer select-none" for="vertical-radio-liam-neeson" style="padding-right:20px"> 05:00 AM</label> </div>
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-daniel-craig" name="time" value="07:00 AM" <?php if($list->sendtime=="07:00 AM"){ echo "checked";}?>> <label class="cursor-pointer select-none" for="vertical-radio-daniel-craig" style="padding-right:20px"> 07:00 AM</label> </div>
 </div>
 </div>
                  
   

<br/>
<table>
<tr>
<td> <button name="action" value="activate" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Update </button></td>
                            <td>  </td>
</tr>

                     </table>   
</form>
</div>




<div class="modal" id="header-footer-modal-previewx">
 <div class="modal__content">

 <form action="/users/changesenderid2/{{$list->id}}" method="POST">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">SENDER ID</h2> 
             
         </div>
        
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">

         <div class="col-span-12 sm:col-span-12">
             <label>Current ID:</label> 
            
            
            <select id="senderid" name="senderid" class="input w-full border mt-2 flex-1" style="font-weight:bold;padding-left:20px" disabled >
            <option ><?php echo $sendero->senderID; ?></option>


           </select> </div>

             <div class="col-span-12 sm:col-span-12">
                 <label>Replace With:</label> <br/>


             <select name="senderid" class="input w-full border mt-2 flex-1" style="height:35px;font-weight:bold" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>

@endforeach
</select>
            
            
             </div>
            
             
            
                                    
         </div>

        
        
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button>
          <button type="submit" class="button w-20 bg-theme-1 text-white">Change</button> </div>
    </form> 
 </div>
</div>


                <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->

                    
  
  



                   
                <!-- BEGIN: Delete Confirmation Modal -->




                
    


              
                <!-- END: Delete Confirmation Modal -->
            
@endsection

<script>


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}

function senddel(){
    
    window.location="/users/contact/delete/"+$('#app_id').val();
   
}

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }

</script>

<script language="JavaScript">
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
</script>