<?php
// auto-generated by sfPropelCrud
// date: 2009/08/28 17:35:10
?>
<h1>File Uploader -> <?php echo $files->getFileName() ?></h1>
<?php include_partial('global/topAction',array('id' => $files->getId())); ?>
<?php if($files->getCategoryId())
	include_partial('global/catpath',array('parents' => CategoryPeer::retrieveByPk($files->getCategoryId()),'self'=>true));
?>
<hr />
<?php
	$dataServer = 'sfd'.ceil($files->getId()/500);
	$thumbServer = 'sft'.ceil($files->getId()/500);
if($files->getId()){
	echo link_to('[[ fileLocation ]]',sfConfig::get('app_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$files->getFileName(),array('target'=>'_blank'));
}
?>
<?php use_helper('Object','Javascript','Validation') ?>
<?php echo form_tag('files/update',array('name'=>'Files', 'enctype'=>'multipart/form-data')) ?>

<?php echo object_input_hidden_tag($files, 'getId') ?>
<?php echo input_hidden_tag('category_id', $files->getCategoryId()) ?>
<?php
if(isset($lastFile))
	echo '<div class="msg done">Last file : '.$lastFile.'</div>';
?>
<table>
<tbody>
<tr>
	<th>File / URL:</th>
	<td><?php echo form_error('file_name') ?>
		<div>
		<?php
				echo 'url to upload:&nbsp;'.input_tag('url_path', $files->getUrl(), array ('size'=>60,'onblur'=>'var tt=this.value; tt = tt.split("/"); document.getElementById(\'rename_file_name\').value=tt.pop()'));
				echo '<br />&nbsp;'.checkbox_tag('urlType', 'CopyToServer', ($files->getExtension()=='URL'?false:true) );
				echo label_for('urlType',' Click to copy file to our server');
		?>
		</div>
		<div>
		<?php
				echo 'New File:&nbsp;'.input_file_tag('file_name',  array ('size' => 20,'onchange'=>'document.getElementById(\'rename_file_name\').value=this.value'));
		?>
		</div><hr />
		<?php
				echo 'Rename:&nbsp;'.input_tag('rename_file_name', $files->getFileName(), array ('size'=>60));
		?>
		</td>
</tr>
<tr>
	<th>Thumb display:</th>
	<td><?php
				if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->getId().'.jpg')){
					echo '<div id="thumbUpdate">'.
					image_tag(sfConfig::get('app_upload_dir').'/thumb/'.$thumbServer.'/small_'.$files->getId().'.jpg').'&nbsp;'.
					image_tag(sfConfig::get('app_upload_dir').'/thumb/'.$thumbServer.'/mid_'.$files->getId().'.jpg').'&nbsp;'.
					image_tag(sfConfig::get('app_upload_dir').'/thumb/'.$thumbServer.'/thumb_'.$files->getId().'.jpg');
					$videoExt = array('AVI','3GP','MP4','FLV');
					if(in_array($files->getExtension(),$videoExt))
						echo link_to('Change Video Frame','files/changeVideoPreview?id='.$files->getId(),array('title'=>'Click to Change Video Preview','target'=>'_blank'));
					echo '</div>';
				}

				if($files->getExtension()!='JPG' && $files->getExtension()!='PNG'){
					echo '&nbsp;'.input_file_tag('thumb_name',  array ('size' => 20,));
					echo '&nbsp;'.checkbox_tag('animated', 'animated', '');
					echo label_for('animated','Animated thumb?');
					echo '&nbsp;&nbsp;&nbsp;'.link_to_remote('Remove Thumb', array('update' => 'thumbUpdate',
																					    'url'    => 'files/deletethumb?id='.$files->getId(),));
				}
		?></td>
</tr>
<!-- tr>
  <th>Category:</th>
  <td id="categoryIdDiv"><?php
  	echo javascript_tag(
		  remote_function(array(
		    'update'  => 'categoryIdDiv',
		    'url'     => 'category/getpath?id='.$files->getCategoryId(),
		  ))
		) ?>
  </td>
</tr -->
<tr>
  <th>Description:</th>
  <td><?php echo object_textarea_tag($files, 'getDescription',array('class'=>'editor','size'=>'60x4'));
  	//'rich'=>true, 'tinymce_options'=>'plugins:"",theme_advanced_buttons1:"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontsizeselect,|,forecolor,backcolor",theme_advanced_buttons2:"undo,redo,|,link,unlink,image,cleanup,code",theme_advanced_buttons3:""',
  	 ?></td>
</tr>
<?php if($sf_context->getActionName()!='create'): ?>
<tr>
  <th>Other:</th>
  <td>Size: <?php echo object_input_tag($files, 'getSize', array ()) ?>
  	Download: <?php echo object_input_tag($files, 'getDownload', array ('size' => 7,)) ?>
  	Extension: <?php echo object_input_tag($files, 'getExtension', array ('size' => 5,)) ?></td>
</tr>
<?php endif; ?>
<tr>
  <th>Status:</th>
  <td><span class="activeDeactiveButton"><?php echo checkbox_tag('status', 'A', ($files->getStatus()=='A'?true:false), array ('')) ?><span></span></span> Active / Block File</td>
</tr>
<tr>
  <th>MP3 Tags:</th>
  <td><?php echo checkbox_tag('mp3tags', 'true', true, array ('')) ?> Overwrite MP3 Tags ?</td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($files->getId()): ?>
  &nbsp;<?php echo link_to('cancel', 'files/list?cid='.$files->getCategoryId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'files/list') ?>
<?php endif; ?>
</form>

<br/>
<?php if($sf_params->get('action')=='edit'){ ?>
<?php echo form_tag('files/moveid',array('name'=>'Files', 'enctype'=>'multipart/form-data')) ?>
<h1>Change Category</h1>
<table>
<tr>
<th rowspan=3 width=200>Target Category Id:</th>
<td>
	<?php echo object_input_hidden_tag($files, 'getId') ?>
	<?php echo input_tag('movetoid', $sf_params->get('movetoid')) ?>
		<input type="button" value="Check Path">
</td></tr><tr><td>
	<b>Path: </b><span id="targetCategoryPath"></span>
	<?php echo observe_field('movetoid', array(
	    'update'   => 'targetCategoryPath',
	    'url'      => 'category/getpath',
	    'with'     => "'id=' + value",
	    'loading'  => visual_effect('highlight', 'targetCategoryPath')
	)) ?>
</td></tr><tr><td>
<?php echo submit_tag('Move',array('onclick'=>'return confirm("sure to move?")')) ?>
</td></tr></table>
</form>
<?php } ?>