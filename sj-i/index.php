<?php 
session_start();
if( isset( $_SESSION['cms_user'] ) ) {

	header("location:dashboard/index.php");
	exit();
}
		


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DASHBOARD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
	.top-panel {margin-top: 50px;}
</style>
</head>
<body>

<div class="container text-center">
  <div class="panel panel-default col-sm-offset-2 col-sm-8 top-panel">
  <h3 >LOGIN ADMIN</h3>
  <div class="well well-lg">
  <?php 
  if ($_POST["username"] && $_POST["pwd"])
  {
  	include 'database.php';
	$database = new CMSConnection();

	$username =$_POST["username"];
	$pwd =$_POST["pwd"];

	$result = $database->verified($username,$pwd) ? 1 : 0;
	if ($result)
	{

		if( !isset( $_SESSION['cms_user'] ) ) 
			$_SESSION['cms_user'] = $username;
		header("location:dashboard/index.php");
		exit();
	}
	else
		print "<div >invalid username or password</div>";

  }
	
?>
  <form class="form-horizontal" role="form" name="admin" id="admin" method="post" action="<?php $_PHP_SELF ?>">
    <div class="form-group">
      <label class="control-label col-sm-offset-2 col-sm-2 " for="username">Username:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-offset-2 col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-5">          
        <input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password" required>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
  </div>
  </div>
</div>
</body>
</html>