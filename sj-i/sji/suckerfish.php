<?php
require_once "conf.php";

$database = new Database();
$parent = 'SELECT * FROM pages WHERE publish <=:publish AND status <>:status ORDER BY rank';
$database->query($parent);
$database->bind(':publish', SJ_NOW);
$database->bind(':status', DRAFT);
$rows = $database->resultset(); 
$pageFamily = array();
$count = $database->rowCount();
for ($i=0;$i< $count;$i++)
{
	$child = array("data" => $rows[$i],"child" => array());
   switch ($rows[$i]['rank'])
   {
   	case "1":
   		$pageFamily[$rows[$i]['p_id']] = $child;
   		break;
   	case "2":
   		$pageFamily[$rows[$i]['parent_id']]["child"][$rows[$i]['p_id']] = $child;
   		break;
   	case "3":
   		$grand_child ='SELECT * FROM pages WHERE p_id=:parent';
   		$database->query($grand_child);
		$database->bind(':parent', $rows[$i]['parent_id'],PDO::PARAM_INT);
		$grand_father = $database->single();
		$pageFamily[$grand_father['parent_id']]["child"][$rows[$i]['parent_id']]["child"][$rows[$i]['p_id']] = $child;
   		break;
   	default:
   		throw new Exception("Ranks are other than 1,2,3 ");

   } 
}
$tree_page="";



foreach($pageFamily as $parent)
{
	$tree_page .="<li>";
	if (count($parent['child'])>0) 
		$tree_page .=<<<_SF_
		 <a class="trigger right-caret">{$parent['data']['title']}</a>
		 <ul class="dropdown-menu sub-menu">
_SF_;
	
	else
		$tree_page .=<<<_SF_
		 <a href="sj-innovation.php?page={$parent['data']['p_id']}"
		  class="sj-suckerfish" >
		 {$parent['data']['title']}</a>
_SF_;

	foreach($parent['child'] as $child)
	{
		$tree_page .="<li>";
		if (count($child['child'])>0) 
			$tree_page .=<<<_SF_
			 <a class="trigger right-caret">{$child['data']['title']}</a>
			 <ul class="dropdown-menu sub-menu">
_SF_;
		else
			$tree_page .=<<<_SF_
			 <a href="sj-innovation.php?page={$child['data']['p_id']}" 
			 class="sj-suckerfish"  >
			 {$child['data']['title']}</a>
_SF_;


		foreach($child['child'] as $grand_child)
		{
			$tree_page .="<li>";
			$tree_page .=<<<_SF_
			 <a href="sj-innovation.php?page={$grand_child['data']['p_id']}" 
			 class="sj-suckerfish" >
			 {$grand_child['data']['title']}</a>
_SF_;
			$tree_page .="</li>";
		}

		$tree_page .= (count($child['child'])>0)? "</ul></li>" : "</li>";
	}

	$tree_page .= (count($parent['child'])>0) ? "</ul></li>" : "</li>";

}

?>

