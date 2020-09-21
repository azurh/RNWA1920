<?php

//start session on web page
session_start();

//Include Google Client Library for PHP autoload file
require_once '../vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('REDACTED.apps.googleusercontent.com');
$google_client->setClientSecret('REDACTED');
$google_client->setRedirectUri('http://localhost:8888/rest_google/api/index.php');
$google_client->addScope('profile');
