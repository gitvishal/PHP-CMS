<?php 
include_once('session.php');
$database = new Database();
$query =<<<_QUERY_
	 DELETE FROM pages
	 WHERE p_id=:p_id AND user_id=:user_id
_QUERY_;
$database->query($query);
$database->bind(':p_id', $_POST['page_id'],PDO::PARAM_INT);
$database->bind(':user_id', SJ_USER_ID,PDO::PARAM_INT);
$database->execute(); 
header("Location:listpages-page.php"); 

?>