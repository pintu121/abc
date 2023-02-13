<h2><center>::.. Disclaimer ..::</center></h2>

<br/>
<div class="tCenter">

<?php
    /**************************************************************************
     *  Adiquity Ad Code - Adiquity.com
     *  Copyright Guruji.com Software Pvt Ltd . All rights reserved. 
     *	Language: PHP (Curl)
     *	Version: 18072011
     **************************************************************************/

	$adq_params = array(
			"ADQ_PARAMS"  => array(
					"pazid"=>"adqnhqh3-14z11lmp-u67d6",//PAZID		
					"adbgcolor"=>"FFFFFF", //Ad Unit Background color
					"adtcolor"=>"0063DC",  //Ad Unit Text color
					  )
			);

	/////////////////////////////////
	// Do not edit below this line //
	/////////////////////////////////

	$params = array();
	$params = array(
			"ua=" . urlencode($_SERVER["HTTP_USER_AGENT"]),
			"TIP=". urlencode($_SERVER["REMOTE_ADDR"]),
			"aclang=". "php",
			"acver=". "18072011" ,
			"cat"=>"s1,en"
			);
	if (!empty($adq_params["ADQ_PARAMS"])){
		foreach ($adq_params["ADQ_PARAMS"] as $k => $v){
			$params[] = urlencode($k) . "=" . urlencode($v);
		}
	}
	foreach ($_SERVER as $k => $v) {
		if ((substr($k, 0, 4) == "HTTP") ||(substr($k, 0, 3) == "REQ"))  {
			$params[] = $k . "=" . urlencode($v);
		}
	}
	$post = implode("&", $params);
	$request = curl_init();
	$request_timeout = 6; // 10 seconds timeout
	$adq_url = "http://ads.adiquity.com/mads";
	curl_setopt($request, CURLOPT_URL, $adq_url);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($request, CURLOPT_TIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close", "adqkns2s-14em1p99-tbv6t"));
	curl_setopt($request, CURLOPT_POSTFIELDS, $post);

	$contents = curl_exec($request);
	if (curl_getinfo($request,CURLINFO_HTTP_CODE) == 200)
	{
		if ($contents === true || $contents === false)
			$contents = "";
			echo $contents;
	}
	curl_close($request);
	
?><?php
    /**************************************************************************
     *  Adiquity Ad Code - Adiquity.com
     *  Copyright Guruji.com Software Pvt Ltd . All rights reserved. 
     *	Language: PHP (Curl)
     *	Version: 18072011
     **************************************************************************/

	$adq_params = array(
			"ADQ_PARAMS"  => array(
					"pazid"=>"adqnhqh3-14z11lmp-u67d6",//PAZID		
					"adbgcolor"=>"FFFFFF", //Ad Unit Background color
					"adtcolor"=>"0063DC",  //Ad Unit Text color
					  )
			);

	/////////////////////////////////
	// Do not edit below this line //
	/////////////////////////////////

	$params = array();
	$params = array(
			"ua=" . urlencode($_SERVER["HTTP_USER_AGENT"]),
			"TIP=". urlencode($_SERVER["REMOTE_ADDR"]),
			"aclang=". "php",
			"acver=". "18072011" ,
			"cat"=>"s1,en"
			);
	if (!empty($adq_params["ADQ_PARAMS"])){
		foreach ($adq_params["ADQ_PARAMS"] as $k => $v){
			$params[] = urlencode($k) . "=" . urlencode($v);
		}
	}
	foreach ($_SERVER as $k => $v) {
		if ((substr($k, 0, 4) == "HTTP") ||(substr($k, 0, 3) == "REQ"))  {
			$params[] = $k . "=" . urlencode($v);
		}
	}
	$post = implode("&", $params);
	$request = curl_init();
	$request_timeout = 6; // 10 seconds timeout
	$adq_url = "http://ads.adiquity.com/mads";
	curl_setopt($request, CURLOPT_URL, $adq_url);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($request, CURLOPT_TIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close", "adqkns2s-14em1p99-tbv6t"));
	curl_setopt($request, CURLOPT_POSTFIELDS, $post);

	$contents = curl_exec($request);
	if (curl_getinfo($request,CURLINFO_HTTP_CODE) == 200)
	{
		if ($contents === true || $contents === false)
			$contents = "";
			echo $contents;
	}
	curl_close($request);
	
?></div>
<div class="tCenter">
<?/*
## WapDollar.In Php Ad Code
## Version: v1.4
## Updated: 02/01/2013 
## Creater: Suraj Kumar
*/


//Do not change anything in this code if you will change without any given instruction then your account may be blocked.
//Use this code in only non adult site or non adult toplist else your account will be blocked


    $keyname_ip_arr = array('HTTP_X_FORWARDED_FOR', 'HTTP_REMOTE_ADDR_REAL', 'HTTP_CLIENT_IP', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'); 
    foreach ($keyname_ip_arr as $keyname_ip) { 
        if (!empty($_SERVER[$keyname_ip])) { 
            $ip = $_SERVER[$keyname_ip]; 
            break; 
        } 
    } 
    if (strstr($ip, ',')) {
        $ips = explode(',', $ip);
         if(substr($ips[0], 1, 3)=='10.'&&strlen($ips[1])>5)
            $ip = trim($ips[1]);
        else $ip = trim($ips[0]);
    } 
    if(!preg_match("^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}^", $ip)) $ip = $_SERVER["REMOTE_ADDR"]; 
  

 
  $keyname_ua_arr = array('HTTP_X_DEVICE_USER_AGENT', 'HTTP_X_OPERAMINI_PHONE_UA', 'HTTP_X_BOLT_PHONE_UA', 'HTTP_X_MOBILE_UA', 'HTTP_USER_AGENT');
foreach ($keyname_ua_arr as $keyname_ua) {
  if (isset($_SERVER[$keyname_ua]) && !empty($_SERVER[$keyname_ua])) {
    $ua = rawurlencode($_SERVER[$keyname_ua]);
  
  }
}

     

$sua = rawurlencode($_SERVER['HTTP_USER_AGENT']);
$site=rawurlencode("http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
$adult="no";
$freead="yes";  // change it to "no" if you don't want to show free ads in your site
$key="Zv2DW8zHGP";
$url='http://ad.wapdollar.in/phpwap.php?ip='.$ip.'&key='.$key.'&uag='.$ua.'&site='.$site.'&adult='.$adult.'&sua='.$sua.'&freead='.$freead.'';

$ch = curl_init();
$request_timeout = 5; // 5 seconds timeout
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($ch);
$getserver= curl_getinfo($ch);
curl_close($ch);
 if($getserver["http_code"]==200){


         echo  $page; //showing ads

    }
  
?>
</div>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› Please Read The Disclaimer Before Download Anything From MirchiLoft.Com</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› This is a promotional WAPSITE only, All files placed here are for introducing purpose only.</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› Please, buy original Video Songs/contents from author or developer site!</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› If you do not agree to all the terms, please disconnect from this site now itself.</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› By remaining at this site, you affirm your understanding and compliance of the above disclaimer and absolve this site of any responsibility henceforth</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› All files found on this site have been collected from various sources across the web and are believed to be in the "public domain".</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› All the logos and stuff are the property of their respective owners</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› If you are the rightful owner of any contents posted here, and object to them being displayed or If you are one of representativities of copy rights department and you dont like our conditions of store, Please Contact Us We will remove it in 24 hour!</b></div><br/>
<div  style ="border-bottom:1px dashed rgb(187, 187, 187)"><b>› Downloading at your own risk!!! </b></div><br/>
<div class="tCenter">

<?php
    /**************************************************************************
     *  Adiquity Ad Code - Adiquity.com
     *  Copyright Guruji.com Software Pvt Ltd . All rights reserved. 
     *	Language: PHP (Curl)
     *	Version: 18072011
     **************************************************************************/

	$adq_params = array(
			"ADQ_PARAMS"  => array(
					"pazid"=>"adqnhqh3-14z11lmp-u67d6",//PAZID		
					"adbgcolor"=>"FFFFFF", //Ad Unit Background color
					"adtcolor"=>"0063DC",  //Ad Unit Text color
					  )
			);

	/////////////////////////////////
	// Do not edit below this line //
	/////////////////////////////////

	$params = array();
	$params = array(
			"ua=" . urlencode($_SERVER["HTTP_USER_AGENT"]),
			"TIP=". urlencode($_SERVER["REMOTE_ADDR"]),
			"aclang=". "php",
			"acver=". "18072011" ,
			"cat"=>"s1,en"
			);
	if (!empty($adq_params["ADQ_PARAMS"])){
		foreach ($adq_params["ADQ_PARAMS"] as $k => $v){
			$params[] = urlencode($k) . "=" . urlencode($v);
		}
	}
	foreach ($_SERVER as $k => $v) {
		if ((substr($k, 0, 4) == "HTTP") ||(substr($k, 0, 3) == "REQ"))  {
			$params[] = $k . "=" . urlencode($v);
		}
	}
	$post = implode("&", $params);
	$request = curl_init();
	$request_timeout = 6; // 10 seconds timeout
	$adq_url = "http://ads.adiquity.com/mads";
	curl_setopt($request, CURLOPT_URL, $adq_url);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($request, CURLOPT_TIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close", "adqkns2s-14em1p99-tbv6t"));
	curl_setopt($request, CURLOPT_POSTFIELDS, $post);

	$contents = curl_exec($request);
	if (curl_getinfo($request,CURLINFO_HTTP_CODE) == 200)
	{
		if ($contents === true || $contents === false)
			$contents = "";
			echo $contents;
	}
	curl_close($request);
	
?><?php
    /**************************************************************************
     *  Adiquity Ad Code - Adiquity.com
     *  Copyright Guruji.com Software Pvt Ltd . All rights reserved. 
     *	Language: PHP (Curl)
     *	Version: 18072011
     **************************************************************************/

	$adq_params = array(
			"ADQ_PARAMS"  => array(
					"pazid"=>"adqnhqh3-14z11lmp-u67d6",//PAZID		
					"adbgcolor"=>"FFFFFF", //Ad Unit Background color
					"adtcolor"=>"0063DC",  //Ad Unit Text color
					  )
			);

	/////////////////////////////////
	// Do not edit below this line //
	/////////////////////////////////

	$params = array();
	$params = array(
			"ua=" . urlencode($_SERVER["HTTP_USER_AGENT"]),
			"TIP=". urlencode($_SERVER["REMOTE_ADDR"]),
			"aclang=". "php",
			"acver=". "18072011" ,
			"cat"=>"s1,en"
			);
	if (!empty($adq_params["ADQ_PARAMS"])){
		foreach ($adq_params["ADQ_PARAMS"] as $k => $v){
			$params[] = urlencode($k) . "=" . urlencode($v);
		}
	}
	foreach ($_SERVER as $k => $v) {
		if ((substr($k, 0, 4) == "HTTP") ||(substr($k, 0, 3) == "REQ"))  {
			$params[] = $k . "=" . urlencode($v);
		}
	}
	$post = implode("&", $params);
	$request = curl_init();
	$request_timeout = 6; // 10 seconds timeout
	$adq_url = "http://ads.adiquity.com/mads";
	curl_setopt($request, CURLOPT_URL, $adq_url);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($request, CURLOPT_TIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_CONNECTTIMEOUT, $request_timeout);
	curl_setopt($request, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded", "Connection: Close", "adqkns2s-14em1p99-tbv6t"));
	curl_setopt($request, CURLOPT_POSTFIELDS, $post);

	$contents = curl_exec($request);
	if (curl_getinfo($request,CURLINFO_HTTP_CODE) == 200)
	{
		if ($contents === true || $contents === false)
			$contents = "";
			echo $contents;
	}
	curl_close($request);
	
?></div>
<div class="tCenter">
<?/*
## WapDollar.In Php Ad Code
## Version: v1.4
## Updated: 02/01/2013 
## Creater: Suraj Kumar
*/


//Do not change anything in this code if you will change without any given instruction then your account may be blocked.
//Use this code in only non adult site or non adult toplist else your account will be blocked


    $keyname_ip_arr = array('HTTP_X_FORWARDED_FOR', 'HTTP_REMOTE_ADDR_REAL', 'HTTP_CLIENT_IP', 'HTTP_X_REAL_IP', 'REMOTE_ADDR'); 
    foreach ($keyname_ip_arr as $keyname_ip) { 
        if (!empty($_SERVER[$keyname_ip])) { 
            $ip = $_SERVER[$keyname_ip]; 
            break; 
        } 
    } 
    if (strstr($ip, ',')) {
        $ips = explode(',', $ip);
         if(substr($ips[0], 1, 3)=='10.'&&strlen($ips[1])>5)
            $ip = trim($ips[1]);
        else $ip = trim($ips[0]);
    } 
    if(!preg_match("^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}^", $ip)) $ip = $_SERVER["REMOTE_ADDR"]; 
  

 
  $keyname_ua_arr = array('HTTP_X_DEVICE_USER_AGENT', 'HTTP_X_OPERAMINI_PHONE_UA', 'HTTP_X_BOLT_PHONE_UA', 'HTTP_X_MOBILE_UA', 'HTTP_USER_AGENT');
foreach ($keyname_ua_arr as $keyname_ua) {
  if (isset($_SERVER[$keyname_ua]) && !empty($_SERVER[$keyname_ua])) {
    $ua = rawurlencode($_SERVER[$keyname_ua]);
  
  }
}

     

$sua = rawurlencode($_SERVER['HTTP_USER_AGENT']);
$site=rawurlencode("http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
$adult="no";
$freead="yes";  // change it to "no" if you don't want to show free ads in your site
$key="Zv2DW8zHGP";
$url='http://ad.wapdollar.in/phpwap.php?ip='.$ip.'&key='.$key.'&uag='.$ua.'&site='.$site.'&adult='.$adult.'&sua='.$sua.'&freead='.$freead.'';

$ch = curl_init();
$request_timeout = 5; // 5 seconds timeout
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, $request_timeout);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $request_timeout);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$page = curl_exec($ch);
$getserver= curl_getinfo($ch);
curl_close($ch);
 if($getserver["http_code"]==200){


         echo  $page; //showing ads

    }
  
?>
</div>