<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type"
content="text/html;charset=utf-8" />
<title>
Site
</title>
<style>
body{
	color:#ff0000;
	text-align: center;
	border: 1px dashed #b90000
}
a:link,a:visited,a:active{
	text-decoration: none
}
a:hover{
	color:#000000;
	border-bottom: 1px solid #b90000
}
div.mess{
	color:#000000;
	text-align:center
}
</style>
<meta HTTP-EQUIV="REFRESH" content="2; url=/contact/index.php">
</head>

<body>
<?php
$ip = $_POST['ip'];
$httpref = $_POST['httpref'];
$httpagent = $_POST['httpagent'];
$visitor = $_POST['visitor'];
$visitormail = $_POST['visitormail'];
$notes = $_POST['notes'];
$attn = $_POST['attn'];

if (eregi('sex', $notes)) {
die ("Do NOT try that! ! ");
}
if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,".")))
{
$badinput = "<h2>Feedback was NOT submitted</h2>\n";
echo $badinput;
die ("Go back! ! ");
}

if(empty($visitor) || empty($visitormail) || empty($notes )) {
echo "Seems Like u Missed SomeThing.<br/>\n";
die ("<a href='index.php'>Back</a><br/><br/>");
}

$todayis = date("l, F j, Y, g:i a");

$attn = $attn;
$subject = $attn;

$notes = stripcslashes($notes);

$message = " $todayis [EST] \n
About: $attn \n\n
Message: $notes \n\n
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
mirchiloft Referral : $httpref \n
";

$from = "From: $visitormail\r\n";


mail("mirchiloft.com@gmail.com", $subject, $message, $from);

?>




<p>

<br />
Thank You  <?php echo $visitor ?> ( <?php echo $visitormail ?> ) 
<br />
Your Mail
About  <?php echo $attn ?>
<br/>
 And The Message
<div class="mess">
<?php $notesout = str_replace("\r", "<br/>", $notes);
echo $notesout; ?>
</div>
 Has Been Sent To Admin! <br/>
You'll Get A Response As Soon As Possible.<br/>
We Have Logged Your<br/> 
IP+Browser+Location <br/>
To Aviod Misuse Of This Service!<BR/>

<br />

</p>



  </body>
</html>
                            