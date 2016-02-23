<!DOCTYPE html>
<html lang="en">
<?php

include_once('session.php');
$database = new Database();
$parent = 'SELECT * FROM comments WHERE p_id IN ';
$parent .= '(SELECT p_id FROM pages WHERE user_id=:user_id)';

$database->query($parent);
$database->bind(':user_id', SJ_USER_ID,PDO::PARAM_INT); 
$rows = $database->resultset(); 
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
                            Comments Page
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Comments Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
              <h2>Comments</h2>           
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Comment</th>
                    <th>Page id</th>
                    <th>Date</th>
                    <th>Reply content</th>
                    <th>Reply date</th>
                    <th>Reply</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php
                  foreach ($rows as  $value) {
                      # code...
                    print <<<_OMNLT_
                    <tr class="info">
                    <td>{$value['name']}</td>
                    <td><textarea>{$value['comment']}</textarea></td>
                    <td>{$value['p_id']}</td>
                    <td>{$value['c_date']}</td>
                    <td><textarea>{$value['response']}</textarea></td>
                    <td>{$value['response_date']}</td>
                    <td><a href="reply-comment.php?page={$value['c_id']}">reply</a></td>
                    </tr>
_OMNLT_;

                  }


                  ?>
                </tbody>
              </table>
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
