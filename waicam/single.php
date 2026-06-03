<?php
/**
 * Single — Article individuel style GWC adapté WAI-CAM.
 *
 * @package WAICAM
 */

get_header();
?>

<div class="gwc-reading-progress" aria-hidden="true"><span></span></div>

<?php while ( have_posts() ) : the_post();
	$categories   = get_the_category();
	$primary_cat  = ! empty( $categories ) ? $categories[0] : null;
	$featured_id  = get_post_thumbnail_id( get_the_ID() );
	$featured_alt = $featured_id ? get_post_meta( $featured_id, '_wp_attachment_image_alt', true ) : '';
?>

	<article <?php post_class( 'gwc-article' ); ?>>
		<header class="gwc-article-header">
			<div class="gwc-article-header__inner">
				<h1 class="gwc-article-heading"><?php the_title(); ?></h1>
			</div>
			<svg class="gwc-article-header-wave" viewBox="0 0 1000 120" preserveAspectRatio="none" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0 0 H1000 V78 C780 78 680 116 506 116 C318 116 212 78 0 78 Z" />
			</svg>
		</header>

		<?php if ( $featured_id ) : ?>
			<figure class="gwc-article-featured">
				<div class="gwc-article-featured__media">
					<?php echo wp_get_attachment_image( $featured_id, 'large', false, array( 'alt' => $featured_alt ?: get_the_title(), 'loading' => 'eager' ) ); ?>
				</div>
				<?php if ( $featured_alt ) : ?>
					<figcaption><?php echo esc_html( $featured_alt ); ?></figcaption>
				<?php endif; ?>
			</figure>
		<?php endif; ?>

		<div class="gwc-article-body">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="post-pages">' . esc_html__( 'Pages :', 'waicam' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	</article>

	<?php
	$related_args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 3,
		'post__not_in'        => array( get_the_ID() ),
		'ignore_sticky_posts' => true,
	);

	if ( $primary_cat ) {
		$related_args['category__in'] = array( $primary_cat->term_id );
	}

	$related = new WP_Query( $related_args );
	if ( ! $related->have_posts() && $primary_cat ) {
		wp_reset_postdata();
		unset( $related_args['category__in'] );
		$related = new WP_Query( $related_args );
	}
	?>

	<?php if ( $related->have_posts() ) : ?>
		<section class="gwc-more-articles" aria-labelledby="gwc-more-articles-title">
			<div class="gwc-more-articles__inner">
				<h2 id="gwc-more-articles-title" class="gwc-more-articles__title">
					<span class="gwc-wave-underline">
						<?php esc_html_e( 'À lire aussi', 'waicam' ); ?>
						<svg class="gwc-wave-svg" viewBox="0 0 512 24" role="presentation" aria-hidden="true" focusable="false">
							<path d="M0 12 C16 1 32 1 48 12 S80 23 96 12 S128 1 144 12 S176 23 192 12 S224 1 240 12 S272 23 288 12 S320 1 336 12 S368 23 384 12 S416 1 432 12 S464 23 480 12 S496 1 512 12" />
						</svg>
					</span>
				</h2>

				<ul class="gwc-news-list">
					<?php
					while ( $related->have_posts() ) :
						$related->the_post();
						waicam_gwc_render_news_item();
					endwhile;
					wp_reset_postdata();
					?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer();
