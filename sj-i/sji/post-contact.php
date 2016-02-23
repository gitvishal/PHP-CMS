<?php 
require_once "recaptcha-setup.php";
require_once "conf.php";

if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

if ($response != null && $response->success) {
	$database = new Database();
	$query =<<<_QUERY_
	 INSERT INTO contact_us 
	 (name,email,content,ph_no)
	 VALUES (:name,:email,:content,:ph_no)
_QUERY_;

	$database->query($query);
	$database->bind(':name', $_POST['fname'] ." ".$_POST['lname']);
	$database->bind(':email', $_POST['email']);
	$database->bind(':content', $_POST['message']);
	$database->bind(':ph_no',$_POST['phone']);
	$database->execute();
    echo json_encode("hello");
  }
?>