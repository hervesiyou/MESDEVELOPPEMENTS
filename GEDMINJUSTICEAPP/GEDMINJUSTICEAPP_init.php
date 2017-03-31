<?php

/**
 * provided by module @moduleName@ (version @version@-@release@)
 */

global $app_const;

$app_const = array(
	"INIT"=>"yes",
    "VERSION" => "@version@-@release@"
);
//Visible en mode de consultation sur tous les documents
DocumentUserInterface::addDocumentFooterZone(
    "MYCUSTOMFOOT",
    "GEDMINJUSTICEAPP:FOOTER?id=[id]", 
    false); 
// View Document Footer 
//Visible en mode d'édition sur tous les documents.
DocumentUserInterface::addDocumentFooterZone(
    "MYCUSTOMFOOT",
    "GEDMINJUSTICEAPP:FOOTER?id=[id]&type=form",
    true);
// Form Document Footer 
 
