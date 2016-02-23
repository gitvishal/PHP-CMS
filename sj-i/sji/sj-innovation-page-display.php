<?php
require_once "conf.php";
$database = new Database();

$query = 'SELECT * FROM pages WHERE p_id=:p_id';
$database->query($query);
$database->bind(':p_id', $_GET['page'],PDO::PARAM_INT);
$page = $database->single();
$tree =array($page);
$rank = intval($page['rank']);
for($i=$rank-1;$i>0;$i--)
{
	$query = 'SELECT * FROM pages WHERE p_id=:parent';
	$database->query($query);
	$database->bind(':parent', $page['parent_id'],PDO::PARAM_INT);
	$page = $database->single();
	array_push($tree,$page);

}

$tree=array_reverse($tree);

$display =<<<_SJDISPLAY_
<div class="well well-lg">
    <div class="container-fluid">
      <h1> {$tree[0]['title']}</h1>
      <p>{$tree[0]['modified_time']}</p>
      <div class="row">
    <div class="col-sm-12" style="background-color:lavender;">{$tree[0]['data']}
    </div>
      </div>
    </div>
  </div>
_SJDISPLAY_;

if (count($tree)>=2)
	$display .=<<<_SJDISPLAY1_
  <div class="well well-md">   
    <div class="container-fluid">
      <h2>{$tree[1]['title']}</h2>
      <p>{$tree[1]['modified_time']}</p>
      <div class="row">
    <div class="col-sm-12" style="background-color:lavender;">{$tree[1]['data']}</div>   
      </div>
    </div>
  </div>
_SJDISPLAY1_;

if (count($tree)>=3)
	$display .=<<<_SJDISPLAY2_
  <div class="well well-sm"> 
    <div class="container-fluid">
      <h3>{$tree[2]['title']}</h3>
      <p>{$tree[2]['modified_time']}</p>
      <div class="row">
    <div class="col-sm-12" style="background-color:lavender;">{$tree[2]['data']}</div>
      </div>
    </div>
  </div>
_SJDISPLAY2_;



?>