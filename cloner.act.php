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
// --- Last modification: Date 18 November 2011 5:42:55 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Organisation.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Cloner
//@PARAM@ task=0
//@PARAM@ Organisation=0


//@LOCK:0

function cloner($Params)
{
$task=getParams($Params,"task",0);
$Organisation=getParams($Params,"Organisation",0);
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","cloner",$Params);
$xfer_result->Caption="Cloner";
//@CODE_ACTION@
$img=new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
if ($task>0)
	$img->setValue("task.png");
else
	$img->setValue("organisation.png");
$xfer_result->addComponent($img);

$select=array(''=>'Aucun','+1 week'=>'1 semaine','+2 week'=>'2 semaine','+3 week'=>'3 semaine','+1 month'=>'1 mois','+3 month'=>'3 mois','+6 month'=>'6 mois','+1 year'=>'1 an');
$lbl=new Xfer_Comp_LabelForm('typelbl');
$lbl->setValue("{[bold]}Décalage temporel{[/bold]}");
$lbl->setLocation(1,1);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Select('timeOffset');
$edt->setValue(0);
$edt->setSelect($select);
$edt->setLocation(1,2);
$xfer_result->addComponent($edt);

$xfer_result->addAction(new Xfer_Action("_OK", "ok.png",'org_lucterios_task',"cloneAct"));
$xfer_result->addAction(new Xfer_Action("_Annuler", "cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
