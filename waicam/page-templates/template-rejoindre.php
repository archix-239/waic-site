<?php
/**
 * Template Name: WAI-CAM — Rejoindre
 *
 * @package WAICAM
 */

get_header();

$ff_id = get_theme_mod( 'waicam_form_adhesion', '' );
$join_hero_image_id = absint( get_theme_mod( 'waicam_join_hero_image_id', 0 ) );
$join_hero_image = $join_hero_image_id ? wp_get_attachment_image_url( $join_hero_image_id, 'large' ) : '';
$join_campaign_image_id = absint( get_theme_mod( 'waicam_join_campaign_image_id', 0 ) );
$join_campaign_image = $join_campaign_image_id ? wp_get_attachment_image_url( $join_campaign_image_id, 'large' ) : '';
$join_form_image_id = absint( get_theme_mod( 'waicam_join_form_image_id', 0 ) );
$join_form_image = $join_form_image_id ? wp_get_attachment_image_url( $join_form_image_id, 'large' ) : '';
?>

<section class="join-gwc-hero" id="types">
	<div class="join-gwc-hero__container">
		<div class="join-gwc-hero__top">
			<div class="join-gwc-hero__kicker"><?php echo esc_html( get_theme_mod( 'waicam_join_hero_kicker', 'GET INVOLVED' ) ); ?></div>
			<h1><?php echo esc_html( get_theme_mod( 'waicam_join_hero_title', 'REJOIGNEZ LE MOUVEMENT WAI-CAM' ) ); ?></h1>
			<p><?php echo esc_html( get_theme_mod( 'waicam_join_hero_text', 'Femmes et allié·e·s peuvent contribuer via l’engagement communautaire, l’éducation et le mentorat pour démocratiser l’IA au Cameroun.' ) ); ?></p>
		</div>

		<div class="join-gwc-hero__grid">
			<article class="join-gwc-card">
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_card_1_title', 'DEVENIR MEMBRE' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_card_1_text', 'Rejoignez les activités WAI-CAM, les formations et le réseau national.' ) ); ?></p>
				<strong><?php echo esc_html( get_theme_mod( 'waicam_join_card_1_meta', 'Engagement flexible' ) ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php echo esc_html( get_theme_mod( 'waicam_join_card_cta_text', 'En savoir plus' ) ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_card_2_title', 'VOLONTARIAT' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_card_2_text', 'Apportez vos compétences (tech, communication, opérationnel) sur les actions terrain.' ) ); ?></p>
				<strong><?php echo esc_html( get_theme_mod( 'waicam_join_card_2_meta', 'Selon vos disponibilités' ) ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php echo esc_html( get_theme_mod( 'waicam_join_card_cta_text', 'En savoir plus' ) ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_card_3_title', 'MENTORAT' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_card_3_text', 'Encadrez les jeunes filles et femmes sur les métiers IA et numérique.' ) ); ?></p>
				<strong><?php echo esc_html( get_theme_mod( 'waicam_join_card_3_meta', 'Impact direct' ) ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php echo esc_html( get_theme_mod( 'waicam_join_card_cta_text', 'En savoir plus' ) ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
			<article class="join-gwc-card">
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_card_4_title', 'PARTENARIAT' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_card_4_text', 'Soutenez les programmes par des ressources, expertises ou co-initiatives.' ) ); ?></p>
				<strong><?php echo esc_html( get_theme_mod( 'waicam_join_card_4_meta', 'Collaboration institutionnelle' ) ); ?></strong>
				<a href="#form-adhesion" class="join-gwc-card__link"><?php echo esc_html( get_theme_mod( 'waicam_join_card_cta_text', 'En savoir plus' ) ); ?> <span class="arrow-plain" aria-hidden="true">→</span></a>
			</article>
		</div>
	</div>
</section>

<section class="join-gwc-image" aria-label="WAI-CAM get involved">
	<div class="join-gwc-image__media<?php echo $join_hero_image ? ' has-image' : ''; ?>"<?php if ( $join_hero_image ) : ?> style="background-image:url('<?php echo esc_url( $join_hero_image ); ?>');"<?php endif; ?>></div>
</section>


<section class="join-gwc-campaign">
	<div class="join-gwc-campaign__wave" aria-hidden="true">
		<svg viewBox="0 0 1440 32" preserveAspectRatio="none" focusable="false">
			<path d="M0 16 Q10 4 20 16 T40 16 T60 16 T80 16 T100 16 T120 16 T140 16 T160 16 T180 16 T200 16 T220 16 T240 16 T260 16 T280 16 T300 16 T320 16 T340 16 T360 16 T380 16 T400 16 T420 16 T440 16 T460 16 T480 16 T500 16 T520 16 T540 16 T560 16 T580 16 T600 16 T620 16 T640 16 T660 16 T680 16 T700 16 T720 16 T740 16 T760 16 T780 16 T800 16 T820 16 T840 16 T860 16 T880 16 T900 16 T920 16 T940 16 T960 16 T980 16 T1000 16 T1020 16 T1040 16 T1060 16 T1080 16 T1100 16 T1120 16 T1140 16 T1160 16 T1180 16 T1200 16 T1220 16 T1240 16 T1260 16 T1280 16 T1300 16 T1320 16 T1340 16 T1360 16 T1380 16 T1400 16 T1420 16 T1440 16" />
		</svg>
	</div>
	<div class="join-gwc-campaign__inner">
		<div class="join-gwc-campaign__media<?php echo $join_campaign_image ? ' has-image' : ''; ?>">
			<?php if ( $join_campaign_image ) : ?>
				<img src="<?php echo esc_url( $join_campaign_image ); ?>" alt="" loading="lazy" />
			<?php else : ?>
				<div class="join-gwc-campaign__placeholder"><span><?php esc_html_e( 'Image campagne', 'waicam' ); ?></span></div>
			<?php endif; ?>
		</div>
		<div class="join-gwc-campaign__content">
			<h2><?php echo esc_html( get_theme_mod( 'waicam_join_campaign_title', 'WAI-CAM MOBILISE LES COMMUNAUTÉS POUR UNE IA INCLUSIVE' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'waicam_join_campaign_text', 'En rejoignant WAI-CAM, vous participez à des actions concrètes : formations, mentorat, sensibilisation et programmes terrain pour les femmes et les jeunes au Cameroun.' ) ); ?></p>
			<a href="#form-adhesion" class="join-gwc-campaign__link">
				<?php echo esc_html( get_theme_mod( 'waicam_join_campaign_cta_text', 'Rejoindre une action' ) ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 88 20" focusable="false">
						<path d="M2 10 C12 1, 22 19, 32 10 S52 1, 62 10 S78 19, 86 10 M76 4 L86 10 L76 16" />
					</svg>
				</span>
			</a>
		</div>
	</div>
</section>

<section class="join-gwc-bigstat">
	<div class="join-gwc-bigstat__inner">
		<h2><?php echo esc_html( get_theme_mod( 'waicam_join_bigstat_title', '5 millions de filles et de femmes formées, sensibilisées et accompagnées d’ici 2030.' ) ); ?></h2>
		<div class="join-gwc-bigstat__bottom">
			<p><?php echo esc_html( get_theme_mod( 'waicam_join_bigstat_text', 'Nous agissons pour réduire durablement les écarts d’accès aux compétences numériques et à l’intelligence artificielle.' ) ); ?></p>
			<a href="<?php echo esc_url( get_theme_mod( 'waicam_join_bigstat_cta_url', home_url( '/faire-un-don/' ) ) ); ?>" class="join-gwc-bigstat__button"><?php echo esc_html( get_theme_mod( 'waicam_join_bigstat_cta_text', 'Soutenir maintenant' ) ); ?></a>
		</div>
	</div>
</section>

<section class="join-gwc-pillars">
	<div class="join-gwc-pillars__inner">
		<header class="join-gwc-pillars__header">
			<h2><?php echo esc_html( get_theme_mod( 'waicam_join_pillars_title', 'COMMENT CONTRIBUER' ) ); ?></h2>
			<svg class="join-gwc-pillars__wave" viewBox="0 0 360 18" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0 9 Q9 1 18 9 T36 9 T54 9 T72 9 T90 9 T108 9 T126 9 T144 9 T162 9 T180 9 T198 9 T216 9 T234 9 T252 9 T270 9 T288 9 T306 9 T324 9 T342 9 T360 9" />
			</svg>
		</header>
		<div class="join-gwc-pillars__grid">
			<article class="join-gwc-pillar">
				<div class="join-gwc-pillar__icon" aria-hidden="true">
					<svg viewBox="0 0 96 96" focusable="false"><path d="M20 68 V22 H66 L76 32 V68 Z"/><path d="M66 22 V34 H76"/><path d="M30 38 H60"/><path d="M30 50 H66"/><path d="M30 62 H54"/></svg>
				</div>
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_1_title', 'FORMATION' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_1_text', 'Animez, facilitez ou accompagnez des ateliers d’initiation à l’IA et au numérique pour les jeunes filles et les femmes.' ) ); ?></p>
			</article>
			<article class="join-gwc-pillar">
				<div class="join-gwc-pillar__icon" aria-hidden="true">
					<svg viewBox="0 0 96 96" focusable="false"><path d="M26 18 H70 V78 H26 Z"/><path d="M36 18 V78"/><path d="M44 30 H62"/><path d="M44 44 H62"/><path d="M44 58 H62"/></svg>
				</div>
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_2_title', 'RESSOURCES' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_2_text', 'Contribuez à produire, traduire ou diffuser des ressources pédagogiques adaptées aux réalités du terrain camerounais.' ) ); ?></p>
			</article>
			<article class="join-gwc-pillar">
				<div class="join-gwc-pillar__icon" aria-hidden="true">
					<svg viewBox="0 0 96 96" focusable="false"><circle cx="28" cy="30" r="9"/><circle cx="48" cy="24" r="9"/><circle cx="68" cy="30" r="9"/><path d="M16 72 C16 56 22 48 32 48 C38 48 42 52 48 56 C54 52 58 48 64 48 C74 48 80 56 80 72"/><path d="M36 72 V58"/><path d="M60 72 V58"/></svg>
				</div>
				<h3><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_3_title', 'COMMUNAUTÉ' ) ); ?></h3>
				<p><?php echo esc_html( get_theme_mod( 'waicam_join_pillar_3_text', 'Rejoignez un réseau engagé de membres, mentors, volontaires et partenaires qui agissent pour une IA inclusive.' ) ); ?></p>
			</article>
		</div>
		<a href="#form-adhesion" class="join-gwc-pillars__button"><?php echo esc_html( get_theme_mod( 'waicam_join_pillars_cta_text', 'Rejoindre WAI-CAM' ) ); ?></a>
	</div>
</section>

<section id="form-adhesion" class="join-gwc-form-section">
	<div class="join-gwc-form-section__inner">
		<div class="join-gwc-form-section__media<?php echo $join_form_image ? ' has-image' : ''; ?>">
			<?php if ( $join_form_image ) : ?>
				<img src="<?php echo esc_url( $join_form_image ); ?>" alt="" loading="lazy" />
			<?php else : ?>
				<div class="join-gwc-form-section__placeholder"><span><?php esc_html_e( 'Visuel formulaire', 'waicam' ); ?></span></div>
			<?php endif; ?>
		</div>
		<div class="join-gwc-form-section__content">
			<div class="join-gwc-form-section__eyebrow"><?php echo esc_html( get_theme_mod( 'waicam_join_form_eyebrow', 'Adhésion' ) ); ?></div>
			<h2><?php echo esc_html( get_theme_mod( 'waicam_join_form_title', 'PRÊTE À REJOINDRE LE MOUVEMENT ?' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'waicam_join_form_text', 'Remplissez le formulaire d’adhésion. Notre équipe vous contactera sous 48 heures pour confirmer votre parcours d’engagement.' ) ); ?></p>
			<div class="join-gwc-fluent-form">
				<?php
				if ( $ff_id ) {
					echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
				} else {
					echo '<p class="join-gwc-form-section__notice">' . esc_html__( "Configurez l’ID Fluent Forms dans le Customizer (waicam_form_adhesion).", 'waicam' ) . '</p>';
				}
				?>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
