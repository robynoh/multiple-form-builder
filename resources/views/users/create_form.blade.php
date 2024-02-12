<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Profile  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Collect Information</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Create form  </div>
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
                Choose Optin form Fields 
                    </h1><br/>
                    <table>
<tr>
<td>  
<a href="/users/create_form"  class="button w-40 mr-2 mb-2 flex items-center justify-center bg-theme-10 text-white"> <i data-feather="layout" class="w-4 h-4 mr-2"></i>Basic Fields</a>  



      
       </td>
                            <td > <a href="/users/create_custom_field_new"  class="button w-50 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="user-check" class="w-4 h-4 mr-2"></i>Create Personalized Fields</a>  


                             </td>
                             <td>   


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

<div class="flex justify-center">
                        <button class="intro-y w-10 h-10 rounded-full button text-white bg-theme-1 mx-2">1</button>
                        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 text-gray-600 mx-2">2</button>
                        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 text-gray-600 mx-2">3</button>
                    </div>
<div class="px-5 mt-5 ">
    
                        <div class="font-medium text-center text-lg mt-5">Create the fields you want to display on form</div>
                        <div class="text-gray-600 text-center mt-2">Choose the required fields you want to display in your form and hit the Save button or create your own custom fields</div>
                        <div class="text-gray-600 text-center mt-2" style="color:forestgreen">The email box is checked delibrately because it is important for an optin form</div>
                   
                    </div>
                  
                    <div class="px-5 sm:px-20  border-t border-gray-200  mt-5">
                       <form method="POST" action="">
                       {{ csrf_field() }} 
                        <div class="grid grid-cols-70 gap-4 row-gap-5 mt-5 ">
                            
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                                <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" value="firstname" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Firstname</label> </div> </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="middlename"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Middlename</label> </div>       </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="lastname"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Lastname</label> </div>   </div>
                            
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                               <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="nickname"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Nickname</label> </div>   </div>
                            
                            <div class="intro-y col-span-12 sm:col-span-6">
                              
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="email" checked> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans"><b>Email</b></label> </div>  
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="address"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Address</label> </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="phone"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Phone No.</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="country"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Country</label> </div>
                            </div>
                           <!-- <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="state"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">State</label> </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="lga"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">LGA</label> </div>
                            </div>-->

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="occupation"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Occupation</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="department"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Department</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="name"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Name</label> </div>
                            </div>
                        
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="position"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Position</label> </div>
                            </div>

                           
                            
                            <div class="intro-y col-span-12 flex items-center justify-left  mt-5" >
                                
                            <button  class="button w-24  block bg-theme-9 text-white ml-2">Save</button>
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

