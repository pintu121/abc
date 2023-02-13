<?php

/**
 * category actions.
 *
 * @package    
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class categoryActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }

  public function executeList()
  {
		sfLoader::loadHelpers(array('Url', 'Tag'));
		$this->parent = '';
		$this->parentName = '';
		$this->categoryPath = '';
  	if($this->getRequestParameter('parent')){
  		$this->parent = $this->getRequestParameter('parent');
  		$parent = skyGetRecordById('category',$this->getRequestParameter('parent'));
  		$this->catName = $parent->category_name;
			//$this->catTitle = $parent->title;
  		$this->catDescription = $parent->description;

  		/*
  		* SKYiTech :: make category title and category path from parentsArray
  		*/
			$parentsArray = explode('||',$parent->parentsarray);
			array_shift($parentsArray);
			for($i = 0; $i<count($parentsArray); $i+=2){
				$this->categoryPath .= link_to($parentsArray[$i+1],'/category/list?parent='.$parentsArray[$i].'&fname='.myUser::slugify($parentsArray[$i+1])) . ' &raquo; ';
				$this->catTitle .= $parentsArray[$i+1].' , ';
			}
	    $this->getResponse()->setTitle($this->catName .' :: '.$parent->title.' '.substr($this->catTitle,0,-2).' Free Download :: '.sfConfig::get('app_sitename').' ,Freshmaza,Djmaza');
	    unset($this->catTitle);

			$sql = 'select id,category_name,parents,child,flag_new,flag_updated,flag_hot,parentsarray,files,url from category where parents like "%|'.$this->getRequestParameter('parent').'|" and status="A"';
			$this->totalRecords = skyMysqlGetCount($sql);

			if($this->getRequestParameter('sort')=='default'){
				$sql .= ' order by ord asc, id desc';
		 	}
			elseif($this->getRequestParameter('sort')=='a2z')
				$sql .= ' order by category_name';
			else
				$sql .= ' order by id desc';

			$this->page = $this->getRequestParameter('page', 1);
			$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_CATEGORY_PER_PAGE);
			$sql .= ' limit '.$startLimit.','.SETTING_CATEGORY_PER_PAGE;
	    $categorys = skyMysqlQuery($sql);
			
			$this->categories = array();
			while ($value = mysql_fetch_object($categorys)):
				$this->categories[]=$value;
			endwhile;

	  }
  	else{
  		$this->redirect();
  	}
		
  }

  public function executeSearch()
  {
  	checkDB();
  	if($this->hasRequestParameter('commit')){
  		$this->redirect('category/search?find='.base64_encode($this->getRequestParameter('find') ? $this->getRequestParameter('find') : '.').
  		($this->getRequestParameter('ext') ? '&ext='.$this->getRequestParameter('ext') : '').
  		($this->getRequestParameter('sort') ? '&sort='.$this->getRequestParameter('sort') : '').
  		($this->getRequestParameter('page') ? '&page='.$this->getRequestParameter('page') : '') );
  	}

  	if($this->getRequestParameter('find')){
  		$this->find = mysql_real_escape_string(base64_decode($this->getRequestParameter('find')));

	    $this->getResponse()->setTitle(sfConfig::get('app_sitename').' :: Your Search Result for Album/Movie');

  		$sql = 'select id,category_name,parents,child,flag_new,flag_updated,flag_hot,parentsarray,files,url from category where status="A" and category_name like "%'.str_replace(' ','%',$this->find).'%"';
			$this->totalRecords = skyMysqlGetCount($sql);

			if($this->getRequestParameter('sort')=='default'){
				$sql .= ' order by ord asc, id desc';
		 	}
			elseif($this->getRequestParameter('sort')=='a2z')
				$sql .= ' order by category_name';
			else
				$sql .= ' order by id desc';

			$this->page = $this->getRequestParameter('page', 1);
			$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_CATEGORY_PER_PAGE);
			$sql .= ' limit '.$startLimit.','.SETTING_CATEGORY_PER_PAGE;
	    $categorys = skyMysqlQuery($sql);
			
			$this->categories = array();
			while ($value = mysql_fetch_object($categorys)):
				$this->categories[]=$value;
			endwhile;

	  }
  	else{
  		$this->redirect();
  	}

  }

} 