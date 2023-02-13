<?php

class myUser extends sfBasicSecurityUser
{
	public static function searchExts(){
		$e['ALL'] =  'ALL';
		foreach(explode(',', SETTING_SEARCH_EXTENSIONS) as $value)
			$e[$value] = $value;
		return $e;
	}

	public static function pageNavigate($pager,$uri){
		$navigation = '';
		$seePage = '';
		if ($pager->haveToPaginate()) {

		    // Pages one by one
		    $links = array();
		    $totalPage=0;
		    foreach ($pager->getLinks() as $page) {
		      $links[] = link_to_unless($page == $pager->getPage(), $page, $uri.$page);
		      if($page == $pager->getPage())
		      	$seePage = $page;
		      $totalPage++;
		    }

		    if ($pager->getPage() != 1) {
		    	if($totalPage > 5)
			      $navigation .= link_to(image_tag('first.png', 'class=absmiddle height=16 width=16'), $uri.'1');
		      $navigation .= link_to(image_tag('previous.png', 'class=absmiddle height=16 width=16'), $uri.$pager->getPreviousPage()).' ';
		    }

		    $navigation .= join('  ', $links);

		    if ($pager->getPage() != $pager->getLastPage()) {
		      $navigation .= ' '.link_to(image_tag('next.png', 'class=absmiddle height=16 width=16'), $uri.$pager->getNextPage());
		    	if($totalPage > 5)
			      $navigation .= link_to(image_tag('last.png', 'class=absmiddle height=16 width=16'), $uri.$pager->getLastPage());
		    }
			if($seePage > 0)
				$navigation .= '<br /><span style="font-size:x-small;">Page('.$seePage.'/'. $pager->getLastPage() .')</span> ';
		}
			return $navigation;
	}

	public static function skyPageNavigate($total_no,$start,$limit,$link){
		$totalLink = 5;
		$pagination='';
		$no_of_page=ceil($total_no/$limit);


		if($start!=1){
			//$pagination = link_to('<< First', $link.'1').'';
			//$pagination = link_to(image_tag('first.png', 'class=absmiddle height=16 width=16'), $link.'1').'';
		}
	
	
		if ($start*$limit > $limit)
			$pagination .= link_to(image_tag('previous.png'), $link.($start-1)).'';
	
		$count_record=0;
		$i=1;
		if($start >= $totalLink-floor($totalLink/2))
			$i=$start-floor($totalLink/2);
	
		if($no_of_page > $totalLink)
			if(($no_of_page-$i) < $totalLink)
				$i = $i-($totalLink-($no_of_page-$i)-1);

		for (;$i<=$no_of_page;$i++)
		{
			if($start==$i)
				$pagination .= '<span class="cur">'.$i.'</span>&nbsp;';
			else
				$pagination .= link_to($i,$link.$i).'&nbsp;';
			$count_record=$count_record+1;
			if ($count_record==$totalLink)
				break;
		}

		if($start < $no_of_page)
		{
			$pagination .= link_to(image_tag('next.png'), $link.($start+1)).'';
			
		if($start > 0)
			$pagination .= '<br/>Page('.$start.'/'. $no_of_page .') ';

			//$pagination .= link_to('Last >>', $link.$no_of_page);
			//$pagination .= link_to(image_tag('last.png', 'class=absmiddle height=16 width=16'), $link.$no_of_page);
		}
		return $pagination;
	}


	public static function getDirPath($parentsArray){
		$parentsArray = explode('||',$parentsArray);
		array_shift($parentsArray);
		$categoryPath = array();
		for($i = 0; $i<count($parentsArray); $i+=2){
		$categoryPath[] = $parentsArray[$i+1];
		}
		return implode("/", $categoryPath);
	}
	
	public static function countvisit($module,$action=''){
		$visitlogdir = 'web/visitlog/'.date('Y');
		if(!is_dir($visitlogdir))
			mkdir($visitlogdir);
		$visitlogdir = 'web/visitlog/'.date('Y').'/'.date('m-d');
		if(!is_dir($visitlogdir))
			mkdir($visitlogdir);

		$sfile = $visitlogdir."/".$module."-".$action.".txt";
		$count=0;
		$count = @file_get_contents($sfile);
		$fo = @fopen($sfile, 'w');
  	@fputs($fo, $count+1);
		@fclose($fo);
	}

	public static function getc($info,$e=0){
		if($e==1)
			echo '<!-- '.base64_decode('TVdTIFNvbHV0aW9ucyA6Og==').base64_decode($info).' -->';	
		else
			echo '<!-- '.base64_decode('TVdTIFNvbHV0aW9ucyA6Og==').$info.' -->';	
	}
	
	public static function detect_mobile_device(){
	  if(preg_match('/fennec|uc browser|ucweb|android|up.browser|up.link|windows ce|iemobile|mini|mmp|symbian|midp|wap|phone|pocket|mobile|pda|psp/i',$_SERVER['HTTP_USER_AGENT'])){
	    return true;
	  }
	  if(stristr($_SERVER['HTTP_USER_AGENT'],'windows')&&!stristr($_SERVER['HTTP_USER_AGENT'],'windows ce')){
	    return false;
	  }
	  if(stristr($_SERVER['HTTP_ACCEPT'],'text/vnd.wap.wml')||stristr($_SERVER['HTTP_ACCEPT'],'application/vnd.wap.xhtml+xml')){
	    return true;
	  }
	  if(isset($_SERVER['HTTP_X_WAP_PROFILE'])||isset($_SERVER['HTTP_PROFILE'])||isset($_SERVER['X-OperaMini-Features'])||isset($_SERVER['UA-pixels'])){
	    return true;
	  }
	  $dmdarray = array('acs-'=>'acs-','alav'=>'alav','alca'=>'alca','amoi'=>'amoi','audi'=>'audi','aste'=>'aste',
	  'avan'=>'avan','benq'=>'benq','bird'=>'bird','blac'=>'blac','blaz'=>'blaz','brew'=>'brew','cell'=>'cell',
	  'cldc'=>'cldc','cmd-'=>'cmd-','dang'=>'dang','doco'=>'doco','eric'=>'eric','hipt'=>'hipt','inno'=>'inno',
	  'ipaq'=>'ipaq','java'=>'java','jigs'=>'jigs','kddi'=>'kddi','keji'=>'keji','leno'=>'leno','lg-c'=>'lg-c',
	  'lg-d'=>'lg-d','lg-g'=>'lg-g','lge-'=>'lge-','maui'=>'maui','maxo'=>'maxo','midp'=>'midp','mits'=>'mits',
	  'mmef'=>'mmef','mobi'=>'mobi','mot-'=>'mot-','moto'=>'moto','mwbp'=>'mwbp','nec-'=>'nec-','newt'=>'newt',
	  'noki'=>'noki','opwv'=>'opwv','palm'=>'palm','pana'=>'pana','pant'=>'pant','pdxg'=>'pdxg','phil'=>'phil',
	  'play'=>'play','pluc'=>'pluc','port'=>'port','prox'=>'prox','qtek'=>'qtek','qwap'=>'qwap','sage'=>'sage',
	  'sams'=>'sams','sany'=>'sany','sch-'=>'sch-','sec-'=>'sec-','send'=>'send','seri'=>'seri','sgh-'=>'sgh-',
	  'shar'=>'shar','sie-'=>'sie-','siem'=>'siem','smal'=>'smal','smar'=>'smar','sony'=>'sony','sph-'=>'sph-',
	  'symb'=>'symb','t-mo'=>'t-mo','teli'=>'teli','tim-'=>'tim-','tosh'=>'tosh','treo'=>'treo','tsm-'=>'tsm-',
	  'upg1'=>'upg1','upsi'=>'upsi','vk-v'=>'vk-v','voda'=>'voda','wap-'=>'wap-','wapa'=>'wapa','wapi'=>'wapi',
	  'wapp'=>'wapp','wapr'=>'wapr','webc'=>'webc','winw'=>'winw','winw'=>'winw','xda-'=>'xda-');
	  // check if the first four characters of the current user agent are set as a key in the array
	  if(isset($dmdarray[substr($_SERVER['HTTP_USER_AGENT'],0,4)])){
	    return true;
	  }
	}
	
	/*
	* SKYiTech :: Get category path from root dir to passed category id
	*
	*/
	public static function getCategoryPath($id){
	    $pid = CategoryPeer::retrieveByPk($id);
	    $a = (explode('|',$pid->getParents()));
	    array_shift($a);
	    array_pop($a);
	    array_reverse($a);
	    myUser::getc('Q2F0ZWdvcnkgUGF0aA==',1);
	    $path = '<a href="/category/list">Home</a> &raquo; ';
			sfLoader::loadHelpers(array('Url'));
	    foreach($a as $cid)
	    {
	    	$cname = CategoryPeer::getCategoryName($cid);
	    	$path .= '<a href="'.url_for('/category/list?parent='.$cid.'&path='.myUser::getUrlPath($cid).'&fname='.$cname).'">'.$cname.'</a> &raquo; ';
	    }
	    return $path;
	}
	
	/*
	* SKYiTech :: Get url path from root dir to passed category id
	*							used in all category or file link
	*/
	public static function getUrlPath($id){
	    $pid = CategoryPeer::retrieveByPk($id);

			/*
			* SKYiTech :: if root dir, return with home
			*/
	    if($pid->getParents() == '|')
	    	return 'home';
	    	
	    $a = (explode('|',$pid->getParents()));
	    array_shift($a);
	    array_pop($a);
	    array_reverse($a);
	    $path = '';
	    foreach($a as $cid)
	    {
	    	$cname = CategoryPeer::getCategoryName($cid);
	    	$path .= str_replace(' ','_',$cname).'_';
	    }
	    return substr($path,0,-1);
	}
	
	public static function slugify($str){
		$str = str_replace(' ','_',$str);
		$str = str_replace(array('\'', '"', '&'),'',$str);
		return strtolower($str);
	}

	public static function removeSameWords($str){
		$str = myUser::slugify($str);
		$str = explode('_',$str);
		$str = array_unique($str);
		return implode('_',$str);
	}


	/*
	* SKYiTech :: this function return keywords of passed ids
	*						require $parentids = "|12|2324|34545|3453|" ($category->getParents())
	*						return keywords list of passed ids
	*/
	public static function getCategoryKeywords($parentids){
		$parentids = explode('|',$parentids);
		$keywords = '';
	 	$c = new Criteria();
	  $c->addSelectColumn(CategoryPeer::KEYWORDS);
		$c->add(CategoryPeer::ID, $parentids ,Criteria::IN);
		//print_r(CategoryPeer::doSelectRs($c)); 
		$rs = CategoryPeer::doSelectRs($c);
		while($rs->next()){
			$keywords .= $rs->getString(1);
		}
		return $keywords;
	}



	/*
	* SKYiTech :: this function return keywords of passed ids
	*						require $parentids = "|12|2324|34545|3453|" ($category->getParents())
	*						return keywords list of passed ids
	*/
	public static function getFileKeywords($fname, $ftype){
		$fname = substr($fname,0,strpos($fname,sfConfig::get('app_filename2hide')));
		$ftype = strtolower($ftype);
		$keywords = $fname;
		$keywords .= ', ';
		$keywords .= 'free '.$fname;
		$keywords .= ', ';
		$keywords .= 'free download '.$fname;
		$keywords .= ', ';
		$keywords .= 'free '.$fname.' '.$ftype.' download';
		$keywords .= ', ';
		$keywords .= 'download '.$fname;
		$keywords .= ', ';
		$keywords .= 'download '.$ftype.' file';
		$keywords .= ', ';
		$keywords .= $ftype.' file download';
		$keywords .= ', ';
		$keywords .= 'download free '.$fname;
		$keywords .= ', ';
		$keywords .= 'Free Mp3 Songs,New Bollywood Songs, Free Ringtones, Free Wallpapers, Free Games, Free Mobile, Free Mp3 Songs, Free Themes, Free Videos '.$fname.$catName;
		$keywords .= ', ';
		$keywords .= $fname;
		$keywords .= ', ';
		return $keywords;
	}


	/*
	* SKYiTech :: get online visitors at present
	*						require -
	*						return total number of online visitors
	*/
	public static function getOnlineVisitors($count=false){
		$sql = "SELECT * FROM online WHERE ip='".$_SERVER['REMOTE_ADDR']."' AND browser='".md5($_SERVER['HTTP_USER_AGENT'])."' LIMIT 1";
		if($visitors = skyMysqlObject($sql))
		{
			if($visitors->updated_at < date('Y-m-d H:i:s', time() - (sfConfig::get('app_onlinetime')/2)))
			{
				//setOnpage = $_SERVER['REQUEST_URI'];
				$sql = "UPDATE online SET updated_at = '".date('Y-m-d H:i:s',time())."' WHERE id=".$visitors->id;
				skyMysqlQuery($sql);
			}
		}
		else{
			//setOnpage = $_SERVER['REQUEST_URI'];
	    //$cinfo = myClass::countryCityFromIP($_SERVER['REMOTE_ADDR']);
	    //$visitors->setCountry($cinfo['country']);
	    //$visitors->setFlag($cinfo['country_code']);
			$sql = "INSERT INTO online (ip,browser,updated_at) VALUES('".$_SERVER['REMOTE_ADDR']."','".md5($_SERVER['HTTP_USER_AGENT'])."',now())";
			skyMysqlQuery($sql);
		}
		/*
		* SKYiTech:: define current country
		*/
		define('CountryFlag','IN');
		
		unset($visitors);
		if($count){
			include_partial('global/online');
		}
		return true;
	}

}

                            