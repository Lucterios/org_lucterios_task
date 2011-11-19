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
// --- Last modification: Date 18 November 2011 5:05:21 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Envoie un rappel par courriel
//@PARAM@ 

function Tasks_APAS_envoyerRappel(&$self)
{
//@CODE_ACTION@
$ret="";
$self->rappel=0;
$self->update();

$Moral=new DBObj_org_lucterios_contacts_personneMorale;
$Moral->get(1);
$from=$Moral->mail;
$mail=$from;
$resp=$Moral->toText();
if ($self->owner>0) {
	$owner=$self->getField("owner");
	$mail=$owner->mail;
	$resp=$owner->toText();
}

$DBParam=new DBObj_CORE_extension_params;
$params=$DBParam->getParameters("org_lucterios_task");

$body=$params['messageRappel'];
$body=str_replace(array('##RESP##','##NUM##'),array($resp,$self->toText()),$body);
$body.='{[newline]}';
$body.=$Moral->toText().'{[newline]}';
$body.=$Moral->adresse.'{[newline]}';
$body.=$Moral->codePostal." ".$Moral->ville.'{[newline]}';
$body.=$Moral->mail.'{[newline]}';

require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
if (willMailSend() && ($mail!='')) {
	sendEMail($from,$mail,"Rappel de la tache'".$self->toText()."'",$body);
}
else {
	logAutre("sendEMail('$from','$mail','Rappel de la tache','$body')");
	$ret.=" - Envoie impossible";
}

return $ret;
//@CODE_ACTION@
}

?>
