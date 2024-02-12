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
                <h1 class="text-lg font-medium mr-auto" style="font-size:23px">
                Best Price &amp; Services
                    </h1>
               <br/>

                <div class="intro-y box mt-5 px-8 py-12">
                    
                    <!-- BEGIN: Pricing Tab -->
                    <div class="intro-y flex justify-center mt-6">
                        <div class="pricing-tabs nav-tabs box rounded-full overflow-hidden flex"> <a data-toggle="tab" data-target="#layout-2-monthly-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center active">Monthly Fees</a> <a data-toggle="tab" data-target="#layout-2-annual-fees" href="javascript:;" class="flex-1 w-32 lg:w-40 py-2 lg:py-3 whitespace-no-wrap text-center">Annual Fees</a> </div>
                    </div>
                    <!-- END: Pricing Tab -->
                    <!-- BEGIN: Pricing Content -->
                    <div class="flex mt-10">
                        <div class="tab-content">
                            <div class="tab-content__pane flex flex-col lg:flex-row active" id="layout-2-monthly-fees">
                                <div class="intro-y flex justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                    <div class="font-medium text-lg">Monthly Product Pricing</div>
                                    <div class="mt-3 lg:text-justify text-gray-700">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
                                        <p class="mt-2">When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="intro-y flex-1 border-t border-b lg:border-t-0 lg:border-b-0 lg:border-l lg:border-r border-gray-200 py-16 lg:ml-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase w-12 h-12 text-theme-1 mx-auto"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> 
                                    <div class="text-xl font-medium text-center mt-10">Business</div>
                                    <div class="text-gray-700 text-center mt-5"> 1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies </div>
                                    <div class="text-gray-600 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                    <div class="flex justify-center">
                                        <div class="relative text-5xl font-semibold mt-8 mx-auto"> 60 <span class="absolute text-2xl top-0 right-0 text-gray-500 -mr-4 mt-1">$</span> </div>
                                    </div>
                                    <button type="button" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8">PURCHASE NOW</button>
                                </div>
                                <div class="intro-y flex-1 py-16">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag w-12 h-12 text-theme-1 mx-auto"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> 
                                    <div class="text-xl font-medium text-center mt-10">Enterprise</div>
                                    <div class="text-gray-700 text-center mt-5"> 1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies </div>
                                    <div class="text-gray-600 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                    <div class="flex justify-center">
                                        <div class="relative text-5xl font-semibold mt-8 mx-auto"> 120 <span class="absolute text-2xl top-0 right-0 text-gray-500 -mr-4 mt-1">$</span> </div>
                                    </div>
                                    <button type="button" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8">PURCHASE NOW</button>
                                </div>
                            </div>
                            <div class="tab-content__pane flex flex-col lg:flex-row" id="layout-2-annual-fees">
                                <div class="intro-y flex justify-center flex-col flex-1 text-center sm:px-10 lg:px-5 pb-10 lg:pb-0">
                                    <div class="font-medium text-lg">Annual Product Pricing</div>
                                    <div class="mt-3 lg:text-justify text-gray-700">
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
                                        <p class="mt-2">When an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                                    </div>
                                </div>
                                <div class="intro-y flex-1 border-t border-b lg:border-t-0 lg:border-b-0 lg:border-l lg:border-r border-gray-200 py-16 lg:ml-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase w-12 h-12 text-theme-1 mx-auto"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> 
                                    <div class="text-xl font-medium text-center mt-10">Business</div>
                                    <div class="text-gray-700 text-center mt-5"> 1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies </div>
                                    <div class="text-gray-600 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                    <div class="flex justify-center">
                                        <div class="relative text-5xl font-semibold mt-8 mx-auto"> 120 <span class="absolute text-2xl top-0 right-0 text-gray-500 -mr-4 mt-1">$</span> </div>
                                    </div>
                                    <button type="button" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8">PURCHASE NOW</button>
                                </div>
                                <div class="intro-y flex-1 py-16">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag w-12 h-12 text-theme-1 mx-auto"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg> 
                                    <div class="text-xl font-medium text-center mt-10">Enterprise</div>
                                    <div class="text-gray-700 text-center mt-5"> 1 Domain <span class="mx-1">•</span> 10 Users <span class="mx-1">•</span> 20 Copies </div>
                                    <div class="text-gray-600 px-10 text-center mx-auto mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                                    <div class="flex justify-center">
                                        <div class="relative text-5xl font-semibold mt-8 mx-auto"> 210 <span class="absolute text-2xl top-0 right-0 text-gray-500 -mr-4 mt-1">$</span> </div>
                                    </div>
                                    <button type="button" class="button button--lg block text-white bg-theme-1 rounded-full mx-auto mt-8">PURCHASE NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Pricing Content -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->
            
@endsection

