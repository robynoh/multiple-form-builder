<?php   use \App\Http\Controllers\UserController; ?>
@extends('layouts.userint')
@section('title')
    <title> User | Form Information  </title>
@endsection
<?php $senderids= UserController::pullsenderid();?>
@section('content')


                   <!-- BEGIN: Top Bar -->
                   <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">interface</a><i data-feather="chevron-right" class="breadcrumb__icon"></i> Stat </div>
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
               Stat
                    </h1>
                    <br/>


                    <table width="20%">
<tr>
<td width="">  
<a href="/users/interface/{{$tableid}}"  class="button w-40 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="chevron-left" class="w-4 h-4 mr-2"></i>Go Back </a>  



      
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
            

<div class="intro-y col-span-12 md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200">
                                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{asset($optin->img)}}">
                                </div>
                                <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                    <a href="" class="font-medium" style="font-weight:bold;font-size:20px">{{$optin->title}}</a> 
                                    <div class="text-gray-600 text-xs lg:w-auto" style="font-size:12px">{!! substr(ucfirst($optin->description), 0,100)!!}...  </div>
                                </div>
                                <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                                <div class="text-center rounded-md w-20 py-3">
                                                    <div class="font-semibold text-theme-1 text-lg">{{$entry->count()}}</div>
                                                    <div class="text-gray-600">Entries</div>
                                                </div>
                                                
                                                <div class="text-center rounded-md w-20 py-3">
                                                    <div class="font-semibold text-theme-1 text-lg">{{$view->count()}}</div>
                                                    <div class="text-gray-600">Views</div>
                                                </div>
                                                
                                                
                                                
                                 </div>
                            </div>
                         
                        </div>
                    </div>

<br/>

<div class="intro-y box">


                               


<div style="padding-left:10px;padding-top:10px;font-weight:bold">



</div>


                    
                  
                    <div class="px-5 sm:px-20  mt-5">

                    <div class="flex flex-col xl:flex-row xl:items-center">
                                    <div class="flex">
                                        <div>
                                            <div class="text-theme-20 text-lg xl:text-xl font-bold">Activity</div>
                                            <div class="text-gray-600">Chart</div>
                                        </div>
                                        <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6"></div>
                                        <div>
                                            <div class="text-gray-600 text-lg xl:text-xl font-medium">{{Usercontroller::fullmonth($months)}}</div>
                                            <div class="text-gray-600">{{$year}}</div>
                                        </div>
                                    </div>
                                   
                                    <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0">
                                    <form action="" method="POST">
                                    {{ csrf_field() }} 
                                    <input name="tableid" type="hidden" value="{{$tableid}}" />
                                    <input name="interfaceid" type="hidden" value="{{$optin->id}}" />
                                        <table><tr><td><div class="sm:mt-2">
                                            <select name="year" class="input border mr-2">
                                                <?php for($i=date('Y'); $i<=2050; $i++){?>
                                                <option><?php echo $i; ?></option>
                                                <?php }?>
                                            </select>
                                        </div></td><td><div class="sm:mt-2">
                                            <select name="month" class="input border mr-2">
                                               <option value=""></option>
                                                <option value="1">Jan</option>
                                                <option value="2">Feb</option>
                                                <option value="3">Mar</option>
                                                <option value="4">Apr</option>
                                                <option value="5">May</option>
                                                <option value="6">Jun</option>
                                                <option value="7">Jul</option>
                                                <option value="8">Aug</option>
                                                <option value="9">Sep</option>
                                                <option value="10">Oct</option>
                                                <option value="11">Nov</option>
                                                <option value="12">Dec</option>
                                            </select>
                                        </div></td>
                                    <td style="padding-top:20px">

                                    <button type="submit" class="button w-20 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white">Filter</button>
                                    </td>
                                    
                                    </tr>
                                    
                                    
                                    </table>
                                    
                                                </form>
                                    </div>
                                  
                                </div>

                                
<br/>
<h4><b>Rate of views to signups per day</b></h4>
                                <br/> <canvas id="myChart" style="width:100%;max-width:100%"></canvas>

                                <br/>
<h4><b>Rate of views per day</b></h4><br/>
                                <canvas id="myChart2" style="width:100%;max-width:100%;float:left"></canvas>
                                <br/>
                                <br/><br/>
<h4><b>Rate of signups per day</b></h4><br/>
                                <canvas id="myChart3" style="width:100%;max-width:100%;float:left"></canvas>

   


                               
                    <div class="p-5" id="line-chart">
                    <input id="views" type="hidden" value="{{$viewstat}}" />
                 <input id="entry" type="hidden" value="{{$entrystat}}" />
                 <input id="views2" type="hidden" value="{{$viewstat}}" />
                 <input id="entry2" type="hidden" value="{{$entrystat}}" />
                              
                               
                            </div>

                          

                    </div>

                  
<br/> <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<br/>

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


  




  
    </script>

