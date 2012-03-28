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
// --- Last modification: Date 28 March 2012 5:51:57 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@Editer un tache
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function Tasks_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$xfer_result->setDBObject($self,"title",false,$posY,$posX,2);
$xfer_result->setDBObject($self,"state",false,$posY++,$posX+3);
$xfer_result->setDBObject($self,"description",false,$posY++,$posX,5);
$xfer_result->setDBObject($self,"begin",false,$posY,$posX,2);
$xfer_result->setDBObject($self,"owner",true,$posY++,$posX+3);
$xfer_result->setDBObject($self,"end",false,$posY,$posX,2);
$xfer_result->removeComponents("owner");
$sel_list=array('0'=>'');
$contact_connect=-1;
$contact=new DBObj_org_lucterios_contacts_personnePhysique;
if ($contact->findConnected()) {
	$contact_connect=$contact->id;
	$sel_list[$contact->id]=$contact->toText();
}
if (isset($xfer_result->m_context['NewContact'])) {
	$DBOtherContact=new DBObj_org_lucterios_contacts_personnePhysique;
	$DBOtherContact->get($xfer_result->m_context['NewContact']);
	$sel_list[$DBOtherContact->id]=$DBOtherContact->toText();
}
if (!isset($sel_list[(int)$self->owner])) {
	$DBOtherContact=new DBObj_org_lucterios_contacts_personnePhysique;
	$DBOtherContact->get($self->owner);
	$sel_list[$DBOtherContact->id]=$DBOtherContact->toText();
}
$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
$DBMoral->get(1);
$DBLiaison=$DBMoral->getField('physiques');
while($DBLiaison->fetch()) {
	if (!array_key_exists($DBLiaison->physique,$sel_list)) {
		$DBOtherContact=$DBLiaison->getField('physique');
		$sel_list[$DBOtherContact->id]=$DBOtherContact->toText();
	}
}
$select_owner=new Xfer_Comp_Select("owner");
$select_owner->setLocation($posX+4,$posY-1,2);
$select_owner->setSelect($sel_list);
$select_owner->setValue($self->owner);
$select_owner->setSize(20,200);
$xfer_result->addComponent($select_owner);
$bnt=new Xfer_Comp_Button('NewOwer');
$bnt->setLocation($posX+6,$posY-1,1,2);
$bnt->setAction($self->NewAction('+','','SelectResp',FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addComponent($bnt);

if ($self->organisation>0) {
	$xfer_result->m_context['type']='n';
	$posY++;
}
else {
	$xfer_result->setDBObject($self,"type",false,$posY++,$posX+3);
	$type_val='<CHECK>n</CHECK>';
	$select_owner->JavaScript="
var owner=current.getValue();
if (owner!=$contact_connect) {
	parent.get('type').setEnabled(false);
	parent.get('type').setValue('$type_val');
}
else {
	parent.get('type').setEnabled(true);
}
";
}
$xfer_result->setDBObject($self,"couleur",false,$posY,$posX,2);
$xfer_result->setDBObject($self,"rappel",false,$posY++,$posX+3,2);
$xfer_result->setDBObject($self,"organisation",false,$posY++,$posX,2);
return $xfer_result;
//@CODE_ACTION@
}

?>
