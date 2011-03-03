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
//  // table file write by SDK tool
// --- Last modification: Date 21 July 2010 9:05:04 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_task_Tasks extends DBObj_Basic
{
	var $Title="";
	var $tblname="Tasks";
	var $extname="org_lucterios_task";
	var $__table="org_lucterios_task_Tasks";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $title;
	var $description;
	var $begin;
	var $end;
	var $value;
	var $owner;
	var $type;
	var $valueGraph;
	var $__DBMetaDataField=array('title'=>array('description'=>'Titre', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>100, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>true, 'params'=>array()), 'begin'=>array('description'=>'Début', 'type'=>4, 'notnull'=>true, 'params'=>array()), 'end'=>array('description'=>'Fin', 'type'=>4, 'notnull'=>true, 'params'=>array()), 'value'=>array('description'=>'Progression', 'type'=>0, 'notnull'=>true, 'params'=>array('Min'=>0, 'Max'=>100)), 'owner'=>array('description'=>'Responsable', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_contacts_personnePhysique')), 'type'=>array('description'=>'Privé', 'type'=>3, 'notnull'=>true, 'params'=>array()), 'valueGraph'=>array('description'=>'Progression', 'type'=>12, 'notnull'=>false, 'params'=>array('MethodGet'=>'getValueGraph', 'MethodSet'=>'')));

}

?>
