<!DOCTYPE html>
<html lang="en">

<?php 
include 'session.php';

$database = new Database();

$parent = 'SELECT * FROM pages WHERE user_id=:author_id AND rank <>:rank AND status <> :status';
$database->query($parent);
$database->bind(':author_id', SJ_USER_ID,PDO::PARAM_INT); 
$database->bind(':rank', RANK_3);
$database->bind(':status',DRAFT);
$rows = $database->resultset();

$page='';
for ($i=0;$i< $database->rowCount();$i++)
{
    $value = $rows[$i]['p_id'];
    $title = $rows[$i]['title'];

    $page .= <<<_OPTION_
    <option value="$value">$title</option>
_OPTION_;
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
    <link rel="stylesheet" type="text/css" href="../newDateTimePeaker/jquery.datetimepicker.css"/>
    <link rel="stylesheet" type="text/css" href="../newDateTimePeaker/cs.css"/>
    <script src="../ckeditor/ckeditor.js"></script>
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
                            Add Page
    
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Add Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <div class="container-fluid">
              <div class="col-sm-9 well">
              <h2>Add Page</h2>
              <form role="form" id="publish_page" method="post" action="publish.php">
                <div class="form-group">
                  <label for="page">Page Name</label>
                  <input type="text" class="form-control" name="page" id="page" placeholder="Enter page name">
                </div>

                <div class="form-group">
                  <label for="ckeditor">Content</label>
                  <textarea class="form-control ckeditor" id="editor" name="editor" placeholder="Enter page name"></textarea>
                </div>
                <div class="form-group">
                  <label for="datetimepicker">Publish time</label>
                
                  <input type="text" class="form-control" value="" id="datetimepicker" name="datetimepicker"/>
                </div>
                <div class="form-group">
                    <label class="screen-reader-text" for="parent_id">Parent</label>
                        <select name="parent_id" id="parent_id">
                            <option value="0">(no parent)</option>
                                <?php echo "$page";?>
                        </select>
                </div>
            
                       <input type="hidden" name="page_id" id="page_id">                 
                <button type="submit" class="btn btn-default disabled">Publish</button>
              </form>
              </div>
              <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <button type="button" class="btn btn-default btn-md prev disabled">Preview</button>
                    </div>
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
    <script src="../newDateTimePeaker/build/jquery.datetimepicker.full.js"></script>
    <script src="../newDateTimePeaker/d_t.js"></script>

    <script>

    $(document).ready(function(){
        function draftData()
        {
           // var re = new RegExp("^(\d{4})/(\d{2})/(\d{2})\s(\d{2}):(\d{2})$");

            $.post("draft.php",
                {
                    'etext':CKEDITOR.instances.editor.getData(),
                    'select_parent_id':$('#parent_id').find('option:selected').attr('value'),
                    'title':$("#page").val(),
                    'page_id_hidden':$("#page_id").val(),
                    'publish':$("#datetimepicker").val(),
                },
                function(data)
                {
                    $("#page_id").val(data.page_id);
                    $("#page").val(data.page);
                    CKEDITOR.instances.editor.setData(data.etext);
                    $('#parent_id').val(data.parent_id);
                    $("#datetimepicker").val(data.publish);

                },
                "json"
                );
            $('button[type="submit"]').removeClass('disabled');
            $('.prev').removeClass('disabled');

        }

        function draftInterval() {
            draftSet = setInterval(draftData, 3000);
        }

        
        $('form input[type="text"]').one("keyup",function(){
            draftData();
            draftInterval();
        });
        $('#parent_id ,#datetimepicker').one("change",function(){
            draftData();
            draftInterval();
        });

        $('.prev').click(function(event){
                if (event.target == this){
                    $('body').append('<form id="prevForm"></form>'); 
                    $('#prevForm').attr("action","previewpage-page.php")
                    .attr("method","post")
                    .attr("target","_blank") 
                    .append('<input type="hidden" name="page_id"  value="'+$('#page_id').val()+'">')
                    .submit();
                    event.stopPropagation();
                }
            });

        

    
        
    });

    </script>

</body>

</html>
