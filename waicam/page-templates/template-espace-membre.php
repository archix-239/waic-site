<?php
/**
 * Template Name: WAI-CAM — Espace membre
 *
 * Espace membre connecté à MemberPress. La page affiche le formulaire
 * compte MemberPress quand l'extension est active, avec un fallback clair
 * pour les administrateurs pendant la configuration.
 *
 * @package WAICAM
 */

get_header();

$memberpress_active = shortcode_exists( 'mepr-account-form' ) || shortcode_exists( 'mepr-login-form' ) || class_exists( 'MeprAppCtrl' );
?>

<main id="primary" class="memberpress-portal-page">
	<section class="memberpress-portal-hero" aria-labelledby="memberpress-portal-title">
		<div class="memberpress-portal-hero__inner">
			<p class="memberpress-portal-hero__kicker"><?php esc_html_e( 'Espace membre', 'waicam' ); ?></p>
			<h1 id="memberpress-portal-title"><?php esc_html_e( 'Votre espace WAI-CAM', 'waicam' ); ?></h1>
			<p><?php esc_html_e( 'Retrouvez vos informations de membre, vos inscriptions, vos accès réservés et les ressources partagées par Women in AI Cameroon.', 'waicam' ); ?></p>
		</div>
	</section>

	<section class="memberpress-portal-panel" aria-label="<?php esc_attr_e( 'Accès membre', 'waicam' ); ?>">
		<div class="memberpress-portal-panel__intro">
			<div>
				<span><?php esc_html_e( 'MemberPress', 'waicam' ); ?></span>
				<h2><?php esc_html_e( 'Connexion et gestion du compte', 'waicam' ); ?></h2>
			</div>
			<p><?php esc_html_e( 'Cette zone est reliée à MemberPress. Les membres peuvent se connecter, consulter leur compte et gérer leur adhésion selon les règles configurées dans WordPress.', 'waicam' ); ?></p>
		</div>

		<div class="memberpress-portal-grid">
			<aside class="memberpress-portal-help" aria-label="<?php esc_attr_e( 'Informations espace membre', 'waicam' ); ?>">
				<h3><?php esc_html_e( 'Ce que vous pouvez faire ici', 'waicam' ); ?></h3>
				<ul>
					<li><?php esc_html_e( 'Accéder à votre compte membre.', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Suivre votre adhésion et vos informations.', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Retrouver les contenus réservés aux membres.', 'waicam' ); ?></li>
				</ul>
				<a class="memberpress-portal-help__link" href="<?php echo esc_url( home_url( '/rejoindre/' ) ); ?>">
					<?php esc_html_e( 'Devenir membre', 'waicam' ); ?> <span aria-hidden="true">→</span>
				</a>
			</aside>

			<div class="memberpress-portal-account">
				<?php if ( $memberpress_active && shortcode_exists( 'mepr-account-form' ) ) : ?>
					<?php echo do_shortcode( '[mepr-account-form]' ); ?>
				<?php elseif ( $memberpress_active && shortcode_exists( 'mepr-login-form' ) ) : ?>
					<?php echo do_shortcode( '[mepr-login-form]' ); ?>
				<?php else : ?>
					<div class="memberpress-portal-empty">
						<h3><?php esc_html_e( 'MemberPress n’est pas encore configuré', 'waicam' ); ?></h3>
						<p><?php esc_html_e( 'Installez et activez MemberPress, puis assignez cette page comme page Account dans MemberPress → Settings → Pages.', 'waicam' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
