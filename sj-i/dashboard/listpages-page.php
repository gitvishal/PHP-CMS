<!DOCTYPE html>
<html lang="en">

<head>
<?php
include_once('session.php');
include 'hirarchical-page.php';

?>

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
    <link rel="stylesheet" type="text/css" href="tree.css">

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
                            All Page
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> All Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
                <div class="tree well">
                    <?php echo $tree_page; ?>
                </div>
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

    <script>
        $(function () {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function (e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) 
                {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
                } 
                else
                {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
                }
                e.stopPropagation();
            });

            $('.del').click(function(event){
                if (event.target == this){
                    $('body').append('<form id="deleteForm"></form>'); 
                    $('#deleteForm').attr("action","deletepages-page.php")
                    .attr("method","post") 
                    .append('<input type="hidden" name="page_id"  value="'+ event.target.value +'">')
                    .submit();
                    event.stopPropagation();
                }
            });

            $('.ed').click(function(event){
                if (event.target == this){
                    $('body').append('<form id="editForm"></form>'); 
                    $('#editForm').attr("action","editpages-page.php")
                    .attr("method","post") 
                    .append('<input type="hidden" name="page_id"  value="'+event.target.value+'">')
                    .submit();
                    event.stopPropagation();
                }
            });

            $('.prev').click(function(event){
                if (event.target == this){
                    $('body').append('<form id="prevForm"></form>'); 
                    $('#prevForm').attr("action","previewpage-page.php")
                    .attr("method","post")
                    .attr("target","_blank") 
                    .append('<input type="hidden" name="page_id"  value="'+event.target.value+'">')
                    .submit();
                    event.stopPropagation();
                }
            });
        });

    </script>

</body>

</html>
