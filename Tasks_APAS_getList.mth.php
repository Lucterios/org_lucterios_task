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
// --- Last modification: Date 10 November 2011 5:42:21 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Retourne la liste à afficher
//@PARAM@ Params

function Tasks_APAS_getList(&$self,$Params)
{
//@CODE_ACTION@
$QUERY="SELECT *,org_lucterios_task_FCT_Tasks_APAS_getValue(id) AS value FROM org_lucterios_task_Tasks WHERE ((type='n')";
$contact=new DBObj_org_lucterios_contacts_personnePhysique;
if ($contact->findConnected()) {
	$QUERY.=" OR (owner=".$contact->id.")";
}
$QUERY.=")";
if ($Params['isTerminate']!='o') {
	$QUERY.=" AND timeLast<>0";
}
$QUERY.=" ORDER BY projet,end";
$self->query($QUERY);
//@CODE_ACTION@
}

?>
