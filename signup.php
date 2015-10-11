<?php
$mysql_server = 'xxxxx';
$mysql_username = 'xxxxxx';
$mysql_password = 'xxxxxxx';
$mysql_database = 'xxxxxxx';
$mysql_table = 'xxxxxxxxx';
$success_page = './send.html';
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_name'] == 'signupform')
{
   $newemail = $_POST['email'];
   
   $newmessage = $_POST['message'];
   
   $code = 'NA';
   
   
   
   if (!preg_match("/^.+@.+\..+$/", $newemail))
   {
      $error_message = 'Email is not a valid email address. Please check and try again.';
   }
   
   
   
   if (empty($error_message))
   {
    $db = mysql_connect($mysql_server, $mysql_username, $mysql_password);
 //     if (!$db)
 //     {
 //        die('Failed to connect to database server!<br>'.mysql_error());
 //     }
      
//      $sql = "SELECT username FROM ".$mysql_table." WHERE username = '".$newusername."'";
      $result = mysql_query($sql, $db);
//      if ($data = mysql_fetch_array($result))
//      {
 //        $error_message = 'Username already used. Please select another username.';
 //     }
   }
   
   
   if (empty($error_message))
   {
     // $crypt_pass = md5($newpassword);
      //$newusername = mysql_real_escape_string($newusername);
      $newemail = mysql_real_escape_string($newemail);
      $newmessage = mysql_real_escape_string($newmessage);
      $result = mysql_query($sql, $db);
      mysql_close($db);
      header('Location: '.$success_page);
      exit;
   }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Signup</title>
<link href="login5.css" rel="stylesheet" type="text/css">
<link href="signup.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
<div id="wb_Signup1" style="position:absolute;left:184px;top:226px;width:448px;height:236px;z-index:0;">
<form name="signupform" method="post" action="<?php echo basename(__FILE__); ?>" id="signupform">
<input type="hidden" name="form_name" value="signupform">
<table id="Signup1">
<tr>
   <td class="Signup1_header" colspan="2" style="height:22px;">Message</td>
</tr>



<tr>
   <td style="height:20px">E-mail:</td>
   <td style="text-align:left"><input class="Signup1_input" name="email" type="textarea" id="email"></td>
</tr>



<tr>
<td style="height:18px">Message:</td>
</tr>

<tr>
<textarea name="message" id="message" style="position:absolute;left:82px;top:90px;width:298px;height:98px;z-index:1;" rows="5" cols="30"></textarea>

</tr>










<tr>
   <td colspan="2"><?php echo $error_message; ?></td>
</tr>
<tr>
   <td style="text-align:right;vertical-align:bottom" colspan="2"><input class="Signup1_button" type="submit" name="signup" value="Send" id="signup"></td>
</tr>
</table>
</form>
</div>
<div id="wb_Text1" style="position:absolute;left:148px;top:135px;width:487px;height:32px;text-align:center;z-index:1;">
<span style="color:#000000;font-family:'Bookman Old Style';font-size:27px;"><strong>User Query</strong></span></div>
<div id="wb_Text2" style="position:absolute;left:176px;top:138px;width:119px;height:24px;text-align:center;z-index:2;">
<span style="color:#000000;font-family:'Bookman Old Style';font-size:21px;"><strong><a href="javascript:history.back()" class="style1">&lt;&lt; Home</a></strong></span></div>
<img src="images/img0003.jpg" id="Banner1" alt="Backend system" style="border-width:0;position:absolute;left:201px;top:41px;width:387px;height:60px;z-index:3;">
</div>
</body>
</html>