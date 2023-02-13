<div class="devider">&nbsp;</div>
<div class="tCenter"><h2>
	<?php echo $catName; ?>
</h2></div>
<div class="list">
<?php
	if(is_file(sfConfig::get('sf_upload_dir').'/thumb/c/'.$parent.'_3.jpg'))
		echo '<p class="tCenter showimage">'.image_tag(SETTING_THUMB_DOMAIN.'/c/'.$parent.'_3.jpg',('class=absmiddle')).'</p>';
?>
<?php if($catDescription): ?>
	<div class="description"><?php echo str_replace(chr(13),'<br />',$catDescription); ?></div>
<?php endif; ?>

<?php
/* if files more then 0 */
if(count($filess)>0)
{
?>
<div class="dtype">
	<?php
		$parent = $name = $type = $sort = '';
		$fname = '&fname='.myUser::slugify($catName);
		if($sf_params->get('parent'))	$parent = '&parent='.$sf_params->get('parent');
		if($sf_params->get('name'))	$name = '&name='.$sf_params->get('name');
		if($sf_params->get('type'))	$type = '&type='.$sf_params->get('type');
		echo 'Sort By: ';
		if($sf_params->get('sort')!='new2old')
			echo link_to('New 2 Old','@filesList?sort=new2old'.$parent.$name.$type.$fname);
		if($sf_params->get('sort')!='download')
			echo '&nbsp;|&nbsp;'.link_to('Popular','@filesList?sort=download'.$parent.$name.$type.$fname);
		if($sf_params->get('sort')!='a2z')
			echo '&nbsp;|&nbsp;'.link_to('A to Z','@filesList?sort=a2z'.$parent.$name.$type.$fname);
	?>	
</div>
<?php
//if(mysql_num_rows($filess)>3)
include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listStart.php');
?>
<?php include('files_list.php') ?>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listEnd.php'); ?>
	<?php
		if($sf_params->get('sort'))	$sort = '&sort='.$sf_params->get('sort');
		$pageNum = myUser::skyPageNavigate($totalRecords,$page,SETTING_FILES_PER_PAGE, '@filesList?'.$parent.$name.$fname.$type.$sort.'&page=');
		if($pageNum)
		{
	?>
		<div class="pgn">
			<?php
				myUser::getc('1ff3f2c3c561d524136e59c21cb4fc4f==',1);
				echo $pageNum;
				echo form_tag('files/list','method=get');
				echo input_hidden_tag('parent',$sf_params->get('parent'));
				echo input_hidden_tag('name',$sf_params->get('name'));
				echo input_hidden_tag('fname',$sf_params->get('fname'));
				echo input_hidden_tag('type',$sf_params->get('type'));
				echo input_hidden_tag('sort',$sf_params->get('sort'));
				echo 'Jump to Page '.input_tag('page','','size=3');
				echo submit_tag('Go&raquo;','');
				echo '</form>';
			?>
		</div>
	<?php } ?>
<?php
} /* if files more then 0 */
?>
</div>

<div class="path"><?php 
	echo link_to('Home',sfConfig::get('app_webpath')).' &raquo; ';
	echo $categoryPath;
	echo link_to($catName,'@filesList?parent='.$sf_params->get('parent').'&fname='.myUser::slugify($catName));
?>
</div>

                            
                            