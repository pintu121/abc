<?php

/**
 * Subclass for performing query and update operations on the 'download_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DownloadHistoryPeer extends BaseDownloadHistoryPeer
{
	/*
	* SKYiTech :: @return count
	* 		return 21 files which are most downloaded for the day($limit)
	*/
	public static function getMostPopuler($day=0,$limit=21,$ext=''){
		
		if($day==0)
			if($ext)
			$sql = 'select id, file_name, today as download, extension, size, category_id from files,category where status="A" and extension="'.$ext.'" order by today desc limit '.$limit;
			else
			$sql = 'select files.id, files.file_name, category.category_name, files.today as download, files.extension, files.size, files.category_id from files,category where files.status="A" and files.category_id=category.id order by files.today desc limit '.$limit;
		else
			if($ext)
			$sql = "select files.id,files.category_id,download_history.file_id,sum(download_history.hits) as download,files.file_name,files.extension,files.size from files,download_history,category where files.extension='".$ext."' and files.id=download_history.file_id and download_history.date >= '".date('Ymd',strtotime('-'.$day.' day'))."' group by files.id order by download desc limit ".$limit;
			else
			$sql = "select files.id,files.category_id,download_history.file_id,sum(download_history.hits) as download,files.file_name,files.extension,files.size from files,download_history where files.id=download_history.file_id and download_history.date >= '".date('Ymd',strtotime('-'.$day.' day'))."' group by files.id order by download desc limit ".$limit;
		return skyMysqlQuery($sql);
	}

}
