<?php
/**
 * Single — Article de blog WAI-CAM
 *
 * @package WAICAM
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post();
	$categories = get_the_category();
	$primary_cat = ! empty( $categories ) ? $categories[0] : null;
?>

	<?php
	get_template_part( 'template-parts/page-hero', null, array(
		'title'    => get_the_title(),
		'subtitle' => sprintf(
			/* translators: 1: date, 2: auteur */
			esc_html__( 'Publié le %1$s par %2$s', 'waicam' ),
			esc_html( waicam_date_fr() ),
			esc_html( get_the_author() )
		),
		'crumb'    => __( 'Blog', 'waicam' ),
	) );
	?>

	<article class="single-actu single-post">
		<div style="max-width:860px;margin:0 auto;">

			<!-- Métas article -->
			<div class="single-meta">
				<span class="actu-tag actu-tag--date"><i class="fa-regular fa-calendar"></i> <?php echo esc_html( waicam_date_fr() ); ?></span>
				<span class="actu-tag actu-tag--auteur"><i class="fa-regular fa-user"></i> <?php echo esc_html( get_the_author() ); ?></span>
				<?php if ( $categories ) : ?>
					<?php foreach ( $categories as $cat ) : ?>
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="actu-tag actu-tag--cat">
							<i class="fa-regular fa-folder"></i> <?php echo esc_html( $cat->name ); ?>
						</a>
					<?php endforeach; ?>
				<?php endif; ?>
				<span class="actu-tag actu-tag--reading"><i class="fa-regular fa-clock"></i>
					<?php
					$word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
					$min        = max( 1, ceil( $word_count / 200 ) );
					/* translators: %d minutes de lecture */
					printf( esc_html__( '%d min de lecture', 'waicam' ), (int) $min );
					?>
				</span>
			</div>

			<!-- Contenu de l'article (style magazine — l'image mise en avant ne sert
			     que pour la vignette de la liste blog, jamais répétée ici) -->
			<div class="single-content post-content post-content--magazine">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="post-pages">' . esc_html__( 'Pages :', 'waicam' ),
					'after'  => '</div>',
				) );
				?>
			</div>

			<!-- Tags -->
			<?php $tags = get_the_tags(); if ( $tags ) : ?>
				<div class="single-tags">
					<strong><?php esc_html_e( 'Mots-clés :', 'waicam' ); ?></strong>
					<?php foreach ( $tags as $tag ) : ?>
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="actu-tag actu-tag--tag">#<?php echo esc_html( $tag->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<!-- Partage social -->
			<div class="single-share">
				<strong><?php esc_html_e( 'Partager :', 'waicam' ); ?></strong>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( urlencode( get_permalink() ) ); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
				<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( urlencode( get_permalink() ) ); ?>&text=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>" target="_blank" rel="noopener" aria-label="Twitter / X"><i class="fa-brands fa-x-twitter"></i></a>
				<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( urlencode( get_permalink() ) ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
				<a href="mailto:?subject=<?php echo esc_attr( urlencode( get_the_title() ) ); ?>&body=<?php echo esc_attr( urlencode( get_permalink() ) ); ?>" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
			</div>

			<!-- Navigation prev / next -->
			<nav class="single-nav">
				<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				?>
				<?php if ( $prev_post ) : ?>
					<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="single-nav-prev">
						<span><?php esc_html_e( '← Article précédent', 'waicam' ); ?></span>
						<strong><?php echo esc_html( get_the_title( $prev_post ) ); ?></strong>
					</a>
				<?php endif; ?>
				<?php if ( $next_post ) : ?>
					<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="single-nav-next">
						<span><?php esc_html_e( 'Article suivant →', 'waicam' ); ?></span>
						<strong><?php echo esc_html( get_the_title( $next_post ) ); ?></strong>
					</a>
				<?php endif; ?>
			</nav>

			<!-- Articles liés (même catégorie) -->
			<?php if ( $primary_cat ) :
				$related = new WP_Query( array(
					'posts_per_page' => 3,
					'category__in'   => array( $primary_cat->term_id ),
					'post__not_in'   => array( get_the_ID() ),
					'orderby'        => 'rand',
				) );
			if ( $related->have_posts() ) : ?>
				<section class="single-related">
					<h3><?php esc_html_e( 'Articles liés', 'waicam' ); ?></h3>
					<div class="news-grid">
						<?php while ( $related->have_posts() ) : $related->the_post(); ?>
							<div class="news-card">
								<a href="<?php the_permalink(); ?>"><?php waicam_thumbnail( get_the_ID(), 'medium_large', 'training-1.jpg' ); ?></a>
								<div class="news-card-body">
									<div class="news-date"><?php echo esc_html( waicam_date_fr() ); ?></div>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p><?php echo esc_html( waicam_excerpt( get_the_excerpt(), 120 ) ); ?></p>
									<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Lire la suite →', 'waicam' ); ?></a>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					</div>
				</section>
			<?php endif; endif; ?>

			<!-- Commentaires -->
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="single-comments">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>

			<!-- Retour blog -->
			<div class="single-back">
				<?php $blog_url = get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ); ?>
				<a href="<?php echo esc_url( $blog_url ); ?>" class="btn-outline">
					← <?php esc_html_e( 'Tous les articles', 'waicam' ); ?>
				</a>
			</div>
		</div>
	</article>

<?php endwhile; ?>

<?php get_footer();
