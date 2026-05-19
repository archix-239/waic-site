<?php
/**
 * Helpers réutilisables pour le thème WAI-CAM.
 *
 * Tous les champs personnalisés sont lus via ACF (get_field).
 * Si ACF n'est pas actif, les helpers retombent sur get_post_meta().
 *
 * @package WAICAM
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Récupère un champ ACF (avec fallback get_post_meta si ACF absent).
 *
 * @param string $slug    Le slug ACF du champ (ex: 'nom_complet')
 * @param int    $post_id ID du post (par défaut = post courant)
 * @param mixed  $default Valeur par défaut si vide
 */
function waicam_field( $slug, $post_id = null, $default = '' ) {
	$post_id = $post_id ?: get_the_ID();
	if ( function_exists( 'get_field' ) ) {
		$v = get_field( $slug, $post_id );
		return ( $v !== '' && $v !== null && $v !== false ) ? $v : $default;
	}
	$v = get_post_meta( $post_id, $slug, true );
	return $v ? $v : $default;
}

/**
 * Récupère une URL d'image à partir d'un champ ACF Image.
 * ACF peut retourner un array (ID, URL, alt…) ou juste un ID selon la config.
 *
 * @param string $slug    Slug ACF du champ image
 * @param int    $post_id ID du post
 * @param string $size    Taille d'image WP ('thumbnail', 'medium', 'large', 'full')
 * @param string $fallback Nom de fichier dans assets/images/ si vide
 */
function waicam_image_url( $slug, $post_id = null, $size = 'large', $fallback = 'hero-women.jpg' ) {
	$post_id = $post_id ?: get_the_ID();
	$value   = function_exists( 'get_field' ) ? get_field( $slug, $post_id ) : get_post_meta( $post_id, $slug, true );

	if ( is_array( $value ) ) {
		// ACF en mode "Tableau d'image"
		if ( ! empty( $value['sizes'][ $size ] ) ) return $value['sizes'][ $size ];
		if ( ! empty( $value['url'] ) ) return $value['url'];
	} elseif ( is_numeric( $value ) ) {
		// ACF en mode "ID"
		$src = wp_get_attachment_image_src( (int) $value, $size );
		if ( $src ) return $src[0];
	} elseif ( is_string( $value ) && filter_var( $value, FILTER_VALIDATE_URL ) ) {
		// ACF en mode "URL"
		return $value;
	}

	// Fallback : image embarquée dans le thème
	return waicam_img( $fallback );
}

/**
 * Affiche directement <img> à partir d'un champ ACF image.
 */
function waicam_image( $slug, $post_id = null, $size = 'large', $fallback = 'hero-women.jpg', $alt = '', $class = '' ) {
	$url = waicam_image_url( $slug, $post_id, $size, $fallback );
	$alt = $alt ?: get_the_title( $post_id ?: get_the_ID() );
	$cls = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '"' . $cls . ' loading="lazy" />';
}

/**
 * Affiche l'image en vedette OU une image par défaut du thème
 * OU une image ACF si aucune image mise en avant n'est définie.
 */
function waicam_thumbnail( $post_id = null, $size = 'large', $fallback = 'hero-women.jpg', $attrs = array(), $acf_fallback = '' ) {
	$post_id = $post_id ?: get_the_ID();

	if ( has_post_thumbnail( $post_id ) ) {
		$attrs['loading'] = $attrs['loading'] ?? 'lazy';
		echo get_the_post_thumbnail( $post_id, $size, $attrs );
		return;
	}

	if ( $acf_fallback ) {
		$url = waicam_image_url( $acf_fallback, $post_id, $size, $fallback );
		$alt = get_the_title( $post_id );
		$attr_str = ' loading="lazy"';
		foreach ( $attrs as $k => $v ) {
			$attr_str .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
		}
		echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '"' . $attr_str . ' />';
		return;
	}

	$src = WAICAM_URI . '/assets/images/' . $fallback;
	$alt = get_the_title( $post_id );
	$attr_str = ' loading="lazy"';
	foreach ( $attrs as $k => $v ) {
		$attr_str .= ' ' . esc_attr( $k ) . '="' . esc_attr( $v ) . '"';
	}
	echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $alt ) . '"' . $attr_str . ' />';
}

/**
 * Date formatée fr.
 */
function waicam_date_fr( $post_id = null, $date = null ) {
	if ( $date ) {
		// Utile pour les dates ACF (format Ymd ou similaire)
		$ts = strtotime( str_replace( '/', '-', $date ) );
		return $ts ? wp_date( 'j F Y', $ts ) : $date;
	}
	$post_id = $post_id ?: get_the_ID();
	return wp_date( 'j F Y', get_post_timestamp( $post_id ) );
}

/**
 * Tronque un texte à N caractères en respectant les mots.
 */
function waicam_excerpt( $text, $limit = 160 ) {
	$text = wp_strip_all_tags( $text );
	if ( mb_strlen( $text ) <= $limit ) return $text;
	$text = mb_substr( $text, 0, $limit );
	$text = mb_substr( $text, 0, mb_strrpos( $text, ' ' ) );
	return $text . '…';
}

/**
 * Récupère l'URL d'une image embarquée dans le thème.
 */
function waicam_img( $filename ) {
	return WAICAM_URI . '/assets/images/' . $filename;
}

/**
 * Helper d'inclusion de template-part.
 */
function waicam_part( $slug, $name = null, $args = array() ) {
	get_template_part( 'template-parts/' . $slug, $name, $args );
}

/**
 * Récupère les programmes pour la page d'accueil.
 * @return WP_Query|null
 */
function waicam_get_programmes( $limit = 4 ) {
	if ( ! post_type_exists( 'programme' ) ) return null;

	$query = new WP_Query( array(
		'post_type'      => 'programme',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'ASC',
	) );

	return $query->have_posts() ? $query : null;
}

/**
 * Récupère les évènements via The Events Calendar (CPT `tribe_events`).
 *
 * @param int    $limit   Nombre d'évènements (-1 pour tous)
 * @param string $statut  '' (tous) | 'a-venir' | 'en-cours' | 'passe'
 * @return WP_Query|null
 */
function waicam_get_evenements( $limit = 3, $statut = '' ) {
	if ( ! function_exists( 'tribe_get_events' ) ) return null;

	$args = array(
		'posts_per_page' => $limit,
	);

	$now = current_time( 'Y-m-d H:i:s' );
	$st  = waicam_slug( $statut );

	if ( $st === 'passe' ) {
		$args['ends_before'] = $now;
		$args['order']       = 'DESC';
	} elseif ( $st === 'a-venir' || $st === 'en-cours' || $st === '' ) {
		$args['ends_after'] = $now;
		$args['order']      = 'ASC';
	}

	$events = tribe_get_events( $args, true );
	return ( $events && $events->have_posts() ) ? $events : null;
}

/**
 * Récupère les témoignages (limit ou tous).
 */
function waicam_get_temoignages( $limit = -1 ) {
	if ( ! post_type_exists( 'temoignage' ) ) return null;

	$query = new WP_Query( array(
		'post_type'      => 'temoignage',
		'posts_per_page' => $limit,
		'orderby'        => 'date',
		'order'          => 'ASC',
	) );

	return $query->have_posts() ? $query : null;
}

/**
 * Récupère les partenaires.
 *
 * @param string $type Filtre type de partenariat ('Institutionnel', 'Financier', etc.)
 */
function waicam_get_partenaires( $limit = -1, $type = '' ) {
	if ( ! post_type_exists( 'partenaire' ) ) return null;

	$args = array(
		'post_type'      => 'partenaire',
		'posts_per_page' => $limit,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);

	if ( $type ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'type_de_partenariat',
				'value'   => $type,
				'compare' => '=',
			),
		);
	}

	$query = new WP_Query( $args );
	return $query->have_posts() ? $query : null;
}

/**
 * Génère une couleur de carte programme cohérente à partir du nom du programme.
 * Utilisé dans les templates qui affichent les 4 programmes.
 */
function waicam_programme_color( $nom ) {
	$nom = strtoupper( trim( $nom ) );
	$map = array(
		'YOUTH & AI'           => 'c1',
		'IA & PUBLIC SERVICE'  => 'c2',
		'WOMEN LEADERS FOR AI' => 'c3',
		'AI FOR COMMUNITIES'   => 'c4',
	);
	return $map[ $nom ] ?? 'c1';
}

/**
 * Génère une icône Font Awesome pour le programme à partir du nom.
 * Retourne du HTML — à utiliser avec wp_kses_post() ou echo direct, PAS esc_html().
 */
function waicam_programme_icone( $nom ) {
	$nom = strtoupper( trim( $nom ) );
	$map = array(
		'YOUTH & AI'           => '<i class="fa-solid fa-rocket"></i>',
		'IA & PUBLIC SERVICE'  => '<i class="fa-solid fa-landmark"></i>',
		'WOMEN LEADERS FOR AI' => '<i class="fa-solid fa-crown"></i>',
		'AI FOR COMMUNITIES'   => '<i class="fa-solid fa-leaf"></i>',
	);
	return $map[ $nom ] ?? '<i class="fa-solid fa-wand-magic-sparkles"></i>';
}

/**
 * Normalise une chaîne en slug minuscule sans accent.
 * Utile pour comparer des valeurs ACF qui peuvent être stockées en slug ou en libellé.
 * Ex: "À venir" → "a-venir", "À Venir" → "a-venir", "a_venir" → "a-venir"
 */
function waicam_slug( $str ) {
	$s = strtolower( (string) $str );
	$s = remove_accents( $s );
	$s = str_replace( '_', '-', $s );
	$s = preg_replace( '/[^a-z0-9-]+/', '-', $s );
	return trim( $s, '-' );
}

/**
 * Convertit une valeur ACF (slug ou label) en libellé humain agréable.
 *
 * Ex: "a_venir" → "À venir", "passe" → "Passé", "conference" → "Conférence"
 */
function waicam_format_select( $value ) {
	if ( empty( $value ) ) return '';

	$slug = waicam_slug( $value );
	$map = array(
		// Statuts évènement
		'a-venir'      => 'À venir',
		'en-cours'     => 'En cours',
		'passe'        => 'Passé',
		// Types évènement
		'conference'   => 'Conférence',
		'formation'    => 'Formation',
		'atelier'      => 'Atelier',
		'masterclass'  => 'Masterclass',
		'bootcamp'     => 'Bootcamp',
		'webinaire'    => 'Webinaire',
		// Niveaux formation
		'debutant'        => 'Débutant',
		'intermediaire'   => 'Intermédiaire',
		'avance'          => 'Avancé',
		'tous-niveaux'    => 'Tous niveaux',
		// Types partenariat
		'institutionnel'  => 'Institutionnel',
		'financier'       => 'Financier',
		'media'           => 'Média',
		'technique'       => 'Technique',
	);

	return $map[ $slug ] ?? ucfirst( $value );
}

/**
 * Vérifie si une valeur ACF correspond à un slug donné (insensible à la casse, accents, etc.).
 *
 * Ex: waicam_match( 'À venir', 'a-venir' ) === true
 * Ex: waicam_match( 'a_venir', 'a-venir' ) === true
 */
function waicam_match( $value, $expected_slug ) {
	return waicam_slug( $value ) === waicam_slug( $expected_slug );
}

/**
 * Vérifie si un type d'évènement correspond à une formation
 * (Formation, Masterclass, Atelier, Bootcamp).
 */
function waicam_is_formation_type( $type ) {
	$slug = waicam_slug( $type );
	return in_array( $slug, array( 'formation', 'masterclass', 'atelier', 'bootcamp' ), true );
}

/**
 * Récupère les formations (= évènements de catégorie Formation/Masterclass/Atelier/Bootcamp).
 *
 * @param int    $limit
 * @param string $statut '' (tous) | 'a-venir' | 'en-cours' | 'passe'
 * @return WP_Query|null
 */
function waicam_get_formations( $limit = -1, $statut = '' ) {
	if ( ! function_exists( 'tribe_get_events' ) ) return null;

	$args = array(
		'posts_per_page' => $limit,
		'tax_query'      => array(
			array(
				'taxonomy' => 'tribe_events_cat',
				'field'    => 'slug',
				'terms'    => array( 'formation', 'masterclass', 'atelier', 'bootcamp' ),
			),
		),
	);

	$now = current_time( 'Y-m-d H:i:s' );
	$st  = waicam_slug( $statut );

	if ( $st === 'passe' ) {
		$args['ends_before'] = $now;
		$args['order']       = 'DESC';
	} elseif ( $st === 'a-venir' || $st === 'en-cours' || $st === '' ) {
		$args['ends_after'] = $now;
		$args['order']      = 'ASC';
	}

	$events = tribe_get_events( $args, true );
	return ( $events && $events->have_posts() ) ? $events : null;
}

/**
 * ============================================================
 *  WRAPPERS THE EVENTS CALENDAR — accès données évènements
 * ============================================================
 *  Ces helpers abstraient l'accès aux données d'un évènement.
 *  Les templates s'appuient sur eux plutôt que sur les fonctions
 *  natives `tribe_*` directement → permet d'évoluer sans casser.
 */

/**
 * Date de début formatée FR (ex: "24 janvier 2026").
 */
function waicam_event_date( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( function_exists( 'tribe_get_start_date' ) ) {
		return tribe_get_start_date( $post_id, false, 'j F Y' );
	}
	return '';
}

/**
 * Plage horaire (ex: "08h30 - 17h00") ou vide si all-day.
 */
function waicam_event_time_range( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'tribe_get_start_date' ) ) return '';
	if ( function_exists( 'tribe_event_is_all_day' ) && tribe_event_is_all_day( $post_id ) ) return '';

	$start = tribe_get_start_date( $post_id, false, 'H\hi' );
	$end   = tribe_get_end_date( $post_id, false, 'H\hi' );

	return ( $start && $end && $start !== $end ) ? "{$start} - {$end}" : $start;
}

/**
 * Lieu (Venue) lié à l'évènement.
 */
function waicam_event_venue( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( function_exists( 'tribe_get_venue' ) ) {
		return tribe_get_venue( $post_id );
	}
	return '';
}

/**
 * Type d'évènement (1ʳᵉ catégorie tribe_events_cat).
 */
function waicam_event_type( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$terms   = get_the_terms( $post_id, 'tribe_events_cat' );
	return ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : '';
}

/**
 * Statut dérivé : 'a-venir' | 'en-cours' | 'passe'.
 */
function waicam_event_status( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'tribe_get_start_date' ) ) return 'a-venir';

	$start_ts = strtotime( tribe_get_start_date( $post_id, false, 'Y-m-d H:i:s' ) );
	$end_ts   = strtotime( tribe_get_end_date( $post_id, false, 'Y-m-d H:i:s' ) );
	$now_ts   = current_time( 'timestamp' );

	if ( $end_ts && $end_ts < $now_ts ) return 'passe';
	if ( $start_ts && $start_ts <= $now_ts && ( ! $end_ts || $end_ts >= $now_ts ) ) return 'en-cours';
	return 'a-venir';
}

/**
 * Libellé humain du statut ('À venir' / 'En cours' / 'Passé').
 */
function waicam_event_status_label( $post_id = null ) {
	return waicam_format_select( waicam_event_status( $post_id ) );
}

/**
 * Description de l'évènement (excerpt court).
 */
function waicam_event_excerpt( $post_id = null, $length = 160 ) {
	$post_id = $post_id ?: get_the_ID();
	$post    = get_post( $post_id );
	if ( ! $post ) return '';
	$text = $post->post_excerpt ?: $post->post_content;
	return waicam_excerpt( $text, $length );
}

/**
 * URL image à la une (avec fallback du thème).
 */
function waicam_event_image_url( $post_id = null, $size = 'medium_large', $fallback = 'training-1.jpg' ) {
	$post_id = $post_id ?: get_the_ID();
	if ( has_post_thumbnail( $post_id ) ) {
		$url = get_the_post_thumbnail_url( $post_id, $size );
		if ( $url ) return $url;
	}
	return waicam_img( $fallback );
}

/**
 * Vrai si l'évènement est une formation (catégorie incluse).
 */
function waicam_event_is_formation( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$terms   = get_the_terms( $post_id, 'tribe_events_cat' );
	if ( ! $terms || is_wp_error( $terms ) ) return false;

	$formations = array( 'formation', 'masterclass', 'atelier', 'bootcamp' );
	foreach ( $terms as $term ) {
		if ( in_array( waicam_slug( $term->slug ), $formations, true ) ) return true;
	}
	return false;
}

/**
 * URL de l'archive événements (The Events Calendar).
 */
function waicam_events_archive_url() {
	if ( function_exists( 'tribe_get_events_link' ) ) {
		return tribe_get_events_link();
	}
	return home_url( '/evenements/' );
}
