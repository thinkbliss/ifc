<?php
$env = substr($_SERVER['SERVER_NAME'], 0, strpos($_SERVER['SERVER_NAME'], '.'));
switch($env) {
	case 'dev2':
                $smtp_config = array(
                        'host'       => 'mx01.amcnetworks.com',
                        'port'       => '25',
                        'auth'       => false,
                        'debug'      => 2, //0 - off, 1 - errors and messages, 2 - messages
                        'from_email' => 'wordpress@dev2.ifcfilms.com',
                        'from_name'  => 'IFC Films',
                        'content_type' => 'text/plain'
                );
                break;
        case 'stage':
                $smtp_config = array(
                        'host'       => 'ssl://smtp.aws.amcn.com',
                        'port'       => '465',
                        'auth'       => true,
                        'user'       => 'AKIAIMQJQWACAO6GL5LQ',
                        'pass'       => 'ApgdtUeUw2ax8y1JM4iqZVJEbwsm7ofjBUU9022sQ0Vi',
                        'secure'     => 'ssl',
                        'debug'      => 0, //0 - off, 1 - errors and messages, 2 - messages
                        'from_email' => 'wordpress@stage.ifcfilms.com',
                        'from_name'  => 'IFC Films',
                        'content_type' => 'text/plain'
                );
                break;
	default:
                $smtp_config = array(
                        'host'       => 'ssl://smtp.aws.amcn.com',
                        'port'       => '465',
                        'auth'       => true,
                        'user'       => 'AKIAIMQJQWACAO6GL5LQ',
                        'pass'       => 'ApgdtUeUw2ax8y1JM4iqZVJEbwsm7ofjBUU9022sQ0Vi',
                        'secure'     => 'ssl',
                        'debug'      => 0, //0 - off, 1 - errors and messages, 2 - messages
                        'from_email' => 'wordpress@ifcfilms.com',
                        'from_name'  => 'IFC Films',
                        'content_type' => 'text/plain'
                );
                break;
}

