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
// --- Last modification: Date 18 November 2011 6:25:45 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_task/Organisation.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@
//@PARAM@ 


//@LOCK:0

function menuTab($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_task","menuTab",$Params);
$xfer_result->Caption="";
//@CODE_ACTION@
global $SECURITY_LOCK;
if ($SECURITY_LOCK->isLock()==0) {
	$lab=new Xfer_Comp_LabelForm('titleTabTask');
	$lab->setLocation(0,0,6);
	$lab->setValue('{[center]}{[bold]}{[underline]}Taches courantes{[/underline]}{[/bold]}{[/center]}{[newline]}{[newline]}');
	$xfer_result->addComponent($lab);

	$lastOrganisation=-1;
	$t=mktime();
	$posY=2;
	$task_list=new DBObj_org_lucterios_task_Tasks;
	$task_list->getList();
	while($task_list->fetch()) {
		if ($lastOrganisation!=$task_list->organisation) {
			$lastOrganisation=$task_list->organisation;
			if (($task_list->organisation>0) && ($DBOrganisation->progression!='100%')) {
				$DBOrganisation=$task_list->getField('organisation');
				$lab=new Xfer_Comp_LabelForm('ProjectTitle'.$t.'-'.$DBOrganisation->id);
				$lab->setLocation($posX,$posY++,6);
				$lab->setValue('{[newline]}{[hr/]}{[center]}{[bold]}{[italic]}'.str_replace('$','&#160;',str_pad($DBOrganisation->nom,20,'$')).'{[italic]}{[/bold]}'.$DBOrganisation->progression.'{[/center]}{[hr/]}');
				$xfer_result->addComponent($lab);
			}
		}

		$lab=new Xfer_Comp_LabelForm('TaskItemTitle'.$t.'-'.$task_list->id);
		$lab->setLocation($posX,$posY,4);
		$lab->setValue('{[bold]}'.str_replace('$','&#160;',str_pad($task_list->titleColor,20,'$')).'{[/bold]}');
		$xfer_result->addComponent($lab);

		$btn=new Xfer_Comp_Button('TaskItemBtn'.$t.'-'.$task_list->id);
		$btn->setLocation($posX+5,$posY,1,2);
		$btn->setClickInfo('task',$task_list->id);
		$btn->setIsMini(true);
		$btn->setAction($task_list->newAction("", "edit.png", "Fiche", FORMTYPE_MODAL,CLOSE_NO, SELECT_SINGLE));
		$xfer_result->addComponent($btn);

		$lab=new Xfer_Comp_LabelForm('TaskItemState'.$t.'-'.$task_list->id);
		$lab->setLocation($posX+4,$posY++);
		$lab->setValue("{[center]}".$task_list->getField('state')."{[/center]}");
		$xfer_result->addComponent($lab);

		$lab=new Xfer_Comp_LabelForm('TaskItemSep'.$t.'-'.$task_list->id);
		$lab->setLocation($posX,$posY);
		$lab->setSize(10,50);
		$lab->setValue('');
		$xfer_result->addComponent($lab);

		$lab=new Xfer_Comp_LabelForm('TaskItemEnd'.$t.'-'.$task_list->id);
		$lab->setLocation($posX+1,$posY,2);
		$lab->setValue('{[italic]}Fin pour le{[/italic]} '.convertDate($task_list->end,true));
		$xfer_result->addComponent($lab);

		$lab=new Xfer_Comp_LabelForm('TaskItemOwner'.$t.'-'.$task_list->id);
		$lab->setLocation($posX+3,$posY++,2);
		if ($task_list->owner>0)
			$lab->setValue('{[underline]}Resp.{[/underline]} '.$task_list->getField('owner')->toText().'&#160;');
		else
			$lab->setValue('&#160;');
		$xfer_result->addComponent($lab);

	}

	$error='';
	$task_list=new DBObj_org_lucterios_task_Tasks;
	$task_list->query('SELECT * FROM org_lucterios_task_Tasks WHERE rappel>0 AND state<>2');
	if ($task_list->fetch()) {
		require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
		if (!willMailSend()) {
			$error.='{[newline]}&#160;-&#160;la configuration courriel est manquante.';
		}
		$filemtime = @filemtime('./conf/backgroundTask.log');
		if (!$filemtime or ((time() - $filemtime) >= (60*60))){ // log de tache de font de moins d'une heure
			$error.="{[newline]}&#160;-&#160;le mécanisme 'fond de tache' n'est pas actif.";
		}
		if ($error!='')
			$error='Des rappels sont demandés :'.$error;
	}
	$lab=new Xfer_Comp_LabelForm('errorLbl');
	$lab->setLocation($posX,$posY+100,6);
	$lab->setValue("{[font color='red']}$error{[/italic]}");
	$xfer_result->addComponent($lab);
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
