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
// --- Last modification: Date 10 November 2011 2:37:39 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Project.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer une liste de projects


//@LOCK:0

function Project_APAS_PrintList($Params)
{
$self=new DBObj_org_lucterios_task_Project();
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_task","Project_APAS_PrintList",$Params);
$xfer_result->Caption="Imprimer une liste de projects";
//@CODE_ACTION@
require_once "CORE/PrintListing.inc.php";
$listing=new PrintListing("Liste des projects");
$listing->Header="Liste des projects";
$listing->GridHeader[]=array("nom",95);
$listing->GridHeader[]=array("description",95);
	$self->find();
while ($self->fetch()) {
	$one_row=array();
	$one_row[]=$self->nom;
	$one_row[]=$self->description;
	$listing->GridContent[]=$one_row;
}
$xfer_result->printListing($listing);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
