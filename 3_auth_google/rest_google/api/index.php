<?php

// loging
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include_once '../config/config.php';
include_once '../config/database.php';
include_once '../objects/job.php';

$database = new Database();
$db = $database->getConnection();
$job = new Job($db);

$google_login_url = require_google($google_client);

?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Jobs</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>

<body>
	<div class="container">
		<br />
		<br />

		<?php
		if ($google_login_url == '') {
			$_SESSION["jobs"] = $job->read();
			include('../ui/print.php');
		} else {
			echo '<div>';
			echo "Please login to view this page";
			echo "<br>";
			echo "<br>";
			echo '<a class="btn btn-primary" href=' . $google_login_url . ' role="button">Login with Google</a>';
			echo '</div>';
		}
		?>

	</div>
</body>

</html>