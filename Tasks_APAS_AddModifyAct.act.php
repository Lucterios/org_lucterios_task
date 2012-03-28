<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Action file write by SDK tool
// --- Last modification: Date 28 March 2012 6:02:13 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider une tache
//@PARAM@ task

//@TRANSACTION:

//@LOCK:0

function Tasks_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_task", "Tasks_APAS_AddModifyAct",$Params ,"task"))!=null)
	return $ret;
$task=getParams($Params,"task",0);
$self=new DBObj_org_lucterios_task_Tasks();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_task","Tasks_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider une tache";
//@CODE_ACTION@
if($task>0)
	$find=$self->get($task);
$self->setFrom($Params);
if ($self->timeLast>$self->timeTotal)
	$self->timeTotal=$self->timeLast;
if ($Params['organisation']!=0)
	$self->type='n';
if ($find)
	$self->update();
else
	$self->insert();
if ($Params['owner']==0) {
	global $connect;
	$connect->execute("UPDATE org_lucterios_task_Tasks SET owner=NULL,type='n' WHERE id=".$self->id,true);
}
if ($Params['organisation']==0) {
	global $connect;
	$connect->execute("UPDATE org_lucterios_task_Tasks SET organisation=NULL WHERE id=".$self->id,true);
}
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
