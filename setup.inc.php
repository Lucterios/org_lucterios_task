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
// setup file write by SDK tool
// --- Last modification: Date 18 November 2011 19:10:45 By  ---

$extention_name="org_lucterios_task";
$extention_description="Modules de gestion de projets organisés en taches de travail {[newline]}Il permet également de suivre leur évolution.";
$extention_appli="";
$extention_famille="";
$extention_titre="Gestionnaire de projet et de taches";
$extension_libre=true;

$version_max=1;
$version_min=2;
$version_release=1;
$version_build=519;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 1, 3, 1, 3, false);
$depencies[1] = new Param_Depencies("org_lucterios_contacts", 1, 3, 1, 3, false);

$rights=array();
$rights[0] = new Param_Rigth("Visualisation",30);
$rights[1] = new Param_Rigth("Modifier",60);
$rights[2] = new Param_Rigth("Supprimer",80);
$rights[3] = new Param_Rigth("Administrer",90);
$rights[4] = new Param_Rigth("Changer",50);

$menus=array();
$menus[0] = new Param_Menu("Gestion des organisations et de taches", "Bureautique", "", "task.png", "", 30 , 0, "Gestionnaire des organisations et{[newline]}des taches associées");
$menus[1] = new Param_Menu("Liste des taches", "Gestion des organisations et de taches", "Tasks_APAS_List", "task.png", "", 10 , 0, "Gestion des taches.");
$menus[2] = new Param_Menu("Recherche de taches", "Gestion des organisations et de taches", "Tasks_APAS_Search", "tasksearch.png", "", 20 , 1, "Recherche une tache suivant des critères.");
$menus[3] = new Param_Menu("Liste des organisations", "Gestion des organisations et de taches", "Organisation_APAS_List", "organisation.png", "ctrl alt P", 5 , 0, "Gestion des organisations");
$menus[4] = new Param_Menu("Paramètrages de tache", "_Extensions (conf.)", "Param", "task.png", "", 100 , 1, "Paramètrages de tache");

$actions=array();
$actions[0] = new Param_Action("Changer les paramètres", "ChangeParams", 3);
$actions[1] = new Param_Action("Valider une organisation", "Organisation_APAS_AddModifyAct", 1);
$actions[2] = new Param_Action("Ajouter/Modifier une organisation", "Organisation_APAS_AddModify", 1);
$actions[3] = new Param_Action("Supprimer une organisation", "Organisation_APAS_Del", 2);
$actions[4] = new Param_Action("Fiche d'une organisation", "Organisation_APAS_Fiche", 0);
$actions[5] = new Param_Action("Liste des organisations", "Organisation_APAS_List", 0);
$actions[6] = new Param_Action("Imprimer une organisation", "Organisation_APAS_PrintFile", 0);
$actions[7] = new Param_Action("Paramètrages de tache", "Param", 3);
$actions[8] = new Param_Action("Valider une tache", "Tasks_APAS_AddModifyAct", 1);
$actions[9] = new Param_Action("Ajouter/Modifier une tache", "Tasks_APAS_AddModify", 1);
$actions[10] = new Param_Action("Commencer une tache", "Tasks_APAS_Commencer", 4);
$actions[11] = new Param_Action("Supprimer une tache", "Tasks_APAS_Del", 2);
$actions[12] = new Param_Action("Fiche d'une tache", "Tasks_APAS_Fiche", 0);
$actions[13] = new Param_Action("Finir une tache", "Tasks_APAS_Finir", 4);
$actions[14] = new Param_Action("Liste des taches", "Tasks_APAS_List", 0);
$actions[15] = new Param_Action("Rechercher une tache", "Tasks_APAS_Search", 0);
$actions[16] = new Param_Action("Selectionner d'un contact comme responsable", "Tasks_APAS_SelectRespVal", 3);
$actions[17] = new Param_Action("Selectionner d'un contact comme responsable", "Tasks_APAS_SelectResp", 3);
$actions[18] = new Param_Action("Cloner", "cloneAct", 1);
$actions[19] = new Param_Action("Cloner", "cloner", 1);
$actions[20] = new Param_Action("", "menuTab", 0);

$params=array();
$params["messageRappel"] = new Param_Parameters("messageRappel", "##RESP##{[newline]}{[newline]}La tache '##NUM##' de votre Diacamma arrive bientôt à échéance.{[newline]}Pensez à la terminer prochainement.", "Message de rappel", 0, array('Multi'=>true));

$extend_tables=array();
$extend_tables["Organisation"] = array("org_lucterios_task.Organisation","",array());
$extend_tables["Tasks"] = array("org_lucterios_task.Tasks","",array("org_lucterios_contacts_personnePhysique"=>"owner","org_lucterios_task_Organisation"=>"organisation",));
$signals=array();

?>