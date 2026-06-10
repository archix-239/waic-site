<?php
/**
 * Archive LearnPress courses.
 *
 * @package WAICAM
 */

get_header();

$paged = max( 1, get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
?>

<main id="primary" class="waicam-courses-page waicam-courses-archive-page">
	<section class="waicam-courses-hero" aria-labelledby="waicam-courses-archive-title">
		<div class="waicam-courses-hero__inner">
			<p class="waicam-courses-kicker"><?php esc_html_e( 'Catalogue LearnPress', 'waicam' ); ?></p>
			<h1 id="waicam-courses-archive-title"><?php esc_html_e( 'Toutes les formations WAI-CAM', 'waicam' ); ?></h1>
			<p><?php esc_html_e( 'Retrouvez les parcours de formation publiés dans LearnPress et accédez aux détails de chaque cours.', 'waicam' ); ?></p>
		</div>
	</section>

	<section class="waicam-courses-section" aria-label="<?php esc_attr_e( 'Liste des formations', 'waicam' ); ?>">
		<?php if ( have_posts() ) : ?>
			<div class="waicam-courses-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					waicam_render_course_card( get_the_ID() );
				endwhile;
				?>
			</div>
			<?php
			$pagination = paginate_links( array(
				'total'     => (int) $wp_query->max_num_pages,
				'current'   => $paged,
				'prev_text' => __( '← Formations précédentes', 'waicam' ),
				'next_text' => __( 'Formations suivantes →', 'waicam' ),
			) );
			?>
			<?php if ( $pagination ) : ?>
				<nav class="waicam-courses-pagination" aria-label="<?php esc_attr_e( 'Pagination des formations', 'waicam' ); ?>">
					<?php echo wp_kses_post( $pagination ); ?>
				</nav>
			<?php endif; ?>
		<?php else : ?>
			<div class="waicam-courses-empty">
				<h2><?php esc_html_e( 'Aucune formation publiée', 'waicam' ); ?></h2>
				<p><?php esc_html_e( 'Les prochaines formations seront bientôt disponibles.', 'waicam' ); ?></p>
			</div>
		<?php endif; ?>
	</section>
</main>

<?php
get_footer();
