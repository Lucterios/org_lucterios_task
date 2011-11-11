<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// table file write by SDK tool
// --- Last modification: Date 11 November 2011 10:54:44 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_task_Project extends DBObj_Basic
{
	public $Title="";
	public $tblname="Project";
	public $extname="org_lucterios_task";
	public $__table="org_lucterios_task_Project";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $nom;
	public $description;
	public $timeLast;
	public $timeTotal;
	public $progression;
	public $end;
	public $tasks;
	public $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>100, 'Multi'=>false)), 'description'=>array('description'=>'Description', 'type'=>7, 'notnull'=>true, 'params'=>array()), 'timeLast'=>array('description'=>'Durée restante (h)', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_task_FCT_Project_APAS_getTimeLast', 'NbField'=>1)), 'timeTotal'=>array('description'=>'Durée total (h)', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_task_FCT_Project_APAS_getTimeTotal', 'NbField'=>1)), 'progression'=>array('description'=>'Progression', 'type'=>12, 'notnull'=>false, 'params'=>array('MethodGet'=>'getValue', 'MethodSet'=>'getValue')), 'end'=>array('description'=>'Fin prévu', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_task_FCT_Project_APAS_getMaxEnd', 'NbField'=>1)), 'tasks'=>array('description'=>'Taches', 'type'=>9, 'notnull'=>false, 'params'=>array('TableName'=>'org_lucterios_task_Tasks', 'RefField'=>'projet')));

	public $__toText='$nom';
}

?>
