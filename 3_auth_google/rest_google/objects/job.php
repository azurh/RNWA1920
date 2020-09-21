<?php
class Job
{
	private $conn;
	private $table_name = "jobs";

	public $job_id;
	public $job_title;
	public $min_salary;
	public $max_salary;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// convenience encapsulating method to route the request further
	function read()
	{
		if (!empty($_GET["id"])) {
			return $this->readSingle();
		} else {
			return $this->readAll();
		}
	}

	// gets all jobs
	function readAll()
	{
		$query = "SELECT * FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$num = $stmt->rowCount();

		if ($num > 0) {
			$jobs_arr = array();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$job_item = array(
					"job_id" => $job_id,
					"job_title" => $job_title,
					"min_salary" => floatval($min_salary),
					"max_salary" => floatval($max_salary),
				);
				array_push($jobs_arr, $job_item);
			}
			http_response_code(200);
			return json_encode($jobs_arr);
		} else {
			http_response_code(404);
			return json_encode(
				array("error" => "No jobs found.")
			);
		}
	}
}
