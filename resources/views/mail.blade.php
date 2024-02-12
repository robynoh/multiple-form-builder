<?php   use \App\Http\Controllers\UserController; ?>


<h1 style="font-size:12px">Hey,</h1>
<p>{{ $msg }}</p>
<?php if(Usercontroller::userpackagebrand($userid)=='free'){?>
<div style="font-size:11px">
<br/><br/>
<p>This is sent using watawazi. Watawazi is an email list builder published by Ragura LTD a digital marketing solution provider company registerd 
with Nigeria corprate affiars commission.</p>
 <p>RC number: 1574301 <br/>
Publication Director: Agaga Robinson<br/>
Phone: +234 08032454342 <br/>
contact@watawazi.com <br/>

website: <a href="https://www.watawazi.com/">www.watawazi.com</a> 

</p>
</div> 
<?php }?>