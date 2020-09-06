Hello <i>{{ $pg_email->name }}</i>,
<p>This email have been sent because you have recently requested for your password to be reset.</p>
<p>Password reset was successfull!</p>

<div>
<p>To login use these login details. &nbsp;<a href="https://fxauction.net/login">Click to login</a></p>
<p><b>Username:</b>&nbsp;{{ $pg_email->username }}</p>
<p><b>Password:</b>&nbsp;{{ $pg_email->password }}</p>
</div>
 
Thank You,
<br/>
<i><b>The FXAuction Team</b></i>