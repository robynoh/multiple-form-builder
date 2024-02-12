<?php   use \App\Http\Controllers\UserController; ?>
<?php $senderids= UserController::pullsenderid();?>
@extends('layouts.userint')
@section('title')
    <title> User | List  </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i>{{$lists->name}} <i data-feather="chevron-right" class="breadcrumb__icon"></i> contacts</div>
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
                   Contacts
                </h2>
<br/>
               
               
<form action="/users/processmultiplemsg/{{$lists->id}}" method="POST">
{{ csrf_field() }} 
<table>
<tr>
<td>  
<a href="{{url()->previous()}}" class="button box bg-theme-1 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="chevron-left" class="breadcrumb__icon"></i>     Back </a>
                 
      
       </td>
                            <td>  <?php if($contactlists->count()>0){?> <button type="submit" class="button w-40 mr-2  flex items-center justify-center bg-theme-9 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Save </button>   <?php }?>          
</td>
</tr>



                     </table>   
<div class="grid grid-cols-12 gap-6 mt-5">

               
        
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                   <?php if($contactlists->count()<1){?>

                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">  This contact list is empty  </div>

                <?php }?>
                    <?php if($contactlists->count()>0){?>                       <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">  Type in anniversary SMS you want to send to contact and choose your desired time to send.</div>
<table width="30%">

<tr>
<td>

<select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
<option value="">Choose sender ID</option>
@foreach( $senderids as  $senderid)

<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
</td>


</tr>

</table>
<?php }?>

                   
<div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                    <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">NAME</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE ANNIVERSARY</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">TYPE</th>
                               
                                <th class="border-b-2 text-center whitespace-no-wrap">PHONE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">MESSAGE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">SEND TIME</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($contactlists as $contactlist)
                                <tr class="intro-x">
                                   
                                    <td class="border-b">
                                    <input type="hidden", name="contactid[]" value="{{$contactlist->annmonth}}">
                                        <a href="" class="font-medium whitespace-no-wrap">{{ucwords($contactlist->firstname)}} {{ucwords($contactlist->lastname)}}</a> 
                                        <div class="text-gray-600 text-xs whitespace-no-wrap"></div>
                                        <input type="hidden", name="firstname[]" value="{{$contactlist->firstname}}">
                                        <input type="hidden", name="lastname[]" value="{{$contactlist->lastname}}">
                                    </td>
                                    <td class="border-b">
                                    <input type="hidden", name="birthday[]" value="{{$contactlist->annday}}">
                                    <input type="hidden", name="birthmonth[]" value="{{$contactlist->annmonth}}">
                                   
                                    {{ucwords($contactlist->annmonth)}} {{ucwords($contactlist->annday)}}</td>

                                    <td class="border-b" style="color:#090">
                                    <input type="hidden", name="phone[]" value="{{$contactlist->contact}}">
                                   
                                    {{ucwords($contactlist->anniversary)}}
                                    </td>
                                    <td class="border-b">
                                    <input type="hidden", name="phone[]" value="{{$contactlist->contact}}">
                                   
                                    {{ucwords($contactlist->contact)}}
                                    </td>
                                    <td class="border-b">
                                    <textarea name="msg[]" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in birthday wishes here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>happy anniversary</textarea>
                       
                                    </td>
                                    <td class="border-b">
                                    <select name="sendtime[]">

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
<?php if($contactlists->count()>0){?>
<button type="submit" class="button w-40 mr-2  flex items-center justify-center bg-theme-9 text-white"> <i data-feather="save" class="w-4 h-4 mr-2"></i> Save </button> 
     <?php }?>                   
      
       </td>
                            <td>              
</td>
</tr>

                     </table>  
                <!-- BEGIN: Delete Confirmation Modal -->

</form>


                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New list</h2> 
             
         </div>
         <form  action="createlist" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label>Name</label> 
             <input name="title" type="text" class="input w-full border mt-2 flex-1" placeholder="title" required> </div>
            
             
             
            
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Create</button> </div>
    </form>  </div>
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
</script>