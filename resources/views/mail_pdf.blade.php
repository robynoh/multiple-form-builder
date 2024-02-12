<?php   use \App\Http\Controllers\UserController; ?>


<h1 style="font-size:14px">Hi,</h1>
<p style="font-size:14px;font-weight:bold">{{ $msg }}</p>
<p style="font-size:14px">Thanks for finding this ebook useful. <a href="<?php echo UserController::getsubdomain($user)?>.watawazi.com/file/{{$id}}">Click here</a> to download it.</p>

