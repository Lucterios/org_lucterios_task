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
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un groupe de tâches
//@PARAM@ Organisation

//@TRANSACTION:

//@LOCK:0

function Organisation_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_task", "Organisation_APAS_AddModifyAct",$Params ,"Organisation"))!=null)
	return $ret;
$Organisation=getParams($Params,"Organisation",0);
$self=new DBObj_org_lucterios_task_Organisation();

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_task","Organisation_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un groupe de tâches";
//@CODE_ACTION@
if($Organisation>0)
	$find=$self->get($Organisation);
$self->setFrom($Params);
if ($find)
	$self->update();
else
	$self->insert();
$xfer_result->m_context = array("Organisation" => $self->id);
$xfer_result->redirectAction($self->NewAction("editer","","Fiche"));
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
