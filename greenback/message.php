<div class="w3-container w3-large" style="margin-top:50px; margin-left:25px">
<?php

// include CSS Style Sheet

echo "<link rel='stylesheet' type='text/css' href='css/styles.css'/>";
echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400'/>";
echo "<link rel='icon' href='img/logo.png'/>";
$myemail = "contact@greenbackco.com";
$subject = "Greenback Website Message";
$name = $_POST['name'];
$email = $_POST['email'];
$headers = "From: $name <$myemail>\r\n";
$headers.= "Reply-To: $name <$email>\r\n";

// Error code

function died($error) {
	echo "<p class='text'>Sorry, there were errors in your form submission. These errors appear below.</p>";
	echo $error;
	echo "<p class='text'>Please go back and fix these errors.</p>";
	echo "<br><br><a href='contact.html' class='CTA CTAtext'>RETURN</a>";
	die();
}

// Validation code

if (!isset($name) || !isset($email) || !isset($_POST['message'])) {
	died('Please fill all required fields.');
}

$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if (!preg_match($email_exp, $email)) {
	$error_message.= '<li style=\'margin-left:20px\' class=\'text\'> The email address you entered is invalid.</li>';
}

if (strlen($_POST['message']) < 2) {
	$error_message.= '<li style=\'margin-left:20px\' class=\'text\'> The message you entered is invalid.</li>';
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

$message = "Name: " . clean_string($name) . "\n\nEmail: " . clean_string($email) . "\n\n" . clean_string($_POST['message']);

if (mail($myemail, $subject, $message, $headers)) {
	echo "<p class='text'>Your message has been sent successfully!</p>";
	echo "<br><br><a href='index.html' class='CTA CTAtext'>RETURN</a>";
}
else {
	echo "<p class='text'>We're sorry but an error occurred during the submission of your message></p>";
	echo "<br><br><a href='contact.html' class='CTA CTAtext'>RETURN</a>";
}

?>
</div>