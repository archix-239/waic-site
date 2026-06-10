<?php
/**
 * Template Name: WAI-CAM — Formations
 *
 * Page catalogue des formations WAI-CAM alimentée par LearnPress.
 *
 * @package WAICAM
 */

get_header();

$search_term = isset( $_GET['recherche_formation'] ) ? sanitize_text_field( wp_unslash( $_GET['recherche_formation'] ) ) : '';
$course_cat  = isset( $_GET['categorie_formation'] ) ? sanitize_title( wp_unslash( $_GET['categorie_formation'] ) ) : '';
$paged       = max( 1, get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : absint( get_query_var( 'page' ) ) );
$has_lp      = post_type_exists( 'lp_course' );
$categories  = array();
$query       = null;

if ( $has_lp ) {
	$categories = get_terms( array(
		'taxonomy'   => 'course_category',
		'hide_empty' => true,
	) );

	$query_args = array(
		'post_type'           => 'lp_course',
		'post_status'         => 'publish',
		'posts_per_page'      => 9,
		'paged'               => $paged,
		'ignore_sticky_posts' => true,
		's'                   => $search_term,
	);

	if ( $course_cat ) {
		$query_args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			array(
				'taxonomy' => 'course_category',
				'field'    => 'slug',
				'terms'    => $course_cat,
			),
		);
	}

	$query = new WP_Query( $query_args );
}
?>

<main id="primary" class="waicam-courses-page waicam-courses-archive-page">
	<section class="waicam-courses-hero" aria-labelledby="waicam-courses-title">
		<div class="waicam-courses-hero__inner">
			<p class="waicam-courses-kicker"><?php esc_html_e( 'Formations WAI-CAM', 'waicam' ); ?></p>
			<h1 id="waicam-courses-title"><?php esc_html_e( 'Apprendre, pratiquer et progresser avec l’IA', 'waicam' ); ?></h1>
			<p><?php esc_html_e( 'Explorez les parcours LearnPress de Women in AI Cameroon : initiation, ateliers pratiques, masterclass et programmes pour renforcer les compétences numériques des femmes et des jeunes.', 'waicam' ); ?></p>
		</div>
	</section>

	<section class="waicam-courses-section" aria-labelledby="waicam-courses-list-title">
		<div class="waicam-courses-section__intro">
			<div>
				<p class="waicam-courses-eyebrow"><?php esc_html_e( 'Catalogue LearnPress', 'waicam' ); ?></p>
				<h2 id="waicam-courses-list-title"><?php esc_html_e( 'Choisissez votre prochaine formation', 'waicam' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Recherchez une formation, filtrez par catégorie, puis ouvrez la page détaillée pour consulter le programme et vous inscrire.', 'waicam' ); ?></p>
		</div>

		<?php if ( ! $has_lp ) : ?>
			<div class="waicam-courses-notice">
				<h2><?php esc_html_e( 'LearnPress doit être activé', 'waicam' ); ?></h2>
				<p><?php esc_html_e( 'Cette page affiche les formations créées dans LearnPress. Activez l’extension LearnPress pour publier le catalogue.', 'waicam' ); ?></p>
			</div>
		<?php else : ?>
			<form class="waicam-courses-search" method="get" action="<?php echo esc_url( get_permalink() ); ?>">
				<label class="waicam-courses-search__field">
					<span class="screen-reader-text"><?php esc_html_e( 'Rechercher une formation', 'waicam' ); ?></span>
					<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
					<input type="search" name="recherche_formation" value="<?php echo esc_attr( $search_term ); ?>" placeholder="<?php esc_attr_e( 'Rechercher une formation', 'waicam' ); ?>" />
				</label>

				<label class="waicam-courses-search__select">
					<span class="screen-reader-text"><?php esc_html_e( 'Catégorie de formation', 'waicam' ); ?></span>
					<select name="categorie_formation">
						<option value=""><?php esc_html_e( 'Toutes les catégories', 'waicam' ); ?></option>
						<?php if ( ! is_wp_error( $categories ) ) : ?>
							<?php foreach ( $categories as $category ) : ?>
								<option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $course_cat, $category->slug ); ?>><?php echo esc_html( $category->name ); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</label>

				<button type="submit"><?php esc_html_e( 'Chercher', 'waicam' ); ?></button>
			</form>

			<?php if ( $query && $query->have_posts() ) : ?>
				<div class="waicam-courses-grid">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						waicam_render_course_card( get_the_ID() );
					endwhile;
					?>
				</div>

				<?php
				$pagination = paginate_links( array(
					'total'     => (int) $query->max_num_pages,
					'current'   => $paged,
					'prev_text' => __( '← Formations précédentes', 'waicam' ),
					'next_text' => __( 'Formations suivantes →', 'waicam' ),
					'add_args'  => array_filter( array(
						'recherche_formation' => $search_term,
						'categorie_formation' => $course_cat,
					) ),
				) );
				?>
				<?php if ( $pagination ) : ?>
					<nav class="waicam-courses-pagination" aria-label="<?php esc_attr_e( 'Pagination des formations', 'waicam' ); ?>">
						<?php echo wp_kses_post( $pagination ); ?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<div class="waicam-courses-empty">
					<h2><?php esc_html_e( 'Aucune formation trouvée', 'waicam' ); ?></h2>
					<p><?php esc_html_e( 'Essayez un autre mot-clé ou retirez le filtre de catégorie.', 'waicam' ); ?></p>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
	</section>
</main>

<?php
get_footer();
