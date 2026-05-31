<?php
/**
 * Blog index — liste des articles façon Girls Who Code.
 *
 * @package WAICAM
 */

get_header();

$blog_kicker = get_theme_mod( 'waicam_blog_kicker', __( 'News and Blog', 'waicam' ) );
$blog_title  = get_theme_mod( 'waicam_blog_title', __( 'Keep up with us', 'waicam' ) );
$gwc_posts   = array(
	array(
		'title' => __( 'Julissa Toledo, 2026 Reshma Saujani Girls First Leadership Award Winner', 'waicam' ),
		'url'   => 'https://girlswhocode.com/news/julissa-toledo-2026-reshma-saujani-girls-first-leadership-award-winner',
		'class' => 'julissa',
	),
	array(
		'title' => __( 'How Tech Is Helping Us Adapt to Climate Change', 'waicam' ),
		'url'   => 'https://girlswhocode.com/news/how-tech-is-helping-us-adapt-to-climate-change',
		'class' => 'climate',
	),
	array(
		'title' => __( 'Jana Chandler-Ligon Promoted to Chief Operating Officer of Girls Who Code', 'waicam' ),
		'url'   => 'https://girlswhocode.com/news/jana-chandler-ligon-promoted-to-chief-operating-officer-of-girls-who-code',
		'class' => 'jana',
	),
);
?>

<section class="blog-gwc">
	<div class="blog-gwc__inner">
		<div class="blog-gwc__kicker"><?php echo esc_html( $blog_kicker ); ?></div>
		<h1><?php echo esc_html( $blog_title ); ?></h1>
		<svg class="blog-gwc__wave" viewBox="0 0 520 22" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0 11 C9 3, 17 3, 26 11 S43 19, 52 11 S69 3, 78 11 S95 19, 104 11 S121 3, 130 11 S147 19, 156 11 S173 3, 182 11 S199 19, 208 11 S225 3, 234 11 S251 19, 260 11 S277 3, 286 11 S303 19, 312 11 S329 3, 338 11 S355 19, 364 11 S381 3, 390 11 S407 19, 416 11 S433 3, 442 11 S459 19, 468 11 S485 3, 494 11 S511 19, 520 11" />
		</svg>

		<div class="blog-gwc__grid">
			<?php foreach ( $gwc_posts as $gwc_post ) : ?>
				<article class="blog-gwc-card blog-gwc-card--<?php echo esc_attr( $gwc_post['class'] ); ?>">
					<a href="<?php echo esc_url( $gwc_post['url'] ); ?>" class="blog-gwc-card__link" aria-label="<?php echo esc_attr( sprintf( __( 'Lire : %s', 'waicam' ), $gwc_post['title'] ) ); ?>">
						<div class="blog-gwc-card__title">
							<h2><?php echo esc_html( $gwc_post['title'] ); ?></h2>
							<svg class="blog-gwc-card__wave-cut" viewBox="0 0 540 92" preserveAspectRatio="none" role="presentation" aria-hidden="true" focusable="false">
								<path d="M0 0 C95 0 132 36 260 36 C388 36 445 0 540 0 V92 H0 Z" />
							</svg>
						</div>
						<div class="blog-gwc-card__media" aria-hidden="true">
							<span class="blog-gwc-card__visual"></span>
						</div>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer();
