<div class="w3-container w3-large" style="margin-top:50px; margin-left:25px; line-height: 23px">
<?php

// include CSS Style Sheet

echo "<link rel='stylesheet' type='text/css' href='css/styles.css'/>\n";
echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400'/>\n";
echo "<link rel='icon' href='img/logo.png'/>\n";
$myemail = "contact@greenbackco.com";
$subject = "Set Up this QR CODE!";
$name = $_POST['name'];
$email = $_POST['email'];
$code = $_POST['code'];
$facebook = $_POST['facebook'];
$linkedin = $_POST['linkedin'];
$instagram = $_POST['instagram'];
$twitter = $_POST['twitter'];
$snapchat = $_POST['snapchat'];
$wechat = $_POST['wechat'];
$website = $_POST['website'];
$headers = "From: QR Code Setup <$email>\r\n";
$headers.= "Reply-To: $name <$email>\r\n";

if(!isset($facebook)) {
	$facebook = " ";
}
if(!isset($linkedin)) {
	$linkedin = " ";
}
if(!isset($instagram)) {
	$instagram = " ";
}
if(!isset($twitter)) {
	$twitter = " ";
}
if(!isset($snapchat)) {
	$snapchat = " ";
}
if(!isset($wechat)) {
	$wechat = " ";
}
if(!isset($website)) {
	$website = " ";
}

// Error code

function died($error) {
	echo "<p class='text'>Sorry, there were errors in your form submission. These errors appear below.</p>";
	echo "<p class='text'>" . $error . "</p>";
	echo "<p class='text'>Please go back and fix these errors.</p>";
	echo "<br><br><a href='qrsetup.html' class='CTA CTAtext'>RETURN</a>";
	die();
}

// Validation code

if (!isset($name) || !isset($code)) {
	died('Please fill all required fields.');
}

$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if (!preg_match($email_exp, $email)) {
	$error_message.= '<li style=\'margin-left:20px\' class=\'text\'> The email address you entered is invalid.</li>';
}

if (strlen($error_message) > 0) {
	died($error_message);
}

// Clean the text

function clean_string($string) {
	$bad = array(
		"content-type",
		"bcc:",
		"to:",
		"cc:",
		"href"
	);
	return str_replace($bad, "", $string);
}

$message = "Name: " . $name . "\n\nEmail: " . $email . "\n\nCode: " . $code . "\n\n\nQR CODE INFO\n\nFacebook: " . $facebook . "\n\nLinkedIn: " . $linkedin . "\n\nInstagram: " . $instagram . "\n\nTwitter: " . $twitter . "\n\nSnapchat: " . $snapchat . "\n\nWeChat: " . $wechat . "\n\nPersonal Website: " . $website;

if (mail($myemail, $subject, $message, $headers)) {
	echo "<p class='text'>Thank you for your purchase! We will set up your QR Card (" . $code . ") with the information you provided and we will contact you as soon as it is ready.</p>";
	echo "<br><br><a href='index.html' class='CTA CTAtext'>RETURN</a>";
}
else {
	echo "<p class='text'>We're sorry but an error occurred during your order></p>";
	echo "<br><br><a href='qrsetup.html' class='CTA CTAtext'>RETURN</a>";
}

?>
</div>