<?php
if(isset($_POST['go'])) 
{
	$email_to = "jeffrey_reeve@hotmail.com";
	$email_subject = "You've had an enquiry!";

    function died($error) {// your error code can go here
	echo "We are very sorry, but there were error(s) found with the form you submitted. ";
	echo "These errors appear below.<br /><br />";
	echo $error."<br /><br />";
	echo "Please go back and fix these errors.<br /><br />";
	die();
	}
	
	    // validation expected data exists
	
	    if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['comments'])) 
		{
			died('We are sorry, but there appears to be a problem with the form you submitted.');       
		}
	
	$name = $_POST['name'];
    $email_from = $_POST['email'];
    $comments = $_POST['comments'];
    $error_message = "";

	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';//regular expression
	if(!preg_match($email_exp,$email_from)) //matches a string to regular expression for an email address
	{
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
	}
	    
	$string_exp = "/^[A-Za-z .'-]+$/";
	if(!preg_match($string_exp,$name)) //matches a string to regular expression for a name
	{
		$error_message .= 'The Name you entered does not appear to be valid.<br />';
	}
	
	if(strlen($comments) < 2) 
	{
		$error_message .= 'The Comments you entered do not appear to be valid.<br />';
	}
	
	function clean_string($string) 
	{
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}
    
	$email_message = "Form details below.\n\n"; 
    $email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Comments: ".clean_string($comments)."\n";

	echo $error_message;
	
	// create email headers
	$headers = "daneborrell@e26.ehosts.com";
	/* $headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion(); */

	$success = mail($email_to, $email_subject, $email_message, $headers); 
}
	
	
	
/* 	if (isset($_POST['go'])) {//form will submit on activation of submit button
		{
			if (empty($_POST["name"])) 
			{
				$nameError = "name is required";
			}else
			{
				$name = testInput
			}
     $to = 'jeffrey_reeve@hotmail.com'; // Use your own email address
     $subject = 'Feedback from my site';
	 $message = 'Name: ' . $_POST['name'] . "\r\n\r\n";
	 $message .= 'Email: ' . $_POST['email'] . "\r\n\r\n";
	 $message .= 'Message: ' . $_POST['comments'];
	 
	 $headers = "From: jeff@filmwolf.co.uk\r\n";
	 $headers .= 'Content-Type: text/plain; charset=utf-8';
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
if ($email) {
   $headers .= "\r\nReply-To: $email";
}
	}
$success = mail($to, $subject, $message, $headers);
	
     */

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thanks For Getting In Touch</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"><!-- ensures proper rendering and touch zooming on mobile -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="company.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script><!-- jquery link -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><!-- BS content delivery network -->
  <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="company.js"></script>
</head>

<body>
<?php if (isset($success) && $success) { ?><!--or use header('Location: successful.html'); */

<!-- jumbotron -->
<div class="jumbotron text-center"><!-- centre text using BS class -->
  <h1>MKeetley Electrical</h1> 
  <p>Thanks for getting in touch. We aim to get back to you within the next 24hrs.</p>
    <form class="form-inline">
    <a href="index.html"><button type="button" class="btn">Return To Site</button></a>
	
	<a href="http://google.com">
    <input type="button" value="Google!" />
</a>
  </form>
</div>
<!-- jumbotron -->

<?php } else { ?>
      <h1>Oops!</h1>
      Sorry, there was a problem sending your message.
      <?php } ?>
</body>
</html>
