<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | Optin Interface  </title>
@endsection

<?php $senderids= UserController::pullsenderid();?>

@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a><i data-feather="chevron-right" class="breadcrumb__icon"></i><a style="color:#84C345" href="" class="breadcrumb--active"> Opt-in Interface </div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
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
                                    <a href="/user/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile</a>
                                    <a href="/user/updatePassword" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Update Password</a>
                               
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

       
                     
                     @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif



                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
              All Optin Forms
                    </h1><br/>
<?php echo $interfaces->links(); ?>
<br/>
<br/>
<div class="intro-y box ">
   
                   
                            <!-- BEGIN: Chat Active -->
                           
                            <!-- END: Chat Active -->
                            <!-- BEGIN: Chat Default -->
                          
                            <!-- END: Chat Default -->
                           
                            <div class="intro-y grid grid-cols-12 gap-6  p-10">


                           


                    <!-- BEGIN: Blog Layout -->
                @foreach($interfaces as $interface)
                                       <div class="intro-y col-span-12 md:col-span-6 xl:col-span-4 box ">
                        <div class="flex items-center border-b border-gray-200 px-5 py-4">
                            
                        <div class="w-10 h-10 flex-none image-fit">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ UserController::get_niche_logo($interface->table_id)}}" >
                            </div>
                            <div class="ml-3 mr-auto">
                                <a href="/users/interface/{{ UserController::encrypt_decrypt($interface->table_id,true)}}" class="font-medium">{{ UserController::get_niche_name($interface->table_id)}}</a> 
                                <div class="flex text-gray-600 truncate text-xs mt-1"> <a class="text-theme-1 inline-block truncate" href="">{{$interface->interface_name}}</a> <span class="mx-1">•</span> {{ \Carbon\Carbon::parse($interface->created_at)->diffForHumans() }} </div>
                         </div>
                            
                            
                            <div class="dropdown relative ml-3">
                                <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-gray-500"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical w-4 h-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg> </a>
                                <div class="dropdown-box mt-6 absolute w-40 top-0 right-0 z-20">
                                    <div class="dropdown-box__content box p-2">
                                         <a href="javascript:void(0)" id="deleteUser{{ $interface->id}}" data-userid="{{$interface->id}}" href="javascript:void(0)" onclick="showInterfaceBox({{ $interface->id}});" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4 mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> View Interface </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="h-40 xxl:h-56 image-fit">
                                <img alt="interface optin image" class="rounded-md" src="{{ asset($interface->img) }}">
                            </div>
                            <a href="" class="block font-medium text-base mt-5">{{$interface->title }}</a> 
                            <div class="text-gray-700 mt-2 sm:w-auto truncate" style="font-size:12px">{!!$interface->description !!}</div>
                        </div>
                        
                        <div class="px-5 pt-3 pb-5 border-t border-gray-200">

                            <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                                <div class="mr-2"> Views: <span class="font-medium text-theme-1">{{$interface->no_view}}</span> </div>
                                <div class="mr-2"> Entries: <span class="font-medium text-theme-1">{{$interface->no_entry}}</span> </div>
                               
                            </div>

                          
                            <div class="w-full flex text-gray-600 text-xs sm:text-sm mt-5 items-center">
                            <?php  if(Usercontroller::userpackage()!='free'){?>
                            <a href="http://{{Usercontroller::showsubdomain(Auth::user()->id)}}.watawazi.com/<?php echo $interface->id; ?>" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-32 text-white" > <i data-feather="eye" class="w-6 h-6 mr-2"></i> View Form </a> 
                          <?php }else{?>
                            <a href="/interface/optin/{{ UserController::encrypt_decrypt($interface->table_id,true)}}/{{ UserController::encrypt_decrypt($interface->id,true)}}/{{ UserController::encrypt_decrypt($interface->userID,true)}}" class="button w-full mr-2 mb-2 flex items-center justify-center bg-theme-32 text-white" > <i data-feather="eye" class="w-6 h-6 mr-2"></i> View Form </a>
                            <?php }?>
                           
                           
                            </div>

                           
                           
                        </div>
                    </div>

       @endforeach
                    
                    <!-- END: Blog Layout -->
                    <!-- BEGIN: Pagination -->
                    
                    <!-- END: Pagination -->
                </div>
                   
                          
</div>
<br/>
<br/>
 <?php echo $interfaces->links(); ?> 



 <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal3">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                           
                               <div class="p-5">
                            <div class="h-40 xxl:h-56 image-fit">
                                <img id="imgsrc" alt="interface optin image" class="rounded-md" src="">
                            </div>
                            <a href="" class="block font-medium text-base mt-5"><span id="title"></span></a> 
                            <div class="text-gray-700 mt-2"><span id="description"></span></div>
                        </div>   <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Close</button>
                         </div>
                    </div>
                </div>
                </form>



     



 
          
 
 

 
            
@endsection

<script>


function showconfirmSMS(){

    if($('input[name=question]:checked', '#myForm').val()=='no'){

        $('#medium-modal-size-preview').modal('hide'); 
    }
    else if($('input[name=question]:checked', '#myForm').val()=='yes'){
        $('#medium-modal-size-preview').modal('hide'); 
 $('#medium-modal-size-preview2').modal('show');

}
}


function updateMessage(){

if($('#message2').val()==''){

    $('#errormsg2').text('Please enter message!')
}else{
    $('#errormsg2').hide();

    var senderid=$('#senderid2').val(); 
    var message=$('#message2').val();
 var _token = $('input[name="_token"]').val();

 $.ajax({
    url:'/users/updateconfirmsms',
       method:'POST',
       data: {
         senderid:senderid,message:message,_token:_token
       },
       success:function(result){

$('#delete-confirmation-modal6').modal('show'); 
$('#medium-modal-size-preview').modal('hide');
        


       }});
   


}

}


function submitMessage(){

    if($('#message').val()==''){

        $('#errormsg').text('Please enter message!')
    }else{
        $('#errormsg').hide()

        var senderid=$('#senderid').val(); 
        var message=$('#message').val();
     var _token = $('input[name="_token"]').val();

     $.ajax({
        url:'/users/addconfirmsms',
           method:'POST',
           data: {
             senderid:senderid,message:message,_token:_token
           },
           
           success:function(result){

             
$('#medium-modal-size-preview2').modal('hide');
$('#delete-confirmation-modal5').modal('show');         


           }});
       


    }

}

function showAlertfrm(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal2').modal('show'); 
   
}


function showInterfaceBox(id){
    var interfaceid=id;
    var userID=$('#deleteUser'+interfaceid).attr('data-userid');
    $('#app_id').val(userID); 

    $.get('/users/pullinterfacedetail/'+interfaceid,function(detail){
     $("#title").text(detail.title);
     $("#description").text(detail.description);
     $('#imgsrc').attr('src', detail.img)
      

});

   $('#delete-confirmation-modal3').modal('show'); 

}


function showAlertfrm3(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id3').val(userID); 
   $('#delete-confirmation-modal3').modal('show'); 
   
   getFieldname(formid);
   
}

function getFieldname(id){
    var tableId=id;
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'/users/pullnichename',
            method: 'POST',
            data: {
                tableId:tableId,_token:_token
            },
            
            success:function(result){

                
             document.getElementById('niche').innerHTML = result;
            
            }});


}




function showAlertSMS(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id').val(userID); 
   $('#medium-modal-size-preview').modal('show'); 
   
}

function senddel(){

       
   window.location="/users/interface/delete/"+$('#app_id').val();
    
   
}

function senddel3(){

       
window.location="/users/form/delete/"+$('#app_id3').val();
 

}


function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }


        function switchsms(){

            alert('uerhiu');
        }

</script>
