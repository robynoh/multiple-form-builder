<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | List  </title>
@endsection
@section('content')

<?php $senderids= UserController::pullsenderid();?>

                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <i data-feather="chevron-right" class="breadcrumb__icon"></i> contacts</div>
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
                <h2 class="intro-y text-lg font-medium mt-10">
                   Update <?php echo Usercontroller::get_list_type_brand($listid); ?>
                </h2>
<br/>

@if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif
               
               
<form action="/users/updatemultipleinfo" method="POST">
{{ method_field("PUT")}}
{{ csrf_field() }} 
<table>
<tr>
<td>  
<a href="/users/scheduleList" class="button box bg-theme-1 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="chevron-left" class="breadcrumb__icon"></i>     Back </a>
                 
      
       </td>
                            <td>  <button type="submit" class="button w-40 mr-2  flex items-center justify-center bg-theme-9 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Save</button>             
</td>
</tr>



                     </table>   
<div class="grid grid-cols-12 gap-6 mt-5">

               
        
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                       
<table>

<tr>
<td>

<table><tr>
<td><select name="senderid" style="width:250px;height:35px;font-weight:bold" required>

<option ><?php echo $sendero->senderID; ?></option>


</select></td>
<td>   <table><tr><td></td><td>
<a data-toggle="modal" data-target="#header-footer-modal-previewx" class="button w-20 mr-2  flex items-center justify-center bg-theme-7 text-white"> <i data-feather="sliders" class="w-4 h-4 mr-2"></i></a> 
</td></tr></table></td>


</tr></table>




</td>


</tr>

</table>
<br/>
                   
<div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                    <thead>
                            <tr>
                                <th></th>
                                <th class="border-b-2 whitespace-no-wrap">NAME</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE</th>
                                
                                <th class="border-b-2 text-center whitespace-no-wrap">PHONE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">MESSAGE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">SEND TIME</th>
                            </tr>
                        </thead>
                           
                            <tbody>
                                @foreach($lists as $contactlist)
                                <tr class="intro-x">
                                <td class="border-b"><i data-loading-icon="puff" class="w-8 h-8"></i></td>
                                   
                                    <td class="border-b">
                                    <input type="hidden", name="contact[]" value="{{$contactlist->id}}">
                                    <input type="hidden", name="contactid[]" value="{{$contactlist->birthMonth}}">
                                        <a href="" class="font-medium whitespace-no-wrap">{{ucwords($contactlist->reciever_name)}}</a> 
                                        <div class="text-gray-600 text-xs whitespace-no-wrap"></div>
                                        <input type="hidden", name="recievername[]" value="{{$contactlist->reciever_name}}">
                                       
                                    </td>
                                    <td class="border-b">
                                    <input type="hidden", name="birthday[]" value="{{$contactlist->birthDay}}">
                                    <input type="hidden", name="birthmonth[]" value="{{$contactlist->birthMonth}}">
                                   
                                    {{$contactlist->birthMonth}} {{$contactlist->birthDay}}</td>

                                  

                                    <td class="border-b">
                                    <input type="hidden", name="phone[]" value="{{$contactlist->reciever}}">
                                   
                                    {{ $contactlist->reciever}}
                                    </td>
                                    <td class="border-b">
                                    <textarea maxlength="160" name="msg[]" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in birthday wishes here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{$contactlist->msg}}</textarea>
                       
                                    </td>
                                    <td class="border-b">
                                    <select name="sendtime[]">
<option>{{ $contactlist->send_time}}</option>
                                    <option>12:00AM</option>
                                    <option>7:00AM</option>
                                    <option>5:00AM</option>
                                    </select>
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

                <table>
<tr>
<td>  
<button type="submit" class="button w-40 mr-2  flex items-center justify-center bg-theme-9 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Save </button> 
                 
      
       </td>
                            <td>              
</td>
</tr>

                     </table>  
                <!-- BEGIN: Delete Confirmation Modal -->

</form>






 <div class="modal" id="header-footer-modal-previewx">
 <div class="modal__content">

 <form action="/users/changesenderid/{{$listid}}" method="POST">
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







 


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">sure you want to delete this list?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
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
    
    window.location="/users/lists/delete/"+$('#app_id').val();
   
}
</script>