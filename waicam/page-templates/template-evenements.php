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
</main>

<?php
get_footer();
