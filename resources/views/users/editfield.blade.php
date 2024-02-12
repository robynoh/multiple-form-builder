
<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Edit Field  </title>
@endsection
@section('content')



                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Collect Information</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Edit form field  </div>
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
                   Edit Form Question
                </h2>
<br/>
               

               <a href="/users/create_form_stp2/{{UserController::encrypt_decrypt($table,true)}}"  class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i> Go Back </a>             
                   
                 

<div class="px-5 sm:px-20  border-gray-200 " style="background:#fff">


 @if($errors->any())
 <br/><br/>
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
      <li>  {{$errors->first()}}</li>
        </Ol>
    </div>

@endif


                    @if(session('success'))

                    <br/><br/>
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif
            
                   


<div class="">

<br/>
<br/>
                            
                   
<form method="POST" action="">
{{ method_field("PUT")}}
 {{ csrf_field() }} 


                       <div> <label><b>Question</b></label>
                        <input name="fieldname" id="title" type="text" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ str_replace('_', ' ',$field->fields) }}"> </div>
                        <input name="id"  type="hidden" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ $field->id }}"> 
                        <input name="table"  type="hidden" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ $table }}"> </div>
                      
                        <br/>
                       <div class="mt-3"> <label><b>Answer type</b></label></div>

                      
     <div class="flex flex-col sm:flex-row mt-2">


     
				  

         <div class="flex items-center text-gray-700 mr-2"> <input type="radio" class="input border mr-2" id="horizontal-radio-chris-evans" name="option" value="radio" <?php if($field->type=='radio'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-chris-evans">Multiple choice</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-liam-neeson" name="option" value="checkbox"  <?php if($field->type=='checkbox'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Checkboxes</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-liam-neeson" name="option" value="textfield" <?php if($field->type=='text' || $field->type=='number'){ echo "checked";} ?> > <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Short answer</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="textarea" <?php if($field->type=='textarea'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Long answer text</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="selectMenu" <?php if($field->type=='selectMenu'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Dropdown</label> </div>
        <!-- <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="image"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Image/Photo</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="file"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Document</label> </div>
         <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2" id="horizontal-radio-daniel-craig" name="option" value="imagelive"> <label class="cursor-pointer select-none" for="horizontal-radio-daniel-craig">Live Camera Photo</label> </div>
-->
     </div>
     

     <div id="optTable" style="float:left;width:500px;<?php if( $field->type=='radio' || $field->type=='checkbox'){ }else{?>display:none <?php } ?>" class="flex flex-col sm:flex-row mt-5">
<table width="100%"> 
    <tr>
        <td>
<div>
    
<label><b>Add options</b></label> 
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

		 
				 
				  <table id="menuTable" style="float:left;width:500px;<?php if($field->type=='selectMenu'){ }else{?>display:none <?php } ?>">
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
				 
				 
				  <table id="inputT" style="float:left;width:500px;<?php  if($field->type=='text'){ }else{?> display:none <?php } ?>">
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
    <div class="mt-3"> <label><b style="font-size: 14px;">Description</b></label><i style="color:#ff0000;font-size:13px"> optional</i></div>

     






<div class="flex items-center text-gray-700 mr-2" style="font-size:14px"> 
 <input name="description" id="title" type="text" class="input w-full border mt-2" placeholder="Enter any further information needed to understand this question " value="{{$field->description}}"> </label> </div>

 <input name="oldfieldname"  type="hidden" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ $field->fields }}"> </div>
 <input name="oldoption"  type="hidden" class="input w-full border mt-2" placeholder="Enter your question here" value="{{ $field->type }}"> </div>

    </td>
   </tr>
</table>


<br/>


                 <table width="100%">

                 <tr>
                     <td>
                     <div class="mt-3"> <label><b style="font-size:14px;">Required</b></label></div>

                      
<div class="flex flex-col sm:flex-row mt-2">



             

    <div class="flex items-center text-gray-700 mr-2"> <input type="radio" class="input border mr-2"  name="required_option" value="yes" <?php if($field->required_type=='yes'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-chris-evans">Yes</label> </div>
    <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> <input type="radio" class="input border mr-2"  name="required_option" value="no" <?php if($field->required_type=='no'){ echo "checked";} ?>> <label class="cursor-pointer select-none" for="horizontal-radio-liam-neeson">Optional</label> </div>
    
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
                                       <a href="/users/create_form_edit/{{UserController::encrypt_decrypt($table,true)}}" class="button w-24 mr-1   block bg-gray-200 text-gray-600 ml-2">Go Back</a>
                         
                                       </td>
                                   </tr>
                        
                        </table>
     </div>

</form>

<br/><br/> 
                               
                               
                    </div>  
                    
                    



                   



                    <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Do you want to drop <b id="field"></b> field from form?</div>
                            <div class="text-gray-600 mt-2"> This process can not be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                           
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>
                </form>

                    </div>
 <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
      <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
        <script src="{{ asset('dist/js/app.js') }}"></script>
                   
    
    
        <script>


$(document).ready(function(){
     

     var title=$('#title').val();
  var option_type=$("input[name='option']:checked"). val(); 
  var optionValue=$('#optionValue').val(); 
  var _token = $('input[name="_token"]').val();

  $.ajax({
    url:'/users/displayprocessoption',
      method:'POST',
      data: {
        title:title,option_type:option_type,optionValue:optionValue,_token:_token
      },
      
      success:function(result){

         document.getElementById('sucmessage').innerHTML = result;
        $('#optionValue').val("");

       
     

      }});


     
   })

        $(document).ready(function(){
     

         
           var title=$('#title').val();
       var option_type=$("input[name='option']:checked"). val(); 
       var optionMenuValue=$('#optionMenuValue').val(); 
       var _token = $('input[name="_token"]').val();
       
       
     $.ajax({
         url:'/users/displayprocessmenuoption',
           method:'POST',
           data: {
             title:title,option_type:option_type,optionMenuValue:optionMenuValue,_token:_token
           },
           
           success:function(result){

    document.getElementById('sucmessage2').innerHTML = result;
	$('#optionMenuValue').val("");

            
          

           }});
          
        })






$('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      if($(this).val()=='radio' || $(this).val()=='checkbox'){
		  
		  $('#optTable').show();
		  $('#menuTable').hide();
		   $('#inputT').hide();
	  }
    else if($(this).val()=='yes' || $(this).val()=='no'){
		  
		 // $('#optTable').show();
		 // $('#menuTable').show();
		  // $('#inputT').hide();
	  }
	 else if($(this).val()=='selectMenu'){
		  
		  $('#menuTable').show();
		  $('#optTable').hide();
		   $('#inputT').hide();
	  }
	  else if($(this).val()=='textfield'){
		  
		  $('#menuTable').hide();
		  $('#optTable').hide();
		  $('#inputT').show();
	  }
	  
	  else{
		  
		 $('#optTable').hide();  
		  $('#menuTable').hide();  
		  $('#inputT').hide();
	  }
    }
  });

		

function enterOptions(){
	
    if($('#title').val()==''){
        
        
        $('#err').html('<span>Enter question first</span>');
    }
     else if($('#optionValue').val()==''){
        
        
        $('#err').html('<span>Please enter the options</span>');
        
    }
    else{
        
       var title=$('#title').val();
       var option_type=$("input[name='option']:checked"). val(); 
       var optionValue=$('#optionValue').val(); 
       var _token = $('input[name="_token"]').val();
    
       $.ajax({
         url:'/users/processoption',
           method:'POST',
           data: {
             title:title,option_type:option_type,optionValue:optionValue,_token:_token
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
         url:'/users/deleteoption',
           method:'POST',
           data: {
             title:title,option_type:option_type,optionid:optionid,_token:_token
           },
           
           success:function(result){

             // document.getElementById('sucmessage').innerHTML = result;
             //$('#optionValue').val("");

            alert(result);
          

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
        
       var title=$('#title').val();
       var option_type=$("input[name='option']:checked"). val(); 
       var optionMenuValue=$('#optionMenuValue').val(); 
       var _token = $('input[name="_token"]').val();
       
       
     $.ajax({
         url:'/users/processmenuoption',
           method:'POST',
           data: {
             title:title,option_type:option_type,optionMenuValue:optionMenuValue,_token:_token
           },
           
           success:function(result){

    document.getElementById('sucmessage2').innerHTML = result;
	$('#optionMenuValue').val("");

            
          

           }});
}			   
}

</script>

    
    
@endsection

            


