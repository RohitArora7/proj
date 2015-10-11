<?php 
$max_allowed_file_size = 3072; 
$allowed_extensions = array("docx");
$upload_folder = './uploads/'; 
$your_email = 'xxxxxx@gmail.com';

$errors ='';

if(isset($_POST['submit']))
{
	
	$name_of_uploaded_file =  basename($_FILES['uploaded_file']['name']);
	
	
	$type_of_uploaded_file = substr($name_of_uploaded_file, 
							strrpos($name_of_uploaded_file, '.') + 1);
	
	$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
	
	
	if(empty($_POST['name'])||empty($_POST['email']))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	
	if($size_of_uploaded_file > $max_allowed_file_size ) 
	{
		$errors .= "\n Size of file should be less than $max_allowed_file_size";
	}
	
	//------ Validate the file extension -----
	$allowed_ext = false;
	for($i=0; $i<sizeof($allowed_extensions); $i++) 
	{ 
		if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
		{
			$allowed_ext = true;		
		}
	}
	
	if(!$allowed_ext)
	{
		$errors .= "\n The uploaded file is not supported file type. ".
		" Only the following file types are supported: ".implode(',',$allowed_extensions);
	}
	
	//send the email 
	if(empty($errors))
	{
		//copy the temp. uploaded file to uploads folder
		$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
		$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
		
		if(!copy($tmp_path,$path_of_uploaded_file)
		{
		    if(!copy($tmp_path,$path_of_uploaded_file))
		    {
		    	$errors .= '\n error while copying the uploaded file';
		    }
		}
		
		
		$message = new Mail_mime(); 
		$message->setTXTBody($text); 
		$message->addAttachment($path_of_uploaded_file);
		$body = $message->get();
		$extraheader = array("From"=>$from, "Subject"=>$subject,"Reply-To"=>$visitor_email);
		$headers = $message->headers($extraheaders);
		$mail = Mail::factory("email");
		$mail->send($to, $headers, $body);
		//redirect to 'thank-you page
		header('Location: thank-you.html');
	}
}

function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg.match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
?>

<html>
<head>
	<title>File upload form</title>
<!-- define some style elements-->
<style>
label,a, body 
{
	font-family : Arial, Helvetica, sans-serif;
	font-size : 12px; 
}

</style>	
<!-- a helper script for vaidating the form-->
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>	
</head>

<body>
<?php
if(!empty($errors))
{
	echo nl2br($errors);
}
?>
<script language="JavaScript">
var frmvalidator  = new Validator("email_form_with_php");
frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<noscript>
<small><a href='http://www.google.com'
>php</a> article page.</small>
</noscript>

</body>
</html>