<?php
/**
 * Template par défaut pour les pages WordPress.
 *
 * @package WAICAM
 */

get_header();

$is_waicam_cart_page = function_exists( 'is_cart' ) && is_cart();

if ( $is_waicam_cart_page ) :
	?>
	<main id="primary" class="waicam-cart-page waicam-cart-block-page">
		<section class="waicam-cart-hero" aria-labelledby="waicam-cart-title">
			<div class="waicam-cart-hero__inner">
				<p class="waicam-cart-kicker"><?php esc_html_e( 'Panier WAI-CAM', 'waicam' ); ?></p>
				<h1 id="waicam-cart-title"><?php esc_html_e( 'Finalisez votre achat en toute simplicité', 'waicam' ); ?></h1>
				<p><?php esc_html_e( 'Vérifiez votre don, vos achats ou vos inscriptions, puis passez au paiement sécurisé pour soutenir les actions Women in AI Cameroon.', 'waicam' ); ?></p>
			</div>
		</section>

		<section class="waicam-cart-block-content" aria-label="<?php esc_attr_e( 'Contenu du panier', 'waicam' ); ?>">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</section>
	</main>
	<?php
else :
	get_template_part( 'template-parts/page-hero', null, array(
		'title'    => get_the_title(),
		'subtitle' => get_the_excerpt(),
	) );
	?>

	<section>
		<div style="max-width:900px;margin:0 auto;" class="page-content">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</section>
	<?php
endif;

get_footer();
