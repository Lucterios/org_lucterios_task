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
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// library file write by SDK tool
// --- Last modification: Date 18 November 2011 6:36:27 By  ---

//@BEGIN@
function install_org_lucterios_task($ExensionVersions)
{
// Fonction appelée en fin d'installation.
global $connect;
$connect->execute('UPDATE org_lucterios_task_Tasks SET state=1 WHERE NOT timeLast IS NULL AND NOT timeTotal IS NULL AND timeLast>0 AND timeLast<timeTotal',true);
$connect->execute('UPDATE org_lucterios_task_Tasks SET state=2 WHERE NOT timeLast IS NULL AND NOT timeTotal IS NULL AND timeLast=0 AND timeTotal>0',true);
$connect->execute('UPDATE org_lucterios_task_Tasks SET timeLast=NULL,timeTotal=NULL',true);
}
//@END@
?>
