<?php

/**
 * Subclass for performing query and update operations on the 'files' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FilesPeer extends BaseFilesPeer
{
	public static function getFileCount($cid='',$child='F'){
		$c = new Criteria();
		$c->add(FilesPeer::STATUS,1);
		$c->add(FilesPeer::CATEGORY_ID,$cid);
		return FilesPeer::doCount($c);
	}


	public static function getRandomFile($limit=2){
		$c = new Criteria();
		$c->add(FilesPeer::STATUS,'A');
		$c->add(FilesPeer::CREATED_AT,date('Y-m-d h:s:i',time()-(60*60*24*7)), Criteria::GREATER_THAN);
		$c->add(FilesPeer::DOWNLOAD,SettingPeer::getSetting('randomfile_must_downloaded'), Criteria::GREATER_THAN);
		$c->addAscendingOrderByColumn('RAND()');
		$c->setLimit($limit);
		return FilesPeer::doSelect($c);
	}

	public static function getFileInfo($id){
		$filesss = FilesPeer::retrieveByPk($id);
		return $filesss;
	}

	public static function getFilesById($ids){
		$filesss = FilesPeer::retrieveByPks($ids);
		return $filesss;
	}
}
