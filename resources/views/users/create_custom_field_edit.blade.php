<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Custom Fields  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Collect Information</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Create Custom Field  </div>
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
                  Custom Field
                </h2>
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
            

<div class="intro-y box ">




<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        New Field
                                    </h2>
                                    <div class="dropdown relative ml-auto sm:hidden">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                            <div class="dropdown-box__content box p-2">
                                            <a href="/users/create_form_edit" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"><i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Go Back </a> 
                                            
                                            <a href="" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"><i data-feather="layout" class="w-6 h-6 mr-2"></i> Basic Field </a>
                                            
                                                
                                                
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/users/new_field_edit/{{UserController::encrypt_decrypt($tableid,'true')}}" class="button border relative flex items-center text-gray-700 hidden sm:flex"> <i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Go back to basic field</a>
                              
                                    
                                   


                                </div>


<div class="px-5 mt-5 ">
    
                         <div class="text-gray-600 text-center mt-2">Enter the name of field you want to create, choose the type of the field you want and click "Save" button </div>
                    </div>
                  
                    <div class="px-5 sm:px-20   mt-5">
                    <form method="POST" action="">
                       {{ csrf_field() }} 


                       <div> <label><b>Question</b></label>
                        <input name="fieldname" id="fieldname" type="text" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ old('fieldname') }}"> 
                        <input name="tableid" id="tableid" type="hidden" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ $tableid }}"> 
                       

                        <br/>
                       <div class="mt-3"> <label><b>Answer type</b></label></div>

                      
     <div class="flex flex-col sm:flex-row mt-2">


     
				  

         <div class="flex items-center text-gray-700 mr-2"> <input type="radio" class="input border mr-2" id="horizontal-radio-chris-evans" name="option" value="radio"> <label class="cursor-pointer select-none" for="horizontal-radio-chris-evans">Multiple choice</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-liam-neeson" name="option" value="checkbox"> <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Checkboxes</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-liam-neeson" name="option" value="textfield" value="horizontal-radio-liam-neeson"> <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Short answer</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="textarea"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Long answer text</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="selectMenu"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Dropdown</label> </div>
        <!-- <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="image"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Image/Photo</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="file"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Document</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="imagelive"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Live Camera Photo</label> </div>
-->
     </div>
     

     <div id="optTable" style="float:left;width:500px;<?php if(isset($_GET['update']) && $_GET['update']=='NO_OPTIONS'){ }else{?>display:none <?php } ?>" class="flex flex-col sm:flex-row mt-5">
<table width="100%"> 
    <tr>
        <td>
<div>
    
<label><b>Enter options</b></label> 
<span id="err" style="color:#ff0000;font-size:12px"></span>
				   <br/>
				
<input id="optionValue" type="text" class="input w-full border mb-2" placeholder="Enter option"> 

</div>
        </td>
        <td><a href="javascript:void(0);" onclick="enterOptions()" class=" mt-4" style="background:#ccc;padding:10px;border-radius:5px"> Enter </a>
</td>
</tr>
<tr>
    <td colspan="2"> <div id="sucmessage" style="padding-bottom:10px" ></div></td>
</tr>

</table>             			 
</div>





<div class=" mt-5">

		 
				 
				  <table id="menuTable" style="float:left;width:500px;<?php if(isset($_GET['update']) && $_GET['update']=='NO_OPTIONSii'){ }else{?>display:none <?php } ?>">
				   <tr>
				   <td colspan="3"> <b>Enter dropdown options</b></td>
				  
				   
				   </tr>
				 <tr>
				  <td style="padding-right:10px" colspan="3"><input type="text"  id="optionMenuValue"class="input w-full border mb-2" style="width:70%" /> 
				  <a href="javascript:void(0);" onclick="enterMenuOptions()" style="background:#ccc;padding:10px;border-radius:5px"> Enter </a> </td>
				  </tr>
				  <tr>
				  <td>
				   <span id="err2" style="color:#ff0000;font-size:12px"></span>
				   <br/>
				 <div id="sucmessage2" style="padding-bottom:10px"></div>
				  </td>
				  
				  </tr>
				 </table>
				 
				 
				  <table id="inputT" style="float:left;width:500px;<?php  if(isset($_GET['update']) && $_GET['update']=='NO_TEXT_TYPE'){ }else{?> display:none <?php } ?>">
				   <tr>
				   <td colspan="3"> <b>Choose text type allowed for short text</b></td>
				  
				   
				   </tr>
                   <tr>
				  <td style="padding-right:10px" colspan="3">
				  <br/>
				  <select name="input_type" class="input border mt-2 flex-1 bg-gray-200" style="width:50%" >
				  <option value="" >Choose type</option>
				  <option value="text">Text</option>
				  <option value="number">Number</option>
          <option value="email">Email</option>
                  <option value="date">Date</option>
				  
				  </select>
				 
				  
				  
				   </td>
				   
				  </tr>
				  <tr>
				  <td>
				   
				  </td>
				  
				  </tr>
				 </table>


                 <table width="100%">

<tr>
    <td>
    <div class="mt-3"> <label><b>Description</b></label><i style="color:#ff0000;font-size:13px"> optional</i></div>

     






<div class="flex items-center text-gray-700 mr-2" style="font-size:14px">  <input name="description" id="description" type="text" class="input w-full border mt-2" placeholder="Enter any further information needed to understand this question " value="{{ old('description') }}"> </label> </div>


    </td>
   </tr>
</table>


                 <table width="100%">

                 <tr>
                     <td>
                     <div class="mt-3"> <label><b>Required</b></label></div>

                      
<div class="flex flex-col sm:flex-row mt-2">



             

    <div class="flex items-center text-gray-700 mr-2"> <input type="radio" class="input border mr-2"  name="required_option" value="yes"> <label class="cursor-pointer select-none" for="horizontal-radio-chris-evans">Yes</label> </div>
    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2"  name="required_option" value="no"> <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Optional</label> </div>
    
</div>
                     </td>
                    </tr>
                 </table>
				 
</div>







     


 <div class="mt-5">
     <br/><br/>
     <table width="100%"> 
                                   <tr>
                                       <td width="2%">
                            <button type="submit"  class="button w-24  block bg-theme-9 text-white ml-2">Save</button>
                                       </td>
                                       <td >
                                       <a href="/users/create_form_stp2" class="button w-24 mr-1   block bg-gray-200 text-gray-600 ml-2">Go Back</a>
                         
                                       </td>
                                   </tr>
                        
                        </table>
     </div>

</form>

<br/><br/><br/><br/><br/><br/>
                    </div>

                  


                </div>



            </div>   
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                
                    <!-- END: Pagination -->

                   
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->
           
@endsection
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="{{ asset('dist/js/app.js') }}"></script>
        <script>
function enterOptions(){
	
    if($('#title').val()==''){
        
        
        $('#err').html('<span>Enter question first</span>');
    }
     else if($('#optionValue').val()==''){
        
        
        $('#err').html('<span>Please enter the options</span>');
        
    }
    else{
        
        var fieldname=$('#fieldname').val();
       var option_type=$("input[name='option']:checked"). val(); 
       var optionValue=$('#optionValue').val(); 
       var _token = $('input[name="_token"]').val();
    
       $.ajax({
         url:'/users/processoptiontemprary',
           method:'POST',
           data: {
             fieldname:fieldname,option_type:option_type,optionValue:optionValue,_token:_token
           },
           
           success:function(result){
      
             document.getElementById('sucmessage').innerHTML = result;
             $('#optionValue').val("");

            
          

           }});


}			   

}


function deleteOptions(val){ 
	 var optionid=val;
	 var title=$('#title').val();
     var option_type=$("input[name='option']:checked"). val(); 
     var _token = $('input[name="_token"]').val();
     $.ajax({
         url:'/users/deleteoptiontemprary',
           method:'POST',
           data: {
             title:title,option_type:option_type,optionid:optionid,_token:_token
           },
           
           success:function(result){

              document.getElementById('sucmessage').innerHTML = result;
             $('#optionValue').val("");

            
          

           }});
	 
     
    
	 
 }


 function deleteMenuOptions(val){ 
	 var menuid=val;
	 var title=$('#title').val();
     var option_type=$("input[name='option']:checked"). val(); 
     var _token = $('input[name="_token"]').val();
     $.ajax({
         url:'/users/deletemenuoption',
           method:'POST',
           data: {
             title:title,option_type:option_type,menuid:menuid,_token:_token
           },
           
           success:function(result){

              document.getElementById('sucmessage2').innerHTML = result;
              $('#optionMenuValue').val("");

            
          

           }});
	 
     
    
	 
 }


 

function enterMenuOptions(){
	
    if($('#title').val()==''){
        
        
        $('#err2').html('<span>Enter question first</span>');
        
    }
    else if($('#optionMenuValue').val()==''){
        
        
        $('#err2').html('<span>Please enter dropdown options</span>');
        
    }
    else{
        
       var fieldname=$('#fieldname').val();
       var option_type=$("input[name='option']:checked"). val(); 
       var optionMenuValue=$('#optionMenuValue').val(); 
       var _token = $('input[name="_token"]').val();
       
       
     $.ajax({
         url:'/users/processmenuoptiontemprary',
           method:'POST',
           data: {
             fieldname:fieldname,option_type:option_type,optionMenuValue:optionMenuValue,_token:_token
           },
           
           success:function(result){

    document.getElementById('sucmessage2').innerHTML = result;
	$('#optionMenuValue').val("");

            
          

           }});
}			   
}

</script>