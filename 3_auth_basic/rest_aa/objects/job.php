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

	// gets a single job
	function readSingle()
	{
		$query = "SELECT * FROM " . $this->table_name . " WHERE job_id = :job_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':job_id', $_GET["id"]);
		$stmt->execute();
		$num = $stmt->rowCount();

		if ($num > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			extract($row);

			$job_item = array(
				"job_id" => $row['job_id'],
				"job_title" => $row['job_title'],
				"min_salary" => floatval($row['min_salary']),
				"max_salary" => floatval($row['max_salary']),
			);
			http_response_code(200);
			return json_encode($job_item);
		} else {
			http_response_code(404);
			return json_encode(
				array("error" => "No jobs found or invalid job id.")
			);
		}
	}

	// creates a new job
	function create()
	{
		$body = json_decode(file_get_contents("php://input"), true);
		$job_id = $body["job_id"];
		$job_title = $body["job_title"];
		$min_salary = $body["min_salary"];
		$max_salary = $body["max_salary"];

		// checks the validity
		if (
			!empty($job_id) &&
			!empty($job_title) &&
			!empty($min_salary) &&
			!empty($max_salary)
		) {

			$query = 'INSERT INTO ' . $this->table_name . '
				SET
				job_id = :job_id,
				job_title = :job_title,
				min_salary = :min_salary,
				max_salary = :max_salary';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':job_id', $job_id);
			$stmt->bindParam(':job_title', $job_title);
			$stmt->bindParam(':min_salary', $min_salary);
			$stmt->bindParam(':max_salary', $max_salary);

			try {
				$stmt->execute();
				http_response_code(201);
				return json_encode(array("message" => "Job was created."));
			} catch (Exception $e) {
				var_dump($e);
				http_response_code(503);
				return json_encode(array("error" => "Unable to create the job."));
			}
		} else {
			http_response_code(400);
			return json_encode(array("error" => "Unable to create the job. Data is missing."));
		}
	}

	// updates an existing job
	function update()
	{
		$body = json_decode(file_get_contents("php://input"), true);
		$job_id = $body["job_id"];
		$job_title = $body["job_title"];
		$min_salary = $body["min_salary"];
		$max_salary = $body["max_salary"];

		if (!empty($job_id)) {

			$query = 'UPDATE ' . $this->table_name . '
				SET
				job_title = :job_title,
				min_salary = :min_salary,
				max_salary = :max_salary
				WHERE
				job_id = :job_id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':job_id', $job_id);
			$stmt->bindParam(':job_title', $job_title);
			$stmt->bindParam(':min_salary', $min_salary);
			$stmt->bindParam(':max_salary', $max_salary);

			try {
				$stmt->execute();
				http_response_code(201);
				return json_encode(array("message" => "Job was updated."));
			} catch (Exception $e) {
				var_dump($e);
				http_response_code(503);
				return json_encode(array("message" => "Unable to update job"));
			}
		} else {
			http_response_code(400);
			return json_encode(array("message" => "Unable to update job. Data is missing."));
		}
	}

	function delete()
	{
		if (!empty($_GET["id"])) {
			$query = 'DELETE FROM ' . $this->table_name . ' WHERE job_id = :job_id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':job_id', $_GET["id"]);

			try {
				$stmt->execute();
				http_response_code(200);
				return json_encode(array("message" => "Job was deleted."));
			} catch (Exception $e) {
				var_dump($e);
				http_response_code(503);
				return json_encode(array("error" => "Unable to delete job."));
			}
		} else {
			http_response_code(400);
			return json_encode(
				array("error" => "Job doesn't exist or the ID is invalid.")
			);
		}
	}
}

/**
Example data:

{
  "job_id": "PHP_DEV",
  "job_title": "PHP Backend Developer",
  "min_salary": 2000,
  "max_salary": 8000
}
 */
