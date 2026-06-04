<?php
/**
 * Template Name: WAI-CAM — Évènements
 *
 * Page dédiée aux évènements WAI-CAM alimentée par The Events Calendar.
 * Les sections sont construites progressivement à partir des captures validées.
 *
 * @package WAICAM
 */

get_header();

$hero_image_id = absint( get_theme_mod( 'waicam_events_hero_image_id', 0 ) );
if ( ! $hero_image_id && has_post_thumbnail() ) {
	$hero_image_id = get_post_thumbnail_id();
}
$hero_year = get_theme_mod( 'waicam_events_hero_year', gmdate( 'Y' ) );
?>

<main id="primary" class="events-campaign-page">
	<section class="events-campaign-hero" aria-label="<?php esc_attr_e( 'Évènements WAI-CAM', 'waicam' ); ?>">
		<div class="events-campaign-hero__media">
			<?php if ( $hero_image_id ) : ?>
				<?php
				echo wp_get_attachment_image(
					$hero_image_id,
					'full',
					false,
					array(
						'class'    => 'events-campaign-hero__image',
						'loading'  => 'eager',
						'decoding' => 'async',
					)
				);
				?>
			<?php else : ?>
				<div class="events-campaign-hero__placeholder" aria-hidden="true">
					<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
					<strong><?php esc_html_e( 'ÉVÈNEMENTS', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $hero_year ) : ?>
			<div class="events-campaign-hero__sticker" aria-label="<?php echo esc_attr( sprintf( __( 'Année %s', 'waicam' ), $hero_year ) ); ?>">
				<span><?php echo esc_html( $hero_year ); ?></span>
			</div>
		<?php endif; ?>
	</section>
	<section class="events-campaign-intro" aria-labelledby="events-campaign-intro-title">
		<div class="events-campaign-intro__inner">
			<h1 id="events-campaign-intro-title" class="events-campaign-intro__title">
				<?php echo esc_html( get_theme_mod( 'waicam_events_intro_title', __( 'ÉVÈNEMENTS WAI-CAM', 'waicam' ) ) ); ?>
			</h1>

			<div class="events-campaign-intro__copy">
				<p><?php echo esc_html( get_theme_mod( 'waicam_events_intro_text', __( "Participez aux rencontres, formations, ateliers et actions terrain de Women in AI Cameroon. Nos évènements créent des espaces d’apprentissage, de dialogue et d’engagement autour d’une intelligence artificielle inclusive au Cameroun.", 'waicam' ) ) ); ?></p>
				<a class="events-campaign-intro__link" href="<?php echo esc_url( get_theme_mod( 'waicam_events_intro_cta_url', '#events-upcoming' ) ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_events_intro_cta_text', __( 'Voir les prochains évènements', 'waicam' ) ) ); ?></span>
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
					</svg>
				</a>
			</div>
		</div>
	</section>

	<?php
	$feature_event = waicam_get_evenements( 1, 'a-venir' );
	$feature_id    = ( $feature_event && $feature_event->have_posts() ) ? $feature_event->posts[0]->ID : 0;
	$feature_title = get_theme_mod( 'waicam_events_feature_title', '' );
	$feature_text  = get_theme_mod( 'waicam_events_feature_text', '' );
	$feature_url   = get_theme_mod( 'waicam_events_feature_cta_url', '' );
	$feature_img   = absint( get_theme_mod( 'waicam_events_feature_image_id', 0 ) );

	if ( ! $feature_title ) {
		$feature_title = $feature_id ? get_the_title( $feature_id ) : __( 'Prochain rendez-vous WAI-CAM', 'waicam' );
	}
	if ( ! $feature_text ) {
		$feature_text = $feature_id ? waicam_event_excerpt( $feature_id, 150 ) : __( "Découvrez les prochains temps forts de Women in AI Cameroon : ateliers, rencontres institutionnelles, formations terrain et moments de communauté autour d'une IA inclusive.", 'waicam' );
	}
	if ( ! $feature_url ) {
		$feature_url = $feature_id ? get_permalink( $feature_id ) : '#events-upcoming';
	}
	if ( ! $feature_img && $feature_id && has_post_thumbnail( $feature_id ) ) {
		$feature_img = get_post_thumbnail_id( $feature_id );
	}
	?>
	<section class="events-campaign-feature" aria-labelledby="events-campaign-feature-title">
		<div class="events-campaign-feature__copy">
			<div class="events-campaign-feature__copy-inner">
				<h2 id="events-campaign-feature-title"><?php echo esc_html( $feature_title ); ?></h2>
				<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
				</svg>
				<p><?php echo esc_html( $feature_text ); ?></p>

				<?php if ( $feature_id ) : ?>
					<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations évènement', 'waicam' ); ?>">
						<li><?php echo esc_html( waicam_event_date( $feature_id ) ); ?></li>
						<?php if ( waicam_event_venue( $feature_id ) ) : ?>
							<li><?php echo esc_html( waicam_event_venue( $feature_id ) ); ?></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

				<a class="events-campaign-feature__link" href="<?php echo esc_url( $feature_url ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_events_feature_cta_text', __( 'En savoir plus', 'waicam' ) ) ); ?></span>
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
					</svg>
				</a>
			</div>
		</div>

		<div class="events-campaign-feature__visual">
			<?php if ( $feature_img ) : ?>
				<?php echo wp_get_attachment_image( $feature_img, 'large', false, array( 'class' => 'events-campaign-feature__image', 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<div class="events-campaign-feature__placeholder">
					<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
					<strong><?php esc_html_e( 'ÉVÈNEMENT', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php wp_reset_postdata(); ?>

	<?php
	$event_cards = waicam_get_evenements( -1, 'a-venir' );
	if ( $event_cards ) :
		$card_index = 0;
		while ( $event_cards->have_posts() ) :
			$event_cards->the_post();
			$card_id = get_the_ID();
			if ( $feature_id && $card_id === $feature_id ) {
				continue;
			}

			$card_classes = array( 'events-campaign-feature', 'events-campaign-feature--auto' );
			if ( 0 === $card_index % 2 ) {
				$card_classes[] = 'events-campaign-feature--image-left';
			}
			$card_classes[] = 'events-campaign-feature--tone-' . array( 'green', 'red', 'blue' )[ $card_index % 3 ];

			$card_img = has_post_thumbnail( $card_id ) ? get_post_thumbnail_id( $card_id ) : 0;
			$card_venue = waicam_event_venue( $card_id );
			?>
			<section class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>" aria-labelledby="events-campaign-card-<?php echo esc_attr( $card_id ); ?>">
				<div class="events-campaign-feature__copy">
					<div class="events-campaign-feature__copy-inner">
						<h2 id="events-campaign-card-<?php echo esc_attr( $card_id ); ?>"><?php the_title(); ?></h2>
						<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
							<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
						</svg>
						<p><?php echo esc_html( waicam_event_excerpt( $card_id, 150 ) ); ?></p>

						<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations évènement', 'waicam' ); ?>">
							<li><?php echo esc_html( waicam_event_date( $card_id ) ); ?></li>
							<?php if ( $card_venue ) : ?>
								<li><?php echo esc_html( $card_venue ); ?></li>
							<?php endif; ?>
						</ul>

						<a class="events-campaign-feature__link" href="<?php the_permalink(); ?>">
							<span><?php echo esc_html( get_theme_mod( 'waicam_events_feature_cta_text', __( 'En savoir plus', 'waicam' ) ) ); ?></span>
							<span class="arrow-plain">→</span>
							<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
								<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
							</svg>
						</a>
					</div>
				</div>

				<div class="events-campaign-feature__visual">
					<?php if ( $card_img ) : ?>
						<?php echo wp_get_attachment_image( $card_img, 'large', false, array( 'class' => 'events-campaign-feature__image', 'loading' => 'lazy' ) ); ?>
					<?php else : ?>
						<div class="events-campaign-feature__placeholder">
							<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
							<strong><?php esc_html_e( 'ÉVÈNEMENT', 'waicam' ); ?></strong>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
			$card_index++;
		endwhile;
		wp_reset_postdata();
	endif;
	?>

</main>

<?php
get_footer();
