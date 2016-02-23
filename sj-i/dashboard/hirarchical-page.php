<?php

include_once('session.php');

$database = new Database();
$parent = 'SELECT * FROM pages WHERE user_id=:author_id ORDER BY rank';
$database->query($parent);
$database->bind(':author_id', SJ_USER_ID,PDO::PARAM_INT); 
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

function addButton($value)
{
	$buttons=<<<_BUTTON_
 	<div class="btn-group">
  		<button type="button" class="btn btn-primary btn-xs del" value="{$value}" id="d_{$value}" >
  		delete
  		</button>
  		<button type="button" class="btn btn-primary btn-xs ed" value="{$value}" id="e_{$value}" >
  		edit
  		</button>
  		<button type="button" class="btn btn-primary btn-xs prev" value="{$value}" id="p_{$value}" >
  		preview
  		</button>
	</div>
_BUTTON_;

return $buttons;
}



foreach($pageFamily as $parent)
{
	$tree_page .=<<<_PARENTSTARTTAG_
	<ul>
	<li>
	<span><i class="icon-folder-open"></i> {$parent['data']['title']}</span> 
_PARENTSTARTTAG_;

	if (count($parent['child'])==0) {
		$tree_page .='<span class="label label-primary">'.$parent['data']['status'].'</span>';
		$tree_page .= addButton($parent['data']['p_id']);
	}

	foreach($parent['child'] as $child)
	{
		$tree_page .=<<<_CHILDSTARTTAG_
		<ul>
        <li>
        <span><i class="icon-leaf"></i> {$child['data']['title']}</span> 
_CHILDSTARTTAG_;

		if (count($child['child'])==0){
			$tree_page .='<span class="label label-primary">'.$child['data']['status'].'</span>';
				 
			$tree_page .= addButton($child['data']['p_id']);
				}

		foreach($child['child'] as $grand_child)
		{
			$tree_page .=<<<_GRANDCHILDSTARTTAG_
			<ul>
            <li>
            <span><i class="icon-leaf"></i> 
            {$grand_child['data']['title']}</span> 
_GRANDCHILDSTARTTAG_;
			$tree_page .='<span class="label label-primary">'.$grand_child['data']['status'].'</span>';
			$tree_page .= addButton($grand_child['data']['p_id']);
			$tree_page .=<<<_GRANDCHILDENDTAG_
            </li>
            </ul>
_GRANDCHILDENDTAG_;
		}

		$tree_page .=<<<_CHILDENDTAG_
		</li>
		</ul>
_CHILDENDTAG_;
	}

	$tree_page .=<<<_PARENTENDTAG_
	</li>
	</ul>
_PARENTENDTAG_;

}

?>