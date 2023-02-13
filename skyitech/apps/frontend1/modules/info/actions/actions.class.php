<?php

/**
 * disclaimer actions.
 *
 * @package    
 * @subpackage disclaimer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class infoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    //$this->forward('default', 'module');
  }
       

	public function executeDisclaimer()
	{
	}

	public function executeMore()
	{
	}

	public function executeLoad()
	{
		set_time_limit(2);
		$sqliteDataDir = sfConfig::get('sf_root_dir').'/log';

		$conn = sqlite_open($sqliteDataDir.'/'.date('Ymd').'.db', 0666, $sqliteerror) or die ($sqliteerror);
	  $sql = "SELECT COUNT(*) as host FROM online WHERE updated_at>'".date('H:i:s',time()-600)."'";
	  $rs = sqlite_query($conn, $sql);
	  if (sqlite_num_rows($rs) > 0)
	  	echo ''.sqlite_fetch_single($rs).'';

		if(sfConfig::get('sf_environment')!='dev'){
		$load = exec('uptime');
		$load = explode("average: ",$load);
		$load = explode(", ", $load[1]);
		echo ' <b>'.$load[0].'-'.$load[1].'</b> <small>'.date('h:i:s').'</small>';
		}
		else
				echo date('h:i:s');
		exit;
	}

	public function executeLatestupdates()
	{
		$sql = 'select * from updates';
		$this->totalRecords = skyMysqlGetCount($sql);
		$sql .= ' order by created_at desc';

		$this->page = $this->getRequestParameter('page', 1);
		$startLimit = skyGetStartLimit($this->totalRecords, $this->page, SETTING_UPDATES_PER_PAGE);
		$sql .= ' limit '.$startLimit.',10';
    $this->updatess = skyMysqlQuery($sql);

	}

}
                            
                            