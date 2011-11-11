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
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Event file write by SDK tool
// --- Last modification: Date 10 November 2011 6:44:07 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Evenement relatif au signal 'Evenement lancer régulièrement par CRON' de 'CORE'
//@PARAM@ logContent

function org_lucterios_task_APAS_TIME_EVENT(&$logContent)
{
//@CODE_ACTION@
$Q="SELECT * FROM org_lucterios_task_Tasks WHERE rappel>0 AND timeLast>0 AND ((TO_DAYS(end)-TO_DAYS(now()))<=rappel)";
$DBTask=new DBObj_org_lucterios_task_Tasks;
$DBTask->query($Q);
while ($DBTask->fetch()) {
	$ret=$DBTask->envoyerRappel();
	$logContent.="Rappel de la tache '".$DBTask->toText()."' : $ret\n";
}
//@CODE_ACTION@
}

?>
