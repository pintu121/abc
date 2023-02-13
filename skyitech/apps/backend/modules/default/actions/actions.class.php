<?php

/**
 * default actions.
 *
 * @package    sf_sandbox
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class defaultActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 */
	public function executeIndex()
	{
		$user = $this->getUser();
		if($user->isAuthenticated()){
			if(!$user->hasCredential('admin'))
				return $this->redirect('/default/secure');
		}else
			return $this->redirect(sfConfig::get('app_webpath').'/login/index');

	}

	public function executeError404()
	{
	}

	public function executeSecure()
	{
	}

	public function executeOnline()
	{
		/*
		$sqliteDataDir = sfConfig::get('sf_root_dir').'/log';
		if(is_file($sqliteDataDir.'/'.date('Ymd').'.db')){
			$conn = sqlite_open($sqliteDataDir.'/'.date('Ymd').'.db', 0666, $sqliteerror) or die ($sqliteerror);
		  $sql = "SELECT COUNT(*) as host FROM online WHERE updated_at>'".date('H:i:s',time()-600)."'";
		  $rs = sqlite_query($conn, $sql);

		  while($online = sqlite_fetch_array($rs,SQLITE_ASSOC))
		  	echo ' '.implode(':',$online);
			sqlite_close($conn);
		}
 		else
 			echo 'No DB';
			*/
		echo date('(h:i:s)');
		if(sfConfig::get('sf_environment')!='dev'){
			$load = exec('uptime');
			$load = explode("average: ",$load);
			$load = explode(", ", $load[1]);
			echo '('.$load[0].')';
		}
		return sfView::NONE;
	}
	
	public function executeRecalculate()
	{
		//exec('php '.sfConfig::get('sf_root_dir').'/batch/parentsArray.php');
		myUser::recalculateCategory();
		return $this->redirect($_SERVER['HTTP_REFERER'].'/msg/Category Recalculated');
	}

	public function executeClearcachefull()
	{
		if(is_dir(sfConfig::get('sf_root_dir').'/cache/frontend')){
			echo date('h:i:s').' Clearing '.sfConfig::get('sf_root_dir').'/cache/frontend'; flush();
			rename(sfConfig::get('sf_root_dir').'/cache/frontend' , sfConfig::get('sf_root_dir').'/cache/frontend_'.date('hi'));
			sfToolkit::clearGlob(sfConfig::get('sf_root_dir').'/cache/frontend_'.date('hi'));
		}
		echo '<br/>'.date('h:i:s').' - Completed'; flush();
		if(is_dir(sfConfig::get('sf_root_dir').'/cache/frontend_m')){
			echo '<br/>'.date('h:i:s').' Clearing '.sfConfig::get('sf_root_dir').'/cache/frontend_m'; flush();
			rename(sfConfig::get('sf_root_dir').'/cache/frontend_m' , sfConfig::get('sf_root_dir').'/cache/frontend_m_'.date('hi'));
			sfToolkit::clearGlob(sfConfig::get('sf_root_dir').'/cache/frontend_m_'.date('hi'));
		}
		echo '<br/>'.date('h:i:s').' - Completed'; flush();
		exit;
	}

	public function executeClearcacheconfig()
	{
		$sf_root_cache_dir = sfConfig::get('sf_root_cache_dir');
		$cache_dir = $sf_root_cache_dir.'/*/*/config';
		sfToolkit::clearGlob($cache_dir);
		echo ' - Completed.';
		exit;
	}
	
	public function executeClearcachebackend()
	{
		echo sfConfig::get('sf_root_dir').'/cache/backend';
		myUser::rmdirr(sfConfig::get('sf_root_dir').'/cache/backend');
		exit;
	}
}
