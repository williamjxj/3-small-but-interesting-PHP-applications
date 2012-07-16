<?php
if(isset($_POST['email'])) {
	if ( !check_email( trim($_POST['email']) )) {
		echo 'Please enter a valid email address<br />';
	}
	else send_email();
}
else init();
exit;

//////////////////////////////

function init() {
?>
<script language="javascript" type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validationEngine-en.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css" />
<link rel="stylesheet" href="include/jqtransform/jqtransformplugin/jqtransform.css" type="text/css" media="all" />
<link rel="stylesheet" href="include/jqtransform/demo.css" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="include/jqtransform/jqtransformplugin/jquery.jqtransform.js"></script>
<form id="request_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" class="jqtransform" style="display:none;">
  <p>Organization:</p>
  <div class="inputbg">
    <input id="organization" name="organization" type="text"  class="input validate[required]" onFocus="this.select();" />
  </div>
  <br />
  <p>Name:</p>
  <div class="inputbg">
    <input id="name" name="name" class="input validate[required]" type="text" onFocus="this.select();" />
  </div>
  <br />
  <p>Email:</p>
  <div class="inputbg">
    <input id="email" name="email" type="text" class="input validate[required,custom[email]]" onFocus="this.select();" />
  </div>
  <br />
  <p>Phone #:</p>
  <div class="inputbg">
    <input id="phone" name="phone" class="input validate[required,custom[telephone]]" type="text" onFocus="this.select();" />
  </div>
  <br />
  <p>
    <input id="request_submit" value="Send Request" type="submit">
  </p>
</form>
<script language="javascript" type="text/javascript">
$(function() {
  var form = '#request_form';
  $(form).fadeIn(100);
  $(form + ".jqtransform").jqTransform({imgPath:'include/jqtransform/jqtransformplugin/img/'});
  // $(form).validationEngine();
  $("#request_submit").click( function(event) {
	event.preventDefault();
	if ($(form).validationEngine({returnIsValid:true})) {
		$.ajax({
			type: $(form).attr('method'),
			url: $(form).attr('action'),
			data: $(form).serialize(),
			success: function(data) {
				alert(data);
				$(form).append('<p>Successfully send out this email request!</p>');
			}
		});
	}
  });
});
</script>
<?php
}

function check_email($emailAddress) {
	if (preg_match('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $emailAddress)){
		$emailArray = explode("@",$emailAddress);
		if (checkdnsrr($emailArray[1])){
			return true;
		}
	}
	return false;
}

function send_email() {
	$message = "\nOrganization: " . $_POST['organization'] . 
		"\nName: " . $_POST['name'] .
		"\nEmail: " . $_POST['email'] .
		"\nPhone: " . $_POST['phone'];
	
	$message .= "\n\nBrowser Info: " . $_SERVER["HTTP_USER_AGENT"] .
		"\nIP: " . $_SERVER["REMOTE_ADDR"] .
		"\n\nDate: " . date("Y-m-d h:i:s");

	$siteEmail = 'your-email-here';
	$emailTitle = 'Request from multiemployerbenefits.com';
	$thankYouMessage = "Thank you for contacting us, we'll get back to you shortly.";   

	if(! mail($siteEmail, $emailTitle, $message, 'From: ' . $_POST['name'] . ' <' . $_POST['email'] . '>'))
		echo 'Mail can not sent.';
}
?>
