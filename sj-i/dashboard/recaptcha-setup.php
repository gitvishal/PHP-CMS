<?php
// grab recaptcha library
require_once "recaptchalib.php";
$secret = "6Lff3BgTAAAAAGppzUjvEfW1rjmuPsOMJqywqX9w";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

?>