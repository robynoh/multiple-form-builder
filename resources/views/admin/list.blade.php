@extends('layouts.adminint')
<?php   use \App\Http\Controllers\AdminController; ?>
@section('title')
    <title> Admin | List  </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> </div>
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
                   Contact list
                </h2>

               <br/> 
<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview2" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New List </a>             
 
          
<div class="grid grid-cols-12 gap-6 mt-1">

               
                       
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                        
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">NAME</th>
                                <th class="border-b-2 whitespace-no-wrap">TYPE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE CREATED</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CREATED BY</th>
                               
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                               
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($lists as $list) 
                            <tr>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$list->name}}</div>
                                    
                                </td>
                                <td class="border-b">
                                <div class="font-medium whitespace-no-wrap" style="color:#090"><b><?php if($list->type=='other'){ echo "Other Anniversary" ;}if($list->type=='birthday'){ echo "Birthdays" ;} ?></b></div>
                                  
                                </td>
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div>
                                </td>

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ AdminController::showusername($list->userID)}}</div>
                                </td>
                              
                                
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                   
                                    <a class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" href="listDetail/{{$list->id}}/{{$list->type}}"><i data-feather="external-link" class="w-4 h-4 mr-1"></i> Open</a>
</div>
                                </td>
                                   

                                <td class="border-b w-5">
                                <div class="flex sm:justify-center items-center">
                                    <?php if (Auth::user()->id==$list->userID){?>                                    
                                   
                                    <a class="button button--sm w-8 mr-1 mb-2 bg-theme-6 text-white" id="deleteUser{{ $list->id}}" data-userid="{{$list->id}}" href="javascript:void(0)" onclick="showAlert({{ $list->id}});" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
                                   
                                    <?php } ?>
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
                <!-- BEGIN: Delete Confirmation Modal -->




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
            
             

             <div class="col-span-12 sm:col-span-12"><label>Type</label> 
            
            <select id="type" name="type" class="input w-full border mt-2 flex-1">
<option value="birthday">Birthdays</option>
<option value="other">Other Anniversary</option>
<option value="phonebook">Phone Book</option>

            </select>
             
              </div>
            
            
             
            
                                    
         </div>
        
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Create</button> </div>
    </form> 
 </div>




 <div class="modal" id="header-footer-modal-preview3">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">Edit list</h2> 
             
         </div>
         <form  action="createlist" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label>Name</label> 
             <input name="listid" id="listid2" type="hidden" class="input w-full border mt-2 flex-1"> 
             <input type="hidden", name="id" id="app_id2">
             
             <input name="title" id="title2" type="text" class="input w-full border mt-2 flex-1" placeholder="title" required>
             </div>

             <div class="col-span-12 sm:col-span-12"><label>Type</label> 
             
             
             
             <input name="showtype" id="show-type" type="text" class="input w-full border mt-2 flex-1" placeholder="title" disabled required>
             </div>
            
        
            
             <div class="col-span-12 sm:col-span-12"><label>Change Type</label> 
            
            <select id="type" name="type" class="input w-full border mt-2 flex-1">
<option value="birthday">Birthdays</option>
<option value="other">Other Anniversary</option>

            </select>
             
              </div>
             
            
                                    
         </div>
         
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <a href="javascript:void(0);" onclick="submitlist();"  class="button w-20 bg-theme-1 text-white">Save</a> </div>
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

                <div class="modal" id="button-modal-preview">
     <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Update Successful</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>
 </div>
                <!-- END: Delete Confirmation Modal -->
            
@endsection

<script>


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

    $.get('/users/pulllistdetail/'+id,function(list){

        $("#listid2").val(list.id);
       $("#title2").val(list.name);
      


});


  $('#header-footer-modal-preview3').modal('show'); 
   
}


function submitlist(){

var id=$("#listid2").val();
var title=$("#title2").val();
var _token = $('input[name="_token"]').val();
$.ajax({
      url:'/users/submitlistupdate',
            method: 'POST',
            data: {
              id:id,title:title,_token:_token
            },
            
            success:function(result){
              $('#header-footer-modal-preview3').modal('hide'); 
              $('#button-modal-preview').modal('show'); 
            }});



}

function senddel(){
    
    window.location="/users/lists/delete/"+$('#app_id').val();
   
}
</script>