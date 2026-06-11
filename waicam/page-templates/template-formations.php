<?php
/**
 * Template Name: WAI-CAM — Formations
 *
 * Page dédiée aux formations WAI-CAM alimentée par The Events Calendar.
 * Les formations sont des évènements catégorisés Formation / Masterclass /
 * Atelier / Bootcamp dans The Events Calendar.
 *
 * @package WAICAM
 */

get_header();

$hero_image_id = absint( get_theme_mod( 'waicam_formations_hero_image_id', 0 ) );
if ( ! $hero_image_id && has_post_thumbnail() ) {
	$hero_image_id = get_post_thumbnail_id();
}
$hero_year = get_theme_mod( 'waicam_formations_hero_year', gmdate( 'Y' ) );
?>

<main id="primary" class="events-campaign-page formations-campaign-page">
	<section class="events-campaign-hero formations-campaign-hero" aria-label="<?php esc_attr_e( 'Formations WAI-CAM', 'waicam' ); ?>">
		<div class="events-campaign-hero__media">
			<?php if ( $hero_image_id ) : ?>
				<?php
				echo wp_get_attachment_image(
					$hero_image_id,
					'full',
					false,
					array(
						'class'    => 'events-campaign-hero__image',
						'loading'  => 'eager',
						'decoding' => 'async',
					)
				);
				?>
			<?php else : ?>
				<div class="events-campaign-hero__placeholder" aria-hidden="true">
					<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
					<strong><?php esc_html_e( 'FORMATIONS', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $hero_year ) : ?>
			<div class="events-campaign-hero__sticker" aria-label="<?php echo esc_attr( sprintf( __( 'Année %s', 'waicam' ), $hero_year ) ); ?>">
				<span><?php echo esc_html( $hero_year ); ?></span>
			</div>
		<?php endif; ?>
	</section>

	<section class="events-campaign-intro formations-campaign-intro" aria-labelledby="formations-campaign-intro-title">
		<div class="events-campaign-intro__inner">
			<h1 id="formations-campaign-intro-title" class="events-campaign-intro__title">
				<?php echo esc_html( get_theme_mod( 'waicam_formations_intro_title', __( 'FORMATIONS WAI-CAM', 'waicam' ) ) ); ?>
			</h1>

			<div class="events-campaign-intro__copy">
				<p><?php echo esc_html( get_theme_mod( 'waicam_formations_intro_text', __( "Développez vos compétences en intelligence artificielle, data, leadership numérique et innovation grâce aux formations, ateliers, bootcamps et masterclass de Women in AI Cameroon.", 'waicam' ) ) ); ?></p>
				<a class="events-campaign-intro__link" href="<?php echo esc_url( get_theme_mod( 'waicam_formations_intro_cta_url', '#formations-shop' ) ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_formations_intro_cta_text', __( 'Voir les formations achetables', 'waicam' ) ) ); ?></span>
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
					</svg>
				</a>
			</div>
		</div>
	</section>

	<?php
	$training_products = null;

	if ( class_exists( 'WooCommerce' ) ) {
		$training_product_terms = array();
		$product_categories     = get_terms( array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		) );

		if ( ! is_wp_error( $product_categories ) ) {
			foreach ( $product_categories as $product_category ) {
				$category_signature = strtolower( $product_category->slug . ' ' . $product_category->name );
				if ( preg_match( '/formation|cours|training|atelier|masterclass/', $category_signature ) ) {
					$training_product_terms[] = $product_category->slug;
				}
			}
		}

		if ( $training_product_terms ) {
			$training_products = new WP_Query( array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'posts_per_page'      => 6,
				'ignore_sticky_posts' => true,
				'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => $training_product_terms,
					),
				),
			) );
		}
	}
	?>

	<?php if ( $training_products && $training_products->have_posts() ) : ?>
	<section id="formations-shop" class="formations-shop-section" aria-labelledby="formations-shop-title">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Formations en ligne', 'waicam' ); ?></div>
			<h2 id="formations-shop-title" class="section-title"><?php echo wp_kses_post( __( 'Formations <span>à acheter</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'Ces formations sont vendues comme produits WooCommerce : consulte le programme, ajoute la formation au panier, puis finalise ton achat en ligne.', 'waicam' ); ?></p>
		</div>

		<div class="formations-shop-grid">
			<?php
			while ( $training_products->have_posts() ) :
				$training_products->the_post();
				$product = wc_get_product( get_the_ID() );
				if ( ! $product ) {
					continue;
				}
				?>
				<article <?php wc_product_class( 'formations-shop-card', $product ); ?>>
					<a class="formations-shop-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large' ); ?>
						<?php else : ?>
							<div class="formations-shop-card__placeholder" aria-hidden="true"><?php esc_html_e( 'Formation WAI-CAM', 'waicam' ); ?></div>
						<?php endif; ?>
					</a>

					<div class="formations-shop-card__body">
						<p class="formations-shop-card__category"><?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ' ) ); ?></p>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( $product->get_short_description() ? wp_strip_all_tags( $product->get_short_description() ) : get_the_excerpt(), 22 ) ); ?></p>
						<div class="formations-shop-card__footer">
							<span class="formations-shop-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
							<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
							   data-quantity="1"
							   data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
							   data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
							   class="formations-shop-card__button <?php echo esc_attr( implode( ' ', array_filter( array( 'button', 'product_type_' . $product->get_type(), $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' ) ) ) ); ?>">
								<?php echo esc_html( $product->add_to_cart_text() ); ?>
							</a>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<div class="formations-shop-more">
			<a class="btn-outline" href="<?php echo esc_url( home_url( '/produits/' ) ); ?>"><?php esc_html_e( 'Voir toutes les formations en vente', 'waicam' ); ?></a>
		</div>
	</section>
	<?php wp_reset_postdata(); ?>
	<?php endif; ?>

	<?php
	$feature_event = waicam_get_formations( 1, 'a-venir' );
	$feature_id    = ( $feature_event && $feature_event->have_posts() ) ? $feature_event->posts[0]->ID : 0;
	$feature_title = get_theme_mod( 'waicam_formations_feature_title', '' );
	$feature_text  = get_theme_mod( 'waicam_formations_feature_text', '' );
	$feature_url   = get_theme_mod( 'waicam_formations_feature_cta_url', '' );
	$feature_img   = absint( get_theme_mod( 'waicam_formations_feature_image_id', 0 ) );

	if ( ! $feature_title ) {
		$feature_title = $feature_id ? get_the_title( $feature_id ) : __( 'Prochaine formation WAI-CAM', 'waicam' );
	}
	if ( ! $feature_text ) {
		$feature_text = $feature_id ? waicam_event_excerpt( $feature_id, 150 ) : __( "Découvrez nos prochaines sessions : ateliers pratiques, masterclass, bootcamps et parcours d'initiation pour rendre l'IA accessible aux femmes et aux jeunes au Cameroun.", 'waicam' );
	}
	if ( ! $feature_url ) {
		$feature_url = $feature_id ? get_permalink( $feature_id ) : '#formations-calendar';
	}
	if ( ! $feature_img && $feature_id && has_post_thumbnail( $feature_id ) ) {
		$feature_img = get_post_thumbnail_id( $feature_id );
	}
	?>
	<section class="events-campaign-feature formations-campaign-feature" aria-labelledby="formations-campaign-feature-title">
		<div class="events-campaign-feature__copy">
			<div class="events-campaign-feature__copy-inner">
				<h2 id="formations-campaign-feature-title"><?php echo esc_html( $feature_title ); ?></h2>
				<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
				</svg>
				<p><?php echo esc_html( $feature_text ); ?></p>

				<?php if ( $feature_id ) : ?>
					<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations formation', 'waicam' ); ?>">
						<li><?php echo esc_html( waicam_event_date( $feature_id ) ); ?></li>
						<?php if ( waicam_event_venue( $feature_id ) ) : ?>
							<li><?php echo esc_html( waicam_event_venue( $feature_id ) ); ?></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

				<a class="events-campaign-feature__link" href="<?php echo esc_url( $feature_url ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_formations_feature_cta_text', __( 'Découvrir la formation', 'waicam' ) ) ); ?></span>
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
					</svg>
				</a>
			</div>
		</div>

		<div class="events-campaign-feature__visual">
			<?php if ( $feature_img ) : ?>
				<?php echo wp_get_attachment_image( $feature_img, 'large', false, array( 'class' => 'events-campaign-feature__image', 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<div class="events-campaign-feature__placeholder">
					<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
					<strong><?php esc_html_e( 'FORMATION', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php wp_reset_postdata(); ?>

	<?php
	$formation_cards = waicam_get_formations( -1, 'a-venir' );
	if ( $formation_cards ) :
		$card_index = 0;
		while ( $formation_cards->have_posts() ) :
			$formation_cards->the_post();
			$card_id = get_the_ID();
			if ( $feature_id && $card_id === $feature_id ) {
				continue;
			}

			$card_classes = array( 'events-campaign-feature', 'events-campaign-feature--auto', 'formations-campaign-feature' );
			if ( 0 === $card_index % 2 ) {
				$card_classes[] = 'events-campaign-feature--image-left';
			}
			$card_classes[] = 'events-campaign-feature--tone-' . array( 'green', 'red', 'blue' )[ $card_index % 3 ];

			$card_img   = has_post_thumbnail( $card_id ) ? get_post_thumbnail_id( $card_id ) : 0;
			$card_venue = waicam_event_venue( $card_id );
			?>
			<section class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>" aria-labelledby="formations-campaign-card-<?php echo esc_attr( $card_id ); ?>">
				<div class="events-campaign-feature__copy">
					<div class="events-campaign-feature__copy-inner">
						<h2 id="formations-campaign-card-<?php echo esc_attr( $card_id ); ?>"><?php the_title(); ?></h2>
						<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
							<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
						</svg>
						<p><?php echo esc_html( waicam_event_excerpt( $card_id, 150 ) ); ?></p>

						<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations formation', 'waicam' ); ?>">
							<li><?php echo esc_html( waicam_event_date( $card_id ) ); ?></li>
							<?php if ( $card_venue ) : ?>
								<li><?php echo esc_html( $card_venue ); ?></li>
							<?php endif; ?>
						</ul>

						<a class="events-campaign-feature__link" href="<?php the_permalink(); ?>">
							<span><?php esc_html_e( 'Voir la formation', 'waicam' ); ?></span>
							<span class="arrow-plain">→</span>
							<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
								<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
							</svg>
						</a>
					</div>
				</div>

				<div class="events-campaign-feature__visual">
					<?php if ( $card_img ) : ?>
						<?php echo wp_get_attachment_image( $card_img, 'large', false, array( 'class' => 'events-campaign-feature__image', 'loading' => 'lazy' ) ); ?>
					<?php else : ?>
						<div class="events-campaign-feature__placeholder">
							<span><?php esc_html_e( 'WAI-CAM', 'waicam' ); ?></span>
							<strong><?php esc_html_e( 'FORMATION', 'waicam' ); ?></strong>
						</div>
					<?php endif; ?>
				</div>
			</section>
			<?php
			$card_index++;
		endwhile;
		wp_reset_postdata();
	endif;
	?>

	<section id="formations-calendar" class="events-calendar-system formations-calendar-system" aria-labelledby="formations-calendar-title">
		<div class="events-calendar-system__inner">
			<div class="events-calendar-system__heading">
				<span class="events-calendar-system__kicker"><?php esc_html_e( 'Calendrier', 'waicam' ); ?></span>
				<h2 id="formations-calendar-title"><?php esc_html_e( 'Toutes les formations', 'waicam' ); ?></h2>
				<p><?php esc_html_e( 'Retrouvez le calendrier complet des ateliers, masterclass, bootcamps et sessions de formation Women in AI Cameroon.', 'waicam' ); ?></p>
			</div>

			<?php
			$calendar_search = isset( $_GET['formation_search'] ) ? sanitize_text_field( wp_unslash( $_GET['formation_search'] ) ) : '';
			$calendar_date   = isset( $_GET['formation_date'] ) ? sanitize_text_field( wp_unslash( $_GET['formation_date'] ) ) : '';
			if ( $calendar_date && ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $calendar_date ) ) {
				$calendar_date = '';
			}
			$formations_page     = isset( $_GET['formations_page'] ) ? max( 1, absint( $_GET['formations_page'] ) ) : 1;
			$formations_per_page = 6;
			$calendar_base       = get_permalink();
			$calendar_feed       = function_exists( 'tribe_get_ical_link' ) ? tribe_get_ical_link() : add_query_arg( 'ical', '1', $calendar_base );
			$calendar_webcal     = set_url_scheme( $calendar_feed, 'webcal' );
			$calendar_google     = add_query_arg( 'cid', rawurlencode( $calendar_webcal ), 'https://calendar.google.com/calendar/r' );
			$calendar_args       = array(
				'posts_per_page' => $formations_per_page,
				'paged'          => $formations_page,
				'order'          => 'ASC',
				'tax_query'      => array(
					array(
						'taxonomy' => 'tribe_events_cat',
						'field'    => 'slug',
						'terms'    => array( 'formation', 'masterclass', 'atelier', 'bootcamp' ),
					),
				),
			);
			if ( $calendar_date ) {
				$calendar_args['starts_after']  = $calendar_date . ' 00:00:00';
				$calendar_args['starts_before'] = $calendar_date . ' 23:59:59';
			} else {
				$calendar_args['ends_after'] = current_time( 'Y-m-d H:i:s' );
			}
			if ( $calendar_search ) {
				$calendar_args['s'] = $calendar_search;
			}
			$calendar_formations  = function_exists( 'tribe_get_events' ) ? tribe_get_events( $calendar_args, true ) : null;
			$calendar_total_pages = ( $calendar_formations && ! empty( $calendar_formations->max_num_pages ) ) ? (int) $calendar_formations->max_num_pages : 1;
			$calendar_url_args    = array_filter(
				array(
					'formation_search' => $calendar_search,
					'formation_date'   => $calendar_date,
				),
				static function( $value ) {
					return '' !== $value;
				}
			);
			$calendar_previous_url = add_query_arg( array_merge( $calendar_url_args, array( 'formations_page' => max( 1, $formations_page - 1 ) ) ), get_permalink() ) . '#formations-calendar';
			$calendar_next_url     = add_query_arg( array_merge( $calendar_url_args, array( 'formations_page' => $formations_page + 1 ) ), get_permalink() ) . '#formations-calendar';
			?>

			<form class="events-calendar-toolbar" role="search" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
				<?php if ( $calendar_date ) : ?>
					<input type="hidden" name="formation_date" value="<?php echo esc_attr( $calendar_date ); ?>" />
				<?php endif; ?>
				<label class="events-calendar-toolbar__search" for="formations-calendar-search">
					<span class="screen-reader-text"><?php esc_html_e( 'Rechercher des formations', 'waicam' ); ?></span>
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M10.8 18.1a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Zm5.2-1.1 4.2 4.2" /></svg>
					<input id="formations-calendar-search" type="search" name="formation_search" value="<?php echo esc_attr( $calendar_search ); ?>" placeholder="<?php esc_attr_e( 'Rechercher formations', 'waicam' ); ?>" />
				</label>
				<button class="events-calendar-toolbar__submit" type="submit"><?php esc_html_e( 'Chercher', 'waicam' ); ?></button>
				<nav class="events-calendar-toolbar__views" aria-label="<?php esc_attr_e( 'Vues du calendrier', 'waicam' ); ?>">
					<a class="is-active" href="#formations-calendar"><?php esc_html_e( 'Liste', 'waicam' ); ?></a>
					<a href="<?php echo esc_url( add_query_arg( 'eventDisplay', 'month', $calendar_base ) ); ?>"><?php esc_html_e( 'Mois', 'waicam' ); ?></a>
					<a href="<?php echo esc_url( add_query_arg( 'eventDisplay', 'day', $calendar_base ) ); ?>"><?php esc_html_e( 'Jour', 'waicam' ); ?></a>
				</nav>
			</form>

			<div class="events-calendar-controls">
				<div class="events-calendar-controls__nav">
					<?php if ( 1 < $formations_page ) : ?>
						<a href="<?php echo esc_url( $calendar_previous_url ); ?>" aria-label="<?php esc_attr_e( 'Formations précédentes', 'waicam' ); ?>">‹</a>
					<?php endif; ?>
					<?php if ( $formations_page < $calendar_total_pages ) : ?>
						<a href="<?php echo esc_url( $calendar_next_url ); ?>" aria-label="<?php esc_attr_e( 'Formations suivantes', 'waicam' ); ?>">›</a>
					<?php endif; ?>
					<form class="events-calendar-date-filter" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
						<?php if ( $calendar_search ) : ?>
							<input type="hidden" name="formation_search" value="<?php echo esc_attr( $calendar_search ); ?>" />
						<?php endif; ?>
						<label class="events-calendar-controls__today" for="formations-calendar-date">
							<span><?php esc_html_e( 'Aujourd’hui', 'waicam' ); ?></span>
							<input id="formations-calendar-date" type="date" name="formation_date" value="<?php echo esc_attr( $calendar_date ); ?>" onchange="this.form.submit()" />
						</label>
					</form>
				</div>
				<strong><?php echo esc_html( $calendar_date ? wp_date( 'j F Y', strtotime( $calendar_date ) ) : __( 'À venir', 'waicam' ) ); ?></strong>
			</div>

			<div class="events-calendar-list" role="list">
				<?php if ( $calendar_formations && $calendar_formations->have_posts() ) : ?>
					<?php
					$current_month = '';
					while ( $calendar_formations->have_posts() ) :
						$calendar_formations->the_post();
						$formation_id    = get_the_ID();
						$formation_month = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $formation_id, false, 'F Y' ) : get_the_date( 'F Y', $formation_id );
						$formation_day   = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $formation_id, false, 'd' ) : get_the_date( 'd', $formation_id );
						$formation_dow   = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $formation_id, false, 'D' ) : get_the_date( 'D', $formation_id );
						$formation_venue = waicam_event_venue( $formation_id );
						$formation_ical  = function_exists( 'tribe_get_single_ical_link' ) ? tribe_get_single_ical_link( $formation_id ) : add_query_arg( 'ical', '1', get_permalink( $formation_id ) );
						$formation_gcal  = function_exists( 'tribe_get_gcal_link' ) ? tribe_get_gcal_link( $formation_id ) : '';
						if ( $formation_month !== $current_month ) :
							$current_month = $formation_month;
							?>
							<div class="events-calendar-list__month"><span><?php echo esc_html( $current_month ); ?></span></div>
						<?php endif; ?>
						<article class="events-calendar-item" role="listitem">
							<div class="events-calendar-item__date" aria-label="<?php echo esc_attr( waicam_event_date( $formation_id ) ); ?>">
								<span><?php echo esc_html( $formation_dow ); ?></span>
								<strong><?php echo esc_html( $formation_day ); ?></strong>
							</div>
							<div class="events-calendar-item__body">
								<p class="events-calendar-item__time"><?php echo esc_html( waicam_event_date( $formation_id ) ); ?></p>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php if ( $formation_venue ) : ?>
									<p class="events-calendar-item__venue"><?php echo esc_html( $formation_venue ); ?></p>
								<?php endif; ?>
								<p><?php echo esc_html( waicam_event_excerpt( $formation_id, 260 ) ); ?></p>
								<div class="events-calendar-item__actions">
									<a href="<?php echo esc_url( $formation_ical ); ?>"><?php esc_html_e( 'Ajouter au calendrier', 'waicam' ); ?></a>
									<?php if ( $formation_gcal ) : ?>
										<a href="<?php echo esc_url( $formation_gcal ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Google Agenda', 'waicam' ); ?></a>
									<?php endif; ?>
								</div>
							</div>
							<?php if ( has_post_thumbnail( $formation_id ) ) : ?>
								<a class="events-calendar-item__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
									<?php echo get_the_post_thumbnail( $formation_id, 'large', array( 'loading' => 'lazy' ) ); ?>
								</a>
							<?php endif; ?>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="events-calendar-empty">
						<p><?php esc_html_e( 'Aucune formation ne correspond à votre recherche pour le moment.', 'waicam' ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<div class="events-calendar-footer">
				<?php if ( 1 < $formations_page ) : ?>
					<a class="events-calendar-footer__previous" href="<?php echo esc_url( $calendar_previous_url ); ?>">‹ <?php esc_html_e( 'Formations précédentes', 'waicam' ); ?></a>
				<?php else : ?>
					<span class="events-calendar-footer__previous is-disabled">‹ <?php esc_html_e( 'Formations précédentes', 'waicam' ); ?></span>
				<?php endif; ?>
				<?php if ( $formations_page < $calendar_total_pages ) : ?>
					<a class="events-calendar-footer__next" href="<?php echo esc_url( $calendar_next_url ); ?>">
						<span><?php esc_html_e( 'Formations suivantes', 'waicam' ); ?></span>
						<span class="arrow-plain">→</span>
						<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
							<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
						</svg>
					</a>
				<?php else : ?>
					<span class="events-calendar-footer__next is-disabled"><?php esc_html_e( 'Formations suivantes', 'waicam' ); ?> →</span>
				<?php endif; ?>
				<details class="events-calendar-subscribe">
					<summary><?php esc_html_e( 'S’abonner au calendrier', 'waicam' ); ?></summary>
					<div class="events-calendar-subscribe__menu">
						<a href="<?php echo esc_url( $calendar_base ); ?>"><?php esc_html_e( 'Calendrier The Events Calendar', 'waicam' ); ?></a>
						<a href="<?php echo esc_url( $calendar_google ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Google Agenda', 'waicam' ); ?></a>
						<a href="<?php echo esc_url( $calendar_feed ); ?>"><?php esc_html_e( 'iCalendar', 'waicam' ); ?></a>
						<a href="<?php echo esc_url( $calendar_webcal ); ?>"><?php esc_html_e( 'Outlook 365', 'waicam' ); ?></a>
						<a href="<?php echo esc_url( $calendar_webcal ); ?>"><?php esc_html_e( 'Outlook Live', 'waicam' ); ?></a>
						<a href="<?php echo esc_url( $calendar_feed ); ?>" download><?php esc_html_e( 'Exporter le fichier .ics', 'waicam' ); ?></a>
					</div>
				</details>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
