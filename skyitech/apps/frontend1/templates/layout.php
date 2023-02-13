<?php
if(USERDEVICE=='m'):
?><!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<?php else: ?>
<!DOCTYPE html>
<?php endif; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<meta name="googlebot" content="index, follow">
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/images/favicon.ico" />
<?if($sf_params->get('module').$sf_params->get('action')=='categorylist'){?>
<meta name="Description" content="<? include(success_dir.'meta-cat.php');?>" /> <?}?>
 <?php if($sf_params->get('module').$sf_params->get('action')=='filesshow'){
if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'){?>
<meta name="Description" content="<? include(success_dir.'meta-file.php');?>" /> <?}
if($files->extension=='MP4' || $files->extension=='3GP' || $files->extension=='AVI'){?>
<meta name="Description" content="<? include(success_dir.'meta-file1.php');?>" /> <?} }?>
<meta name='Author ' content='MirchiLoft.CoM'/>
<meta name='Rating' content='Safe For Kids'/>
<meta name="keywords" content="Bollywood music,Bollywood music download,Indian video songs,Music bollywood,Bollywood music videos"/>
<meta name="copyright" content="MirchiLoft.CoM, 2014. All rights Reserved."/>
<meta name="msvalidate.01" content="DF70E4A4FF01B0674D49557D9570D82C" />
<?php if(USERDEVICE=='a'){ ?>
<link href="/css/<?php echo sfConfig::get('app_smallname')?>_m.css?1.1" type="text/css" rel="stylesheet"/>
<?php }else{ ?>
<link href="/css/<?php echo sfConfig::get('app_smallname')?>.css?1.1" type="text/css" rel="stylesheet"/>
<?php } ?>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53705734-1', 'mirchiloft.com');
  ga('send', 'pageview');

</script>
	<?php if(USERDEVICE!='a'){ ?>
	<div class="logo"><a href="/"><img alt="<?php echo sfConfig::get('app_sitename')?>" src="/images/logo_<?php echo USERDEVICE; ?>_<?php echo sfConfig::get('app_smallname')?>.gif" /></a></div>
	<?php } ?>
	<div id="mainDiv">
	<?php
		if($sf_params->get('module')=='default'){
			include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_homeTop.php');
		}
		else
		{
			include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_allPageTop.php');
		}
	?>
	<?php
		if($sf_params->get('module').$sf_params->get('action')=='defaultindex' || $sf_params->get('module').$sf_params->get('action')=='filessearch')
		{
		echo '<div class="search tCenter">';
		echo form_tag('files/search','method=get');
		echo 'Search : '.input_tag('find',($sf_params->get('action')=='search' ? base64_decode($sf_params->get('find')):''),'size=15');
		echo select_tag('ext', options_for_select(myUser::searchExts(), $sf_params->get('ext') ? $sf_params->get('ext') : 'ALL'));
		echo submit_tag('Search','id=file');
		echo '</form>';
		echo '</div>';
		}
	?>
	<?php echo $sf_data->getRaw('sf_content') ?>
	<?php
	if($sf_params->get('module').$sf_params->get('action')=='categorylist')
		include(success_dir.'categoryList.php');
	if($sf_params->get('module').$sf_params->get('action')=='fileslist')
		include(success_dir.'filesList.php');
	if($sf_params->get('module').$sf_params->get('action')=='filesshow')
		include(success_dir.'fileShow.php');
	if($sf_params->get('module').$sf_params->get('action')=='fileslastadded')
		include(success_dir.'lastAdded.php');
	if($sf_params->get('module').$sf_params->get('action')=='filestop')
		include(success_dir.'topDownload.php');
	?>

	<?php
	if($sf_params->get('module')=='default'){
		include_partial('global/updates');
		echo '<div class="top21">';
		echo '<b>Top 21 Downloads:</b><br/>'.link_to('Today','@topFiles?type=today');
		echo ' | '.link_to('Yesterday','@topFiles?type=yesterday');
		echo ' | '.link_to('Week','@topFiles?type=week');
		echo ' | '.link_to('Month','@topFiles?type=month');
		echo '</div>';
		include_partial('global/category');
	}
	/*
	* Close Mysql Connection
	*/
	closeDB();
?>

<?php if($sf_params->get('module')=='default'): ?>
	<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_homeBottom.php'); ?>
<?php else: ?>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_allPageBottom.php'); ?>
<?php endif; ?>

<?if($sf_params->get('module').$sf_params->get('action')=='fileslist'){?>
	<?php if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'): ?>
<B>TAG:-</B>
<?php echo $catName;?>  movie songs download songspk, <?php echo $catName;?>  Movie mp3 djmaza, <?php echo $catName;?> dJ mix songs wapking, <?php echo $catName;?>  Songs mastiway, <?php echo $catName;?> mp3 songs free download, <?php echo $catName;?> video songs freshmaza, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Song Free Download mymp3singer, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Full Video Song HD MP4 - 3GP Download videokng
<?php endif; ?>

	<?php if($files->extension=='AVI' || $files->extension=='3GP' || $files->extension=='MP4'): ?>
<B>TAG:-</B>
<?php echo $catName;?> download Videos freshmaza, <?php echo $catName;?> 3gp,avi,mp4 videos download mirchifun, <?php echo $catName;?> high quality videos djmaza, <?php echo $catName;?> hd mp4 videos songspk, <?php echo $catName;?> free download videos mastipur, <?php echo $catName;?>free video songs wapking, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> videos Free Download videoking, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Full Video Song HD MP4 - 3GP Download mastiway
<?php endif; ?>    <?php } ?>

<div class="ftrLink">
	<a href="http://mirchiloft.com"><?=sfConfig::get('app_sitename')?></a>
</div>
</div>
<?php if($sf_params->get('module')=='default'): ?>
<!-- br /><small>Development Partner: <a href="http://www.skyitech.com" class="siteLink">SKYiTech.com</a></small -->
<?php endif; ?>
</body>
</html>
                            