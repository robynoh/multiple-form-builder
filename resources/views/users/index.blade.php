<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Dashboard  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Dashboard</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        </div>
                    <!-- END: Search -->
                  
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
            

<h1 class="text-lg font-large truncate mr-auto" style="font-weight:bold">
                                        Welcome, {{ ucwords(Auth::user()->name) }}
                                    </h1>
<?php echo $submsg; ?>

   

<div class="grid grid-cols-12 gap-6">


                <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Report -->
                    <div class="col-span-12 mt-3">

                   
                    <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/collect_information">    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="clipboard" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator  bg-theme-9 tooltip cursor-pointer" title="All Birthday List"> NB <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">{{$boards->count()}}</div>
                                        <div class="text-base text-gray-600 mt-1">Niche Boards</div>
                                    </div>
</a>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                  <a href="/users/optin-list">  <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="monitor" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="All Other Anniversary List"> OF <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">{{$optins->count()}}</div>
                                        <div class="text-base text-gray-600 mt-1">Optin Forms</div>
                                    </div>
</a>
                                </div>
                            </div>


                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/pay-history">     <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="file-text" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 text-white tooltip cursor-pointer" title="Total number of autoschedule lists"> IN <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">{{$payments->count()}}</div>
                                        <div class="text-base text-gray-600 mt-1">Payments</div>
                                    </div></a>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/my-package">   <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="credit-card" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="List of contacts"> P <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">{{ucfirst($package)}} <?php if($status->status==1){?> <b style="font-size:small;color:#94C826;font-weight:normal">Active</b> <?php }else if($status->status==2){?> <b style="font-size:small;color:#94C826;font-weight:normal">Active</b> <?php }else{ ?> <b style="font-size:small;color:#ff0000;font-weight:normal">Expired</b> <?php } ?></div>
                                        <div class="text-base text-gray-600 mt-1"> Package </div>
                                    </div>
</a>
                                </div>
                            </div>
                           
                        </div>






<br/><br/>

                       
                        <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                           
                            <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                                <div class="intro-x flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-auto" style="font-weight:bold">
                                        Getting Started
                                    </h2>
                                    <button data-carousel="important-notes" data-target="prev" class="slick-navigator button px-2 border border-gray-400 flex items-center text-gray-700 mr-2"> <i data-feather="chevron-left" class="w-4 h-4"></i> </button>
                                    <button data-carousel="important-notes" data-target="next" class="slick-navigator button px-2 border border-gray-400 flex items-center text-gray-700"> <i data-feather="chevron-right" class="w-4 h-4"></i> </button>
                                </div>
                                <div class="mt-5 intro-x">
                                    <div class="slick-carousel box zoom-in" id="important-notes">
                                     
                                        <div class="p-5">
                                             <div class="text-gray-500 mt-1 " style="color:black">
                                             
                                             <p class="mb-5" style="font-size:large">To be able to set up a sign up form to get the information of your leads using watawazi, you are required to go through just two steps. Which are creating a <b style="color:#006600">Niche Board</b> first and Creating an <b style="color:#006600">Interface</b> second. </p></div>
                                          
                                            <div class="font-medium flex mt-5">
                                                <a href="/users/get-started" class="button button--sm bg-theme-9" style="color:#fff">View More</a>
                                                </div>
                                        </div>
                                       
                                        
                                      
                                    </div>
                                </div>
                            </div>
                            <!-- END: Important Notes -->
                            <!-- BEGIN: Schedules -->
                   
                            <!-- END: Schedules -->
                        </div>
                    </div>


                    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                           
                            <div class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                                <div class="intro-x flex items-center h-10">
                                    <br/><br/>
                                    <h2 class="text-lg font-medium truncate mr-auto" style="font-weight:bold">
                                       Tutorial Videos
                                    </h2> 

                                    <a href="users/help-videos" data-carousel="important-notes" data-target="prev" class="slick-navigator button px-2 border border-gray-400 flex items-center text-gray-700 mr-2"> All video</a>
                                   

                                     </div>

                                <div class="intro-y grid grid-cols-12 gap-6 mt-5">
                                 <!-- BEGIN: Blog Layout -->
                    
                   
                  
                 @foreach($videos as $video)
                    <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box">
                       
                        <div class="p-5">
                            <div class="h-40 xxl:h-56 image-fit">
                                <a href="users/view-video/{{$video->vid_id}}">
                                <img alt="{{$video->title}}" class="rounded-md" src="{{$video->video_img}}">
</a>
                            </div>
                            <a href="users/view-video/{{$video->vid_id}}" class="block font-medium text-base mt-5" style="font-weight:bold;font-size:16px">{{ucfirst($video->title)}}</a> 
                         </div>
                        
                     
                    </div>
                    @endforeach

                    
                    <!-- END: Blog Layout -->
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

