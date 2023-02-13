<?php

// include project configuration
include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

    if(myUser::detect_mobile_device())
        define('USERDEVICE','m');
    else
        define('USERDEVICE','p');


if(USERDEVICE=='m' && strtolower($_SERVER['HTTP_HOST'])!='mirchiloft.com')
    header('Location: http://mirchiloft.com'.$_SERVER['REQUEST_URI']);


define('success_dir', sfConfig::get('sf_app_template_dir').'/');

$sf_root_dir = sfConfig::get('sf_root_dir');
sfConfig::add(array(
  'sf_web_dir_name' => $sf_web_dir_name = '../',
  'sf_web_dir'      => $sf_root_dir.DIRECTORY_SEPARATOR.$sf_web_dir_name,
  'sf_upload_dir_name' => $sf_upload_dir_name = 'siteuploads',
  'sf_upload_dir'   => $sf_root_dir.DIRECTORY_SEPARATOR.$sf_web_dir_name.DIRECTORY_SEPARATOR.$sf_upload_dir_name,
));


include(sfConfig::get('sf_root_dir')."/".'dbconnect.php');
include(sfConfig::get('sf_upload_dir')."/".'settings.php');
include(sfConfig::get('sf_upload_dir').'/advt/'.USERDEVICE.'_mainfunctions.php');


                            
                            
                            
                            