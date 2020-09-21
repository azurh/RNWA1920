<?php

// loging:

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/job.php';

$http_method = $_SERVER["REQUEST_METHOD"];

$database = new Database();
$db = $database->getConnection();
$job = new Job($db);

switch ($http_method) {
	case 'GET':
		echo $job->read();
		break;
	case 'POST':
		echo $job->create();
		break;
	case 'PUT':
		echo $job->update();
		break;
	case 'DELETE':
		echo $job->delete();
		break;
	default:
		// Invalid Request Method
		header("HTTP/1.0 405 Method Not Allowed");
		break;
}
