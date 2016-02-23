<?php
$database = new Database();
$author = 'SELECT * FROM user WHERE username=:uname';
$database->query($author);
$database->bind(':uname', $_SESSION['cms_user']); 
$user = $database->single();

define("SJ_USER_ID", $user['id']);
unset($user);
unset($database);
?>