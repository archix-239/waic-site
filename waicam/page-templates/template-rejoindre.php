<?php
/**
 * Template Name: WAI-CAM — Rejoindre
 *
 * @package WAICAM
 */

get_header();

$ff_id = get_theme_mod( 'waicam_form_adhesion', '' );
?>

<section class="join-gwc-hero" id="types">
	<div class="join-gwc-hero__container">
		<div class="join-gwc-hero__top">
			<div class="join-gwc-hero__kicker"><?php esc_html_e( 'GET INVOLVED', 'waicam' ); ?></div>
			<h1><?php esc_html_e( 'REJOIGNEZ LE MOUVEMENT WAI-CAM', 'waicam' ); ?></h1>
			<p><?php esc_html_e( "Femmes et allié·e·s peuvent contribuer via l’engagement communautaire, l’éducation et le mentorat pour démocratiser l’IA au Cameroun.", 'waicam' ); ?></p>
		</div>

		<div class="join-gwc-hero__grid">
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'DEVENIR MEMBRE', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Rejoignez les activités WAI-CAM, les formations et le réseau national.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Engagement flexible', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'VOLONTARIAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Apportez vos compétences (tech, communication, opérationnel) sur les actions terrain.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Selon vos disponibilités', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'MENTORAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Encadrez les jeunes filles et femmes sur les métiers IA et numérique.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Impact direct', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'PARTENARIAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Soutenez les programmes par des ressources, expertises ou co-initiatives.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Collaboration institutionnelle', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
		</div>
	</div>
</section>

<section class="join-gwc-image" aria-label="WAI-CAM get involved">
	<div class="join-gwc-image__media" style="background-image:url('<?php echo esc_url( waicam_img( 'join-cta.jpg' ) ); ?>');"></div>
</section>

<section id="form-adhesion">
	<div style="max-width:800px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Rejoindre <span>WAI-CAM</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire pour rejoindre le mouvement. Notre équipe vous contactera sous 48 heures.", 'waicam' ); ?></p>
		</div>

		<div class="form-card">
			<?php
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				echo '<p style="margin:0;">' . esc_html__( "Configurez l’ID Fluent Forms dans le Customizer (waicam_form_adhesion).", 'waicam' ) . '</p>';
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
