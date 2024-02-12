@extends('layouts.userint')
@section('title')
    <title> User | List detail </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> </div>
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
                <br/>
                <h1 class="text-lg font-medium mr-auto" style="font-size:23px">
                    Birthday
                    </h1>
               <br/>
               <h2 class="text-lg font-medium mr-auto" style="font-weight:lighter">
                    {{$lists->name}}
                    </h2>

                    <br/>               
                    @if(session('success'))
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> 
{{session('success')}}
    </div>
@endif

<table>
    <tr>
        <td>
        <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Add Contact </a>             
</td>
<td>
</td>
</tr>
</table> 




   
<div class="grid grid-cols-12 gap-6 mt-5">

                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <a href="/users/todayBirthday/{{$lists->id}}">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="gift" class="report-box__icon text-theme-10"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="Today's birthday celebrants"> Birthday <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6"><?php echo $birthcount->count(); ?></div>
                                        <div class="text-base text-gray-600 mt-1">Today Celebrants</div>
                                    </div>
                                </div></a>
                            </div>


                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/tomorrowBirthday/{{$lists->id}}">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="gift" class="report-box__icon text-theme-11"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="Tomorrow birthday celebrants Indicator "> Birthday <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6"><?php echo $tomorrowbirthcount->count(); ?></div>
                                        <div class="text-base text-gray-600 mt-1">Tomorrow Celebrants</div>
                                    </div>
                                </a>

                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/celebrantsByMonths/{{$lists->id}}" >
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="filter" class="report-box__icon text-theme-12"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> Sort celebrants <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6"><?php echo $contactlists->count(); ?></div>
                                        <div class="text-base text-gray-600 mt-1">Celebrants by Months</div>
                                    </div>
</a>

                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                <a href="/users/sentMessages/{{$lists->id}}" >
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="send" class="report-box__icon text-theme-9"></i> 
                                            <div class="ml-auto">
                                                <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="All messages sent to celebrants"> Outbox <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="text-3xl font-bold leading-8 mt-6">152.000</div>
                                        <div class="text-base text-gray-600 mt-1">Credits remaining</div>
                                    </div>
</a>
                                </div>
                            </div>
                        </div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
<table width="100%"><tr>
                            <td width="60%">
                    <h1 style="font-size:18px;font-weight:bold">Contacts </h1><td>
                        <td>
                       
          
                   <a href="/users/smsallcontacts/{{$lists->id}}/birthday" class=" w-55 mr-2 mb-2 flex ">
                        <i data-feather="send" class="breadcrumb__icon"></i>  <u>Send SMS to all contacts on this list </u></a>
                       
</td>
</tr>
                        </table>  

                </div>      <div class="grid grid-cols-12 gap-6 mt-0">

               
                       
                   
                    <!-- BEGIN: Data List -->
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full" style="font-size:14px;">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">NAME</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">DOB</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CONTACT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">REMARKS</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($contactlists as $contactlist) 
                            <tr>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ucwords($contactlist->firstName)}} {{ucwords($contactlist->lastName)}}</div>
                                    
                                </td>
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{$contactlist->birthMonth}} {{$contactlist->birthDay}} </div>
                                </td>
                              
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap">{{$contactlist->phone}}</div>
                                </td>
                                <td class="w-40 border-b">
                                <div class="font-medium whitespace-no-wrap"> {{$contactlist->remarks}}</div>
                                </td>


                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                   
                                   
                                     
                                      
                                         
                                    <a class="button button--sm w-8 mr-1 mb-2 bg-theme-7 text-white" id="deleteUser{{ $contactlist->id}}" data-userid="{{ $contactlist->id }}" href="javascript:void(0)" onclick="showAlert2({{ $contactlist->id }});" > <i data-feather="edit" class="w-4 h-4 mr-1"></i></a>
                                       
                             
                                  
                                    </div>
                                </td>
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                   
                                   
                                     
                                      
                                         
                                    <a class="button button--sm w-8 mr-1 mb-2 bg-theme-6 text-white" id="deleteUser{{ $contactlist->id}}" data-userid="{{ $contactlist->id }}" href="javascript:void(0)" onclick="showAlert({{ $contactlist->id }});" > <i data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
                                       
                             
                                  
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
             <h2 class="font-medium text-base mr-auto">New contact</h2> 
             
         </div>
         <form  action="/users/addcontact/{{$lists->id}}" method="POST" >
         {{ csrf_field() }} 
         <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
             <div class="col-span-12 sm:col-span-12"><label><b>Firstname</b></label> 
             <input name="firstname" type="text" class="input w-full border mt-2 flex-1" placeholder="firstname" required> </div>
            
             <div class="col-span-12 sm:col-span-12"><label><b>Lastname</b></label> 
             <input name="lastname" type="text" class="input w-full border mt-2 flex-1" placeholder="lastname" required> </div>
            
           

         <div class="p-5 grid grid-cols-12 gap-8 row-gap-2">
             
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Month</b></label>
                                                    <select name="birthmonth" class="input border mr-2 w-full">
                                                    <option>Month</option>
                                                    <option value="Jan">Jan</option>
             <option value="Feb">Feb</option>
             <option value="Mar">Mar</option>
             <option value="Apr">Apr</option>
             <option value="May">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="Aug">Aug</option>
             <option value="Sep">Sep</option>
             <option value="Oct">Oct</option>
             <option value="Nov">Nov</option>
             <option value="Dec">Dec</option>
         </select>     </div>
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Day</b></label>
                                                    <select name="birthday" class="input border mr-2 w-full">
                                                    <option>Day</option>
                     @for($i=1; $i<=32; $i++ )
             <option>{{$i}}</option>
             
             @endfor
         </select>   </div>
                                            </div>

         <div class="col-span-12 sm:col-span-12"><label><b>Phone</b></label> 
             <input name="phone" type="text" class="input w-full border mt-2 flex-1" placeholder="Phone number" > </div>
            
             <div class="col-span-12 sm:col-span-12"><label><b>Remark</b></label> 
             <input name="remark" type="text" class="input w-full border mt-2 flex-1" placeholder="remark" > </div>
            
              
                                    
         </div>
         <div class="px-5 py-3 text-right border-t border-gray-200"> <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel</button> <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button> </div>
    </form>  </div>
 </div>

 <div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10 text-center">
         

    <div class="">
        <table>
             <tr>
                 <td> <button class="add_field_button button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-14"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Add Field </button>
      
   </td>
<td>  <a href="javascript:void(0);" onclick="show_file_box();" class="button w-60 mr-2 mb-2 flex items-center justify-center bg-theme-14"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Upload Excel Sheet </a>
      
</td>
    </tr>           
         </table>
        
        <br/>
        <form action="/users/multiplecontact/{{$lists->id}}" method="POST">
        {{ csrf_field() }}
            
        <table >

  <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">Firstname</th>
                                <th class="border-b-2 whitespace-no-wrap">Lastname</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">birthMonth</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">birthDay</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CONTACT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">REMARKS</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                            </tr>
                        </thead>
                        <tbody class="input_fields_wrap">
       <tr>
<td><input name="firstname[]" type="text" class="input w-full border col-span" placeholder="Firstname" required>

</td>
<td><input name="lastname[]" type="text" class="input w-full border col-span" placeholder="Lastname" required></td>
<td> <select name="birthmonth[]" class="input border mr-2 w-full" required>
                                                    <option>Choose Month</option>
                                                    <option value="Jan">Jan</option>
             <option value="Feb">Feb</option>
             <option value="Mar">Mar</option>
             <option value="Apr">Apr</option>
             <option value="May">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="Aug">Aug</option>
             <option value="Sep">Sep</option>
             <option value="Oct">Oct</option>
             <option value="Nov">Nov</option>
             <option value="Dec">Dec</option>
         </select> </td>
<td><select name="birthday[]" class="input border mr-2 w-full">
                                                    <option>Choose Day</option>
                     @for($i=1; $i<=32; $i++ )
             <option>{{$i}}</option>
             
             @endfor
         </select></td>
<td><input name="phone[]" type="text" class="input w-full border col-span" placeholder="Phone" required></td>
<td><input name="remark[]" type="text" class="input w-full border col-span" placeholder="remark"></td>
<td  >   
   
  </td>


</tr>
</tbody>
  </table>
<br/>
  <table>
<tr>
<td> <button type="submit" class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Save Contact </button></td>
                            <td> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button> </td>
</tr>

                     </table>
</form>
    </div>
    
         
        
    
    </div>
 </div>



 <div class="modal" id="superlarge-modal-size-preview3">
     <div class="modal__content modal__content--xl p-10 text-center">
         

    <div class="">
        <table>
             <tr>
                 <td>
                     <table>
                         <tr>
                         <td>
                     <a href="javascript:void(0);" onclick="back_to_add_field();" class=" button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-14"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i> Go back</a>
                   </td>
                         <td><a href="/users/download/ContactsList.csv/folder/{{'uploadFormat'}}" class=" button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-2"> <i data-feather="download" class="w-4 h-4 mr-2"></i> Download format</a></td>
                         </tr>
                         
</table>  
<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-17 text-theme-11">
First download the format for upload by clicking the "download format" button above and enter all your contacts following the column arrangement then save and upload.
</div>
                     <br/>

<h2 class="text-lg font-medium mr-auto" style="float:left">
            Upload contact list
            </h2>
            <br/> <br/>
   </td>
<td> 
      
</td>
    </tr>           
         </table>
        
        
        <form action="/users/fileupload" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
            
        <table>
            <tr>
           
            <td>
                <input type="file" name="file" id="file"  />
                <input type="hidden" name="listId" id="listId" value="{{$lists->id}}" />
        </td>
            </tr>
            

                     </table>

                     

<br/>
<br/>
<table>
    <tr>
        <td>
<button class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Upload</button>
</td>
<td>

                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button> 
</td>
    </tr>
</table>
          </form>              </div>
    
         
        
    
    </div>
 </div>





 <div class="modal" id="superlarge-modal-size-preview2">
     <div class="modal__content modal__content--xl p-10 text-center">
         <table>
             <tr>
                 <td>
   </td>
<td> 
</td>
    </tr>           
         </table>

    <div class="">
       
        <br/>
        <form id="form2" action="" method="POST">
        {{ method_field("PUT")}}
{{ csrf_field() }} 
            
        <table id="table2" >

  <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">Firstname</th>
                                <th class="border-b-2 whitespace-no-wrap">Lastname</th>
        
                                <th class="border-b-2 text-center whitespace-no-wrap">birthMonth</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">birthDay</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">CONTACT</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">REMARKS</th>
                                <th class="border-b-2 text-center whitespace-no-wrap"></th>
                            </tr>
                        </thead>
                        <tbody class="input_fields_wrap">
       <tr>
<td>
<input type="hidden", name="id" id="app_id2">
<input type="hidden", name="contactid" id="contactid" >
<input name="firstname[]" id="firstname2" type="text" class="input w-full border col-span" placeholder="Firstname" required>

</td>
<td><input name="lastname[]" id="lastname2" type="text" class="input w-full border col-span" placeholder="Lastname" required></td>
<td> <select name="birthmonth[]" id="month" class="input border mr-2 w-full" required>
                                                    <option>Choose Month</option>
                                                    <option value="Jan">Jan</option>
             <option value="Feb">Feb</option>
             <option value="Mar">Mar</option>
             <option value="Apr">Apr</option>
             <option value="May">May</option>
             <option value="jun">Jun</option>
             <option value="jul">Jul</option>
             <option value="Aug">Aug</option>
             <option value="Sep">Sep</option>
             <option value="Oct">Oct</option>
             <option value="Nov">Nov</option>
             <option value="Dec">Dec</option>
         </select> </td>
<td><select name="birthday[]" id="day" class="input border mr-2 w-full">
                                                    <option>Choose Day</option>
                     @for($i=1; $i<=32; $i++ )
             <option>{{$i}}</option>
             
             @endfor
         </select></td>
<td><input name="phone[]" id="phone2" type="text" class="input w-full border col-span" placeholder="Phone" required></td>
<td><input name="remark[]" id="remark2" type="text" class="input w-full border col-span" placeholder="remark"></td>
<td  >   
   
  </td>


</tr>
</tbody>
  </table>
<br/>
  <table>
<tr>
<td> <a  href="javascript:void(0);" onclick="submitContact();"  class="button box bg-theme-9 text-white mr-2 flex items-center  ml-auto sm:ml-0" >
                            Save</a></td>
                            <td> <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>  </td>
</tr>

                     </table>
</form>
    </div>
    
         
        
    
    </div>
 </div>










                <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2">Do you really want to delete these contact? This process cannot be undone.</div>
                            <input type="hidden", name="id" id="app_id">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddel();" >Delete</button>
                        </div>
                    </div>
                </div>

               <div class="modal" id="button-modal-preview">
     <div class="modal__content relative"> <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
         <div class="p-5 text-center"> <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
             <div class="text-3xl mt-5">Update Successful</div>
            
         </div>
         <div class="px-5 pb-8 text-center"> <a href="" class="button w-24 bg-theme-1 text-white">Ok</a> </div>
     </div>
 </div>

                </form>
                <!-- END: Delete Confirmation Modal -->
            
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script>

    $(document).ready(function() {
       
var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var tab= $("#tableCol"); //Add button ID
var removal = $(".remove"); //Add button ID
var x = 1; //initlal text box count

$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<tr><td><input name="firstname[]" type="text" class="input w-full border col-span" placeholder="Firstname" required></td><td><input type="text" name="lastname[]" class="input w-full border col-span" placeholder="Lastname" required></td><td> <select name="birthmonth[]" class="input border mr-2 w-full" required><option>Choose Month</option><option value="Jan">Jan</option><option value="Feb">Feb</option><option value="Mar">Mar</option><option value="Apr">Apr</option><option value="May">May</option><option value="jun">Jun</option><option value="jul">Jul</option><option value="Aug">Aug</option><option value="Sep">Sept</option><option value="Oct">Oct</option><option value="Nov">Nov</option> <option value="Dec">Dec</option></select> </td><td><select name="birthday[]" class="input border mr-2 w-full" required> <option>Choose Day</option> @for($i=1; $i<=32; $i++ )<option>{{$i}}</option>@endfor</select></td><td><input name="phone[]" type="text" class="input w-full border col-span" placeholder="Phone" required></td><td><input name="remark[]" type="text" class="input w-full border col-span" placeholder="remark" required></td><td  ></td><td class="remove_field button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-14" style="font-size:12px"> <img class="w-3" src="{{ asset('dist/images/delete-icon.png') }}"> Remove</td></tr>'); //add input box
}
});


$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault();
 $(this).parent('tr').remove(); 
 x--;
})


});

function dropField(){

    alert(5);

}

function removeField(){

var max_fields = 15; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID
var tab= $("#tableCol"); //Add button ID
var x = 1; //initlal text box count

e.preventDefault(); $(this).parent('div').remove(); x--;

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

    $.get('/users/pullcontactdetail/'+id,function(contact){
        $("#contactid").val(contact.id);
       $("#firstname2").val(contact.firstName);
        $("#lastname2").val(contact.lastName);
        $("#phone2").val(contact.phone);
        $("#remark2").val(contact.remarks);
        $("#month").val(contact.birthMonth);
        $("#day").val(contact.birthDay);


});


  $('#superlarge-modal-size-preview2').modal('show'); 
   
}

function senddel(){
    
    window.location="/users/contact/delete/"+$('#app_id').val();
   
}


function submitContact(){

      var id=$("#contactid").val();
      var firstname=$("#firstname2").val();
      var lastname=$("#lastname2").val();
      var phone= $("#phone2").val();
      var remark= $("#remark2").val();
      var month=$("#month").val();
      var day= $("#day").val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
            url:'/users/submitcontactupdate',
                  method: 'POST',
                  data: {
					id:id,firstname:firstname,lastname:lastname,phone:phone,remark:remark,month:month,day:day,_token:_token
                  },
                  
                  success:function(result){
                    $('#superlarge-modal-size-preview2').modal('hide'); 
                    $('#button-modal-preview').modal('show'); 
                  }});


    
}

function show_file_box(){

    $('#superlarge-modal-size-preview').modal('hide'); 
     $('#superlarge-modal-size-preview3').modal('show'); 

}

function back_to_add_field(){

$('#superlarge-modal-size-preview3').modal('hide'); 
 $('#superlarge-modal-size-preview').modal('show'); 

}



    $(document).ready(function(){

        var fileName;

        $('input[type="file"]').change(function(e){

        fileName = e.target.files[0].name;
                  
        });


        $('#submit').click(function(){

        var id =$("#listId").val();
        var _token = $('input[name="_token"]').val();
        var file=fileName;

        $.ajax({
            url:"/users/fileupload",
                  method: 'POST',
                  data: {
					id:id,filename:file,_token:_token
                  },
                  
                  success:function(result){
                   // $('#superlarge-modal-size-preview3').modal('hide'); 
                   // $('#success').modal('show'); 
                   alert(result);
                  }});

        });


    });






</script>