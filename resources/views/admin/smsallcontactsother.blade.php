<?php   use \App\Http\Controllers\AdminController; ?>
@extends('layouts.adminint')
@section('title')
    <title>Admin | all contacts </title>
@endsection
@section('content')
<?php $senderids= AdminController::pullsenderid();?>


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> {{$lists->name}} </div>
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
                                    <div class="text-xs text-theme-41"> <?php if(Auth::user()->role=="manage"){ echo"Super Admin"; }else if(Auth::user()->role=="manage-sub"){ echo"Admin";} ?></div>
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
                    Send SMS to contacts in this list <?php // echo UserController::fullmonth($month); ?>
                    </h1>
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
 
               
<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                    
<div class="w-full sm:w-auto flex mt-0 sm:mt-0">
                       
                        
                       <a id="cswishes" href="javasrcipt:void(0);" onclick="hideMsg()" class="button box bg-theme-6 text-white mr-2 flex items-center  ml-auto sm:ml-0" <?php if (empty($errors->any())){ ?> style="display:none"<?php } ?>>
                                               <i data-feather="x" class="w-4 h-4 mr-2"></i>  Close message box </a>
                              
                       
                                               <a id="swishes" href="javasrcipt:void(0);" onclick="showMsg()" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" <?php if ($errors->any()){ ?> style="display:none"<?php } ?>>
                                               <i data-feather="message-circle" class="w-4 h-4 mr-2"></i>     Send SMS </a>
                              
                       
                                               <a href="/admin/listDetail/{{$lists->id}}/other" class="button box bg-theme-1 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                                               <i data-feather="chevron-left" class="breadcrumb__icon"></i>    Go Back </a>
                              
                                                                
                                           </div>
                                          
       

                                           
                </div>   
                <br/>
                 <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
Select contacts you want to send SMS to from the list bellow.
</div>
                <br/>  

                <div class="intro-y datatable-wrapper box p-5 mb-5" id="sms" <?php if (empty($errors->any())){ ?> style="display:none" <?php }?>>
                <form action="/users/smstocontactsmonth" method="POST">
                {{ csrf_field() }} 
                <div class="col-span-12 sm:col-span-12"><label><b>Sender ID</b></label> 
              <input name="listid" type="hidden"  value="{{ $lists->id }}">
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
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                       <i data-feather="send" class="w-4 h-4 mr-2"></i>     Send </button>
      
                   
                   </div>
    
    
</div>
                <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->

                    
  
  

                    <h1 class="text-lg font-medium mr-auto" >
                    Contacts <?php // echo UserController::fullmonth($month); ?>
                    </h1>

                    
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                  
                    <div class="intro-y datatable-wrapper box p-5 mt-0">
                        <?php if($contactlists->count()==0){?>

                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> There is no birthday celebrant in this month </div>

                        <?php }else{?>


                    <table class="table" style="font-size:14px">
         <thead>
             <tr>
                 <th class="border border-b-2 whitespace-no-wrap"><input id='selectall' type="checkbox" class="input border mr-2" onClick="selectAll(this,'color')"  > Select all</th>
                 <th class="border border-b-2 whitespace-no-wrap">Name</th>
                 <th class="border border-b-2 whitespace-no-wrap">Date of Anniversary</th>
                 <th class="border border-b-2 whitespace-no-wrap">Contact</th>
            
             </tr>
         </thead>
         <tbody>
            
            
        
                    
                          @foreach($contactlists as $contactlist) 
                            <tr>
                            <td class="border">
                                <input type="checkbox" name="contacts[]" class="input border mr-2" value="{{$contactlist->contact}}" >
                                <input type="hidden" name="contactids[]" class="input border mr-2" value="{{$contactlist->id}}" >
                                <input type="hidden" name="name[]" class="input border mr-2" value="{{$contactlist->firstname}} {{$contactlist->lastname}}" >
                              
                            </td>
                            <td class="border">
                                    
                                        {{ucwords($contactlist->firstname)}} {{ucwords($contactlist->lastname)}}
                                    
                                </td>
                                <td class=" border">
                               {{$contactlist->annmonth}} {{$contactlist->annday}} 
                                </td>
                              
                                <td class="border">
                                {{$contactlist->contact}}
                                </td>
                                
                                
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                        <?php }?>
                    </div>
                        </form>          <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->




                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New contact</h2> 
             
         </div>
         <form  action="../addcontact/{{$lists->id}}" method="POST" >
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
                                                    <option>Choose month</option>
                                                    <option>January</option>
             <option>Februray</option>
             <option>March</option>
             <option>April</option>
             <option>May</option>
             <option>June</option>
             <option>July</option>
             <option>August</option>
             <option>September</option>
             <option>October</option>
             <option>November</option>
             <option>December</option>
         </select>     </div>
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Day</b></label>
                                                    <select name="birthday" class="input border mr-2 w-full">
                                                    <option>Choose day</option>
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
                </form>
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