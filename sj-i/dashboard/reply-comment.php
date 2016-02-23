<!DOCTYPE html>
<html lang="en">
<?php

include_once('session.php');
if(isset($_POST['reply']))
{
    $database = new Database();
    $query =<<<_UPDATEQUERY_
    UPDATE comments
    SET response=:response,response_date=:response_date
    WHERE c_id=:c_id
_UPDATEQUERY_;
    $database->query($query);
    $database->bind(':response',$_POST['reply'] ); 
    $database->bind(':response_date',SJ_NOW );
    $database->bind(':c_id',$_POST['c_id'],PDO::PARAM_INT); 
    $database->execute();
    header("location:index.php");

}
 
 ?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SJ-ADMIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php 
        require_once "nevigation-bar.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Reply Comment Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Reply Comment Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
              <h2>Comments</h2>           
               <form class="form-inline" 
               role="form" method="post" 
               action="<?php echo $_SERVER['PHP_SELF'] ?>">
                
                 <div class="form-group" >
                 <label for="reply">Reply:</label>
                 <textarea  class="form-control" id="reply" name="reply"></textarea>
                 <input type="hidden" name="c_id" value="<?php echo $_GET['page'];?>">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>

        </div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>