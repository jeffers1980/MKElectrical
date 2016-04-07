<?php
if(isset($_POST['go'])) 
{
    $email_to = "myName@mySite.com";
    $email_subject = "You've had an enquiry!";

    function died($error) 
    {//error code can go here
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
    $headers = "myName@mySite.com";
    /* $headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from."\r\n" .'X-Mailer: PHP/' . phpversion(); */

    $success = mail($email_to, $email_subject, $email_message, $headers); 
}
?>
