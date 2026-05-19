<?php
/**
 * Template Name: WAI-CAM — Galerie Photo
 *
 * Page galerie multimédia (powered by Envira Gallery Lite).
 * Affiche 4 sections thématiques. Chaque section utilise une galerie Envira
 * dont l'ID est configuré via le Customizer.
 *
 * @package WAICAM
 */

get_header();

// IDs des galeries Envira Gallery (configurables via Customizer → WAI-CAM → Galeries)
$gal_formations  = get_theme_mod( 'waicam_envira_gallery_formations', '' );
$gal_conferences = get_theme_mod( 'waicam_envira_gallery_conferences', '' );
$gal_terrain     = get_theme_mod( 'waicam_envira_gallery_terrain', '' );
$gal_evenements  = get_theme_mod( 'waicam_envira_gallery_evenements', '' );

/**
 * Affiche une galerie Envira si configurée, sinon un message d'aide à l'admin.
 */
function waicam_render_envira( $id, $section_label ) {
	if ( $id && shortcode_exists( 'envira-gallery' ) ) {
		echo do_shortcode( '[envira-gallery id="' . esc_attr( $id ) . '"]' );
		return;
	}

	if ( current_user_can( 'manage_options' ) ) {
		echo '<div class="gallery-empty gallery-empty--admin">';
		echo '<p><strong>' . esc_html( $section_label ) . '</strong> — ' . esc_html__( 'aucune galerie liée pour cette section.', 'waicam' ) . '</p>';
		echo '<p>' . sprintf(
			/* translators: 1: lien admin envira, 2: lien customizer */
			wp_kses_post( __( '1. <a href="%1$s">Crée une galerie Envira</a>, copie son ID. 2. Va dans <a href="%2$s">Apparence → Personnaliser → WAI-CAM → Galeries</a> et colle l\'ID.', 'waicam' ) ),
			esc_url( admin_url( 'edit.php?post_type=envira' ) ),
			esc_url( admin_url( 'customize.php' ) )
		) . '</p>';
		echo '</div>';
	} else {
		echo '<p class="gallery-empty">' . esc_html__( 'Galerie en cours de constitution.', 'waicam' ) . '</p>';
	}
}
?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Galerie photo', 'waicam' ),
	'subtitle' => __( "Plongez dans les moments forts de Women in AI Cameroon : formations, conférences, missions terrain et grands rendez-vous qui font vivre le mouvement.", 'waicam' ),
	'crumb'    => __( 'Galerie', 'waicam' ),
) );
?>

<!-- ============================================
     RÉSUMÉ — STATS
     ============================================ -->
<section class="gallery-stats">
	<div class="gallery-stats-grid">
		<div class="gallery-stat">
			<div class="gallery-stat-num">10</div>
			<div class="gallery-stat-lbl"><?php esc_html_e( 'Régions couvertes', 'waicam' ); ?></div>
		</div>
		<div class="gallery-stat">
			<div class="gallery-stat-num">4</div>
			<div class="gallery-stat-lbl"><?php esc_html_e( 'Programmes phares', 'waicam' ); ?></div>
		</div>
		<div class="gallery-stat">
			<div class="gallery-stat-num">500+</div>
			<div class="gallery-stat-lbl"><?php esc_html_e( 'Participantes formées', 'waicam' ); ?></div>
		</div>
		<div class="gallery-stat">
			<div class="gallery-stat-num">2026</div>
			<div class="gallery-stat-lbl"><?php esc_html_e( 'Année en cours', 'waicam' ); ?></div>
		</div>
	</div>
</section>

<!-- ============================================
     SECTION FORMATIONS
     ============================================ -->
<section class="gallery-section" id="formations">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Formations & Ateliers', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Apprendre, pratiquer, <span>transmettre</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Sessions de formation, ateliers pratiques, masterclasses : les femmes et les jeunes au cœur de l'apprentissage de l'IA.", 'waicam' ); ?></p>
	</div>
	<div class="gallery-section-body">
		<?php waicam_render_envira( $gal_formations, __( 'Formations', 'waicam' ) ); ?>
	</div>
</section>

<!-- ============================================
     SECTION CONFÉRENCES
     ============================================ -->
<section class="gallery-section gallery-section--alt" id="conferences">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Conférences', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Faire <span>entendre nos voix</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Plénières nationales, panels d'expertes, rencontres institutionnelles : WAI-CAM porte la voix des femmes camerounaises dans le débat sur l'IA.", 'waicam' ); ?></p>
	</div>
	<div class="gallery-section-body">
		<?php waicam_render_envira( $gal_conferences, __( 'Conférences', 'waicam' ) ); ?>
	</div>
</section>

<!-- ============================================
     SECTION TERRAIN
     ============================================ -->
<section class="gallery-section" id="terrain">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Missions terrain', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'L\'IA <span>jusqu\'au dernier village</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Du Centre à l'Extrême-Nord, du Littoral à l'Est : WAI-CAM va à la rencontre des communautés pour rendre l'IA accessible partout.", 'waicam' ); ?></p>
	</div>
	<div class="gallery-section-body">
		<?php waicam_render_envira( $gal_terrain, __( 'Missions terrain', 'waicam' ) ); ?>
	</div>
</section>

<!-- ============================================
     SECTION ÉVÈNEMENTS
     ============================================ -->
<section class="gallery-section gallery-section--alt" id="evenements">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Évènements', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Les <span>moments forts</span> du mouvement', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Lancements officiels, fêtes de la jeunesse, rencontres partenaires : revivez les temps forts de WAI-CAM.", 'waicam' ); ?></p>
	</div>
	<div class="gallery-section-body">
		<?php waicam_render_envira( $gal_evenements, __( 'Évènements', 'waicam' ) ); ?>
	</div>
</section>

<!-- ============================================
     CTA — VOUS ÊTES DANS UNE PHOTO ?
     ============================================ -->
<section class="gallery-cta">
	<div class="gallery-cta-inner">
		<div class="gallery-cta-icon"><i class="fa-solid fa-camera-retro"></i></div>
		<h3><?php esc_html_e( 'Vous étiez à un évènement WAI-CAM ?', 'waicam' ); ?></h3>
		<p><?php esc_html_e( "Vous reconnaissez-vous sur l'une de nos photos ? Vous souhaitez recevoir des clichés d'un évènement particulier ou nous signaler une utilisation ? Contactez-nous.", 'waicam' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary">
			<i class="fa-solid fa-envelope"></i> <?php esc_html_e( 'Nous écrire', 'waicam' ); ?>
		</a>
	</div>
</section>

<?php get_footer();
