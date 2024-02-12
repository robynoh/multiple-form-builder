<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Add New Field  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Collect Information</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Add New Field </div>
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

                <h2 class="intro-y text-lg font-medium mt-5">
                  Basic Field
                </h2>
<br/>

<table width="100%">
<tr>
<td width="5%">  
<a href="/users/create_form_stp2/{{ $tableid}}"  class="button w-40 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i>Back To All Field</a>  



      
       </td>
                            <td style="float:left">
                            <a href="/users/create_custom_field/{{$tableid}}" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="user-check" class="w-4 h-4 mr-2"></i>Create Custom Field </a>  

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
            

<div class="intro-y box">


<div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                    <h2 class="font-medium text-base mr-auto">
                                       <i> Choose from basic fields bellow or create a custom field in optin form</i>
                                    </h2>
                                   

                                 

                                </div>

                  
                    <div class="px-5 sm:px-20  border-gray-200  mt-5">
                       <form method="POST" action="">
                       {{ csrf_field() }} 
                        <div class="grid grid-cols-70 gap-4 row-gap-5 mt-5 ">
                            
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <input name="table" value="{{UserController::encrypt_decrypt($tableid,false)}}" type="hidden"  />
                           
                               
                                <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" value="firstname" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" <?php if(UserController::selectedField('firstname',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Firstname</label> </div> </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="middlename" <?php if(UserController::selectedField('middlename',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Middlename</label> </div>       </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                               
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="lastname" <?php if(UserController::selectedField('lastname',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Lastname</label> </div>   </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                              
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="email" <?php if(UserController::selectedField('email',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Email</label> </div>  
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="address" <?php if(UserController::selectedField('address',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Address</label> </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="phone" <?php if(UserController::selectedField('phone',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Phone No.</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="country" <?php if(UserController::selectedField('country',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Country</label> </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="state" <?php if(UserController::selectedField('state',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">State</label> </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="lga" <?php if(UserController::selectedField('lga',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">LGA</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="occupation" <?php if(UserController::selectedField('occupation',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Occupation</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="department" <?php if(UserController::selectedField('department',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Department</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="name" <?php if(UserController::selectedField('name',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Name</label> </div>
                            </div>
                        
                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="position" <?php if(UserController::selectedField('position',UserController::encrypt_decrypt($tableid,false))==1){ echo 'checked';} ?>> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Position</label> </div>
                            </div>

                            <div class="intro-y col-span-12 sm:col-span-6">
                            <div class="flex items-center text-gray-700 mr-2"> <input name="fields[]" type="checkbox" class="input border mr-2" id="horizontal-checkbox-chris-evans" value="age"> <label class="cursor-pointer select-none" for="horizontal-checkbox-chris-evans">Age</label> </div>
                            </div>

                           
                            
                            <div class="intro-y col-span-12 flex items-center justify-left  mt-5" >
                               <table> 
                                   <tr>
                                       <td>
                            <button type="submit"  class="button w-24  block bg-theme-9 text-white ml-2">Save</button>
                                       </td>
                                       <td>
                                      
                                       </td>
                                   </tr>
                        
                        </table>
                        
                        </div>


                              
                        </div>

                        <br/><br/><br/>

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

