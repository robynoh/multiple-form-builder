<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Profile  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Board settings</a> </div>
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
               Customise {{$niche}} board
                    </h1><br/>


                    <table>
<tr>
<td>  
<a href="/users/collect_information"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i>All Niche Board </a>  



      
       </td>
                            <td style="float:right"> <div class="clockContainer" style="font-size:15px">

                             </td>
</tr>

                     </table>  


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
            

<div class="intro-y box py-10 sm:py-20">
<div class="px-5 mt-5"><div class="px-5 sm:px-20">
                        <div class="intro-x flex items-center">
                            <button class="w-10 h-10 rounded-full text-gray-600 button bg-gray-200  " style="color:black"><i data-feather="layout" class="w-5 h-5 mr-2"></i> </button>
                            <div class="font-medium text-base ml-3"><a  <?php if($package !='free'){?>href="/users/interface/customise/{{UserController::encrypt_decrypt($tableid,true)}}" <?php }?>>Edit form theme</a><span style="font-size:15px;font-weight:normal;color:green"> Change the style (text color, font style,font size) of the sign up form of this niche board
                            <?php if($package =='free'){?>
                            <span class="text-xs px-1 rounded-full bg-theme-9 text-white mr-1">Premium</span><?php } ?></span></div>
                        </div>
                        <div class="intro-x flex items-center mt-5">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200" style="color:black"><i data-feather="edit" class="w-5 h-5 mr-2"></i></button>
                            <div class="text-base text-gray-700 ml-3"><a href="/users/acknowledgement/{{UserController::encrypt_decrypt($tableid,true)}}">Edit acknowledgement Message</a></div>
                        </div>
                     <!---   <div class="intro-x flex items-center mt-5">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200" style="color:black"><i data-feather="mail" class="w-5 h-5 mr-2"></i></button>
                            <div class="text-base text-gray-700 ml-3">Edit auto-respond email</div>
                        </div>-->
                       
                    </div>

                            
                            
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

