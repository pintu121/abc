<?php
$tDomain = SETTING_THUMB_DOMAIN;
?>
<?php myUser::getc('RmlsZSBMaXN0',1); ?>
<table cellspacing="0">
<tbody>
<?php
	$class = 'odd';
	$cnt=0;
	$filename2hide = sfConfig::get('app_filename2hide');
	$adAfterFiles = (SETTING_ADVT_AFTER_EACH_FILES ? SETTING_ADVT_AFTER_EACH_FILES : 3);
	foreach($filess as $files):
		$class = myClass::getOddEven($class);
		$cnt++;
	?>
	<tr class="fl <?php echo $class?>">
		<?php 
		$thumbServer = 'sft'.ceil($files->id/500);
		echo '<td class="tblimg">';
		if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->id.'.jpg'))
	  		echo image_tag($tDomain.'/'.$thumbServer.'/small_'.$files->id.'.jpg',array());
	  	elseif(is_file(sfConfig::get('sf_upload_dir').'/thumb/c/'.$files->category_id.'_1.jpg'))
	  		echo image_tag($tDomain.'/c/'.$files->category_id.'_1.jpg','');
	  	else
	  		echo image_tag('filetype/'.$files->extension.'.gif','');
		echo '</td><td>';
    	echo link_to(str_replace($filename2hide,'',str_replace('_',' ',$files->file_name)), '@filesShow?id='.$files->id.'&name='.myUser::slugify($catName.'-'.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide')))), array('class'=>'fileName') );
			echo '<br/>['.myClass::formatsize($files->size).']';
			echo '<br /><span>'.$files->download.' Downloads</span>';
			echo '<br style="clear:both;">';
			echo '</td>';
		?>
  </tr>
  <?php
  if( $cnt % $adAfterFiles == 0): ?>
	<tr class="odd"><td colspan="2"><?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_betweenFile.php'); ?></td></tr>
 <?php endif; ?>
<?php endforeach; ?>
</tbody></table>
<?php  myUser::getc('RmlsZSBMaXN0IENvbXBsZXRl',1); ?>