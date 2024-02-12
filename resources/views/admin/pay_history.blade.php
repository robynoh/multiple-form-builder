@extends('layouts.adminint')
<?php   use \App\Http\Controllers\AdminController;
use Carbon\Carbon; ?>
@section('title')
    <title> Admin | Pay History  </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Payment History</a> </div>
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
                <h2 class="intro-y text-lg font-medium mt-10">
                   Payment History
                </h2>

               <br/> 

               
               @if ($errors->any())

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> 
    
   
        <Ol>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </Ol>
    </div>
@endif


@if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif


               <form action="/admin/senderidprocess" method="POST">
               {{ csrf_field() }}
              

               
          
<div class="grid grid-cols-12 gap-6 mt-1">

               
                       
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible"> 
           
                    <div class="intro-y datatable-wrapper box p-5 mt-1">
                   
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                               
                                <th class="border-b-2 whitespace-no-wrap">USERNAME</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">TYPE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">PACKAGE</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">AMOUNT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">START</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">END</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">INVOICE ID</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">STATUS</th>
                               
                               
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($users as $user) 
                            <tr>
                                
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ucwords($user->name)}}</div>
                                    
                                </td>

                              
                               
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$user->type}}</div>
                                    
                                </td>

                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$user->userpackage}}</div>
                                    
                                </td>

                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$user->amount}}</div>
                                    
                                </td>

                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}
                                        
                                    </div>
                                    
                                </td>

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ \Carbon\Carbon::parse($user->ends_at)->diffForHumans() }}</div>
                                </td>

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{$user->invoiceID}}</div>
                                </td>

                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap text-theme-6"><?php if($user->ends_at< Carbon::now()){ ?><span class="px-3 py-2 rounded-full bg-theme-12 text-white mr-1">Expired</span>  <?php }else{?> <span class="px-3 py-2 rounded-full bg-theme-9 text-white mr-1">Live</span> <?php }?></div>
                                </td>
                                
            
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    </form>
                    </div>
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->




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




 <div class="modal" id="header-footer-modal-preview3">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">Edit list</h2> 
             
         </div>
         <form  action="createlist" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label>Name</label> 
             <input name="listid" id="listid2" type="hidden" class="input w-full border mt-2 flex-1"> 
             <input type="hidden", name="id" id="app_id2">
            
             
             <input name="title" id="title2" type="text" class="input w-full border mt-2 flex-1" placeholder="title" required> </div>
            
             
             
            
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <a href="javascript:void(0);" onclick="submitlist();"  class="button w-20 bg-theme-1 text-white">Save</a> </div>
    </form> 
 </div>
 </div>


 <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal3">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:15px">Do you really want to delete <b id="niche"></b>'s profile? This process cannot be undone. All data regarding this user will be removed totally</div>
                            <input type="hidden", name="id" id="app_id3">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel3();" >Yes! Delete</button>
                        </div>
                    </div>
                </div>
                </form>



 


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">sure you want to delete this list?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>
                </form>

                <div class="modal" id="button-modal-preview">
     <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Update Successful</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>
 </div>


 <div class="modal" id="button-modal-previewx">
     <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Sender ID submitted succesfully</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>
 </div>
                <!-- END: Delete Confirmation Modal -->
            
@endsection

<script language="JavaScript">
function selectAll(source) {
    checkboxes = document.getElementsByName('ids[]');
    for(var i in checkboxes)
        checkboxes[i].checked = source.checked;
}


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}


function showAlert2(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id2').val(userID); 

    $.get('/users/pulllistdetail/'+id,function(list){

        $("#listid2").val(list.id);
       $("#title2").val(list.name);
      


});


  $('#header-footer-modal-preview3').modal('show'); 
   
}


function submitlist(){

var id=$("#listid2").val();
var title=$("#title2").val();
var _token = $('input[name="_token"]').val();
$.ajax({
      url:'/users/submitlistupdate',
            method: 'POST',
            data: {
              id:id,title:title,_token:_token
            },
            
            success:function(result){
              $('#header-footer-modal-preview3').modal('hide'); 
              $('#button-modal-preview').modal('show'); 
            }});



}

function senddel(){
    
    window.location="/users/lists/delete/"+$('#app_id').val();
   
}

$("#checkAll").click(function () {
    alert("good");
 });


 function addsender(){

     var name=$('#id').val();
    $.get('/admin/insertname/'+name,function(list){
        
        //alert(list);
        $("#form").hide();
        $("#succ").show();


});
 }


 function showAlertfrm3(id){
    var user=id;
    var userID=$('#deleteUser'+user).attr('data-userid');
    $('#app_id3').val(userID); 
   $('#delete-confirmation-modal3').modal('show'); 
   
   getFieldname(user);
   
}

function getFieldname(id){
    var userId=id;
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'/admin/pullusername',
            method: 'POST',
            data: {
                userId:userId,_token:_token
            },
            
            success:function(result){

                
             document.getElementById('niche').innerHTML = result;
            
            }});


}


function senddel3(){

       
window.location="/admin/user/delete/"+$('#app_id3').val();
 

}

</script>