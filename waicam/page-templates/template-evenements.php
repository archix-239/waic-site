<?php
/**
 * Template Name: WAI-CAM — Évènements
 *
 * Page dédiée aux évènements WAI-CAM alimentée par The Events Calendar.
 * Les sections sont construites progressivement à partir des captures validées.
 *
 * @package WAICAM
 */

get_header();

$hero_image_id = absint( get_theme_mod( 'waicam_events_hero_image_id', 0 ) );
if ( ! $hero_image_id && has_post_thumbnail() ) {
	$hero_image_id = get_post_thumbnail_id();
}
$hero_year = get_theme_mod( 'waicam_events_hero_year', gmdate( 'Y' ) );
?>

<main id="primary" class="events-campaign-page">
	<section class="events-campaign-hero" aria-label="<?php esc_attr_e( 'Évènements WAI-CAM', 'waicam' ); ?>">
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
					<strong><?php esc_html_e( 'ÉVÈNEMENTS', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( $hero_year ) : ?>
			<div class="events-campaign-hero__sticker" aria-label="<?php echo esc_attr( sprintf( __( 'Année %s', 'waicam' ), $hero_year ) ); ?>">
				<span><?php echo esc_html( $hero_year ); ?></span>
			</div>
		<?php endif; ?>
	</section>
	<section class="events-campaign-intro" aria-labelledby="events-campaign-intro-title">
		<div class="events-campaign-intro__inner">
			<h1 id="events-campaign-intro-title" class="events-campaign-intro__title">
				<?php echo esc_html( get_theme_mod( 'waicam_events_intro_title', __( 'ÉVÈNEMENTS WAI-CAM', 'waicam' ) ) ); ?>
			</h1>

			<div class="events-campaign-intro__copy">
				<p><?php echo esc_html( get_theme_mod( 'waicam_events_intro_text', __( "Participez aux rencontres, formations, ateliers et actions terrain de Women in AI Cameroon. Nos évènements créent des espaces d’apprentissage, de dialogue et d’engagement autour d’une intelligence artificielle inclusive au Cameroun.", 'waicam' ) ) ); ?></p>
				<a class="events-campaign-intro__link" href="<?php echo esc_url( get_theme_mod( 'waicam_events_intro_cta_url', '#events-upcoming' ) ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_events_intro_cta_text', __( 'Voir les prochains évènements', 'waicam' ) ) ); ?></span>
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
					</svg>
				</a>
			</div>
		</div>
	</section>

	<?php
	$feature_event = waicam_get_evenements( 1, 'a-venir' );
	$feature_id    = ( $feature_event && $feature_event->have_posts() ) ? $feature_event->posts[0]->ID : 0;
	$feature_title = get_theme_mod( 'waicam_events_feature_title', '' );
	$feature_text  = get_theme_mod( 'waicam_events_feature_text', '' );
	$feature_url   = get_theme_mod( 'waicam_events_feature_cta_url', '' );
	$feature_img   = absint( get_theme_mod( 'waicam_events_feature_image_id', 0 ) );

	if ( ! $feature_title ) {
		$feature_title = $feature_id ? get_the_title( $feature_id ) : __( 'Prochain rendez-vous WAI-CAM', 'waicam' );
	}
	if ( ! $feature_text ) {
		$feature_text = $feature_id ? waicam_event_excerpt( $feature_id, 150 ) : __( "Découvrez les prochains temps forts de Women in AI Cameroon : ateliers, rencontres institutionnelles, formations terrain et moments de communauté autour d'une IA inclusive.", 'waicam' );
	}
	if ( ! $feature_url ) {
		$feature_url = $feature_id ? get_permalink( $feature_id ) : '#events-upcoming';
	}
	if ( ! $feature_img && $feature_id && has_post_thumbnail( $feature_id ) ) {
		$feature_img = get_post_thumbnail_id( $feature_id );
	}
	?>
	<section class="events-campaign-feature" aria-labelledby="events-campaign-feature-title">
		<div class="events-campaign-feature__copy">
			<div class="events-campaign-feature__copy-inner">
				<h2 id="events-campaign-feature-title"><?php echo esc_html( $feature_title ); ?></h2>
				<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
				</svg>
				<p><?php echo esc_html( $feature_text ); ?></p>

				<?php if ( $feature_id ) : ?>
					<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations évènement', 'waicam' ); ?>">
						<li><?php echo esc_html( waicam_event_date( $feature_id ) ); ?></li>
						<?php if ( waicam_event_venue( $feature_id ) ) : ?>
							<li><?php echo esc_html( waicam_event_venue( $feature_id ) ); ?></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

				<a class="events-campaign-feature__link" href="<?php echo esc_url( $feature_url ); ?>">
					<span><?php echo esc_html( get_theme_mod( 'waicam_events_feature_cta_text', __( 'En savoir plus', 'waicam' ) ) ); ?></span>
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
					<strong><?php esc_html_e( 'ÉVÈNEMENT', 'waicam' ); ?></strong>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php wp_reset_postdata(); ?>

	<?php
	$event_cards = waicam_get_evenements( -1, 'a-venir' );
	if ( $event_cards ) :
		$card_index = 0;
		while ( $event_cards->have_posts() ) :
			$event_cards->the_post();
			$card_id = get_the_ID();
			if ( $feature_id && $card_id === $feature_id ) {
				continue;
			}

			$card_classes = array( 'events-campaign-feature', 'events-campaign-feature--auto' );
			if ( 0 === $card_index % 2 ) {
				$card_classes[] = 'events-campaign-feature--image-left';
			}
			$card_classes[] = 'events-campaign-feature--tone-' . array( 'green', 'red', 'blue' )[ $card_index % 3 ];

			$card_img = has_post_thumbnail( $card_id ) ? get_post_thumbnail_id( $card_id ) : 0;
			$card_venue = waicam_event_venue( $card_id );
			?>
			<section class="<?php echo esc_attr( implode( ' ', $card_classes ) ); ?>" aria-labelledby="events-campaign-card-<?php echo esc_attr( $card_id ); ?>">
				<div class="events-campaign-feature__copy">
					<div class="events-campaign-feature__copy-inner">
						<h2 id="events-campaign-card-<?php echo esc_attr( $card_id ); ?>"><?php the_title(); ?></h2>
						<svg class="events-campaign-feature__wave" viewBox="0 0 260 24" role="presentation" aria-hidden="true" focusable="false">
							<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 260 12" />
						</svg>
						<p><?php echo esc_html( waicam_event_excerpt( $card_id, 150 ) ); ?></p>

						<ul class="events-campaign-feature__meta" aria-label="<?php esc_attr_e( 'Informations évènement', 'waicam' ); ?>">
							<li><?php echo esc_html( waicam_event_date( $card_id ) ); ?></li>
							<?php if ( $card_venue ) : ?>
								<li><?php echo esc_html( $card_venue ); ?></li>
							<?php endif; ?>
						</ul>

						<a class="events-campaign-feature__link" href="<?php the_permalink(); ?>">
							<span><?php echo esc_html( get_theme_mod( 'waicam_events_feature_cta_text', __( 'En savoir plus', 'waicam' ) ) ); ?></span>
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
							<strong><?php esc_html_e( 'ÉVÈNEMENT', 'waicam' ); ?></strong>
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


	<section id="events-calendar" class="events-calendar-system" aria-labelledby="events-calendar-title">
		<div class="events-calendar-system__inner">
			<div class="events-calendar-system__heading">
				<span class="events-calendar-system__kicker"><?php esc_html_e( 'Calendrier', 'waicam' ); ?></span>
				<h2 id="events-calendar-title"><?php esc_html_e( 'Tous les évènements', 'waicam' ); ?></h2>
				<p><?php esc_html_e( 'Retrouvez le calendrier complet des formations, rencontres, conférences et actions terrain de Women in AI Cameroon.', 'waicam' ); ?></p>
			</div>

			<?php
			$calendar_search = isset( $_GET['event_search'] ) ? sanitize_text_field( wp_unslash( $_GET['event_search'] ) ) : '';
			$calendar_date   = isset( $_GET['event_date'] ) ? sanitize_text_field( wp_unslash( $_GET['event_date'] ) ) : '';
			if ( $calendar_date && ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $calendar_date ) ) {
				$calendar_date = '';
			}
			$events_page     = isset( $_GET['events_page'] ) ? max( 1, absint( $_GET['events_page'] ) ) : 1;
			$events_per_page = 6;
			$calendar_base   = function_exists( 'tribe_get_events_link' ) ? tribe_get_events_link() : waicam_events_page_url();
			$calendar_feed   = function_exists( 'tribe_get_ical_link' ) ? tribe_get_ical_link() : add_query_arg( 'ical', '1', $calendar_base );
			$calendar_webcal = set_url_scheme( $calendar_feed, 'webcal' );
			$calendar_google = add_query_arg( 'cid', rawurlencode( $calendar_webcal ), 'https://calendar.google.com/calendar/r' );
			$calendar_args   = array(
				'posts_per_page' => $events_per_page,
				'paged'          => $events_page,
				'order'          => 'ASC',
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
			$calendar_events      = function_exists( 'tribe_get_events' ) ? tribe_get_events( $calendar_args, true ) : null;
			$calendar_total_pages = ( $calendar_events && ! empty( $calendar_events->max_num_pages ) ) ? (int) $calendar_events->max_num_pages : 1;
			$calendar_url_args    = array_filter(
				array(
					'event_search' => $calendar_search,
					'event_date'   => $calendar_date,
				),
				static function( $value ) {
					return '' !== $value;
				}
			);
			$calendar_previous_url = add_query_arg( array_merge( $calendar_url_args, array( 'events_page' => max( 1, $events_page - 1 ) ) ), get_permalink() ) . '#events-calendar';
			$calendar_next_url     = add_query_arg( array_merge( $calendar_url_args, array( 'events_page' => $events_page + 1 ) ), get_permalink() ) . '#events-calendar';
			?>

			<form class="events-calendar-toolbar" role="search" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
				<?php if ( $calendar_date ) : ?>
					<input type="hidden" name="event_date" value="<?php echo esc_attr( $calendar_date ); ?>" />
				<?php endif; ?>
				<label class="events-calendar-toolbar__search" for="events-calendar-search">
					<span class="screen-reader-text"><?php esc_html_e( 'Rechercher des évènements', 'waicam' ); ?></span>
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M10.8 18.1a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Zm5.2-1.1 4.2 4.2" /></svg>
					<input id="events-calendar-search" type="search" name="event_search" value="<?php echo esc_attr( $calendar_search ); ?>" placeholder="<?php esc_attr_e( 'Rechercher évènements', 'waicam' ); ?>" />
				</label>
				<button class="events-calendar-toolbar__submit" type="submit"><?php esc_html_e( 'Chercher', 'waicam' ); ?></button>
				<nav class="events-calendar-toolbar__views" aria-label="<?php esc_attr_e( 'Vues du calendrier', 'waicam' ); ?>">
					<a class="is-active" href="#events-calendar"><?php esc_html_e( 'Liste', 'waicam' ); ?></a>
					<a href="<?php echo esc_url( add_query_arg( 'eventDisplay', 'month', $calendar_base ) ); ?>"><?php esc_html_e( 'Mois', 'waicam' ); ?></a>
					<a href="<?php echo esc_url( add_query_arg( 'eventDisplay', 'day', $calendar_base ) ); ?>"><?php esc_html_e( 'Jour', 'waicam' ); ?></a>
				</nav>
			</form>

			<div class="events-calendar-controls">
				<div class="events-calendar-controls__nav" aria-label="<?php esc_attr_e( 'Navigation calendrier', 'waicam' ); ?>">
					<a href="<?php echo esc_url( add_query_arg( 'eventDisplay', 'past', $calendar_base ) ); ?>" aria-label="<?php esc_attr_e( 'Évènements précédents', 'waicam' ); ?>">‹</a>
					<a href="<?php echo esc_url( $calendar_next_url ); ?>" aria-label="<?php esc_attr_e( 'Évènements suivants', 'waicam' ); ?>">›</a>
					<form class="events-calendar-date-filter" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
						<?php if ( $calendar_search ) : ?>
							<input type="hidden" name="event_search" value="<?php echo esc_attr( $calendar_search ); ?>" />
						<?php endif; ?>
						<label class="events-calendar-controls__today" for="events-calendar-date">
							<span><?php esc_html_e( 'Aujourd’hui', 'waicam' ); ?></span>
							<input id="events-calendar-date" type="date" name="event_date" value="<?php echo esc_attr( $calendar_date ); ?>" onchange="this.form.submit()" />
						</label>
					</form>
				</div>
				<strong><?php echo esc_html( $calendar_date ? wp_date( 'j F Y', strtotime( $calendar_date ) ) : __( 'À venir', 'waicam' ) ); ?></strong>
			</div>

			<div class="events-calendar-list" role="list">
				<?php if ( $calendar_events && $calendar_events->have_posts() ) : ?>
					<?php
					$current_month = '';
					while ( $calendar_events->have_posts() ) :
						$calendar_events->the_post();
						$event_id    = get_the_ID();
						$event_month = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $event_id, false, 'F Y' ) : get_the_date( 'F Y', $event_id );
						$event_day   = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $event_id, false, 'd' ) : get_the_date( 'd', $event_id );
						$event_dow   = function_exists( 'tribe_get_start_date' ) ? tribe_get_start_date( $event_id, false, 'D' ) : get_the_date( 'D', $event_id );
						$event_venue = waicam_event_venue( $event_id );
						$event_ical  = function_exists( 'tribe_get_single_ical_link' ) ? tribe_get_single_ical_link( $event_id ) : add_query_arg( 'ical', '1', get_permalink( $event_id ) );
						$event_gcal  = function_exists( 'tribe_get_gcal_link' ) ? tribe_get_gcal_link( $event_id ) : '';
						if ( $event_month !== $current_month ) :
							$current_month = $event_month;
							?>
							<div class="events-calendar-list__month"><span><?php echo esc_html( $current_month ); ?></span></div>
						<?php endif; ?>
						<article class="events-calendar-item" role="listitem">
							<div class="events-calendar-item__date" aria-label="<?php echo esc_attr( waicam_event_date( $event_id ) ); ?>">
								<span><?php echo esc_html( $event_dow ); ?></span>
								<strong><?php echo esc_html( $event_day ); ?></strong>
							</div>
							<div class="events-calendar-item__body">
								<p class="events-calendar-item__time"><?php echo esc_html( waicam_event_date( $event_id ) ); ?></p>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php if ( $event_venue ) : ?>
									<p class="events-calendar-item__venue"><?php echo esc_html( $event_venue ); ?></p>
								<?php endif; ?>
								<p><?php echo esc_html( waicam_event_excerpt( $event_id, 260 ) ); ?></p>
								<div class="events-calendar-item__actions">
									<a href="<?php echo esc_url( $event_ical ); ?>"><?php esc_html_e( 'Ajouter au calendrier', 'waicam' ); ?></a>
									<?php if ( $event_gcal ) : ?>
										<a href="<?php echo esc_url( $event_gcal ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Google Agenda', 'waicam' ); ?></a>
									<?php endif; ?>
								</div>
							</div>
							<?php if ( has_post_thumbnail( $event_id ) ) : ?>
								<a class="events-calendar-item__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
									<?php echo get_the_post_thumbnail( $event_id, 'large', array( 'loading' => 'lazy' ) ); ?>
								</a>
							<?php endif; ?>
						</article>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php else : ?>
					<div class="events-calendar-empty">
						<p><?php esc_html_e( 'Aucun évènement ne correspond à votre recherche pour le moment.', 'waicam' ); ?></p>
					</div>
				<?php endif; ?>
			</div>

			<div class="events-calendar-footer">
				<a class="events-calendar-footer__previous" href="<?php echo esc_url( 1 < $events_page ? $calendar_previous_url : add_query_arg( 'eventDisplay', 'past', $calendar_base ) ); ?>">‹ <?php esc_html_e( 'Évènements précédents', 'waicam' ); ?></a>
				<?php if ( $events_page < $calendar_total_pages || $calendar_total_pages <= 1 ) : ?>
					<a class="events-calendar-footer__next" href="<?php echo esc_url( $events_page < $calendar_total_pages ? $calendar_next_url : add_query_arg( 'eventDisplay', 'list', $calendar_base ) ); ?>">
						<span><?php esc_html_e( 'Évènements suivants', 'waicam' ); ?></span>
						<span class="arrow-plain">→</span>
						<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
							<path d="M1 8 C11 1 21 1 31 8 S51 15 61 8 S81 1 95 8" />
						</svg>
					</a>
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
