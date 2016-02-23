<?php
require_once "conf.php";

$database = new Database();
$parent = 'SELECT * FROM comments WHERE p_id=:p_id';
$database->query($parent);
$database->bind(':p_id',$_GET['page'],PDO::PARAM_INT); 
$rows = $database->resultset();
$comments = "";
foreach($rows as $coment)
{
	$comments .=<<<_CMT_
	<li>
        <div class="commenterImage">
            <img src="" alt="guest"/>
            </div>
            <div class="commentText">
                <p class="">:   {$coment['comment']}</p> 
                <span class="date sub-text">     {$coment['c_date']}</span>
                
            </div>
            <p>
            <div class="commenterImage">
                <img src="" alt="sji-admin"/>
                </div>
                <div class="commentText">
                <p class="">:   {$coment['response']}</p>
                 <span class="date sub-text">   {$coment['response_date']}</span>

                </div>
            </p>
    </li>

_CMT_;

}

?>