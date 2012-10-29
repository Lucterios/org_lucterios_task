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
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer un groupe de tâches
//@PARAM@ 
//@INDEX:Organisation


//@LOCK:0

function Organisation_APAS_PrintFile($Params)
{
$self=new DBObj_org_lucterios_task_Organisation();
$Organisation=getParams($Params,"Organisation",-1);
if ($Organisation>=0) $self->get($Organisation);
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_task","Organisation_APAS_PrintFile",$Params);
$xfer_result->Caption="Imprimer un groupe de tâches";
//@CODE_ACTION@
require_once "CORE/PrintAction.inc.php";
$print_action=new PrintAction("org_lucterios_task","Organisation_APAS_Fiche",$Params);
$print_action->TabChangePage=false;
$print_action->Extended=false;
$print_action->Title="Fiche descriptive";
$xfer_result->printListing($print_action);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
