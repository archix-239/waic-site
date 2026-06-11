<?php
/**
 * WAI-CAM styled empty cart template.
 *
 * @package WAICAM
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<main class="waicam-cart-page waicam-cart-page--empty" id="primary">
	<section class="waicam-cart-empty" aria-labelledby="waicam-cart-empty-title">
		<p class="waicam-cart-kicker"><?php esc_html_e( 'Panier WAI-CAM', 'waicam' ); ?></p>
		<h1 id="waicam-cart-empty-title"><?php esc_html_e( 'Votre panier est vide', 'waicam' ); ?></h1>
		<p><?php esc_html_e( 'Ajoutez une formation, un produit ou une contribution pour soutenir les actions Women in AI Cameroon.', 'waicam' ); ?></p>
		<?php do_action( 'woocommerce_cart_is_empty' ); ?>
		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<a class="waicam-cart-empty__link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Découvrir la boutique', 'waicam' ); ?></a>
		<?php endif; ?>
	</section>
</main>

<?php
do_action( 'woocommerce_after_cart' );
