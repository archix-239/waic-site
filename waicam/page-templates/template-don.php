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

$don_hero_title       = get_theme_mod( 'waicam_don_hero_title', 'Montrez votre soutien pour une IA inclusive' );
$don_hero_intro       = get_theme_mod( 'waicam_don_hero_intro', "Votre contribution aide WAI-CAM à former, outiller et accompagner les femmes et les jeunes filles dans les métiers du numérique et de l'intelligence artificielle." );
$don_hero_highlight_1 = get_theme_mod( 'waicam_don_hero_highlight_1', 'Chaque don finance des actions concrètes' );
$don_hero_body        = get_theme_mod( 'waicam_don_hero_body', 'formations terrain, mentorat, ressources pédagogiques et accompagnement des communautés au Cameroun.' );
$don_hero_highlight_2 = get_theme_mod( 'waicam_don_hero_highlight_2', 'Privilégiez le don mensuel' );
$don_hero_closing     = get_theme_mod( 'waicam_don_hero_closing', 'pour donner à l’association une capacité d’action régulière et durable.' );
$don_card_title       = get_theme_mod( 'waicam_don_card_title', 'Aidez-nous à agir — faites un don' );
$don_card_note        = get_theme_mod( 'waicam_don_card_note', "Votre don peut ouvrir droit à une déduction fiscale selon les dispositions applicables de la Loi de finances 2022. Un reçu pourra être transmis après validation du paiement." );
?>

<!-- ============================================
     HERO DON — formulaire + argumentaire
     ============================================ -->
<section class="don-gwc-hero">
	<div class="don-gwc-hero__inner">
		<div class="don-gwc-left">
			<div class="don-gwc-card">
				<h2><?php echo esc_html( $don_card_title ); ?></h2>

			<?php if ( ! $donation_product_id || ! function_exists( 'wc_get_product' ) || ! wc_get_product( $donation_product_id ) ) : ?>

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
					<p class="don-gwc-unavailable"><?php esc_html_e( 'Le module de don est temporairement indisponible. Merci de revenir plus tard.', 'waicam' ); ?></p>
				<?php endif; ?>

			<?php else :
				$tiers = array(
					2000    => __( '2 000 XAF', 'waicam' ),
					25000   => __( '25 000 XAF', 'waicam' ),
					50000   => __( '50 000 XAF', 'waicam' ),
					1000000 => __( '1 000 000 XAF', 'waicam' ),
				);
				$form_action = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/panier/' );
			?>
				<form id="don-form" method="GET" action="<?php echo esc_url( $form_action ); ?>" class="don-form don-gwc-form">
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $donation_product_id ); ?>" />

					<div class="don-gwc-frequency" aria-label="<?php esc_attr_e( 'Fréquence du don', 'waicam' ); ?>">
						<label>
							<input type="radio" name="don_frequency" value="monthly" checked />
							<span><?php esc_html_e( 'Mensuel', 'waicam' ); ?> <i class="fa-solid fa-heart" aria-hidden="true"></i></span>
						</label>
						<label>
							<input type="radio" name="don_frequency" value="once" />
							<span><?php esc_html_e( 'Une fois', 'waicam' ); ?></span>
						</label>
					</div>

					<p class="don-gwc-form__hint"><?php esc_html_e( 'Choisissez un montant à donner.', 'waicam' ); ?></p>

					<div class="don-gwc-amounts">
						<?php foreach ( $tiers as $amount => $label ) :
							$is_default = 25000 === (int) $amount;
						?>
							<label class="don-gwc-amount<?php echo $is_default ? ' is-featured' : ''; ?>">
								<input type="radio" name="nyp_preset" value="<?php echo esc_attr( $amount ); ?>" data-amount="<?php echo esc_attr( $amount ); ?>" <?php checked( $is_default ); ?> />
								<span><?php echo esc_html( $label ); ?></span>
							</label>
						<?php endforeach; ?>
					</div>

					<div class="don-gwc-custom">
						<label for="don-amount-input"><?php esc_html_e( 'Montant libre', 'waicam' ); ?></label>
						<div class="don-gwc-custom__input">
							<span>XAF</span>
							<input type="number" id="don-amount-input" name="nyp" value="25000" min="500" step="100" required />
						</div>
					</div>

					<label class="don-gwc-dedicate">
						<input type="checkbox" name="dedicate_donation" value="1" />
						<span><?php esc_html_e( 'Dédier mon don', 'waicam' ); ?></span>
					</label>

					<button type="submit" class="don-gwc-submit"><?php esc_html_e( 'Faire un don', 'waicam' ); ?></button>
				</form>

				<script>
				(function() {
					const form  = document.getElementById('don-form');
					const input = document.getElementById('don-amount-input');
					if ( ! form || ! input ) return;

					form.querySelectorAll('input[name="nyp_preset"]').forEach(function(radio){
						radio.addEventListener('change', function(){
							input.value = this.dataset.amount;
						});
					});

					input.addEventListener('input', function(){
						form.querySelectorAll('input[name="nyp_preset"]').forEach(function(r){ r.checked = false; });
					});

					form.addEventListener('submit', function(){
						form.querySelectorAll('input[name="nyp_preset"]').forEach(function(r){ r.disabled = true; });
					});
				})();
				</script>
			<?php endif; ?>
			</div>
			<p class="don-gwc-card__note"><?php echo esc_html( $don_card_note ); ?></p>
		</div>

		<div class="don-gwc-copy">
			<h1><?php echo esc_html( $don_hero_title ); ?></h1>
			<p><?php echo esc_html( $don_hero_intro ); ?></p>
			<p><strong><?php echo esc_html( $don_hero_highlight_1 ); ?></strong> <?php echo esc_html( $don_hero_body ); ?></p>
			<p><strong><?php echo esc_html( $don_hero_highlight_2 ); ?></strong> <?php echo esc_html( $don_hero_closing ); ?></p>
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