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

</main>

<?php
get_footer();
