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
//  // Action file write by SDK tool
// --- Last modification: Date 20 July 2010 8:59:25 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Selectionner d'un contact comme responsable
//@PARAM@ contact
//@PARAM@ classname


//@LOCK:0

function Tasks_APAS_SelectRespVal($Params)
{
if (($ret=checkParams("org_lucterios_task", "Tasks_APAS_SelectRespVal",$Params ,"contact","classname"))!=null)
	return $ret;
$contact=getParams($Params,"contact",0);
$classname=getParams($Params,"classname",0);
$self=new DBObj_org_lucterios_task_Tasks();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_task","Tasks_APAS_SelectRespVal",$Params);
$xfer_result->Caption="Selectionner d'un contact comme responsable";
//@CODE_ACTION@
list($ext_name,$table_name) = split('/',$classname);
$table_name = trim($table_name);
$file="extensions/$ext_name/$table_name.tbl.php";
$class_name="DBObj_".$ext_name."_".$table_name;
include_once $file;
$DBContact=new $class_name;
$DBContact->get($contact);
$contact_id=$DBContact->getMotherId('DBObj_org_lucterios_contacts_personnePhysique');
$xfer_result->m_context['NewContact']=$contact_id;
$xfer_result->redirectAction($self->NewAction("editer","","AddModify"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
