<div class="devider"> </div>
<div class="tCenter ">
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
  
?></div>



<div class="tCenter ">
<?php
// AdzMedia Publisher Install Code
// Language: PHP (curl)
// Version: 2.0
// Copyright AdzMedia Pvt Ltd, All rights reserved

		$adzone = 5491;
	 
	 	$adzmedia_url  = 'http://rtb.adzmedia.com/api?';
	 	
		 $adzmsite = array('adzone'=>$adzone);
	 
	 	if(isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI']))
	 	{
	 		$adzmsite['rqpage']  = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	 	}
	 	if(isset($_SERVER['HTTP_REFERER']))
	 	{
	 		$adzmsite['ref'] =  $_SERVER['HTTP_REFERER'];
	 	}
	 	
	 	$adzmdevice = array('ip' => $_SERVER['REMOTE_ADDR'],'ua'=>$_SERVER['HTTP_USER_AGENT']);
	 	
	 	$adzmedia_headers = array();
	 	$headerprefix = 'ADZ-';
		foreach ($_SERVER as $adz_name => $adz_value)
		{
    		$adzmedia_headers[$headerprefix.$adz_name] = $adz_value;
   		}	
   		$content_type=array("Content-Type: application/json");
   	    
   	    $adzmsite['headers'] = $adzmedia_headers;

   		$adzmobj = json_encode(array('site' => $adzmsite,'device'=>$adzmdevice)); 	

	 	$adzmrequest = curl_init();
		$request_timeout = 5; 
		curl_setopt($adzmrequest, CURLOPT_URL, $adzmedia_url);
		curl_setopt($adzmrequest, CURLOPT_USERAGENT, $adzmdevice['ua']);
		curl_setopt($adzmrequest, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($adzmrequest, CURLOPT_HTTPHEADER, $content_type);
		curl_setopt($adzmrequest, CURLOPT_POST, 1);
		curl_setopt($adzmrequest, CURLOPT_TIMEOUT, $request_timeout);
		curl_setopt($adzmrequest, CURLOPT_CONNECTTIMEOUT, $request_timeout);
		curl_setopt($adzmrequest, CURLOPT_POSTFIELDS,$adzmobj);

		$adzmcontents = curl_exec($adzmrequest);
		if (curl_getinfo($adzmrequest,CURLINFO_HTTP_CODE) == 200)
		{
			echo $adzmcontents;
		}
		
		curl_close($adzmrequest);
?>

</div>