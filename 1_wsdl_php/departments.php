<?php

if (isset($_GET["country_name"])) {

  $name = $_GET['country_name'];

  try {

    $sClient = new SoapClient(
      'http://localhost:8888/wsdl/DepartmentsService.wsdl',
      array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => 1, 'exceptions' => true)
    );

    $response = $sClient->getDepartmentsByCountry($name);
  } catch (SoapFault $e) {
    $error = $e->message;
    var_dump($e);
  }
} else if (isset($_GET["region_name"])) {
  $name = $_GET['region_name'];

  try {

    $sClient = new SoapClient(
      'http://localhost:8888/wsdl/DepartmentsService.wsdl',
      array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => 1, 'exceptions' => true)
    );

    $response = $sClient->getDepartmentsByRegion($name);
  } catch (SoapFault $e) {
    $error = $e->message;
    var_dump($e);
  }
} else {
  $error = "Please provide a country or region name.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Confirmation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>

<body class="container">
  <div class="row">
    <?php
    // 
    if ($error) {
      echo '<h1>' . $error . '</h1>';
      return;
    }
    if (count($response) == 0) {
      echo '<h1>No departments found for \'' . $name . '\'</h1>';
      return;
    }
    echo '<h3>Departments for <strong>\'' . $name . '\'</strong></h3><br/><br/><br/>';
    echo '<table class="table">
      <thead>
      <tr>
      <th>Department ID</th>
      <th>Department Name</th>
      <th>City</th>
      <th>Country</th>
      <th>Region</th>
      </tr>
      </thead>';

    for ($j = 0; $j < sizeof($response); $j++) {
      echo '<tr>
        <td>' . $response[$j]["id"] . '</td>
        <td>' . $response[$j]["department"] . '</td>
        <td>' . $response[$j]["city"] . '</td>
        <td>' . $response[$j]["country"] . '</td>
        <td>' . $response[$j]["regiom"] . '</td>
        </tr>';
    }
    echo '</table>'
    ?>
  </div>
  </div>
  </div>
</body>

</html>