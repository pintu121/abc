<?php
	$class = 'even';
	while($files = mysql_fetch_object($filesss)):
		$class = myClass::getOddEven($class);
?>
		<tr class="<?php echo $class?>">
	    <?php 
				$thumbServer = 'ts'.ceil($files->id/500);
	    	if(is_file(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/mid_'.$files->id.'.jpg'))
	    		echo '<td class="tblimg">'.image_tag(SETTING_THUMB_DOMAIN.'/'.$thumbServer.'/mid_'.$files->id.'.jpg',array()).'</td><td>';
	    	else
		  		echo '<td colspan=2>';
	    	?>
	    	<?php echo link_to(str_replace(sfConfig::get('app_filename2hide'),'',$files->file_name),'@filesShow?id='.$files->id.'&name='.substr($files->file_name,0,strpos($files->file_name,sfConfig::get('app_filename2hide'))), array('class'=>'fileName')) ?>
	    </td>
	  </tr>
<?php
	endwhile;
?>