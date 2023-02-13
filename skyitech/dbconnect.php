                                <?php 
define('dbhost','localhost');          //Database Server(Usually "Localhost")
define('dbuser','mirchilo_admin');               //Database User Username
define('dbpass','Mukesh@6287');                    //Database User Password
define('dbname','mirchilo_sky');        //Database Name

function connectDB()
{
	global $conms;
  $conms = @mysql_connect(dbhost,dbuser,dbpass); //connect mysql
  if(!$conms) return false;
  $condb = @mysql_select_db(dbname);
  if(!$condb) die('Can\' connect database '. mysql_error());
  // echo '--connected--';
  return true;
}

function checkDB()
{
	global $conms;
	if (!is_resource($conms))
  	connectDB();
  // echo '--dis-connected--';
}
function closeDB()
{
	global $conms;
	if (is_resource($conms))
  	mysql_close($conms);

  // echo '--dis-connected--';
}

$sky_mysqlQueriesList = array();
function mysqlLog($sql){
	global $sky_mysqlQueriesList;
	$sky_mysqlQueriesList[]['query'] = $sql;
	return count($sky_mysqlQueriesList);
}

function mysqlLogTime($id,$time){
	global $sky_mysqlQueriesList;
	$sky_mysqlQueriesList[$id]['time'] = $time;
}

function readMysqlLog(){
	global $sky_mysqlQueriesList;
	foreach($sky_mysqlQueriesList as $value)
		echo ($value['time']).'-'.$value['query'].'<Br />';
}

function skyMysqlQuery($sql){
	global $conms;
	if (!is_resource($conms))
		connectDB();
	$result = mysql_query($sql);
	return $result;
}
/*
* Get Single Record with row number
*			echo $row[0];
*/
function skyMysqlRow($sql){
	return mysql_fetch_row(skyMysqlQuery($sql));
}

/*
* Get Single Record with assoc
*					echo $row["userid"];
*/
function skyMysqlAssoc($sql){
	return mysql_fetch_assoc(skyMysqlQuery($sql));
}

/*
* Get Single Record with object name
*			echo $row->user_id;
*/
function skyMysqlObject($sql){
	return mysql_fetch_object(skyMysqlQuery($sql));
}

/*
* return value of selected field for passed id
*/
function skyGetNameById($tableName,$fieldName,$id)
{
	$sql = 'SELECT '.$fieldName.' FROM '.$tableName.' WHERE id="'.$id.'"';
	$rowName = mysql_fetch_object(skyMysqlQuery($sql));
	return $rowName->$fieldName;
}

function skyGetRecordById($tableName,$id)
{
	$sql = 'SELECT * FROM '.$tableName.' WHERE id='.$id;
	return mysql_fetch_object(skyMysqlQuery($sql));
}

function skyMysqlCount($tableName,$criteria='')
{
	$sql = 'SELECT count(*) FROM '.$tableName;
	if($criteria)
		$sql .= ' WHERE '.$criteria;
	$rs = mysql_fetch_row(skyMysqlQuery($sql));
	return $rs[0];
}

function skyMysqlGetCount($sql)
{
	$sql = preg_replace('/select (\*|.*) from /','select count(id) from ',$sql);
	$rs = mysql_fetch_row(skyMysqlQuery($sql));
	return $rs[0];
}

/*
* This function return start limit for mysql
*		arguments (totalRecordCount, current page, resultPerPage)
*		return Start Value
*/
function skyGetStartLimit($total, $page, $perpage){
	if((($page-1) * $perpage) >= $total)
		return (floor($total - $perpage) > -1) ? floor($total - $perpage) : 0 ;
	else
		return (($page-1) * $perpage);
}
/*
* SKYiTECH:: return formatted date
*/
function skyDate($format, $time){
	return date($format, strtotime($time));
}

/*
* call this function once before calling getCountry() function
*/
global $getCountryByIpClass;
function skyEnableCountryClass(){
	global $getCountryByIpClass;
	include "include/ipclass.php";
	$getCountryByIpClass = new get_user_info;
}
/*
* skyitech:: get country name by ip
*/
function skyGetCountry($ip=''){
	global $getCountryByIpClass;
	if(!$ip)
		$ip=$_SERVER['REMOTE_ADDR'];
	$getCountryByIpClass->set_ip($ip);
	$getCountryByIpClass->dist_ip();
	$getCountryByIpClass->count_ip();
	$info = $getCountryByIpClass->search_country();
	return $info['2letters_country'];
}

?>
                            