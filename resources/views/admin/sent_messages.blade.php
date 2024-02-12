<?php   use \App\Http\Controllers\UserController;
use Carbon\Carbon;
 ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | today birthday </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sent Messages</a> </div>
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
                <h1 class="text-lg font-medium mr-auto mb-5" >
                    Message History
                    </h1>
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
                   <form action="" method="POST">
                   {{ csrf_field() }}
                    <table>
<tr>

                          
                        
                        <td >  <div class="mt-0">
                            
                        <select name="month" class="input border mr-2">
             <option value="">Month</option>
             <option>Jan</option>
             <option>Feb</option>
             <option>Mar</option>
             <option>Apr</option>
             <option>May</option>
             <option>Jun</option>
             <option>Jul</option>
             <option>Aug</option>
             <option>Sep</option>
             <option>Oct</option>
             <option>Nov</option>
             <option>Dec</option>
         </select> </div>
</td>

<td >  <div class="mt-0"> <select name="year" class="input border mr-2" >
             <option value="">Year</option>
             <?php for($i=Carbon::now()->format('Y'); $i <= 2050; $i++){?>
             <option><?php echo $i; ?></option>
             
             <?php }?>

         </select> </div>
</td>

<td>
         
         <button name="action" value="filter"  class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
         <i data-feather="filter" class="w-4 h-4 mr-2"></i>   Filter </button></td>

                            <td>
 <button name="action" value="delete" class="button w-32 mr-2 mb-0 flex items-center justify-center bg-theme-6 text-white"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </button>             
</td>                        
</tr>

                     </table>                   
 
  
               
                
                <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->

                    
                  


                    <div class="col-span-12 lg:col-span-20 xxl:col-span-10 ">
                        <!-- BEGIN: Inbox Filter -->
                        
                        <!-- END: Inbox Filter -->
                        <!-- BEGIN: Inbox Content -->
                        <?php if($smss->count()<1){?>
                            <br/>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
 --- no message  here yet ---
</div>

                       <?php }else{?>
                        <div class="intro-y inbox box mt-5  ">
                            <div class="p-5 w-full flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200">
                                <div class="flex items-center mt-3 sm:mt-0 border-t sm:border-0 border-gray-200 pt-5 sm:pt-0 mt-5 sm:mt-0 -mx-5 sm:mx-0 px-5 sm:px-0">
                                    <input id='selectall' class="input border border-gray-500" type="checkbox" onClick="selectAll(this,'color')">
                                   
                                 </div> <div class="ml-2">Select all </div>
                                 <div class="ml-2"> </div>
                                 
                                <div class="flex items-center sm:ml-auto">
                                    <div><?php echo $smss->links(); ?></div>
                                           </div>
                            </div>
                            <div class="overflow-x-auto sm:overflow-x-visible">
                                <div class="intro-y">
                                        
                                    @foreach($smss as $sms)
                                   
                                    <div class="inbox__item inbox__item--active inline-block sm:block text-gray-700 bg-gray-100 border-b border-gray-200">
                                 
                                    <div class="flex px-5 py-3"> 
                                       
                                            <div class="w-56 flex-none flex items-center mr-10">
                                                <input name="contacts[]" class="input flex-none border border-gray-500" type="checkbox" value="{{$sms->id}}">
                                                <?php if($sms->status == 200){?>

                                                    <a href="" class="text-theme-9 block" style="padding-left:10px">Sent</a>
                                               
                                               
                                                <?php }
                                                else{?>
                                                     <a href="" class="text-theme-6 block" style="padding-left:10px">Failed</a>
                                                  
                                                <?php }?>
                                                <div class="w-4 h-6 flex-none image-fit relative ml-5">
                                                   
                                                </div>
                                                <div class="inbox__item--sender truncate ml-3">{{$sms->senderID}}</div>
                                            </div>

                                            <div class="w-64 sm:w-auto truncate">  <a href="smsdetail/{{$sms->id}}"><span class="inbox__item--highlight">{{ucwords($sms->name)}}</span> {{$sms->message}} </a></div>
                                            <div class="inbox__item--time whitespace-no-wrap ml-auto pl-10">{{ \Carbon\Carbon::parse($sms->created_at)->diffForHumans() }}</div>
                                            
                                        </div></div>
                                                
                                        @endforeach


                                    
                                </div>
               
                                
                              
                            </div>
                           
                        </div>
                        <?php } ?>
                        <!-- END: Inbox Content -->
                    </div>
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                                                </form>
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->




                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New contact</h2> 
             
         </div>
         <form  action="../addcontact/" method="POST" >
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

function selectAll(source) {
    checkboxes = document.getElementsByName('contacts[]');
    for(var i in checkboxes)
        checkboxes[i].checked = source.checked;
}


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

