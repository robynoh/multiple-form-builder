<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.passwordForgot')
@section('title')
    <title> User | Verification  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Verification</a> </div>
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
            




<div class="grid grid-cols-12 gap-6">


                <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12">

<br/><br/>

@if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

 <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                           
                            <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                                <div class="intro-x flex items-center h-10">
                                <h1 class="text-lg font-large truncate mr-auto" style="font-weight:bold;color:#000">
                                        Welcome, {{ ucwords(Auth::user()->name) }}
                                    </h1>
                                  </div>
                                <div class="mt-5 intro-x">
                                    <div class="slick-carousel box zoom-in" id="important-notes">
                                     
                                        <div class="p-5">
                                            <div class="text-base font-medium"> Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
      </div>
                                            
                                            <div class="font-medium flex mt-5">
                                            <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                <button type="submit" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white">Resend Verification Email</button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white">
                    {{ __('Logout') }}
                </button>
            </form>
        </div> </div>
                                        </div>

                                       
                                       
                                        
                                      
                                    </div>
                                </div>
                            </div>
                            <!-- END: Important Notes -->
                            <!-- BEGIN: Schedules -->
                   
                            <!-- END: Schedules -->
                        </div>
                    </div>

                        
                    </div>


                    
                    <!-- END: General Report -->
                    <!-- BEGIN: Sales Report -->
                
                    <!-- END: Sales Report -->
                    <!-- BEGIN: Weekly Top Seller -->
                  
                    <!-- END: Weekly Top Seller -->
                    <!-- BEGIN: Sales Report -->
                  
                    <!-- END: Sales Report -->
                   
                          
                    <!-- BEGIN: Weekly Best Sellers -->
                    

                  

                   
                    <!-- END: Weekly Best Sellers -->
                    <!-- BEGIN: General Report -->
                    
                    <!-- END: General Report -->
                    <!-- BEGIN: Weekly Top Seller -->
                   
                        <!-- END: Schedules -->
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

