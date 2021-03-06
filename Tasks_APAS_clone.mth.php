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
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Method file write by SDK tool
// --- Last modification: Date 23 April 2012 1:57:32 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Cloner
//@PARAM@ timeOffset
//@PARAM@ newOrganisation=0

function Tasks_APAS_clone(&$self,$timeOffset,$newOrganisation=0)
{
//@CODE_ACTION@
$DBTask=new DBObj_org_lucterios_task_Tasks;
$DBTask->title=$self->title;
$DBTask->description=$self->description;
$DBTask->begin=date("Y-m-d",strtotime(date("Y-m-d", strtotime($self->begin)).$timeOffset));
$DBTask->end=date("Y-m-d",strtotime(date("Y-m-d", strtotime($self->end)).$timeOffset));
$DBTask->state=0;
$DBTask->owner=$self->owner;
$DBTask->type=$self->type;
$DBTask->rappel=$self->rappel;
$DBTask->couleur=$self->couleur;
if ($newOrganisation==0)
	$DBTask->organisation=$self->organisation;
else
	$DBTask->organisation=$newOrganisation;
$DBTask->insert();
return $DBTask->id;
//@CODE_ACTION@
}

?>
