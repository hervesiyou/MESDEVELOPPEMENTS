<?php

function footer(Action &$action) {
    $docid=$action->getArgument("id");
    $type=$action->getArgument("type", "view");
 
    $action->parent->AddCssRef("GEDMINJUSTICEAPP/libs/css/footer.css");
    $action->parent->AddJsRef("GEDMINJUSTICEAPP/libs/js/footer.js");
 
    if ($type === "form") {
        $action->lay->eset("MYKEY", "Formulaire à remplir");
    } else {
        $action->lay->set("MYKEY", "&copy; Copyright, Tous droits reservés. POWERED BY GED MADIA TEST");
    }
	$action->lay->eSetBlockData("FOOTER", $docid);
}
?>