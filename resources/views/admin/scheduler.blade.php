<?php   use \App\Http\Controllers\AdminController; ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | today birthday </title>
@endsection
@section('content')
<?php $senderids= AdminController::pullsenderid();?>


                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Scheduler</a> </div>
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
                <h1 class="text-lg font-medium mr-auto" style="font-size:23px">
                    Auto Send SMS
                    </h1>
              
                                 
                    
               
<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                    <table>
<tr>
<td>  <a href="/users/scheduleList" class="button box bg-theme-1 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="chevron-left" class="breadcrumb__icon"></i>     Back  </a>
       </td>
                            <td>  </td>
</tr>

                     </table> 
                    <div class="w-full sm:w-auto flex sm:mt-0">
                    <form action="/users/autosms" method="POST">
                    

       

                       
       

                      
       
                                         
                    </div>
                </div>   
                <br/>
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

<div class="intro-y datatable-wrapper box p-5 mb-5" id="sms" >
               
                {{ csrf_field() }} 
                <div class="col-span-12 sm:col-span-12"><label><b>User ID</b></label> 
                <select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
             
            </div>
            
            
            

             <div class="news__input relative mt-5"> 
                            <label><b>Message</b></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="message" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in birthday wishes here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('message') }}</textarea>
                        </div>
        <br/><br/>
        <div class="intro-y  datatable-wrapper box p-1" style="float:right;color:red">
        You have
        <input readonly type="text" name="countdown" size="3" value="160"> chars left

</div>


<div> <label><b>Time to send SMS on birthday</b></label>
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-chris-evans" name="time" value="12:00AM"> <label class="cursor-pointer select-none" for="vertical-radio-chris-evans">12:00AM</label> </div>
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-liam-neeson" name="time" value="5:00AM"> <label class="cursor-pointer select-none" for="vertical-radio-liam-neeson">5:00AM</label> </div>
     <div class="flex items-center text-gray-700 mt-2"> <input type="radio" class="input border mr-2" id="vertical-radio-daniel-craig" name="time" value="7:00AM"> <label class="cursor-pointer select-none" for="vertical-radio-daniel-craig">7:00AM</label> </div>
 </div>
                   <?php if($lists->count()==0){?>

<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Your have not created any list to auto schedule </div>

<?php }else{?>
    <br/>
    <label><b>Check the list you want to Automate</b></label> 

<table class="table mt-3" style="font-size:14px">
<thead>
<tr>
<th class="border border-b-2 whitespace-no-wrap"></th>
<th class="border border-b-2 whitespace-no-wrap">Name</th>
<th class="border border-b-2 whitespace-no-wrap">status</th>
<th class="border border-b-2 whitespace-no-wrap">Created</th>
</tr>
</thead>
<tbody>




@foreach($lists as $list) 
<tr>
<td class="border" style="color:yellowgreen">

<?php if(AdminController::autostatus($list->id) !=""){?>
        
    <i data-feather="flag" class="w-4 h-4"></i><?php }else{?>

        <?php if($list->type=='other'){?>
            
            <a href="javascript:;" class="tooltip button inline-block " title="You can not send same message to contacts on an Anniversary list">
                 <i data-feather="alert-octagon" class="w-4 h-4" style="color:red"></i>  </a>
            <?php }else{?>
        <input type="hidden" name="type[]" class="input border mr-2" value="{{$list->type}}" >
    <input type="checkbox" name="listid[]" class="input border mr-2" value="{{$list->id}}" >
    <?php }?>
<?php }?>

   

    
 </td>
<td class="border">
        
            {{ucwords($list->name)}} 
           
        
    </td>
    <td class="border">
        <?php if(AdminController::autostatus($list->id) !=""){?>
        
            
            <span class="px-3 py-2 rounded-full border border-theme-9 text-theme-9 mr-1">Auto scheduled</span>
      <?php }else{?>

<span style="color:orange">Basic</span>
    <?php }?>
        </td>
    <td class=" border">
    {{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}
    </td>
  
    
    
</tr>
@endforeach

</tbody>
</table>
<?php }?>
<br/>
<table>
<tr>
<td> <button name="action" value="activate" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Activate List </button></td>
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