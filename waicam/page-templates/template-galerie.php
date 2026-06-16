<?php
/**
 * Template Name: WAI-CAM — Galerie Photo
 *
 * Page galerie multimédia alimentée par Envira Gallery.
 * Chaque galerie Envira représente un évènement et peut être retrouvée par son nom.
 *
 * @package WAICAM
 */

get_header();

$gallery_search = isset( $_GET['gallery_search'] ) ? sanitize_text_field( wp_unslash( $_GET['gallery_search'] ) ) : '';

$configured_galleries = array_filter(
	array(
		absint( get_theme_mod( 'waicam_envira_gallery_formations', 0 ) ),
		absint( get_theme_mod( 'waicam_envira_gallery_conferences', 0 ) ),
		absint( get_theme_mod( 'waicam_envira_gallery_terrain', 0 ) ),
		absint( get_theme_mod( 'waicam_envira_gallery_evenements', 0 ) ),
	)
);

$gallery_cover_id = static function( $gallery_id ) {
	$gallery_id = absint( $gallery_id );
	if ( ! $gallery_id ) {
		return 0;
	}

	if ( has_post_thumbnail( $gallery_id ) ) {
		return get_post_thumbnail_id( $gallery_id );
	}

	$envira_data = get_post_meta( $gallery_id, '_eg_gallery_data', true );
	if ( is_array( $envira_data ) && ! empty( $envira_data['gallery'] ) && is_array( $envira_data['gallery'] ) ) {
		foreach ( $envira_data['gallery'] as $attachment_key => $attachment ) {
			if ( is_array( $attachment ) && ! empty( $attachment['id'] ) ) {
				return absint( $attachment['id'] );
			}
			if ( is_numeric( $attachment_key ) ) {
				return absint( $attachment_key );
			}
		}
	}

	return 0;
};

$gallery_items = array();

if ( post_type_exists( 'envira' ) ) {
	$envira_query_args = array(
		'post_type'      => 'envira',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	);
	if ( $gallery_search ) {
		$envira_query_args['s'] = $gallery_search;
	}

	$envira_query = new WP_Query( $envira_query_args );
	if ( $envira_query->have_posts() ) {
		while ( $envira_query->have_posts() ) {
			$envira_query->the_post();
			$gallery_items[] = array(
				'id'    => get_the_ID(),
				'title' => get_the_title(),
			);
		}
		wp_reset_postdata();
	}
}

if ( empty( $gallery_items ) && ! empty( $configured_galleries ) ) {
	foreach ( $configured_galleries as $gallery_id ) {
		$gallery_post  = get_post( $gallery_id );
		$gallery_title = $gallery_post ? get_the_title( $gallery_post ) : sprintf( __( 'Galerie évènement #%d', 'waicam' ), $gallery_id );
		if ( $gallery_search && false === stripos( remove_accents( $gallery_title ), remove_accents( $gallery_search ) ) ) {
			continue;
		}
		$gallery_items[] = array(
			'id'    => $gallery_id,
			'title' => $gallery_title,
		);
	}
}

usort(
	$gallery_items,
	static function( $a, $b ) {
		return strcasecmp( remove_accents( $a['title'] ), remove_accents( $b['title'] ) );
	}
);
?>

<section class="gwc-news-landing waicam-gallery-page" aria-labelledby="waicam-gallery-title">
	<div class="gwc-news-stream-header waicam-gallery-header">
		<span class="gwc-news-label"><?php esc_html_e( 'Galerie photo', 'waicam' ); ?></span>
		<h1 id="waicam-gallery-title" class="gwc-news-heading">
			<span class="gwc-wave-underline">
				<?php esc_html_e( 'Revivez nos évènements', 'waicam' ); ?>
				<svg class="gwc-wave-svg" viewBox="0 0 512 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C16 1 32 1 48 12 S80 23 96 12 S128 1 144 12 S176 23 192 12 S224 1 240 12 S272 23 288 12 S320 1 336 12 S368 23 384 12 S416 1 432 12 S464 23 480 12 S496 1 512 12" />
				</svg>
			</span>
		</h1>
		<p class="waicam-gallery-intro"><?php esc_html_e( 'Parcourez les galeries Envira classées par nom d’évènement et retrouvez rapidement les photos d’une formation, conférence, mission terrain ou rencontre WAI-CAM.', 'waicam' ); ?></p>
	</div>

	<form class="events-calendar-toolbar waicam-gallery-toolbar" role="search" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
		<label class="events-calendar-toolbar__search" for="waicam-gallery-search">
			<span class="screen-reader-text"><?php esc_html_e( 'Rechercher une galerie par nom d’évènement', 'waicam' ); ?></span>
			<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M10.8 18.1a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Zm5.2-1.1 4.2 4.2" /></svg>
			<input id="waicam-gallery-search" type="search" name="gallery_search" value="<?php echo esc_attr( $gallery_search ); ?>" placeholder="<?php esc_attr_e( 'Rechercher par nom d’évènement', 'waicam' ); ?>" />
		</label>
		<button class="events-calendar-toolbar__submit" type="submit"><?php esc_html_e( 'Chercher', 'waicam' ); ?></button>
		<nav class="events-calendar-toolbar__views" aria-label="<?php esc_attr_e( 'Filtres galerie', 'waicam' ); ?>">
			<a class="is-active" href="#waicam-gallery-results"><?php esc_html_e( 'Galeries', 'waicam' ); ?></a>
			<?php if ( $gallery_search ) : ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Tout voir', 'waicam' ); ?></a>
			<?php endif; ?>
		</nav>
	</form>

	<?php if ( ! empty( $gallery_items ) ) : ?>
		<ul id="waicam-gallery-results" class="gwc-news-list waicam-gallery-list">
			<?php foreach ( $gallery_items as $gallery_item ) :
				$gallery_id    = absint( $gallery_item['id'] );
				$gallery_title = $gallery_item['title'];
				$cover_id      = $gallery_cover_id( $gallery_id );
				$target_id     = 'waicam-gallery-event-' . $gallery_id;
				?>
				<li class="gwc-news-item waicam-gallery-item">
					<a class="gwc-news-card waicam-gallery-card" href="#<?php echo esc_attr( $target_id ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Voir la galerie : %s', 'waicam' ), $gallery_title ) ); ?>">
						<div class="gwc-news-item-title" title="<?php echo esc_attr( $gallery_title ); ?>">
							<span class="gwc-news-title-text"><?php echo esc_html( $gallery_title ); ?></span>
						</div>
						<div class="gwc-news-item-image<?php echo $cover_id ? ' has-image' : ''; ?>">
							<?php if ( $cover_id ) : ?>
								<picture><?php echo wp_get_attachment_image( $cover_id, 'large', false, array( 'alt' => $gallery_title, 'loading' => 'lazy' ) ); ?></picture>
							<?php else : ?>
								<span class="gwc-news-image-placeholder waicam-gallery-placeholder" aria-hidden="true"></span>
							<?php endif; ?>
						</div>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="waicam-gallery-event-list" aria-label="<?php esc_attr_e( 'Galeries par évènement', 'waicam' ); ?>">
			<?php foreach ( $gallery_items as $gallery_item ) :
				$gallery_id    = absint( $gallery_item['id'] );
				$gallery_title = $gallery_item['title'];
				?>
				<section id="waicam-gallery-event-<?php echo esc_attr( $gallery_id ); ?>" class="waicam-gallery-event">
					<div class="waicam-gallery-event__header">
						<span><?php esc_html_e( 'Galerie évènement', 'waicam' ); ?></span>
						<h2><?php echo esc_html( $gallery_title ); ?></h2>
					</div>
					<div class="waicam-gallery-event__body">
						<?php
						if ( shortcode_exists( 'envira-gallery' ) ) {
							echo do_shortcode( '[envira-gallery id="' . esc_attr( $gallery_id ) . '"]' );
						} elseif ( current_user_can( 'manage_options' ) ) {
							echo '<div class="gallery-empty gallery-empty--admin"><p>' . esc_html__( 'Activez Envira Gallery pour afficher cette galerie.', 'waicam' ) . '</p></div>';
						} else {
							echo '<p class="gallery-empty">' . esc_html__( 'Galerie en cours de constitution.', 'waicam' ) . '</p>';
						}
						?>
					</div>
				</section>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<div class="gwc-news-empty waicam-gallery-empty">
			<p><?php esc_html_e( 'Aucune galerie ne correspond à votre recherche pour le moment.', 'waicam' ); ?></p>
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<p><?php esc_html_e( 'Créez des galeries Envira ou renseignez leurs IDs dans Apparence → Personnaliser → WAI-CAM → Galeries.', 'waicam' ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>

<?php
get_footer();
