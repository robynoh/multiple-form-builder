<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Autoschedule Birthday </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Birthday Scheduler</a> </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
                    <!-- END: Search -->
                    <!-- BEGIN: Notifications -->
                 
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="Midone Tailwind HTML Admin Template" src="{{ asset('dist/images/profile-12.jpg') }}">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium"> {{ Auth::user()->name }}</div>
                                    <div class="text-xs text-theme-41"> <?php



if(Auth::user()->role=="manage"){ echo"Super Admin"; }else if(Auth::user()->role=="manage-sub"){ echo"Admin";} ?></div>
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
               
                                 
                    
               
<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                   
                    <div class="w-full sm:w-auto flex sm:mt-0">
                    <form action="/users/autosms" method="POST">
                    

       

                       
       

                      
       
                                         
                    </div>
                </div>   
                <br/>
            

<div class="intro-y datatable-wrapper box p-5 mb-5" id="sms" >
               
               
            
            
            

            
       


                 
<table>
    <tr>
      <td><h1 class="text-lg font-medium mr-auto" style="font-size:23px">
This List has been activated to send SMS automatically</h1>
      </td>  
    </tr>
</table>

<br/>
<table>
<tr>
<td> <a href="/users/scheduleList" value="activate" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            View Autoschedule list </a></td>
                            <td>  </td>
</tr>

                     </table>   
</form>
</div>
                <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->

                    
  
  



                   
                <!-- BEGIN: Delete Confirmation Modal -->




                
    


              
                <!-- END: Delete Confirmation Modal -->
            
@endsection

<script>


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}

function senddel(){
    
    window.location="/users/contact/delete/"+$('#app_id').val();
   
}

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }

</script>

<script language="JavaScript">
function selectAll(source) {
    checkboxes = document.getElementsByName('contacts[]');
    for(var i in checkboxes)
        checkboxes[i].checked = source.checked;
}

function showMsg(){
    $('#sms').show();
    $('#swishes').hide();
    $('#cswishes').show();

}

function hideMsg(){
    $('#sms').hide();
    $('#swishes').show();
    $('#cswishes').hide();

}
</script>