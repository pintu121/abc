<?php

/**
 * default actions.
 *
 * @package    
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
		if(!preg_match('/mirchiloft.com|mirchiloft.sky/i',$_SERVER['HTTP_HOST']))
			exit;
				
		$this->getResponse()->setTitle(sfConfig::get('app_sitename').' :: '.SETTING_TITLE);
  }
	public function executeError404()
	{
		$this->redirect('/');
	}

	public function executeSecure()
	{
	}

	public function executeUnavailable()
	{
	}

}

                            