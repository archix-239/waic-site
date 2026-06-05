<?php
/**
 * Template Name: WAI-CAM — Programmes
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$programmes_hero_label    = get_theme_mod( 'waicam_programmes_hero_label', __( 'Programmes WAI-CAM', 'waicam' ) );
$programmes_hero_title    = get_theme_mod( 'waicam_programmes_hero_title', __( 'Nos Programmes Phares', 'waicam' ) );
$programmes_hero_text     = get_theme_mod( 'waicam_programmes_hero_text', __( "Quatre programmes structurants pour démocratiser l'IA auprès de toutes les femmes camerounaises.", 'waicam' ) );
$programmes_hero_image_id = absint( get_theme_mod( 'waicam_programmes_hero_image_id', 0 ) );
$programmes_intro_title    = get_theme_mod( 'waicam_programmes_intro_title', __( 'Quels sont nos programmes phares ?', 'waicam' ) );
$programmes_intro_text     = get_theme_mod( 'waicam_programmes_intro_text', __( "WAI-CAM déploie des programmes conçus pour former, outiller et accompagner les femmes, les jeunes et les communautés dans l'appropriation de l'intelligence artificielle au Cameroun.", 'waicam' ) );
$programmes_intro_image_id = absint( get_theme_mod( 'waicam_programmes_intro_image_id', 0 ) );
$programmes_values         = array(
	array(
		'title' => get_theme_mod( 'waicam_programmes_value_1_title', __( 'Créer une communauté', 'waicam' ) ),
		'text'  => get_theme_mod( 'waicam_programmes_value_1_text', __( "Connecter les femmes et les jeunes filles à une communauté solidaire qui les aide à apprendre, persévérer et réussir dans l'IA.", 'waicam' ) ),
	),
	array(
		'title' => get_theme_mod( 'waicam_programmes_value_2_title', __( 'Développer le leadership', 'waicam' ) ),
		'text'  => get_theme_mod( 'waicam_programmes_value_2_text', __( 'Renforcer les compétences, la confiance et le mentorat grâce à des parcours pratiques portés par des modèles féminins inspirants.', 'waicam' ) ),
	),
	array(
		'title' => get_theme_mod( 'waicam_programmes_value_3_title', __( 'Construire des carrières IA', 'waicam' ) ),
		'text'  => get_theme_mod( 'waicam_programmes_value_3_text', __( "Préparer les participantes à saisir les opportunités du numérique, de la recherche et de l'emploi dans l'écosystème IA camerounais.", 'waicam' ) ),
	),
);
?>

<section class="programmes-career-hero" aria-labelledby="programmes-career-hero-title">
	<div class="programmes-career-hero__inner">
		<div class="programmes-career-hero__media">
			<?php if ( $programmes_hero_image_id ) : ?>
				<?php echo wp_get_attachment_image( $programmes_hero_image_id, 'large', false, array( 'class' => 'programmes-career-hero__image', 'loading' => 'eager' ) ); ?>
			<?php else : ?>
				<img class="programmes-career-hero__image" src="<?php echo esc_url( waicam_img( 'girls-ict.webp' ) ); ?>" alt="<?php esc_attr_e( 'Participantes WAI-CAM engagées dans un programme de formation', 'waicam' ); ?>" loading="eager" />
			<?php endif; ?>
		</div>

		<div class="programmes-career-hero__copy">
			<?php if ( $programmes_hero_label ) : ?>
				<span class="programmes-career-hero__label"><?php echo esc_html( $programmes_hero_label ); ?></span>
			<?php endif; ?>
			<h1 id="programmes-career-hero-title"><?php echo esc_html( $programmes_hero_title ); ?></h1>
			<p><?php echo esc_html( $programmes_hero_text ); ?></p>
		</div>
	</div>
</section>

<section class="programmes-career-intro" aria-labelledby="programmes-career-intro-title">
	<div class="programmes-career-intro__inner">
		<div class="programmes-career-intro__copy">
			<h2 id="programmes-career-intro-title"><?php echo esc_html( $programmes_intro_title ); ?></h2>
			<svg class="programmes-career-intro__wave" viewBox="0 0 360 24" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 256 12 S278 2 288 12 S310 22 320 12 S342 2 360 12" />
			</svg>
			<p><?php echo esc_html( $programmes_intro_text ); ?></p>
		</div>

		<div class="programmes-career-intro__visual">
			<?php if ( $programmes_intro_image_id ) : ?>
				<?php echo wp_get_attachment_image( $programmes_intro_image_id, 'large', false, array( 'class' => 'programmes-career-intro__image', 'loading' => 'lazy' ) ); ?>
			<?php else : ?>
				<img class="programmes-career-intro__image" src="<?php echo esc_url( waicam_img( 'training-1.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Atelier Women in AI Cameroon', 'waicam' ); ?>" loading="lazy" />
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="programmes-career-values" aria-label="<?php esc_attr_e( 'Valeurs des programmes WAI-CAM', 'waicam' ); ?>">
	<div class="programmes-career-values__inner">
		<?php foreach ( $programmes_values as $programmes_value ) : ?>
			<article class="programmes-career-values__item">
				<h3><?php echo esc_html( $programmes_value['title'] ); ?></h3>
				<p><?php echo esc_html( $programmes_value['text'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<?php
$programmes_query = waicam_get_programmes( -1 );

// Mapping des couleurs vers IDs de section pour la nav par ancre
$couleur_to_id = array(
	'c1' => 'youth',
	'c2' => 'public',
	'c3' => 'leaders',
	'c4' => 'communities',
);

if ( $programmes_query ) :
	$index = 0;
?>
<section class="programmes-career-cpt" aria-label="<?php esc_attr_e( 'Liste des programmes WAI-CAM', 'waicam' ); ?>">
	<?php
	while ( $programmes_query->have_posts() ) :
		$programmes_query->the_post();
		$nom_prog      = waicam_field( 'nom_programme', get_the_ID(), get_the_title() );
		$accroche      = waicam_field( 'accroche_courte' );
		$description   = waicam_field( 'description_complete' );
		$public_cible  = waicam_field( 'public_cible' );
		$couleur       = waicam_programme_color( $nom_prog );
		$section_id    = $couleur_to_id[ $couleur ] ?? 'prog-' . get_the_ID();
		$is_reverse    = ( $index % 2 === 1 );
		$theme_classes = array( 'programmes-career-feature' );

		if ( $is_reverse ) {
			$theme_classes[] = 'programmes-career-feature--reverse';
		}

		$theme_classes[] = 'programmes-career-feature--tone-' . ( $index % 3 );
		$img_url         = waicam_image_url( 'image_dillustration', get_the_ID(), 'large', 'girls-ict.webp' );
		$card_text       = $description ? $description : $accroche;
		$card_text       = wp_trim_words( wp_strip_all_tags( $card_text ), 72, '…' );
		?>
		<article id="<?php echo esc_attr( $section_id ); ?>" class="<?php echo esc_attr( implode( ' ', $theme_classes ) ); ?>">
			<div class="programmes-career-feature__image">
				<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $nom_prog ); ?>" loading="lazy" />
			</div>

			<div class="programmes-career-feature__copy">
				<span class="programmes-career-feature__kicker"><?php printf( esc_html__( 'Programme %02d', 'waicam' ), $index + 1 ); ?></span>
				<h2><?php echo esc_html( $nom_prog ); ?></h2>
				<svg class="programmes-career-feature__wave" viewBox="0 0 420 24" role="presentation" aria-hidden="true" focusable="false">
					<path d="M0 12 C10 2 22 2 32 12 S54 22 64 12 S86 2 96 12 S118 22 128 12 S150 2 160 12 S182 22 192 12 S214 2 224 12 S246 22 256 12 S278 2 288 12 S310 22 320 12 S342 2 352 12 S374 22 384 12 S406 2 420 12" />
				</svg>
				<?php if ( $card_text ) : ?>
					<p><?php echo esc_html( $card_text ); ?></p>
				<?php endif; ?>
				<?php if ( $public_cible ) : ?>
					<p class="programmes-career-feature__meta"><strong><?php esc_html_e( 'Public cible :', 'waicam' ); ?></strong> <?php echo esc_html( $public_cible ); ?></p>
				<?php endif; ?>
				<a class="programmes-career-feature__link" href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>">
					<span><?php esc_html_e( 'Participer au programme', 'waicam' ); ?></span>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</article>
		<?php
		$index++;
	endwhile;
	wp_reset_postdata();
	?>
</section>
<?php
else :
	// Si aucun programme CPTUI/ACF n'est disponible, afficher un message clair pour l'administration.
?>
<section>
	<div style="max-width:700px;margin:0 auto;text-align:center;color:var(--gray);">
		<p><?php esc_html_e( 'Aucun programme à afficher pour le moment. Ajoutez vos programmes via CPT UI / ACF pour alimenter cette section.', 'waicam' ); ?></p>
	</div>
</section>
<?php endif; ?>

<!-- FORMULAIRE INSCRIPTION PROGRAMME -->
<section>
	<div style="max-width:700px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Inscription', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( "S'inscrire à un <span>programme</span>", 'waicam' ) ); ?></h2>
			<p class="section-desc"><?php esc_html_e( "Remplissez ce formulaire pour exprimer votre intérêt et rejoindre l'un de nos programmes.", 'waicam' ); ?></p>
		</div>
		<div class="form-card">
			<?php
			// Affiche un formulaire Fluent Forms via shortcode (configuré depuis le Customizer)
			$ff_id = get_theme_mod( 'waicam_form_programme', '' );
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				echo '<p style="text-align:center;color:var(--gray);padding:24px;">';
				esc_html_e( 'Formulaire à connecter dans Apparence → Personnaliser → WAI-CAM → ID du formulaire programme', 'waicam' );
				echo '</p>';
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
