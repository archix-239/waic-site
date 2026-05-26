<?php
/**
 * WAI-CAM theme functions and definitions.
 *
 * @package WAICAM
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'WAICAM_VERSION', '1.0.0' );
define( 'WAICAM_DIR', get_template_directory() );
define( 'WAICAM_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function waicam_setup() {

	load_theme_textdomain( 'waicam', WAICAM_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script',
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'primary'  => __( 'Menu principal', 'waicam' ),
		'footer-1' => __( 'Footer — Navigation', 'waicam' ),
		'footer-2' => __( 'Footer — Programmes', 'waicam' ),
		'footer-3' => __( 'Footer — Contact', 'waicam' ),
	) );
}
add_action( 'after_setup_theme', 'waicam_setup' );

/**
 * Enqueue scripts and styles
 */
function waicam_enqueue_assets() {

	// Google Fonts
	wp_enqueue_style(
		'waicam-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&family=Poppins:wght@500;600;700;800&display=swap',
		array(),
		null
	);

	// Font Awesome 6 (icônes)
	wp_enqueue_style(
		'waicam-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(),
		'6.5.2'
	);

	// CSS principal (style original du projet HTML)
	wp_enqueue_style(
		'waicam-style',
		WAICAM_URI . '/assets/css/main.css',
		array( 'waicam-fonts', 'waicam-fontawesome' ),
		WAICAM_VERSION
	);

	// CSS additionnel (extraction des styles inline + nouvelles classes templates)
	wp_enqueue_style(
		'waicam-extras',
		WAICAM_URI . '/assets/css/wp-extras.css',
		array( 'waicam-style' ),
		WAICAM_VERSION
	);

	// style.css (obligatoire WordPress)
	wp_enqueue_style(
		'waicam-theme',
		get_stylesheet_uri(),
		array( 'waicam-extras' ),
		WAICAM_VERSION
	);

	// JavaScript principal
	wp_enqueue_script(
		'waicam-main',
		WAICAM_URI . '/assets/js/main.js',
		array(),
		WAICAM_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'waicam_enqueue_assets' );

/**
 * Custom Post Types & Custom Fields
 */
require_once WAICAM_DIR . '/inc/cpt.php';

/**
 * Helpers réutilisables
 */
require_once WAICAM_DIR . '/inc/helpers.php';

/**
 * Assistant d'installation (auto-création des pages + menu)
 */
require_once WAICAM_DIR . '/inc/setup-wizard.php';

/**
 * Menu walker — génère .nav-item avec .nav-dropdown pour les sous-menus
 * Structure produite :
 *   <div class="nav-item [active]">
 *     <a href="...">Label ▾</a>
 *     <div class="nav-dropdown">
 *       <a href="...">Sous-item</a>
 *     </div>
 *   </div>
 */
class WAICAM_Nav_Walker extends Walker_Nav_Menu {

	/** Ouvre un élément de menu (li → div.nav-item) */
	function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		if ( $depth === 0 ) {
			// ── Niveau 0 : wrapper .nav-item ──
			$is_active  = in_array( 'current-menu-item', $classes, true )
			           || in_array( 'current_page_item', $classes, true )
			           || in_array( 'current-menu-ancestor', $classes, true );
			$is_cta     = in_array( 'btn-nav', $classes, true )
			           || strtolower( trim( $item->title ) ) === 'rejoindre';
			$has_children = $args->walker->has_children;

			$wrapper_class = 'nav-item';
			if ( $is_active )  $wrapper_class .= ' active';
			if ( $is_cta )     $wrapper_class .= ' btn-nav';

			$output .= '<div class="' . esc_attr( $wrapper_class ) . '">';

			// Lien principal
			$link_class = '';
			if ( $is_active ) $link_class .= ' active';
			if ( $is_cta )    $link_class .= ' btn-nav';

			$output .= '<a href="' . esc_url( $item->url ) . '"'
			         . ( $link_class ? ' class="' . esc_attr( trim( $link_class ) ) . '"' : '' )
			         . ( $has_children ? ' aria-haspopup="true" aria-expanded="false"' : '' )
			         . '>' . esc_html( $item->title ) . '</a>';

			// Ouvre le dropdown si l'item a des enfants
			if ( $has_children ) {
				$output .= '<div class="nav-dropdown" role="menu">';
			}

		} else {
			// ── Niveau 1 : lien dans le dropdown ──
			$is_active = in_array( 'current-menu-item', $classes, true );
			$output .= '<a href="' . esc_url( $item->url ) . '"'
			         . ( $is_active ? ' class="active"' : '' )
			         . ' role="menuitem">'
			         . esc_html( $item->title ) . '</a>';
		}
	}

	/** Ferme un élément de menu */
	function end_el( &$output, $item, $depth = 0, $args = null ) {
		if ( $depth === 0 ) {
			// Ferme le dropdown s'il a été ouvert
			if ( $args->walker->has_children ) {
				$output .= '</div>'; // .nav-dropdown
			}
			$output .= '</div>'; // .nav-item
		}
		// Niveau 1 : pas de balise fermante (les <a> sont auto-fermants)
	}

	/** Ouvre un sous-menu (déjà géré dans start_el) */
	function start_lvl( &$output, $depth = 0, $args = null ) {}

	/** Ferme un sous-menu (déjà géré dans end_el) */
	function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/**
 * Fallback du menu si l'admin ne l'a pas encore configuré
 * Génère la même structure .nav-item / .nav-dropdown que le Walker
 */
function waicam_default_menu() {

	$current = function( $slug ) {
		if ( $slug === 'home' ) return is_front_page();
		return is_page( $slug );
	};

	// Structure : slug => [ label, sous-items[] ]
	$items = array(
		'home'        => array( __( 'Accueil', 'waicam' ), array() ),
		'about'       => array( __( 'À propos', 'waicam' ), array(
			home_url('/about')       => __( 'Qui sommes-nous', 'waicam' ),
			home_url('/equipe')      => __( 'Équipe', 'waicam' ),
			home_url('/partenaires') => __( 'Partenaires', 'waicam' ),
		) ),
		'educate'     => array( __( 'Educate', 'waicam' ), array(
			home_url('/formations')  => __( 'Formations', 'waicam' ),
			home_url('/programmes')  => __( 'Programmes', 'waicam' ),
		) ),
		'inspire'     => array( __( 'Inspire', 'waicam' ), array(
			home_url('/blog')        => __( 'Blog', 'waicam' ),
			home_url('/temoignages') => __( 'Témoignages', 'waicam' ),
			home_url('/galerie')     => __( 'Galerie', 'waicam' ),
		) ),
		'get-involved' => array( __( 'Get Involved', 'waicam' ), array(
			home_url('/rejoindre')   => __( 'Devenir membre', 'waicam' ),
			home_url('/partenaires') => __( 'Partenariats', 'waicam' ),
			home_url('/faire-un-don') => __( 'Faire un don', 'waicam' ),
			home_url('/contact')     => __( 'Contact', 'waicam' ),
		) ),
	);

	foreach ( $items as $slug => $data ) {
		list( $label, $children ) = $data;
		$href        = $slug === 'home' ? home_url('/') : home_url('/' . $slug);
		$is_active   = $current( $slug );
		$has_children = ! empty( $children );

		$wrapper_class = 'nav-item' . ( $is_active ? ' active' : '' );
		$link_class    = $is_active ? ' class="active"' : '';

		echo '<div class="' . esc_attr( $wrapper_class ) . '">';
		echo '<a href="' . esc_url( $href ) . '"' . $link_class;
		if ( $has_children ) echo ' aria-haspopup="true" aria-expanded="false"';
		echo '>' . esc_html( $label ) . '</a>';

		if ( $has_children ) {
			echo '<div class="nav-dropdown" role="menu">';
			foreach ( $children as $child_url => $child_label ) {
				echo '<a href="' . esc_url( $child_url ) . '" role="menuitem">' . esc_html( $child_label ) . '</a>';
			}
			echo '</div>';
		}
		echo '</div>';
	}

	// Note : le bouton CTA "Rejoindre" est rendu directement dans header.php (.nav-right)
}

/**
 * Customizer — Panneau WAI-CAM (formulaires Fluent Forms + coordonnées)
 */
function waicam_customize_register( $wp_customize ) {

	// ────────── Panneau principal WAI-CAM ──────────
	$wp_customize->add_panel( 'waicam_panel', array(
		'title'    => __( 'WAI-CAM', 'waicam' ),
		'priority' => 30,
	) );


	$wp_customize->add_panel( 'waicam_home_panel', array(
		'title'    => __( 'WAI-CAM — Accueil', 'waicam' ),
		'priority' => 31,
	) );

	$wp_customize->add_panel( 'waicam_about_panel', array(
		'title'    => __( 'WAI-CAM — À propos', 'waicam' ),
		'priority' => 32,
	) );

	// ────────── Section Formulaires (IDs Fluent Forms) ──────────
	$wp_customize->add_section( 'waicam_forms', array(
		'title' => __( 'Formulaires Fluent Forms', 'waicam' ),
		'description' => __( "Saisis l'ID de chaque formulaire Fluent Forms à afficher (visible dans Fluent Forms → Tous les formulaires).", 'waicam' ),
		'panel' => 'waicam_panel',
	) );

	$forms = array(
		'waicam_form_contact'              => __( 'Formulaire de contact', 'waicam' ),
		'waicam_form_adhesion'             => __( "Formulaire d'adhésion", 'waicam' ),
		'waicam_form_partenariat'          => __( 'Formulaire partenariat', 'waicam' ),
		'waicam_form_inscription_formation'=> __( 'Formulaire inscription formation', 'waicam' ),
		'waicam_form_programme'            => __( 'Formulaire inscription programme', 'waicam' ),
		'waicam_form_newsletter'           => __( 'Formulaire newsletter', 'waicam' ),
		'waicam_give_form_id'              => __( 'Formulaire de don GiveWP (ID) — déprécié', 'waicam' ),
		'waicam_donation_product_id'       => __( 'Produit WooCommerce « Don à WAI-CAM » (ID)', 'waicam' ),
	);
	foreach ( $forms as $key => $label ) {
		$wp_customize->add_setting( $key, array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $label,
			'section' => 'waicam_forms',
			'type'    => 'number',
		) );
	}

	// ────────── Section Coordonnées ──────────
	$wp_customize->add_section( 'waicam_contact', array(
		'title' => __( 'Coordonnées', 'waicam' ),
		'panel' => 'waicam_panel',
	) );

	$contact_fields = array(
		'waicam_address'        => array( __( 'Adresse', 'waicam' ),    '919 Boulevard de Rey-Bouba, Mballa 2, Yaoundé' ),
		'waicam_phone_display'  => array( __( 'Téléphone (affichage)', 'waicam' ), '(+237) 222 20 58 53 / 682 573 699 / 698 164 869' ),
		'waicam_phone'          => array( __( 'Téléphone (lien)', 'waicam' ), '+237682573699' ),
		'waicam_email'          => array( __( 'Email principal', 'waicam' ), 'womeninaicameroon@gmail.com' ),
		'waicam_hours'          => array( __( 'Horaires', 'waicam' ), 'Lundi – Vendredi : 8h00 – 18h00' ),
	);
	foreach ( $contact_fields as $key => $cfg ) {
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_contact',
			'type'    => 'text',
		) );
	}

	// ────────── Section Réseaux sociaux ──────────
	$wp_customize->add_section( 'waicam_social', array(
		'title' => __( 'Réseaux sociaux', 'waicam' ),
		'panel' => 'waicam_panel',
	) );

	$socials = array(
		'waicam_social_facebook'  => 'Facebook',
		'waicam_social_twitter'   => 'Twitter / X',
		'waicam_social_linkedin'  => 'LinkedIn',
		'waicam_social_instagram' => 'Instagram',
		'waicam_social_youtube'   => 'YouTube',
	);
	foreach ( $socials as $key => $label ) {
		$wp_customize->add_setting( $key, array(
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $label,
			'section' => 'waicam_social',
			'type'    => 'url',
		) );
	}

	// ────────── Section Galeries (IDs Envira Gallery) ──────────
	$wp_customize->add_section( 'waicam_galleries', array(
		'title'       => __( 'Galeries (Envira Gallery)', 'waicam' ),
		'description' => __( "Saisis l'ID de chaque galerie Envira à afficher dans la page Galerie. L'ID est visible dans Envira Gallery → Toutes les galeries (colonne ID).", 'waicam' ),
		'panel'       => 'waicam_panel',
	) );

	$galleries = array(
		'waicam_envira_gallery_formations'  => __( 'Galerie — Formations & Ateliers', 'waicam' ),
		'waicam_envira_gallery_conferences' => __( 'Galerie — Conférences', 'waicam' ),
		'waicam_envira_gallery_terrain'     => __( 'Galerie — Missions terrain', 'waicam' ),
		'waicam_envira_gallery_evenements'  => __( 'Galerie — Évènements', 'waicam' ),
	);
	foreach ( $galleries as $key => $label ) {
		$wp_customize->add_setting( $key, array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $label,
			'section' => 'waicam_galleries',
			'type'    => 'number',
		) );
	}

	// ────────── Section Home post-hero (modèle institutionnel) ──────────
	$wp_customize->add_section( 'waicam_home_posthero', array(
		'title'       => __( 'Accueil — Section post-hero', 'waicam' ),
		'description' => __( 'Contenus du bloc immédiatement après le hero de la page d’accueil.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );

	$home_posthero_fields = array(
		'waicam_home_posthero_title'    => array( __( 'Titre principal', 'waicam' ), '5 MILLIONS D’ICI 2030', 'text' ),
		'waicam_home_posthero_cta_text' => array( __( 'Texte du lien principal', 'waicam' ), 'En savoir plus sur notre plan stratégique', 'text' ),
		'waicam_home_posthero_cta_url'  => array( __( 'URL du lien principal', 'waicam' ), home_url( '/about' ), 'url' ),
		'waicam_home_axis_1_title'      => array( __( 'Axe 1 — Titre', 'waicam' ), 'Former', 'text' ),
		'waicam_home_axis_1_text'       => array( __( 'Axe 1 — Description', 'waicam' ), 'Former les jeunes filles et femmes aux compétences numériques et à l’IA appliquée.', 'textarea' ),
		'waicam_home_axis_1_url'        => array( __( 'Axe 1 — URL', 'waicam' ), home_url( '/formations' ), 'url' ),
		'waicam_home_axis_2_title'      => array( __( 'Axe 2 — Titre', 'waicam' ), 'Accompagner', 'text' ),
		'waicam_home_axis_2_text'       => array( __( 'Axe 2 — Description', 'waicam' ), 'Accompagner les femmes vers des parcours concrets : leadership, entrepreneuriat et innovation.', 'textarea' ),
		'waicam_home_axis_2_url'        => array( __( 'Axe 2 — URL', 'waicam' ), home_url( '/programmes' ), 'url' ),
	);

		foreach ( $home_posthero_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_posthero',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Section Home impact (suite section après post-hero) ──────────
	$wp_customize->add_section( 'waicam_home_impact', array(
		'title'       => __( 'Accueil — Section impact', 'waicam' ),
		'description' => __( 'Bloc texte + statistiques après la section post-hero.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );

		$impact_fields = array(
		'waicam_home_impact_kicker'        => array( __( 'Sur-titre', 'waicam' ), 'INTELLIGENCE ARTIFICIELLE & INCLUSION', 'text' ),
		'waicam_home_impact_title'         => array( __( 'Titre principal', 'waicam' ), 'BRISER LES BARRIÈRES À L’IA ET AUX TECHNOLOGIES ÉMERGENTES.', 'text' ),
		'waicam_home_impact_text'          => array( __( 'Paragraphe', 'waicam' ), 'Women in AI Cameroon développe des parcours de formation, de sensibilisation et d’accompagnement pour permettre aux femmes et aux jeunes filles de participer pleinement à la révolution de l’intelligence artificielle.', 'textarea' ),
		'waicam_home_impact_cta_text'      => array( __( 'Texte du lien', 'waicam' ), 'Découvrir nos actions', 'text' ),
			'waicam_home_impact_cta_url'       => array( __( 'URL du lien', 'waicam' ), waicam_events_archive_url(), 'url' ),
		'waicam_home_impact_stat_1_number' => array( __( 'Stat 1 — Chiffre', 'waicam' ), '860 000', 'text' ),
		'waicam_home_impact_stat_1_label'  => array( __( 'Stat 1 — Label', 'waicam' ), 'PERSONNES SENSIBILISÉES', 'text' ),
		'waicam_home_impact_stat_1_text'   => array( __( 'Stat 1 — Description', 'waicam' ), 'Des femmes et jeunes filles touchées par des campagnes de sensibilisation et des ateliers.', 'textarea' ),
		'waicam_home_impact_stat_2_number' => array( __( 'Stat 2 — Chiffre', 'waicam' ), '425 000', 'text' ),
		'waicam_home_impact_stat_2_label'  => array( __( 'Stat 2 — Label', 'waicam' ), 'COMMUNAUTÉ ENGAGÉE', 'text' ),
		'waicam_home_impact_stat_2_text'   => array( __( 'Stat 2 — Description', 'waicam' ), 'Une communauté active autour du mentorat, du leadership et de l’apprentissage collaboratif.', 'textarea' ),
		'waicam_home_impact_stat_3_number' => array( __( 'Stat 3 — Chiffre', 'waicam' ), '10 000', 'text' ),
		'waicam_home_impact_stat_3_label'  => array( __( 'Stat 3 — Label', 'waicam' ), 'APPRENANTES IA', 'text' ),
		'waicam_home_impact_stat_3_text'   => array( __( 'Stat 3 — Description', 'waicam' ), 'Des participantes formées sur des usages concrets de l’IA dans leurs secteurs.', 'textarea' ),
	);
		foreach ( $impact_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_impact',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Section Home vidéo ──────────
	$wp_customize->add_section( 'waicam_home_video', array(
		'title'       => __( 'Accueil — Section vidéo', 'waicam' ),
		'description' => __( 'Vidéo mise en avant après la section impact (URL YouTube/Vimeo).', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );

	$home_video_fields = array(
		'waicam_home_video_title' => array( __( 'Titre', 'waicam' ), 'Regards croisés sur nos actions terrain', 'text' ),
		'waicam_home_video_text'  => array( __( 'Texte', 'waicam' ), 'Découvrez nos initiatives, nos formations et nos témoignages en vidéo.', 'textarea' ),
		'waicam_home_video_url'   => array( __( 'Lien vidéo (YouTube/Vimeo)', 'waicam' ), '', 'url' ),
	);

		foreach ( $home_video_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_video',
			'type'    => $cfg[2],
			) );
		}
		$wp_customize->add_setting( 'waicam_home_posthero_media_id', array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( new WP_Customize_Media_Control(
			$wp_customize,
			'waicam_home_posthero_media_id',
			array(
				'label'      => __( 'Image de la section (gauche)', 'waicam' ),
				'section'    => 'waicam_home_posthero',
				'mime_type'  => 'image',
			)
		) );

		// ────────── Section Initiative phare (image + éditorial + CTA actualités) ──────────
		$wp_customize->add_section( 'waicam_home_featured', array(
			'title'       => __( 'Accueil — Initiative phare', 'waicam' ),
			'description' => __( 'Bloc éditorial image/texte orienté actualités et actions WAI-CAM.', 'waicam' ),
			'panel'       => 'waicam_home_panel',
		) );
		$featured_fields = array(
			'waicam_home_featured_kicker'   => array( __( 'Sur-titre', 'waicam' ), 'INITIATIVE PHARE WAI-CAM', 'text' ),
			'waicam_home_featured_title'    => array( __( 'Titre', 'waicam' ), 'Nos actions terrain pour démocratiser l’IA au Cameroun', 'text' ),
			'waicam_home_featured_text'     => array( __( 'Texte', 'waicam' ), 'Formations, ateliers, conférences et rencontres institutionnelles : WAI-CAM agit sur le terrain pour rendre l’intelligence artificielle accessible, inclusive et utile aux femmes et aux jeunes filles.', 'textarea' ),
			'waicam_home_featured_cta_text' => array( __( 'Texte du lien', 'waicam' ), 'Découvrir nos actualités', 'text' ),
			'waicam_home_featured_cta_url'  => array( __( 'URL du lien', 'waicam' ), waicam_events_archive_url(), 'url' ),
		);
		foreach ( $featured_fields as $key => $cfg ) {
			$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
			if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
			$wp_customize->add_setting( $key, array(
				'default'           => $cfg[1],
				'sanitize_callback' => $sanitize,
			) );
			$wp_customize->add_control( $key, array(
				'label'   => $cfg[0],
				'section' => 'waicam_home_featured',
				'type'    => $cfg[2],
			) );
		}
		$wp_customize->add_setting( 'waicam_home_featured_media_id', array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( new WP_Customize_Media_Control(
			$wp_customize,
			'waicam_home_featured_media_id',
			array(
				'label'      => __( 'Image initiative phare (gauche)', 'waicam' ),
				'section'    => 'waicam_home_featured',
				'mime_type'  => 'image',
			)
		) );

	// ────────── Section Home newsletter ──────────
	$wp_customize->add_section( 'waicam_home_newsletter', array(
		'title'       => __( 'Accueil — Newsletter', 'waicam' ),
		'description' => __( 'Bloc newsletter après la section initiative phare.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );
	$newsletter_fields = array(
		'waicam_home_newsletter_title' => array( __( 'Titre', 'waicam' ), 'Restez informé(e) de nos actualités', 'text' ),
		'waicam_home_newsletter_text'  => array( __( 'Texte', 'waicam' ), 'Recevez les mises à jour sur nos formations, événements, ressources et actions de terrain portées par Women in AI Cameroon.', 'textarea' ),
	);
	foreach ( $newsletter_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_newsletter',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Section Home témoignage cadré ──────────
	$wp_customize->add_section( 'waicam_home_quote', array(
		'title'       => __( 'Accueil — Témoignage cadré', 'waicam' ),
		'description' => __( 'Bloc témoignage avec visuel et motif de cadre inspiré de la référence.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );
	$quote_fields = array(
		'waicam_home_quote_text'   => array( __( 'Texte du témoignage', 'waicam' ), 'Women in AI Cameroon a changé ma trajectoire professionnelle en me donnant les outils, la confiance et la communauté nécessaires pour agir concrètement.', 'textarea' ),
		'waicam_home_quote_author' => array( __( 'Nom / signature', 'waicam' ), 'MEMBRE WAI-CAM', 'text' ),
		'waicam_home_quote_role'   => array( __( 'Fonction / programme', 'waicam' ), 'Programme Leadership & Mentorat', 'text' ),
	);
	foreach ( $quote_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_quote',
			'type'    => $cfg[2],
		) );
	}
	$wp_customize->add_setting( 'waicam_home_quote_media_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control(
		$wp_customize,
		'waicam_home_quote_media_id',
		array(
			'label'      => __( 'Image témoignage', 'waicam' ),
			'section'    => 'waicam_home_quote',
			'mime_type'  => 'image',
		)
	) );

	// ────────── Section Home grand chiffre + CTA ──────────
	$wp_customize->add_section( 'waicam_home_bigstat', array(
		'title'       => __( 'Accueil — Grand chiffre', 'waicam' ),
		'description' => __( 'Bloc grand chiffre avec texte et CTA après le témoignage.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );
	$bigstat_fields = array(
		'waicam_home_bigstat_title'   => array( __( 'Titre principal', 'waicam' ), '860 000 femmes et jeunes touchées par nos actions au Cameroun', 'text' ),
		'waicam_home_bigstat_text'    => array( __( 'Texte', 'waicam' ), 'WAI-CAM accélère l’inclusion numérique des femmes grâce à des programmes de formation, de mentorat et d’accompagnement sur le terrain.', 'textarea' ),
		'waicam_home_bigstat_cta_text'=> array( __( 'Texte bouton', 'waicam' ), 'Soutenir nos actions', 'text' ),
		'waicam_home_bigstat_cta_url' => array( __( 'URL bouton', 'waicam' ), home_url( '/don' ), 'url' ),
	);
	foreach ( $bigstat_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_bigstat',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Section Home actualités (cartes) ──────────
	$wp_customize->add_section( 'waicam_home_news', array(
		'title'       => __( 'Accueil — Actualités (grille)', 'waicam' ),
		'description' => __( 'Bloc actualités avec cartes après le grand chiffre.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );
	$news_fields = array(
		'waicam_home_news_kicker'   => array( __( 'Sur-titre', 'waicam' ), 'ACTUALITÉS', 'text' ),
		'waicam_home_news_title'    => array( __( 'Titre', 'waicam' ), 'Restez connectés à nos actions', 'text' ),
		'waicam_home_news_cta_text' => array( __( 'Texte lien bas', 'waicam' ), 'Voir toutes nos actualités', 'text' ),
		'waicam_home_news_cta_url'  => array( __( 'URL lien bas', 'waicam' ), home_url( '/blog' ), 'url' ),
	);
	foreach ( $news_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_news',
			'type'    => $cfg[2],
		) );
	}



	// ────────── Page Équipe — Hero ──────────
	$wp_customize->add_section( 'waicam_team_hero', array(
		'title'       => __( 'Équipe — Hero', 'waicam' ),
		'description' => __( 'Première section de la page Notre Équipe.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );
	$team_hero_fields = array(
		'waicam_team_hero_kicker'   => array( __( 'Badge', 'waicam' ), 'NOTRE ÉQUIPE', 'text' ),
		'waicam_team_hero_title'    => array( __( 'Titre', 'waicam' ), "RENCONTREZ L'ÉQUIPE QUI FAIT AVANCER WAI-CAM", 'text' ),
		'waicam_team_hero_cta_text' => array( __( 'Texte CTA', 'waicam' ), 'Envie de rejoindre l’équipe ? Découvrir les opportunités', 'text' ),
		'waicam_team_hero_cta_url'  => array( __( 'URL CTA', 'waicam' ), home_url( '/rejoindre/' ), 'url' ),
	);
	foreach ( $team_hero_fields as $key => $cfg ) {
		$sanitize = 'url' === $cfg[2] ? 'esc_url_raw' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_team_hero',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Page Équipe — Présidence spotlight ──────────
	$wp_customize->add_section( 'waicam_team_spotlight', array(
		'title'       => __( 'Équipe — Présidence', 'waicam' ),
		'description' => __( 'Section texte + image après le hero.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );
	$team_spotlight_fields = array(
		'waicam_team_spotlight_kicker'   => array( __( 'Titre court', 'waicam' ), 'NOTRE PRÉSIDENCE', 'text' ),
		'waicam_team_spotlight_title'    => array( __( 'Titre principal', 'waicam' ), 'UNE LEADERSHIP FÉMININ ENGAGÉ POUR L’IA INCLUSIVE', 'text' ),
		'waicam_team_spotlight_text'     => array( __( 'Texte', 'waicam' ), "WAI-CAM est portée par une présidence engagée qui agit pour réduire les inégalités d’accès au numérique, renforcer les compétences des femmes et promouvoir une intelligence artificielle éthique au Cameroun.", 'textarea' ),
		'waicam_team_spotlight_cta_text' => array( __( 'Texte CTA', 'waicam' ), 'Découvrir notre gouvernance', 'text' ),
		'waicam_team_spotlight_cta_url'  => array( __( 'URL CTA', 'waicam' ), home_url( '/about/' ), 'url' ),
	);
	foreach ( $team_spotlight_fields as $key => $cfg ) {
		if ( 'textarea' === $cfg[2] ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'url' === $cfg[2] ) {
			$sanitize = 'esc_url_raw';
		} else {
			$sanitize = 'sanitize_text_field';
		}
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_team_spotlight',
			'type'    => $cfg[2],
		) );
	}
	$wp_customize->add_setting( 'waicam_team_spotlight_image_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'waicam_team_spotlight_image_id', array(
		'label'     => __( 'Image section', 'waicam' ),
		'section'   => 'waicam_team_spotlight',
		'mime_type' => 'image',
	) ) );


	// ────────── Page Équipe — Citation mouvement ──────────
	$wp_customize->add_section( 'waicam_team_quote', array(
		'title'       => __( 'Équipe — Citation', 'waicam' ),
		'description' => __( 'Bloc citation après la section Présidence.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );
	$team_quote_fields = array(
		'waicam_team_quote_text'   => array( __( 'Texte citation', 'waicam' ), "WAI-CAM est plus qu'une organisation : c'est un mouvement citoyen qui agit pour l'inclusion numérique des femmes.", 'textarea' ),
		'waicam_team_quote_author' => array( __( 'Auteur / signature', 'waicam' ), 'WAI-CAM — Leadership & Gouvernance', 'text' ),
	);
	foreach ( $team_quote_fields as $key => $cfg ) {
		$sanitize = 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_team_quote',
			'type'    => $cfg[2],
		) );
	}



	// ────────── Page About — Hero ──────────
	$wp_customize->add_section( 'waicam_about_hero', array(
		'title'       => __( 'À propos — Hero', 'waicam' ),
		'description' => __( 'Section hero de la page Qui sommes-nous.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$wp_customize->add_setting( 'waicam_about_hero_title', array(
		'default'           => __( "NOUS SOMMES EN MISSION POUR RENDRE L'IA ACCESSIBLE AUX FEMMES ET AUX JEUNES DU CAMEROUN.", 'waicam' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'waicam_about_hero_title', array(
		'label'   => __( 'Titre hero', 'waicam' ),
		'section' => 'waicam_about_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'waicam_about_hero_image_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'waicam_about_hero_image_id', array(
		'label'      => __( 'Image hero', 'waicam' ),
		'section'    => 'waicam_about_hero',
		'mime_type'  => 'image',
	) ) );


	// ────────── Page About — Intro texte ──────────
	$wp_customize->add_section( 'waicam_about_intro', array(
		'title'       => __( 'À propos — Intro texte', 'waicam' ),
		'description' => __( 'Bloc texte après le hero.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$about_intro_fields = array(
		'waicam_about_intro_kicker' => array( __( 'Sur-titre', 'waicam' ), 'IA ET TECHNOLOGIES ÉMERGENTES', 'text' ),
		'waicam_about_intro_title'  => array( __( 'Titre', 'waicam' ), "BRISER LES BARRIÈRES À L'IA ET AUX TECHNOLOGIES ÉMERGENTES.", 'text' ),
		'waicam_about_intro_text'   => array( __( 'Texte', 'waicam' ), "Nous développons des parcours d'apprentissage en IA qui rendent les compétences numériques accessibles aux femmes et aux jeunes, grâce à des programmes concrets, des ateliers terrain et un accompagnement durable.", 'textarea' ),
	);
	foreach ( $about_intro_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_intro',
			'type'    => $cfg[2],
		) );
	}


	// ────────── Page About — Chiffres d'impact ──────────
	$wp_customize->add_section( 'waicam_about_stats', array(
		'title'       => __( 'À propos — Chiffres', 'waicam' ),
		'description' => __( 'Bloc des 3 chiffres de la page Qui sommes-nous.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$about_stats_fields = array(
		'waicam_about_stat_1_number' => array( __( 'Chiffre 1', 'waicam' ), '860 000', 'text' ),
		'waicam_about_stat_1_label'  => array( __( 'Label 1', 'waicam' ), 'PERSONNES TOUCHÉES', 'text' ),
		'waicam_about_stat_1_text'   => array( __( 'Description 1', 'waicam' ), "WAI-CAM a déjà sensibilisé et accompagné des milliers de femmes et de jeunes à travers ses actions communautaires, éducatives et citoyennes.", 'textarea' ),
		'waicam_about_stat_2_number' => array( __( 'Chiffre 2', 'waicam' ), '425 000', 'text' ),
		'waicam_about_stat_2_label'  => array( __( 'Label 2', 'waicam' ), 'ALUMNI & COMMUNAUTÉ', 'text' ),
		'waicam_about_stat_2_text'   => array( __( 'Description 2', 'waicam' ), "Une communauté active d'apprenantes, d'enseignantes, d'ambassadrices et de partenaires qui relaient l'adoption responsable de l'IA.", 'textarea' ),
		'waicam_about_stat_3_number' => array( __( 'Chiffre 3', 'waicam' ), '10 000', 'text' ),
		'waicam_about_stat_3_label'  => array( __( 'Label 3', 'waicam' ), 'APPRENANTES IA', 'text' ),
		'waicam_about_stat_3_text'   => array( __( 'Description 3', 'waicam' ), "Des participantes formées aux bases de l'IA, de la culture numérique et des usages concrets dans l'éducation, l'entrepreneuriat et la vie quotidienne.", 'textarea' ),
	);
	foreach ( $about_stats_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_stats',
			'type'    => $cfg[2],
		) );
	}


	// ────────── Page About — Section fracture genre ──────────
	$wp_customize->add_section( 'waicam_about_gap', array(
		'title'       => __( 'À propos — Fracture genre', 'waicam' ),
		'description' => __( 'Titre, texte et données du graphique de tendance.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$about_gap_fields = array(
		'waicam_about_gap_title' => array( __( 'Titre', 'waicam' ), 'LA FRACTURE GENRE EN NUMÉRIQUE RESTE UN DÉFI MAJEUR.', 'text' ),
		'waicam_about_gap_text'  => array( __( 'Texte', 'waicam' ), "Au Cameroun comme ailleurs, les femmes restent sous-représentées dans les filières technologiques. WAI-CAM agit en priorité auprès des adolescentes et jeunes femmes pour renforcer l'accès, la confiance et les compétences en intelligence artificielle.", 'textarea' ),
		'waicam_about_gap_p1'    => array( __( 'Point 1 (%)', 'waicam' ), '37%', 'text' ),
		'waicam_about_gap_p2'    => array( __( 'Point 2 (%)', 'waicam' ), '24%', 'text' ),
		'waicam_about_gap_p3'    => array( __( 'Point 3 (%)', 'waicam' ), '22%', 'text' ),
		'waicam_about_gap_y1'    => array( __( 'Année 1', 'waicam' ), '1995', 'text' ),
		'waicam_about_gap_y2'    => array( __( 'Année 2', 'waicam' ), '2017', 'text' ),
		'waicam_about_gap_y3'    => array( __( 'Année 3', 'waicam' ), '2022', 'text' ),
	);
	foreach ( $about_gap_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_gap',
			'type'    => $cfg[2],
		) );
	}


	// ────────── Page About — Bloc transformation + soutien ──────────
	$wp_customize->add_section( 'waicam_about_change', array(
		'title'       => __( 'À propos — Transformation', 'waicam' ),
		'description' => __( 'Bloc titre/texte avec encart de soutien à droite.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$about_change_fields = array(
		'waicam_about_change_title'          => array( __( 'Titre principal', 'waicam' ), 'WAI-CAM TRANSFORME LA DONNE', 'text' ),
		'waicam_about_change_text'           => array( __( 'Texte principal', 'waicam' ), "Nous mobilisons les femmes et les jeunes à travers des formations, du mentorat et des actions communautaires pour accélérer une adoption inclusive de l'intelligence artificielle au Cameroun.", 'textarea' ),
		'waicam_about_change_cta_title'      => array( __( 'Titre encart', 'waicam' ), 'SOUTENEZ WAI-CAM', 'text' ),
		'waicam_about_change_cta_text'       => array( __( 'Texte encart', 'waicam' ), "Votre contribution nous aide à former, outiller et accompagner davantage de femmes et de jeunes dans les métiers du numérique et de l'IA.", 'textarea' ),
		'waicam_about_change_cta_link_label' => array( __( 'Texte lien', 'waicam' ), 'Faire un don', 'text' ),
		'waicam_about_change_cta_link_url'   => array( __( 'URL lien', 'waicam' ), home_url( '/faire-un-don/' ), 'url' ),
	);
	foreach ( $about_change_fields as $key => $cfg ) {
		if ( 'textarea' === $cfg[2] ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'url' === $cfg[2] ) {
			$sanitize = 'esc_url_raw';
		} else {
			$sanitize = 'sanitize_text_field';
		}
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_change',
			'type'    => $cfg[2],
		) );
	}


	// ────────── Page About — Nos valeurs ──────────
	$wp_customize->add_section( 'waicam_about_values', array(
		'title'       => __( 'À propos — Nos valeurs', 'waicam' ),
		'description' => __( 'Titre, description et 3 cartes valeurs.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );

	$about_values_fields = array(
		'waicam_about_values_title'        => array( __( 'Titre section', 'waicam' ), 'NOS VALEURS', 'text' ),
		'waicam_about_values_text'         => array( __( 'Description section', 'waicam' ), "Ces valeurs définissent notre manière d'agir au quotidien.", 'textarea' ),
		'waicam_about_value_1_title'       => array( __( 'Carte 1 — Titre', 'waicam' ), 'BRAVOURE', 'text' ),
		'waicam_about_value_1_text'        => array( __( 'Carte 1 — Texte', 'waicam' ), "Nous avançons avec résilience, ambition et persévérance pour ouvrir plus d'opportunités.", 'textarea' ),
		'waicam_about_value_2_title'       => array( __( 'Carte 2 — Titre', 'waicam' ), 'SORORITÉ', 'text' ),
		'waicam_about_value_2_text'        => array( __( 'Carte 2 — Texte', 'waicam' ), "Nous croyons qu'une communauté diverse, solidaire et intergénérationnelle est plus forte.", 'textarea' ),
		'waicam_about_value_3_title'       => array( __( 'Carte 3 — Titre', 'waicam' ), 'ENGAGEMENT', 'text' ),
		'waicam_about_value_3_text'        => array( __( 'Carte 3 — Texte', 'waicam' ), "Nous préparons les femmes et les jeunes à transformer durablement leur environnement.", 'textarea' ),
	);
	foreach ( $about_values_fields as $key => $cfg ) {
		$sanitize = 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_values',
			'type'    => $cfg[2],
		) );
	}

	for ( $i = 1; $i <= 3; $i++ ) {
		$key = "waicam_about_value_{$i}_icon_id";
		$wp_customize->add_setting( $key, array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $key, array(
			'label'     => sprintf( __( 'Carte %d — Icône', 'waicam' ), $i ),
			'section'   => 'waicam_about_values',
			'mime_type' => 'image',
		) ) );
	}


	// ────────── Page About — Déclaration inclusion ──────────
	$wp_customize->add_section( 'waicam_about_statement', array(
		'title'       => __( 'À propos — Déclaration', 'waicam' ),
		'description' => __( 'Bloc texte fort avec CTA après Nos valeurs.', 'waicam' ),
		'panel'       => 'waicam_about_panel',
	) );
	$about_statement_fields = array(
		'waicam_about_statement_title'    => array( __( 'Titre', 'waicam' ), "WAI-CAM place l'inclusion, l'éthique et l'impact social au cœur de sa mission.", 'textarea' ),
		'waicam_about_statement_cta_text' => array( __( 'Texte lien', 'waicam' ), 'Lire notre déclaration d’inclusion', 'text' ),
		'waicam_about_statement_cta_url'  => array( __( 'URL lien', 'waicam' ), home_url( '/a-propos/' ), 'url' ),
	);

	$wp_customize->add_setting( 'waicam_about_reports_title', array(
		'default'           => 'ACTUALITÉS & ÉVÉNEMENTS',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'waicam_about_reports_title', array(
		'label'   => __( 'Titre section Actualités/Événements', 'waicam' ),
		'section' => 'waicam_about_statement',
		'type'    => 'text',
	) );
	foreach ( $about_statement_fields as $key => $cfg ) {
		if ( 'textarea' === $cfg[2] ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'url' === $cfg[2] ) {
			$sanitize = 'esc_url_raw';
		} else {
			$sanitize = 'sanitize_text_field';
		}
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_about_statement',
			'type'    => $cfg[2],
		) );
	}


	// ────────── Page Partenaires — Sections 1 & 2 ──────────
	$wp_customize->add_section( 'waicam_partners_page', array(
		'title'       => __( 'Partenaires — Intro & CTA', 'waicam' ),
		'description' => __( 'Deux premières sections de la page partenaires.', 'waicam' ),
		'panel'       => 'waicam_panel',
	) );
	$partners_fields = array(
		'waicam_partners_hero_title' => array( __( 'Titre hero', 'waicam' ), 'DEVENEZ PARTENAIRE', 'text' ),
		'waicam_partners_hero_text_1' => array( __( 'Texte hero 1', 'waicam' ), "Women in AI Cameroon (WAI-CAM) est un mouvement citoyen qui promeut une IA inclusive, utile et accessible aux femmes et aux jeunes à travers le Cameroun.", 'textarea' ),
		'waicam_partners_hero_text_2' => array( __( 'Texte hero 2', 'waicam' ), "En soutenant nos initiatives, vous contribuez au renforcement des compétences, à l'innovation locale et à une meilleure représentation des femmes dans les métiers du numérique et de l'IA.", 'textarea' ),
		'waicam_partners_cta_title' => array( __( 'Titre bloc CTA', 'waicam' ), 'REJOIGNEZ NOTRE MISSION', 'text' ),
		'waicam_partners_cta_text_1' => array( __( 'Texte CTA 1', 'waicam' ), 'Nous développons des opportunités de partenariat institutionnel, éducatif, média et entreprise.', 'textarea' ),
		'waicam_partners_cta_text_2' => array( __( 'Texte CTA 2', 'waicam' ), 'Soumettez votre demande de partenariat dès aujourd’hui.', 'textarea' ),
		'waicam_partners_cta_btn' => array( __( 'Texte bouton', 'waicam' ), 'FAIRE UNE DEMANDE DE PARTENARIAT', 'text' ),
		'waicam_partners_cta_url' => array( __( 'URL bouton', 'waicam' ), '#form-partenariat', 'url' ),
	);
	foreach ( $partners_fields as $key => $cfg ) {
		if ( 'textarea' === $cfg[2] ) $sanitize = 'sanitize_textarea_field';
		elseif ( 'url' === $cfg[2] ) $sanitize = 'esc_url_raw';
		else $sanitize = 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_partners_page',
			'type'    => $cfg[2],
		) );
	}
	$wp_customize->add_setting( 'waicam_partners_cta_image_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'waicam_partners_cta_image_id', array(
		'label'     => __( 'Image bloc CTA', 'waicam' ),
		'section'   => 'waicam_partners_page',
		'mime_type' => 'image',
	) ) );


	$wp_customize->add_section( 'waicam_partners_impact', array(
		'title'       => __( 'Partenaires — Impact', 'waicam' ),
		'description' => __( 'Section impact et 4 blocs partenaires.', 'waicam' ),
		'panel'       => 'waicam_panel',
	) );
	$partners_impact_fields = array(
		'waicam_partners_impact_title' => array( __( 'Titre section', 'waicam' ), 'CRÉER DE L’IMPACT', 'text' ),
		'waicam_partners_impact_text'  => array( __( 'Texte intro', 'waicam' ), "Nos actions ne seraient pas possibles sans nos partenaires institutionnels, entreprises et acteurs publics. Ensemble, nous accélérons l'inclusion des femmes dans les métiers du numérique et de l'IA.", 'textarea' ),
		'waicam_partners_impact_1_title' => array( __( 'Bloc 1 — Titre', 'waicam' ), 'INSTITUTIONS', 'text' ),
		'waicam_partners_impact_1_text'  => array( __( 'Bloc 1 — Texte', 'waicam' ), 'Universités, centres de recherche et institutions académiques engagées à nos côtés.', 'textarea' ),
		'waicam_partners_impact_2_title' => array( __( 'Bloc 2 — Titre', 'waicam' ), 'ENTREPRISES', 'text' ),
		'waicam_partners_impact_2_text'  => array( __( 'Bloc 2 — Texte', 'waicam' ), 'Entreprises qui soutiennent nos programmes de formation, mentorat et insertion.', 'textarea' ),
		'waicam_partners_impact_3_title' => array( __( 'Bloc 3 — Titre', 'waicam' ), 'RÉSEAUX', 'text' ),
		'waicam_partners_impact_3_text'  => array( __( 'Bloc 3 — Texte', 'waicam' ), 'Réseaux professionnels et communautés mobilisées pour amplifier l’impact.', 'textarea' ),
		'waicam_partners_impact_4_title' => array( __( 'Bloc 4 — Titre', 'waicam' ), 'INSTITUTIONS PUBLIQUES', 'text' ),
		'waicam_partners_impact_4_text'  => array( __( 'Bloc 4 — Texte', 'waicam' ), 'Institutions publiques partenaires pour porter une IA responsable et inclusive.', 'textarea' ),
	);
	foreach ( $partners_impact_fields as $key => $cfg ) {
		$sanitize = 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_partners_impact',
			'type'    => $cfg[2],
		) );
	}


	$wp_customize->add_section( 'waicam_partners_quote', array(
		'title'       => __( 'Partenaires — Témoignage', 'waicam' ),
		'description' => __( 'Bloc témoignage partenaire image + citation.', 'waicam' ),
		'panel'       => 'waicam_panel',
	) );
	$partners_quote_fields = array(
		'waicam_partners_quote_text' => array( __( 'Citation', 'waicam' ), "En collaborant avec WAI-CAM, nous renforçons notre impact social tout en soutenant l'inclusion des femmes dans les métiers du numérique.", 'textarea' ),
		'waicam_partners_quote_author' => array( __( 'Auteur', 'waicam' ), 'Partenaire institutionnel — WAI-CAM', 'text' ),
		'waicam_partners_quote_role' => array( __( 'Fonction', 'waicam' ), 'Direction générale', 'text' ),
		'waicam_partners_quote_linkedin' => array( __( 'URL LinkedIn', 'waicam' ), '#', 'url' ),
	);
	foreach ( $partners_quote_fields as $key => $cfg ) {
		if ( 'textarea' === $cfg[2] ) $sanitize = 'sanitize_textarea_field';
		elseif ( 'url' === $cfg[2] ) $sanitize = 'esc_url_raw';
		else $sanitize = 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_partners_quote',
			'type'    => $cfg[2],
		) );
	}
	$wp_customize->add_setting( 'waicam_partners_quote_image_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'waicam_partners_quote_image_id', array(
		'label'     => __( 'Image témoignage', 'waicam' ),
		'section'   => 'waicam_partners_quote',
		'mime_type' => 'image',
	) ) );


	$wp_customize->add_section( 'waicam_partners_stats', array(
		'title'       => __( 'Partenaires — Communauté', 'waicam' ),
		'description' => __( 'Bloc communauté avec statistiques sur image.', 'waicam' ),
		'panel'       => 'waicam_panel',
	) );
	$partners_stats_fields = array(
		'waicam_partners_stats_title' => array( __( 'Titre section', 'waicam' ), 'CONNECTEZ-VOUS À NOTRE COMMUNAUTÉ', 'text' ),
		'waicam_partners_stats_text'  => array( __( 'Texte intro', 'waicam' ), "Nos membres sont engagés dans la tech, l'innovation et l'impact social au Cameroun et au-delà.", 'textarea' ),
		'waicam_partners_stats_1_number' => array( __( 'Stat 1 — Chiffre', 'waicam' ), '12,800', 'text' ),
		'waicam_partners_stats_1_label'  => array( __( 'Stat 1 — Libellé', 'waicam' ), 'MEMBRES ET COMMUNAUTÉ', 'text' ),
		'waicam_partners_stats_2_number' => array( __( 'Stat 2 — Chiffre', 'waicam' ), '25-45', 'text' ),
		'waicam_partners_stats_2_label'  => array( __( 'Stat 2 — Libellé', 'waicam' ), 'ÂGE MAJORITAIRE', 'text' ),
		'waicam_partners_stats_3_number' => array( __( 'Stat 3 — Chiffre', 'waicam' ), '42%', 'text' ),
		'waicam_partners_stats_3_label'  => array( __( 'Stat 3 — Libellé', 'waicam' ), 'DIPLÔMÉES SUPÉRIEUR', 'text' ),
		'waicam_partners_stats_4_number' => array( __( 'Stat 4 — Chiffre', 'waicam' ), '40%', 'text' ),
		'waicam_partners_stats_4_label'  => array( __( 'Stat 4 — Libellé', 'waicam' ), 'PROFILS SENIORS', 'text' ),
	);
	foreach ( $partners_stats_fields as $key => $cfg ) {
		$sanitize = 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_partners_stats',
			'type'    => $cfg[2],
		) );
	}
	$wp_customize->add_setting( 'waicam_partners_stats_image_id', array(
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'waicam_partners_stats_image_id', array(
		'label'     => __( 'Image de fond stats', 'waicam' ),
		'section'   => 'waicam_partners_stats',
		'mime_type' => 'image',
	) ) );


	$wp_customize->add_section( 'waicam_partners_logos', array(
		'title'       => __( 'Partenaires — Mur de logos', 'waicam' ),
		'description' => __( 'Titre et texte du mur de logos partenaires.', 'waicam' ),
		'panel'       => 'waicam_panel',
	) );
	$partners_logos_fields = array(
		'waicam_partners_logos_title' => array( __( 'Titre section', 'waicam' ), 'NOS PARTENAIRES', 'text' ),
		'waicam_partners_logos_text'  => array( __( 'Texte intro', 'waicam' ), 'Nous remercions nos partenaires pour leur confiance et leur soutien.', 'textarea' ),
	);
	foreach ( $partners_logos_fields as $key => $cfg ) {
		$sanitize = 'textarea' === $cfg[2] ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_partners_logos',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Section Home partenaires ──────────
	$wp_customize->add_section( 'waicam_home_partners', array(
		'title'       => __( 'Accueil — Partenaires', 'waicam' ),
		'description' => __( 'Bloc partenaires de fin de page.', 'waicam' ),
		'panel'       => 'waicam_home_panel',
	) );
	$partner_fields = array(
		'waicam_home_partners_title'    => array( __( 'Titre', 'waicam' ), 'Devenez partenaire Women in AI Cameroon', 'text' ),
		'waicam_home_partners_text'     => array( __( 'Texte', 'waicam' ), 'Chaque année, des entreprises et institutions soutiennent nos programmes de formation, mentorat et inclusion numérique au Cameroun.', 'textarea' ),
		'waicam_home_partners_cta_text' => array( __( 'Texte lien', 'waicam' ), 'Voir nos partenaires', 'text' ),
		'waicam_home_partners_cta_url'  => array( __( 'URL lien', 'waicam' ), home_url( '/partenaires' ), 'url' ),
	);
	foreach ( $partner_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : 'sanitize_text_field';
		if ( $cfg[2] === 'textarea' ) $sanitize = 'sanitize_textarea_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_home_partners',
			'type'    => $cfg[2],
		) );
	}

	// ────────── Panneau Rejoindre (Get Involved) ──────────
	$wp_customize->add_panel( 'waicam_rejoindre_panel', array(
		'title'    => __( 'WAI-CAM — Rejoindre', 'waicam' ),
		'priority' => 33,
	) );

	// Section Hero
	$wp_customize->add_section( 'waicam_rejoindre_hero', array(
		'title' => __( 'Rejoindre — Hero', 'waicam' ),
		'panel' => 'waicam_rejoindre_panel',
	) );

	$rejoindre_hero_fields = array(
		'waicam_rejoindre_hero_badge' => array( __( 'Badge', 'waicam' ), 'GET INVOLVED', 'text' ),
		'waicam_rejoindre_hero_title' => array( __( 'Titre', 'waicam' ), 'WAI-CAM A BESOIN DE VOTRE SOUTIEN', 'text' ),
		'waicam_rejoindre_hero_text'  => array( __( 'Texte', 'waicam' ), "Les femmes ont besoin de votre soutien pour s'épanouir dans la tech, et il existe de nombreuses façons de nous aider.", 'textarea' ),
	);

	foreach ( $rejoindre_hero_fields as $key => $cfg ) {
		$sanitize = $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field';
		$wp_customize->add_setting( $key, array(
			'default'           => $cfg[1],
			'sanitize_callback' => $sanitize,
		) );
		$wp_customize->add_control( $key, array(
			'label'   => $cfg[0],
			'section' => 'waicam_rejoindre_hero',
			'type'    => $cfg[2],
		) );
	}

	// Section Cartes (Involvement Cards)
	$wp_customize->add_section( 'waicam_rejoindre_cards', array(
		'title' => __( 'Rejoindre — Cartes d’engagement', 'waicam' ),
		'panel' => 'waicam_rejoindre_panel',
	) );

	for ( $i = 1; $i <= 4; $i++ ) {
		$defaults = array(
			1 => array( 'DEVENIR MEMBRE', "Rejoignez notre communauté active pour échanger, apprendre et participer à nos ateliers.", "Engagement libre", 'En savoir plus', home_url('/rejoindre') ),
			2 => array( 'DEVENIR VOLONTAIRE', "Donnez de votre temps pour encadrer nos sessions de formation ou aider à l'organisation.", "Selon vos disponibilités", 'En savoir plus', home_url('/contact') ),
			3 => array( 'PARTENARIATS', "Associez votre entreprise ou institution à nos programmes d'inclusion numérique.", "Sur mesure", 'En savoir plus', home_url('/partenaires') ),
			4 => array( 'AMBASSADRICE', "Représentez WAI-CAM dans votre localité ou établissement pour porter notre mission.", "Continu", 'En savoir plus', home_url('/contact') ),
		);

		$card_fields = array(
			"waicam_rejoindre_card_{$i}_title" => array( sprintf( __( 'Carte %d — Titre', 'waicam' ), $i ), $defaults[$i][0], 'text' ),
			"waicam_rejoindre_card_{$i}_text"  => array( sprintf( __( 'Carte %d — Description', 'waicam' ), $i ), $defaults[$i][1], 'textarea' ),
			"waicam_rejoindre_card_{$i}_commit"=> array( sprintf( __( 'Carte %d — Engagement', 'waicam' ), $i ), $defaults[$i][2], 'text' ),
			"waicam_rejoindre_card_{$i}_btn"   => array( sprintf( __( 'Carte %d — Texte bouton', 'waicam' ), $i ), $defaults[$i][3], 'text' ),
			"waicam_rejoindre_card_{$i}_url"   => array( sprintf( __( 'Carte %d — URL bouton', 'waicam' ), $i ), $defaults[$i][4], 'url' ),
		);

		foreach ( $card_fields as $key => $cfg ) {
			$sanitize = $cfg[2] === 'url' ? 'esc_url_raw' : ( $cfg[2] === 'textarea' ? 'sanitize_textarea_field' : 'sanitize_text_field' );
			$wp_customize->add_setting( $key, array(
				'default'           => $cfg[1],
				'sanitize_callback' => $sanitize,
			) );
			$wp_customize->add_control( $key, array(
				'label'   => $cfg[0],
				'section' => 'waicam_rejoindre_cards',
				'type'    => $cfg[2],
			) );
		}
	}
	}
	add_action( 'customize_register', 'waicam_customize_register' );

/**
 * Sanitize CSS classes for body / nav (compat WP)
 */
function waicam_body_classes( $classes ) {
	if ( is_singular() ) $classes[] = 'singular';
	return $classes;
}
add_filter( 'body_class', 'waicam_body_classes' );

/**
 * Largeur d'image par défaut
 */
function waicam_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'waicam_content_width', 1200 );
}
add_action( 'after_setup_theme', 'waicam_content_width', 0 );

/**
 * ============================================================
 *  DON via WooCommerce — gestion du montant libre (NYP)
 * ============================================================
 * Lorsque le visiteur soumet le formulaire de don depuis
 * /faire-un-don/, l'URL contient `?add-to-cart=ID&nyp=MONTANT`.
 * Ces hooks lisent le paramètre nyp et l'appliquent au prix
 * de l'article ajouté au panier.
 */

/**
 * 1. Stocke le montant NYP comme méta de l'article-panier au moment de l'ajout.
 */
add_filter( 'woocommerce_add_cart_item_data', function( $cart_item_data, $product_id ) {
	$donation_product_id = (int) get_theme_mod( 'waicam_donation_product_id', 0 );
	if ( ! $donation_product_id || (int) $product_id !== $donation_product_id ) {
		return $cart_item_data;
	}

	if ( isset( $_REQUEST['nyp'] ) && is_numeric( $_REQUEST['nyp'] ) ) {
		$amount = (float) $_REQUEST['nyp'];
		if ( $amount >= 500 ) {
			$cart_item_data['waicam_nyp'] = $amount;
			// Force unicité : chaque don a sa propre clé pour ne pas se cumuler en quantité
			$cart_item_data['unique_key'] = md5( microtime() . wp_rand() );
		}

		}
	return $cart_item_data;
}, 10, 2 );

/**
 * 2. Avant le calcul des totaux, applique le montant NYP au prix de l'article.
 *    On force aussi le "prix régulier" à la même valeur pour éviter que WC
 *    affiche un faux "Économisez X CFA" quand le don est < prix régulier.
 */
add_action( 'woocommerce_before_calculate_totals', function( $cart ) {
	if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;
	if ( ! $cart || ! $cart->get_cart() ) return;

	foreach ( $cart->get_cart() as $cart_item ) {
		if ( ! empty( $cart_item['waicam_nyp'] ) && isset( $cart_item['data'] ) ) {
			$amount = (float) $cart_item['waicam_nyp'];
			$cart_item['data']->set_price( $amount );
			$cart_item['data']->set_regular_price( $amount );
			$cart_item['data']->set_sale_price( '' );
		}
	}
}, 20 );

/**
 * 3. Vide le panier de tout don précédent quand on ajoute un nouveau don
 *    (évite que le visiteur cumule plusieurs montants par erreur).
 */
add_action( 'woocommerce_add_to_cart', function( $cart_item_key, $product_id ) {
	$donation_product_id = (int) get_theme_mod( 'waicam_donation_product_id', 0 );
	if ( ! $donation_product_id || (int) $product_id !== $donation_product_id ) return;
	if ( ! WC()->cart ) return;

	foreach ( WC()->cart->get_cart() as $key => $item ) {
		if ( $key !== $cart_item_key && (int) $item['product_id'] === $donation_product_id ) {
			WC()->cart->remove_cart_item( $key );
		}
	}
}, 10, 2 );

/**
 * 4. Persiste le montant NYP entre les sessions (rechargement de page).
 */
add_filter( 'woocommerce_get_cart_item_from_session', function( $cart_item, $values ) {
	if ( isset( $values['waicam_nyp'] ) ) {
		$cart_item['waicam_nyp'] = $values['waicam_nyp'];
		if ( isset( $cart_item['data'] ) ) {
			$cart_item['data']->set_price( (float) $values['waicam_nyp'] );
		}
	}
	return $cart_item;
}, 10, 2 );
