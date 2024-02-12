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
              How to Create an Interface
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
                The second step is to <b style="color:#006600">create interfaces</b>. Interface is simply the front-view of your sign up forms or  lead magnet. it include a title, description and an image e.g in weight loss niche you can have a lead magnet with titles like <b>10 EASY WAYS TO BURN BELLY FAT FAST</b>, <b>7 EXERCISE TO BUILD YOUR ABS FAST</b>, <b>5 THINGS TO KNOW ABOUT KETO DIET</b>... with their corresponding descriptions. What is common with these lead magnets is that they are all under the weight loss niche and in this regard, with this application any lead from these sign up forms will all be stored in the weight loss niche board you created earlier. 
    
                
                </p>

                <p class="mb-5" style="font-size:large">You can create as much as the number of sign up interfaces you desire for a given niche and be assured that you can have access to all your lead together  in one place.</p>
                    
                          
                <p class="mb-5" style="font-size:large">To create an interface, </p>

                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Click on the interface button on the niche board you created.</b>
                                </a>

                                <br/>
<img alt="geting started step 1"  src="{{ asset('dist/images/stp6.png') }}">


<br/>

                <a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Click the button with plus icon to create your sign up or lead magnet interface.</b>
                                </a>

                                <br/>
<img alt="geting started step 1"  src="{{ asset('dist/images/stp7.png') }}">

<br/>
<a href="" class="flex items-center px-3 py-2 rounded-md" style="font-size:large">
                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                   <b> Fill the fields as required and click the Create interface button.</b>
                                </a>

                                <br/>
<img alt="geting started step 1"  src="{{ asset('dist/images/stp8.png') }}">

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

