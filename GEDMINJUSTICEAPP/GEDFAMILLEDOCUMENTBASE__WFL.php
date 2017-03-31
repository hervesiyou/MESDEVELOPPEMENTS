<?php

namespace GEDNAMESPACE;

class GEDFAMILLEDOCUMENTBASE__WFL extends \Dcp\Family\WDoc
{
	public $attrPrefix = 'GED'; //FIXME: set attrPrefix
    public $firstState = self::e_chargement; //FIXME: set FirstState
    public $viewlist = "none";
	
    //region States
    //const e_E1 = 'FIXME'; //FIXME: set E1
	 /* @stateLabel _("ged_chargement") */
    const e_chargement = 'ged_e1'; //FIXME: set E1
	/* @stateLabel _("ged_reception") */
    const e_reception = 'ged_e2'; //FIXME: set E1
	/* @stateLabel _("ged_publication") */
    const e_publier = 'ged_e3'; //FIXME: set E1
	/* @stateLabel _("ged_sauvegarde") */
    const e_sauvegarde = 'ged_e4'; //FIXME: set E1
    //endregion

    //region Transitions
    //const t_E1__E2 = 'FIXME'; //FIXME: set T1
	/* @stateLabel _("ged_t1") */
    const t_chargement__reception = 'ged_t1'; //FIXME: set T1
    /* @stateLabel _("ged_t2") */
    const t_reception__publier = 'ged_t2'; //FIXME: set T1
    /* @stateLabel _("ged_t3") */
	const t_reception__chargement = 'ged_t3'; //FIXME: set T1
    /* @stateLabel _("ged_t4") */
	const t_chargement__sauvegarde = 'ged_t4'; //FIXME: set T1
    //endregion

    public $stateactivity = array(//FIXME: set stateactivity
				/* @stateLabel _("ged_acti_creerdocument") */
				self::e_chargement=>"ged_acti_creerdocument",
				/* @stateLabel _("ged_acti_parametrerdocument") */
				self::e_reception=>"ged_acti_parametrerdocument"
				//self::e_publier=>"ged_acti_publierdocument";
				//self::e_sauvegarde=>"ged_acti_sauvegarderdocument";
    );

    public $transitions = array(//FIXME: set transitions
				self::t_chargement__reception=> array("nr" => true,"m1"=>"checkerLaDate"),
				self::t_reception__publier=> array("nr" => true),
				self::t_reception__chargement=> array("nr" => true,"ask"=>array("mon_raison"),"m2" => "prendlaRaison"),
				self::t_chargement__sauvegarde=> array("nr" => true),
			
    );

    public $cycle = array(//FIXME: set cycle
				array("t"=>self::t_chargement__reception,"e1"=>self::e_chargement,"e2"=>self::e_reception),
				array("t"=>self::t_reception__publier,"e1"=>self::e_reception,"e2"=>self::e_publier),
				array("t"=>self::t_reception__chargement,"e1"=>self::e_reception,"e2"=>self::e_chargement),
				array("t"=>self::t_chargement__sauvegarde,"e1"=>self::e_chargement,"e2"=>self::e_sauvegarde),
    );
	
	public function prendlaRaison(){
			$today = date("F j, Y, g:i a");
			$this->doc->addHistoryEntry($this->getRawValue(\Dcp\AttributeIdentifiers\GEDFAMILLEDOCUMENTBASE__WFL::mon_raison));
			//$this->doc->addHistoryEntry($this->getRawValue($today));
	}
	public function checkerLaDate(){
		$err = "";
		$date = $this->getAttributeValue(\Dcp\AttributeIdentifiers\GEDFAMILLEDOCUMENTBASE::doc_created_at);
		$today = date("F j, Y, g:i a");
		//if ( (!empty($date)&& $this->getPropertyValue("doc_created_at") < $today)){
		if  (!empty($date) ){
			 
			$err = ___("Le document res pecte les dates", "GEDFAMILLEDOCUMENTBASE");
		}else{
			$err = ___("Tres important de verifier les dates", "GEDFAMILLEDOCUMENTBASE");
		}
		return $err;
    }


}