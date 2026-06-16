<?php
/**
 * Template Name: Produits
 *
 * Boutique WAI-CAM — produits WooCommerce.
 *
 * @package WAICAM
 */

get_header();

$search_term = isset( $_GET['recherche_produit'] ) ? sanitize_text_field( wp_unslash( $_GET['recherche_produit'] ) ) : '';
$product_cat = isset( $_GET['categorie_produit'] ) ? sanitize_title( wp_unslash( $_GET['categorie_produit'] ) ) : '';
$paged       = max( 1, get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : absint( get_query_var( 'page' ) ) );

$products_query = null;
$categories     = array();

if ( class_exists( 'WooCommerce' ) ) {
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
	) );

	$query_args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'posts_per_page'      => 12,
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
		's'                   => $search_term,
	);

	if ( $product_cat ) {
		$query_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $product_cat,
			),
		);
	}

	$products_query = new WP_Query( $query_args );
}
?>

<main id="primary" class="waicam-products-page">
	<section class="waicam-products-hero" aria-labelledby="waicam-products-title">
		<div class="waicam-products-hero__inner">
			<p class="waicam-products-kicker"><?php esc_html_e( 'Boutique WAI-CAM', 'waicam' ); ?></p>
			<h1 id="waicam-products-title"><?php esc_html_e( 'Produits solidaires Women in AI Cameroon', 'waicam' ); ?></h1>
			<p><?php esc_html_e( 'Découvrez les articles, supports et produits officiels proposés par Women in AI Cameroon pour soutenir nos programmes, formations et actions terrain.', 'waicam' ); ?></p>
		</div>
	</section>

	<section class="waicam-products-shop" aria-labelledby="waicam-products-list-title">
		<div class="waicam-products-shop__intro">
			<div>
				<p class="waicam-products-shop__eyebrow"><?php esc_html_e( 'Catalogue', 'waicam' ); ?></p>
				<h2 id="waicam-products-list-title"><?php esc_html_e( 'Retrouvez nos produits disponibles', 'waicam' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Filtrez par nom ou par catégorie pour retrouver rapidement un produit, puis ajoutez-le au panier en quelques clics.', 'waicam' ); ?></p>
		</div>

		<?php if ( ! class_exists( 'WooCommerce' ) ) : ?>
			<div class="waicam-products-notice">
				<h2><?php esc_html_e( 'WooCommerce doit être activé', 'waicam' ); ?></h2>
				<p><?php esc_html_e( 'Cette page affiche les produits créés avec WooCommerce. Activez WooCommerce pour afficher le catalogue.', 'waicam' ); ?></p>
			</div>
		<?php else : ?>
			<form class="waicam-products-search" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
				<label class="waicam-products-search__field">
					<span class="screen-reader-text"><?php esc_html_e( 'Rechercher un produit', 'waicam' ); ?></span>
					<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
					<input type="search" name="recherche_produit" value="<?php echo esc_attr( $search_term ); ?>" placeholder="<?php esc_attr_e( 'Rechercher un produit', 'waicam' ); ?>" />
				</label>

				<label class="waicam-products-search__select">
					<span class="screen-reader-text"><?php esc_html_e( 'Catégorie de produit', 'waicam' ); ?></span>
					<select name="categorie_produit">
						<option value=""><?php esc_html_e( 'Toutes les catégories', 'waicam' ); ?></option>
						<?php if ( ! is_wp_error( $categories ) ) : ?>
							<?php foreach ( $categories as $category ) : ?>
								<option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $product_cat, $category->slug ); ?>>
									<?php echo esc_html( $category->name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</label>

				<button type="submit"><?php esc_html_e( 'Chercher', 'waicam' ); ?></button>
			</form>

			<?php if ( $products_query && $products_query->have_posts() ) : ?>
				<div class="waicam-products-grid">
					<?php
					while ( $products_query->have_posts() ) :
						$products_query->the_post();
						$product = wc_get_product( get_the_ID() );
						if ( ! $product ) {
							continue;
						}
						?>
						<article <?php wc_product_class( 'waicam-product-card', $product ); ?>>
							<a class="waicam-product-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'large' ); ?>
								<?php else : ?>
									<div class="waicam-product-card__placeholder" aria-hidden="true"><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></div>
								<?php endif; ?>
								<?php if ( $product->is_on_sale() ) : ?>
									<span class="waicam-product-card__badge"><?php esc_html_e( 'Promo', 'waicam' ); ?></span>
								<?php endif; ?>
							</a>

							<div class="waicam-product-card__body">
								<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<p class="waicam-product-card__category">', '</p>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="waicam-product-card__excerpt"><?php echo esc_html( wp_trim_words( $product->get_short_description() ? wp_strip_all_tags( $product->get_short_description() ) : get_the_excerpt(), 18 ) ); ?></p>
								<div class="waicam-product-card__footer">
									<span class="waicam-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
									<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
									   data-quantity="1"
									   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
									   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
									   class="waicam-product-card__button <?php echo esc_attr( implode( ' ', array_filter( array( 'button', 'product_type_' . $product->get_type(), $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' ) ) ) ); ?>">
										<?php echo esc_html( $product->add_to_cart_text() ); ?>
									</a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				$pagination = paginate_links( array(
					'total'     => (int) $products_query->max_num_pages,
					'current'   => $paged,
					'prev_text' => __( '← Produits précédents', 'waicam' ),
					'next_text' => __( 'Produits suivants →', 'waicam' ),
					'add_args'  => array_filter( array(
						'recherche_produit'  => $search_term,
						'categorie_produit'  => $product_cat,
					) ),
				) );
				?>
				<?php if ( $pagination ) : ?>
					<nav class="waicam-products-pagination" aria-label="<?php esc_attr_e( 'Pagination des produits', 'waicam' ); ?>">
						<?php echo wp_kses_post( $pagination ); ?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<div class="waicam-products-empty">
					<h2><?php esc_html_e( 'Aucun produit trouvé', 'waicam' ); ?></h2>
					<p><?php esc_html_e( 'Essayez un autre mot-clé ou retirez le filtre de catégorie.', 'waicam' ); ?></p>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</section>
</main>

<?php
get_footer();
