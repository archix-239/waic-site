<?php
/**
 * CPT et taxonomies pour le thème WAI-CAM.
 *
 * IMPORTANT : Ce fichier est volontairement quasi-vide.
 * Les CPT (Témoignage, Partenaire, Programme, Évènement) sont gérés
 * directement dans WordPress via le plugin "Custom Post Type UI" (CPT UI),
 * et leurs champs personnalisés via le plugin "Advanced Custom Fields" (ACF).
 *
 * Ne PAS redéclarer les CPT ici sous peine de conflits.
 *
 * Slugs des CPT actuellement déclarés via CPT UI :
 *  - temoignage
 *  - partenaire
 *  - programme
 *  - evenement
 *
 * @package WAICAM
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Helper : vérifie qu'un CPT existe avant qu'on l'utilise dans un template.
 * À appeler en début de template si on veut éviter les warnings.
 */
function waicam_cpt_exists( $slug ) {
	return post_type_exists( $slug );
}
