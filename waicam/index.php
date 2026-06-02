<?php
/**
 * Blog index — liste des articles.
 *
 * @package WAICAM
 */

get_header();

$blog_kicker = get_theme_mod( 'waicam_blog_kicker', __( 'News and Blog', 'waicam' ) );
$blog_title  = get_theme_mod( 'waicam_blog_title', __( 'Keep up with us', 'waicam' ) );
$news_query  = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 9,
	'paged'               => 1,
	'ignore_sticky_posts' => true,
) );
?>

<section class="news-blog-section" aria-labelledby="news-blog-title">
	<div class="news-blog-section__inner">
		<header class="news-blog-section__heading">
			<div class="section-label"><?php echo esc_html( $blog_kicker ); ?></div>
			<h1 id="news-blog-title" class="section-title"><?php echo esc_html( $blog_title ); ?></h1>
			<svg class="news-blog-section__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0 8 C10 0, 22 0, 32 8 S54 16, 64 8 S86 0, 96 8 S118 16, 128 8 S150 0, 160 8 S182 16, 192 8 S214 0, 224 8 S246 16, 256 8 S278 0, 288 8 S310 16, 320 8" />
			</svg>
		</header>

		<?php if ( $news_query->have_posts() ) : ?>
			<div id="posts-container" class="posts-grid">
				<?php
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					waicam_render_news_card();
				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<?php if ( $news_query->max_num_pages > 1 ) : ?>
				<button id="load-more-btn" class="news-load-more" type="button" data-page="2" data-max-pages="<?php echo esc_attr( $news_query->max_num_pages ); ?>">
					<?php esc_html_e( 'Load More', 'waicam' ); ?>
				</button>
			<?php endif; ?>
		<?php else : ?>
			<p class="news-blog-section__empty"><?php esc_html_e( 'Aucun article publié pour le moment.', 'waicam' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
