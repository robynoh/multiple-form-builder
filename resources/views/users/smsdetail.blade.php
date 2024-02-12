<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Dashboard  </title>
@endsection
@section('content')


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Message</a> </div>
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
                 Report
                </h2>


<div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: FAQ Menu -->
                    <div class="intro-y col-span-12 lg:col-span-4 xl:col-span-3">
                    <div class="box mt-5">
                            <div class="px-4 pb-3 pt-5">
                            <a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview2" class="button w-40 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="send" class="w-4 h-4 mr-2"></i>
                                    <div class="flex-1 truncate">Resend SMS</div>
                                </a>
                                <a class="flex items-center px-4 py-2 mt-1" href="/users/my_senderid">
                                <div class="flex-1 truncate" style="font-size:20px;font-weight:bold">Status</div>
                                </a>
                                <a class="flex items-center px-4 py-2 " href="/users/senderid">

                                <?php if($smsx->status == 200){?>
                                <div class="flex-1 truncate" style="font-size:18px;color:limegreen">Sent (100%)</div>
                                <?php }else{?>

                                    <div class="flex-1 truncate" style="font-size:18px;color:red">Failed (0%)</div>
                               
                                    <?php }?>
                                </a>

                                <a class="flex items-center px-4 py-2 " href="/users/senderid">
                                <div class="flex-1 truncate" >{{$smsx->month}} {{$smsx->day}},{{$smsx->year}}</div>
                                </a>

                                <a class="flex items-center px-4 py-2 mt-1" href="/users/my_senderid">
                                <div class="flex-1 truncate"><b>List</b></div>
                                </a>
                                <a class="flex items-center px-4 py-2" >
                                <div class="flex-1 truncate"><i>{{UserController::listname($smsx->listID)}}</i></div>
                                </a>
                            </div>
                           
                          
                        </div>
                    </div>
                    <!-- END: FAQ Menu -->
                    <!-- BEGIN: FAQ Content -->
                    <div class="intro-y col-span-12 lg:col-span-8 xl:col-span-9">
                        <div class="intro-y box lg:mt-5">
                           
                            <div class="accordion p-5">
                                <div class="accordion__pane active border border-gray-200 p-4">
                                <h2 class="font-medium text-base mr-auto">
                                {{ucwords($smsx->name)}}
                                </h2>
                                     <div class="accordion__pane__content mt-3 text-gray-700 leading-relaxed"> {{$smsx->message}}</div>
                               
                               
<br/>
                                   <div class="flex ">
                                        <div class="flex items-center mr-5">
                                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                            <span>{{$smsx->phone}}</span> 
                                        </div>
                                        <div class="flex items-center mr-5">
                                            <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                                            <span>{{ \Carbon\Carbon::parse($smsx->created_at)->diffForHumans() }}</span> 
                                        </div>

                                        <div class="flex items-center ">
                                            <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                                            <span>{{$smsx->senderID}}</span> 
                                        </div>
</div>
                                    </div>
                             
                               
                            </div>
                        </div>
                       
                       
                    </div>
                    <!-- END: FAQ Content -->
                </div>

                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">Re-send SMS</h2> 
             
         </div>

         <div class="rounded-md flex items-center px-5 py-4 mb-2 " style="font-size:15px">
             Do you want to resend this message to  &nbsp;<b> {{ucwords($smsx->name)}}</b> ?

               </div>
         <form id="form"  action="/users/resendsms" method="POST" >
         {{ csrf_field() }} 
         <input name="id" type="hidden"  value="{{ $smsx->id }}">
         <input name="senderid" type="hidden"  value="{{ $smsx->senderID }}">
         <input name="phone" type="hidden"  value="{{ $smsx->phone }}">
         <input name="msg" type="hidden"  value="{{ $smsx->message }}">
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">No</button> 
         <button class="button w-20 bg-theme-1 text-white">Yes</button> </div>
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