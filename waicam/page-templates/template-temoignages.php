<?php
/**
 * Template Name: WAI-CAM — Témoignages
 *
 * Page dédiée aux témoignages créés depuis CPT UI / ACF.
 *
 * @package WAICAM
 */

get_header();

$temoignages_query = waicam_get_temoignages( -1 );
$temoignages       = array();

if ( $temoignages_query ) {
	while ( $temoignages_query->have_posts() ) {
		$temoignages_query->the_post();

		$post_id  = get_the_ID();
		$nom      = waicam_field( 'nom_complet', $post_id, get_the_title( $post_id ) );
		$role     = waicam_field( 'role__fonction', $post_id, '' );
		$profil   = waicam_field( 'profil_professionnel', $post_id, '' );
		$citation    = waicam_field( 'citation', $post_id, '' );
		$photo_field = waicam_field( 'photo', $post_id, '' );
		$photo       = $photo_field ? waicam_image_url( 'photo', $post_id, 'large', '' ) : '';
		$initiale    = $nom ? strtoupper( substr( remove_accents( $nom ), 0, 1 ) ) : 'W';

		$temoignages[] = array(
			'id'       => $post_id,
			'nom'      => $nom,
			'role'     => $role,
			'profil'   => $profil,
			'citation' => $citation,
			'photo'    => $photo,
			'initiale' => $initiale,
		);
	}

	wp_reset_postdata();
}

$featured_testimonial = ! empty( $temoignages ) ? $temoignages[0] : null;
$testimonials_count   = count( $temoignages );
?>

<main id="primary" class="waicam-testimonials-page">
	<section class="waicam-testimonials-hero" aria-labelledby="waicam-testimonials-title">
		<div class="waicam-testimonials-hero__inner">
			<div class="waicam-testimonials-hero__copy">
				<p class="waicam-testimonials-kicker"><?php esc_html_e( 'Témoignages WAI-CAM', 'waicam' ); ?></p>
				<h1 id="waicam-testimonials-title"><?php esc_html_e( 'Les voix qui font avancer Women in AI Cameroon', 'waicam' ); ?></h1>
				<svg class="waicam-wave waicam-testimonials-wave" viewBox="0 0 260 20" aria-hidden="true" focusable="false">
					<path d="M2 10 C18 0 31 20 47 10 S76 0 92 10 121 20 137 10 166 0 182 10 211 20 227 10 246 4 258 10" />
				</svg>
				<p><?php esc_html_e( "Découvrez comment l'intelligence artificielle transforme la vie professionnelle et personnelle des membres et des sympathisant·es de Women in AI Cameroon.", 'waicam' ); ?></p>
				<div class="waicam-testimonials-stats" aria-label="<?php esc_attr_e( 'Résumé des témoignages', 'waicam' ); ?>">
					<span><strong><?php echo esc_html( max( $testimonials_count, 1 ) ); ?></strong><?php esc_html_e( ' récits inspirants', 'waicam' ); ?></span>
					<span><?php esc_html_e( 'Parcours, engagement et impact', 'waicam' ); ?></span>
				</div>
			</div>

			<?php if ( $featured_testimonial ) : ?>
				<article class="waicam-testimonials-featured" aria-label="<?php esc_attr_e( 'Témoignage mis en avant', 'waicam' ); ?>">
					<div class="waicam-testimonials-featured__media">
						<?php if ( $featured_testimonial['photo'] ) : ?>
							<img src="<?php echo esc_url( $featured_testimonial['photo'] ); ?>" alt="<?php echo esc_attr( $featured_testimonial['nom'] ); ?>" loading="eager" />
						<?php else : ?>
							<div class="waicam-testimonials-avatar waicam-testimonials-avatar--large"><?php echo esc_html( $featured_testimonial['initiale'] ); ?></div>
						<?php endif; ?>
					</div>
					<div class="waicam-testimonials-featured__quote">
						<span class="waicam-testimonials-quote-mark" aria-hidden="true">“</span>
						<p><?php echo esc_html( $featured_testimonial['citation'] ? $featured_testimonial['citation'] : __( 'Un témoignage WAI-CAM sera bientôt disponible.', 'waicam' ) ); ?></p>
						<footer>
							<strong><?php echo esc_html( $featured_testimonial['nom'] ); ?></strong>
							<?php if ( $featured_testimonial['role'] || $featured_testimonial['profil'] ) : ?>
								<span><?php echo esc_html( trim( $featured_testimonial['role'] . ( $featured_testimonial['role'] && $featured_testimonial['profil'] ? ' · ' : '' ) . $featured_testimonial['profil'] ) ); ?></span>
							<?php endif; ?>
						</footer>
					</div>
				</article>
			<?php else : ?>
				<div class="waicam-testimonials-featured waicam-testimonials-featured--empty">
					<p><?php esc_html_e( 'Les témoignages seront publiés très prochainement.', 'waicam' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="waicam-testimonials-list" aria-labelledby="waicam-testimonials-list-title">
		<div class="waicam-testimonials-list__header">
			<p class="waicam-testimonials-kicker"><?php esc_html_e( 'Communauté', 'waicam' ); ?></p>
			<h2 id="waicam-testimonials-list-title"><?php esc_html_e( 'Elles et ils racontent leur expérience', 'waicam' ); ?></h2>
			<p><?php esc_html_e( 'Des récits authentiques issus de la communauté WAI-CAM, entre découverte, montée en compétences, leadership et confiance dans les métiers de l’IA.', 'waicam' ); ?></p>
		</div>

		<?php if ( ! empty( $temoignages ) ) : ?>
			<div class="waicam-testimonials-grid">
				<?php foreach ( $temoignages as $index => $temoignage ) : ?>
					<article class="waicam-testimonial-card<?php echo 0 === $index ? ' waicam-testimonial-card--accent' : ''; ?>">
						<div class="waicam-testimonial-card__header">
							<?php if ( $temoignage['photo'] ) : ?>
								<img src="<?php echo esc_url( $temoignage['photo'] ); ?>" alt="<?php echo esc_attr( $temoignage['nom'] ); ?>" loading="lazy" />
							<?php else : ?>
								<div class="waicam-testimonials-avatar"><?php echo esc_html( $temoignage['initiale'] ); ?></div>
							<?php endif; ?>
							<div>
								<strong><?php echo esc_html( $temoignage['nom'] ); ?></strong>
								<?php if ( $temoignage['role'] ) : ?>
									<span><?php echo esc_html( $temoignage['role'] ); ?></span>
								<?php endif; ?>
								<?php if ( $temoignage['profil'] ) : ?>
									<em><?php echo esc_html( $temoignage['profil'] ); ?></em>
								<?php endif; ?>
							</div>
						</div>
						<p><?php echo esc_html( $temoignage['citation'] ? $temoignage['citation'] : __( 'Témoignage en cours de rédaction.', 'waicam' ) ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="waicam-testimonials-empty">
				<p><?php esc_html_e( 'Les témoignages seront publiés très prochainement.', 'waicam' ); ?></p>
			</div>
		<?php endif; ?>
	</section>

	<section class="waicam-testimonials-cta" aria-labelledby="waicam-testimonials-cta-title">
		<div>
			<p class="waicam-testimonials-kicker"><?php esc_html_e( 'Vous aussi', 'waicam' ); ?></p>
			<h2 id="waicam-testimonials-cta-title"><?php esc_html_e( 'Partagez votre histoire', 'waicam' ); ?></h2>
			<p><?php esc_html_e( "Vous utilisez l'IA dans votre quotidien et souhaitez inspirer d'autres femmes ? Rejoignez-nous et contribuez à diffuser des récits inspirants.", 'waicam' ); ?></p>
		</div>
		<a class="waicam-testimonials-cta__link" href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>">
			<?php esc_html_e( 'Rejoindre WAI-CAM', 'waicam' ); ?> <span aria-hidden="true">→</span>
		</a>
	</section>
</main>

<?php
get_footer();
