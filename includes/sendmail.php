<?php

if(isset($_POST['submit']) && $_POST['submit'] == 'submitForm'){
	
	$to = 'wilbertfoundation@wilbertinc.com'; // Your Email Address
	
	$name = $_POST['form_name'];
	$email = $_POST['form_email'];
	$inquiry = $_POST['form_subject'];
	$phone = $_POST['form_phone'];
	$message = $_POST['form_message'];
	
	$name = isset($name) ? "Name: $name<br><br>" : '';
	$email = isset($email) ? "Email: $email<br><br>" : '';
	$phone = isset($phone) ? "Phone: $phone<br><br>" : '';
	$inquiry = isset($inquiry) ? "Website Inquiry: $inquiry<br><br>" : '';
	$message = isset($message) ? "Message: $message<br><br>" : '';

	$referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>This Form was submitted from: ' . $_SERVER['HTTP_REFERER'] : '';
	
	$subject = 'Contact form Welbert Foundation';
	$body = "$name $email $phone $inquiry $message $referrer";
	
	$headers = '';
	$headers = 'MIME-Version: 1.0'.PHP_EOL;
	$headers .= 'Content-type: text/html; charset=iso-8859-1'.PHP_EOL;
	//$headers .= 'From: webmaster@example.com<From: webmaster@example.com>'.PHP_EOL; 
	
	$sendEmail = mail($to, $subject, $body, $headers);

	if( $sendEmail){
		$message = 'We have <strong>successfully</strong> received your Message and will get Back to you as soon as possible.';
		$status = "true";
	}else{
		$message = 'Email <strong>could not</strong> be sent due to some Unexpected Error. Please Try Again later.<br /><br />';
		$status = "false";
	}    
	$status_array = array( 'message' => $message, 'status' => $status);
	echo json_encode($status_array);	
}
?>