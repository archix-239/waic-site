<?php
/**
 * WAI-CAM styled WooCommerce cart page.
 *
 * @package WAICAM
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<main class="waicam-cart-page" id="primary">
	<section class="waicam-cart-hero" aria-labelledby="waicam-cart-title">
		<div class="waicam-cart-hero__inner">
			<p class="waicam-cart-kicker"><?php esc_html_e( 'Panier WAI-CAM', 'waicam' ); ?></p>
			<h1 id="waicam-cart-title"><?php esc_html_e( 'Finalisez votre achat en toute simplicité', 'waicam' ); ?></h1>
			<p><?php esc_html_e( 'Vérifiez vos produits, ajustez les quantités puis passez au paiement sécurisé pour soutenir les actions Women in AI Cameroon.', 'waicam' ); ?></p>
		</div>
	</section>

	<div class="waicam-cart-form">
		<div class="waicam-cart-layout">
			<form class="woocommerce-cart-form waicam-cart-items-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<section class="waicam-cart-items" aria-label="<?php esc_attr_e( 'Articles du panier', 'waicam' ); ?>">
				<div class="waicam-cart-items__head">
					<h2><?php esc_html_e( 'Vos articles', 'waicam' ); ?></h2>
					<span><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?> <?php esc_html_e( 'article(s)', 'waicam' ); ?></span>
				</div>

				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
					<?php
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( ! $_product || ! $_product->exists() || 0 >= $cart_item['quantity'] || ! apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						continue;
					}

					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>

					<article class="waicam-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
						<div class="waicam-cart-item__media">
							<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
							if ( $product_permalink ) {
								echo '<a href="' . esc_url( $product_permalink ) . '">' . $thumbnail . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							} else {
								echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</div>

						<div class="waicam-cart-item__body">
							<div class="waicam-cart-item__title-row">
								<h3>
									<?php
									if ( $product_permalink ) {
										echo '<a href="' . esc_url( $product_permalink ) . '">' . wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ) . '</a>';
									} else {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) );
									}
									?>
								</h3>
								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="waicam-cart-item__remove remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_attr( sprintf( __( 'Retirer %s du panier', 'waicam' ), wp_strip_all_tags( $_product->get_name() ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() ),
										esc_html__( 'Retirer', 'waicam' )
									),
									$cart_item_key
								);
								?>
							</div>

							<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

							<div class="waicam-cart-item__meta">
								<div>
									<span><?php esc_html_e( 'Prix', 'waicam' ); ?></span>
									<strong><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</div>
								<div class="waicam-cart-item__quantity">
									<label class="screen-reader-text" for="quantity_<?php echo esc_attr( $cart_item_key ); ?>"><?php esc_html_e( 'Quantité', 'waicam' ); ?></label>
									<?php
									if ( $_product->is_sold_individually() ) {
										$min_quantity = 1;
										$max_quantity = 1;
									} else {
										$min_quantity = 0;
										$max_quantity = $_product->get_max_purchase_quantity();
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', woocommerce_quantity_input( array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $max_quantity,
										'min_value'    => $min_quantity,
										'product_name' => $_product->get_name(),
									), $_product, false ), $cart_item_key, $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									?>
								</div>
								<div>
									<span><?php esc_html_e( 'Sous-total', 'waicam' ); ?></span>
									<strong><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
								</div>
							</div>
						</div>
					</article>
				<?php endforeach; ?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<div class="waicam-cart-actions">
					<?php if ( wc_coupons_enabled() ) : ?>
						<div class="coupon waicam-cart-coupon">
							<label for="coupon_code"><?php esc_html_e( 'Code promo', 'waicam' ); ?></label>
							<input type="text" name="coupon_code" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Votre code', 'waicam' ); ?>" />
							<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Appliquer le coupon', 'waicam' ); ?>"><?php esc_html_e( 'Appliquer', 'waicam' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php endif; ?>

					<button type="submit" class="button waicam-cart-update" name="update_cart" value="<?php esc_attr_e( 'Mettre à jour le panier', 'waicam' ); ?>"><?php esc_html_e( 'Mettre à jour le panier', 'waicam' ); ?></button>
					<?php do_action( 'woocommerce_cart_actions' ); ?>
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</div>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				</section>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>
			</form>

			<aside class="waicam-cart-summary" aria-label="<?php esc_attr_e( 'Résumé du panier', 'waicam' ); ?>">
				<div class="cart-collaterals">
					<?php do_action( 'woocommerce_cart_collaterals' ); ?>
				</div>
			</aside>
		</div>
	</div>

	<?php do_action( 'woocommerce_after_cart' ); ?>
</main>
