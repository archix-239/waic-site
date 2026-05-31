<?php
/**
 * Page des articles WordPress — Blog.
 *
 * @package WAICAM
 */

get_header();

$blog_kicker = get_theme_mod( 'waicam_blog_kicker', __( 'News and Blog', 'waicam' ) );
$blog_title  = get_theme_mod( 'waicam_blog_title', __( 'Keep up with us', 'waicam' ) );
?>

<section class="blog-gwc">
	<div class="blog-gwc__inner">
		<div class="blog-gwc__kicker"><?php echo esc_html( $blog_kicker ); ?></div>
		<h1><?php echo esc_html( $blog_title ); ?></h1>
		<svg class="blog-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0 8 C10 0, 22 0, 32 8 S54 16, 64 8 S86 0, 96 8 S118 16, 128 8 S150 0, 160 8 S182 16, 192 8 S214 0, 224 8 S246 16, 256 8 S278 0, 288 8 S310 16, 320 8" />
		</svg>

		<?php if ( have_posts() ) : ?>
			<div class="blog-gwc__grid">
				<?php while ( have_posts() ) : the_post();
					$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					$thumb_alt = get_post_meta( get_post_thumbnail_id( get_the_ID() ), '_wp_attachment_image_alt', true );
				?>
					<article class="blog-gwc-card">
						<a href="<?php the_permalink(); ?>" class="blog-gwc-card__link" aria-label="<?php echo esc_attr( sprintf( __( 'Lire : %s', 'waicam' ), get_the_title() ) ); ?>">
							<div class="blog-gwc-card__title">
								<h2><?php the_title(); ?></h2>
								<svg class="blog-gwc-card__wave-cut" viewBox="0 0 540 92" preserveAspectRatio="none" role="presentation" aria-hidden="true" focusable="false">
									<path d="M0 0 C95 0 132 36 260 36 C388 36 445 0 540 0 V92 H0 Z" />
								</svg>
							</div>
							<div class="blog-gwc-card__media<?php echo $thumb_url ? ' has-image' : ''; ?>">
								<?php if ( $thumb_url ) : ?>
									<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $thumb_alt ?: get_the_title() ); ?>" loading="lazy" />
								<?php endif; ?>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<div class="blog-gwc__pagination">
				<?php the_posts_pagination( array(
					'mid_size'  => 1,
					'prev_text' => __( '← Précédent', 'waicam' ),
					'next_text' => __( 'Suivant →', 'waicam' ),
				) ); ?>
			</div>
		<?php else : ?>
			<p class="blog-gwc__empty"><?php esc_html_e( 'Aucun article publié pour le moment.', 'waicam' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
