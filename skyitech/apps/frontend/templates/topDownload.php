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
	<div class="fl">		<?php 		echo '<a class="fileName" href="'.url_for('@filesShow?id='.$files->id.'&name='.myUser::slugify($catName.'-'.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide'))))).'">';		echo '<div><div>';		$thumbServer = 'sft'.ceil($files->id/500);		if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->id.'.jpg'))	  		echo image_tag($tDomain.'/'.$thumbServer.'/small_'.$files->id.'.jpg',array());	  	elseif(is_file(sfConfig::get('sf_upload_dir').'/thumb/c/'.$files->category_id.'_1.jpg'))	  		echo image_tag($tDomain.'/c/'.$files->category_id.'_1.jpg','');	  	else	  		echo image_tag('filetype/'.$files->extension.'.gif','');		echo '</div><div>';       echo str_replace($filename2hide,'',str_replace('_',' ',$files->file_name));			echo '<br/>';			echo '<span><b> Hits: '.$files->download.'</b></span>';			echo '<font color="#3366ff"> - </font>';			echo "<span><b>Size: ".myClass::formatsize($files->size)."</b></span>";			echo '<br/></div></div></a>';		?>  </div>
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