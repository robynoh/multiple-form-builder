@extends('layouts.adminint')
@section('title')
    <title> Admin | Autoschedule list  </title>
@endsection


<style>

#clock {
            font-size: 30px;
            font-weight:bold;
            color:green;
           
            text-align: center;
            border-radius: 20px;
        }
</style>
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Admin</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> </div>
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
               
                <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px">
                Auto Schedule List
                    </h1>
<br/>
               
<table width="100%">
<tr>
<td width="20%">  
<a href="javascript:;" data-toggle="modal" data-target="#header-footer-modal-preview2" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Auto schedule </a>  



      
       </td>
                            <td style="float:right"> <div class="clockContainer" style="font-size:15px">

                            <div id="clock">8:10:45</div> </td>
</tr>

                     </table>   
                     
                     @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif
<?php if($lists->count()>0){?>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
Wishes will be sent to contacts in all list bellow automatically on their birthday.
</div>

<?php }?>
     <div class="grid grid-cols-12 gap-6 mt-5">

     

               
                       
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="intro-y datatable-wrapper box p-5 mt-5">

                    


                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                            <th class="border-b-2 whitespace-no-wrap"></th>
                                <th class="border-b-2 whitespace-no-wrap">NAME</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">DATE ACTIVATED</th>
                               
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($lists as $list) 
                            <tr>
                                <td> <i data-loading-icon="puff" class="w-8 h-8"></i> </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{$list->name}}</div>
                                    
                                </td>
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</div>
                                </td>
                              
                                
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                    <?php if (Auth::user()->id==$list->userID){?> 
                                    <a class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" href="/admin/scheduleUpdate/{{$list->id}}/{{$list->sendtype}}"><i data-feather="settings" class="w-4 h-4 mr-1"></i> Settings</a>
                                                                          
                                         
                                  
                                    <a class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white" id="deleteUser{{ $list->listID}}" data-userid="{{$list->listID}}" href="javascript:void(0)" onclick="showAlert({{ $list->listID}});" > Deactivate</a>  
                             <?php }?>
                                  
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    </div>
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
         
         <div class="p-5 "> <label><b>Choose how you want  to autosend birthday wishes to your contacts</b></label>
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
            
@endsection

<script>


function showAlert(photo){
    var id=photo;
    var userID=$('#deleteUser'+id).attr('data-userid');
    $('#app_id').val(userID); 
   $('#delete-confirmation-modal').modal('show'); 
   
}

function senddel(){
    
    window.location="/users/deactivate/"+$('#app_id').val();
   
}





var myVar = setInterval(myTimer, 1000);
var hours = ["12",
"01","02","03","04","05","06","07","08","09","10","11","12",
"01","02","03","04","05","06","07","08","09","10","11"];
var months = [
"January",
"February",
"March",
"April",
"May",
"June",
"July",
"August",
"September",
"October",
"November",
"December",
];
function myTimer() {
var date = new Date();
document.getElementById("date").innerHTML =
date.getDate() +
"-" +
months[date.getMonth()] +
"-" +
date.getFullYear();
document.getElementById("hours").innerHTML = hours[date.getHours()];
document.getElementById("minutes").innerHTML = date.getMinutes()<10?"0"+date.getMinutes() :date.getMinutes();
document.getElementById("seconds").innerHTML = date.getSeconds()<10?"0"+date.getSeconds() :date.getSeconds();
document.getElementById("ampm").innerHTML = date.getHours()<12?"AM":"PM";

if (document.getElementById("colon1").innerHTML.includes(":"))
{

document.getElementById("colon2").innerHTML = "";
document.getElementById("colon1").innerHTML = "";
}
else
{

document.getElementById("colon2").innerHTML = ":";
document.getElementById("colon1").innerHTML = ":";
}

}

var myVar = setInterval(myTimer, 1000);
var hours = ["12",
"01","02","03","04","05","06","07","08","09","10","11","12",
"01","02","03","04","05","06","07","08","09","10","11"];
var months = [
"January",
"February",
"March",
"April",
"May",
"June",
"July",
"August",
"September",
"October",
"November",
"December",
];
function myTimer() {
var date = new Date();
document.getElementById("date").innerHTML =
date.getDate() +
"-" +
months[date.getMonth()] +
"-" +
date.getFullYear();
document.getElementById("hours").innerHTML = hours[date.getHours()];
document.getElementById("minutes").innerHTML = date.getMinutes()<10?"0"+date.getMinutes() :date.getMinutes();
document.getElementById("seconds").innerHTML = date.getSeconds()<10?"0"+date.getSeconds() :date.getSeconds();
document.getElementById("ampm").innerHTML = date.getHours()<12?"AM":"PM";

if (document.getElementById("colon1").innerHTML.includes(":"))
{

document.getElementById("colon2").innerHTML = "";
document.getElementById("colon1").innerHTML = "";
}
else
{

document.getElementById("colon2").innerHTML = ":";
document.getElementById("colon1").innerHTML = ":";
}

}

setInterval(showTime, 1000);
        function showTime() {
            let time = new Date();
            let hour = time.getHours();
            let min = time.getMinutes();
            let sec = time.getSeconds();
            am_pm = "AM";
  
            if (hour > 12) {
                hour -= 12;
                am_pm = "PM";
            }
            if (hour == 0) {
                hr = 12;
                am_pm = "AM";
            }
  
            hour = hour < 10 ? "0" + hour : hour;
            min = min < 10 ? "0" + min : min;
            sec = sec < 10 ? "0" + sec : sec;
  
            let currentTime = hour + ":" 
                + min + ":" + sec + am_pm;
  
            document.getElementById("clock")
                .innerHTML = currentTime;
        }
  
        showTime();
</script>