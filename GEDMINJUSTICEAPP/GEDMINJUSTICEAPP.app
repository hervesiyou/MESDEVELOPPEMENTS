<?php

$app_desc = array(
    "name" => "GEDMINJUSTICEAPP",
    "short_name" => N_("GEDMINJUSTICEAPP:GEDMINJUSTICEAPP"),
    "description" => N_("GEDMINJUSTICEAPP:GEDMINJUSTICEAPP"),
    "icon" => "GEDMINJUSTICEAPP.png",
    "with_frame" =>"Y",
    "displayable" => "N",
    "childof" => ""
);

/**/
// ACLs for this application
$app_acl = array(
    array(
        "name" => "CHARGEURACL",
        "description" => N_("GEDMINJUSTICEAPP:Chargement ACL"),
		"group_default"=>"Y"
    ), array(
        "name" => "RECEPTEURACL",
        "description" => N_("GEDMINJUSTICEAPP:Reception ACL"),
		"group_default"=>"Y"
    ), array(
        "name" => "BASIC",
        "description" => N_("GEDMINJUSTICEAPP:Basic ACL"),
		"group_default"=>"Y"
    ),
	array(
        "name" => "MULTIPLICATION",
        "description" => N_("GEDMINJUSTICEAPP:Basic ACL"),
		"group_default"=>"Y"
    )
);
$action_desc = array(
     
	 array(
		"name" => "CHARGE",
		"short_name" => N_("GEDMINJUSTICEAPP:Charge interface"),
		"script" => "action.charge.php",
		"function" => "charge",
		"layout" => "charge.html",
		"root" => "N",
		"acl" => "CHARGEURACL"
	),
	array(
		"name" => "RECOIS",
		"short_name" => N_("GEDMINJUSTICEAPP:Recois interface"),
		"script" => "action.recois.php",
		"function" => "recois",
		"layout" => "recois.html",
		"root" => "N",
		"acl" => "RECEPTEURACL"
	),
	array(
		"name" => "PUBLIE",
		"short_name" => N_("GEDMINJUSTICEAPP:Publie interface"),
		"script" => "action.publie.php",
		"function" => "publie",
		"layout" => "publie.html",
		"root" => "N",
		"acl" => "RECEPTEURACL"
	),
	array(
		"name" => "ARCHIVE",
		"short_name" => N_("GEDMINJUSTICEAPP:Archive interface"),
		"script" => "action.archive.php",
		"function" => "archive",
		"layout" => "archive.html",
		"root" => "N",
		//"acl" => "CHARGEURACL"
	),
    /******************************************************************/
    array(
        "name" => "DOCUMENT_LIST",
        "short_name" => N_("GEDMINJUSTICEAPP:document list"),
        "script" => "action.document_list.php",
        "function" => "document_list",
        "layout" => "document_list.html",
        "acl" => "RECEPTEURACL"
    ),
	array(
		"name" => "MAIN",
		"short_name" => N_("GEDMINJUSTICEAPP:main interface"),
		"script" => "action.main.php",
		"function" => "main",
		"layout" => "main.html",
		"root" => "Y",
		"acl" => "BASIC"
	),
	array(
		"name" => "multiplication",
		"short_name" => N_("GEDMINJUSTICEAPP:multiplication interface"),
		"script" => "action.multiplication.php",
		"function" => "multiplication",
		"layout" => "multiplication.html",
		"acl" => "MULTIPLICATION"
	),
	array(
		"name" => "FOOTER",
		"short_name" => N_("GEDMINJUSTICEAPP:multiplication interface"),
		"script" => "action.footer.php",
		"function" => "footer",
		"layout" => "footer.xml",
		//"acl" => "MULTIPLICATION"
	)
/*	*/
);

/*
// Actions for this application
$action_desc = array(
    array(
        "name" => "ACTION_NAME",
        "short_name" => N_("GEDMINJUSTICEAPP:ACTION_NAME"),
        "script" => "action.action_name.php",
        "layout" => "action.html",
        "function" => "action_name",
        "root" => "N",
        "acl" => "BASIC"
    )
);
*/

