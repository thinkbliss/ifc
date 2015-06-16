<?php
$path = trim(ABSPATH, '/');
$path_parts = explode('/', $path);
$count = count($path_parts) - 1;
unset($path_parts[$count]);
$one_above_docroot = '/'.implode('/', $path_parts);
$config_path = $one_above_docroot.'/s3-config.php';
require_once $config_path;