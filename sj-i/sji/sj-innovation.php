<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="contact-comment-form.css">
  <link rel="stylesheet" type="text/css" href="suckerfish.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="suckerfish.js"></script>
  <?php require_once "multiple-recaptchalib.php"; ?>
</head>
<body> 

<div class="container">
  <h1>SJ INNOVATION</h1>
  <?php include 'menu-page.php'; ?>
  <div class="container-fluid">
    <div class="row">
    <div class="wall">
    <?php 
    require_once "sj-innovation-page-display.php";
    echo $display;
    ?>
  </div>
    <?php include 'contact.php'; ?>
    <?php include 'comment.php';?>
    </div>
  </div>
</div>
</body>
</html>
