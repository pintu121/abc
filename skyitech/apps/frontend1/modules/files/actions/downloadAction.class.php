<?php

class downloadAction extends sfAction
{
  public function execute()
  {
  	if($this->getRequestParameter('id')){
	    {
		    $files = skyGetRecordById('files',$this->getRequestParameter('id'));
		    $category = skyGetRecordById('category',$files->category_id);
				$this->forward404Unless($files);

				$dataServer = 'sfd'.ceil($files->id/500);

				/*
				* SKYiTech :: get wallpaper in different size
				*							if image in requested size is not present on server generate it now and redirect to current page
				*/
		    $size = '';
		    if($this->getRequestParameter('size') && $this->getRequestParameter('size')!=''){
			    $size = $this->getRequestParameter('size');
					if(!is_file(sfConfig::get('sf_upload_dir').'/ifiles/'.$size.'/'.$files->id.'/'.$files->file_name)){
						if(!is_dir(sfConfig::get('sf_upload_dir').'/ifiles/'.$size)){
							mkdir(sfConfig::get('sf_upload_dir').'/ifiles/'.$size);
							//chmod(sfConfig::get('sf_upload_dir').'/ifiles/'.$size,777);
						}
						if(!is_dir(sfConfig::get('sf_upload_dir').'/ifiles/'.$size.'/'.$files->id)){
							mkdir(sfConfig::get('sf_upload_dir').'/ifiles/'.$size.'/'.$files->id);
							//chmod(sfConfig::get('sf_upload_dir').'/ifiles/'.$size.'/'.$files->id,777);
						}
						$sizes = explode('x',$size);
				    $orgFilePath = sfConfig::get('sf_upload_dir').'/files/'.$dataServer.'/'.$files->id.'/org_'.$files->id.'_'.$files->file_name;
				    list($width1, $height1) = getimagesize($orgFilePath);
				    if($size[0] < 220)
				    	$wImg = 'logo4.png';
				    else
				    	$wImg = 'logo3.png';
					myClass::getImageRatio($orgFilePath,'ifiles/'.$size.'/'.$files->id.'/',$sizes[0], $sizes[1], $width1, $height1,false, $files->file_name,true,100,$wImg);
						//$this->redirect($this->getRequest()->getUri());
					}
			  }

			$sql = "update files set today=today+1, download=download+1 where id=".$this->getRequestParameter('id');
			skyMysqlQuery($sql);
			$mobDomain = SETTING_MOB_DATA_DOMAIN;
			$pcDomain = SETTING_PC_DATA_DOMAIN;

			if($files->extension=='URL'){
				$this->redirect($files->url);
				exit;
			}
			elseif(USERDEVICE=='m')
			{
				if($size!=''){	/* if wallpaper */
				  if(preg_match('/samsung|android/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/opera|ucweb|uc browser/i',$_SERVER['HTTP_USER_AGENT']))
				    $this->redirect($mobDomain.'/ifiles/'.$size.'/'.$files->id.'/'.$files->file_name);
				  else
				    $this->redirect($pcDomain.'/ifiles/'.$size.'/'.$files->id.'/'.$files->file_name);
				}
			  else{	/* if other file */
				  if(preg_match('/3GP|MP4/i',$files->extension))
				    $this->redirect($mobDomain.'/files/'.$dataServer.'/'.$files->id.'/'.$files->file_name);
				  elseif(preg_match('/samsung|android/i',$_SERVER['HTTP_USER_AGENT']))
				    $this->redirect($mobDomain.'/files/'.$dataServer.'/'.$files->id.'/'.$files->file_name);
				  else
				    $this->redirect($mobDomain.'/files/'.$dataServer.'/'.$files->id.'/'.$files->file_name);
				}
				exit;
			}
			else /* SKYiTech :: if device is pc read file from server */
			{
				if($size!=''){	/* if wallpaper */
					/* 9-9-10 : Temparory redirected to direct link due to downloading problem */
			    $this->redirect($pcDomain.'/ifiles/'.$size.'/'.$files->id.'/'.$files->file_name);
			    exit;
			  }
			  $this->redirect($pcDomain.'/files/'.$dataServer.'/'.$files->id.'/'.$files->file_name);
				exit;
			}

			}
			
	    return sfView::NONE;
	    $this->forward404Unless($this->files);
  	}
  }

	public function handleError()
	{
 		downloadAction::execute();
 		return sfView::NONE;
	}

}