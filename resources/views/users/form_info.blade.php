<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Form Information  </title>
@endsection
<?php $senderids= UserController::pullsenderid();?>
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
            

<div class="intro-y box">

<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                        Board Information
                                    </h2>
                                    <div class="dropdown relative ml-auto sm:hidden">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                            <div class="dropdown-box__content box p-2">
                                            <a href="/users/create_form_stp2" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"><i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Go Back </a> 
                                            
                                                
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/users/create_form_stp2" class="button border relative flex items-center text-gray-700 hidden sm:flex"> <i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Back </a>
                              
           

                                </div>
                                <br/><br/>

<div class="flex justify-center">
<button class="intro-y w-10 h-10 rounded-full button bg-gray-200 text-gray-600 mx-2">1</button>
                        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 text-gray-600 mx-2">2</button>
                        <button class="intro-y w-10 h-10 rounded-full button text-white bg-theme-1 mx-2">3</button>
                    </div>






                    
                  
                    <div class="px-5 sm:px-20  mt-5">
                    <form method="POST"  action="" enctype="multipart/form-data">

{{ csrf_field() }} 

<div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">




  
    <div class="intro-y col-span-12 sm:col-span-12">
        <div class="mb-2"><b>Brand/Business name</b> </div>
        <input name="organisation2" type="text" class="input w-full border flex-1" placeholder="Enter the name of your organisation/Business" value="{{$brand->brand_name }}" disabled>
        <input name="organisation" type="hidden" class="input w-full border flex-1" placeholder="Enter the name of your organisation/Business" value="{{$brand->brand_name }}">

    </div>

    <div class="intro-y col-span-12 sm:col-span-12">
        <div class="mb-2"><b>Board title</b> </div>
        <input name="title" type="text" class="input w-full border flex-1" placeholder="Enter title of board " value="{{ old('title') }}">
    </div>

    <div class="intro-y col-span-12 sm:col-span-12">
        <div class="mb-2"><b>Niche</b> </div>
        <input name="niche" type="text" class="input w-full border flex-1" placeholder="Enter blogging/Marketing niche " value="{{ old('title') }}">
    </div>

   





  

    <div class="intro-y col-span-12 sm:col-span-12">
    <div class="mb-2"><b>Description</b><span style="color:forestgreen"> (<i>A brief description of niche.</i> )</span></div>
     <textarea data-feature="basic" class="summernote" name="note">
     {{ old('note') }}
    </textarea>

    </div>

    <div class="intro-y col-span-12 sm:col-span-12">
       <div class="mb-6"><b>Upload Image</b><span style="color:forestgreen"></div>
           
       <input name="imgfile" type="file"   /> </div>


      
<!---
    
    <div class="intro-y col-span-12 sm:col-span-12"> 
                            <label><b>Confirmation SMS Message</b> <span style="color:forestgreen"> (<i> This is the message that will be sent to the mobile phone of members who fill and submit this form.</i> )</span></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="sms" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in message here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('sms') }}</textarea>
                        </div>
        
        <div class="intro-y col-span-12 sm:col-span-12" style="font-weight:bold;color:forestgreen;text-align:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160" style="font-weight:bold;color:forestgreen">chars left

</div>

                     
<div class="intro-y col-span-12 sm:col-span-12">
<label><b>Choose Sender ID to send SMS</b></label>

<select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
     
</div>
---->
      
    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
       
        <button class="button w-40 justify-center block bg-theme-1 text-white ml-2">Save</button>
    </div>
    <br/>
    <br/>
</div>


</form>

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

<script>

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }




        $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      if($(this).val()=='radio' || $(this).val()=='checkbox'){
		  
		  $('#optTable').show();
		  $('#menuTable').hide();
		   $('#inputT').hide();
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
    </script>

