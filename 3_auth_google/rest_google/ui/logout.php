<?php

include('../config/config.php');

//Reset OAuth access token
$google_client->revokeToken($_SESSION['access_token']);
unset($_SESSION['access_token']);

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location: ../api/index.php');
