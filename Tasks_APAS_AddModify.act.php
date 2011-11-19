<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// Action file write by SDK tool
// --- Last modification: Date 18 November 2011 19:06:37 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter/Modifier une tache
//@PARAM@ Organisation=0
//@INDEX:task


//@LOCK:2

function Tasks_APAS_AddModify($Params)
{
$Organisation=getParams($Params,"Organisation",0);
$self=new DBObj_org_lucterios_task_Tasks();
$task=getParams($Params,"task",-1);
if ($task>=0) $self->get($task);

$self->lockRecord("Tasks_APAS_AddModify");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","Tasks_APAS_AddModify",$Params);
$xfer_result->Caption="Ajouter/Modifier une tache";
$xfer_result->m_context['ORIGINE']="Tasks_APAS_AddModify";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if ($self->id>0)
	$xfer_result->Caption="Modifier une tache";
else
	$xfer_result->Caption="Ajouter une tache";
$img=new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("task.png");
$xfer_result->addComponent($img);
$self->setFrom($Params);
if ($Organisation>0)
	$self->organisation=$Organisation;
$xfer_result=$self->edit(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok", "ok.png", "AddModifyAct",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Annuler", "cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("Tasks_APAS_AddModify");
	throw $e;
}
return $xfer_result;
}

?>
