<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Profile  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Form</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Custom form Arrangement</a> </div>
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


<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                    Custom Field Arrangement
                                    </h2>
                                    <div class="dropdown relative ml-auto sm:hidden">
                                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal w-5 h-5 text-gray-700"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg> </a>
                                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                                            <div class="dropdown-box__content box p-2">
                                            <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"><i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Go Back </a> 
                                            
                                       
                                                
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <a href="/users/create_form_edit/{{ UserController::encrypt_decrypt($tableid,true)}}" class="button border relative flex items-center text-gray-700 hidden sm:flex"> <i data-feather="chevron-left" class="w-6 h-6 mr-2"></i> Back </a>
                              
                                 


                                </div>

<div class="px-5 ">
    
                            <div class="text-gray-600 text-center mt-2">Assign a number to the box before each field e.g 1,2,3,4... to determine the order at which they align in form</div>
                    </div>

                  
                    <div class="px-5 sm:px-20  border-gray-200  mt-5">
                       <form method="POST" action="">
                       {{ csrf_field() }} 
                       <input name="tableid" type="hidden" class="input w-20 h-15 border mt-2 border-gray-200" style="font-weight:bold;font-size:25px" value="{{$tableid}}" />
                                    
                       @foreach($fields as $field)
                       
<div style="background-color:#ccc;padding:5px"> <table> 
                                   <tr>
                                       <td style="background-color:gray;padding:5px">
                                       <input name="id[]" type="hidden" class="input w-20 h-15 border mt-2 border-gray-200" style="font-weight:bold;font-size:25px" value="{{$field->id}}" required>
                                       <input name="order[]" type="number" class="input w-20 h-15 border mt-2 border-gray-200" style="font-weight:bold;font-size:25px" required></td><td ><div class="mt-2 pl-5"><b>{{ ucwords(str_replace('_', ' ',$field->fields))}}</b></div></td></tr>
                                    </table> 
                                </div>

                                @endforeach
  
 <div class="intro-y col-span-12 flex items-center justify-left  mt-5" >
                               <table> 
                                   <tr>
                                       <td>
                            <button type="submit"  class="button w-24  block bg-theme-9 text-white ml-2">Save</button>
                                       </td>
                                       <td>
                                       <a href="/users/create_form_stp2" class="button w-24 mr-1   block bg-gray-200 text-gray-600 ml-2">Go Back</a>
                         
                                       </td>
                                   </tr>
                        
                        </table>
                        
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

