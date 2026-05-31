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
$don_form_action      = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/panier/' );

$don_option_defaults = array(
	1 => array(
		'title'  => __( 'Soutenir une apprenante', 'waicam' ),
		'text'   => __( 'Financez une participation à une formation, un atelier ou une activité terrain WAI-CAM.', 'waicam' ),
		'amount' => 2000,
	),
	2 => array(
		'title'  => __( 'Financer un atelier', 'waicam' ),
		'text'   => __( 'Aidez-nous à couvrir les ressources pédagogiques, la logistique et l’accompagnement des participantes.', 'waicam' ),
		'amount' => 25000,
	),
	3 => array(
		'title'  => __( 'Accélérer l’impact', 'waicam' ),
		'text'   => __( 'Contribuez au déploiement de programmes inclusifs dans les communautés et les régions du Cameroun.', 'waicam' ),
		'amount' => 50000,
	),
	4 => array(
		'title'  => __( 'Partenaire grand impact', 'waicam' ),
		'text'   => __( 'Soutenez durablement les programmes, les antennes et les actions nationales de Women in AI Cameroon.', 'waicam' ),
		'amount' => 1000000,
	),
);
$don_option_cards = array();
foreach ( $don_option_defaults as $index => $defaults ) {
	$don_option_cards[] = array(
		'title'    => get_theme_mod( "waicam_don_option_{$index}_title", $defaults['title'] ),
		'text'     => get_theme_mod( "waicam_don_option_{$index}_text", $defaults['text'] ),
		'amount'   => (int) get_theme_mod( "waicam_don_option_{$index}_amount", $defaults['amount'] ),
		'image_id' => (int) get_theme_mod( "waicam_don_option_{$index}_image_id", 0 ),
	);
}

$don_faq_title = get_theme_mod( 'waicam_don_faq_title', __( 'Questions fréquentes', 'waicam' ) );
$don_faq_defaults = array(
	1 => array(
		'question' => __( 'À quoi sert mon don à WAI-CAM ?', 'waicam' ),
		'answer'   => __( 'Votre don contribue aux formations, ateliers, actions communautaires, ressources pédagogiques et programmes de mentorat portés par Women in AI Cameroon.', 'waicam' ),
	),
	2 => array(
		'question' => __( 'Puis-je faire un don mensuel ?', 'waicam' ),
		'answer'   => __( 'Oui. Nous encourageons les dons mensuels, car ils permettent de planifier les actions terrain et d’accompagner les bénéficiaires sur la durée.', 'waicam' ),
	),
	3 => array(
		'question' => __( 'Une entreprise peut-elle soutenir WAI-CAM ?', 'waicam' ),
		'answer'   => __( 'Oui. Les organisations peuvent soutenir WAI-CAM par un don, un partenariat stratégique, un appui en nature ou un accompagnement de programmes.', 'waicam' ),
	),
	4 => array(
		'question' => __( 'Comment obtenir un reçu ou une information fiscale ?', 'waicam' ),
		'answer'   => __( 'Après validation du paiement, l’équipe peut transmettre un reçu et les informations disponibles relatives aux dispositions fiscales applicables.', 'waicam' ),
	),
);
$don_faq_items = array();
foreach ( $don_faq_defaults as $index => $defaults ) {
	$don_faq_items[] = array(
		'question' => get_theme_mod( "waicam_don_faq_{$index}_question", $defaults['question'] ),
		'answer'   => get_theme_mod( "waicam_don_faq_{$index}_answer", $defaults['answer'] ),
	);
}
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
     OPTIONS DE DON — cartes d'impact
     ============================================ -->
<section class="don-gwc-options" aria-label="<?php esc_attr_e( 'Choisir un impact à financer', 'waicam' ); ?>">
	<div class="don-gwc-options__grid">
		<?php foreach ( $don_option_cards as $card ) :
			$amount    = max( 500, (int) $card['amount'] );
			$image_url = $card['image_id'] ? wp_get_attachment_image_url( $card['image_id'], 'large' ) : '';
		?>
			<form class="don-gwc-option-card" method="GET" action="<?php echo esc_url( $don_form_action ); ?>">
				<?php if ( $donation_product_id ) : ?>
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $donation_product_id ); ?>" />
				<?php endif; ?>
				<input type="hidden" name="nyp" value="<?php echo esc_attr( $amount ); ?>" />

				<div class="don-gwc-option-card__media">
					<?php if ( $image_url ) : ?>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy" />
					<?php else : ?>
						<div class="don-gwc-option-card__placeholder" aria-hidden="true"></div>
					<?php endif; ?>
				</div>

				<div class="don-gwc-option-card__body">
					<h2><?php echo esc_html( $card['title'] ); ?></h2>
					<p><?php echo esc_html( $card['text'] ); ?></p>

					<div class="don-gwc-option-card__price" aria-label="<?php echo esc_attr( sprintf( __( 'Montant %s XAF', 'waicam' ), number_format_i18n( $amount ) ) ); ?>">
						<span>XAF</span>
						<strong><?php echo esc_html( number_format_i18n( $amount ) ); ?></strong>
					</div>

					<label class="don-gwc-option-card__frequency">
						<span><?php esc_html_e( 'Fréquence', 'waicam' ); ?></span>
						<select name="don_frequency">
							<option value="monthly"><?php esc_html_e( 'Mensuel', 'waicam' ); ?></option>
							<option value="once"><?php esc_html_e( 'Une fois', 'waicam' ); ?></option>
						</select>
					</label>

					<button type="submit" class="don-gwc-option-card__button" <?php disabled( ! $donation_product_id ); ?>><?php esc_html_e( 'Faire un don', 'waicam' ); ?></button>
				</div>
			</form>
		<?php endforeach; ?>
	</div>
</section>

<!-- ============================================
     FAQ DON
     ============================================ -->
<section class="don-gwc-faq">
	<div class="don-gwc-faq__panel">
		<h2><?php echo esc_html( $don_faq_title ); ?></h2>
		<div class="don-gwc-faq__items">
			<?php foreach ( $don_faq_items as $index => $item ) : ?>
				<details class="don-gwc-faq__item" <?php echo 0 === $index ? 'open' : ''; ?>>
					<summary>
						<span><?php echo esc_html( $item['question'] ); ?></span>
						<i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
					</summary>
					<div class="don-gwc-faq__answer">
						<p><?php echo esc_html( $item['answer'] ); ?></p>
					</div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer();