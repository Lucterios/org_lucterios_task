<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Action file write by SDK tool
// --- Last modification: Date 24 February 2011 20:18:50 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@
//@PARAM@ 


//@LOCK:0

function menuTab($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","menuTab",$Params);
$xfer_result->Caption="";
//@CODE_ACTION@
$lab=new Xfer_Comp_LabelForm('titleTabTask');
$lab->setLocation(0,0,3);
$lab->setValue('{[center]}{[bold]}{[underline]}Taches courrantes{[/underline]}{[/bold]}{[/center]}');
//$xfer_result->addComponent($lab);

$t=mktime();
$posY=2;
$task_list=new DBObj_org_lucterios_task_Tasks;
$task_list->getList();
while($task_list->fetch()) {
	$lab=new Xfer_Comp_LabelForm('TaskItemTitle'.$t.'-'.$task_list->id);
	$lab->setLocation($posX,$posY);
	$lab->setValue('{[center]}{[bold]}'.str_replace('$','&#160;',str_pad($task_list->title,20,'$')).'{[/bold]}{[/center]}');
	$xfer_result->addComponent($lab);

	$btn=new Xfer_Comp_Button('TaskItemBtn'.$t.'-'.$task_list->id);
	$btn->setLocation($posX+3,$posY,1,3);
	$btn->setClickInfo('task',$task_list->id);
	$btn->setIsMini(true);
	$btn->setAction($task_list->newAction("", "edit.png", "AddModify", FORMTYPE_MODAL,CLOSE_NO, SELECT_SINGLE));
	$xfer_result->addComponent($btn);

	$lab=new Xfer_Comp_LabelForm('TaskItemProgress'.$t.'-'.$task_list->id);
	$lab->setLocation($posX+2,$posY++);
	$lab->setValue($task_list->getValueGraph());
	$xfer_result->addComponent($lab);

	$lab=new Xfer_Comp_LabelForm('TaskItemEnd'.$t.'-'.$task_list->id);
	$lab->setLocation($posX+2,$posY++);
	$lab->setValue('{[italic]}Fin pour le{[/italic]} '.convertDate($task_list->end,true));
	$xfer_result->addComponent($lab);

	$lab=new Xfer_Comp_LabelForm('TaskItemOwner'.$t.'-'.$task_list->id);
	$lab->setLocation($posX+2,$posY++);
	if ($task_list->owner>0)
		$lab->setValue('{[underline]}Resp.{[/underline]} '.$task_list->getField('owner')->toText().'{[newline]}&#160;');
	else
		$lab->setValue('&#160;');

	$xfer_result->addComponent($lab);
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
