<?php
 
function archive(Action &$action) {
 
    $usage = new \ActionUsage($action); 
    $type = $usage->addOptionalParameter("type", "type", array("ALL", "OPEN", "CLOSE"), "ALL");
    $offset = intval($usage->addOptionalParameter("offset", "offset", array(), 0));
    $slice = intval($usage->addOptionalParameter("slice", "slice", array(), 5));
    $keyWord = $usage->addOptionalParameter("keyword", "keyword", array(), false);
 
    try {
        $usage->verify(true); 
        $inProgressStates = array(\GEDNAMESPACE\GEDFAMILLEDOCUMENTBASE__WFL::e_chargement,
            \GEDNAMESPACE\GEDFAMILLEDOCUMENTBASE__WFL::e_reception
        );
 
        $inProgressStates = array_map(function ($value) { return "'$value'"; }, $inProgressStates); 
        $inProgressStates = implode(",", $inProgressStates);
 
        $audits = array();
        $searchDoc = new \SearchDoc("",GEDFAMILLEDOCUMENTBASE);
        $searchDoc->setObjectReturn();
        if ($keyWord) {
            $searchDoc->addFilter("title ~* '%s'", $keyWord);
        }
        if ($type === "OPEN") {
            $searchDoc->addFilter("state in ($inProgressStates)");
        } elseif ($type === "CLOSE") {
            $searchDoc->addFilter("state not in ($inProgressStates)");
        }
        $searchDoc->setStart($offset*$slice);
        $searchDoc->setSlice($slice+1);
        $nbResult = $searchDoc->count();
        foreach ($searchDoc->getDocumentList() as $currentAudit) {
            /* @var \Dcp\Family\GEDFAMILLEDOCUMENTBASE $currentAudit */
            $audits[] = array(
                "TITLE" => $currentAudit->getTitle(),
                "ID" => $currentAudit->getPropertyValue("id"),
                "URL" => sprintf(
                    "?app=FDL&action=OPENDOC&id=%d&mode=view&latest=Y",
                    $currentAudit->getPropertyValue("id")
                ),
                "STATE" => $currentAudit->getStatelabel(),
                "COLOR" => $currentAudit->getStateColor()
            );
        }
        $isLast = ($nbResult < $slice + 1);
        if (!$isLast) {
            array_pop($audits);
        }
 /*********************************************************************/
		$application = $action->parent; 
		//$application = $action->parent; 
		$cssLink = $application->getCSSLink("GEDMINJUSTICEAPP/libs/css/testauto.css"); 
		$action->lay->eSet("CSS_LINK", htmlspecialchars($cssLink));
		$action->lay->eSet("QUESTION","CECI EST MON TEST POUR LA QUESTION?????");
		$this->generate_PDF();
		$d = new_Doc("", "GEDFAMILLEDOCUMENTBASE");
		if ($d->isAlive()) {
			printf("Identifiant %d\n", $d->id);
			$err=$d->revise();
			if (empty($err)) {
				printf("Nouvel identifiant %d", $d->id);
			} else {
				printf("Erreur de révision %s", $err);
			}
        }
		$d->generate_PDF();
 /*********************************************************************/
        $action->lay->eSet("FIRST", ($slice === 0));
        $action->lay->eSet("LAST", $isLast);
        $action->lay->eSet("OFFSET", $offset);
        $action->lay->eSet("KEYWORD", $keyWord);
        $action->lay->eSet("TYPE_ALL", $type === "ALL");
        $action->lay->eSet("TYPE_OPEN", $type === "OPEN");
        $action->lay->eSet("TYPE_CLOSE", $type === "CLOSE");
        $action->lay->eSetBlockData("GEDFAMILLEDOCUMENTBASE_ARCHIVE", $audits);
    } catch(Exception $exception) {
        header($exception->getMessage(), true, 500);
    }
 
}

?>