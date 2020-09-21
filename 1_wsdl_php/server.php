<?php

include_once 'database.php';

if (!extension_loaded("soap")) {
	dl("php_soap.dll");
}
ini_set("soap.wsdl_cache_enabled", "0");

$server = new SoapServer("http://localhost:8888/wsdl/DepartmentsService.wsdl", array('soap_version' => SOAP_1_2));

function getDepartmentsByCountry($country_name)
{

	$database = new Database();
	$db = $database->getConnection();

	$query = "SELECT * FROM v_departments_by_country WHERE country_name like " . "'$country_name%'";

	$stmt = $db->prepare($query);
	$stmt->execute();

	$num = $stmt->rowCount();

	$departments_arr = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$department_item = array(
			"id" => $department_id,
			"department" => $department_name,
			"city" => $city,
			"country" => $country_name,
			"regiom" => $region_name
		);

		array_push($departments_arr, $department_item);
	}

	return $departments_arr;
}

function getDepartmentsByRegion($region_name)
{

	$database = new Database();
	$db = $database->getConnection();

	$query = "SELECT * FROM v_departments_by_country WHERE region_name like " . "'$region_name%'";

	$stmt = $db->prepare($query);
	$stmt->execute();

	$num = $stmt->rowCount();

	$departments_arr = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$department_item = array(
			"id" => $department_id,
			"department" => $department_name,
			"city" => $city,
			"country" => $country_name,
			"regiom" => $region_name
		);

		array_push($departments_arr, $department_item);
	}

	return $departments_arr;
}

$server->AddFunction("getDepartmentsByCountry");
$server->AddFunction("getDepartmentsByRegion");
$server->handle();
