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
	 INSERT INTO comments 
	 (name,comment,p_id,c_date)
	 VALUES (:name,:comment,:p_id,:c_date)
_QUERY_;

	$database->query($query);
	$database->bind(':name', 'guest');
	$database->bind(':comment', $_POST['comment']);
	$database->bind(':p_id', $_POST['page']);
	$database->bind(':c_date', SJ_NOW);
	$database->execute();
    echo json_encode("hello");
  }
?>