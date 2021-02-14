<?php
include("adodb/adodb.inc.php");

$DBuser = "puser";
$DBpass = "123";
$DBserver="localhost";
$DBname = "web";

$conn = ADONewConnection('postgres');
$conn->Connect($DBserver, $DBuser, $DBpass, $DBname); 
?>