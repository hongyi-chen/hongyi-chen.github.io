<div class="w3-container w3-large" style="margin-top:50px; margin-left:25px; line-height: 23px">
<?php

// include CSS Style Sheet

echo "<link rel='stylesheet' type='text/css' href='css/styles.css'/>\n";
echo "<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400'/>\n";
echo "<link rel='icon' href='img/logo.png'/>\n";
$myemail = "contact@greenbackco.com";
$subject = "New Order from Website";
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone-number'];
$address = $_POST['address'];
$quantity = 1;
if ((int)$_POST['quantity'] != 0) {
	$quantity = (int)$_POST['quantity'];
}
$promocode = strtoupper($_POST['promo-code']);
$codeEntered = False;
$discount = 0;
$discountMsg = "";
if ($promocode == "LAUNCH20") {
	$discount = 5;
	$discountMsg = "LAUNCH20 applied";
	$codeEntered = True;
} else if (isset($promocode)) {
	$discountMsg = "Promo Code is invalid";
	$codeEntered = True;
}
$subtotal = $quantity * 25;
$shipping = $_POST['shippingMethod'];
$shippingPrice = 0;
if ($shipping == "Standard") {
	$shippingPrice = 5;
}
$price = $subtotal + $shippingPrice - $discount;
$order_num = rand(10000, 99999);

$facebook = $_POST['facebook'];
$linkedin = $_POST['linkedin'];
$instagram = $_POST['instagram'];
$twitter = $_POST['twitter'];
$snapchat = $_POST['snapchat'];
$wechat = $_POST['wechat'];
$website = $_POST['website'];
$headers = "From:Greenback Website Order Form <$email>\r\n";
$headers.= "Reply-To: $name <$email>\r\n";

if(!isset($promocode)) {
	$promocode = " ";
}
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
	echo "<br><br><a href='buy.html' class='CTA CTAtext'>RETURN</a>";
	die();
}

// Validation code

if (!isset($name) || !isset($email) || !isset($phone) || !isset($address) || !isset($quantity)) {
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

$message = "Order #: " . $order_num . "\n\nName: " . $name . "\n\nEmail: " . $email . "\n\nPhone Number: " . $phone . "\n\nAddress: " . $address . "\n\nShipping: " . $shipping . "\n\nQuantity: " . $quantity . "\n\nPrice: " . $price . "\n\n\nQR CODE INFO\n\nFacebook: " . $facebook . "\n\nLinkedIn: " . $linkedin . "\n\nInstagram: " . $instagram . "\n\nTwitter: " . $twitter . "\n\nSnapchat: " . $snapchat . "\n\nWeChat: " . $wechat . "\n\nPersonal Website: " . $website;

if (mail($myemail, $subject, $message, $headers)) {
	echo "<p class='text'>Thank you for your purchase!</p>\n
			<p class='text'>Here is a summary of your order:</p>\n<br>\n
			<p class='text'>" . $name . "</p>\n
			<p class='text'>" . $email . "</p>\n
			<p class='text'>" . $phone . "</p>\n
			<p class='text'>" . $address . "</p>\n<br>\n
			<p class='text'>" . $quantity . " Wallet(s)</p>\n<br>
			<p class='text'> Order Number: #" . $order_num . "</p>\n<br>\n
			<p class='text'>Wallet $" . $subtotal . ".00</p>\n";
	if ($codeEntered) {
		echo "<p class='text'>Discount -$" . $discount . ".00 (" . $discountMsg . ")</p>\n";
	}
	echo "<p class='text' style='text-decoration: underline'>Shipping $" . $shippingPrice . ".00</p>\n<br>
			<p class='text'>Total $" . $price . ".00</p>\n<br><br>\n
			<p class='text' style='font-weight: bold'>Please e-transfer your payment in full to <span style='color: #5fac60; text-decoration: underline'>contact@greenbackco.com</span> with <span style='text-decoration: underling'>your name as your security question and your order number (" . $order_num . ") as your password</span> within 48 hours to complete your order.</p>";
	echo "<br><br><a href='index.html' class='CTA CTAtext'>RETURN</a>";
}
else {
	echo "<p class='text'>We're sorry but an error occurred during your order></p>";
	echo "<br><br><a href='buy.html' class='CTA CTAtext'>RETURN</a>";
}

?>
</div>