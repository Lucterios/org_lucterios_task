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
// Test file write by SDK tool
// --- Last modification: Date 16 December 2011 0:23:33 By  ---


//@TABLES@
require_once('extensions/org_lucterios_task/Tasks.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ 

function org_lucterios_task_Tasks_APAS_AjouterModifier(&$test)
{
//@CODE_ACTION@
$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #1');
$test->assertEquals("",$act->m_extension,'Ext action #1');
$test->assertEquals("",$act->m_action,'Act action #1');
$test->assertEquals(6,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_task/images/task.png","".$comp->m_value,"Valeur de img");
//LABELFORM - titre
$comp=$rep->getComponents('titre');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titre");
$test->assertEquals("{[center]}{[bold]}Liste des taches{[/bold]}{[/center]}","".$comp->m_value,"Valeur de titre");
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de task");
$act=$comp->m_actions[0];
$test->assertEquals("_Editer",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext grid action #1');
$test->assertEquals("Tasks_APAS_AddModify",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Supprimer",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext grid action #2');
$test->assertEquals("Tasks_APAS_Del",$act->m_action,'Act grid action #2');
$act=$comp->m_actions[2];
$test->assertEquals("_Ajouter",$act->m_title,'Titre grid action #3');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext grid action #3');
$test->assertEquals("Tasks_APAS_AddModify",$act->m_action,'Act grid action #3');
$act=$comp->m_actions[3];
$test->assertEquals("_Cloner",$act->m_title,'Titre grid action #4');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext grid action #4');
$test->assertEquals("cloner",$act->m_action,'Act grid action #4');
$headers=$comp->m_headers;
$test->assertEquals("Titre",$headers["titleColor"]->m_descript,'Header #1');
$test->assertEquals("Description",$headers["description"]->m_descript,'Header #2');
$test->assertEquals("Fin",$headers["end"]->m_descript,'Header #3');
$test->assertEquals("Responsable",$headers["owner"]->m_descript,'Header #4');
$test->assertEquals("Etat",$headers["state"]->m_descript,'Header #5');
$test->assertEquals("Groupe associé",$headers["organisation"]->m_descript,'Header #5');
//LABELFORM - isTerminatelbl
$comp=$rep->getComponents('isTerminatelbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de isTerminatelbl");
$test->assertEquals("Voir les taches terminées","".$comp->m_value,"Valeur de isTerminatelbl");
//CHECK - isTerminate
$comp=$rep->getComponents('isTerminate');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de isTerminate");
$test->assertEquals(false,$comp->m_value,"Valeur de isTerminate");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_AddModify",array("isTerminate"=>"n",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Ok",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext action #1');
$test->assertEquals("Tasks_APAS_AddModifyAct",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(20,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_task/images/task.png","".$comp->m_value,"Valeur de img");
//EDIT - title
$comp=$rep->getComponents('title');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de title");
$test->assertEquals("","".$comp->m_value,"Valeur de title");
//SELECT - state
$comp=$rep->getComponents('state');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de state");
$test->assertEquals("","".$comp->m_value,"Valeur de state");
$test->assertEquals(3,COUNT($comp->m_select),'Nb select de state');
//MEMO - description
$comp=$rep->getComponents('description');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de description");
$test->assertEquals("","".$comp->m_value,"Valeur de description");
//DATE - begin
$comp=$rep->getComponents('begin');
$test->assertClass("Xfer_Comp_Date",$comp,"Classe de begin");
$test->assertEquals("","".$comp->m_value,"Valeur de begin");
//SELECT - owner
$comp=$rep->getComponents('owner');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de owner");
$test->assertEquals("","".$comp->m_value,"Valeur de owner");
$test->assertEquals(1,COUNT($comp->m_select),'Nb select de owner');
//BUTTON - NewOwer
$comp=$rep->getComponents('NewOwer');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de NewOwer");
$act=$comp->m_action;
$test->assertEquals("+",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext action btn');
$test->assertEquals("Tasks_APAS_SelectResp",$act->m_action,'Act action btn');
//DATE - end
$comp=$rep->getComponents('end');
$test->assertClass("Xfer_Comp_Date",$comp,"Classe de end");
$test->assertEquals("","".$comp->m_value,"Valeur de end");
//CHECK - type
$comp=$rep->getComponents('type');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de type");
$test->assertEquals(true,$comp->m_value,"Valeur de type");
$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"Tasks_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_task_Tasks","isTerminate"=>"n",),"Xfer_Container_Acknowledge");
//SELECT - couleur
$comp=$rep->getComponents('couleur');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de couleur");
$test->assertEquals("","".$comp->m_value,"Valeur de couleur");
$test->assertEquals(7,COUNT($comp->m_select),'Nb select de couleur');
//FLOAT - rappel
$comp=$rep->getComponents('rappel');
$test->assertClass("Xfer_Comp_FLOAT",$comp,"Classe de rappel");
$test->assertEquals("0","".$comp->m_value,"Valeur de rappel");

$test->CallAction("org_lucterios_task","Tasks_APAS_AddModifyAct",array("ORIGINE"=>"Tasks_APAS_AddModify","RECORD_ID"=>"",
"TABLE_NAME"=>"org_lucterios_task_Tasks","begin"=>"2011-06-01","description"=>"Exemple pour les tests","end"=>"2011-06-30",
"isTerminate"=>"n","owner"=>"0","couleur"=>"3","state"=>"0","title"=>"Exemple de tache","type"=>"n","rappel"=>"30"),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array(),"Xfer_Container_Custom");
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de task");
$rec=$comp->m_records[100];
$test->assertEquals('{[FONT color="green"]}Exemple de tache{[/FONT]}',$rec["titleColor"],"Valeur de grid [100,titleColor]");
$test->assertEquals("Exemple pour les tests",$rec["description"],"Valeur de grid [100,description]");
$test->assertEquals("30/06/2011",$rec["end"],"Valeur de grid [100,end]");
$test->assertEquals("",$rec["owner"],"Valeur de grid [100,owner]");
$test->assertEquals("A faire",$rec["state"],"Valeur de grid [100,state]");
$test->assertEquals("",$rec["organisation"],"Valeur de grid [100,organisation]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_AddModify",array("isTerminate"=>"n","task"=>"100",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
//FLOAT - timeLast
$comp=$rep->getComponents('state');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de timeLast");
$test->assertEquals("0","".$comp->m_value,"Valeur de timeLast");
//FLOAT - timeTotal
$comp=$rep->getComponents('couleur');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de timeTotal");
$test->assertEquals("3","".$comp->m_value,"Valeur de timeTotal");
//MEMO - description
$comp=$rep->getComponents('description');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de description");
$test->assertEquals("Exemple pour les tests","".$comp->m_value,"Valeur de description");
//DATE - begin
$comp=$rep->getComponents('begin');
$test->assertClass("Xfer_Comp_Date",$comp,"Classe de begin");
$test->assertEquals("2011-06-01","".$comp->m_value,"Valeur de begin");
//SELECT - owner
$comp=$rep->getComponents('owner');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de owner");
$test->assertEquals("","".$comp->m_value,"Valeur de owner");
$test->assertEquals(1,COUNT($comp->m_select),'Nb select de owner');
//BUTTON - NewOwer
$comp=$rep->getComponents('NewOwer');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de NewOwer");
$act=$comp->m_action;
$test->assertEquals("+",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext action btn');
$test->assertEquals("Tasks_APAS_SelectResp",$act->m_action,'Act action btn');
//DATE - end
$comp=$rep->getComponents('end');
$test->assertClass("Xfer_Comp_Date",$comp,"Classe de end");
$test->assertEquals("2011-06-30","".$comp->m_value,"Valeur de end");
//CHECK - type
$comp=$rep->getComponents('type');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de type");
$test->assertEquals(false,$comp->m_value,"Valeur de type");
$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"Tasks_APAS_AddModify","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks","isTerminate"=>"n","task"=>"100",),"Xfer_Container_Acknowledge");
//FLOAT - rappel
$comp=$rep->getComponents('rappel');
$test->assertClass("Xfer_Comp_FLOAT",$comp,"Classe de rappel");
$test->assertEquals("30","".$comp->m_value,"Valeur de rappel");

$test->CallAction("org_lucterios_task","Tasks_APAS_AddModifyAct",array("ORIGINE"=>"Tasks_APAS_AddModify","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks",
"begin"=>"2011-06-01","description"=>"Exemple pour les tests","end"=>"2011-06-30","isTerminate"=>"n","owner"=>"0","task"=>"100",
"couleur"=>"4","state"=>"1","title"=>"Exemple de tache","type"=>"n","rappel"=>'20'),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de task");
$rec=$comp->m_records[100];
$test->assertEquals("En cours",$rec["state"],"Valeur de grid [100,state]");

$test->CallAction("org_lucterios_task","Tasks_APAS_AddModifyAct",array("ORIGINE"=>"Tasks_APAS_AddModify","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks",
"begin"=>"2011-06-01","description"=>"Exemple pour les tests","end"=>"2011-06-30","isTerminate"=>"n","owner"=>"0","task"=>"100","couleur"=>"1","state"=>"2","title"=>"Exemple de tache","type"=>"n",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de task");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array("isTerminate"=>"o",),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de task");
$rec=$comp->m_records[100];
$test->assertEquals('{[FONT color="blue"]}Exemple de tache{[/FONT]}',$rec["titleColor"],"Valeur de grid [100,titleColor]");
$test->assertEquals("Exemple pour les tests",$rec["description"],"Valeur de grid [100,description]");
$test->assertEquals("30/06/2011",$rec["end"],"Valeur de grid [100,end]");
$test->assertEquals("",$rec["owner"],"Valeur de grid [100,owner]");
$test->assertEquals("Fini",$rec["state"],"Valeur de grid [100,state]");
$test->assertEquals("",$rec["organisation"],"Valeur de grid [100,organisation]");
//CHECK - isTerminate
$comp=$rep->getComponents('isTerminate');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de isTerminate");
$test->assertEquals(true,$comp->m_value,"Valeur de isTerminate");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_Del",array("isTerminate"=>"o","task"=>"100",),"Xfer_Container_DialogBox");
$test->assertEquals(2,$rep->m_type,'Type dialogue');
$test->assertEquals("Voulez vous supprimer Exemple de tache?",$rep->m_text,'Text dialogue');
$act=$rep->m_actions[0];
$test->assertEquals("Oui",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_task",$act->m_extension,'Ext action #1');
$test->assertEquals("Tasks_APAS_Del",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("Non",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->CallAction("CORE","UNLOCK",array("CONFIRME"=>"YES","ORIGINE"=>"Tasks_APAS_Del","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks","isTerminate"=>"o","task"=>"100",),"Xfer_Container_Acknowledge");

$test->CallAction("org_lucterios_task","Tasks_APAS_Del",array("CONFIRME"=>"YES","ORIGINE"=>"Tasks_APAS_Del","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks","isTerminate"=>"o","task"=>"100",),"Xfer_Container_Acknowledge");
$test->CallAction("CORE","UNLOCK",array("CONFIRME"=>"YES","ORIGINE"=>"Tasks_APAS_Del","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_task_Tasks","isTerminate"=>"o","task"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_task","Tasks_APAS_List",array("isTerminate"=>"o",),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - task
$comp=$rep->getComponents('task');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de task");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de task");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de task");
//CHECK - isTerminate
$comp=$rep->getComponents('isTerminate');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de isTerminate");
$test->assertEquals(true,$comp->m_value,"Valeur de isTerminate");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");
//@CODE_ACTION@
}

?>
