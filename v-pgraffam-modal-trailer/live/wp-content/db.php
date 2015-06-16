<?php

add_filter ('pre_option_home', 'test_localhost');
add_filter ('pre_option_siteurl', 'test_localhost');

function test_localhost( ) {
  $SN = $_SERVER['SERVER_NAME'];

  if ($SN == 'localhost' || preg_match('/^\w+\.local$/', $SN)) {
    // allow non-ftp plugin/core updates
    //define('FS_METHOD','direct');
    
    // set site_url to override value in db
    //return "http://" . $SN . "/ifcfilms";
    return "http://" . $SN;
  }

  else return false;
}
