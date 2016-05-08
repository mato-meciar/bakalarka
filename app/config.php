<?php
require_once dirname(dirname(__FILE__)).'/app/libraries/Google/autoload.php';


define('URL_BASE', 'http://' . $_SERVER['SERVER_NAME'] . '/bakalarka');
//define('URL_BASE', 'http://localhost/');
define('CURRENT_SCHOOL_YEAR', '2016');

// MySQL
define('MYSQL_NAME', 'projekty');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_HOST', 'localhost');

$client_id = '29418959227-cea5c0a516p6nr0ef8n41mh51c4bm05h.apps.googleusercontent.com'; 
$client_secret = 'xtBaX2fXl8_FHcGbVMaEDbSk';
$redirect_uri = 'http://localhost/bakalarka/public/login/';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");

$service = new Google_Service_Oauth2($client);
