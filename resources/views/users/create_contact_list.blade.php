<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Create contact list  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Create Contact List</a> </div>
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
                
                <h1 class="text-lg font-medium mr-auto mt-3" >
                Phonebook
                    </h1><br/>


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
                  
               
<div class=""  style="padding:20px">
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
To be able to create a phonebook from the submitted information, select the column where you have the phone numbers in the phone number drop down and also select the column where you have the names in the Names of Contact drop down
</div>
      <form action="" method="POST">
 
      {{ csrf_field() }}

    
          
      <table  style="width:100%">

                      <tbody class="input_fields_wrap">


                      <tr>
<td>
<div> <label><b>List name</b></label> <input type="text" name="listname" class="input w-full border mt-2" placeholder="contact list name"> </div>
      
</td>
</tr>
     <tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label><b>Phone Number</b></label> 
<span style="color:forestgreen"> (<i>Choose the column that contain the mobile numbers</i> )</span>
<select name="phones"  class="input w-full border col-span mt-2">
@foreach($fields as $field)
<option>{{$field->fields}}</option>
@endforeach
</select></div>
</td>
</tr>

<tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label><b>Name of Contacts</b></label> 

<span style="color:forestgreen">(<i>Choose the column that contain names</i> )</span>



<select name="names"  class="input w-full border col-span mt-2">
@foreach($fields as $field)
<option>{{$field->fields}}</option>
@endforeach
</select>


</div>
</td>
</tr>
</tbody>
</table>
<br/>
<table>
<tr>
<td> <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                          Create List </button></td>
                          <td> <a href="/users/response/" class="button w-24 border text-gray-700 mr-1">Go Back</button> </td>
</tr>

                   </table>
                 
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

