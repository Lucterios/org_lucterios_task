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
require_once('extensions/org_lucterios_task/Organisation.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter/Modifier un groupe de tâches
//@PARAM@ 
//@INDEX:Organisation


//@LOCK:2

function Organisation_APAS_AddModify($Params)
{
$self=new DBObj_org_lucterios_task_Organisation();
$Organisation=getParams($Params,"Organisation",-1);
if ($Organisation>=0) $self->get($Organisation);

$self->lockRecord("Organisation_APAS_AddModify");
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_task","Organisation_APAS_AddModify",$Params);
$xfer_result->Caption="Ajouter/Modifier un groupe de tâches";
$xfer_result->m_context['ORIGINE']="Organisation_APAS_AddModify";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if ($self->id>0)
	$xfer_result->Caption="Modifier un groupe de tâches";
else
	$xfer_result->Caption="Ajouter un groupe de tâches";
$img=new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("organisation.png");
$xfer_result->addComponent($img);
$self->setFrom($Params);
$xfer_result=$self->edit(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok", "ok.png", "AddModifyAct",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Annuler", "cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("Organisation_APAS_AddModify");
	throw $e;
}
return $xfer_result;
}

?>
