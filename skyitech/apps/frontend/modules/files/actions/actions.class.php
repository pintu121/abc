<?php
// auto-generated by sfPropelCrud
// date: 2009/06/07 18:21:54
?>
<?php

/**
 * files actions.
 *
 * @package    
 * @subpackage files
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class filesActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('files', 'list');
  }

  public function executeList()
  {
  	if($this->getRequestParameter('parent') && is_numeric($this->getRequestParameter('parent'))){
			sfLoader::loadHelpers(array('Url', 'Tag'));
			$this->parent = $this->getRequestParameter('parent');

  		$parent = skyGetRecordById('category',$this->getRequestParameter('parent'));
  		$this->catName = $parent->category_name;
			$this->catTitle = $parent->title;
  		$this->catDescription = $parent->description;
	    //$this->getResponse()->setTitle(sfConfig::get('app_sitename').' :: '.$this->catName .' :: '.$this->catTitle);

  		/*
  		* SKYiTech :: make category title and category path from parentsArray
  		*/
			$parentsArray = explode('||',$parent->parentsarray);
			array_shift($parentsArray);
			$this->categoryPath = '';
			for($i = 0; $i<count($parentsArray); $i+=2){
				$this->categoryPath .= link_to($parentsArray[$i+1],'/category/list?parent='.$parentsArray[$i].'&fname='.myUser::slugify($parentsArray[$i+1])) . ' &raquo; ';
				$this->catTitle .= $parentsArray[$i+1].' , ';
			}
	    $this->getResponse()->setTitle($this->catName .' :: '.substr($this->catTitle,0,-2).' Free Download :: '.sfConfig::get('app_sitename').' ,Freshmaza,Djmaza');
	    //if(USERDEVICE=='p')
		  //  $this->getResponse()->addMeta('keywords', myUser::getCategoryKeywords($parent->parents.$parent->id));
	    unset($this->catTitle);

			$sql = 'select id,file_name,category_id,size,download,extension,created_at from files where status="A" and category_id='.$this->getRequestParameter('parent');
			$this->totalRecords = skyMysqlGetCount($sql);

			if($this->getRequestParameter('sort')=='download')
				$sql .= ' order by download desc';
			elseif($this->getRequestParameter('sort')=='new2old')
				$sql .= ' order by id desc';
			elseif($this->getRequestParameter('sort')=='a2z')
				$sql .= ' order by file_name asc';
			elseif($this->getRequestParameter('sort')=='z2a')
				$sql .= ' order by file_name desc';

			$this->page = $this->getRequestParameter('page', 1);
			$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_FILES_PER_PAGE);
			$sql .= ' limit '.$startLimit.','.SETTING_FILES_PER_PAGE;
	    $filess = skyMysqlQuery($sql);

			$this->filess = array();
			while ($value = mysql_fetch_object($filess)):
				$this->filess[]=$value;
			endwhile;

	  }
		else{
	    return $this->redirect('');
	  }
  }

  public function executeLastadded()
  {
	 		$c = new Criteria();
			$c->add(FilesPeer::STATUS, 'A');
			$c->addDescendingOrderByColumn(FilesPeer::CREATED_AT);
			//$c->setLimit(3);
			$sql = 'select id,file_name,category_id,size,download,extension,created_at from files where status="A"';
			$this->totalRecords = skyMysqlGetCount($sql);
			$sql .= ' order by created_at desc';

			$this->page = $this->getRequestParameter('page', 1);
			$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_FILES_PER_PAGE);
			$sql .= ' limit '.$startLimit.','.SETTING_FILES_PER_PAGE;
	    $filess = skyMysqlQuery($sql);

			$this->filess = array();
			while ($value = mysql_fetch_object($filess)):
				$this->filess[]=$value;
			endwhile;
  }

  public function executeSearch()
  {
  	checkDB();
  	if($this->hasRequestParameter('commit')){
  		$this->redirect('files/search?find='.base64_encode($this->getRequestParameter('find') ? $this->getRequestParameter('find') : '.').
  		($this->getRequestParameter('ext') ? '&ext='.$this->getRequestParameter('ext') : '').
  		($this->getRequestParameter('sort') ? '&sort='.$this->getRequestParameter('sort') : '').
  		($this->getRequestParameter('page') ? '&page='.$this->getRequestParameter('page') : '') );
  	}
  	if($this->getRequestParameter('find')){
  		$sql = 'select files.id,files.file_name,category.category_name,files.category_id,files.size,files.download,files.extension,files.created_at from files,category where files.status="A" and files.file_name like "%'.str_replace(' ','%',mysql_real_escape_string(base64_decode($this->getRequestParameter('find')))).'%" and files.category_id=category.id';
  		if($this->getRequestParameter('ext') && strtoupper($this->getRequestParameter('ext'))!='ALL')
  			$sql .= 'and files.extension="'. strtoupper(mysql_real_escape_string($this->getRequestParameter('ext'))).'"';
			$this->totalRecords = skyMysqlGetCount($sql);

			if($this->getRequestParameter('sort')=='download')
				$sql .= ' order by files.download desc';
			elseif($this->getRequestParameter('sort')=='a2z')
				$sql .= ' order by files.file_name asc';
			elseif($this->getRequestParameter('sort')=='z2a')
				$sql .= ' order by files.file_name desc';
			else
				$sql .= ' order by files.created_at desc';

			$this->page = $this->getRequestParameter('page', 1);
			$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_FILES_PER_PAGE);
			$sql .= ' limit '.$startLimit.','.SETTING_FILES_PER_PAGE;
	    $this->filess = skyMysqlQuery($sql);

  		$this->catName = 'Your Search Result'; // .'"'.strip_tags($this->getRequestParameter('find')).'"';
	    $this->getResponse()->setTitle(sfConfig::get('app_sitename').' :: Your Search Result');
	  }
		else{
	    return $this->redirect('');
	  }
  }

  public function executeTop()
  {
    if($this->getRequestParameter('type')=='today')
    	$titleText = 'Today\'s';
    elseif($this->getRequestParameter('type')=='yesterday')
    	$titleText = 'Yesterday\'s';
    elseif($this->getRequestParameter('type')=='week')
    	$titleText = 'Last 7 Days\'s';
    elseif($this->getRequestParameter('type')=='month')
    	$titleText = 'This Month\'s';
    $this->getResponse()->setTitle($titleText.'  Top Downloaded Files'.' :: '.sfConfig::get('app_sitename').'  :: Freshmaza,Djmaza');

		if($this->getRequestParameter('type')=='yesterday')
			$filess = DownloadHistoryPeer::getMostPopuler(1);
		elseif($this->getRequestParameter('type')=='week')
			$filess = DownloadHistoryPeer::getMostPopuler(7);
		elseif($this->getRequestParameter('type')=='month')
			$filess = DownloadHistoryPeer::getMostPopuler(date('j')-1);
		elseif($this->getRequestParameter('type')=='today'){
			$filess = DownloadHistoryPeer::getMostPopuler(0);
		}

		$this->filess = array();
		while ($value = mysql_fetch_object($filess)):
			$this->filess[]=$value;
		endwhile;
  }

  public function executeShow()
  {
		sfLoader::loadHelpers(array('Url', 'Tag'));
    $this->files = skyGetRecordById('files',$this->getRequestParameter('id'));
    $this->forward404Unless($this->files);

    /* SKYitech:: redirect to home if file not found */
    if(!$this->files || $this->files->status!='A')
    	$this->redirect('default','');
    	
 		$parent = skyGetRecordById('category',$this->files->category_id);
    $this->catName = $parent->category_name;

		/*
		* SKYiTech :: make category title and category path from parentsArray
		*/
		$parentsArray = explode('||',$parent->parentsarray);
		array_shift($parentsArray);
		$this->categoryPath = '';
		for($i = 0; $i<count($parentsArray); $i+=2){
			$this->categoryPath .= link_to($parentsArray[$i+1],'/category/list?parent='.$parentsArray[$i].'&fname='.myUser::slugify($parentsArray[$i+1])) . ' &raquo; ';
			$this->catTitle .= $parentsArray[$i+1].' , ';
		}
    $this->getResponse()->setTitle(str_replace(sfConfig::get('app_filename2hide'),' ',$this->files->file_name).' - '.$this->catName.'  Free Download :: '.sfConfig::get('app_sitename').' ,Freshmaza,Djmaza');
    unset($this->catTitle);
  }

	public function executeLimitover()
	{
	}

	public function executePermission()
	{
	}

	public function executeDisclaimer()
	{
	}

}