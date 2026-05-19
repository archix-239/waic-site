<?php
/**
 * Template par défaut pour les pages WordPress.
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => get_the_title(),
	'subtitle' => get_the_excerpt(),
) );
?>

<section>
	<div style="max-width:900px;margin:0 auto;" class="page-content">
		<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
	</div>
</section>

<?php get_footer();
