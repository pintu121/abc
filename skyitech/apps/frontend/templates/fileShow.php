<?php
$tDomain = SETTING_THUMB_DOMAIN;
?>
<div class="devider">&nbsp;</div>
<div class="tCenter"><h2>
	<?php echo 'Free Download '. str_replace(sfConfig::get('app_filename2hide'),'', str_replace('_',' ',$files->file_name)); ?>
</h2></div>
<div class="fshow">
<?php 
	$thumbServer = 'sft'.ceil($files->id/500);
	if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/thumb_'.$files->id.'.jpg'))
		echo '<div class="tCenter">'.image_tag($tDomain.'/'.$thumbServer.'/thumb_'.$files->id.'.jpg',array()).'</div>';
?>
<?php if($files->description): ?>
	<div class="filedescription"><?php echo str_replace(chr(13),'<br />',$files->description); ?></div>
	<div class="devider">&nbsp;</div>
<?php endif; ?>
<?php myUser::getc('RG93bmxvYWQgTGluaw==',1);?>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_downloadPageTop.php'); ?>
<div class="fd tCenter">
<?php $dataServer = 'ds'.ceil($files->id/500); ?>
	<?php if($files->extension=='JPG' || $files->extension=='PNG'): ?>
		<div class="downLink">Select Your Screen Size:<br />
		<?php 
		echo link_to('<b>128x128</b>','files/download?id='.$files->id.'&size=128x128',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>128x160</b>','files/download?id='.$files->id.'&size=128x160',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>176x220</b>','files/download?id='.$files->id.'&size=176x220',array('class'=>'dwnLink','rel'=>'nofollow')).',<br/>';
		echo link_to('<b>220x176</b>','files/download?id='.$files->id.'&size=220x176',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>240x320</b>','files/download?id='.$files->id.'&size=240x320',array('class'=>'dwnLink','rel'=>'nofollow')).',<br/>';
		echo link_to('<b>320x240</b>','files/download?id='.$files->id.'&size=320x240',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>320x480</b>','files/download?id='.$files->id.'&size=320x480',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>360x640</b>','files/download?id='.$files->id.'&size=360x640',array('class'=>'dwnLink','rel'=>'nofollow')).',<br/>';
		echo link_to('<b>480x640</b>','files/download?id='.$files->id.'&size=480x640',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		echo link_to('<b>640x480</b>','files/download?id='.$files->id.'&size=640x480',array('class'=>'dwnLink','rel'=>'nofollow')).',';
		?>
		</div>
		<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_afterDownload.php'); ?>
	<?php else: ?>
		<?php 
		if(USERDEVICE=='a')
			echo '<div class="downLink">'.link_to(image_tag('download.png','alt=Download'),'files/download?id='.$files->id,array('class'=>'dwnLink','rel'=>'nofollow')).'</div>';
		else
			echo '<div class="downLink"><b>Download</b> : '.link_to('<b>'.str_replace(sfConfig::get('app_filename2hide'),'', str_replace('_',' ',$files->file_name)).'</b>','files/download?id='.$files->id,array('class'=>'dwnLink','rel'=>'nofollow')).'</div>';
		?>
		
		<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_afterDownload.php'); ?>
		<div class="devider">&nbsp;</div>
		<?php echo '<div>Size of file:&nbsp;<span class="bld">('.myClass::formatSize($files->size).')</span></div>'; ?>
	<?php endif; ?>
		<div class="devider">&nbsp;</div>
	<?php echo '<div>Hits:&nbsp;<span class="bld"><b>'.$files->download.' Times</b></span></div>'; ?>
    
	<div class="devider">&nbsp;</div>
	<?php echo '<div>Category:&nbsp;<span class="bld"><b>'.$catName.'</b></span></div>'; ?>

</div>
</div>

<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_RelatedItemsBefore.php'); ?>

<div class="randomFile">
<h3>Related Files</h3>
<table cellspacing="0">
<?php
$sql = "select id,file_name,category_id,extension,size,download from files where category_id=".$files->category_id.' order by rand() limit 3';
$randomfiles = skyMysqlQuery($sql);
while($file = mysql_fetch_object($randomfiles))
{
	?>
	<div align="left" class="fl odd">
		<?php 
		
		echo '<a class="fileName" href="'.url_for('@filesShow?id='.$file->id.'&name='.myUser::slugify($catName.'-'.substr($file->file_name,0,strpos($file->file_name,sfConfig::get('app_filename2hide'))))).'">';
echo '<div><div>';

$thumbServer = 'sft'.ceil($file->id/500);
		
  	if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$file->id.'.jpg'))
			echo image_tag(SETTING_THUMB_DOMAIN.'/'.$thumbServer.'/small_'.$file->id.'.jpg','');
  	else
  		echo image_tag('filetype/'.$file->extension.'.gif','');
                echo '</div><div>';
		echo str_replace(sfConfig::get('app_filename2hide'),'',$file->file_name);
echo '<br/>';
		 echo '<span><b> Hits: '.$file->download.'</b></span>';
echo '<font color="#3366ff"> - </font>';
		 echo "<span><b>Size: ".myClass::formatsize($file->size)."</b></span>";

                 echo '<br/></div></div></div></a>';
		
		
		?>
<?php
}
?>
</table>
</div>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_RelatedItemsBefore.php'); ?>
	<?php if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'): ?>
 <div style="padding:10px; background:#CCCCCC; -moz-border-radius: 11px 11px 0 0;-webkit-border-radius: 11px 11px 0 0;border-radius: 11px 11px 0 0;-moz-box-shadow:0 -4px 12px #666;-webkit-box-shadow:0 -4px 12px #666;box-shadow:0 -4px 12px #666; font-size:small;">
<b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> free download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> download in high Quality, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> Mymp3song dJ mix songs, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> download 320kbps quality, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> song download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b>video song download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> hd video download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> All Mp3 Song Download
</div>
<?php endif;?>


	<?php if($files->extension=='AVI' || $files->extension=='3GP' || $files->extension=='MP4'): ?>
<div style="padding:10px; background:#CCCCCC; -moz-border-radius: 11px 11px 0 0;-webkit-border-radius: 11px 11px 0 0;border-radius: 11px 11px 0 0;-moz-box-shadow:0 -4px 12px #666;-webkit-box-shadow:0 -4px 12px #666;box-shadow:0 -4px 12px #666; font-size:small;"><B>TAG</B>:-
<b><?php $files->file_name= str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b>
<b><?=$files->file_name;?></b>Freshmaza Videos download , <b><?=$files->file_name;?></b> Wapking 3gp,avi,mp4 videos download, <b><?=$files->file_name;?></b> Djmaza high quality videos, <b><?=$files->file_name;?></b> Songspk hd mp4 videos, <b><?=$files->file_name;?></b> Videoming free download videos, <b><?=$files->file_name;?></b> free video songs, <b><?=$files->file_name;?></b> videos Free Download, <b><?=$files->file_name;?></b> Full Video Song HD MP4 - 3GP Download
</div>
<?php endif; ?>
<div align="left" class="ad1"><?php 
	if(isset($_SERVER['HTTP_REFERER']) && strstr($_SERVER['HTTP_REFERER'],strtolower(sfConfig::get('app_sitename'))))
		echo '&laquo; '.link_to('Go Back',$_SERVER['HTTP_REFERER']).'<br />';
	echo link_to('Home',sfConfig::get('app_webpath')).' &raquo; ';
	echo $categoryPath;
	echo link_to($catName,'@filesList?parent='.$files->category_id.'&fname='.myUser::slugify($catName));
?>
</div>
<div class="devider">&nbsp;</div>