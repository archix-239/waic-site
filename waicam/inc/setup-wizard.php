<?php
/**
 * Auto-installation des pages et du menu lors de l'activation du thème.
 *
 * @package WAICAM
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Crée automatiquement les pages WP nécessaires + assigne les templates,
 * configure la page d'accueil, et installe le menu principal.
 */
function waicam_setup_pages_and_menu() {

	// ─── 1. Définition des pages à créer ───
	$pages = array(
		'accueil' => array(
			'title'    => __( 'Accueil', 'waicam' ),
			'template' => '', // front-page.php est appliqué automatiquement
			'order'    => 1,
		),
		'about' => array(
			'title'    => __( 'À propos', 'waicam' ),
			'template' => 'page-templates/template-about.php',
			'order'    => 2,
		),
		'programmes' => array(
			'title'    => __( 'Programmes', 'waicam' ),
			'template' => 'page-templates/template-programmes.php',
			'order'    => 3,
		),
		'formations' => array(
			'title'    => __( 'Formations', 'waicam' ),
			'template' => 'page-templates/template-formations.php',
			'order'    => 4,
		),
		'equipe' => array(
			'title'    => __( 'Équipe', 'waicam' ),
			'template' => 'page-templates/template-equipe.php',
			'order'    => 5,
		),
		'temoignages' => array(
			'title'    => __( 'Témoignages', 'waicam' ),
			'template' => 'page-templates/template-temoignages.php',
			'order'    => 6,
		),
		'partenaires' => array(
			'title'    => __( 'Partenaires', 'waicam' ),
			'template' => 'page-templates/template-partenaires.php',
			'order'    => 7,
		),
		'contact' => array(
			'title'    => __( 'Contact', 'waicam' ),
			'template' => 'page-templates/template-contact.php',
			'order'    => 8,
		),
		'rejoindre' => array(
			'title'    => __( 'Rejoindre', 'waicam' ),
			'template' => 'page-templates/template-rejoindre.php',
			'order'    => 9,
		),
		'faire-un-don' => array(
			'title'    => __( 'Faire un don', 'waicam' ),
			'template' => 'page-templates/template-don.php',
			'order'    => 10,
		),
		'blog' => array(
			'title'    => __( 'Blog', 'waicam' ),
			'template' => '', // index.php est utilisé automatiquement quand la page est définie comme "page des articles"
			'order'    => 11,
		),
		'galerie' => array(
			'title'    => __( 'Galerie', 'waicam' ),
			'template' => 'page-templates/template-galerie.php',
			'order'    => 12,
		),
	);

	$created_ids = array();

	// ─── 2. Créer les pages si elles n'existent pas déjà ───
	foreach ( $pages as $slug => $cfg ) {
		$existing = get_page_by_path( $slug );
		if ( $existing ) {
			$created_ids[ $slug ] = $existing->ID;
			continue; // On ne touche pas aux pages existantes
		}

		$page_id = wp_insert_post( array(
			'post_title'   => $cfg['title'],
			'post_name'    => $slug,
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '', // Le contenu vient des templates PHP
			'menu_order'   => $cfg['order'],
		) );

		if ( $page_id && ! is_wp_error( $page_id ) ) {
			$created_ids[ $slug ] = $page_id;
			if ( ! empty( $cfg['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $cfg['template'] );
			}
		}
	}

	// ─── 3. Définir l'accueil comme page statique ───
	if ( isset( $created_ids['accueil'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $created_ids['accueil'] );
	}

	// ─── 3 bis. Définir la page Blog comme "page des articles" ───
	if ( isset( $created_ids['blog'] ) ) {
		update_option( 'page_for_posts', $created_ids['blog'] );
	}

	// ─── 4. Créer le menu principal s'il n'existe pas ───
	$menu_name = __( 'Menu principal WAI-CAM', 'waicam' );
	$menu_obj  = wp_get_nav_menu_object( $menu_name );

	if ( ! $menu_obj ) {
		$menu_id = wp_create_nav_menu( $menu_name );

		// Items du menu (ordre + classes CSS)
		$menu_items = array(
			array( 'slug' => 'accueil',     'title' => __( 'Accueil', 'waicam' ),     'classes' => '' ),
			array( 'slug' => 'about',       'title' => __( 'À propos', 'waicam' ),    'classes' => '' ),
			array( 'slug' => 'programmes',  'title' => __( 'Programmes', 'waicam' ),  'classes' => '' ),
			array( 'slug' => 'formations',  'title' => __( 'Formations', 'waicam' ),  'classes' => '' ),
			array( 'slug' => 'equipe',      'title' => __( 'Équipe', 'waicam' ),      'classes' => '' ),
			array( 'slug' => 'evenement',   'title' => __( 'Évènements', 'waicam' ),  'classes' => '', 'is_archive' => true ),
			array( 'slug' => 'blog',        'title' => __( 'Blog', 'waicam' ),         'classes' => '' ),
			array( 'slug' => 'galerie',     'title' => __( 'Galerie', 'waicam' ),      'classes' => '' ),
			array( 'slug' => 'partenaires', 'title' => __( 'Partenaires', 'waicam' ), 'classes' => '' ),
			array( 'slug' => 'contact',       'title' => __( 'Contact', 'waicam' ),       'classes' => '' ),
			array( 'slug' => 'rejoindre',     'title' => __( 'Rejoindre', 'waicam' ),     'classes' => 'btn-nav' ),
			array( 'slug' => 'faire-un-don',  'title' => __( 'Faire un don', 'waicam' ),  'classes' => 'btn-nav btn-nav--don' ),
		);

		foreach ( $menu_items as $i => $item ) {
			if ( ! empty( $item['is_archive'] ) ) {
				// Item lien personnalisé pour l'archive The Events Calendar
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $item['title'],
					'menu-item-url'       => waicam_events_archive_url(),
					'menu-item-status'    => 'publish',
					'menu-item-type'      => 'custom',
					'menu-item-classes'   => $item['classes'],
					'menu-item-position'  => $i + 1,
				) );
			} elseif ( isset( $created_ids[ $item['slug'] ] ) ) {
				wp_update_nav_menu_item( $menu_id, 0, array(
					'menu-item-title'     => $item['title'],
					'menu-item-object-id' => $created_ids[ $item['slug'] ],
					'menu-item-object'    => 'page',
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-classes'   => $item['classes'],
					'menu-item-position'  => $i + 1,
				) );
			}
		}

		// Assigner le menu à l'emplacement "primary"
		$locations            = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $menu_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// ─── 5. Marquer l'installation comme terminée ───
	update_option( 'waicam_setup_done', '1' );

	// ─── 6. Vider les permaliens ───
	flush_rewrite_rules();
}

/**
 * Lance l'installation à l'activation du thème.
 */
add_action( 'after_switch_theme', 'waicam_setup_pages_and_menu' );

/**
 * Lien "Refaire l'installation" dans l'admin WP (Outils → WAI-CAM Setup).
 */
function waicam_setup_admin_menu() {
	add_management_page(
		__( 'WAI-CAM Setup', 'waicam' ),
		__( 'WAI-CAM Setup', 'waicam' ),
		'manage_options',
		'waicam-setup',
		'waicam_setup_admin_page'
	);
}
add_action( 'admin_menu', 'waicam_setup_admin_menu' );

function waicam_setup_admin_page() {
	if ( ! current_user_can( 'manage_options' ) ) return;

	if ( isset( $_POST['waicam_run_setup'] ) && check_admin_referer( 'waicam_setup' ) ) {
		waicam_setup_pages_and_menu();
		echo '<div class="notice notice-success"><p>' . esc_html__( '✅ Installation effectuée. Pages et menu créés.', 'waicam' ) . '</p></div>';
	}

	$pages_status = array(
		'accueil', 'about', 'programmes', 'formations', 'equipe', 'temoignages', 'partenaires', 'contact', 'rejoindre', 'faire-un-don', 'blog', 'galerie',
	);

	$cpt_required = array(
		'temoignage' => __( 'Témoignages', 'waicam' ),
		'partenaire' => __( 'Partenaires', 'waicam' ),
		'programme'  => __( 'Programmes', 'waicam' ),
		'evenement'  => __( 'Évènements', 'waicam' ),
	);
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'WAI-CAM — Assistant d\'installation', 'waicam' ); ?></h1>
		<p><?php esc_html_e( "Cet assistant crée automatiquement les pages WordPress, leur attribue le bon template et configure le menu principal.", 'waicam' ); ?></p>

		<h2><?php esc_html_e( 'État des CPT requis', 'waicam' ); ?></h2>
		<table class="widefat" style="max-width:600px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'CPT (slug)', 'waicam' ); ?></th>
					<th><?php esc_html_e( 'État', 'waicam' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $cpt_required as $slug => $label ) : ?>
					<tr>
						<td><code><?php echo esc_html( $slug ); ?></code> — <?php echo esc_html( $label ); ?></td>
						<td>
							<?php if ( post_type_exists( $slug ) ) : ?>
								<?php $count = wp_count_posts( $slug )->publish ?? 0; ?>
								<span style="color:#16A34A;">✅ <?php echo esc_html__( 'OK', 'waicam' ); ?></span>
								<?php
								/* translators: %d nombre d'articles publiés */
								printf( esc_html__( '— %d publié(s)', 'waicam' ), (int) $count );
								?>
							<?php else : ?>
								<span style="color:#DC2626;">❌ <?php esc_html_e( 'Non déclaré (vérifier CPT UI)', 'waicam' ); ?></span>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<h2 style="margin-top:32px;"><?php esc_html_e( 'État des pages', 'waicam' ); ?></h2>
		<table class="widefat" style="max-width:600px;">
			<thead>
				<tr>
					<th><?php esc_html_e( 'Page (slug)', 'waicam' ); ?></th>
					<th><?php esc_html_e( 'État', 'waicam' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $pages_status as $slug ) :
					$p = get_page_by_path( $slug );
				?>
					<tr>
						<td><code><?php echo esc_html( $slug ); ?></code></td>
						<td>
							<?php if ( $p ) : ?>
								<span style="color:#16A34A;">✅ <?php echo esc_html__( 'Existe', 'waicam' ); ?></span>
								— <a href="<?php echo esc_url( get_edit_post_link( $p->ID ) ); ?>"><?php esc_html_e( 'Modifier', 'waicam' ); ?></a>
								| <a href="<?php echo esc_url( get_permalink( $p->ID ) ); ?>" target="_blank"><?php esc_html_e( 'Voir', 'waicam' ); ?></a>
							<?php else : ?>
								<span style="color:#DC2626;">❌ <?php esc_html_e( 'Manquante', 'waicam' ); ?></span>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<h2 style="margin-top:32px;"><?php esc_html_e( 'Lancer / Relancer l\'installation', 'waicam' ); ?></h2>
		<p><?php esc_html_e( "Si certaines pages sont manquantes, tu peux relancer l'installation. Les pages déjà créées ne seront pas écrasées.", 'waicam' ); ?></p>
		<form method="post">
			<?php wp_nonce_field( 'waicam_setup' ); ?>
			<button type="submit" name="waicam_run_setup" class="button button-primary button-hero">
				🚀 <?php esc_html_e( 'Lancer l\'installation', 'waicam' ); ?>
			</button>
		</form>

		<h2 style="margin-top:32px;"><?php esc_html_e( 'Formulaires Fluent Forms', 'waicam' ); ?></h2>
		<p><?php esc_html_e( "Pour activer les formulaires (contact, adhésion, partenariat, programme, newsletter), va dans :", 'waicam' ); ?></p>
		<p><strong><?php esc_html_e( 'Apparence → Personnaliser → WAI-CAM → Formulaires', 'waicam' ); ?></strong></p>
		<p><?php esc_html_e( "Saisis-y les ID Fluent Forms (visibles dans Fluent Forms → Tous les formulaires, colonne ID).", 'waicam' ); ?></p>
	</div>
	<?php
}

/**
 * Notice d'admin la première fois qu'on accède au back-office si setup pas encore fait.
 */
function waicam_admin_setup_notice() {
	if ( get_option( 'waicam_setup_done' ) ) return;
	if ( ! current_user_can( 'manage_options' ) ) return;
	?>
	<div class="notice notice-info is-dismissible">
		<p>
			<strong>WAI-CAM :</strong>
			<?php esc_html_e( 'le thème nécessite une initialisation rapide pour créer les pages et le menu.', 'waicam' ); ?>
			<a href="<?php echo esc_url( admin_url( 'tools.php?page=waicam-setup' ) ); ?>" class="button button-primary" style="margin-left:8px;">
				<?php esc_html_e( 'Lancer l\'installation', 'waicam' ); ?>
			</a>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'waicam_admin_setup_notice' );
