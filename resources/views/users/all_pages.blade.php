<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Collect Information  </title>
@endsection

<?php $senderids= UserController::pullsenderid();?>

@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> All Pages<i data-feather="chevron-right" class="breadcrumb__icon"></i><a style="color:#84C345" href="" class="breadcrumb--active"> Landing Pages </a></div>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Search -->
                   
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


                <h2 class="intro-y text-lg font-medium mt-5">
                   All Landing Pages   
                </h2>
<br/>
 
   
        
<table>
<tr>
<td>  
<a href="javascript:;" data-toggle="modal" data-target="#medium-modal-size-preview"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i>Create Page </a>  


      
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

<?php if($pages->count()<1){?>
     <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-14 text-theme-7" style="width:100%" style="font-size:20px"> 
     You have not created any landing page. To create, click the the create page button
    </div>
      <?php }?>  


     <div class="grid grid-cols-12 gap-6 ">

     
               
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                  
                  

                    @foreach($pages as $page)  
                    

                    <div class="datatable-wrapper box p-5 ">
                                    

                              


                    <div class="px-5">
                                        <div class="flex flex-col lg:flex-row items-center pb-5">
                                            <div class="flex flex-col sm:flex-row items-center pr-5 lg:border-r border-gray-200">
                                               
                                                <div class="mr-auto text-center sm:text-left mt-3 sm:mt-0">
                                                    <a href="" class="font-medium text-lg"><?php echo ucfirst($page->page_title); ?></a> 
                                                   
                                                </div>
                                            </div>
                                            <div class="w-full lg:w-auto mt-6 lg:mt-0 pt-4 lg:pt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-t-0 border-gray-200">
                                                <div class="text-center rounded-md w-45 py-3">
                                                    <div class="font-semibold text-theme-1 text-lg"></div>

                                                    <?php if($page->status==1){?>
                                                    <div class="text-gray-600">

                                                    <?php // if(Usercontroller::userpackage()!='free'){?>
                                                   <!-- <a href="http://{{Usercontroller::showsubdomain(Auth::user()->id)}}.watawazi.com/page/{{Auth::user()->id}}/{{str_replace(' ', '-',strtolower($page->page_title))}}/{{$page->id}}" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="eye" class="w-4 h-4 mr-2"></i>Preview </a>-->
                                                <?php // }else{?>
                                                    <a href="/{{$page->id}}/{{Auth::user()->id}}/pages/{{Usercontroller::getbusinessname()}}/{{str_replace(' ', '-',strtolower($page->page_title))}}" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="eye" class="w-4 h-4 mr-2"></i>Preview </a>
                                                <?php // }?>
                                                </div>
                                                <?php }?>
                                                </div>
                                                <div class="text-center rounded-md w-45 py-3">
                                                    <div class="font-semibold text-theme-1 text-lg"></div>
                                                    
                                                    <div class="text-gray-600"><a href="lpage_content/{{ $page->id}}" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-10 text-white"> <i data-feather="edit" class="w-4 h-4 mr-2"></i>Edit </a>
                                                
                                                </div>
                                               
                                                
                                                </div>

                                                <div class="text-center rounded-md w-45 py-3">
                                                    <div class="font-semibold text-theme-1 text-lg"></div>
                                                    <div class="text-gray-600"><a id="deleteUser{{ $page->id}}" data-userid="{{$page->id}}" href="javascript:void(0)" onclick="showAlertfrm3({{ $page->id}});" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white"> <i data-feather="trash-2" class="w-4 h-4 mr-2"></i>Remove </a></div>
                                                </div>
                                                <div class="text-center rounded-md w-20 py-3">



                                               
     
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:flex-row items-center border-t border-gray-200 pt-5">
                                            <div class="w-full sm:w-auto flex justify-center sm:justify-start items-center border-b sm:border-b-0 border-gray-200 pb-5 sm:pb-0">
                                                <div class="px-3 py-2 bg-theme-14 text-theme-10 rounded font-medium mr-3">{{ \Carbon\Carbon::parse($page->created_at)->diffForHumans() }}</div>
                                                <div class="text-gray-600"><i data-feather="eye" class="w-4 h-4 mr-2"></i></div>
                                                <div class="text-gray-600" style="padding-right:5px;font-weight:bold;color:#000">{{Usercontroller::pageviewCount($page->id)}}</div>
                                                <div class="text-gray-600" style="font-weight:bold;color:#000" >views</div>
                                                  <div class="text-gray-600" style="font-weight:bold;color:#000;padding-left:10px" > <i data-feather="bar-chart-2" class="w-6 h-6 mr-2"></i></div>
                                                  
                                                  <div class="text-gray-600" style="font-weight:bold;color:#000" ><a href="/landing/stat/{{ UserController::encrypt_decrypt(Auth::user()->id,true)}}/{{Usercontroller::encrypt_decrypt($page->id,true)}}">Stat</a></div>
                                                
                                         
                                                
                                            </div>
                                           
                                        </div>
                                    </div>        



                   
                   
                    </div>

<br/>
                    
                    @endforeach 
                             


                   

<br/>
<br/>

                    
                                 

                   
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                   
                    <!-- END: Pagination -->
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->




                <div class="modal" id="header-footer-modal-preview2">
     <div class="modal__content">
         <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
             <h2 class="font-medium text-base mr-auto">Autosend Type </h2> 
             
         </div>

         
         <form  action="autosendtype" method="GET" >
         {{ csrf_field() }} 
         
         <div class="p-5 "> <label><b>Choose how you want  to autosend wishes to your contacts</b></label>
     <div class="flex items-center text-gray-700 mt-2"> <input name="autotype" type="radio" class="input border mr-2" id="vertical-radio-chris-evans" name="vertical_radio_button" value="1" required> <label class="cursor-pointer select-none" for="vertical-radio-chris-evans">Send same message to all my contacts</label> </div>
     <div class="flex items-center text-gray-700 mt-2"> <input name="autotype" type="radio" class="input border mr-2" id="vertical-radio-liam-neeson" name="vertical_radio_button" value="2" required> <label class="cursor-pointer select-none" for="vertical-radio-liam-neeson">Send different messages to my contacts</label> </div>
  </div>
        
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Continue</button> </div>
    </form>  </div>
 </div>


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">sure you want to deactivate this list?</div>
                            <div class="text-gray-600 mt-2">Do you really want to deactivate these records? This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Deactivate</button>
                        </div>
                    </div>
                </div>
                </form>
                <!-- END: Delete Confirmation Modal -->


                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal2">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2">Do you really want to terminate this landing page you started creating? This process cannot be undone. All data regarding this page will be removed totally</div>
                            <input type="text", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Yes! Delete</button>
                        </div>
                    </div>
                </div>
                </form>



                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal3">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:18px">Do you really want to delete this landing page? This process cannot be undone. All data regarding this landing page will be removed totally</div>
                            <input type="hidden", name="id" id="app_id3">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel3();" >Yes! Delete</button>
                        </div>
                    </div>
                </div>
                </form>



                <div class="modal" id="medium-modal-size-preview">
     <div class="modal__content p-10 "> 



      
              
               

<form  method="POST" action="" id="myForm2"> 
     
               
                {{ csrf_field() }}
<h2 class="font-medium text-base mr-auto"><i>Title of Page</i></h2>
                <span style="color:#060"><i>Title of page should be SEO base</i></span>  
                <br/>
           <div class="col-span-12 sm:col-span-12">
              <input name="page-name" type="text" class="input w-full bg-gray-200 pl-5 py-6 mt-2 placeholder-theme-13 resize-none"  required>
            
             
            </div>
            
             <div class="news__input relative mt-5"> 
                         
                            <h2 class="font-medium text-base mr-auto"><i>Description of page</i></h2>
                                             <textarea required id="message" name="page_description" class="input w-full bg-gray-200 pl-3 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Description..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
                        
                        <div class="intro-y  datatable-wrapper box p-5" style="float:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="200"> chars left

</div>

<div class="col-span-12 sm:col-span-12">
    
              <input name="keywords" type="text" class="input w-full bg-gray-200 pl-5 py-6 mt-2 placeholder-theme-13 resize-none"  placeholder="Type in page keywords and  separated by comma" maxlength="150"   required>
            
             
            </div>
           



<br/>

 

      









        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        Save </button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 <div class="modal" id="medium-modal-size-preview2">
     <div class="modal__content p-10 "> 
     <h2 class="font-medium text-base mr-auto">Message</h2>
     <br/>
     <form action="" method="POST" >
                {{ csrf_field() }}
                
              
               
            
            
           <br/>
           <div class="col-span-12 sm:col-span-12"><label><b>Sender ID</b></label> 
              <input name="listid" type="hidden"  value="{{ Auth::user()->id }}">
             <select id="senderid" name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
             
            </div>





 

             <div class="news__input relative mt-5"> 
                            <label><b>Message</b></label> <br/>
                            <span>This message will be sent as SMS to people who submit this form</span>
                                             <textarea required id="message" name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in SMS here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
                        <br/>
                        <span id="errormsg" style="color:red"></span>
                        <span id="processing" style="color:green"></span>
        <br/><br/>
        <div class="intro-y  datatable-wrapper box p-5" style="float:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>


                          
        <br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <a href="javascript:void(0);" onclick="submitMessage();"  class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        Submit </a>
      
                   
                   </div>
    
    



</form>

    



    
    </div>
 </div>
          
 
 <div class="modal" id="delete-confirmation-modal5">

{{ csrf_field() }}

     <div class="modal__content">
         <div class="p-5 text-center">
             <i data-feather="mail" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i> 
            
             <div class="text-gray-600 mt-2">Form comfirmation message Saved</div>
            
         </div>
         <div class="px-5 pb-8 text-center">
             <a href="" class="button w-24 inline-block mr-1 mb-2 border text-gray-700"  >Okay</a>
         </div>
     </div>
 </div>

 <div class="modal" id="delete-confirmation-modal6">

{{ csrf_field() }}

     <div class="modal__content">
         <div class="p-5 text-center">
             <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i> 
            
             <div class="text-gray-600 mt-2">Confirmation message updated</div>
            
         </div>
         <div class="px-5 pb-8 text-center">
             <a href="" class="button w-24 inline-block mr-1 mb-2 border text-gray-700"  >Okay</a>
         </div>
     </div>
 </div>
            
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


function showAlertfrm3(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id3').val(userID); 
   $('#delete-confirmation-modal3').modal('show'); 
   
   
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

       
   window.location="/users/form/delete/"+$('#app_id').val();
    
   
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
