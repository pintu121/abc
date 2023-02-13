<?php
$tDomain = SETTING_THUMB_DOMAIN;
?>
<?php if($sf_params->get('type')): ?>
<h2>
	<?php
		if($sf_params->get('type')=='today' ||  $sf_params->get('type')=='yesterday')
			echo $sf_params->get('type').'\'s Most Popular Downloads';
		if($sf_params->get('type')=='week' ||  $sf_params->get('type')=='month')
			echo 'This '. $sf_params->get('type') . '\'s Most Popular Downloads';
	?>
</h2>
<div class="path">Top 21 Files:
<?php
echo link_to('Today','@topFiles?type=today');
echo ', '.link_to('Yesterday','@topFiles?type=yesterday');
echo ', '.link_to('Week','@topFiles?type=week');
echo ', '.link_to('Month','@topFiles?type=month');
?>
</div>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listStart.php'); ?>
<div class="devider">&nbsp;</div>
<table cellspacing="0">
<tbody>
	<?php
	$filename2hide = sfConfig::get('app_filename2hide');
	$class = 'even';
	foreach($filess as $files):
		$class = myClass::getOddEven($class);
	?>
	<tr class="fl <?php echo $class?>">
		<?php 
			$thumbServer = 'sft'.ceil($files->id/500);

		echo '<td class="tblimg">';
		if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->id.'.jpg'))
	  		echo image_tag(SETTING_THUMB_DOMAIN.'/'.$thumbServer.'/small_'.$files->id.'.jpg',array());
	  	elseif(is_file(sfConfig::get('sf_upload_dir').'/thumb/c/'.$files->category_id.'_1.jpg'))
	  		echo image_tag(SETTING_THUMB_DOMAIN.'/c/'.$files->category_id.'_1.jpg','');
	  	else
	  		echo image_tag('filetype/'.$files->extension.'.gif','');
		echo '</td><td>';
    	echo link_to(str_replace($filename2hide,'',str_replace('_',' ',$files->file_name)), '@filesShow?id='.$files->id.'&name='.myUser::slugify($files->category_name.'-'.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide')))), array('class'=>'fileName') )."<br />";
			echo '['.myClass::formatsize($files->size).']';
			echo '<br/>'.$files->download.' Downloads';
			echo '<br style="clear:both;">';
			echo '</td>';
		?>
  </tr>
<?php
	endforeach;
?>
</tbody></table>
<?php endif; ?>

<div class="path">
Top 21 Files:
<?php
echo link_to('Today','@topFiles?type=today');
echo ', '.link_to('Yesterday','@topFiles?type=yesterday');
echo ', '.link_to('Week','@topFiles?type=week');
echo ', '.link_to('Month','@topFiles?type=month');
?>
</div>
