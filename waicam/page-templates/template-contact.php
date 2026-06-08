<?php
/**
 * Template Name: WAI-CAM — Contact
 *
 * @package WAICAM
 */

get_header();

$email         = get_theme_mod( 'waicam_email', 'womeninaicameroon@gmail.com' );
$phone_display = get_theme_mod( 'waicam_phone_display', '(+237) 222 20 58 53 / 682 573 699 / 698 164 869' );
$phone_link    = preg_replace( '/[^0-9+]/', '', get_theme_mod( 'waicam_phone', '+237682573699' ) );
$address       = get_theme_mod( 'waicam_address', '919 Boulevard de Rey-Bouba, Mballa2, Yaoundé, Cameroun' );
$hours         = get_theme_mod( 'waicam_hours', __( 'Lundi – Vendredi : 8h00 – 18h00', 'waicam' ) );
$ff_id         = get_theme_mod( 'waicam_form_contact', '' );
?>

<main id="primary" class="waicam-contact-page">
	<section class="waicam-contact-hero" aria-labelledby="waicam-contact-title">
		<div class="waicam-contact-hero__inner">
			<div class="waicam-contact-hero__copy">
				<span class="waicam-contact-kicker"><?php esc_html_e( 'Contact WAI-CAM', 'waicam' ); ?></span>
				<h1 id="waicam-contact-title"><?php esc_html_e( 'Parlons de votre projet IA, partenariat ou engagement', 'waicam' ); ?></h1>
				<svg class="waicam-contact-wave" viewBox="0 0 360 20" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 10 C12 1 24 1 36 10 S60 19 72 10 S96 1 108 10 S132 19 144 10 S168 1 180 10 S204 19 216 10 S240 1 252 10 S276 19 288 10 S324 1 360 10" />
				</svg>
				<p><?php esc_html_e( "Une question, une idée, une demande de partenariat ou l'envie de rejoindre le mouvement ? Notre équipe est à votre écoute pour construire une IA plus inclusive au Cameroun.", 'waicam' ); ?></p>
			</div>
			<div class="waicam-contact-hero__panel" aria-label="<?php esc_attr_e( 'Réponse WAI-CAM', 'waicam' ); ?>">
				<strong><?php esc_html_e( 'Réponse sous 24–48h', 'waicam' ); ?></strong>
				<span><?php esc_html_e( 'Programmes · Formations · Partenariats · Presse · Bénévolat', 'waicam' ); ?></span>
			</div>
		</div>
	</section>

	<section class="waicam-contact-main" aria-label="<?php esc_attr_e( 'Coordonnées et formulaire', 'waicam' ); ?>">
		<div class="waicam-contact-main__inner">
			<aside class="waicam-contact-info">
				<div class="waicam-contact-section-label"><?php esc_html_e( 'Coordonnées', 'waicam' ); ?></div>
				<h2><?php esc_html_e( 'Restons connectés', 'waicam' ); ?></h2>
				<p><?php esc_html_e( "Contactez-nous pour toute question concernant nos programmes, formations, évènements, partenariats ou pour rejoindre le mouvement WAI-CAM.", 'waicam' ); ?></p>

				<div class="waicam-contact-cards">
					<article class="waicam-contact-card">
						<div class="waicam-contact-card__icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></div>
						<div>
							<span><?php esc_html_e( 'Adresse', 'waicam' ); ?></span>
							<strong><?php echo esc_html( $address ); ?></strong>
						</div>
					</article>
					<article class="waicam-contact-card">
						<div class="waicam-contact-card__icon"><i class="fa-solid fa-phone" aria-hidden="true"></i></div>
						<div>
							<span><?php esc_html_e( 'Téléphone', 'waicam' ); ?></span>
							<strong><a href="tel:<?php echo esc_attr( $phone_link ); ?>"><?php echo esc_html( $phone_display ); ?></a></strong>
						</div>
					</article>
					<article class="waicam-contact-card">
						<div class="waicam-contact-card__icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></div>
						<div>
							<span><?php esc_html_e( 'Email', 'waicam' ); ?></span>
							<strong><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></strong>
						</div>
					</article>
					<article class="waicam-contact-card">
						<div class="waicam-contact-card__icon"><i class="fa-regular fa-clock" aria-hidden="true"></i></div>
						<div>
							<span><?php esc_html_e( 'Disponibilité', 'waicam' ); ?></span>
							<strong><?php echo esc_html( $hours ); ?></strong>
						</div>
					</article>
				</div>

				<div class="waicam-contact-social">
					<h3><?php esc_html_e( 'Suivez-nous', 'waicam' ); ?></h3>
					<div class="waicam-contact-social__links">
						<?php
						$socials = array(
							array( get_theme_mod( 'waicam_social_facebook', '#' ), 'Facebook' ),
							array( get_theme_mod( 'waicam_social_twitter', '#' ), 'Twitter/X' ),
							array( get_theme_mod( 'waicam_social_linkedin', '#' ), 'LinkedIn' ),
							array( get_theme_mod( 'waicam_social_instagram', '#' ), 'Instagram' ),
						);
						foreach ( $socials as $social ) :
							if ( empty( $social[0] ) || '#' === $social[0] ) {
								continue;
							}
							?>
							<a href="<?php echo esc_url( $social[0] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $social[1] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</aside>

			<section class="waicam-contact-form-card" aria-labelledby="waicam-contact-form-title">
				<div class="waicam-contact-form-card__header">
					<span><?php esc_html_e( 'Écrivez-nous', 'waicam' ); ?></span>
					<h2 id="waicam-contact-form-title"><?php esc_html_e( 'Envoyez-nous un message', 'waicam' ); ?></h2>
					<p><?php esc_html_e( 'Précisez votre besoin et nous vous orienterons vers la bonne personne dans l’équipe.', 'waicam' ); ?></p>
				</div>
				<?php if ( $ff_id ) : ?>
					<div class="waicam-contact-form-embed">
						<?php echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' ); ?>
					</div>
				<?php else : ?>
					<form class="waicam-contact-fallback-form" data-form="contact">
						<div class="form-row">
							<label><?php esc_html_e( 'Prénom', 'waicam' ); ?> <span>*</span><input type="text" required /></label>
							<label><?php esc_html_e( 'Nom', 'waicam' ); ?> <span>*</span><input type="text" required /></label>
						</div>
						<label><?php esc_html_e( 'Email', 'waicam' ); ?> <span>*</span><input type="email" required /></label>
						<label><?php esc_html_e( 'Téléphone', 'waicam' ); ?><input type="tel" /></label>
						<label><?php esc_html_e( 'Sujet', 'waicam' ); ?> <span>*</span>
							<select required>
								<option value=""><?php esc_html_e( 'Sélectionner un sujet', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Informations générales', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Inscription à un programme', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Demande de partenariat', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Presse & Médias', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Bénévolat', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Don / Financement', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Autre', 'waicam' ); ?></option>
							</select>
						</label>
						<label><?php esc_html_e( 'Message', 'waicam' ); ?> <span>*</span><textarea rows="5" required></textarea></label>
						<label class="waicam-contact-consent"><input type="checkbox" required /> <?php esc_html_e( "J'accepte que mes données soient utilisées pour répondre à ma demande conformément à la politique de confidentialité de WAI-CAM.", 'waicam' ); ?></label>
						<button type="submit"><?php esc_html_e( 'Envoyer le message', 'waicam' ); ?> <span aria-hidden="true">→</span></button>
					</form>
				<?php endif; ?>
			</section>
		</div>
	</section>
</main>

<?php
get_footer();
