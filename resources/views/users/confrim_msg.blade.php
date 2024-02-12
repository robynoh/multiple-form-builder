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
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Appreciation Message</a> </div>
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

                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
               Acknowledgement Message
                    </h1><br/>

                    <a href="/users/user_settings/{{$tableid}}"  class="button mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white" style="width:150px"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i>Go Back </a>  

                
              

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


                                <br/><br/>








                    
                  
                    <div class="px-5 sm:px-20  mt-5 ">
                    <form method="POST"  action="" enctype="multipart/form-data">

{{ csrf_field() }} 

<div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">




  
    <div class="intro-y col-span-12 sm:col-span-12">
        <div class="mb-2"><div style="float:left;font-size:14px"><b>Display Message after optin form Sign up</b></div><div style="float:left;padding-left:3px;color:royalblue"> <i data-feather="alert-circle" class="w-4 h-4 mr-2 tooltip cursor-pointer" title="This message will display as thank you message on optin"></i></div></div>
        <input name="thank" type="text" class="input w-full border flex-1 mt-3" placeholder="Enter the name of your organisation/Business" value="{{ $acknowledge->thankMsg }}">
    </div>

    <div class="intro-y col-span-12 sm:col-span-12">
        <div class="mb-2"><div style="float:left"><b>Autorespond email message on sign up</b></div><div style="float:left;padding-left:3px;color:royalblue"> <i data-feather="alert-circle" class="w-4 h-4 mr-2 tooltip cursor-pointer" title="This message will be sent as autorespond email on any optin"></i></div></div>
        <input name="email" type="text" class="input w-full border flex-1 mt-2" placeholder="Enter name of your board " value="{{$acknowledge->respEmail}}">
    </div>

    

   


                     


      
    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
       
        <button class="button w-40 justify-center block bg-theme-9 text-white ml-2">Save</button>
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

