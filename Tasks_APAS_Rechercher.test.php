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
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Test file write by SDK tool
// --- Last modification: Date 12 March 2012 2:49:05 By  ---


//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ 

function org_lucterios_task_Tasks_APAS_Rechercher(&$test)
{
//@CODE_ACTION@
$test->CallAction("org_lucterios_task","Tasks_APAS_AddModifyAct",array("begin"=>"2011-06-01","description"=>"Exemple pour les tests","end"=>"2011-06-30",
"isTerminate"=>"n","owner"=>"0","couleur"=>"3","state"=>"0","title"=>"Exemple de tache","type"=>"n","rappel"=>"30"),"Xfer_Container_Acknowledge");

$test->CallAction("org_lucterios_task","Tasks_APAS_AddModifyAct",array("begin"=>"2011-07-01","description"=>"Autre exemple","end"=>"2011-07-30",
"isTerminate"=>"n","owner"=>"0","couleur"=>"4","state"=>"1","title"=>"Autre","type"=>"n","rappel"=>"10"),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_Search",array(),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
//SELECT - searchSelector
$comp=$rep->getComponents('searchSelector');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de searchSelector");
$test->assertEquals("","".$comp->m_value,"Valeur de searchSelector");
$test->assertEquals(9,COUNT($comp->m_select),'Nb select de searchSelector');

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array("CRITERIA"=>"begin||4||2011-06-15||array%28%27fieldname%27%3D%3E%27begin%27%2C+%27description%27%3D%3E%27D%E9but%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27date%27%2C+%27table.name%27%3D%3E%27org_lucterios_task_Tasks.begin%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_task_Tasks%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//end||3||2011-09-15||array%28%27fieldname%27%3D%3E%27end%27%2C+%27description%27%3D%3E%27Fin%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27date%27%2C+%27table.name%27%3D%3E%27org_lucterios_task_Tasks.end%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_task_Tasks%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//couleur||8||4||array%28%27fieldname%27%3D%3E%27couleur%27%2C+%27description%27%3D%3E%27Code+couleur%27%2C+%27list%27%3D%3E%270%7C%7CNoir%3B1%7C%7CBleu%3B2%7C%7CRouge%3B3%7C%7CVert%3B4%7C%7CJaune%3B5%7C%7CViolet%3B6%7C%7COrange%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_task_Tasks.couleur%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_task_Tasks%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","IsSearch"=>"1"),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$test->assertEquals(4,$rep->getComponentCount(),'nb component');
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de task");
$headers=$comp->m_headers;
$test->assertEquals("Titre",$headers["titleColor"]->m_descript,'Header #1');
$test->assertEquals("Description",$headers["description"]->m_descript,'Header #2');
$test->assertEquals("Fin",$headers["end"]->m_descript,'Header #3');
$test->assertEquals("Responsable",$headers["owner"]->m_descript,'Header #4');
$test->assertEquals("Etat",$headers["state"]->m_descript,'Header #5');
$test->assertEquals("Groupe associé",$headers["organisation"]->m_descript,'Header #6');
$rec=$comp->m_records[101];
$test->assertEquals('{[FONT color="yellow"]}Autre{[/FONT]}',$rec["titleColor"],"Valeur de grid [101,titleColor]");
$test->assertEquals("Autre exemple",$rec["description"],"Valeur de grid [101,description]");
$test->assertEquals("30/07/2011",$rec["end"],"Valeur de grid [101,end]");
$test->assertEquals("",$rec["owner"],"Valeur de grid [101,owner]");
$test->assertEquals("En cours",$rec["state"],"Valeur de grid [101,state]");
$test->assertEquals("",$rec["organisation"],"Valeur de grid [101,organisation]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");
//@CODE_ACTION@
}

?>
