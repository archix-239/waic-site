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
