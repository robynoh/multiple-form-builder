<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Edit Phone number  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Edit Contact</a><i data-feather="chevron-right" class="breadcrumb__icon"></i>{{$listname}} </div>
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
                Edit Contacts
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
      
      <form action="" method="POST">
      {{ method_field("PUT")}}
      {{ csrf_field() }}

      @foreach($contactlists as $contactlist)
          
      <table  style="width:100%">


                      <tbody class="input_fields_wrap">
     <tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label><b>Title</b></label> 
  <input name="title" type="text" class="input w-full border col-span mt-2" placeholder="Give a name to your contact list" value="{{$contactlist->title}}" required>
</div>
</td>
</tr>

<tr>
<td>
<div class="col-span-12 sm:col-span-12 mt-3"><label><b>Contacts</b></label> 
<span style="color:forestgreen"> (<i>Separate contacts with comma (,)</i> )</span>


<textarea name="numbers" class="input w-full border col-span mt-2" placeholder="Enter phone numbers separated with commas e.g 09012345678, 07012345678, 08012345678,...">{{$contactlist->numbers}}</textarea>
</div>
</td>
</tr>
</tbody>
</table>
<br/>
<table>
<tr>
<td> <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                          Update </button></td>
                          <td> <a href="/users/listDetail/{{$lists}}/phonebook" class="button w-24 border text-gray-700 mr-1">Go Back</button> </td>
</tr>

                   </table>
                   @endforeach
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

