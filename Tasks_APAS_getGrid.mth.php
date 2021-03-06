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
// --- Last modification: Date 20 November 2011 12:20:29 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@getList de tache
//@PARAM@ Params
//@PARAM@ withProject=0

function Tasks_APAS_getGrid(&$self,$Params,$withProject=0)
{
//@CODE_ACTION@
$grid = new Xfer_Comp_Grid("task");
$field=array('titleColor','description','end','owner','state');
if ($withProject>0)
	$field[]='organisation';
$grid->setDBObject($self, $field,"",$Params);
$grid->addAction($self->newAction("_Editer", "edit.png", "AddModify", FORMTYPE_MODAL,CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->newAction("_Supprimer", "suppr.png", "Del", FORMTYPE_MODAL,CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->newAction("_Ajouter", "add.png", "AddModify",FORMTYPE_MODAL,CLOSE_NO, SELECT_NONE));
$grid->addAction(new Xfer_Action("_Cloner", "add.png",'org_lucterios_task',"cloner", FORMTYPE_MODAL,CLOSE_NO, SELECT_SINGLE));
$grid->setSize(200,750);
return $grid;
//@CODE_ACTION@
}

?>
