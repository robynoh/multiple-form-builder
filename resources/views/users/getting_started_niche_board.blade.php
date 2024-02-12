<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Get Started  </title>
@endsection
<?php $senderids= UserController::pullsenderid();?>
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Get Stated</a>  </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        </div>
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                  
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative" >
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                         </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20" >
                            <div class="dropdown-box__content box text-white" style="background:#fff">
                                <div class="p-4 border-b border-theme-8">
                                    <div class="font-medium " style="color:#000"> {{ ucwords(Auth::user()->name) }}</div>
                                    <div class="text-xs text-theme-9">Manage Account</div>
                                 </div>
                              
                                 <div class="p-2" style="color:#000">
                                    <a href="user/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile</a>
                                    <a href="user/updatePassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password</a>
                               
                                </div>
                                <div class="p-2 border-t border-theme-8" style="color:#000">
                                
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>

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
                
                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px;font-weight:bold">
               How To Create a Niche Board
                    </h1><br/>

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
<br/>
<br/>






                    
                  
                    <div class="px-5 sm:px-20  mt-5">
                  
                <p class="mb-5" style="font-size:large">
                The first step is to create a <b style="color:#006600">Niche Board</b>. Here is where you add the kind of field you want to display on your sign up form.
                It allows you to access and download the sign up information submitted by your leads in a given niche from your dashboard.
                You can create niche board for multiple niche depending on your interest as an affiliate marketer or an online business owner.
                
                </p>

                <p class="mb-5" style="font-size:large">
                To create Niche Board, please follow the direction bellow;
                </p>

                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Click the Niche Boards tab</b>
                                </a>

                                <img alt="geting started step 1"  src="{{ asset('dist/images/stp1.png') }}">
                    
                    
                    
                                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Click the Create Niche Board button</b>
                                </a>
<br/>
                                <img alt="geting started step 1"  src="{{ asset('dist/images/stp2.png') }}">
                 
                    
                                <br/><br/>

                                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Check (select) the fields you want to add to your sign up form and click the save button </b>
                                </a>
<br/>
                                <img alt="geting started step 1"  src="{{ asset('dist/images/stp3.png') }}">
                 <p style="font-size:large"><span style="color:#ff0000">*</span>You can click the <b>create personalized</b> field button to create your own custom fields if you want to. </p>
                                <br/><br/>

<a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
    <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
   <b> Click on the "Next" button. </b>
</a>
<br/>
<img alt="geting started step 1"  src="{{ asset('dist/images/stp4.png') }}">

<a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 rounded-full mr-3"></div>
                                   1. Enter the title of the board(e.g archive for people who are interested in weight loss.
                                </a>

                                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 rounded-full mr-3"></div>
                                   2. Enter the Niche (e.g Weight loss)
                                </a>


                                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                                    <div class="w-2 h-2 rounded-full mr-3"></div>
                                   3. A brief description and an image then save.
                                </a>

                                
                                <br/>
<img alt="geting started step 1"  src="{{ asset('dist/images/stp5.png') }}">


<br/>
<p class="mb-5" style="font-size:large">
<i><b>That is all you need to create a Niche Board.</b></i>
                </p>
                    

              <br/>
              <br/>

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

