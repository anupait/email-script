<?php
/* Set e-mail recipient */

	$to_name = "Recipient Name";
	$from_name =($_POST['name']);
	$subject = "Your Online Enquiry form has been submitted.";
	$body = stripslashes($_POST['body']);
	//$to_email = "customerservice@acrobatengineers.com";
	$to_email = "customerservice@acrobatengineers.com";
	$experience=$_POST['exp'];
	$mobile = $_POST['mobile'];
	$resume = $_POST['datafile'];

$bad_headers = array(
"/to\:/i",
"/from\:/i",
"/bcc\:/i",
"/cc\:/i",
"/Content\-Transfer\-Encoding\:/i",
"/Content\-Type\:/i",
"/Mime\-Version\:/i",'/(\n+)/i',
'/(\r+)/i',
'/(\t+)/i',
'/(%0A+)/i',
'/(%0D+)/i',
'/(%08+)/i',
'/(%09+)/i'
);

//Lets start our headers
$from_name = preg_replace($bad_headers, '', $_POST['name']);
$from_email = preg_replace($bad_headers, '', $_POST['email']);
$body = preg_replace($bad_headers, '', $_POST['body']); 
//$headers = "From: $from_name<" . $from_name . ">\n";
$headers = "From: $from_name<" . $_POST['email'] . ">\n";
$headers .= "Reply-To: <" . $from_email . ">\n"; 
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"----=MIME_BOUNDRY_main_message\"\n"; 
$headers .= "X-Sender: $from_name<" . $body . ">\n";
$headers .= "X-Mailer: PHP4\n";
$headers .= "X-Priority: 3\n"; //1 = Urgent, 3 = Normal
$headers .= "Return-Path: <" . $body . ">\n"; 
$headers .= "This is a multi-part message in MIME format.\n";
$headers .= "------=MIME_BOUNDRY_main_message \n"; 
$headers .= "Content-Type: multipart/alternative; boundary=\"----=MIME_BOUNDRY_message_parts\"\n"; 

$message = "------=MIME_BOUNDRY_message_parts\n";
$message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n"; 
$message .= "Content-Transfer-Encoding: quoted-printable\n"; 
$message .= "\n"; 
/* Add our message, in this case its plain text. You could also add HTML by changing the Content-Type to text/html */
$message .= "

Name     :     $from_name
Email    :     $from_email
Mobile   :     $mobile
Experience  :  $experience
Resume  :     $resume

AEA.......................


";
// send the message
mail("$to_name<$to_email>", $subject, $message, $headers); 

/* Redirect visitor to the thank you page */
echo '<script> alert("Email has been successfully delivered to the Company and shall revert you at the earliest!.")
window.location.href="career.html";
 </script>';
exit();

?>
