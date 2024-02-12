<?php   use \App\Http\Controllers\AdminController; ?>
@extends('layouts.adminint')
@section('title')
    <title> Admin | today birthday </title>
@endsection
@section('content')



                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">list</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> {{$lists->name}} </div>
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
                                    <div class="text-xs text-theme-41"> <?php if(Auth::user()->role=="manage"){ echo"Super Admin"; }else if(Auth::user()->role=="manage-sub"){ echo"Admin";} ?></div>
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
                <h1 class="text-lg font-medium mr-auto" >
                   {{ucwords($anns)}} Anniversary Celebrants by Month
                    </h1>
               
                   
                                 
 
               
<div class="intro-y flex flex-col sm:flex-row items-center mt-0">
                     <a href="/admin/{{$lists->id}}/anniversary/{{$anns}}/{{$annids}}" class="button box bg-theme-1 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="chevron-left" class="breadcrumb__icon"></i> Go Back </a>
       
                   
                </div>   
               
                
                <div class="grid grid-cols-12 gap-6 mt-5">

               
                       
                   
                    <!-- BEGIN: Data List -->

                    
  
  



                    
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <?php $conlists=AdminController::annpermonth($lists->id,'Jan',$anns); ?>
                        <table width="100%"><tr>
                            <td width="80%">
                    <h1 >January </h1><td>
                        <td>
                       
          <?php  if($conlists->count()>0){?>
                   <a href="/admin/annmonthExtract/{{'Jan'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>
                       
<?php }?>
                    </td>
</tr>
                        </table>
                    <table class="table">
         <thead>
             <tr>
                
                 <th class="border-b-2 whitespace-no-wrap">Name</th>
                 <th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
                 <th class="border-b-2 whitespace-no-wrap">Contact</th>
             </tr>
         </thead>
         <tbody>
         
         <?php    
         if($conlists->count()<1){?>
<tr class="bg-gray-200">
    <td colspan=3> No celebrants in the month of january</td>
</tr>

<?php }?>
<?php
         
         foreach($conlists as $conlist){ ?>


            <tr class="bg-gray-200">
                
                 <td class="border-b">       <?php echo ucwords($conlist->firstname); ?> <?php echo ucwords($conlist->lastname);?>
                           </td>
                 <td class="border-b">  <?php echo $conlist->annmonth; ?> <?php echo $conlist->annday ?></td>
                 <td class="border-b"> <?php echo $conlist->contact?></td>
             </tr>

                       
                      
                 <?php }?>
         </tbody>
     </table>



<br/><br/>
<?php $conlistsfeb=AdminController::annpermonth($lists->id,'Feb',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>February </h1><td>
                        <td>

                        <?php  if($conlistsfeb->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Feb'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>
         
<?php }?>
                  </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsfeb->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of february</td>
</tr>

<?php }?>
<?php

foreach($conlistsfeb as $conlistfeb){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistfeb->firstname); ?> <?php echo ucwords($conlistfeb->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistfeb->annmonth; ?> <?php echo $conlistfeb->annday ?></td>
<td class="border-b"> <?php echo $conlistfeb->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsmar=AdminController::annpermonth($lists->id,'Mar',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>March </h1><td>
                        <td>
                        <?php  if($conlistsmar->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Mar'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>



  </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Birth</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsmar->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of march</td>
</tr>

<?php }?>
<?php

foreach($conlistsmar as $conlistmar){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistmar->firstname); ?> <?php echo ucwords($conlistmar->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistmar->annmonth; ?> <?php echo $conlistmar->annday ?></td>
<td class="border-b"> <?php echo $conlistmar->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsapr=AdminController::annpermonth($lists->id,'Apr',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>April </h1><td>
                        <td>

                        <?php  if($conlistsapr->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Apr'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>


</td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsapr->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of april</td>
</tr>

<?php }?>
<?php

foreach($conlistsapr as $conlistapr){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistapr->firstname); ?> <?php echo ucwords($conlistapr->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistapr->annmonth; ?> <?php echo $conlistapr->annday ?></td>
<td class="border-b"> <?php echo $conlistapr->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsmay=AdminController::annpermonth($lists->id,'May',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>May </h1><td>
                        <td>


                        <?php  if($conlistsmay->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'May'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>


 </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsmay->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of May</td>
</tr>

<?php }?>
<?php

foreach($conlistsmay as $conlistmay){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistmay->firstname); ?> <?php echo ucwords($conlistmay->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistmay->annmonth; ?> <?php echo $conlistmay->annday ?></td>
<td class="border-b"> <?php echo $conlistmay->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsjun=AdminController::annpermonth($lists->id,'Jun',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>June </h1><td>
                        <td>

                        <?php  if($conlistsjun->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Jun'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>


 </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsjun->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of june</td>
</tr>

<?php }?>
<?php

foreach($conlistsjun as $conlistjun){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistjun->firstname); ?> <?php echo ucwords($conlistjun->lastName);?>
       </td>
<td class="border-b">  <?php echo $conlistjun->annmonth; ?> <?php echo $conlistjun->annday ?></td>
<td class="border-b"> <?php echo $conlistjun->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsjul=AdminController::annpermonth($lists->id,'Jul',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>July </h1><td>
                        <td>

                        <?php  if($conlistsjul->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Jul'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>

                        
       </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsjul->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of july</td>
</tr>

<?php }?>
<?php

foreach($conlistsjul as $conlistjul){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistjul->firstname); ?> <?php echo ucwords($conlistjul->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistjul->annmonth; ?> <?php echo $conlistjul->annday ?></td>
<td class="border-b"> <?php echo $conlistjul->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>

<?php $conlistsaug=AdminController::annpermonth($lists->id,'Aug',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>August </h1><td>
                        <td>

                        <?php  if($conlistsaug->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Aug'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>

   </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsaug->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of august</td>
</tr>

<?php }?>
<?php

foreach($conlistsaug as $conlistaug){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistaug->firstname); ?> <?php echo ucwords($conlistaug->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistaug->annmonth; ?> <?php echo $conlistaug->annday ?></td>
<td class="border-b"> <?php echo $conlistaug->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>





<br/><br/>
<?php $conlistssep=AdminController::annpermonth($lists->id,'Sep',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>September </h1><td>
                        <td>
                        <?php  if($conlistssep->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Sep'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>


  </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistssep->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of September</td>
</tr>

<?php }?>
<?php

foreach($conlistssep as $conlistsep){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistsep->firstname); ?> <?php echo ucwords($conlistsep->lastName);?>
       </td>
<td class="border-b">  <?php echo $conlistsep->annmonth; ?> <?php echo $conlistsep->annday ?></td>
<td class="border-b"> <?php echo $conlistsep->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsoct=AdminController::annpermonth($lists->id,'Oct',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>October </h1><td>
                        <td>

                        <?php  if($conlistsoct->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Oct'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>

 </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsoct->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of October</td>
</tr>

<?php }?>
<?php

foreach($conlistsoct as $conlistoct){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistoct->firstname); ?> <?php echo ucwords($conlistoct->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistoct->annmonth; ?> <?php echo $conlistoct->annday ?></td>
<td class="border-b"> <?php echo $conlistoct->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>



<br/><br/>
<?php $conlistsnov=AdminController::annpermonth($lists->id,'Nov',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>November </h1><td>
                        <td>

                        <?php  if($conlistsnov->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Nov'}}/{{$lists->id}}/{{$ann}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>
        </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsnov->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of November</td>
</tr>

<?php }?>
<?php

foreach($conlistsnov as $conlistnov){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistnov->firstname); ?> <?php echo ucwords($conlistnov->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistnov->annmoth; ?> <?php echo $conlistnov->annday ?></td>
<td class="border-b"> <?php echo $conlistnov->contact?></td>
</tr>

   
  
<?php }?>
</tbody>
</table>


<br/><br/>
<?php $conlistsdec=AdminController::annpermonth($lists->id,'Dec',$anns); ?>
<table width="100%"><tr>
                            <td width="80%">
                    <h1>December </h1><td>
                        <td>

                        <?php  if($conlistsdec->count()>0){?>
                            <a href="/admin/annmonthExtract/{{'Dec'}}/{{$lists->id}}/{{$anns}}/{{$annids}}" class="button box bg-theme-9 mt-3 text-white mr-2 flex items-center  ml-auto sm:ml-0">
                        <i data-feather="external-link" class="breadcrumb__icon"></i> Extract celebrants </a>

<?php }?>

     </td>
</tr>
                        </table>

<table class="table">
<thead>
<tr>

<th class="border-b-2 whitespace-no-wrap">Name</th>
<th class="border-b-2 whitespace-no-wrap">Date of Anniversary</th>
<th class="border-b-2 whitespace-no-wrap">Contact</th>
</tr>
</thead>
<tbody>

<?php    
if($conlistsdec->count()<1){?>
<tr class="bg-gray-200">
<td colspan=3> No celebrants in the month of December</td>
</tr>

<?php }?>
<?php

foreach($conlistsdec as $conlistdec){ ?>


<tr class="bg-gray-200">

<td class="border-b">       <?php echo ucwords($conlistdec->firstname); ?> <?php echo ucwords($conlistdec->lastname);?>
       </td>
<td class="border-b">  <?php echo $conlistdec->annmonth; ?> <?php echo $conlistdec->annday ?></td>
<td class="border-b"> <?php echo $conlistdec->contact?></td>
</tr>

   
  
<?php }?>
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
         <form  action="../addcontact/{{$lists->id}}" method="POST" >
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
                                                    <option>Choose month</option>
                                                    <option>January</option>
             <option>Februray</option>
             <option>March</option>
             <option>April</option>
             <option>May</option>
             <option>June</option>
             <option>July</option>
             <option>August</option>
             <option>September</option>
             <option>October</option>
             <option>November</option>
             <option>December</option>
         </select>     </div>
                                                <div class="col-span-12 sm:col-span-6">
                                                    <label><b>Birth Day</b></label>
                                                    <select name="birthday" class="input border mr-2 w-full">
                                                    <option>Choose day</option>
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