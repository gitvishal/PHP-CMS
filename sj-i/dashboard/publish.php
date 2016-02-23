<?php
include 'session.php';

$database = new Database();
$title=&$_POST['page'];
$body=&$_POST['editor'];
$page_id=&intval($_POST['page_id']);
$parent_id=&intval($_POST['parent_id']);
$publish_date_time=&$_POST['datetimepicker'];

$query =<<<_UPDATEQUERY_
	UPDATE pages
	SET title=:title,data=:data,user_id=:user_id,
	parent_id=:parent_id,status=:status,
	publish=:publish,modified_time=:modified_time
	WHERE p_id=:p_id
_UPDATEQUERY_;

$database->query($query);
$database->bind(':title', $title);
$database->bind(':data', $body);
$database->bind(':user_id', SJ_USER_ID,PDO::PARAM_INT);
$database->bind(':parent_id',$parent_id, PDO::PARAM_INT);
$database->bind(':status',NEW_PAGE);
$database->bind(':p_id',$page_id);
$database->bind(':publish',$publish_date_time);
$database->bind(':modified_time',SJ_NOW);
$database->execute();

header("location:index.php");

?>