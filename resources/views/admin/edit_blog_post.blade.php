<?php   use \App\Http\Controllers\UserController;
        use \App\Http\Controllers\AdminController;
 
 ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | Edit Blog Post  </title>
@endsection
<?php $senderids= UserController::pullsenderid();?>
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Edit post</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Blog  </div>
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
                   Edit Post
                </h2>
<br/>

<table width="100%">
<tr>
<td width="20%">  
<a href="/admin/articles"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i>Go Back </a>  



      
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
            

<div class="intro-y box ">


                  
                    <div class="px-5 sm:px-20  ">

                    
                    <form method="POST"  action="/admin/blogupdate/{{$blog->id}}" enctype="multipart/form-data">
                    {{ method_field("PUT")}}
{{ csrf_field() }} 

<div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">




<div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>

                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                  
                                    <a href="" class="w-3/5 file__icon file__icon--image mx-auto">
                                        <div class="file__icon--image__preview image-fit">
                                            <img id="blah" alt="Midone Tailwind HTML Admin Template" src="{{ asset($blog->img)}}">
                                        </div>
                                    </a>
                                    
                                  
                                </div>
<br/>
                                <input name="file" type="file" onchange="readURL(this);"   />
                            </div>

  
    <div class="intro-y col-span-12 sm:col-span-12 mt-5">
        <div class="mb-2"><b>Title</b> </div>
        <input name="title" type="text" class="input w-full border flex-1" placeholder="Enter the name of your Business" value="{{ $blog->title }}">
        <input name="blogid" type="hidden" class="input w-full border flex-1" placeholder="Enter the name of your Business" value="{{ $blog->id }}">
    
    </div>

    


   





  

    <div class="intro-y col-span-12 sm:col-span-12 mt-5">
    <div class="mb-2"><b>Article Detail</b><span style="color:forestgreen"> </span></div>
     <textarea data-feature="all" class="summernote" name="description" >
     {{ $blog->content }}
    </textarea>

    

    </div>


    <div class="intro-y col-span-12 sm:col-span-12 mt-5">
    <div class="mb-2"><b>Category</b><span style="color:forestgreen"> </span></div>
    


<div class="mt-2"> <select name="category" class="input input--lg border mr-2">
    <option>{{$blog->category}}</option>
<?php echo AdminController::pullallcategory(); ?>
         </select> </div>

    

    </div>

   

      

    
    

                     

      
    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
       
        <button class="button w-40 justify-center block bg-theme-9 text-white ml-2">Save</button>
    </div>

    <br/>
    <br/>
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

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }




        $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      if($(this).val()=='radio' || $(this).val()=='checkbox'){
		  
		  $('#optTable').show();
		  $('#menuTable').hide();
		   $('#inputT').hide();
	  }
	 else if($(this).val()=='selectMenu'){
		  
		  $('#menuTable').show();
		  $('#optTable').hide();
		   $('#inputT').hide();
	  }
	  else if($(this).val()=='textfield'){
		  
		  $('#menuTable').hide();
		  $('#optTable').hide();
		  $('#inputT').show();
	  }
	  
	  else{
		  
		 $('#optTable').hide();  
		  $('#menuTable').hide();  
		  $('#inputT').hide();
	  }
    }
  });

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

        function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }
    </script>

