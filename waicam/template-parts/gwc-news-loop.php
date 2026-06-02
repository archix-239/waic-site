<?php
/**
 * GWC-style News/Blog listing.
 *
 * @package WAICAM
 */

$gwc_news_label = get_theme_mod( 'waicam_blog_kicker', __( 'Actualités & Blog', 'waicam' ) );
$gwc_news_title = get_theme_mod( 'waicam_blog_title', __( 'Suivez nos actions', 'waicam' ) );
$gwc_news_query = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 9,
	'paged'               => 1,
	'ignore_sticky_posts' => true,
) );
?>

<section class="gwc-news-landing" aria-labelledby="gwc-news-title">
	<div class="gwc-news-stream-header">
		<span class="gwc-news-label"><?php echo esc_html( $gwc_news_label ); ?></span>
		<h1 id="gwc-news-title" class="gwc-news-heading">
			<span class="gwc-wave-underline">
				<?php echo esc_html( $gwc_news_title ); ?>
				<svg class="gwc-wave-svg" viewBox="0 0 512 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C16 1 32 1 48 12 S80 23 96 12 S128 1 144 12 S176 23 192 12 S224 1 240 12 S272 23 288 12 S320 1 336 12 S368 23 384 12 S416 1 432 12 S464 23 480 12 S496 1 512 12" />
				</svg>
			</span>
		</h1>
	</div>

	<?php if ( $gwc_news_query->have_posts() ) : ?>
		<ul id="gwc-news-list" class="gwc-news-list">
			<?php
			while ( $gwc_news_query->have_posts() ) :
				$gwc_news_query->the_post();
				waicam_gwc_render_news_item();
			endwhile;
			wp_reset_postdata();
			?>
		</ul>

		<?php if ( $gwc_news_query->max_num_pages > 1 ) : ?>
			<div class="gwc-news-load">
				<button class="gwc-arrow-button" id="gwc-load-more" type="button" data-page="2" data-max-pages="<?php echo esc_attr( $gwc_news_query->max_num_pages ); ?>">
					<span><?php esc_html_e( 'Load More', 'waicam' ); ?></span>
					<svg viewBox="0 0 28 18" role="presentation" aria-hidden="true" focusable="false">
						<path d="M1 9h24M18 2l7 7-7 7" />
					</svg>
				</button>
			</div>
		<?php endif; ?>
	<?php else : ?>
		<p class="gwc-news-empty"><?php esc_html_e( 'Aucun article publié pour le moment.', 'waicam' ); ?></p>
	<?php endif; ?>
</section>
