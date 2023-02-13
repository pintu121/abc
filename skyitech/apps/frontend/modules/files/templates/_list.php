<?php myUser::getc('RmlsZSBMaXN0',1); ?>
<table cellspacing="0">
<tbody>
<?php
	$class = 'even';
	$cnt=0;
	$filename2hide = sfConfig::get('app_filename2hide');
	$adAfterFiles = (SETTING_ADVT_AFTER_EACH_FILES ? SETTING_ADVT_AFTER_EACH_FILES : 3);
	while($files = mysql_fetch_object($filess)):
		$class = myClass::getOddEven($class);
		$cnt++;
	?>
	<tr class="<?php echo $class?>">
		<?php if($thumbOnOff=='show'): ?>
			<td class="tblimg"><?php 
			$thumbServer = 'ts'.ceil($files->id/500);
	  	if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/mid_'.$files->id.'.jpg'))
	  		echo image_tag(sfConfig::get('app_thumbdomain').'/'.$thumbServer.'/mid_'.$files->id.'.jpg',array());
	  	else
	  		echo image_tag('/images/nopreview.gif',array('width'=>'50', 'height'=>'50'))
			?></td>
		<?php endif; ?>
		<td>
    	<?php echo link_to(str_replace($filename2hide,'',$files->file_name),'@filesShow?id='.$files->id.'&name='.myUser::slugify(substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide')))), array('class'=>'fileName')) ?>
			<br />
			<?php if(!in_array($files->extension,array('JPG','GIF','PNG'))): ?>
			[<?php echo myClass::formatsize($files->size) ?>]<br />
			<?php endif; ?>
			<?php if($sf_params->get('action')=='lastadded')
							echo myClass::TimeAgo(strtotime($files->created_at));
			?>
    </td>
  </tr>
  <?php if( $cnt % $adAfterFiles == 0): ?>
	<tr class="odd"><td colspan="2"><?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listBetween.php'); ?></td></tr>
  <?php endif; ?>
<?php endwhile; ?>
</tbody>
</table>
<?php  myUser::getc('RmlsZSBMaXN0IENvbXBsZXRl',1); ?>