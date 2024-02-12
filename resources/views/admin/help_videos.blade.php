<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | List of Videos  </title>
@endsection
<?php $senderids= UserController::pullsenderid();?>
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Help Videos</a>  </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                    <div class="search hidden sm:block">
                        </div>
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                  
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative" >
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                         </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20" >
                            <div class="dropdown-box__content box text-white" style="background:#fff">
                                <div class="p-4 border-b border-theme-8">
                                    <div class="font-medium " style="color:#000"> {{ ucwords(Auth::user()->name) }}</div>
                                    <div class="text-xs text-theme-9">Manage Account</div>
                                 </div>
                              
                                 <div class="p-2" style="color:#000">
                                    <a href="user/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile</a>
                                    <a href="user/updatePassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password</a>
                               
                                </div>
                                <div class="p-2 border-t border-theme-8" style="color:#000">
                                
                                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>

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
              Help Videos
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
            

                    
<table>
<tr>
<td width="">  
<a href="/admin/addvideo"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="plus" class="w-4 h-4 mr-2"></i>Add video </a>  
  



      
       </td>
<td width="">  
  
  



      
       </td>
                           
</tr>

                     </table>  
               
                    <div class="intro-y datatable-wrapper box p-5 mt-1">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                               
                                <th class="border-b-2 whitespace-no-wrap">TITLE</th>
                                <th class="border-b-2 whitespace-no-wrap">VIEWS</th>
                                <th class="border-b-2 whitespace-no-wrap"></th>
                                <th class="border-b-2 whitespace-no-wrap"></th>
                               
                               
                               
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($videos as $video) 
                            <tr>
                                
                                <td class="border-b" width="80%">
                                    <div class="font-large whitespace-no-wrap"><b>{{ucwords($video->title)}}</b></div>
                                    
                                </td>

                                <td class="border-b" width="80%">
                                    <div class="font-large whitespace-no-wrap"><b>{{ucwords($video->view_count)}}</b></div>
                                    
                                </td>

                                <td class="border-b">
                                <a href="/admin/view-video/{{$video->vid_id}}"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="eye" class="w-4 h-4 mr-2"></i>view </a>  
 
                                    
                                </td>
                                <td class="border-b">
                                  
                                <a id="deleteUser{{ $video->vid_id}}" data-userid="{{$video->vid_id}}" href="javascript:void(0)" onclick="showAlertfrm3({{ $video->vid_id}});"   class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white"> <i data-feather="trash" class="w-4 h-4 mr-2"></i>Delete </a>  

                                  </td>

                              
                             
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
</div>
                    

                  


                </div>



              
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                
                    <!-- END: Pagination -->

                   
                </div>


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal3">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:15px">Do you really want to delete <b id="video_title"></b> video? This process cannot be undone. All data regarding this user will be removed totally</div>
                            <input type="hidden", name="id" id="vid_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel3();" >Yes! Delete</button>
                        </div>
                    </div>
                </div>
                </form>
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



        function showAlertfrm3(id){
    var user=id;
    var userID=$('#deleteUser'+user).attr('data-userid');
    $('#vid_id').val(userID); 
   $('#delete-confirmation-modal3').modal('show'); 
   
   getFieldname(user);
   
}

function getFieldname(id){
    var userId=id;
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'/admin/pullvideotitle',
            method: 'POST',
            data: {
                userId:userId,_token:_token
            },
            
            success:function(result){

                
             document.getElementById('video_title').innerHTML = result;
            
            }});

 


}


           
function senddel3(){

       
window.location="/admin/video/delete/"+$('#vid_id').val();
 

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
    </script>

