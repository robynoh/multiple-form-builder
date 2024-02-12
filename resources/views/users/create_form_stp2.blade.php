<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Profile  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Collect Information</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Create form  </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        </div>
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
                                    <a href="user/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile</a>
                                    <a href="user/updatePassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password</a>
                               
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
                <h2 class="intro-y text-lg font-medium mt-5">
                   Form Fields
                </h2>
<br/>

<table width="100%">
<tr>
<td width="5%">  
<a href="/users/new_field/{{ Usercontroller::encrypt_decrypt($tableid,true)}}"  class="button w-40 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i>New Field </a>  



      
       </td>
                            <td style="float:left">
                            <a href="/users/custom_form_arrange/{{ Usercontroller::encrypt_decrypt($tableid,true)}}"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="sliders" class="w-4 h-4 mr-2"></i>Custom Arrangement </a>  

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




            

<div class="intro-y box ">



<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                       <i> Current field(s) in optin</i>
                                    </h2>
                                    <div class="dropdown relative ml-auto sm:hidden">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                            <div class="dropdown-box__content box p-2">
                                            
                                                <a id="deleteUser{{$tableid}}" data-userid="{{$tableid}}" href="javascript:void(0)" onclick="showAlertfrm({{ $tableid}});"  class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="x" class="w-6 h-6 mr-2"></i> Cancel board  </a>
                                                
                                                
                                            
                                            </div>
                                        </div>
                                    </div>

                                   
                                    
                                   <span style="padding-left:10px">
                                        <a id="deleteUser{{$tableid}}" data-userid="{{$tableid}}" href="javascript:void(0)" onclick="showAlertfrm({{$tableid}});"  class="button border relative flex items-center text-gray-700 hidden sm:flex"> <i data-feather="x" class="w-6 h-6 mr-2"></i> Cancel board </a>
</span>


                                </div>
                                <div class="px-5 sm:px-20  border-gray-200  mt-10">
                    
                                <div class="grid grid-cols-12 gap-4 row-gap-5 ">
                            
                   
                   
                               
                            @foreach($fields as $field)
                            <div class="intro-y col-span-12 sm:col-span-6">
                                <label><b>{{str_replace('_', ' ',$field->fields)}}</b> <span style="color:orangered"><?php if($field->required_type=='yes'){ echo "*";} ?> </span>  <span><i><?php if($field->required_type=='no'){ echo "optional";} ?></i></span></label>

                                <table>
<tr>
<td>
                               <?php echo UserController::verifyField($field->fields,$field->type,Auth::user()->id,$tableid); ?>
                               <br/>
<span style="font-size:12px"><i>{{$field->description}}</i></span>
</td>
<td width="5%">
<a  id="deleteUser{{$field->id}}" data-userid="{{$field->id}}" href="javascript:void(0)" onclick="showAlert({{$field->id}});" class="tooltip cursor-pointer"  title="Remove {{ str_replace('_', ' ',$field->fields) }} field" ><i data-feather="trash-2"  style="color:red"></i> </a>
<a href="/users/editfield/{{ UserController::encrypt_decrypt($field->id,true) }}/{{ UserController::encrypt_decrypt($tableid,true)}}" class="tooltip cursor-pointer"  title="Edit question" ><i data-feather="edit"  style="color:darkslateblue"></i> </a>

</td>
                            </tr>                             
</table>
                            </div>
                           @endforeach
                          
                           
                          
                       
            </div>  </div>
                  <br/>
                  <br/>
                  <br/>
                  <br/>
 <?php if($fields->count()>0){?>

    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-30" style="padding-right:20px">
                                
                            
                                <a href="/users/form_info"  class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="chevron-right" class="w-4 h-4 mr-2"></i>Next</a>
                            </div>
                            <br/>
                            <br/>
    <?php }?>

                </div>



                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5" style="font-size:18px">Do you want to drop <b id="field"></b> field from form?</div>
                            <div class="text-gray-600 mt-2"> This process can not be undone.</div>
                            <input type="hidden", name="id" id="app_id2">
                            <input type="hidden" name="table" id="table" value="{{$tableid}}">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel2();" >Delete</button>
                        </div>
                    </div>
                </div>
                </form>
                
                  


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal2">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:18px">Do you really want to delete this board you are creating? This process cannot be undone. All data regarding this niche board will be removed totally</div>
                            <input type="hidden", name="id" id="app_id3">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-35 bg-theme-6 text-white" onclick="senddel3();" >Delete Board</button>
                        </div>
                    </div>
                </div>
                </form>


            </div>   
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                
                    <!-- END: Pagination -->

                   
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
                <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>           
                <!-- END: Delete Confirmation Modal -->
   <script>
    
    function showAlertfrm(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id3').val(userID); 
   $('#delete-confirmation-modal2').modal('show'); 
   
}



function showAlert(ids){
    var id=ids;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id2').val(userID); 
   $('#delete-confirmation-modal').modal('show');
   
   getFieldname(id);
   
}

function getFieldname(id){
    var fieldId=id;
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'/users/pullfieldname',
            method: 'POST',
            data: {
                fieldId:fieldId,_token:_token
            },
            
            success:function(result){
             document.getElementById('field').innerHTML = result;
            
            }});


}




function senddel2(){
    
    window.location="/users/removefield2/"+$('#app_id2').val()+"/"+$('#table').val();
   
}

function senddel3(){

      
 window.location="/users/form/delete/"+$('#app_id3').val();
 

}

</script>         
@endsection

