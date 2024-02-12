<?php   use \App\Http\Controllers\UserController;
use Illuminate\Support\Str;  ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | Profile  </title>
@endsection
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Profile</a> </div>
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
               Brand/Business Settings
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


@foreach($datas as $data)
<div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 pb-5 -mx-5">
                        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                                <img alt="brand logo" class="rounded-full" src="{{ asset($logos) }}">
                              </div>
                            <div class="ml-5">
                                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{$data->brand_name}}</div>
                                <div class="text-gray-600">{{$data->business_area}}</div>
                                <div class="truncate sm:whitespace-normal flex items-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail w-4 h-4 mr-2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> {{$data->business_email}} </div>
                           
                            </div>

                            
                        </div>
                      
                     
                    </div>
                   </div>
<br/>

            

<div class="intro-y box py-10 sm:py-20">


                  
                    <div class="px-5 sm:px-20  border-gray-200 ">
                       <form method="POST" action="">
                       {{ csrf_field() }} 
                        <div class="grid grid-cols-12 gap-4 row-gap-5 ">
 <?php // if(Usercontroller::userpackage()=='free'){?>
                       
                        <div class="intro-y col-span-12 sm:col-span-12">
                                <div class="mb-2"><b style="color:olivedrab">About Business</b></div>
                                {!! $data->about_business !!}  
                              
                             </div>
                             
                          

                             
                                <?php // } ?>
                          


                            
                           
                          
                           
                           @endforeach

                            
                          
                        </div>

</form>

                    </div>

                    
                  

                </div>


                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
               Niche Boards
                    </h1><br/>

                    @foreach($boards as $board)  
                   
                   <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                      
                      

                      
                     

                   </div>
                   <div class="datatable-wrapper box p-5 ">
                       

                 


                   <div class="px-5">
                           <div class="flex flex-col lg:flex-row items-center pb-5">
                               <div class="flex flex-col sm:flex-row items-center pr-5 lg:border-r border-gray-200">
                                   <div class="sm:mr-5">
                                       <div class="w-20 h-20 image-fit">
                                           <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ asset($board->logo) }}">
                                       </div>
                                   </div>
                                   <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                                       <a href="" class="font-medium text-lg"><?php echo ucfirst($board->title); ?></a> 
                                       <div class="text-gray-600 mt-1 sm:mt-0"><?php echo substr(ucfirst($board->note), 0,120) ?>...</div>
                                   </div>
                               </div>
                               <div class="w-full lg:w-auto mt-6 lg:mt-0 pt-4 lg:pt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-t-0 border-gray-200">
       

                               <div class="text-center rounded-md w-20 py-3">
                                       <div class="font-semibold text-theme-1 text-lg">{{ UserController::totalViews($board->table_id) }}</div>
                                       <div class="text-gray-600">Views</div>
                                   </div>
                                   <div class="text-center rounded-md w-20 py-3">
                                       <div class="font-semibold text-theme-1 text-lg">{{ UserController::totalEntry($board->table_id) }}</div>
                                       <div class="text-gray-600">Entries</div>
                                   </div>
                                   <div class="text-center rounded-md w-20 py-3">



                                  

                                   </div>
                               </div>
                           </div>
                           <div class="flex flex-col sm:flex-row items-center border-t border-gray-200 pt-5">
                               <div class="w-full sm:w-auto flex justify-center sm:justify-start items-center border-b sm:border-b-0 border-gray-200 pb-5 sm:pb-0">
                               <div class="px-3 py-2 bg-theme-7 text-theme-2 rounded font-medium mr-3"> <a href="/admin/interface/{{ UserController::encrypt_decrypt($board->table_id,true)}}/{{$board->userID}}">All Interface </a></div>
                               <div class="px-3 py-2 bg-theme-14 text-theme-10 rounded font-medium mr-3"> {{$board->niche}}</div>
                                   <div class="px-3 py-2 bg-theme-14 text-theme-10 rounded font-medium mr-3">{{ \Carbon\Carbon::parse($board->created_at)->diffForHumans() }}</div>
                                  
                               </div>
                              
                           </div>
                       </div>



      
      
       </div>

       @endforeach 


                <div class="modal" id="medium-modal-size-preview">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
New Image
</h2>
     <form action="/users/changeimage" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>

                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                  
                                    <a href="" class="w-3/5 file__icon file__icon--image mx-auto">
                                        <div class="file__icon--image__preview image-fit">
                                            <img id="blah" alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/brand_place_holder.png')}}">
                                        </div>
                                    </a>
                                    
                                    <input name="oldimage" type="hidden" value="{{$logos}}"   />
                                </div>
<br/>
                                <input name="file" type="file" onchange="readURL(this);"   required/>
                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
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
<script>
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

