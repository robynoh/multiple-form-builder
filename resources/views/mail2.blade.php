<?php   use \App\Http\Controllers\UserController; ?>
<div>
<img src="{{ asset('form/img/demos/startup-agency/logo.png')}}" class="img-fluid" width="195" height="64" alt="" />
</div>

<h1 style="font-size:12px">Hi, {{ $name }}</h1>
<div>
<p> you have a new lead sign up: {{ $email }}</p>
</div>
<?php if(Usercontroller::userpackagebrand($userid)=='free'){?>
<div style="font-size:11px">
<br/><br/>
<p>This is sent by the watawazi team. Watawazi is an email list builder published by Ragura LTD a digital marketing solution provider company registerd 
with Nigeria corprate affiars commission.</p>
 <p>RC number: 1574301 <br/>
Publication Director: Agaga Robinson<br/>
Phone: +234 08032454342 <br/>
contact@watawazi.com <br/>

website: <a href="https://www.watawazi.com/">www.watawazi.com</a> 

</p>
</div> 
<?php }?>