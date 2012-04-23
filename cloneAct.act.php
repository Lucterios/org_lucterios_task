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
// --- Last modification: Date 23 April 2012 2:02:01 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Organisation.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Cloner
//@PARAM@ timeOffset
//@PARAM@ task=0
//@PARAM@ Organisation=0

//@TRANSACTION:

//@LOCK:0

function cloneAct($Params)
{
if (($ret=checkParams("org_lucterios_task", "cloneAct",$Params ,"timeOffset"))!=null)
	return $ret;
$timeOffset=getParams($Params,"timeOffset",0);
$task=getParams($Params,"task",0);
$Organisation=getParams($Params,"Organisation",0);

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_task","cloneAct",$Params);
$xfer_result->Caption="Cloner";
//@CODE_ACTION@
if ($task>0) {
	$DBObj=new DBObj_org_lucterios_task_Tasks;
	$DBObj->get($task);
}
else {
	$DBObj=new DBObj_org_lucterios_task_Organisation;
	$DBObj->get($Organisation);
}
$id=$DBObj->clone($timeOffset);
if ($task>0) {
	$xfer_result->m_context['task']=$id;
	$xfer_result->redirectAction($DBObj->NewAction('','','AddModify',FORMTYPE_MODAL,CLOSE_NO));
}
else {
	$xfer_result->m_context['Organisation']=$id;
	$xfer_result->redirectAction($DBObj->NewAction('','','Fiche',FORMTYPE_MODAL,CLOSE_NO));
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
