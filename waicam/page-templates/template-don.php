<?php
/**
 * Template Name: WAI-CAM — Faire un don
 *
 * Page dédiée au module de dons (powered by WooCommerce + WPC Name Your Price).
 * Le visiteur choisit un montant prédéfini OU saisit un montant libre,
 * puis le don est ajouté au panier et payé via WooCommerce (Dohone, etc.).
 *
 * @package WAICAM
 */

get_header();

// ID du produit WooCommerce "Don à WAI-CAM" (configurable via Customizer → WAI-CAM → Formulaires)
$donation_product_id = (int) get_theme_mod( 'waicam_donation_product_id', 0 );

// URL de base pour ajouter au panier avec un montant personnalisé (Name Your Price)
$add_to_cart_url = function( $amount ) use ( $donation_product_id ) {
	if ( ! $donation_product_id ) return '#';
	return esc_url( add_query_arg( array(
		'add-to-cart' => $donation_product_id,
		'nyp'         => $amount,
	), home_url( '/' ) ) );
};
?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Soutenez le mouvement', 'waicam' ),
	'subtitle' => __( "Votre don finance directement la formation, l'accompagnement et l'autonomisation des femmes camerounaises dans le numérique. Chaque contribution, même modeste, change une vie.", 'waicam' ),
	'crumb'    => __( 'Faire un don', 'waicam' ),
) );
?>

<!-- ============================================
     FORMULAIRE DE DON (4 tuiles + montant libre)
     ============================================ -->
<section class="don-form-section">
	<div class="don-form-wrapper">
		<div class="don-form-intro">
			<div class="section-tag"><?php esc_html_e( 'Faire un don', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Choisissez le montant de <span>votre soutien</span>', 'waicam' ) ); ?></h2>
			<p><?php esc_html_e( "Don ponctuel, sécurisé. Vous serez redirigé·e vers une page de paiement sécurisée. Mobile Money, carte bancaire et virement acceptés.", 'waicam' ); ?></p>

			<ul class="don-form-features">
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( 'Paiement sécurisé', 'waicam' ); ?></li>
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( "Reçu envoyé par email", 'waicam' ); ?></li>
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( "Mobile Money & carte bancaire", 'waicam' ); ?></li>
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( "100 % alloué à l'action terrain", 'waicam' ); ?></li>
			</ul>
		</div>

		<div class="don-form-card">
			<?php if ( ! $donation_product_id || ! function_exists( 'wc_get_product' ) || ! wc_get_product( $donation_product_id ) ) : ?>

				<!-- Avertissement admin si produit non configuré -->
				<?php if ( current_user_can( 'manage_options' ) ) : ?>
					<div class="don-empty don-empty--admin">
						<p><strong><?php esc_html_e( 'Module de don non configuré.', 'waicam' ); ?></strong></p>
						<p>
							<?php
							printf(
								/* translators: 1: lien produits, 2: lien customizer */
								wp_kses_post( __( '1. <a href="%1$s">Créer un produit WooCommerce « Don à WAI-CAM »</a> avec WPC Name Your Price activé. 2. Saisir son ID dans <a href="%2$s">Apparence → Personnaliser → WAI-CAM → Formulaires → Produit Don</a>.', 'waicam' ) ),
								esc_url( admin_url( 'edit.php?post_type=product' ) ),
								esc_url( admin_url( 'customize.php' ) )
							);
							?>
						</p>
					</div>
				<?php else : ?>
					<p style="text-align:center;color:var(--gray);padding:32px;"><?php esc_html_e( 'Le module de don est temporairement indisponible. Merci de revenir plus tard.', 'waicam' ); ?></p>
				<?php endif; ?>

			<?php else :
				// Configuration des paliers d'impact (montant => libellé)
				$tiers = array(
					5000   => array( 'icon' => 'fa-graduation-cap', 'label' => __( '1 femme formée', 'waicam' ),       'desc' => __( "Atelier d'initiation à l'IA", 'waicam' ) ),
					15000  => array( 'icon' => 'fa-users',          'label' => __( '3 femmes formées', 'waicam' ),     'desc' => __( "Programme complet WAI-CAM", 'waicam' ),  'featured' => true ),
					50000  => array( 'icon' => 'fa-rocket',         'label' => __( '10 femmes équipées', 'waicam' ),   'desc' => __( "Supports + accompagnement", 'waicam' ) ),
					100000 => array( 'icon' => 'fa-crown',          'label' => __( '1 session complète', 'waicam' ),   'desc' => __( "Atelier régional 25 personnes", 'waicam' ) ),
				);
			?>
				<?php
				// On poste directement vers le panier — WooCommerce intercepte la requête,
				// ajoute le produit avec le montant Name Your Price et affiche le panier.
				$form_action = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/panier/' );
				?>
				<form id="don-form" method="GET" action="<?php echo esc_url( $form_action ); ?>" class="don-form">
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $donation_product_id ); ?>" />

					<!-- Tuiles d'impact (cliquables) -->
					<div class="don-tiers">
						<?php foreach ( $tiers as $amount => $tier ) :
							$featured = ! empty( $tier['featured'] );
							$is_default = $featured;
						?>
							<label class="don-tier<?php echo $featured ? ' don-tier--featured' : ''; ?>">
								<input type="radio" name="nyp_preset" value="<?php echo esc_attr( $amount ); ?>" data-amount="<?php echo esc_attr( $amount ); ?>" <?php checked( $is_default ); ?> />
								<div class="don-tier-amount"><?php echo esc_html( number_format_i18n( $amount ) ); ?> <span>FCFA</span></div>
								<div class="don-tier-icon"><i class="fa-solid <?php echo esc_attr( $tier['icon'] ); ?>"></i></div>
								<div class="don-tier-label"><?php echo esc_html( $tier['label'] ); ?></div>
								<div class="don-tier-desc"><?php echo esc_html( $tier['desc'] ); ?></div>
								<?php if ( $featured ) : ?>
									<div class="don-tier-badge"><?php esc_html_e( 'RECOMMANDÉ', 'waicam' ); ?></div>
								<?php endif; ?>
							</label>
						<?php endforeach; ?>
					</div>

					<!-- Montant libre -->
					<div class="don-custom">
						<label for="don-amount-input"><?php esc_html_e( 'Ou saisissez un autre montant', 'waicam' ); ?></label>
						<div class="don-custom-input">
							<input type="number" id="don-amount-input" name="nyp" value="15000" min="500" step="100" required />
							<span class="don-currency">FCFA</span>
						</div>
					</div>

					<!-- CTA principal -->
					<button type="submit" class="don-submit">
						<i class="fa-solid fa-heart"></i>
						<?php esc_html_e( 'Faire mon don', 'waicam' ); ?>
					</button>

					<p class="don-form-trust">
						<i class="fa-solid fa-shield-halved"></i>
						<?php esc_html_e( 'Paiement 100% sécurisé · Reçu fiscal envoyé par email', 'waicam' ); ?>
					</p>
				</form>

				<script>
				(function() {
					const form  = document.getElementById('don-form');
					const input = document.getElementById('don-amount-input');
					if ( ! form || ! input ) return;

					// Quand un palier est cliqué, on synchronise le champ "Autre montant"
					form.querySelectorAll('input[name="nyp_preset"]').forEach(function(radio){
						radio.addEventListener('change', function(){
							input.value = this.dataset.amount;
						});
					});

					// Quand l'utilisateur saisit un montant libre, on désélectionne les paliers
					input.addEventListener('input', function(){
						form.querySelectorAll('input[name="nyp_preset"]').forEach(function(r){ r.checked = false; });
					});

					// À la soumission, on retire le radio "preset" pour ne garder que "nyp" dans l'URL
					form.addEventListener('submit', function(){
						form.querySelectorAll('input[name="nyp_preset"]').forEach(function(r){ r.disabled = true; });
					});
				})();
				</script>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ============================================
     TRANSPARENCE
     ============================================ -->
<section class="don-trust">
	<div class="don-trust-inner">
		<div class="don-trust-icon"><i class="fa-solid fa-shield-heart"></i></div>
		<h3><?php esc_html_e( 'Transparence et impact mesurable', 'waicam' ); ?></h3>
		<p><?php esc_html_e( "Women in AI Cameroon publie chaque année un rapport détaillé sur l'utilisation des fonds reçus. Vous pouvez suivre l'impact concret de votre don à travers nos publications, nos évènements et nos programmes.", 'waicam' ); ?></p>
		<div class="don-trust-stats">
			<div>
				<strong>100 %</strong>
				<span><?php esc_html_e( 'des fonds vont à l\'action terrain', 'waicam' ); ?></span>
			</div>
			<div>
				<strong>4</strong>
				<span><?php esc_html_e( 'programmes phares financés', 'waicam' ); ?></span>
			</div>
			<div>
				<strong>10</strong>
				<span><?php esc_html_e( 'régions du Cameroun couvertes', 'waicam' ); ?></span>
			</div>
		</div>
		<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-outline">
			<?php esc_html_e( 'Demander un rapport détaillé', 'waicam' ); ?>
		</a>
	</div>
</section>

<!-- ============================================
     AUTRES MOYENS DE SOUTIEN
     ============================================ -->
<section class="don-other-ways">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Autres moyens de soutenir', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Vous pouvez aussi <span>nous aider</span> autrement', 'waicam' ) ); ?></h2>
	</div>

	<div class="don-other-grid">
		<div class="don-other-card">
			<div class="don-other-icon"><i class="fa-solid fa-handshake"></i></div>
			<h3><?php esc_html_e( 'Devenir partenaire', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Votre organisation peut nous accompagner via un partenariat stratégique, financier ou en nature.", 'waicam' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/partenaires' ) ); ?>" class="btn-outline btn-sm"><?php esc_html_e( 'En savoir plus', 'waicam' ); ?></a>
		</div>
		<div class="don-other-card">
			<div class="don-other-icon"><i class="fa-solid fa-user-plus"></i></div>
			<h3><?php esc_html_e( 'Rejoindre comme bénévole', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Donnez de votre temps et de vos compétences pour porter le mouvement sur le terrain.", 'waicam' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-outline btn-sm"><?php esc_html_e( 'Rejoindre', 'waicam' ); ?></a>
		</div>
		<div class="don-other-card">
			<div class="don-other-icon"><i class="fa-solid fa-share-nodes"></i></div>
			<h3><?php esc_html_e( 'Faire connaître WAI-CAM', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Partagez nos publications, parlez de nous autour de vous, suivez-nous sur les réseaux sociaux.", 'waicam' ); ?></p>
			<div class="don-other-socials">
				<?php
				$socials = array(
					'facebook'  => array( get_theme_mod( 'waicam_social_facebook',  '#' ), '<i class="fa-brands fa-facebook-f"></i>' ),
					'twitter'   => array( get_theme_mod( 'waicam_social_twitter',   '#' ), '<i class="fa-brands fa-x-twitter"></i>' ),
					'linkedin'  => array( get_theme_mod( 'waicam_social_linkedin',  '#' ), '<i class="fa-brands fa-linkedin-in"></i>' ),
					'instagram' => array( get_theme_mod( 'waicam_social_instagram', '#' ), '<i class="fa-brands fa-instagram"></i>' ),
				);
				foreach ( $socials as $key => $s ) :
				?>
					<a href="<?php echo esc_url( $s[0] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( ucfirst( $key ) ); ?>"><?php echo wp_kses_post( $s[1] ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();