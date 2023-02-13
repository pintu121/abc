<div id="cateogry">
	<h2>Your Search Result for Album/Movie</h2>
	<div class="dtype">
	<?php
		$find = $ext = $sort = '';
		if($sf_params->get('find'))	$find = '&find='.$sf_params->get('find');
		if($sf_params->get('ext'))	$ext = '&ext='.$sf_params->get('ext');

		echo 'Sort By: ';
		if($sf_params->get('sort')=='default' || $sf_params->get('sort')=='new2old')
			echo link_to('A to Z','category/search?sort=a2z'.$find);
		else
			echo link_to('New 2 Old','category/search?sort=new2old'.$find);
	?></div>
	<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listStart.php'); ?>

<?php  myUser::getc('RmlsZSBMaXN0',1); ?>
	<div class="catList">
		<?php foreach($categories as $value):?>
		<div class="catRow">
			<?php
				if($value->child=='D'):
					echo '<a href="'.url_for('/category/list/?parent='.$value->id.'&fname='.myUser::slugify($value->category_name)).'"><div>';
					echo $value->category_name.' '.($value->files?'['.$value->files.']':'');
				elseif($value->child=='U'):
					echo '<a href="'.$value->url.'"><div>';
					echo $value->category_name;
				else:
					echo '<a href="'.url_for('/files/list/?parent='.$value->id.'&fname='.myUser::slugify($value->category_name)).'"><div>';
					echo $value->category_name.' '.($value->files?'['.$value->files.']':'');
				endif;
			?>
			<?php
				if($value->flag_new)
					echo image_tag('new.gif');
				if($value->flag_updated)
					echo image_tag('updated.gif');
				if($value->flag_hot)
					echo image_tag('hot.gif');
			?></div></a>
		</div>
		<?php endforeach;?>
	</div>
<?php  myUser::getc('RmlsZSBMaXN0IENvbXBsZXRl',1); ?>

<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_listEnd.php'); ?>
</div>
	<?php
		$find = $sort = '';
		if($sf_params->get('find'))	$find = 'find='.$sf_params->get('find');
		if($sf_params->get('sort'))	$sort = '&sort='.$sf_params->get('sort');
		$pageNum = myUser::skyPageNavigate($totalRecords,$page,SETTING_CATEGORY_PER_PAGE,'category/search?'.$find.$sort.'&page=');
		{
	?>
		<div class="pgn">
			<?php
				myUser::getc('UGFnaW5hdGlvbg==',1);
				echo $pageNum;
				echo form_tag('category/search','method=get');
				echo input_hidden_tag('find',base64_decode($sf_params->get('find')));
				echo input_hidden_tag('sort',$sf_params->get('sort'));
				echo 'Jump to Page '.input_tag('page','','size=3');
				echo submit_tag('Go&raquo;','');
				echo '</form>';
			?>
		</div>
	<?php } ?>
<?php include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_allPageBottom.php'); ?>
