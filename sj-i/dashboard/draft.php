<?php
include 'session.php';

$database = new Database();
$title=&$_POST['title'];
$body=&$_POST['etext'];
$page_id=&intval($_POST['page_id_hidden']);
$parent_id=&intval($_POST['select_parent_id']);
$publish_date_time=&$_POST['publish'];



if ($parent_id == 0 ) $rank = RANK_1;
else {
	$parent = 'SELECT * FROM pages WHERE p_id =:parent_id';
	$database->query($parent);
	$database->bind(':parent_id', $parent_id,PDO::PARAM_INT); 
	$parent_row = $database->single();
	$rank=strval(intval($parent_row['rank']) + 1 ) ;
}

if($page_id == 0)
{
	$query =<<<_QUERY_
	 INSERT INTO pages 
	 (title,data,user_id,parent_id,status,rank,publish,creation_time,modified_time)
	 VALUES (:title,:data,:user_id,:parent_id,:status,:rank,:publish,:creation_time,:modified_time)
_QUERY_;

	$database->query($query);
	$database->bind(':title', $title);
	$database->bind(':data', $body);
	$database->bind(':user_id', SJ_USER_ID,PDO::PARAM_INT);
	$database->bind(':parent_id',$parent_id, PDO::PARAM_INT);
	$database->bind(':status',DRAFT);
	$database->bind(':rank',$rank );
	$database->bind(':publish',$publish_date_time);
	$database->bind(':creation_time',SJ_NOW);
	$database->bind(':modified_time',SJ_NOW);
	$database->execute();
	$page_id = $database->lastInsertId();

}
else
{
	$query =<<<_UPDATEQUERY_
	UPDATE pages
	SET title=:title,data=:data,user_id=:user_id,
	parent_id=:parent_id,status=:status,rank=:rank,
	publish=:publish,modified_time=:modified_time
	WHERE p_id=:p_id
_UPDATEQUERY_;

	$database->query($query);
	$database->bind(':title', $title);
	$database->bind(':data', $body);
	$database->bind(':user_id', SJ_USER_ID,PDO::PARAM_INT);
	$database->bind(':parent_id',$parent_id, PDO::PARAM_INT);
	$database->bind(':status',DRAFT);
	$database->bind(':rank',$rank);
	$database->bind(':p_id',$page_id);
	$database->bind(':publish',$publish_date_time);
	$database->bind(':modified_time',SJ_NOW);
	$database->execute();
}


echo json_encode(array('page_id'=>$page_id,
	'page'=>$title,'etext'=>$body,
	'parent_id'=>$parent_id,
	'publish'=>$publish_date_time,
	));
?>
