<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Dashboard  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        </div>
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                    <div class="intro-x dropdown relative mr-auto sm:mr-6">
                        <div class="dropdown-toggle notification  cursor-pointer">Balance: <b>&#x20A6;</b> 5000.45 </div>
                        
                    </div>
                 
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
                <br/>
                <h1 class="text-lg font-medium mr-auto">
                   Groups
                    </h1>
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
            





<div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-2">

                   
                    <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/name_phone_only/{{$lists}}">    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="phone" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="All Birthday List"> Group <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                           
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">3</div>
                                        <div class="text-base text-gray-600 mt-1">Contact list with <b style="color:black">names</b> and <b style="color:black">phone numbers</b></div>
                                    </div>
</a>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-6 intro-y">
                                <div class="report-box zoom-in">
                                  <a href="/users/list">  <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="phone" class="report-box__icon text-theme-11"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-11 tooltip cursor-pointer" title="All Birthday List"> Group<i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">5</div>
                                        <div class="text-base text-gray-600 mt-1">Contact list with only <b style="color:black">phone numbers</b></div>
                                    </div>
</a>
                                </div>
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

