<?php
/**
 * Fallback générique (requis par WordPress).
 * Si aucun template plus spécifique ne match, ce fichier est utilisé.
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => is_home() ? __( 'Blog', 'waicam' ) : get_the_archive_title(),
	'subtitle' => is_home() ? '' : get_the_archive_description(),
) );
?>

<section>
	<div style="max-width:1100px;margin:0 auto;">
		<?php if ( have_posts() ) : ?>

			<div class="news-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="news-card">
						<a href="<?php the_permalink(); ?>"><?php waicam_thumbnail( get_the_ID(), 'medium_large', 'training-1.jpg' ); ?></a>
						<div class="news-card-body">
							<div class="news-date"><?php echo esc_html( waicam_date_fr() ); ?></div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( waicam_excerpt( get_the_excerpt(), 160 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Lire la suite →', 'waicam' ); ?></a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div style="text-align:center;margin-top:48px;">
				<?php the_posts_pagination( array(
					'mid_size'  => 1,
					'prev_text' => __( '← Précédent', 'waicam' ),
					'next_text' => __( 'Suivant →', 'waicam' ),
				) ); ?>
			</div>

		<?php else : ?>
			<p style="text-align:center;color:var(--gray);"><?php esc_html_e( 'Aucun contenu pour le moment.', 'waicam' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
