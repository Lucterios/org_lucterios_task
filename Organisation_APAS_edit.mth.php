<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// Method file write by SDK tool
// --- Last modification: Date 15 December 2011 0:26:48 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Organisation.tbl.php');
//@TABLES@

//@DESC@Editer un groupe de taches
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function Organisation_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBObject($self,"nom",false,$posY++,$posX);
$xfer_result->setDBObject($self,"description",false,$posY++,$posX);
return $xfer_result;
//@CODE_ACTION@
}

?>
