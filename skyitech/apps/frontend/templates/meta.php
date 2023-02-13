///////////////////////////         layout     //////////////////////
	<?if($sf_params->get('module').$sf_params->get('action')=='fileslist'){?>
	<?php if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'): ?>
<B>TAG:-</B>
<?php echo $catName;?> marathi movie songs download, <?php echo $catName;?> Marathi Movie mp3, <?php echo $catName;?> dJ mix songs, <?php echo $catName;?> Marathi Songs, <?php echo $catName;?> mp3 songs free download, <?php echo $catName;?> video songs, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Song Free Download, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Full Video Song HD MP4 - 3GP Download
<?php endif; ?>

	<?php if($files->extension=='AVI' || $files->extension=='3GP' || $files->extension=='MP4'): ?>
<B>TAG:-</B>
<?php echo $catName;?> download Videos, <?php echo $catName;?> 3gp,avi,mp4 videos download, <?php echo $catName;?> high quality videos, <?php echo $catName;?> hd mp4 videos, <?php echo $catName;?> free download videos, <?php echo $catName;?>free video songs, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> videos Free Download, <?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?> Full Video Song HD MP4 - 3GP Download
<?php endif; ?>    <?php } ?>

////////////  Head   ///////////
<?if($sf_params->get('module').$sf_params->get('action')=='categorylist'){?>
<meta name="description" content="<? include(success_dir.'meta-cat.php');?>" /> <?}?>
 <?php if($sf_params->get('module').$sf_params->get('action')=='filesshow'){
if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'){?>
<meta name="description" content="<? include(success_dir.'meta-file.php');?>" /> <?}
if($files->extension=='MP4' || $files->extension=='3GP' || $files->extension=='AVI'){?>
<meta name="description" content="<? include(success_dir.'meta-file1.php');?>" /> <?} }?>

 //////////////////////////////////////// Download  ///////////////////////////////////////
	<?php if($files->extension=='MP3' || $files->extension=='WAV' || $files->extension=='MID'): ?>
 <div style="padding:10px; background:#CCCCCC; -moz-border-radius: 11px 11px 0 0;-webkit-border-radius: 11px 11px 0 0;border-radius: 11px 11px 0 0;-moz-box-shadow:0 -4px 12px #666;-webkit-box-shadow:0 -4px 12px #666;box-shadow:0 -4px 12px #666; font-size:small;">
<b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> marathi movie songs download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> Marathi Movie mp3, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> dJ mix songs, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> Marathi Songs, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> mp3 songs free download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> video songs, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> Song Free Download, <b><?php echo ''. str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b> Full Video Song HD MP4 - 3GP Download
</div>
<?php endif;?>


	<?php if($files->extension=='AVI' || $files->extension=='3GP' || $files->extension=='MP4'): ?>
<div style="padding:10px; background:#CCCCCC; -moz-border-radius: 11px 11px 0 0;-webkit-border-radius: 11px 11px 0 0;border-radius: 11px 11px 0 0;-moz-box-shadow:0 -4px 12px #666;-webkit-box-shadow:0 -4px 12px #666;box-shadow:0 -4px 12px #666; font-size:small;"><B>TAG</B>:-
<b><?php $files->file_name= str_replace(sfConfig::get('app_filename2hide'),'', $files->file_name); ?></b>
<b><?=$files->file_name;?></b> download Videos, <b><?=$files->file_name;?></b> 3gp,avi,mp4 videos download, <b><?=$files->file_name;?></b> high quality videos, <b><?=$files->file_name;?></b> hd mp4 videos, <b><?=$files->file_name;?></b> free download videos, <b><?=$files->file_name;?></b> free video songs, <b><?=$files->file_name;?></b> videos Free Download, <b><?=$files->file_name;?></b> Full Video Song HD MP4 - 3GP Download
</div>
<?php endif; ?>