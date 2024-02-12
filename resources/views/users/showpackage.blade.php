<?php   use \App\Http\Controllers\UserController;
use Illuminate\Support\Str;  ?>
@extends('layouts.userint')
@section('title')
    <title> User | Payment Plan  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Payment Plan</a> </div>
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
              My Plan 
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




          

<div class="intro-y box ">


                  
                 

                    
                    <div class="modal__content modal__content--lg p-10 text-center"> 
                                            
                                    
                                            <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/proPackage.jpg') }}">
                   
                                            
                                                               <div class="mt-3 lg:text-justify text-gray-700">
                                          <p style="font-size:16px"> You are on <b>{{ucwords($package)}} {{ucwords($plan)}} Plan</b>.
                                          
                                          <?php if($package=='pro'){?>
                                          Here you have Everything you need to get huge result fast from your existing trafic.
                                        
                                        <?php }?>

                                        <?php if($package=='essential'){?>
                                          Here you have Everything you need to get more leads from your existing traffic.
                                        
                                        <?php }?>

                                        <?php if($package=='free'){?>
                                        You have access to some features that can get you started in getting more leads from your existing traffic. To Upgrade to a paid plan to allow you access all the features of this application, Click the upgrade me button bellow.
                                        
                                        <?php }?>
                                        </p>
                                          <p class="mt-2">
                                          
                                              <div class="border-t border-gray-200 mt-5 pt-5">
      
                                              <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md" style="font-size:19px">  <b>Features</b> </a>
                                              <?php if($package=='pro'){?>
                                      <a href="" class="flex items-center px-3 py-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          Unlimited Niche Boards
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          Unlimited Landing Pages
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                                          Unlimited Sign up Forms 
                                      </a>
      
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Unlimited Subscribers
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          No watawazi branding
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Social Media Sharing
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Search Engine Optimized Pages
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          Custom Form Design 
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                                          Instant Sign Up Email Notification 
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                                          Custom subdomain
                                      </a>
      
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          Autorespond thank-you email to subscribers
                                      </a>
                                   <?php }?>

                                   <?php if($package=='essential'){?>
                                      <a href="" class="flex items-center px-3 py-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          5 Niche Boards
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          5 Landing Page
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                                          10 Sign up Forms 
                                      </a>
      
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Unlimited Subscribers
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          No watawazi branding
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Social Media Sharing
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Seach engine Optimized pages
                                      </a>

                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          Custom Form Design 
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                                          Instant Sign Up Email Notification 
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                                          Custom subdomain
                                      </a>
      
                                     
                                   <?php }?>

                                   <?php if($package=='free'){?>
                                      <a href="" class="flex items-center px-3 py-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                          1 Niche Boards
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                                          1 landing Page
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                                          2 Sign up Forms 
                                      </a>

      
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Unlimited Subscribers
                                      </a>
                                      <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
                                          <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                          Social Media Sharing
                                      </a>

                                      <a href="/users/package" class="flex items-center px-3 py-2 mt-2 ">
                                         
                                        <u style="color:#000">  View Paid Plans and Features</u>
                                      </a>
                                      
                                      <br/>
      
                                      <table>
<tr>
<td>  
<a href="/users/package"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> Upgrade Me </a>  



      
       </td>
                          
</tr>

                     </table>  
                                     
                                   <?php }?>
                                    
                                  </div></p>
                                      </div>
                                          
                                          
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
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

