<?php
error_reporting(0);


// database connection variables
$dbconf = [
    "host"=>"localhost",
    "databasename"=>"demos",
    "username"=>"root",
    "password"=>"root"
];

// connect to the database
$db = mysqli_connect($dbconf['host'], $dbconf['username'], $dbconf['password'], $dbconf['databasename']) or die("SQL error.. Please try again later.");
