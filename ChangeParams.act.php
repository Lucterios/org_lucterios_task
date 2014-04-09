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
// --- Last modification: Date 18 November 2011 4:30:45 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Changer les paramètres
//@PARAM@ 


//@LOCK:0

function ChangeParams($Params)
{
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_task","ChangeParams",$Params);
$xfer_result->Caption="Changer les paramètres";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image('img');
$img->setValue('task.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$lab = new Xfer_Comp_LabelForm("title");
$lab->setValue("{[newline]}{[center]}{[bold]}Changer les paramètres{[/bold]}{[/center]}");
$lab->setLocation(1,0,2);
$xfer_result->addComponent($lab);

$DBParam=new DBObj_CORE_extension_params();
$ParamsDesc=array('messageRappel'=>array(1,5));
$xfer_result=$DBParam->fillCustom("org_lucterios_task",0,$ParamsDesc,$xfer_result);
$comp=$xfer_result->getComponents('messageRappel');
$comp->setSize(120,450);

$xfer_result->m_context['extensionName']="org_lucterios_task";
$xfer_result->addAction($DBParam->NewAction('_Valider','ok.png','validerModif',FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
