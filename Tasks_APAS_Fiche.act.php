<?php
// This file is part of Lucterios/Diacamma, a software developped by 'Le Sanglier du Libre' (http://www.sd-libre.fr)
// thanks to have payed a retribution for using this module.
// 
// Lucterios/Diacamma is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios/Diacamma is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Action file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fiche d'une tâche
//@PARAM@ 
//@INDEX:task


//@LOCK:2

function Tasks_APAS_Fiche($Params)
{
$self=new DBObj_org_lucterios_task_Tasks();
$task=getParams($Params,"task",-1);
if ($task>=0) $self->get($task);

$self->lockRecord("Tasks_APAS_Fiche");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","Tasks_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'une tâche";
$xfer_result->m_context['ORIGINE']="Tasks_APAS_Fiche";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
$img=new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("task.png");
$xfer_result->addComponent($img);
$xfer_result=$self->show(1,0,$xfer_result);
if ($self->state==0)
	$xfer_result->addAction($self->newAction("_Commencer", "", "Commencer", FORMTYPE_MODAL,CLOSE_YES));
if ($self->state==1)
	$xfer_result->addAction($self->newAction("_Finir", "", "Finir", FORMTYPE_MODAL,CLOSE_YES));
if ($self->state!=2)
	$xfer_result->addAction($self->newAction("_Modifier", "edit.png", "AddModify", FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("Tasks_APAS_Fiche");
	throw $e;
}
return $xfer_result;
}

?>
