<?php 
include 'database.php';
$database = new CMSConnection();

$username =$_POST["admin"]["username"];
$pwd =$_POST["admin"]["pwd"];

$result = $database->verified($username,$pwd) ? array("success" => 1) : array("success" => 0);
print_r(json_encode($result, JSON_PRETTY_PRINT));
?>