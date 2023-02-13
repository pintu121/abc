<?php
		$fileName = array();
		// Note that !== did not exist until 4.0.0-RC2
		if ($handle = opendir(sfConfig::get('sf_upload_dir').'/advt')) {
		   //echo "Directory handle: $handle\n";
		   $allowExt = array('.txt','.php');
			while (false !== ($file = readdir($handle))) {
				if(in_array(substr($file, -4), $allowExt)) {
					$fileName[$file] = $file;
				}
			}
			closedir($handle);
		}

	if($_REQUEST['save']){
		$selectFile = $_REQUEST['mailName'];
		$filenm = "dirToRead/".$_REQUEST['mailName'];
	
		if(file_exists($filenm))
			unlink($filenm);
		$handle = fopen($filenm, 'w');
		fwrite($handle, $_REQUEST['email_file']);
		fclose($handle);
		//return $this->redirect('language/list');
	}
	
	$content='';
	if($_REQUEST['mailName'] != '') {
		$selectFile = $_REQUEST['mailName'];
		$filenm = "dirToRead/".$_REQUEST['mailName'];
	
		if(file_exists($filenm)) {
			$lines = file($filenm);
			foreach ($lines as $line_num => $line) {
				$content .= $line;
			}
		}
	}
?>
<form action="" method="post" name="mail_format">
<div class="form-container">
	<fieldset style="border:1px solid #d5d5d5;padding:0;margin:0;">
		<br />
		<div class="pad5">
			<?php
				echo '<label>Select File</label>';
				echo '<select name="mailName" onchange="document.mail_format.submit();">';
				foreach($fileName as $key => $value){
					echo '<option value="'.$value.'" '.($value==$selectFile ? 'selected':'').'>'.$value.'</option>';
				}
				echo '</select>';
			?>
		</div>
		<div class="pad5">
			<label>Email File detail</label>
		</div>
		<div class="pad5">
			<?php echo '<textarea name="email_file" cols=80 rows=25>'.$content.'</textarea>'; ?>
		</div>
		<div class="pad5">
			<label class="col" for=""> </label> 
			<input type="submit" class="but_bg" value="Save" name="save"/> 
			<input type="button" onclick='return window.location.href="/backend/language/list";' class="but_bg" value="Cancel" id="cancel" name="cancel"/>
		</div>
	</fieldset>
</div>
</form>
