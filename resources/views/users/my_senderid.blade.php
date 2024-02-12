<?php   use \App\Http\Controllers\AdminController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | My Sender ID Status  </title>
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
                   Sender ID Status
                </h2>


<div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-4 xl:col-span-3">
                    @include('layouts.sender')
                    </div>
                    <!-- END: FAQ Menu -->
                    <!-- BEGIN: FAQ Content -->
                    <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
                   
                        <div class="intro-y box lg:mt-5"> <div class="flex items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                Sender ID Status
                                </h2>
                            </div>
                            <div class="overflow-x-auto">
                        <table class="table " style="font-size:14px;">
                        <thead>
                            <tr>
                               
                                <th class="border-b-2 whitespace-no-wrap">ID</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE CREATED</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AUTHOR</th>
                               
                                <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($ids as $id) 
                            <tr>
                              
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$id->name}}</div>
                                    
                                </td>
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ \Carbon\Carbon::parse($id->created_at)->diffForHumans() }}</div>
                                </td>

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ AdminController::showusername($id->userID)}}</div>
                                </td>
                              
                                
                                <td class="border-b w-5">
                                    <?php if($id->status==0){?>
                                <span class="text-xs px-1 bg-theme-6 text-white mr-1" style="padding:5px;border-radius:5px">Pending</span>
                                <?php }?>
                                <?php if($id->status==1){?>
                                <span class="text-xs px-1 bg-theme-1 text-white mr-1" style="padding:5px;border-radius:5px">Processing ...</span>
                                <?php }?>
                                <?php if($id->status==2){?>
                                <span class="text-xs px-1 bg-theme-9 text-white mr-1" style="padding:5px;border-radius:5px">Approved</span>
                               <?php }?>
                            </td>
                                    
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    <br/>
                    <br/>
                        </div>
                                </div>
                       
                    </div>
                    <!-- END: FAQ Content -->
                </div>


                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">New Sender ID</h2> 
             
         </div>

         <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11" style="font-size:15px">
              Your sender ID should not be less than 11 character

               </div>
         <form id="form"  action="" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label>Sender ID</label> 
            
            
             
             <input id="id" name="id" type="text" class="input w-full border mt-2 flex-1" placeholder="Enter your sender ID" required> </div>
            
             
             
            
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> 
         <a href="javascript:void(0);" onclick="addsender();" class="button w-20 bg-theme-1 text-white">Submit</a> </div>
    </form> 


    <div id="succ" class="modal__content relative" style="display:none"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3">  </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Sender ID submitted succesfully</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>


 </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->
            
@endsection

<script language="JavaScript">
    function addsender(){

var name=$('#id').val();
$.get('/admin/insertname/'+name,function(list){
   
   //alert(list);
   $("#form").hide();
   $("#succ").show();


});

}
    </script>