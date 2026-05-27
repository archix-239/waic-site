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
			<div class="join-gwc-hero__kicker"><?php esc_html_e( 'REJOIGNEZ NOUS', 'waicam' ); ?></div>
			<h1><?php esc_html_e( 'Participez à l’IA inclusive au Cameroun', 'waicam' ); ?></h1>
			<p><?php esc_html_e( "Femmes, mentors et partenaires : engagez-vous pour former, inspirer et soutenir l’autonomie numérique et citoyenne des communautés camerounaises.", 'waicam' ); ?></p>
		</div>

		<div class="join-gwc-hero__grid">
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'DEVENIR MEMBRE', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Rejoignez notre réseau : suivez des formations, participez à des projets locaux et contribuez à l’innovation inclusive.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Engagement régulier', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'VOLONTARIAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Contribuez ponctuellement aux formations, aux missions terrain ou à la communication pour amplifier notre impact.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Selon vos disponibilités', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'MENTORAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Accompagnez des apprenantes, partagez vos compétences et contribuez à l’émergence de vocations locales en IA.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Impact direct', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php esc_html_e( 'PARTENARIAT', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Collaborez avec WAI‑CAM pour co-créer des programmes, stages et opportunités d’insertion professionnelle pour les femmes.', 'waicam' ); ?></p>
				<strong><?php esc_html_e( 'Collaboration stratégique', 'waicam' ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
		</div>
	</div>
</section>

<?php
$fullwidth_image_id = get_theme_mod( 'waicam_join_fullwidth_image_id', 0 );
?>
<section class="join-gwc-image">
	<div class="join-gwc-image__media"<?php
	if ( $fullwidth_image_id ) {
		$full_image_url = wp_get_attachment_image_url( $fullwidth_image_id, 'full' );
		echo ' style="background-image:url(\'' . esc_url( $full_image_url ) . '\');"';
	}
?>>
		<?php if ( ! $fullwidth_image_id ) : ?>
			<div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#f3f3f3; color:#999; font-size:1.1rem;">
				<?php esc_html_e( 'Image pleine largeur après le hero', 'waicam' ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<svg class="home-newsletter-gwc__wave-divider" viewBox="0 0 1440 28" preserveAspectRatio="none" aria-hidden="true" focusable="false">
	<path d="M0 14 Q10 2 20 14 T40 14 T60 14 T80 14 T100 14 T120 14 T140 14 T160 14 T180 14 T200 14 T220 14 T240 14 T260 14 T280 14 T300 14 T320 14 T340 14 T360 14 T380 14 T400 14 T420 14 T440 14 T460 14 T480 14 T500 14 T520 14 T540 14 T560 14 T580 14 T600 14 T620 14 T640 14 T660 14 T680 14 T700 14 T720 14 T740 14 T760 14 T780 14 T800 14 T820 14 T840 14 T860 14 T880 14 T900 14 T920 14 T940 14 T960 14 T980 14 T1000 14 T1020 14 T1040 14 T1060 14 T1080 14 T1100 14 T1120 14 T1140 14 T1160 14 T1180 14 T1200 14 T1220 14 T1240 14 T1260 14 T1280 14 T1300 14 T1320 14 T1340 14 T1360 14 T1380 14 T1400 14 T1420 14 T1440 14"></path>
</svg>

<section class="featured-section featured-section--img-left" style="padding: 60px 20px; max-width: 1200px; margin: 0 auto;">
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
		<div class="featured-image">
			<?php
			$img_id = get_theme_mod( 'waicam_join_featured_image_id', 0 );
			if ( $img_id ) {
				echo wp_get_attachment_image( $img_id, 'large', false, array( 'style' => 'width: 100%; height: auto; border-radius: 8px;' ) );
			} else {
				echo '<div style="background: #f0f0f0; aspect-ratio: 1; border-radius: 8px; display: flex; align-items: center; justify-content: center;"><span style="color: #999;">Image section</span></div>';
			}
			?>
		</div>
		<div class="featured-content">
			<?php
			$kicker = get_theme_mod( 'waicam_join_featured_kicker', 'INITIATIVES PHARES' );
			$title = get_theme_mod( 'waicam_join_featured_title', 'Formations intensives et projets terrain' );
			$text = get_theme_mod( 'waicam_join_featured_text', '' );
			$cta_text = get_theme_mod( 'waicam_join_featured_cta_text', 'Découvrir nos initiatives' );
			$cta_url = get_theme_mod( 'waicam_join_featured_cta_url', home_url( '/formations' ) );
			?>
			<div style="font-size: 14px; font-weight: 600; color: #999; letter-spacing: 1px; margin-bottom: 20px; text-transform: uppercase;">
				<?php echo esc_html( $kicker ); ?>
			</div>
			<h2 style="font-size: 42px; line-height: 1.2; color: #1e3a8a; margin-bottom: 20px; font-weight: 700;">
				<?php echo esc_html( $title ); ?>
			</h2>
			<p style="font-size: 16px; line-height: 1.6; color: #333; margin-bottom: 30px;">
				<?php echo wp_kses_post( nl2br( $text ) ); ?>
			</p>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="home-posthero-link" style="display: inline-flex; align-items: center; gap: 8px;">
				<?php echo esc_html( $cta_text ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
						<path d="M69 4 L77 8 L69 12"></path>
					</svg>
				</span>
			</a>
		</div>
	</div>
</section>

<!-- ========== REJOINDRE — GRAND CHIFFRE + CTA (STYLE GWC) ========== -->
<section class="home-bigstat-gwc">
	<div class="home-bigstat-gwc__inner">
		<h2><?php echo esc_html( waicam_field( 'join_bigstat_title', null, '1 Million de femmes bénéficiaires de l’IA d’ici 2030' ) ); ?></h2>
		<div class="home-bigstat-gwc__bottom">
			<p><?php echo esc_html( waicam_field( 'join_bigstat_text', null, 'WAI-CAM inverse la tendance en formant des ambassadrices régionales pour un impact durable sur tout le territoire camerounais.' ) ); ?></p>
			<a href="<?php echo esc_url( waicam_field( 'join_bigstat_cta_url', null, home_url( '/faire-un-don' ) ) ); ?>" class="home-bigstat-gwc__cta">
				<?php echo esc_html( waicam_field( 'join_bigstat_cta_text', null, 'Soutenir nos actions' ) ); ?>
			</a>
		</div>
	</div>
	<svg class="home-bigstat-gwc__wave-divider" viewBox="0 0 1440 28" preserveAspectRatio="none" aria-hidden="true" focusable="false">
		<path d="M0 14 Q10 2 20 14 T40 14 T60 14 T80 14 T100 14 T120 14 T140 14 T160 14 T180 14 T200 14 T220 14 T240 14 T260 14 T280 14 T300 14 T320 14 T340 14 T360 14 T380 14 T400 14 T420 14 T440 14 T460 14 T480 14 T500 14 T520 14 T540 14 T560 14 T580 14 T600 14 T620 14 T640 14 T660 14 T680 14 T700 14 T720 14 T740 14 T760 14 T780 14 T800 14 T820 14 T840 14 T860 14 T880 14 T900 14 T920 14 T940 14 T960 14 T980 14 T1000 14 T1020 14 T1040 14 T1060 14 T1080 14 T1100 14 T1120 14 T1140 14 T1160 14 T1180 14 T1200 14 T1220 14 T1240 14 T1260 14 T1280 14 T1300 14 T1320 14 T1340 14 T1360 14 T1380 14 T1400 14 T1420 14 T1440 14"></path>
	</svg>
</section>

<section id="form-adhesion">
	<div style="max-width:800px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Rejoindre <span>WAI-CAM</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire pour indiquer votre intérêt (adhésion, bénévolat, mentorat, partenariat). Notre équipe vous contactera rapidement pour préciser le rôle et les prochaines étapes.", 'waicam' ); ?></p>
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
