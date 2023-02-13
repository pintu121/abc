<?php

$W = intval($_GET['w']);
$H = intval($_GET['h']);
$pic = ''.htmlspecialchars(($_GET['file'])).''; 

$mov = new ffmpeg_movie($pic, false);
$wn = $mov->GetFrameWidth();
$hn = $mov->GetFrameHeight();
if(isset($_GET['info'])){
echo '<br />getDuration			'.$mov->getDuration();
echo '<br />getFrameCount		'.$mov->getFrameCount();
echo '<br />getFrameRate		'.$mov->getFrameRate();
echo '<br />getVideoBitRate	'.$mov->getVideoBitRate();
echo '<br />getDuration			'.$mov->getDuration();
}

$frame = $mov->getFrame($_GET['frame']?$_GET['frame']:10);

$gd = $frame->toGDImage();

if(!$W and !$H){
$a = "55*60";
$size = explode('*',$a);
$W = round(intval($size[0])); 
$H = round(intval($size[1])); 
}


$new = imageCreateTrueColor($W, $H);
imageCopyResampled($new, $gd, 0, 0, 0, 0, $W, $H, $wn, $hn);
header ("Content-type: image/gif");
imageGif($new);

//header('Location: '.$location, true, 301);
?>