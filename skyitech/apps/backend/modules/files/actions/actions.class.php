<?php

class filesActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('files', 'list');
  }

  public function executeList()
  {
		$c = new Criteria();
		if($this->getRequestParameter('cid')){
		  $this->parent = $this->getRequestParameter('cid');
		  $this->parentCategory = CategoryPeer::retrieveByPk($this->getRequestParameter('cid'));
			$c->add(FilesPeer::CATEGORY_ID, $this->getRequestParameter('cid'));
			//$this->fileUrls = WapFileTablePeer::getFileUrls($this->getRequestParameter('cid'));
		}
		if($this->getRequestParameter('name'))
			$c->add(FilesPeer::FILE_NAME , '%'.$this->getRequestParameter('name').'%', Criteria::LIKE);
	
		if($this->getRequestParameter('status')=='b')
			$c->add(FilesPeer::STATUS, 'B');
		elseif($this->getRequestParameter('status')=='a')
			$c->add(FilesPeer::STATUS, 'A');

		if($this->getRequestParameter('extension'))
			$c->add(FilesPeer::EXTENSION, strtoupper($this->getRequestParameter('extension')));
	
		if($this->getRequestParameter('sort')=='d')
			$c->addDescendingOrderByColumn(FilesPeer::DOWNLOAD);
		elseif($this->getRequestParameter('sort')=='a2z')
			$c->addAscendingOrderByColumn(FilesPeer::FILE_NAME);
		elseif($this->getRequestParameter('sort')=='z2a')
			$c->addDescendingOrderByColumn(FilesPeer::FILE_NAME);
		else
			$c->addDescendingOrderByColumn(FilesPeer::CREATED_AT);
	
	    $pager = new sfPropelPager('Files', 10);
	    $pager->setCriteria($c);
	    $pager->setPage($this->getRequestParameter('page', 1));
	    $pager->init();
	    $this->pager = $pager;
	    $this->filess = $pager->getResults();
  }

  
  public function executeShow()
  {
    $this->files = FilesPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->files);
  }
 
  public function executeChangeVideoPreview()
  {
    $files = FilesPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($files);

		$dataServer = 'sfd'.ceil($files->getId()/500);
		$thumbServer = 'sft'.ceil($files->getId()/500);
		$movieFile = sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$files->getFileName();
		$mov = new ffmpeg_movie($movieFile, false);
		$frmCnt = $mov->getFrameCount();
		sfLoader::loadHelpers(array('Url'));
		for($i=0; $i< $frmCnt; $i+=10)
		{
			echo "<a title='click to change' href='".url_for('files/setFrame?id='.$files->getId().'&frame='.$i)."'><img src='/backend/ffmpeg.php?frame=$i&w=50&h=50&file=".($movieFile)."' style='margin:5px;border:none;'></a>";
		}
		exit;
  }
   

  public function executeSetFrame()
  {
		myUser::setVideoFrame($this->getRequestParameter('id'),$this->getRequestParameter('frame'));
		echo '<h1>Thumb Updated</h1>';
		return sfView::NONE;
  }

  public function executeCreate()
  {
    $this->files = new Files();
  	if($this->getRequestParameter('cid')){
  		$this->category = CategoryPeer::retrieveByPk($this->getRequestParameter('cid'));
  		if($this->category->getChild()=='D'){
		  	$this->setFlash('attrib', ' can\' add files here, <b>'.$category->getCategoryName().'</b> has sub directories');
		  	return $this->redirect($_SERVER['HTTP_REFERER']);
		  }
	    $this->files->setCategoryId($this->category->getId());
  	}
  	if($this->getRequestParameter('lastFile')){
  		$this->lastFile = base64_decode($this->getRequestParameter('lastFile'));
  	}
		$this->setTemplate('edit');
  }

 
  public function executeEdit()
  {
    $this->files = FilesPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->files);
  }

  public function executeUpdate()
  {
    if(!$this->getRequestParameter('id') || $this->getRequestParameter('id')=='')
    {
			if(!$this->getRequest()->getFileSize('file_name') && !$this->getRequestParameter('url_path'))
			{
			    $this->getRequest()->setError('file_name', 'Please upload files...');
					$this->forward('files', 'create', array('cid' => $this->getRequestParameter('category_id')));
			}
			$files = new Files();
    }
    else
    {
      $files = FilesPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($files);
    }
		$ipUpdated=false;
		if($files->getCategoryId() && $files->getCategoryId()!=$this->getRequestParameter('category_id'))
		{
	    $parentCategory = CategoryPeer::retrieveByPk($files->getCategoryId());
			myUser::updateFilesTotal($files->getCategoryId(),$parentCategory->getParents(),'remove');
		  if($parentCategory->getFiles() == 1){
		    $parentCategory->setChild('N');
		    $parentCategory->save();
			}
			$ipUpdated = true;
		}

	    $files->setId($this->getRequestParameter('id'));
	    $files->setCategoryId($this->getRequestParameter('category_id') ? $this->getRequestParameter('category_id') : null);
	    $files->setDescription($this->getRequestParameter('description') ? $this->getRequestParameter('description') : '');
	    $files->setDownload($this->getRequestParameter('download') ? $this->getRequestParameter('download') : 0);
	    $files->setExtension($this->getRequestParameter('extension'));
	    $files->setStatus($this->getRequestParameter('status')=='A'?'A':'B');
	    $files->setUrl('');
	    $files->save();

	    $parentCategory = CategoryPeer::retrieveByPk($this->getRequestParameter('category_id'));
	    $parentCategory->setChild('F');
	    $parentCategory->save();


		/*
		* SKYiTech :: define file types to allow & to identify
		*/
		$wallpaper = array('jpg','gif','png','jpeg');
		
		/*
		* SKYiTech :: making dataserver and thumbserver directory if not present
		*/
		$dataServer = 'sfd'.ceil($files->getId()/500);
		$thumbServer = 'sft'.ceil($files->getId()/500);
		if(!is_dir(sfConfig::get('sf_upload_dir').'/files/'.$dataServer))
			mkdir(sfConfig::get('sf_upload_dir').'/files/'.$dataServer);
		if(!is_dir(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer))
			mkdir(sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer);
		if(!is_dir(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId()))
			mkdir(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId());


		/*
		* SKYiTech :: upload file from other server directly
		*/
		if($this->getRequestParameter('url_path') && $this->getRequestParameter('urlType') == 'CopyToServer')
		{
			########## url
			if($this->getRequestParameter('dirCatch')):
				$donwloadLink = trim(base64_decode($this->getRequestParameter('url_path')));
				$NewFileName = trim(str_replace('%20',' ',base64_decode($this->getRequestParameter('url_path'))));
			else:
				$donwloadLink = trim($this->getRequestParameter('url_path'));
				$NewFileName = trim(str_replace('%20',' ',$this->getRequestParameter('url_path')));
			endif;
			$urlInfo = pathinfo($donwloadLink);
			$fileNameInfo = pathinfo($NewFileName);
			
			$fileName = ($fileNameInfo['filename'] ? $fileNameInfo['filename'] : str_replace('%20',' ',$urlInfo['filename']));
			//$fileExt = ($fileNameInfo['extension'] ? $fileNameInfo['extension'] : $urlInfo['extension']);
			$fileExt = explode('.',$NewFileName);
			$fileExt = end($fileExt);

			$type = 'o';
			if(in_array(strtolower($fileExt),$wallpaper))
				$type = 'w';

			if($this->getRequestParameter('rename_file_name')!=''){
				$saveAs = explode('.',$this->getRequestParameter('rename_file_name'));
				array_pop($saveAs);	// remove extension from array
				$saveAs = trim(str_replace('%20',' ',implode('.',$saveAs)));	// join remaining array
			}
			else	
				$saveAs = $fileName;
		
			$saveAs = $saveAs.'.'.$fileExt;
			if(strstr($saveAs, sfConfig::get('app_filename2hide').'.'.substr(strrchr($saveAs,'.'),1)))
				$saveAs = str_replace(sfConfig::get('app_filename2hide').'.'.substr(strrchr($saveAs,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($saveAs,'.'),1), $saveAs);
			else
				$saveAs = str_replace('.'.substr(strrchr($saveAs,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($saveAs,'.'),1), $saveAs);
			$filePathToSave = sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$saveAs;

			########## url //
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $donwloadLink);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			
			set_time_limit(300); # 5 minutes for PHP
			curl_setopt($ch, CURLOPT_TIMEOUT, 300) or die('time limit exceed... '); # and also for CURL

			$outfile = fopen($filePathToSave, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $outfile) or die('can not write destination file');
			
			// grab file from URL
			curl_exec($ch) or die('curl function is not working proper');
			
			$info = curl_getinfo($ch);
			fclose($outfile);

			/*
			* SKYiTech :: create thumb images if file type is wallpaper
			*/
			if($type=='w')
			{
				list($width1, $height1, $type1, $attr1) = getimagesize($filePathToSave);
				myClass::getImageRatio($filePathToSave,'thumb/'.$thumbServer.'/',120, 120, $width1, $height1,false, 'thumb_'.$files->getId().'.jpg',true,95,'logo.png');
				myClass::getImageRatio($filePathToSave,'thumb/'.$thumbServer.'/',80, 80, $width1, $height1,false, 'mid_'.$files->getId().'.jpg',false,95);
				myClass::getImageRatio($filePathToSave,'thumb/'.$thumbServer.'/',60, 70, $width1, $height1,false, 'small_'.$files->getId().'.jpg',false,95);

				copy(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$saveAs, sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$saveAs);
				/*
				* SKYiTech :: Water mark original wallpaper, yet original size is only used in gif
				*/
				if(strtoupper($fileExt)!='GIF'){
			    $img = new sfImage(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$saveAs); // using MIME detection
			    $img->overlay(new sfImage(sfConfig::get('sf_upload_dir').'/logo.png'), 'bottom-right'); // or you can use coords array($x,$y)
			    $img->setQuality(100);
			    $img->save();
		  	}
		  }

			$files = FilesPeer::retrieveByPk($files->getId());
			$files->setFileName($saveAs);
	    $files->setSize( filesize($filePathToSave) );
	    $files->setExtension(strtoupper($fileExt));
			$files->save();
		}
		elseif($this->getRequestParameter('url_path') && $this->getRequestParameter('urlType') != 'CopyToServer')
		{
			/*
			* SKYiTech :: direct download file from other server
			*							save 'url address' and 'type' => 'url'
			*/
			$NewFileName = trim(urldecode($this->getRequestParameter('rename_file_name')));
			$fileNameInfo = pathinfo($NewFileName);
			
			$fileName = $fileNameInfo['filename'];
			$fileExt = explode('.',$NewFileName);
			$fileExt = end($fileExt);

			if(strstr($NewFileName, sfConfig::get('app_filename2hide').'.'.substr(strrchr($NewFileName,'.'),1)))
				$NewFileName = str_replace(sfConfig::get('app_filename2hide').'.'.substr(strrchr($NewFileName,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($NewFileName,'.'),1), $NewFileName);
			else
				$NewFileName = str_replace('.'.substr(strrchr($NewFileName,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($NewFileName,'.'),1), $NewFileName);
			//$files = FilesPeer::retrieveByPk($files->getId());
			$files->setFileName($NewFileName);
	    $files->setSize( $this->getRequestParameter('size') );
	    $files->setExtension('URL');
	    $files->setUrl($this->getRequestParameter('url_path'));
			$files->save();
		}

		/*
		* SKYiTech :: upload file from local PC
		*/
		if($this->getRequest()->getFileSize('file_name') > 0)
		{
			$fileName = $this->getRequest()->getFileName('file_name');
			$fileExt = explode('.',$this->getRequest()->getFileName('file_name'));
			$fileExt = end($fileExt);
			if(in_array(strtolower($fileExt),$wallpaper))
				$type = 'w';
			else{
			//    $this->getRequest()->setError('file_name', 'Please upload files like jpg,gif,png');
			//	$this->forward('files','create');
			}

			$saveAs = $this->getRequest()->getFileName('file_name');
			//$saveAs = str_replace('.'.$fileExt, sfConfig::get('app_filename2hide').'.'.strtolower($fileExt), $saveAs);
			//echo $saveAs; exit;

			/*
			* SKYiTech :: create thumb images if file type is wallpaper
			*/
			$fPath = sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$saveAs;
			$this->getRequest()->moveFile('file_name', $fPath);
			if($type=='w')
			{
				list($width1, $height1, $type1, $attr1) = getimagesize($fPath);
				myClass::getImageRatio($fPath,'thumb/'.$thumbServer.'/',60, 70, $width1, $height1,false, 'small_'.$files->getId().'.jpg',false,95);
				myClass::getImageRatio($fPath,'thumb/'.$thumbServer.'/',80, 80, $width1, $height1,false, 'mid_'.$files->getId().'.jpg',false,95);
				myClass::getImageRatio($fPath,'thumb/'.$thumbServer.'/',120, 120, $width1, $height1, false, 'thumb_'.$files->getId().'.jpg',true,95, 'logo.png');

				copy($fPath, sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$saveAs);
				/*
				* SKYiTech :: Water mark original wallpaper, yet original size is only used in gif
				*/
				if(strtoupper($fileExt)!='GIF'){
			    $img = new sfImage($fPath); // using MIME detection
			    $img->overlay(new sfImage(sfConfig::get('sf_upload_dir').'/logo.png'), 'bottom-right'); // or you can use coords array($x,$y)
			    $img->setQuality(100);
			    $img->save();
		  	}
			}

			$files = FilesPeer::retrieveByPk($files->getId());
			$files->setFileName($saveAs);
		  $files->setSize($this->getRequest()->getFileSize('file_name'));
		  $files->setExtension(strtoupper($fileExt));
			$files->save();
		}
		

		/*
		* SKYiTech :: rename file name
									do not rename if it is url upload
		*/
		if($this->getRequestParameter('rename_file_name') && !$this->getRequestParameter('url_path'))
		{
			$newFileName = $this->getRequestParameter('rename_file_name');

			/*
			* SKYiTech :: replace sfConfing::get('app_filename2hide') -(sitename.ext) or add it
			*/
			if(strstr($newFileName, sfConfig::get('app_filename2hide').'.'.substr(strrchr($newFileName,'.'),1)))
				$newFileName = str_replace(sfConfig::get('app_filename2hide').'.'.substr(strrchr($newFileName,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($newFileName,'.'),1), $newFileName);
			else
				$newFileName = str_replace('.'.substr(strrchr($newFileName,'.'),1), sfConfig::get('app_filename2hide').'.'.substr(strrchr($newFileName,'.'),1), $newFileName);
			//echo $newFileName; exit;
			if($newFileName != $files->getFileName())
			{
				rename(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$files->getFileName(), sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/'.$newFileName);
				if(is_file(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$files->getFileName()))
					rename(sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$files->getFileName(), sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/org_'.$files->getId().'_'.$newFileName);

				$files->setFileName($newFileName);
				$files->save();
			}
		}


		/*
		* SKYiTech :: updating total files count for all parent categories
		*/
		if($ipUpdated==true || !$this->getRequestParameter('id') || $this->getRequestParameter('id')=='')
		{
			myUser::updateFilesTotal($files->getCategoryId(),$parentCategory->getParents(),'add');
		}

		/*
		* SKYiTech :: enter record in files_extra table for twit & blog request count
		if(!$this->getRequestParameter('id') || $this->getRequestParameter('id')=='')
		{
			$files_extra = new FilesExtra();
	    $files_extra->setFilesId($files->getId());
	    $files_extra->save();
		}
		*/
		
		$videoExt = array('AVI','3GP','MP4','FLV');
		if(in_array($files->getExtension(),$videoExt))
		{
			myUser::setVideoFrame($files->getId(),10);
		}
		if($files->getExtension()=='NTH')
		{
			myUser::setNthPreview($files->getId());
		}
		if($files->getExtension()=='THM')
		{
			myUser::setThmPreview($files->getId());
		}
		//if($files->getExtension()=='JAR')
		//{
		//	myUser::setJarPreview($files->getId());
		//}


		/*
		* SKYiTech :: create thumb if upload by dirCatch and we found thumb on dir like "thumb-filename.jpg" or "thumb-filename.ext.jpg"
		*/
		if($this->getRequestParameter('dirCatch'))
		{
			if($files->getExtension()!='JPG' && $files->getExtension()!='JPEG' && $files->getExtension()!='PNG'):
				$fileThumb = base64_decode($this->getRequestParameter('url_path'));
				$fileThumb = str_replace('%20',' ',$fileThumb);
				$fileThumb = str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$fileThumb);
				$fileInfo = pathinfo($fileThumb);
				$bname = $fileInfo['basename']; // filname.ext
				$fname = $fileInfo['filename']; // filename
				$fileHasThumb = false;

				if(is_file(str_replace($bname,'thumb-'.$fname.'.jpg',$fileThumb)))
					$fileHasThumb = str_replace($bname,'thumb-'.$fname.'.jpg',$fileThumb);
				elseif(is_file(str_replace($fname,'thumb-'.$fname.'.jpg',$fileThumb)))
					$fileHasThumb = str_replace($fname,'thumb-'.$fname.'.jpg',$fileThumb);
				elseif(is_file(str_replace($bname,'thumb-'.$fname.'.gif',$fileThumb)))
					$fileHasThumb = str_replace($bname,'thumb-'.$fname.'.gif',$fileThumb);
				elseif(is_file(str_replace($fname,'thumb-'.$fname.'.gif',$fileThumb)))
					$fileHasThumb = str_replace($fname,'thumb-'.$fname.'.gif',$fileThumb);
				elseif(is_file(str_replace($bname,'thumb-'.$fname.'.png',$fileThumb)))
					$fileHasThumb = str_replace($bname,'thumb-'.$fname.'.png',$fileThumb);
				elseif(is_file(str_replace($fname,'thumb-'.$fname.'.png',$fileThumb)))
					$fileHasThumb = str_replace($fname,'thumb-'.$fname.'.png',$fileThumb);

				if($fileHasThumb!=false)
				{
					list($width1, $height1, $type1, $attr1) = getimagesize($fileHasThumb);
					myClass::getImageRatio($fileHasThumb,'thumb/'.$thumbServer.'/',120, 120, $width1, $height1,false, 'thumb_'.$files->getId().'.jpg',true,95,'logo.png');
					myClass::getImageRatio($fileHasThumb,'thumb/'.$thumbServer.'/',80, 80, $width1, $height1,false, 'mid_'.$files->getId().'.jpg',true,95,'logo2.png');
					myClass::getImageRatio($fileHasThumb,'thumb/'.$thumbServer.'/',60, 70, $width1, $height1,false, 'small_'.$files->getId().'.jpg',true,95,'logo2.png');

					copy($fileHasThumb, sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/thumb-'.$files->getId().'.jpg');
				}
			endif;
		}
		/*
		* SKYiTech :: create thumb images if file type is not wallpaper and thumb image uploaded
		*/
		if($this->getRequest()->getFileSize('thumb_name') > 0 && ($files->getExtension()!='JPG' && $files->getExtension()!='JPEG' && $files->getExtension()!='PNG'))
		{
			$thumbName = $this->getRequest()->getFileName('thumb_name');
			$thumbExt = explode('.',$this->getRequest()->getFileName('thumb_name'));
			if(in_array(strtolower(end($thumbExt)),$wallpaper))
			{
				list($width1, $height1, $type1, $attr1) = getimagesize($this->getRequest()->getFilePath('thumb_name'));
				myClass::getImageRatio($this->getRequest()->getFilePath('thumb_name'),'thumb/'.$thumbServer.'/',120, 120, $width1, $height1,false, 'thumb_'.$files->getId().'.jpg',true,95,'logo.png');
				myClass::getImageRatio($this->getRequest()->getFilePath('thumb_name'),'thumb/'.$thumbServer.'/',80, 80, $width1, $height1,false, 'mid_'.$files->getId().'.jpg',true,95,'logo2.png');
				myClass::getImageRatio($this->getRequest()->getFilePath('thumb_name'),'thumb/'.$thumbServer.'/',60, 70, $width1, $height1,false, 'small_'.$files->getId().'.jpg',true,95,'logo2.png');
			}
			if($this->getRequestParameter('animated')=='animated' && strtolower(end($thumbExt)) == 'gif')
				$this->getRequest()->moveFile('thumb_name', sfConfig::get('sf_upload_dir').'/thumb/'.$thumbServer.'/animate_'.$files->getId().'.gif');
			else
				$this->getRequest()->moveFile('thumb_name', sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->getId().'/thumb-'.$files->getId().'.jpg');
		}


		/* sKYiTech:: batch upload */
		if($this->getRequestParameter('dirCatch')){
			if($this->getRequestParameter('removeFile')=='yes'):
				$fileRemove = base64_decode($this->getRequestParameter('url_path'));
				$fileRemove = str_replace('%20',' ',$fileRemove);
				$fileRemove = str_replace('http://'.$_SERVER['HTTP_HOST'],$_SERVER['DOCUMENT_ROOT'],$fileRemove);
				if(is_file($fileRemove))
					unlink($fileRemove);
			endif;

			if($files->getExtension()=='MP3' && $this->getRequestParameter('mp3tags')=='yes')
				$this->redirect(sfConfig::get('app_webpath').'/SkyWriteMp3.php?Filename='.htmlentities($dataServer.'/'.$files->getId().'/'.$files->getFileName()).'&cid='.$files->getCategoryId().'&catName='.base64_encode(CategoryPeer::getCategoryName($files->getCategoryId())).'&lastFile='.base64_encode($files->getFileName()).'&dirCatch='.$this->getRequestParameter('url_path') );
			else
				echo $this->getRequestParameter('url_path');
			exit;
		}	

		myUser::clearCategoryCache($files->getCategoryId());
		myUser::clearFileCache($files->getId());

		/* sKYiTech:: single upload */
		if($files->getExtension()=='MP3' && $this->getRequestParameter('mp3tags')=='true' && ($this->getRequestParameter('url_path') || $this->getRequest()->getFileSize('file_name') > 0) ){
			header('Location: /backend/SkyWriteMp3.php?Filename='.$dataServer.'/'.$files->getId().'/'.$files->getFileName().'&cid='.$files->getCategoryId().'&catName='.base64_encode(CategoryPeer::getCategoryName($files->getCategoryId())).'&lastFile='.base64_encode($files->getFileName()) );
			exit;
		}
		else
	    return $this->redirect('files/create?cid='.$files->getCategoryId().'&lastFile='.base64_encode($files->getFileName()));
  }

  public function executeActivation(){
  	if($this->getRequestParameter('status') == 'B')
  		$status = 'A';
  	else
  		$status = 'B';
    $this->files = FilesPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->files);
    $this->files->setStatus($status);
    $this->files->save();
  	if($this->getRequestParameter('status') == 'B')
  		echo '<a onclick="new Ajax.Updater(\'active_'.$this->getRequestParameter('id').'\', \'/backend/files/activation/id/'.$this->getRequestParameter('id').'/status/A\', {asynchronous:true, evalScripts:false});; return false;" href="#">Active</a>';
  	else
  		echo '<a onclick="new Ajax.Updater(\'active_'.$this->getRequestParameter('id').'\', \'/backend/files/activation/id/'.$this->getRequestParameter('id').'/status/B\', {asynchronous:true, evalScripts:false});; return false;" href="#"><span class="red">Block</span></a>';
		return sfView::NONE;
  }
 
}