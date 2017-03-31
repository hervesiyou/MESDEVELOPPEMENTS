<?php
 
function document_list(Action &$action) {
 
    $usage = new \ActionUsage($action); 
    $type = $usage->addOptionalParameter("type", "type", array("ALL", "OPEN", "CLOSE"), "ALL");
			$categori = $usage->addOptionalParameter("categorieSelect", "categorieSelect", array(), false);
    $offset = intval($usage->addOptionalParameter("offset", "offset", array(), 0));
    $slice = intval($usage->addOptionalParameter("slice", "slice", array(), 5));
    $keyWord = $usage->addOptionalParameter("keyword", "keyword", array(), false);
 
    try {
        $usage->verify(true); 
        $inProgressStates = array(\GEDNAMESPACE\GEDFAMILLEDOCUMENTBASE__WFL::e_chargement,
            \GEDNAMESPACE\GEDFAMILLEDOCUMENTBASE__WFL::e_reception
        );
 
        $inProgressStates = array_map(function ($value) {
            return "'$value'";
        }, $inProgressStates);
 
        $inProgressStates = implode(",", $inProgressStates);
		   
	   /**********************************************************************/
	   $cat_doc=array();
	   $searchCat=new \SearchDoc("",Dcp\Family\GEDFAMILLEDOCUMENTCATEGORIE::familyName);
	   $searchCat->setObjectReturn();
	   
	    foreach ($searchCat->getDocumentList() as $cat) {
            /* @var \Dcp\Family\GEDFAMILLEDOCUMENTBASE $currentAudit */
            $cat_doc[] = array(
                "TITLE" => $cat->getTitle(),
                "INITID" => $cat->getPropertyValue("initid")                 
            );
        }
		$action->lay->eSetBlockData("CATEGORIE", $cat_doc);
		//$action->lay->eSetBlockData("CAT", $categori);
		$action->lay->eSet("CAT", $categori);
		$action->lay->eSet("FOOTER", $categori);
		/// je recupere la categorie qui a été choisie
				//if($categori!=""){
					   $docParCat=array();
					   $searchParCat=new \SearchDoc("",GEDFAMILLEDOCUMENTBASE);
					   $searchParCat->setObjectReturn();
					   $searchParCat->addFilter("doc_category_id='%d'",$categori);
					   // j ai filtré, je mets donc dans un bloc pour  envoyer au blocdata
					   foreach ($searchParCat->getDocumentList() as $current ) {
 							$docParCat[] = array(
								"TITLE" => $current->getTitle(),
								"INITID" => $current ->getPropertyValue("initid"),
								"URL" => sprintf("?app=FDL&action=OPENDOC&id=%d&mode=view&latest=Y",$current->getPropertyValue("initid")
								),
								"STATE" => $current->getStatelabel(),
								"COLOR" => $current->getStateColor()
							);
						}
						$searchParCat->setStart($offset*$slice);
						$searchParCat->setSlice($slice+1);
						$nbResult = $searchParCat->count();
						$isLast = ($nbResult < $slice + 1);
						if (!$isLast) {
							array_pop($docParCat);
						}
						//$action->lay->eSetBlockData("CAT1",$docParCat);
					   
				//}
	   
       /**********************************************************************/
 
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
 
 /******************************************************
		//$action->parent->addJsRef("GEDMINJUSTICEAPP/Layout/mySpecialCreate.js");
        $action->parent->addCssRef("GEDMINJUSTICEAPP/libs/css/publicationpage-grid.css");
        $action->parent->addCssRef("GEDMINJUSTICEAPP/libs/css/publicationpage.css");
		
		$application = $action->parent; 
		$cssLink = $application->getCSSLink('GEDMINJUSTICEAPP/libs/css/testauto.css'); 
		$action->lay->eSet('CSS_LINK', htmlspecialchars($cssLink));
		 /*********************************************************************
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
/* $layout = new Layout(
    "",
    null,
    "<p>Bonjour [NOM]&nbsp;[PRENOM].</p><p>La température est actuellement de [TEMPC]°C.</p>"
);
$layout->eSet("NOM","Watson");
$layout->eSet("PRENOM","Robert");
$layout->eSet("TEMPC","23");
$action->lay->eSetBlockData("TEST", $layout);
print $layout->gen();
 
 $searchAccount = new SearchAccount();
$searchAccount->addRoleFilter('Utilisateurs');
$searchAccount->setObjectReturn($searchAccount::returnAccount);

$accountList = $searchAccount->search();

foreach ($accountList as $account) {
    $login = $account->login;
    print "$login\n";
}*/
 /******************************************************/
 /*function testOfOrderBy(Action & $action)
{
    header('Content-Type: text/plain');
 
    $searchDoc = new searchDoc("", "GEDFAMILLEDOCUMENTBASE");
    $searchDoc->setObjectReturn();
 
    print "Without orderby\n";
    foreach ($searchDoc->getDocumentList() as $document) {
        printf("Title : %s \n\t sexe : %s \n", $document->getTitle(),
             $document->getTextualAttrValue("doc_headline"));
    }
 
    var_export($searchDoc->getSearchInfo());
    print "\n***************\nOrder by without orderbyLabel\n";
 
    $searchDoc->setOrder("doc_state");
    $searchDoc->reset();
 
    foreach ($searchDoc->getDocumentList() as $document) {
        printf("Title : %s \n\t sexe : %s \n", $document->getTitle(),
             $document->getTextualAttrValue("doc_headline"));
    }
 
    var_export($searchDoc->getSearchInfo());
    print "\n***************\nOrder by with orderbyLabel\n";
 
    $searchDoc->setOrder("doc_headline", "doc_headline");
    $searchDoc->reset();
 
    foreach ($searchDoc->getDocumentList() as $document) {
        printf("Title : %s \n\t sexe : %s \n", $document->getTitle(),
             $document->getTextualAttrValue("doc_headline"));
    }
 
    var_export($searchDoc->getSearchInfo());
 
}*/
 /******************************************************/
 
       /**********************************************************************/
	  // recherche des categories de document
	  
	   
        $action->lay->eSet("FIRST", ($slice === 0));
        $action->lay->eSet("LAST", $isLast);
        $action->lay->eSet("OFFSET", $offset);
        $action->lay->eSet("KEYWORD", $keyWord);
        $action->lay->eSet("TYPE_ALL", $type === "ALL");
        $action->lay->eSet("TYPE_OPEN", $type === "OPEN");
        $action->lay->eSet("TYPE_CLOSE", $type === "CLOSE");
        $action->lay->eSetBlockData("GEDFAMILLEDOCUMENTBASE", $audits);
		$action->lay->eSetBlockData("CAT1",$docParCat);
        
    } catch(Exception $exception) {
        header($exception->getMessage(), true, 500);
    }
 
}

?>