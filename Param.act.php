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
// --- Last modification: Date 18 November 2011 4:28:18 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Paramètrages de tache
//@PARAM@ 


//@LOCK:0

function Param($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","Param",$Params);
$xfer_result->Caption="Paramètrages de tache";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image('imgParams');
$img->setValue('task.png');
$img->setLocation(0,1);
$xfer_result->addComponent($img);
$lab = new Xfer_Comp_LabelForm("titleParams");
$lab->setValue("{[newline]}{[center]}{[bold]}Paramètrages de tache{[/bold]}{[/center]}");
$lab->setLocation(1,1,5);
$xfer_result->addComponent($lab);

$DBParam=new DBObj_CORE_extension_params;
$ParamsDesc=array('messageRappel'=>array(1,5));
$xfer_result=$DBParam->fillCustom("org_lucterios_task",1,$ParamsDesc,$xfer_result);

$lab = new Xfer_Comp_Button("Params");
$lab->setValue("_Modifier");
$lab->setLocation(0,10,5);
$lab->setAction(new Xfer_Action('Modifier','edit.png','org_lucterios_task','ChangeParams',FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addComponent($lab);

//--------------------------------------------------
$xfer_result->addAction(new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
