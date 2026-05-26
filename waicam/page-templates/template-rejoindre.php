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

<!-- FORMULAIRE D'ADHÉSION -->
<section id="form-adhesion" style="background:#f5f5f7; padding-top:0;">
	<div style="max-width:800px;margin:0 auto; padding: 0 5% 100px;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( "Formulaire d'adhésion", 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Rejoindre <span>WAI-CAM</span>', 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire pour rejoindre le mouvement. Notre équipe vous contactera rapidement.", 'waicam' ); ?></p>
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
