<h2>
	<?php echo $catName; ?>
</h2>
<div class="dtype">
	<small>
	<?php
		$find = $ext = $sort = '';
		if($sf_params->get('find'))	$find = '&find='.$sf_params->get('find');
		if($sf_params->get('ext'))	$ext = '&ext='.$sf_params->get('ext');

		echo 'Sort By: ';
		if($sf_params->has('sort') &&  $sf_params->get('sort')!='new2old')
			echo link_to('New 2 Old','files/search?sort=new2old'.$find.$ext).'&nbsp;|&nbsp;';
		if($sf_params->get('sort')!='download')
			echo link_to('Download','files/search?sort=download'.$find.$ext).'&nbsp;|&nbsp;';
		if($sf_params->get('sort')!='a2z')
			echo link_to('A to Z','files/search?sort=a2z'.$find.$ext);
	?>
	</small>
</div>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listStart.php'); ?>

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
    	echo link_to(str_replace($filename2hide,'',str_replace('_',' ',$files->file_name)), '@filesShow?id='.$files->id.'&name='.myUser::slugify($files->category_name.'-'.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide')))), array('class'=>'fileName') );
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
<?php endwhile; ?>
</tbody></table>
<?php  myUser::getc('RmlsZSBMaXN0IENvbXBsZXRl',1); ?>

<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listEnd.php'); ?>
	<?php
		if($sf_params->get('sort'))	$sort = '&sort='.$sf_params->get('sort');
		$pageNum = myUser::skyPageNavigate($totalRecords,$page,SETTING_FILES_PER_PAGE,'files/search?'.$find.$sort.$ext.'&page=');
		if($pageNum){
	?>
		<div class="pgn">
			<?php
				myUser::getc('UGFnaW5hdGlvbg==',1);
				echo $pageNum;
				echo form_tag('files/search','method=get');
				echo input_hidden_tag('find',base64_decode($sf_params->get('find')));
				echo input_hidden_tag('ext',$sf_params->get('ext'));
				echo input_hidden_tag('sort',$sf_params->get('sort'));
				echo 'Jump to Page '.input_tag('page','','size=3');
				echo submit_tag('Go&raquo;','');
				echo '</form>';
			?>
		</div>
	<?php } ?>
<div class="path"><b><?php 
	echo link_to('Home',sfConfig::get('app_webpath')).' &raquo; ';
?></b>
</div>