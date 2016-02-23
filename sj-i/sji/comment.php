<div class="detailBox col-md-4">
    <div class="titleBox">
      <label>Comment Box</label>
        
    </div>
    <div class="commentBox">
        
        <p class="taskDescription">COMMENTS</p>
    </div>
    <div class="actionBox">
        <ul class="commentList">
            <?php require_once "comment-list.php";
                echo $comments;
             ?>
        </ul>
        <form class="form-inline" role="form" id="comt" method="post" action="post-comment.php">
            <div class="form-group">
                <input class="form-control" type="text" name="comment" placeholder="Your comments" />
                <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
            </div>
            <div class="form-group"></div>
            
            <div class="form-group">
            </div>
                <div id="recaptcha2"></div>
                <button type="submit" class="btn btn-default">Add</button>
            </div>
        </form>
    </div>
</div>

<script>

$(document).ready(function() 
{
    $('#comt').submit(function(event) 
    {
        $.post("post-comment.php",
            $(this).serialize(),
            function(data)
            {
                alert("we will respond to your comment as soon as possible");
            },
            "json")
        .fail(function() 
        {
            alert( "error while submitting" );
        });
        event.preventDefault();
    });
});
</script>