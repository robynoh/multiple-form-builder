<?php   use \App\Http\Controllers\UserController;
$symbols=array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','>','=','?','@','[',']','\\','^','_','{','}','|','~','`');
$replacement=array(' ');// you can enter more replacements.

?>
@extends('layouts.userint')
@section('title')
    <title> User | Form Response  </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> Collect Information <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Board Response Data</a> </div>
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


                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
                Email List for {{$niche}} Niche
                    </h1><br/>
                    <form  action="" method="POST">

                    {{ csrf_field() }} 

                    <input type="hidden" name="tableid" value="{{$tableid}}" />
                    <table>
<tr>
<td>  
<a href="/users/interface/{{UserController::encrypt_decrypt($tableid,true)}}"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i>Go back to board</a>  



      
       </td>
                            <td style="float:left"> <div class="clockContainer" style="font-size:15px">
                            <button name="action" value="delete"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white"> <i data-feather="trash-2" class="w-4 h-4 mr-2"></i>Delete </button>  

                             </td>
</tr>

                     </table>  

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



<div class="grid grid-cols-12 gap-6 ">



<div class="intro-y box col-span-12">
    


                                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        Email records
                                    </h2>
                                    <div class="dropdown relative ml-auto sm:hidden">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                            <div class="dropdown-box__content box p-2">
                                            
                                          
                                            
                                                <a href="/users/exportresponse/{{UserController::encrypt_decrypt($tableid,true)}}" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="external-link" class="w-6 h-6 mr-2"></i> Export to Excel </a>
                                                
                                            
                                            </div>
                                        </div>
                                    </div>

                                   
                                   <span style="padding-left:10px">
                                        <a href="/users/exportresponse/{{UserController::encrypt_decrypt($tableid,true)}}" class="button border relative flex items-center text-gray-700 hidden sm:flex"> <i data-feather="external-link" class="w-6 h-6 mr-2"></i> Export to Excel </a>
</span>


                                </div>
                                <div class="datatable-wrapper box p-5 ">

                                <?php if($acount2<1){ ?>
                                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
Empty records

                                    </div>
		   <?php }else{?>
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">  <input id='selectall' class="input border border-gray-500" type="checkbox" onClick="selectAll(this,'color')">
                                   </th>
                            <th class="border-b-2 whitespace-no-wrap">Date</th>
                           @foreach($srows as $srow)
                                <th class="border-b-2 whitespace-no-wrap">{{ucfirst(str_replace($symbols,$replacement,$srow->fields))}}</th>
        
                               

                                @endforeach
                                <th class="border-b-2 whitespace-no-wrap"></th>
                                <th class="border-b-2 whitespace-no-wrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($srows2 as $srow2)
                            <tr>
                                <td class="border-b"> <input name="res[]" type="checkbox" class="input border mr-2" id="vertical-checkbox-daniel-craig" value="{{$srow2->id}}"></td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$srow2->enter_date}}</div>
                                    
                                </td>

                               @foreach($srows1 as $srow1)

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">
                                    
                               <?php  if ($srow1->fields=='state'){  echo UserController::get_state_name(UserController::fieldValue($srow2,str_replace($symbols,$replacement,$srow1->fields)));}else{echo ucwords(UserController::fieldValue($srow2,str_replace($symbols,$replacement,$srow1->fields))); }  ?>
			
                            
                            </div>
                                </td>

                               @endforeach

                               
                                <td class="border-b"> 
                                    <?php if($ascount>4){?>
                                    <div class="font-medium whitespace-no-wrap" style="color:#090">
                                   <a href="/users/resdetail/{{UserController::encrypt_decrypt($srow2->id,true)}}/{{UserController::encrypt_decrypt($tableid,true)}}" class="button w-10 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white tooltip cursor-pointer" title="More Information"><b> <i data-feather="more-horizontal" class="w-4 h-4 mr-2"></i></b></a>
                                </div>
                                    <?php }?> 
                                </td>

                               
                                
                                <td class="border-b">
                                    <a  id="deleteUser{{ $srow2->id}}" data-userid="{{$srow2->id}}" href="javascript:void(0)" onclick="showAlert({{ $srow2->id}});" class="button w-8 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white tooltip cursor-pointer" title="Delete Record"><b><i data-feather="trash-2" class="w-4 h-4 mr-2"></i></b></td>
                            </tr>
                            @endforeach

                            

                           
                          
                        </tbody>
                    </table>
                    <?php } ?>
                    </div>
                             </form>  
                            

                            
                       
                   
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
                        <div class="p-5 text-center" >
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="mt-5" style="font-size:18px">Do you want to delete this record?</div>
                            <div class="text-gray-600 mt-2" style="font-size:18px">This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                            <input type="hidden", name="tableid" id="tableid" value="{{$tableid}}">
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
       $("#show-type").val(list.type);
      
      


});


  $('#header-footer-modal-preview3').modal('show'); 
   
}


function submitlist(){

var id=$("#listid2").val();
var title=$("#title2").val();
var type=$("#type").val();
var _token = $('input[name="_token"]').val();
$.ajax({
      url:'/users/submitlistupdate',
            method: 'POST',
            data: {
              id:id,title:title,type:type,_token:_token
            },
            
            success:function(result){
              $('#header-footer-modal-preview3').modal('hide'); 
              $('#button-modal-preview').modal('show'); 
            }});



}

function senddel(){
    
    window.location="/users/response/delete/"+$('#app_id').val()+"/"+$('#tableid').val();
   
}

function selectAll(source) {
    checkboxes = document.getElementsByName('res[]');
    for(var i in checkboxes)
        checkboxes[i].checked = source.checked;
}
</script>