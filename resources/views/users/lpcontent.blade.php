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
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">User</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" style="color:#84C345" class="breadcrumb--active">Landing Page</a>  </div>
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
                
               

                    <form method="POST"  action="/users/lpage_content/{{$page->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }} 

                    <br/><br/>
                    
<table>
<tr>
<td>  
<button type="submit"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i>Add Content </button>  


      
       </td>

       <td>  
       <?php  if(Usercontroller::userpackage()!='free'){?>
        <?php if($page->status==1){?>
        <a href="http://{{Usercontroller::showsubdomain(Auth::user()->id)}}.watawazi.com/page/{{Auth::user()->id}}/{{str_replace(' ', '-',strtolower($page->page_title))}}/{{$page->id}}" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="eye" class="w-4 h-4 mr-2"></i>Preview Page </a>  
<?php }?>

        <?php }else{?>
       <?php if($page->status==1){?>
<a href="/page/<?php echo UserController::encrypt_decrypt($page->id,true); ?>" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="eye" class="w-4 h-4 mr-2"></i>Preview Page </a>  

<?php }?>
      <?php }?>
       </td>

       <td>  
<a href="javascript:void(0);" onclick="adjustpage();" class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-11 text-white"> <i data-feather="settings" class="w-4 h-4 mr-2"></i>Page Settings </a>  


      
       </td>
                          
</tr>

                     </table>  
</form>

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
            

<div class="intro-y box">
<br/>
<br/>






                    
                  
                    <div class="px-5 sm:px-20  mt-5">

                    <h1 class="text-lg font-medium mr-auto mt-3" style="font-size:23px;color:<?php echo $page->color ?>">
               {{$page->page_title}}
                    </h1><a style="color:blue" href="javascript:void(0)" onclick="showEditTitle();">Edit Title</a><br/>




                    <div class="modal" id="superlarge-modal-size-previewtitle">
     <div class="modal__content modal__content--xl p-10 text-center"> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Edit Title
</h2>

     <form action="/users/post-title-update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
                {{ method_field("PUT")}}
                <br/>
                <input type="hidden" name="type" id="content-type2u">  
<textarea name="page-title" style="width:100%;background:#ccc;padding:20px;font-weight:bold;font-size:20px">{{$page->page_title}}</textarea>
<input type="hidden" name="pageid" value="<?php echo $page->id; ?>" />
<br/><br/>
<table style="float:left">
    <tr>
        <td>
<b>Text color</b>
       </td>
       <td>
<input type="color"  name="textcolor" value="<?php echo $page->color ?>">
       </td>
       </tr>
       </table>
<br/><br/>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save Update</button>
      
                   
                   </div>

     </form>



     </div>
 </div>


 <div class="modal" id="superlarge-modal-size-previewbg">
     <div class="modal__content modal__content--xl p-10 text-center"> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >Background Theme
</h2>

     <form action="/users/post-body-update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
                {{ method_field("PUT")}}
                <br/>

                <table text-align="center">
                    <tr>
                        <td>
                <input type="hidden" name="type" id="content-type2">  
<input type="hidden" name="pageid" value="<?php echo $page->id; ?>" />
<br/><br/>
<table style="float:left">
    <tr>
        <td>
Page background color
       </td>
       <td>
<input type="color"  name="bgcolor" value="<?php echo $page->bgcolor ?>">
       </td>
       </tr>
       <tr >
        <td style="padding-top:20px">
Add border around content
       </td>
       <td style="padding-top:20px">
           <table>
               <tr>
                   <td>
<input type="radio" <?php if($page->border_option==0){?> checked <?php }?>name="borderoption" onclick="check(this.value)" value="0" /> No
       </td>
       <td style="padding-left:20px">
<input type="radio" <?php if($page->border_option==1){?> checked <?php }?> name="borderoption" onclick="check(this.value)" value="1" /> Yes
       </td>
       </tr>
       </table>
       </td>
       </tr>


       <tr id="change-color" style="display:<?php if($page->border_option==0){?> none <?php }else{?> <?php }?>" >
        <td style="padding-top:20px">
Choose border color
       </td>
       <td style="padding-top:20px">
       <input type="color"  name="bordercolor" value="<?php echo $page->border_color ?>">
       </td>
       </tr>


       </table>

      

       </td>
                    </tr>

                   
                </table>
<br/><br/>


<br/><br/>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>

     </form>



     </div>
 </div>


                    <?php if($divs->count() <1){?>
                        <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-14 text-theme-7" style="width:100%" style="font-size:20px"> 
     This page is empty. Add contents to create a captivation sales and landing page
    </div>
    <br/>
    <br/>

    <?php }else{?>
        
        
        <form method="POST"  action="/users/save-new-page" enctype="multipart/form-data">
{{ csrf_field() }} 

<input type="hidden" name="pageid" value="<?php echo $page->id; ?>" />

<div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">


  @foreach($divs as $div)

<div class="intro-y col-span-12 sm:col-span-12" style="horizontal-align:center">
    <?php if($div->status==0){?>
<div>
<span style="float:right"><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertfrm3({{ $div->id}});" data-target="#medium-modal-size-preview7"  class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-6 text-white tooltip cursor-pointer" title="Remove this row"> <i data-feather="trash-2" class="w-4 h-4 mr-2"></i> </a>  </span>

<span style="float:right" class="tooltip cursor-pointer" title="Add a sign up form" ><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertSignup({{ $div->id}});" data-target="#medium-modal-size-preview6"  class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white "> <i data-feather="at-sign" class="w-4 h-4 mr-2"></i></a>  </span>

<span style="float:right" class="tooltip cursor-pointer" title="Add Video"><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertVideo({{ $div->id}});" class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="youtube" class="w-4 h-4 mr-2"></i>  </a>  </span>
    <span style="float:right" class="tooltip cursor-pointer" title="Add Button"><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertbutton({{ $div->id}});"   class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white"> <i data-feather="box" class="w-4 h-4 mr-2"></i> </a>  </span>
    <span style="float:right" class="tooltip cursor-pointer" title="Add Text"><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertType({{ $div->id}});"  class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white tooltip cursor-pointer" title="Add video"> <i data-feather="type" class="w-4 h-4 mr-2"></i></a>  </span>
    <span style="float:right" class="tooltip cursor-pointer" title="Add Image"><a id="deleteUser{{ $div->id}}" data-userid="{{$div->id}}" href="javascript:void(0)" onclick="showAlertImage({{ $div->id}});"  class="button w-25 mr-2 mb-2 flex items-center justify-center bg-theme-7 text-white tooltip cursor-pointer" title="Add Image"> <i data-feather="image" class="w-4 h-4 mr-2"></i></a>  </span>


</div>


 <textarea style="width:100%;height:50px; background:#F0F0F0" disabled>
 
</textarea>
<?php }else{?>

    <?php echo UserController::filterContent($div->id)?>

    <?php }?>
</div>
@endforeach
   

      
<!---
    
    <div class="intro-y col-span-12 sm:col-span-12"> 
                            <label><b>Confirmation SMS Message</b> <span style="color:forestgreen"> (<i> This is the message that will be sent to the mobile phone of members who fill and submit this form.</i> )</span></label> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> 
                            <textarea name="sms" class="input w-full bg-gray-200 pl-16 py-6 mt-2 placeholder-theme-13 resize-none" rows="1" placeholder="Type in message here..." onkeydown="limitText(this.form.message,this.form.countdown,160);" onkeyup='limitText(this.form.message,this.form.countdown,160);'>{{ old('sms') }}</textarea>
                        </div>
        
        <div class="intro-y col-span-12 sm:col-span-12" style="font-weight:bold;color:forestgreen;text-align:right">
        You have
        <input readonly type="text" name="countdown" size="3" value="160" style="font-weight:bold;color:forestgreen">chars left

</div>

                     
<div class="intro-y col-span-12 sm:col-span-12">
<label><b>Choose Sender ID to send SMS</b></label>

<select name="senderid" class="input w-full border mt-2 flex-1 bg-gray-200" required>
@foreach( $senderids as  $senderid)
<option value="{{ $senderid->name }}">{{ $senderid->name }}</option>
@endforeach
</select>
     
</div>
---->
      
    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
       
    <button type="submit"  class="button w-45 mr-2 mb-2 flex items-center justify-center bg-theme-9 text-white"> <i data-feather="globe" class="w-4 h-4 mr-2"></i>Save and Publish </button> 
    
    
    </div>
    <br/>
    <br/>
</div>




<?php }?>

    </form>


    <div class="modal" id="medium-modal-size-previewsignup">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Choose the Signup board
</h2>
     <form action="/users/add-row-signup" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>
@foreach($interfaces as $interface)
<div class="flex items-center border-b border-gray-200 px-5 py-4">     

                             <input type="hidden" name="id" id="signupid" />
                           
                            <input type="radio" name="interfaceLink" value="/interface/optin/{{ UserController::encrypt_decrypt($interface->table_id,true)}}/{{ UserController::encrypt_decrypt($interface->id,true)}}/{{ UserController::encrypt_decrypt(Auth::user()->id,true)}}" />
                            <div class="w-10 h-10 flex-none image-fit" style="padding-left:10px">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="{{ UserController::get_niche_logo($interface->table_id)}}" >
                                </div>
                                <div class="ml-3 mr-auto">
                                    <a href="/users/interface/{{ UserController::encrypt_decrypt($interface->table_id,true)}}" class="font-medium">{{ UserController::get_niche_name($interface->table_id)}}</a> 
                                    <div class="flex text-gray-600 truncate text-xs mt-1"> <a class="text-theme-1 inline-block truncate" href="">Created</a> <span class="mx-1">•</span> {{ \Carbon\Carbon::parse($interface->created_at)->diffForHumans() }} </div>
                             </div>
                                
                                
                                <div class="button box bg-theme-1 text-white  mr-2 flex items-center  ml-auto sm:ml-0" ><a target="_blank" href="/interface/optin/{{ UserController::encrypt_decrypt($interface->table_id,true)}}/{{ UserController::encrypt_decrypt($interface->id,true)}}/{{ UserController::encrypt_decrypt(Auth::user()->id,true)}}">Preview</a>
                                   
                                </div>
                            </div>

                            @endforeach
<br/>
                               
                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>


    <div class="modal" id="medium-modal-size-previewvideo">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Embed Code
</h2>
     <form action="/users/add-row-video" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>
<input type="hidden" name="id" id="id" />
<textarea name="video" style="width:100%;background:#ccc"></textarea>
<br/>
                               
                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



    <div class="modal" id="medium-modal-size-previewimage">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Choose and upload image
</h2>
     <form action="/users/add-row-image" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>

                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                  <input type="hidden" name="img" id="img" />
                                    <a href="" class="w-3/5 file__icon file__icon--image mx-auto">
                                        <div class="file__icon--image__preview image-fit">
                                        <img id="blah" alt="Brand logo" src="{{ asset('dist/images/brand_place_holder.png')}}" >
                                      
                                        </div>
                                    </a>
                                    
                                    <input name="oldimage" type="hidden" value=""   />
                                </div>
<br/>
                                <input name="file" type="file" onchange="readURL(this);"   required/>
                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 <div class="modal" id="medium-modal-size-previewbuttonedit">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Edit Button
</h2>
     <form action="/users/add-row-button-update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
                {{ method_field("PUT")}}
              
               <input type="hidden" id="idbutton" name="id" />
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>
<p style="padding-bottom:20px;font-weight:bolder">Choose your choice button</p>

    <table> 
        <tr>  
            <td><input type="radio" name="buttonType" value="1" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-1 text-theme-1">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="6" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-6 text-theme-6">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="7" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-7 text-theme-7">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="9" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-9 text-theme-9">Large</button></td>                       


</tr>



</table>

<p style="padding-top:20px;font-weight:bolder">Text</p>

<table width="100%"> <tr> <td><input type="text" name="buttonText" id="buttonText" class="input w-full border mt-2" required/></td></tr></table>
                          
<p style="padding-top:20px;font-weight:bolder">Link</p>

<table width="100%"> <tr> <td><input type="text" name="buttonLink" id="buttonLink" class="input w-full border mt-2"  required/></td></tr></table>
 

</div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 <div class="modal" id="medium-modal-size-previewbutton">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Add Button
</h2>
     <form action="/users/add-row-button" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               <input type="hidden" id="btnid" name="id" />
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>
<p style="padding-bottom:20px;font-weight:bolder">Choose your choice button</p>

    <table> 
        <tr>  
            <td><input type="radio" name="buttonType" value="1" required /></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-1 text-theme-1">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="6" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-6 text-theme-6">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="7" required /></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-7 text-theme-7">Large</button></td>                       


</tr>

<tr>  
            <td><input type="radio" name="buttonType" value="9" required/></td> 
            <td> <button class="button button--lg w-40 mr-1 mb-2 bg-theme-9 text-theme-9">Large</button></td>                       


</tr>



</table>

<p style="padding-top:20px;font-weight:bolder">Text</p>

<table width="100%"> <tr> <td><input type="text" name="buttonText" class="input w-full border mt-2" required/></td></tr></table>
                          
<p style="padding-top:20px;font-weight:bolder">Link</p>

<table width="100%"> <tr> <td><input type="text" name="buttonLink" class="input w-full border mt-2"  required/></td></tr></table>
 

</div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>




<div class="modal" id="medium-modal-size-previewimageedit">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Change image
</h2>
     <form action="/users/update-row-image" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/> <input type="hidden" name="imagetype" id="imagetype" />
                                  <input type="hidden" name="oldimage" id="previmage" />

                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                 
                                    <a href="" class="w-3/5 file__icon file__icon--image mx-auto">
                                        <div class="file__icon--image__preview image-fit">
                                        <img id="blah2" alt="Brand logo" src="{{ asset('dist/images/brand_place_holder.png')}}" >
                                      
                                        </div>
                                    </a>
                                    
                                    <input name="oldimage" type="hidden" value=""   />
                                </div>
<br/>
                                <input name="file" type="file" onchange="readURL2(this);"   required/>
                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>



 

                    </div>



                    

                  


                </div>



            </div>   
                    <!-- END: Data List -->
                    <!-- BEGIN: Pagination -->
                
                    <!-- END: Pagination -->

                   
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
               
                <!-- END: Delete Confirmation Modal -->

                <div class="modal" id="superlarge-modal-size-preview">
     <div class="modal__content modal__content--xl p-10 text-center"> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Type in text
</h2>

     <form action="/users/post-text" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
                <br/>
                <input type="hidden" name="type" id="type">  
<textarea data-feature="all" class="summernote" name="text-content"></textarea>

<br/>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save Text</button>
      
                   
                   </div>

     </form>



     </div>
 </div>


 <div class="modal" id="superlarge-modal-size-previewx">
     <div class="modal__content modal__content--xl p-10 text-center"> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Type in text
</h2>

     <form action="/users/post-text-update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
                {{ method_field("PUT")}}
                <br/>
                <input type="hidden" name="type" id="content-type">  
<textarea data-feature="all" class="summernote" id="text-content" name="text-content"></textarea>

<br/>
<div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save Update</button>
      
                   
                   </div>

     </form>



     </div>
 </div>

                <div class="modal" id="superlarge-modal-size-previewo">
     <div class="modal__content p-10 "> 
         
     <h2 class="intro-y text-lg font-medium" style="font-weight:bolder;font-size:20px" >
Type in text
</h2>
     <form action="/users/changeimage" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }} 
              
               
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
<br/><br/>
 

                         
<br/>
<textarea data-feature="all" class="summernote" name="editor"></textarea>



                            </div>     







<br/><br/>



        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                       
                        
                       <button type="submit" class="button box bg-theme-9 text-white  mr-2 flex items-center  ml-auto sm:ml-0">
                          Save</button>
      
                   
                   </div>
    
    

</form>

    
    
    </div>
 </div>
 


 <form action="" method="post" >
                <div class="modal" id="delete-confirmation-modal3">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:15px">Do you really want to delete this row? This process cannot be undone. All data regarding this board will be removed totally</div>
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
                <div class="modal" id="delete-confirmation-modalcontext">

               {{ csrf_field() }}

                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                           
                            <div class="text-gray-600 mt-2" style="font-size:15px">Do you really want to delete the content of this row? This process cannot be undone. All data regarding this board will be removed totally</div>
                            <input type="hidden", name="context" id="context">
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="submit" class="button w-24 bg-theme-6 text-white" onclick="senddelcontext();" >Yes! Delete</button>
                        </div>
                    </div>
                </div>
                </form>
            
@endsection

<script>

function limitText(limitField, limitCount, limitNum) {
          if (limitField.value.length > limitNum) {
            limitField.value = limitField.value.substring(0, limitNum);
          } else {
            limitCount.value = limitNum - limitField.value.length;
          }
        }

        function senddel3(){

       
window.location="/users/pagerow/delete/"+$('#app_id3').val();
 

}

function senddelcontext(){

       
window.location="/users/context/delete/"+$('#context').val();
 

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


  function showAlertfrm3(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#app_id3').val(userID); 
   $('#delete-confirmation-modal3').modal('show'); 
   
   
}


function showAlertType(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#type').val(userID); 
   $('#superlarge-modal-size-preview').modal('show'); 
   
   
}

function showAlertConDel(id){

    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#context').val(userID); 
   $('#delete-confirmation-modalcontext').modal('show'); 

}

function showEditTitle(){


$('#superlarge-modal-size-previewtitle').modal('show'); 

}

function adjustpage(){


$('#superlarge-modal-size-previewbg').modal('show'); 

}


function showAlertConEdit(id){

var formid=id;
var divID=$('#deleteUser'+formid).attr('data-userid');
 var _token = $('input[name="_token"]').val();
 $('#text-content').summernote('reset');
$.get('/users/pulltextcontent/'+divID,function(events){

 //$("text-content").summernote('code',"<p>jkkk</p>");
 
 $('#text-content').summernote('editor.pasteHTML',events.source);
 
 $("#content-type").val(events.div_id);


});

 $('#superlarge-modal-size-previewx').modal('show'); 

}


function showAlertImgEdit(id){

var formid=id;
var divID=$('#deleteUser'+formid).attr('data-userid');
 var _token = $('input[name="_token"]').val();
 
 $.get('/users/pullrowimage/'+divID,function(detail){
     $("#imagetype").val(detail.div_id);
     $('#previmage').val(detail.source);
     $('#blah2').attr('src', detail.source);
      

});

 $('#medium-modal-size-previewimageedit').modal('show'); 

}


function showAlertButtonEdit(id){

var formid=id;
var divID=$('#deleteUser'+formid).attr('data-userid');
 var _token = $('input[name="_token"]').val();
 
 $.get('/users/pullrowbutton/'+divID,function(detail){
     $("#idbutton").val(divID);
     $("#buttonLink").val(detail.link);
     $('#buttonText').val(detail.text);
    
      

});

 $('#medium-modal-size-previewbuttonedit').modal('show'); 

}



function showAlertbutton(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#btnid').val(userID); 
    $('#medium-modal-size-previewbutton').modal('show'); 
   
   
}



function showAlertImage(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#img').val(userID); 
   $('#medium-modal-size-previewimage').modal('show'); 
   
   
}

function showAlertVideo(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#id').val(userID); 
   $('#medium-modal-size-previewvideo').modal('show'); 
   
   
}

function showAlertSignup(id){
    var formid=id;
    var userID=$('#deleteUser'+formid).attr('data-userid');
    $('#signupid').val(userID); 
   $('#medium-modal-size-previewsignup').modal('show'); 
   
   
}

function check(no_redirect){
  
  if(no_redirect=='0'){
      $('#change-color').hide();
  }
  else if(no_redirect=='1'){
$('#change-color').show();
      
  }

}

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah2')
                        .attr('src', e.target.result)
                        .width(200)
                        
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

