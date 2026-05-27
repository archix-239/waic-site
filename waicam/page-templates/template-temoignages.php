<?php
/**
 * Template Name: WAI-CAM — Témoignages
 *
 * Affiche les 18 témoignages avec citation mise en avant.
 * (Les mêmes données que la page Équipe, mais l'emphase est sur la citation.)
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Témoignages', 'waicam' ),
	'subtitle' => __( "Les voix de celles et ceux qui font WAI-CAM au quotidien. Des parcours, des engagements, une vision commune.", 'waicam' ),
	'crumb'    => __( 'Témoignages', 'waicam' ),
) );
?>

<!-- INTRO -->
<section style="padding-bottom:0;">
	<div style="max-width:780px;margin:0 auto;text-align:center;">
		<p style="color:var(--gray);font-size:1.05rem;line-height:1.7;">
			<?php esc_html_e( "Découvrez les parcours, les engagements et les retours d'expérience des femmes et des leaders qui font vivre WAI-CAM.", 'waicam' ); ?>
		</p>
	</div>
</section>

<?php
$temoignages = waicam_get_temoignages( -1 );

if ( $temoignages ) :
?>
<section>
	<div style="max-width:1100px;margin:0 auto;">
		<div class="testimonials-grid">
			<?php while ( $temoignages->have_posts() ) : $temoignages->the_post();
				$nom      = waicam_field( 'nom_complet', get_the_ID(), get_the_title() );
				$role     = waicam_field( 'role__fonction' );
				$profil   = waicam_field( 'profil_professionnel' );
				$citation = waicam_field( 'citation' );
				$photo    = waicam_image_url( 'photo', get_the_ID(), 'medium', '' );
				$initiale = mb_strtoupper( mb_substr( $nom, 0, 1 ) );
			?>
				<div class="testimonial-card">
					<div class="testimonial-header">
						<?php if ( $photo ) : ?>
							<div class="testimonial-photo">
								<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" />
							</div>
						<?php else : ?>
							<div class="team-avatar testimonial-avatar"><?php echo esc_html( $initiale ); ?></div>
						<?php endif; ?>
						<div class="testimonial-author-info">
							<strong class="testimonial-author-name"><?php echo esc_html( $nom ); ?></strong>
							<?php if ( $role ) : ?>
								<span class="testimonial-author-role"><?php echo esc_html( $role ); ?></span>
							<?php endif; ?>
							<?php if ( $profil ) : ?>
								<span class="testimonial-author-profil"><?php echo esc_html( $profil ); ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="testimonial-quote"><i class="fa-solid fa-quote-left"></i></div>
					<p class="testimonial-text"><?php echo esc_html( $citation ); ?></p>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php else : ?>
<section>
	<div style="max-width:700px;margin:0 auto;text-align:center;color:var(--gray);">
		<p><?php esc_html_e( 'Les témoignages seront publiés très prochainement.', 'waicam' ); ?></p>
	</div>
</section>
<?php endif; ?>

<!-- CTA -->
<section style="background:var(--gray-light);">
	<div style="max-width:780px;margin:0 auto;text-align:center;">
		<div class="section-tag"><?php esc_html_e( 'Vous aussi', 'waicam' ); ?></div>
		<h2 class="section-title" style="margin-bottom:16px;"><?php echo wp_kses_post( __( 'Partagez votre <span>histoire</span>', 'waicam' ) ); ?></h2>
		<p style="color:var(--gray);margin-bottom:32px;">
			<?php esc_html_e( "Partagez votre histoire pour encourager d'autres femmes à prendre part à la transformation numérique et à l'IA responsable.", 'waicam' ); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-primary"><?php esc_html_e( 'Rejoindre WAI-CAM', 'waicam' ); ?></a>
	</div>
</section>

<?php get_footer();
