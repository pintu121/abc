<?php
$tDomain = SETTING_THUMB_DOMAIN;
?>
<?php myUser::getc('RmlsZSBMaXN0',1); ?>
<div class="catList">
<?php
	$class = 'even';
	$cnt=0;
	$filename2hide = sfConfig::get('app_filename2hide');
	$adAfterFiles = (SETTING_ADVT_AFTER_EACH_FILES ? SETTING_ADVT_AFTER_EACH_FILES : 3);
	foreach($filess as $files):
		$class = myClass::getOddEven($class);
		$cnt++;
	?>
		<div class="fl">
		<?php 
		echo '<a class="fileName" href="'.url_for('@filesShow?id='.$files->id.'&name='.myUser::slugify($catName.'-'.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide'))))).'">';
		echo '<div><div>';
		$thumbServer = 'sft'.ceil($files->id/500);
		if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->id.'.jpg'))
	  		echo image_tag($tDomain.'/'.$thumbServer.'/small_'.$files->id.'.jpg',array());
	  	elseif(is_file(sfConfig::get('sf_upload_dir').'/thumb/c/'.$files->category_id.'_1.jpg'))
	  		echo image_tag($tDomain.'/c/'.$files->category_id.'_1.jpg','');
	  	else
	  		echo image_tag('filetype/'.$files->extension.'.gif','');
		echo '</div><div>';
       echo str_replace($filename2hide,'',str_replace('_',' ',$files->file_name));
			echo '<br/>';
			echo '<span><b> Hits: '.$files->download.'</b></span>';
			echo '<font color="#3366ff"> - </font>';
			echo "<span><b>Size: ".myClass::formatsize($files->size)."</b></span>";
			echo '<br/></div></div></a>';
		?>
  </div>
  <?php
  if( $cnt % $adAfterFiles == 0): ?>
	<tr class="odd"><td colspan="2"><?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_betweenFile.php'); ?></td></tr>
 <?php endif; ?>
<?php endforeach; ?>
</div>
<?php  myUser::getc('RmlsZSBMaXN0IENvbXBsZXRl',1); ?>