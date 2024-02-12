<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Annual Pricing  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Package</a> </div>
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
                
               

                    <h2 class="intro-y text-2xl font-medium mt-10 text-center mr-auto">
                    Best Price &amp; Services
                </h2>


                   


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
<div class="intro-y flex justify-center mt-6">
                    <div class="pricing-tabs nav-tabs box rounded-full overflow-hidden flex"> <a data-toggle="tab" data-target="#" href="/users/my-package" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center">Monthly Fees</a> <a data-toggle="tab" data-target="#layout-1-annual-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center active">Annual Fees</a> </div>
                </div> 
                <br/> 
                
                <?php // echo $submsg; ?>

                <div class="flex mt-10">
                    <div class="">
                       
                        <div class="tab-content__pane flex flex-col lg:flex-row" id="layout-1-annual-fees">
                            <div class="intro-y flex justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                <div class="font-medium text-lg">Annual Subscription</div>
                                <div class="mt-3 lg:text-justify text-gray-700">
                                <p>You can choose to subscribe to use features of the application yearly. To subscribe for the monthly package, click the monthly fee tab above.</p>
                                  
                                </div>
                            </div>
                            <div class="intro-y flex-1 box py-16 lg:ml-5 mb-5 lg:mb-0">
                            <form action="{{ route('pay') }}" accept-charset="UTF-8" method="POST">

                            {{ csrf_field() }} 
                         <input type="hidden" name="metadata" value="{{ json_encode($array = ['package' =>'essential','type'=>'annual']) }}" >
                        
                         <input type="hidden" name="orderID" value="3">
                        
                         <input type="hidden"  name="amount"  value="2400000" />{{-- required in kobo --}}
                        
                         <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                        
                         <input type="hidden" name="currency" value="NGN"> 
                        
                         <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  
                        
                        
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase w-12 h-12 text-theme-9 mx-auto"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> 
                                <div class="text-xl font-medium text-center mt-10">Essential</div>
                                <div class="text-gray-700 text-center mt-5 p-5"> Essential tools to get more leads from your existing traffic on a yearly base </div>
                                <div class="text-gray-600 px-10 text-center mx-auto mt-2 text-theme-9"><a a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview"><b>View Features</b></a></div>
                                
                                <div class="flex justify-center">
                                    <div class="relative text-5xl font-semibold mt-8 mx-auto"> &nbsp; &#x20A6; 24,000 </div>
                                </div>
                               
                                <button type="submit" value="Pay Now!" class="button button--lg block text-white bg-theme-9 rounded-full mx-auto mt-8">SUBSCRIBE</button>

                            </form>
                            </div>
                            <div class="intro-y flex-1 box py-16 lg:ml-5">
                            <form   action="{{ route('pay') }}" accept-charset="UTF-8" method="POST">

                            {{ csrf_field() }} 
                         <input type="hidden" name="metadata" value="{{ json_encode($array = ['package' =>'pro','type'=>'annual']) }}" >
                        
                         <input type="hidden" name="orderID" value="4">
                        
                         <input type="hidden"  name="amount"  value="4800000" />{{-- required in kobo --}}
                        
                         <input type="hidden" name="email" value="{{Auth::user()->email}}"> {{-- required --}}
                        
                         <input type="hidden" name="currency" value="NGN"> 
                        
                         <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">  
                        
                        
                                                 
 
 
                        
                                                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag w-12 h-12 text-theme-9 mx-auto"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> 
                                <div class="text-xl font-medium text-center mt-10">Pro</div>
                                <div class="text-gray-700 text-center mt-5 p-5"> Everything you need to get huge result fast from your existing trafic yearly. </div>
                                <div class="text-gray-600 px-10 text-center mx-auto mt-2 text-theme-9"><a a href="javascript:;" data-toggle="modal" data-target="#large-modal-size-preview2"><b>View Features</b></a></div>
                                <div class="flex justify-center">
                                    <div class="relative text-5xl font-semibold mt-8 mx-auto">  &nbsp; &#x20A6; 48,000 </div>
                                </div>

                   
                                <button type="submit" value="Pay Now!" class="button button--lg block text-white bg-theme-9 rounded-full mx-auto mt-8">SUBSCRIBE</button>

                         
                            </form>
                            </div>
                        </div>
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

