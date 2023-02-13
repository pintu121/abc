<h1>Advertisement Code Edit / Show</h1>
<!-- ?php include_partial('advt/list',array('id' => '')); ? -->
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
			sort($fileName);
			closedir($handle);
		}

	if($sf_params->get('save')){
		$selectFile = $_REQUEST['mailName'];
		$filenm = sfConfig::get('sf_upload_dir')."/advt/".$sf_params->get('mailName');
	
		if($sf_params->get('chmod')!='')
			chmod($filenm, $sf_params->get('chmod'));
		if(file_exists($filenm))
			unlink($filenm);
		$handle = fopen($filenm, 'w');
		fwrite($handle, $sf_params->get('email_file'));
		fclose($handle);
		//return $this->redirect('language/list');
	}
	
	$content='';
	if($sf_params->get('mailName') != '') {
		$selectFile = $sf_params->get('mailName');
		$filenm = sfConfig::get('sf_upload_dir')."/advt/".$_REQUEST['mailName'];
	
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
				echo '<input name="chmod" type="hidden" value="'.$sf_params->get('chmod').'">';
				echo '<select name="mailName" onchange="document.mail_format.submit();">';
					echo '<option disabled selected>Select Ad File</option>';
				foreach($fileName as $key => $value){
					echo '<option value="'.$value.'" '.($value==$selectFile ? 'selected':'').'>'.$value.'</option>';
				}
				echo '</select>';
			?>
		</div>
		<Br />
		<div class="pad5">
			<label>Advertisement File Content</label>
		</div>
		<div class="pad5">
			<?php echo '<textarea name="email_file" style="width:98%;" rows=25>'.$content.'</textarea>'; ?>
		</div>
		<div class="pad5">
			<label class="col" for=""> </label> 
			<input type="submit" class="but_bg" value="Save" name="save"/> 
			<input type="button" onclick='return window.location.href="/backend/language/list";' class="but_bg" value="Cancel" id="cancel" name="cancel"/>
		</div>
	</fieldset>
</div>
</form>

<pre>

ad1	=> background->gray; font->white;

ad2	=> font->white; font-weight:bold;

ad3	=> font->white;

adBold => all font->bold;

adLinkBold => only link font->bold;

tCenter => text center

&lt;div class="[above class name by space]"&gt;
	[keep Ad code here]
&lt;/div&gt;
</pre>