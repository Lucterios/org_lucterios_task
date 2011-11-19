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
// --- Last modification: Date 18 November 2011 2:22:34 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Voir un tache
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function Tasks_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBObject($self,"titleColor",true,$posY,$posX,2);
$xfer_result->setDBObject($self,"state",true,$posY++,$posX+3);
$xfer_result->setDBObject($self,"description",true,$posY++,$posX,5);
$xfer_result->setDBObject($self,"begin",true,$posY,$posX,2);
$xfer_result->setDBObject($self,"owner",true,$posY++,$posX+3);
$xfer_result->setDBObject($self,"end",true,$posY,$posX,2);
if ($self->organisation>0)
	$xfer_result->setDBObject($self,"organisation",true,$posY++,$posX+3,2);
else
	$xfer_result->setDBObject($self,"type",true,$posY++,$posX+3);
$xfer_result->setDBObject($self,"rappel",true,$posY++,$posX,2);
return $xfer_result;
//@CODE_ACTION@
}

?>
