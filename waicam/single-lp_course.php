<?php
/**
 * Single LearnPress course.
 *
 * @package WAICAM
 */

get_header();

while ( have_posts() ) :
	the_post();
	$course_id      = get_the_ID();
	$price_html     = waicam_course_price_html( $course_id );
	$duration       = waicam_course_duration( $course_id );
	$level          = waicam_course_level( $course_id );
	$students       = waicam_course_students_count( $course_id );
	$instructor     = waicam_course_instructor_name( $course_id );
	$category_label = waicam_course_category_label( $course_id );
	?>
	<main id="primary" class="waicam-course-single">
		<section class="waicam-course-single__hero" aria-labelledby="waicam-course-title">
			<div class="waicam-course-single__copy">
				<p class="waicam-courses-kicker"><?php echo esc_html( $category_label ? $category_label : __( 'Formation WAI-CAM', 'waicam' ) ); ?></p>
				<h1 id="waicam-course-title"><?php the_title(); ?></h1>
				<p><?php echo esc_html( waicam_course_excerpt( $course_id, 32 ) ); ?></p>
				<div class="waicam-course-single__actions">
					<a class="waicam-course-single__primary" href="#waicam-course-enroll"><?php esc_html_e( 'S’inscrire à la formation', 'waicam' ); ?></a>
					<a class="waicam-course-single__secondary" href="#waicam-course-program"><?php esc_html_e( 'Voir le programme', 'waicam' ); ?></a>
				</div>
			</div>

			<aside class="waicam-course-single__summary" aria-label="<?php esc_attr_e( 'Résumé de la formation', 'waicam' ); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="waicam-course-single__image"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div class="waicam-course-single__price"><?php echo wp_kses_post( $price_html ); ?></div>
				<ul class="waicam-course-single__meta">
					<?php if ( $duration ) : ?><li><span><?php esc_html_e( 'Durée', 'waicam' ); ?></span><strong><?php echo esc_html( $duration ); ?></strong></li><?php endif; ?>
					<?php if ( $level ) : ?><li><span><?php esc_html_e( 'Niveau', 'waicam' ); ?></span><strong><?php echo esc_html( $level ); ?></strong></li><?php endif; ?>
					<?php if ( $instructor ) : ?><li><span><?php esc_html_e( 'Formateur', 'waicam' ); ?></span><strong><?php echo esc_html( $instructor ); ?></strong></li><?php endif; ?>
					<?php if ( '' !== $students ) : ?><li><span><?php esc_html_e( 'Participants', 'waicam' ); ?></span><strong><?php echo esc_html( $students ); ?></strong></li><?php endif; ?>
				</ul>
				<div id="waicam-course-enroll" class="waicam-course-single__enroll">
					<?php waicam_course_buttons( $course_id ); ?>
				</div>
			</aside>
		</section>

		<section id="waicam-course-program" class="waicam-course-single__content" aria-label="<?php esc_attr_e( 'Programme de la formation', 'waicam' ); ?>">
			<div class="waicam-course-single__main">
				<h2><?php esc_html_e( 'À propos de cette formation', 'waicam' ); ?></h2>
				<div class="waicam-course-single__entry">
					<?php the_content(); ?>
				</div>
			</div>

			<aside class="waicam-course-single__learnpress">
				<h2><?php esc_html_e( 'Contenu LearnPress', 'waicam' ); ?></h2>
				<?php waicam_course_learnpress_summary( $course_id ); ?>
			</aside>
		</section>
	</main>
	<?php
endwhile;

get_footer();
