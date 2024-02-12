@extends('layouts.userint')
@section('title')
    <title> User | Add Sender  </title>
@endsection
@section('content')


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Sender ID</a> </div>
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
                <h2 class="intro-y text-lg font-medium ">
                   Sender ID
                </h2>


<div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-4 xl:col-span-3">
                    @include('layouts.sender')
                    </div>
                    <!-- END: FAQ Menu -->
                    <!-- BEGIN: FAQ Content -->
                    <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                What is sender ID?
                                </h2>
                            </div>
                            <div class="accordion p-5">
                                <div class="accordion__pane active border border-gray-200 p-4">
                                    <a href="javascript:;" class="accordion__pane__toggle font-medium block">What to know about a sender ID</a> 
                                    <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">An SMS Sender ID (or sender name) is the displayed value of who sent the message on your handset. For example, the Sender ID of your friend is their phone number. It can also be a shortcode, such as 12302. Or contain a limited number of characters, e.g. RAGURA.</div>
                                </div>
                                <div class="accordion__pane border border-gray-200 p-4 mt-3">
                                    <a href="javascript:;" class="accordion__pane__toggle font-medium block">Why Sender ID ?</a> 
                                    <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed">MTN Nigeria and Airtel Nigeria now requires pre-registration of Sender IDs before your can deliver bulk SMS to lines on their network with your customized Sender IDs.
For now, Sender ID Registration is FREE and should be completed within 2 business days..</div>
                                </div>
                               
                            </div>
                        </div>
                       
                       
                    </div>
                    <!-- END: FAQ Content -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->
            
@endsection

