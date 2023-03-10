<?php
// auto-generated by sfPropelCrud
// date: 2009/08/28 17:35:10
?>
<?php use_helper('Javascript') ?>
<table>
<tr>
	<td width="10%"><h1>Files List</h1></td>
	<td>
<div>
	<?php
		$cid = $extension = $sort = $name = '';
		if($sf_params->get('cid'))	$cid = '&cid='.$sf_params->get('cid');
		if($sf_params->get('name'))	$name = '&name='.$sf_params->get('name');
		if($sf_params->get('extension'))	$extension = '&extension='.$sf_params->get('extension');
		if($sf_params->get('sort'))	$sort = '&sort='.$sf_params->get('sort');
		if($sf_params->get('sort')=='d'):
			echo link_to('sort by New 2 Old','files/list?sort=n'.$cid.$extension).' | ';
			echo link_to('sort by A to Z','files/list?sort=a2z'.$cid.$extension).' | ';
			echo link_to('sort by Z to A','files/list?sort=z2a'.$cid.$extension).' | ';
		elseif($sf_params->get('sort')=='a2z'):
			echo link_to('sort by New 2 Old','files/list?sort=n'.$cid.$extension).' | ';
			echo link_to('sort by Download','files/list?sort=d'.$cid.$extension).' | ';
			echo link_to('sort by Z to A','files/list?sort=z2a'.$cid.$extension).' | ';
		elseif($sf_params->get('sort')=='z2a'):
			echo link_to('sort by New 2 Old','files/list?sort=n'.$cid.$extension).' | ';
			echo link_to('sort by Download','files/list?sort=d'.$cid.$extension).' | ';
			echo link_to('sort by A to Z','files/list?sort=a2z'.$cid.$extension).' | ';
		else:
			echo link_to('sort by Download','files/list?sort=d'.$cid.$extension).' | ';
			echo link_to('sort by A to Z','files/list?sort=a2z'.$cid.$extension).' | ';
			echo link_to('sort by Z to A','files/list?sort=z2a'.$cid.$extension).' | ';
		endif;

		if($sf_params->get('extension'))
			echo link_to('Show all extension','files/list?'.$cid).' | ';
	?>
</div>	</td>
	<td>
		<?php 
		if($sf_params->get('cid'))
			include_partial('global/topAction',array('cid' => $sf_params->get('cid'))); ?>
	</td>
</tr>
</table>

<?php if(isset($parent) && $parent)
	include_partial('global/catpath',array('parents' => $parentCategory,'self'=>true));
?>


<table class="list">
<thead>
<tr>
  <th>Id</th>
  <th colspan=2>File name</th>
  <th>Category</th>
  <th>Size</th>
  <th colspan=2>Download</th>
  <th>Description</th>
  <th>Extension</th>
  <th>Status</th>
  <th width=70>Created at</th>
  <th width=80>Action</th>
</tr>
</thead>
<tbody>
<?php	$categoryNames = array(); ?>
<?php foreach ($filess as $files): ?>
<tr id="tr_<?php echo $files->getId()?>">
    <td><?php echo link_to($files->getId(), 'files/show?id='.$files->getId()) ?></td>
    <td><?php
			$thumbServer = 'sft'.ceil($files->getId()/500);
			$videoExt = array('AVI','3GP','MP4','FLV');
			if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->getId().'.jpg'))
				echo image_tag(sfConfig::get('app_upload_dir_name').'/thumb/'.$thumbServer.'/small_'.$files->getId().'.jpg');
			?></td>
    <td><?php echo link_to($files->getFileName(), 'files/edit?id='.$files->getId()) ?>
    	<?php
				$dataServer = 'sfd'.ceil($files->getId()/500);
			if($files->getExtension()=='URL')
		   		echo '<br />[<a href="'.$files->getUrl().'">'.$files->getUrl().'</a>]';
		   	else
			   	echo '<br /><a href="'.sfConfig::get('app_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$files->getFileName().'">[FL]</a>';
		   	if($files->getExtension()=='JPG')
			   	echo ' - <a target="_blank" href="'.sfConfig::get('app_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$files->getFileName().'">[org FL]</a>';
		    	 //if($files->getExtension()=='MP3'){
    				//	$dataServer = 'ds'.ceil($files->getId()/500);
    				//	echo '<br /><a target="_blank" href="/backend/changeMp3.php?Filename=/uploads/files/'.$dataServer.'/'.$files->getId().'/'.$files->getFileName().'">&laquo;Change tag&raquo;</a>';
    				//}
    	?>
    </td>
    <td>
    	<?php
    		if(isset($parent))
	    		echo link_to($parentCategory->getCategoryName(),'files/list?cid='.$files->getCategoryId().$extension.$sort);
	    	else{
	    		if(!array_key_exists($files->getCategoryId(), $categoryNames))
	    			$categoryNames[$files->getCategoryId()] = CategoryPeer::getCategoryName($files->getCategoryId());
	    		echo link_to($categoryNames[$files->getCategoryId()],'files/list?cid='.$files->getCategoryId().$extension.$sort);
	    	}
    	?></td>
    <td><?php echo myClass::formatsize($files->getSize()) ?></td>
    <td><?php echo $files->getToday() ?></td>
    <td><?php echo $files->getDownload() ?></td>
    <td><?php
    		$description = str_replace(chr(13),'<br />', $files->getDescription() );
    		echo (strlen($description)>100 ? substr($description,0,100).'...' : $description)
    ?></td>
    <td><?php echo link_to($files->getExtension(),'files/list?extension='.$files->getExtension().$cid.$sort); ?></td>
    <td id="active_<?php echo $files->getId(); ?>">
    	<?php
				if($files->getStatus() == 'B'){
					$lnkName = '<span class="red">Block</span>';
					$status = 'B';
				}else{
					$lnkName = 'Active';
					$status = 'A';
				}
				echo link_to_remote($lnkName,	array('update' => 'active_'.$files->getId(),'url' => '/files/activation?id='.$files->getId().'&status='.$status));
				//echo ($files->getStatus()=='A' ? 'Active' : 'Deactive');
    	?>
    </td>
    <td><?php echo date('d-M-y h:i',strtotime($files->getCreatedAt())) ?></td>
   	<td class="action"><?php include_partial('global/myaction',array('id' => $files->getId())); ?>
   		<?php /*
   		echo link_to_remote('delete',array(
						    'update'   => '',
						    'url'      => 'files/delete?id='.$files->getId().'&cid='.$files->getCategoryId(),
						    'confirm'  => 'Are you sure?',
						    'complete' => visual_effect('fade','tr_'.$files->getId()),
						),array('id'=>'delete'.$files->getId()) );
				*/
			?>
   		</td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

	<?php
		$cid = $extension = $sort = $name = '';
		if($sf_params->get('cid'))	$cid = '/cid/'.$sf_params->get('cid');
		if($sf_params->get('extension'))	$extension = '/extension/'.$sf_params->get('extension');
		if($sf_params->get('sort'))	$sort = '/sort/'.$sf_params->get('sort');
		if($sf_params->get('name'))	$name = '/name/'.$sf_params->get('name');
		$pageNum = myUser::pageNavigate($pager,sfConfig::get('app_webpath').'/files/list'.$name.$cid.$extension.$sort.'/page/');
		if($pageNum){
	?>
		<div class="pgn">
			<?php echo $pageNum; ?>
			<?php
				echo form_tag('files/list','METHOD=GET');
				echo input_hidden_tag('cid',$sf_params->get('cid'));
				echo input_hidden_tag('type',$sf_params->get('type'));
				echo input_hidden_tag('extension',$sf_params->get('extension'));
				echo input_hidden_tag('sort',$sf_params->get('sort'));
				echo input_hidden_tag('name',$sf_params->get('name'));
				echo 'Jump to Page '.input_tag('page','','size=3');
				echo submit_tag('Go&raquo;','');
				echo '</form>';
			?>
		</div>
	<?php } ?>

<?php /* echo form_tag('files/urlcatch',array('name'=>'Files', 'enctype'=>'multipart/form-data')) ?>
Current Category: <input type="text" name="cur_category_id" value="<?php echo $sf_params->get('cid');?>" /><br />
Copy From Category: <input type="text" name="from_category_id" value="<?php echo $sf_params->get('cid');?>" /><br />
<?php echo submit_tag('Get Files from URL') ?>
</form>
<br />
<?php echo link_to('Delete All Files','files/deleteallfiles?cid='.$sf_params->get('cid')); ?>
<br />
<?php
echo $fileUrls; */
?>
