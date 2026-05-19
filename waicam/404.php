<?php
/**
 * Template 404
 *
 * @package WAICAM
 */

get_header(); ?>

<section class="error-404" style="text-align:center;padding:80px 5%;">
	<div style="max-width:600px;margin:0 auto;">
		<div style="font-size:6rem;margin-bottom:24px;"><i class="fa-solid fa-robot"></i></div>
		<h1 style="font-size:clamp(2rem,5vw,3rem);margin-bottom:16px;"><?php esc_html_e( '404 — Page introuvable', 'waicam' ); ?></h1>
		<p style="color:var(--gray);margin-bottom:32px;"><?php esc_html_e( "La page que vous recherchez n'existe pas ou a été déplacée. Pas de panique, vous pouvez revenir à l'accueil ou explorer nos programmes.", 'waicam' ); ?></p>
		<div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary"><i class="fa-solid fa-house"></i> <?php esc_html_e( "Retour à l'accueil", 'waicam' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/programmes' ) ); ?>" class="btn-outline"><?php esc_html_e( 'Voir les programmes', 'waicam' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
