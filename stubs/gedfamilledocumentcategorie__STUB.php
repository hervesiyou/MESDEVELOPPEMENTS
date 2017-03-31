<?php
namespace Dcp\Family {
	/**   */
	class Gedfamilledocumentcategorie extends \GEDNAMESPACE\GEDFAMILLEDOCUMENTCATEGORIE { const familyName="GEDFAMILLEDOCUMENTCATEGORIE";}
}

namespace Dcp\AttributeIdentifiers {
	/**   */
	class Gedfamilledocumentcategorie {
		/** [frame] Description de la Categorie */
		const cat_descriptif='cat_descriptif';
		/** [text] Identifiant */
		const cat_id='cat_id';
		/** [text] Nom de la Categorie */
		const cat_name='cat_name';
		/** [docid('GEDFAMILLEDOCUMENTCATEGORIE')] Parent de Cette Categorie */
		const cat_parent='cat_parent';
		/** [htmltext] DESCRIPTTION */
		const cat_description='cat_description';
		/** [enum] Portee */
		const cat_scope='cat_scope';
	}
}
