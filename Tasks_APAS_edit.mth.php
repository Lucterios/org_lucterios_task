<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Method file write by SDK tool
// --- Last modification: Date 21 July 2010 9:07:44 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
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
$xfer_result->setDBObject($self,"value",false,$posY++,$posX+3);
$xfer_result->setDBObject($self,"description",false,$posY++,$posX,4);
$xfer_result->setDBObject($self,"begin",false,$posY,$posX,2);
$xfer_result->setDBObject($self,"end",false,$posY++,$posX+3);
$xfer_result->setDBObject($self,"owner",true,$posY,$posX);
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
$select=new Xfer_Comp_Select("owner");
$select->setLocation($posX+1,$posY);
$select->setSelect($sel_list);
$select->setValue($self->owner);
$type_val='<CHECK>n</CHECK>';
$select->JavaScript="
var owner=current.getValue();
if (owner!=$contact_connect) {
	parent.get('type').setEnabled(false);
	parent.get('type').setValue('$type_val');
}
else {
	parent.get('type').setEnabled(true);
}
";
$select->setSize(20,200);
$xfer_result->addComponent($select);
$bnt=new Xfer_Comp_Button('NewOwer');
$bnt->setLocation($posX+2,$posY);
$bnt->setAction($self->NewAction('+','','SelectResp',FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addComponent($bnt);

$xfer_result->setDBObject($self,"type",false,$posY++,$posX+3);
return $xfer_result;
//@CODE_ACTION@
}

?>
