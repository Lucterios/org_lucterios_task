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
// --- Last modification: Date 12 March 2012 2:42:49 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des taches
//@PARAM@ IsSearch=0
//@PARAM@ isTerminate='n'


//@LOCK:0

function Tasks_APAS_List($Params)
{
$IsSearch=getParams($Params,"IsSearch",0);
$isTerminate=getParams($Params,"isTerminate",'n');
$self=new DBObj_org_lucterios_task_Tasks();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","Tasks_APAS_List",$Params);
$xfer_result->Caption="Liste des taches";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image("img");
$img->setLocation(0,0);
$img->setValue("task.png");
$xfer_result->addComponent($img);
$lbl=new  Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0);
$xfer_result->addComponent($lbl);
if ($IsSearch!=0) {
	$q='';
	$contact=new DBObj_org_lucterios_contacts_personnePhysique;
	if ($contact->findConnected()) {
		$q.="((type='n') OR (owner=".$contact->id."))";
	}
	else
		$q.="(type='n')";
	$self->setForSearch($Params,'organisation,end',$q);
	include_once("CORE/DBFind.inc.php");
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[newline]}{[newline]}".DBFind::getCriteriaText($self,$Params)."{[/center]}");
}
else {
	$lbl->setValue("{[center]}{[bold]}Liste des taches{[/bold]}{[/center]}");
	$self->getList($Params);

	$lbl=new  Xfer_Comp_LabelForm("isTerminatelbl");
	$lbl->setValue("Voir les taches terminées");
	$lbl->setLocation(0,2);
	$xfer_result->addComponent($lbl);
	$edt=new  Xfer_Comp_Check("isTerminate");
	$edt->setValue($isTerminate=='o');
	$edt->setLocation(1,2);
	$edt->setAction($self->NewAction('','','List',FORMTYPE_REFRESH,CLOSE_NO));
	$xfer_result->addComponent($edt);
}
$grid = $self->getGrid($Params,1);
$grid->setLocation(0,1,2);
$xfer_result->addComponent($grid);
$lbl=new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,2);
$lbl->setValue("Nombre total : ".$self->N);
$xfer_result->addComponent($lbl);
if ($IsSearch!=0)
	$xfer_result->addAction($self->NewAction("Nouvelle _Recherche","search.png","Search",FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
