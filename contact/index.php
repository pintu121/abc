<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>

    	MirchiLoft.Com :: Contact Us

	</title>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="language" content="en" />
	<meta name="description" content="MirchiLoft.Com :: Free Mobile Ringtones, Wallpapers, Themes, Games, Softwares, Mp3 Songs, Videos
" />

	<meta name="keywords" content="MirchiLoft.Com :: Free Mobile Ringtones, Wallpapers, Themes, Games, Softwares, Mp3 Songs, Videos" />

	<meta name="robots" content="index, follow" />

	<link rel="shortcut icon" href="http://MirchiLoft.Com/images/favicon.ico" />
     
	<link rel="stylesheet" href="http://MirchiLoft.Com/stylesheet/mirchiloft.css" type="text/css" />

<div class="logo"><a href="http://MirchiLoft.Com/"><img alt="MirchiLoft.Com" width="180" height="30" src="/logo/logo_p_mirchiloft.gif" /></a></div>

</head>
<body>


<center>
<div class="devider">&nbsp;</div>
<h2>For any Complain / Request / Any Suggestion / Problems in Download?</h2>
</div>
<center>
<form method="post" action="sendmail.php">
<?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>
<input type="hidden" name="ip" value="<?php echo $ipi ?>" />
<input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
<input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />

<FONT COLOR="#C71585"><b>Your Name:</b></FONT> <br />
<input type="text" name="visitor" size="35" />
<br />
<FONT COLOR="#FFOOOO"><b>Your Email:</b></FONT><br />
<input type="text" name="visitormail" size="35" />
<br />
<FONT COLOR="#228B22"><b>Mobile No:</b></FONT><br />
<input type="text" name="number" size="20" />
<br />
<FONT COLOR="#OOOOFF"><b>About What?:</b></FONT><br />
<select name="attn" size="1">
<option value=" Request ">Request</option>
<option value=" Suggestions ">Suggestions</option>
<option value=" Partnership ">Partnership</option>
<option value=" Link Exchange ">Link Exchange</option>

</select>
<br /><br />
<FONT COLOR="#FFOOOO"><b>Mail Message:</b></FONT><br />
<textarea name="notes" rows="4" cols="40"></textarea>
<br />
<input type="submit" value="Send Mail" />
</form>
	
</body>
<div class="tCenter"><b>
<script type="text/javascript" src="http://widget.supercounters.com/online_t.js"></script><script type="text/javascript">sc_online_t(891729,"Online Users","");</script>
</b></div>
<div class="ftrLink"><a class="siteLink" href="http://MirchiLoft.Com/" style="font-size:14px">MirchiLoft.Com</a></div>
</body>
</html>