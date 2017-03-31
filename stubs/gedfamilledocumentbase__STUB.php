<?php
namespace Dcp\Family {
	/**   */
	class Gedfamilledocumentbase extends \GEDNAMESPACE\GEDFAMILLEDOCUMENTBASE { const familyName="GEDFAMILLEDOCUMENTBASE";}
}

namespace Dcp\AttributeIdentifiers {
	/**   */
	class Gedfamilledocumentbase {
		/** [frame] Caracteristiques  */
		const doc_f_caracteristique='doc_f_caracteristique';
		/** [frame] Etats */
		const doc_f_etat='doc_f_etat';
		/** [frame] Creation  */
		const doc_f_creation='doc_f_creation';
		/** [frame] Liens  */
		const doc_f_lien='doc_f_lien';
		/** [text] Identifiant */
		const doc_id='doc_id';
		/** [longtext] Sujet */
		const doc_subjet='doc_subjet';
		/** [text] Titre */
		const doc_headline='doc_headline';
		/** [enum] Langue */
		const doc_language='doc_language';
		/** [htmltext] Source */
		const doc_source='doc_source';
		/** [enum] Etat du Document */
		const doc_state='doc_state';
		/** [text] Observations */
		const doc_observation='doc_observation';
		/** [file] Attaches */
		const doc_attachments='doc_attachments';
		/** [htmltext] Liens du Document */
		const doc_link='doc_link';
		/** [enum] Portee */
		const doc_scope='doc_scope';
		/** [date] Derniere Mise a  jour  */
		const doc_updated_at='doc_updated_at';
		/** [date] Cree le */
		const doc_created_at='doc_created_at';
		/** [date] Uploade le */
		const doc_uploaded_at='doc_uploaded_at';
		/** [account] Cree par */
		const doc_created_by='doc_created_by';
		/** [account] Mis a jour par */
		const doc_updated_by='doc_updated_by';
		/** [date] Expire le */
		const doc_expire_at='doc_expire_at';
		/** [docid('GEDFAMILLEDOCUMENTCATEGORIE')] Categorie */
		const doc_category_id='doc_category_id';
		/** [enum] Verrouillage */
		const doc_locked='doc_locked';
	}
}
