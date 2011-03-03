<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Method file write by SDK tool
// --- Last modification: Date 19 July 2010 9:05:50 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Recherche un tache
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function Tasks_APAS_finder(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBSearch($self,"title",$posY++);
$xfer_result->setDBSearch($self,"description",$posY++);
$xfer_result->setDBSearch($self,"begin",$posY++);
$xfer_result->setDBSearch($self,"end",$posY++);
$xfer_result->setDBSearch($self,"value",$posY++);
$xfer_result->setDBSearch($self,"owner[nom]",$posY++);
$xfer_result->setDBSearch($self,"type",$posY++);
return $xfer_result;
//@CODE_ACTION@
}

?>
