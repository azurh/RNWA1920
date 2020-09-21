<?php

if ((isset($_SESSION['logiran'])) && ($_SESSION['logiran'] = 'DA')) {
    //ako je korisnik logiran onda ga ili pustimo na ovaj dio ili cesce proslijedimo na neki default-ni dio web sjedista;
}

// session_start();
include('../config/config.php');
$login_button = '<a href="' . $google_client->createAuthUrl() . '">Login With Google</a>';
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Login using Google Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <h1>Inner HTML</h1>
    <?php
    echo '<div align="center">' . $login_button . '</div>';
    ?>
    <form action="provjera.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="username">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>