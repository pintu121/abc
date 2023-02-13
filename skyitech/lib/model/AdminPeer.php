<?php

/**
 * Subclass for performing query and update operations on the 'admin' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AdminPeer extends BaseAdminPeer
{
	/**
	 * cound record
	 * @access public
	 */
	public static function CountRecord($username,$password,$select = ''){
		$c = new Criteria();
		$c->add(AdminPeer::USERNAME,$username);
		$c->add(AdminPeer::PASSWORD,md5($password));
		if($select != '')
			return AdminPeer::doSelectOne($c);
		else
			return AdminPeer::doCount($c);
	}

}
