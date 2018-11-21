<?php

ini_set('display_errors', 1);
error_reporting(~0);

$serverName = "localhost";
$userName = "meme";
$userPassword = "1234";
$dbName = "lrms2";
//        $userName = "u451491817_lrms";
//        $userPassword = "u123456";
//        $dbName = "u451491817_lrms";
$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
mysqli_set_charset($conn, "utf8");
