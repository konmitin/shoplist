<?php
require("config.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On'); 


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connect = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
$connect->set_charset($DB_CHARSET);
$connect->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);