<?php
/**
 * Archive — Catégorie / Étiquette / Auteur / Date pour les articles de blog
 *
 * @package WAICAM
 */

get_header();

$archive_title = '';
$archive_desc  = '';
$archive_crumb = __( 'Blog', 'waicam' );

if ( is_category() ) {
	/* translators: %s = nom de la catégorie */
	$archive_title = sprintf( __( 'Catégorie : %s', 'waicam' ), single_cat_title( '', false ) );
	$archive_desc  = category_description();
	$archive_crumb = single_cat_title( '', false );
} elseif ( is_tag() ) {
	/* translators: %s = mot-clé */
	$archive_title = sprintf( __( 'Mot-clé : #%s', 'waicam' ), single_tag_title( '', false ) );
	$archive_desc  = tag_description();
	$archive_crumb = '#' . single_tag_title( '', false );
} elseif ( is_author() ) {
	/* translators: %s = nom auteur */
	$archive_title = sprintf( __( 'Articles par %s', 'waicam' ), get_the_author() );
	$archive_crumb = get_the_author();
} elseif ( is_year() ) {
	/* translators: %s = année */
	$archive_title = sprintf( __( 'Archives — %s', 'waicam' ), get_the_date( 'Y' ) );
	$archive_crumb = get_the_date( 'Y' );
} elseif ( is_month() ) {
	$archive_title = sprintf( __( 'Archives — %s', 'waicam' ), get_the_date( 'F Y' ) );
	$archive_crumb = get_the_date( 'F Y' );
} else {
	$archive_title = get_the_archive_title();
	$archive_desc  = get_the_archive_description();
}

get_template_part( 'template-parts/page-hero', null, array(
	'title'    => $archive_title,
	'subtitle' => wp_strip_all_tags( $archive_desc ),
	'crumb'    => $archive_crumb,
) );
?>

<section>
	<div style="max-width:1100px;margin:0 auto;">
		<?php if ( have_posts() ) : ?>

			<div class="news-grid">
				<?php while ( have_posts() ) : the_post();
					$cats = get_the_category();
				?>
					<div class="news-card">
						<a href="<?php the_permalink(); ?>"><?php waicam_thumbnail( get_the_ID(), 'medium_large', 'training-1.jpg' ); ?></a>
						<div class="news-card-body">
							<div class="news-date">
								<?php echo esc_html( waicam_date_fr() ); ?>
								<?php if ( $cats ) : ?>
									· <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>" style="color:var(--accent);"><?php echo esc_html( $cats[0]->name ); ?></a>
								<?php endif; ?>
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( waicam_excerpt( get_the_excerpt(), 160 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Lire la suite →', 'waicam' ); ?></a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div style="text-align:center;margin-top:48px;">
				<?php the_posts_pagination( array(
					'mid_size'  => 1,
					'prev_text' => __( '← Précédent', 'waicam' ),
					'next_text' => __( 'Suivant →', 'waicam' ),
				) ); ?>
			</div>

		<?php else : ?>
			<p style="text-align:center;color:var(--gray);padding:48px 0;">
				<?php esc_html_e( 'Aucun article ne correspond à cette recherche.', 'waicam' ); ?>
			</p>
			<div style="text-align:center;">
				<?php $blog_url = get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ); ?>
				<a href="<?php echo esc_url( $blog_url ); ?>" class="btn-outline">
					← <?php esc_html_e( 'Retour au blog', 'waicam' ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
