<?php
/**
 * Template Name: WAI-CAM — Contact
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Contactez-nous', 'waicam' ),
	'subtitle' => __( "Contactez-nous pour vos questions sur les programmes, les partenariats, la presse ou le bénévolat.", 'waicam' ),
	'crumb'    => __( 'Contact', 'waicam' ),
) );
?>

<section class="contact-bg">
	<div class="contact-grid" style="max-width:1100px;margin:0 auto;">

		<!-- Infos de contact -->
		<div class="contact-info">
			<div class="section-tag" style="text-align:left;"><?php esc_html_e( 'Coordonnées', 'waicam' ); ?></div>
			<h2 class="section-title" style="text-align:left;margin-bottom:16px;"><?php esc_html_e( 'Parlons-nous', 'waicam' ); ?></h2>
			<p><?php esc_html_e( 'Pour toute demande de partenariat, presse, formation ou soutien terrain, notre équipe répond avec réactivité et professionnalisme.', 'waicam' ); ?></p>

			<div class="contact-items">
				<div class="contact-item">
					<div class="ci-icon"><i class="fa-solid fa-location-dot"></i></div>
					<div>
						<div class="ci-label"><?php esc_html_e( 'Adresse', 'waicam' ); ?></div>
						<div class="ci-val"><?php echo esc_html( get_theme_mod( 'waicam_address', '919 Boulevard de Rey-Bouba, Mballa2, Yaoundé, Cameroun' ) ); ?></div>
					</div>
				</div>
				<div class="contact-item">
					<div class="ci-icon"><i class="fa-solid fa-phone"></i></div>
					<div>
						<div class="ci-label"><?php esc_html_e( 'Téléphone', 'waicam' ); ?></div>
						<div class="ci-val"><?php echo esc_html( get_theme_mod( 'waicam_phone_display', '(+237) 222 20 58 53 / 682 573 699 / 698 164 869' ) ); ?></div>
					</div>
				</div>
				<div class="contact-item">
					<div class="ci-icon"><i class="fa-solid fa-envelope"></i></div>
					<div>
						<div class="ci-label"><?php esc_html_e( 'Email', 'waicam' ); ?></div>
						<div class="ci-val">
							<?php $email = get_theme_mod( 'waicam_email', 'womeninaicameroon@gmail.com' ); ?>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</div>
					</div>
				</div>
				<div class="contact-item">
					<div class="ci-icon"><i class="fa-regular fa-clock"></i></div>
					<div>
						<div class="ci-label"><?php esc_html_e( 'Disponibilité', 'waicam' ); ?></div>
						<div class="ci-val"><?php echo esc_html( get_theme_mod( 'waicam_hours', __( 'Lundi – Vendredi : 8h00 – 18h00', 'waicam' ) ) ); ?></div>
					</div>
				</div>
			</div>

			<div class="contact-social-block">
				<h4><?php esc_html_e( 'Suivez-nous', 'waicam' ); ?></h4>
				<div class="contact-social-list">
					<?php
					$socials = array(
						array( get_theme_mod( 'waicam_social_facebook',  '#' ), 'f',   'Facebook'  ),
						array( get_theme_mod( 'waicam_social_twitter',   '#' ), '𝕏',   'Twitter/X' ),
						array( get_theme_mod( 'waicam_social_linkedin',  '#' ), 'in',  'LinkedIn'  ),
						array( get_theme_mod( 'waicam_social_instagram', '#' ), '<i class="fa-brands fa-instagram"></i>',  'Instagram' ),
					);
					foreach ( $socials as $s ) :
					?>
						<a href="<?php echo esc_url( $s[0] ); ?>" class="contact-social-link">
							<span><?php echo esc_html( $s[1] ); ?></span> <?php echo esc_html( $s[2] ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<!-- Formulaire de contact -->
		<div class="form-card">
			<h3><?php esc_html_e( 'Envoyez-nous un message', 'waicam' ); ?></h3>
			<?php
			$ff_id = get_theme_mod( 'waicam_form_contact', '' );
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				?>
				<form data-form="contact">
					<div class="form-fields">
						<div class="form-row">
							<div class="form-group">
								<label><?php esc_html_e( 'Prénom', 'waicam' ); ?> <span>*</span></label>
								<input type="text" class="form-control" required />
							</div>
							<div class="form-group">
								<label><?php esc_html_e( 'Nom', 'waicam' ); ?> <span>*</span></label>
								<input type="text" class="form-control" required />
							</div>
						</div>
						<div class="form-group">
							<label><?php esc_html_e( 'Email', 'waicam' ); ?> <span>*</span></label>
							<input type="email" class="form-control" required />
						</div>
						<div class="form-group">
							<label><?php esc_html_e( 'Téléphone', 'waicam' ); ?></label>
							<input type="tel" class="form-control" />
						</div>
						<div class="form-group">
							<label><?php esc_html_e( 'Sujet', 'waicam' ); ?> <span>*</span></label>
							<select class="form-control" required>
								<option value="">-- <?php esc_html_e( 'Sélectionner un sujet', 'waicam' ); ?> --</option>
								<option><?php esc_html_e( 'Informations générales', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Inscription à un programme', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Demande de partenariat', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Presse & Médias', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Bénévolat', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Don / Financement', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Autre', 'waicam' ); ?></option>
							</select>
						</div>
						<div class="form-group">
							<label><?php esc_html_e( 'Message', 'waicam' ); ?> <span>*</span></label>
							<textarea class="form-control" rows="5" required></textarea>
						</div>
						<div class="form-check">
							<input type="checkbox" id="consent-contact" required />
							<label for="consent-contact"><?php esc_html_e( "J'accepte que mes données soient utilisées pour répondre à ma demande conformément à la politique de confidentialité de WAI-CAM.", 'waicam' ); ?></label>
						</div>
						<button type="submit" class="btn-submit"><i class="fa-solid fa-envelope"></i> <?php esc_html_e( 'Envoyer le message', 'waicam' ); ?></button>
					</div>
					<div class="form-success">
						<div class="success-icon"><i class="fa-solid fa-circle-check" style="color:var(--green)"></i></div>
						<h4><?php esc_html_e( 'Message envoyé !', 'waicam' ); ?></h4>
						<p><?php esc_html_e( "Merci pour votre message. Notre équipe vous répondra dans les 24 à 48 heures.", 'waicam' ); ?></p>
					</div>
				</form>
				<?php
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
