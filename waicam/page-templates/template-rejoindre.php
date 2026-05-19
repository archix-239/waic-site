<?php
/**
 * Template Name: WAI-CAM — Rejoindre
 *
 * @package WAICAM
 */

get_header(); ?>

<!-- HERO REJOINDRE -->
<div class="rejoindre-hero">
	<div class="rejoindre-hero-bg" style="background-image:url('<?php echo esc_url( waicam_img( 'hero-women.jpg' ) ); ?>');"></div>
	<div class="rejoindre-hero-content">
		<div class="breadcrumb breadcrumb--white">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'waicam' ); ?></a>
			<span>/</span>
			<span><?php esc_html_e( 'Rejoindre', 'waicam' ); ?></span>
		</div>
		<h1><?php esc_html_e( 'Rejoignez le mouvement WAI-CAM', 'waicam' ); ?></h1>
		<p><?php esc_html_e( "Devenez membre, ambassadrice ou bénévole et contribuez à démocratiser l'IA pour toutes les femmes camerounaises.", 'waicam' ); ?></p>
		<div class="rejoindre-hero-cta">
			<a href="#form-adhesion" class="btn-primary"><i class="fa-solid fa-wand-magic-sparkles"></i> <?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></a>
			<a href="#types" class="btn-outline btn-outline--white"><?php esc_html_e( 'Découvrir les types de membres', 'waicam' ); ?></a>
		</div>
	</div>
</div>

<!-- TYPES DE MEMBRES -->
<section id="types" style="background:var(--gray-light);">
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Membership', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( "Comment <span>s'impliquer ?</span>", 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( 'Plusieurs façons de rejoindre et contribuer au mouvement WAI-CAM selon votre profil et vos disponibilités.', 'waicam' ); ?></p>
		</div>
		<div class="member-types">
			<div class="member-type-card">
				<div class="mt-icon"><i class="fa-solid fa-user-tie"></i></div>
				<h3><?php esc_html_e( 'Membre Actif', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Participez aux formations, événements et activités du mouvement. Accédez à notre réseau et nos ressources.', 'waicam' ); ?></p>
				<div class="mt-tag mt-tag--violet"><?php esc_html_e( 'Gratuit', 'waicam' ); ?></div>
			</div>
			<div class="member-type-card member-type-card--featured">
				<div class="mt-badge"><?php esc_html_e( 'RECOMMANDÉ', 'waicam' ); ?></div>
				<div class="mt-icon"><i class="fa-solid fa-star"></i></div>
				<h3><?php esc_html_e( 'Ambassadrice Régionale', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Représentez WAI-CAM dans votre région, formez d'autres femmes et portez la vision du mouvement.", 'waicam' ); ?></p>
				<div class="mt-tag mt-tag--white"><?php esc_html_e( 'Formation incluse', 'waicam' ); ?></div>
			</div>
			<div class="member-type-card">
				<div class="mt-icon"><i class="fa-solid fa-handshake"></i></div>
				<h3><?php esc_html_e( 'Bénévole', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Apportez vos compétences (communication, tech, logistique) pour soutenir les activités de WAI-CAM.", 'waicam' ); ?></p>
				<div class="mt-tag mt-tag--green"><?php esc_html_e( 'Flexible', 'waicam' ); ?></div>
			</div>
			<div class="member-type-card">
				<div class="mt-icon"><i class="fa-solid fa-graduation-cap"></i></div>
				<h3><?php esc_html_e( 'Mentor / Expert', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Partagez votre expertise IA, numérique ou entrepreneuriale pour accompagner les membres du mouvement.", 'waicam' ); ?></p>
				<div class="mt-tag mt-tag--orange"><?php esc_html_e( 'Sur candidature', 'waicam' ); ?></div>
			</div>
		</div>
	</div>
</section>

<!-- FORMULAIRE D'ADHÉSION -->
<section id="form-adhesion">
	<div style="max-width:800px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Rejoindre <span>WAI-CAM</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire complet pour rejoindre le mouvement. Notre équipe vous contactera sous 48 heures.", 'waicam' ); ?></p>
		</div>

		<div class="form-card">
			<?php
			$ff_id = get_theme_mod( 'waicam_form_adhesion', '' );
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				// Fallback statique — à connecter via Contact Form 7 / WPForms
				?>
				<form data-form="adhesion">
					<div class="form-fields">

						<div class="form-section-tag"><i class="fa-solid fa-user"></i> <?php esc_html_e( 'Informations personnelles', 'waicam' ); ?></div>
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
						<div class="form-row">
							<div class="form-group">
								<label><?php esc_html_e( 'Date de naissance', 'waicam' ); ?></label>
								<input type="date" class="form-control" />
							</div>
							<div class="form-group">
								<label><?php esc_html_e( 'Genre', 'waicam' ); ?></label>
								<select class="form-control">
									<option value="">-- <?php esc_html_e( 'Sélectionner', 'waicam' ); ?> --</option>
									<option><?php esc_html_e( 'Femme', 'waicam' ); ?></option>
									<option><?php esc_html_e( 'Homme', 'waicam' ); ?></option>
									<option><?php esc_html_e( 'Préfère ne pas préciser', 'waicam' ); ?></option>
								</select>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group">
								<label><?php esc_html_e( 'Email', 'waicam' ); ?> <span>*</span></label>
								<input type="email" class="form-control" required />
							</div>
							<div class="form-group">
								<label><?php esc_html_e( 'Téléphone', 'waicam' ); ?> <span>*</span></label>
								<input type="tel" class="form-control" required />
							</div>
						</div>

						<div class="form-section-tag"><i class="fa-solid fa-location-dot"></i> <?php esc_html_e( 'Localisation', 'waicam' ); ?></div>
						<div class="form-row">
							<div class="form-group">
								<label><?php esc_html_e( 'Région', 'waicam' ); ?> <span>*</span></label>
								<select class="form-control" required>
									<option value="">-- <?php esc_html_e( 'Sélectionner', 'waicam' ); ?> --</option>
									<option>Centre</option><option>Littoral</option><option>Ouest</option>
									<option>Nord-Ouest</option><option>Sud-Ouest</option><option>Sud</option>
									<option>Est</option><option>Adamaoua</option><option>Nord</option>
									<option>Extrême-Nord</option><option>Diaspora / International</option>
								</select>
							</div>
							<div class="form-group">
								<label><?php esc_html_e( 'Ville', 'waicam' ); ?></label>
								<input type="text" class="form-control" />
							</div>
						</div>

						<div class="form-section-tag"><i class="fa-solid fa-briefcase"></i> <?php esc_html_e( 'Profil professionnel', 'waicam' ); ?></div>
						<div class="form-group">
							<label><?php esc_html_e( 'Profession / Statut', 'waicam' ); ?></label>
							<input type="text" class="form-control" />
						</div>
						<div class="form-group">
							<label><?php esc_html_e( "Type d'engagement souhaité", 'waicam' ); ?> <span>*</span></label>
							<select class="form-control" required>
								<option value="">-- <?php esc_html_e( 'Sélectionner', 'waicam' ); ?> --</option>
								<option><?php esc_html_e( 'Membre Actif', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Ambassadrice Régionale', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Bénévole', 'waicam' ); ?></option>
								<option><?php esc_html_e( 'Mentor / Expert', 'waicam' ); ?></option>
							</select>
						</div>
						<div class="form-group">
							<label><?php esc_html_e( 'Pourquoi rejoindre WAI-CAM ?', 'waicam' ); ?> <span>*</span></label>
							<textarea class="form-control" rows="4" required></textarea>
						</div>

						<div class="form-check">
							<input type="checkbox" id="consent-adhesion" required />
							<label for="consent-adhesion"><?php esc_html_e( "J'accepte la politique de confidentialité et les conditions d'adhésion de WAI-CAM.", 'waicam' ); ?></label>
						</div>

						<button type="submit" class="btn-submit"><i class="fa-solid fa-rocket"></i> <?php esc_html_e( 'Soumettre ma candidature', 'waicam' ); ?></button>
					</div>
					<div class="form-success">
						<div class="success-icon"><i class="fa-solid fa-circle-check" style="color:var(--green)"></i></div>
						<h4><?php esc_html_e( 'Bienvenue dans le mouvement !', 'waicam' ); ?></h4>
						<p><?php esc_html_e( "Merci pour votre candidature. Notre équipe vous contactera sous 48 heures.", 'waicam' ); ?></p>
					</div>
				</form>
				<?php
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
