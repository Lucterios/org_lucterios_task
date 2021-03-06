<?php
// setup file write by Lucterios SDK tool

$extention_name="org_lucterios_task";
$extention_description="Modules de gestion de projets organis�s en t�ches de travail {[newline]}Il permet �galement de suivre leur �volution.";
$extention_appli="";
$extention_famille="";
$extention_titre="Gestionnaire de t�ches";
$extension_libre=true;

$version_max=1;
$version_min=3;
$version_release=1;
$version_build=617;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 1, 6, 1, 4, false);
$depencies[1] = new Param_Depencies("org_lucterios_contacts", 1, 5, 1, 3, false);

$rights=array();
$rights[0] = new Param_Rigth("Visualisation",30);
$rights[1] = new Param_Rigth("Modifier",60);
$rights[2] = new Param_Rigth("Supprimer",80);
$rights[3] = new Param_Rigth("Administrer",90);
$rights[4] = new Param_Rigth("Changer",50);

$menus=array();
$menus[0] = new Param_Menu("Gestion de t�ches", "Bureautique", "", "task.png", "", 30 , 0, "Gestionnaire de groupes de t�ches et{[newline]}des t�ches associ�es");
$menus[1] = new Param_Menu("Liste des t�ches", "Gestion de t�ches", "Tasks_APAS_List", "task.png", "", 10 , 0, "Gestion des t�ches.");
$menus[2] = new Param_Menu("Recherche de t�ches", "Gestion de t�ches", "Tasks_APAS_Search", "tasksearch.png", "", 20 , 1, "Recherche une t�che suivant des crit�res.");
$menus[3] = new Param_Menu("Liste des groupes de t�ches", "Gestion de t�ches", "Organisation_APAS_List", "organisation.png", "ctrl alt P", 5 , 0, "Gestion des groupes de t�ches");
$menus[4] = new Param_Menu("Param�trages de t�che", "_Extensions (conf.)", "Param", "task.png", "", 100 , 1, "Param�trages de t�che");

$actions=array();
$actions[0] = new Param_Action("Changer les param�tres", "ChangeParams", 3);
$actions[1] = new Param_Action("Valider un groupe de t�ches", "Organisation_APAS_AddModifyAct", 1);
$actions[2] = new Param_Action("Ajouter/Modifier un groupe de t�ches", "Organisation_APAS_AddModify", 1);
$actions[3] = new Param_Action("Supprimer un groupe de t�ches", "Organisation_APAS_Del", 2);
$actions[4] = new Param_Action("Fiche d'un groupe de t�ches", "Organisation_APAS_Fiche", 0);
$actions[5] = new Param_Action("Liste des groupes de t�ches", "Organisation_APAS_List", 0);
$actions[6] = new Param_Action("Imprimer un groupe de t�ches", "Organisation_APAS_PrintFile", 0);
$actions[7] = new Param_Action("Param�trages de tache", "Param", 3);
$actions[8] = new Param_Action("Valider une t�che", "Tasks_APAS_AddModifyAct", 1);
$actions[9] = new Param_Action("Ajouter/Modifier une t�che", "Tasks_APAS_AddModify", 1);
$actions[10] = new Param_Action("Commencer une t�che", "Tasks_APAS_Commencer", 4);
$actions[11] = new Param_Action("Supprimer une t�che", "Tasks_APAS_Del", 2);
$actions[12] = new Param_Action("Fiche d'une t�che", "Tasks_APAS_Fiche", 0);
$actions[13] = new Param_Action("Finir une t�che", "Tasks_APAS_Finir", 4);
$actions[14] = new Param_Action("Liste des t�ches", "Tasks_APAS_List", 0);
$actions[15] = new Param_Action("Rechercher une t�che", "Tasks_APAS_Search", 0);
$actions[16] = new Param_Action("Selectionner d'un contact comme responsable", "Tasks_APAS_SelectRespVal", 3);
$actions[17] = new Param_Action("Selectionner d'un contact comme responsable", "Tasks_APAS_SelectResp", 3);
$actions[18] = new Param_Action("Cloner", "cloneAct", 1);
$actions[19] = new Param_Action("Cloner", "cloner", 1);
$actions[20] = new Param_Action("", "menuTab", 0);

$params=array();
$params["messageRappel"] = new Param_Parameters("messageRappel", "##RESP##{[newline]}{[newline]}La tache '##NUM##' de votre logiciel de gestion arrive bient�t � �ch�ance.{[newline]}Pensez � la terminer prochainement.", "Message de rappel", 0, array('Multi'=>true));

$extend_tables=array();
$extend_tables["Organisation"] = array("org_lucterios_task.Organisation","",array());
$extend_tables["Tasks"] = array("org_lucterios_task.Tasks","",array("org_lucterios_contacts_personnePhysique"=>"owner","org_lucterios_task_Organisation"=>"organisation",));
$signals=array();

?>