<style type="text/css">
body {
	font-family:Arial, Helvetica, sans-serif
}
h1, h2 {
	font-family:'Georgia', Times New Roman, Times, serif;
}
h2 {
	color:#999;
}
ul {
	padding:0px;
	margin:0px;
	list-style:none;
}
li {
	padding:5px;
	display:none;
}
label {
	font-size:14px;
	font-weight:bold;
}
input[type="text"], input[type="password"] {
	-moz-border-radius: 6px 6px 6px 6px;
	-moz-box-shadow: 3px 5px 10px #78D8F2;
	border: 1px solid #05BBED;
	font-size: 15px;
	margin: 8px;
	padding: 6px;
	width: 220px;
}
input[type="submit"] {
	background-color: #078EA0;
	border: 1px solid #0094A7;
	color: #FFFFFF;
	font-size: 14px;
	padding: 4px;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
}
.error {
	font-size:11px;
	color:#cc0000;
	padding:4px;
}
#form {
	width:600px;
	margin:0 auto;
	margin-top:30px;
}
#form-elements {
	border: 1px solid #aeaeae;
	background-color: #F2F2F2;
	padding: 14px;
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<div id="form">
  <h2>Jquery registration form</h2>
  <form id="form-elements" method="post">
    <ul>
      <li class="username">
        <label>Username: </label>
        <input id="username" name="name" type="text" />
        <span class="error"> </span></li>
      <li class="password">
        <label>Password: </label>
        <input id="password" name="password" type="password" />
        <span class="error"> </span></li>
      <li class="email">
        <label>Email: </label>
        <input id="email" name="email" type="text" />
        <span class="error"> </span></li>
      <li class="phone">
        <label>Phone No: </label>
        <input id="phone" name="phone" type="text" />
        <span class="error"> </span></li>
      <li class="submit">
        <input id="submit" type="submit" value=" Register " />
      </li>
    </ul>
  </form>
</div>
<script type="text/javascript" language="javascript">
$(function() {
		//regular expression for all the fields
		var ck_username = /^[A-Za-z0-9_]{5,20}$/;
		var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i 
		var ck_password =  /^[A-Za-z0-9!@#$%^&amp;*()_]{6,20}$/;
		var ck_phone = /^[0-9-]{10,20}$/;
		//This function will be called for each key pressed in the username field 
		$('#username').keyup(function()
		{
			var username=$(this).val();
			if (!ck_username.test(username)) 
			{
			 	$(this).next().show().html("Minimum 5 characters");
			}
			else
			{
				$(this).next().hide();
				$("li").next("li.password").slideDown({duration: 'slow',easing: 'easeOutElastic'});
			}
		});
		//This function will be called for each key pressed in the password field
		$('#password').keyup(function()
		{
			var password=$(this).val();
			if (!ck_password.test(password)) 
			{
			 	$(this).next().show().html("Minimum 6 Characters");
			}
			else
			{
				$(this).next().hide();
				$("li").next("li.email").slideDown({duration: 'slow',easing: 'easeOutElastic'});
			}
		});
		//This function will be called for each key pressed in the email field
		$('#email').keyup(function()
		{
			var email=$(this).val();
			if (!ck_email.test(email)) 
			{
			 	$(this).next().show().html("Enter valid email");
			}
			else
			{
				$(this).next().hide();
				$("li").next("li.phone").slideDown({duration: 'slow',easing: 'easeOutElastic'});
			}
		});
		//This function will be called for each key pressed in the phone number field
		$('#phone').keyup(function()
		{
			var phone=$(this).val();
			if (!ck_phone.test(phone)) 
			{
			 	$(this).next().show().html("Minimum 10 numbers");
			}
			else
			{
				$(this).next().hide();
				$("li").next("li.submit").slideDown({duration: 'slow',easing: 'easeOutElastic'});
			}
		});
		//when we register it will show the status.
		$('#submit').click(function()
		{
			var email=$("#email").val();
			var username=$("#username").val();
			var password=$("#password").val();
			if(ck_email.test(email) & ck_username.test(username) & ck_password.test(password) )
			{
				$("#form").show().html("<h1>Thank you!</h1><p>You have registered successfully</p>");
			}
			return false;
		});
		$("ul li:first").show();
		$('#username').focus();
});
</script>
