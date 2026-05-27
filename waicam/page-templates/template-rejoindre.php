<?php
/**
 * Template Name: WAI-CAM — Rejoindre
 *
 * @package WAICAM
 */

get_header();

// Customizer settings
$hero_badge = get_theme_mod('waicam_rejoindre_hero_badge', 'GET INVOLVED');
$hero_title = get_theme_mod('waicam_rejoindre_hero_title', 'WAI-CAM A BESOIN DE VOTRE SOUTIEN');
$hero_text  = get_theme_mod('waicam_rejoindre_hero_text', "Les femmes ont besoin de votre soutien pour s'épanouir dans la tech, et il existe de nombreuses façons de nous aider.");

$news_title = get_theme_mod('waicam_rejoindre_newsletter_title', 'STAY IN THE LOOP');
$news_text  = get_theme_mod('waicam_rejoindre_newsletter_text', "Abonnez-vous à notre newsletter pour ne rien manquer de nos actions.");
$news_form_id = get_theme_mod('waicam_form_newsletter', '');

$give_title = get_theme_mod('waicam_rejoindre_give_title', 'WAYS TO GIVE');
$give_text  = get_theme_mod('waicam_rejoindre_give_text', "Votre don finance directement la formation des femmes au Cameroun.");
$donation_product_id = (int) get_theme_mod( 'waicam_donation_product_id', 0 );
?>

<section class="rejoindre-gwc">
	<div class="rejoindre-gwc__inner">

		<!-- TOP SECTION -->
		<div class="rejoindre-gwc__top">
			<div class="rejoindre-gwc__highlight">
				<div class="home-posthero-badge"><?php echo esc_html($hero_badge); ?></div>
				<h1><?php echo wp_kses_post($hero_title); ?></h1>
			</div>
			<div class="rejoindre-gwc__desc">
				<p><?php echo nl2br(esc_html($hero_text)); ?></p>
			</div>
		</div>

		<!-- LARGE WAVE -->
		<svg class="rejoindre-gwc__wave waicam-wave-replay is-visible" viewBox="0 0 1200 60" preserveAspectRatio="none">
			<path d="M0,30 C150,0 300,60 450,30 C600,0 750,60 900,30 C1050,0 1200,60 1350,30" />
		</svg>

		<!-- CARDS GRID -->
		<div class="rejoindre-gwc__grid">
			<?php for ($i = 1; $i <= 4; $i++) :
				$card_title  = get_theme_mod("waicam_rejoindre_card_{$i}_title");
				$card_text   = get_theme_mod("waicam_rejoindre_card_{$i}_text");
				$card_commit = get_theme_mod("waicam_rejoindre_card_{$i}_commit");
				$card_btn    = get_theme_mod("waicam_rejoindre_card_{$i}_btn");
				$card_url    = get_theme_mod("waicam_rejoindre_card_{$i}_url");

				if (!$card_title) continue;
			?>
			<div class="rejoindre-gwc__card">
				<h3><?php echo esc_html($card_title); ?></h3>
				<p><?php echo esc_html($card_text); ?></p>
				<div class="rejoindre-gwc__commit"><?php echo esc_html($card_commit); ?></div>
				<a href="<?php echo esc_url($card_url); ?>" class="rejoindre-gwc__link">
					<?php echo esc_html($card_btn); ?>
					<span class="arrow-anim">
						<span class="arrow-plain">→</span>
						<svg class="arrow-wave" viewBox="0 0 82 24"><path d="M2,12 C15,2 30,22 45,12 C60,2 75,22 80,12" /><path d="M72,6 L80,12 L72,18" /></svg>
					</span>
				</a>
			</div>
			<?php endfor; ?>
		</div>

	</div>
</section>

<!-- NEWSLETTER SECTION (Stay in the loop) -->
<section class="home-newsletter-gwc">
	<div class="home-newsletter-gwc__inner">
		<div class="home-newsletter-gwc__content">
			<h2><?php echo esc_html($news_title); ?></h2>
			<p><?php echo esc_html($news_text); ?></p>
		</div>
		<div class="home-newsletter-gwc__form">
			<?php if ($news_form_id) : ?>
				<?php echo do_shortcode('[fluentform id="' . esc_attr($news_form_id) . '"]'); ?>
			<?php else : ?>
				<div class="home-newsletter-gwc__placeholder">
					<?php esc_html_e("Veuillez configurer l'ID du formulaire Newsletter dans le Customizer.", 'waicam'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- WAYS TO GIVE SECTION (Nudge based donations) -->
<section class="don-form-section" style="background:#fff;">
	<div class="don-form-wrapper">
		<div class="don-form-intro">
			<div class="section-tag"><?php echo esc_html($give_title); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post($give_text); ?></h2>
			<p><?php esc_html_e("Votre don finance directement nos actions sur le terrain. Choisissez un montant et soutenez le mouvement.", 'waicam'); ?></p>

			<ul class="don-form-features">
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( 'Paiement sécurisé', 'waicam' ); ?></li>
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( "Mobile Money & carte bancaire", 'waicam' ); ?></li>
				<li><i class="fa-solid fa-circle-check" style="color:var(--green)"></i> <?php esc_html_e( "Impact direct et mesurable", 'waicam' ); ?></li>
			</ul>
		</div>

		<div class="don-form-card">
			<?php if ( $donation_product_id ) :
				$tiers = array(
					2000   => array( 'icon' => 'fa-heart', 'label' => __( 'Soutien de base', 'waicam' ), 'desc' => __( '10 USD environ', 'waicam' ) ),
					25000  => array( 'icon' => 'fa-graduation-cap', 'label' => __( 'Une étudiante', 'waicam' ), 'desc' => __( '50 USD environ', 'waicam' ), 'featured' => true ),
					50000  => array( 'icon' => 'fa-building', 'label' => __( 'Don entreprise', 'waicam' ), 'desc' => __( '100 USD et +', 'waicam' ) ),
				);
				$form_action = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/panier/' );
			?>
				<form id="don-form" method="GET" action="<?php echo esc_url( $form_action ); ?>" class="don-form">
					<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $donation_product_id ); ?>" />

					<div class="don-tiers">
						<?php foreach ( $tiers as $amount => $tier ) :
							$featured = ! empty( $tier['featured'] );
						?>
							<label class="don-tier<?php echo $featured ? ' don-tier--featured' : ''; ?>">
								<input type="radio" name="nyp_preset" value="<?php echo esc_attr( $amount ); ?>" data-amount="<?php echo esc_attr( $amount ); ?>" <?php checked( $featured ); ?> />
								<div class="don-tier-amount"><?php echo esc_html( number_format_i18n( $amount ) ); ?> <span>FCFA</span></div>
								<div class="don-tier-icon"><i class="fa-solid <?php echo esc_attr( $tier['icon'] ); ?>"></i></div>
								<div class="don-tier-label"><?php echo esc_html( $tier['label'] ); ?></div>
								<div class="don-tier-desc"><?php echo esc_html( $tier['desc'] ); ?></div>
							</label>
						<?php endforeach; ?>
					</div>

					<div class="don-custom">
						<label for="don-amount-input"><?php esc_html_e( 'Montant personnalisé', 'waicam' ); ?></label>
						<div class="don-custom-input">
							<input type="number" id="don-amount-input" name="nyp" value="25000" min="500" step="500" required />
							<span class="don-currency">FCFA</span>
						</div>
					</div>

					<button type="submit" class="don-submit">
						<i class="fa-solid fa-heart"></i>
						<?php esc_html_e( 'Soutenir WAI-CAM', 'waicam' ); ?>
					</button>
				</form>
				<script>
				(function() {
					const form  = document.getElementById('don-form');
					const input = document.getElementById('don-amount-input');
					if (!form || !input) return;
					form.querySelectorAll('input[name="nyp_preset"]').forEach(radio => {
						radio.addEventListener('change', function() { input.value = this.dataset.amount; });
					});
					input.addEventListener('input', function() { form.querySelectorAll('input[name="nyp_preset"]').forEach(r => { r.checked = false; }); });
					form.addEventListener('submit', function() { form.querySelectorAll('input[name="nyp_preset"]').forEach(r => { r.disabled = true; }); });
				})();
				</script>
			<?php else : ?>
				<p style="text-align:center; color:var(--gray);"><?php esc_html_e("Veuillez configurer l'ID du produit de don dans le Customizer.", 'waicam'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- FORMULAIRE D'ADHÉSION -->
<section id="form-adhesion" style="background:var(--gray-light); padding-top:40px;">
	<div style="max-width:800px;margin:0 auto; padding: 0 5% 100px;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Devenir <span>Membre</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire pour rejoindre le mouvement. Notez que le lien vers votre profil LinkedIn est fortement recommandé pour valider votre adhésion professionnelle.", 'waicam' ); ?></p>
		</div>

		<div class="form-card">
			<?php
			$ff_id = get_theme_mod( 'waicam_form_adhesion', '' );
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				?>
				<p style="text-align:center; color:var(--gray);"><?php esc_html_e("Veuillez configurer l'ID du formulaire dans le Customizer (WAI-CAM -> Formulaires).", 'waicam'); ?></p>
				<?php
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
