<?php
/**
 * Template Name: WAI-CAM — Programmes
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Nos Programmes Phares', 'waicam' ),
	'subtitle' => __( "Quatre programmes structurants pour démocratiser l'IA auprès de toutes les femmes camerounaises.", 'waicam' ),
	'crumb'    => __( 'Programmes', 'waicam' ),
) );
?>

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
	while ( $programmes_query->have_posts() ) : $programmes_query->the_post();
		$nom_prog       = waicam_field( 'nom_programme', get_the_ID(), get_the_title() );
		$accroche       = waicam_field( 'accroche_courte' );
		$description    = waicam_field( 'description_complete' );
		$activites_str  = waicam_field( 'activites' );
		$public_cible   = waicam_field( 'public_cible' );

		$couleur    = waicam_programme_color( $nom_prog );
		$icone      = waicam_programme_icone( $nom_prog );
		$section_id = $couleur_to_id[ $couleur ] ?? 'prog-' . get_the_ID();
		$reverse    = ( $index % 2 === 1 );
		$bg         = $reverse ? ' style="background:var(--gray-light);"' : '';

		$activites = $activites_str ? array_filter( array_map( 'trim', explode( ',', $activites_str ) ) ) : array();
?>
<section id="<?php echo esc_attr( $section_id ); ?>"<?php echo $bg; ?>>
	<div class="programme-detail">
		<div class="programme-row<?php echo $reverse ? ' programme-row--reverse' : ''; ?>">

			<!-- HEADER : icône + tag + titre + accroche -->
			<div class="programme-header">
				<div class="programme-icon programme-icon--<?php echo esc_attr( $couleur ); ?>"><?php echo wp_kses_post( $icone ); ?></div>
				<div class="section-tag"><?php printf( esc_html__( 'Programme %02d', 'waicam' ), $index + 1 ); ?></div>
				<h2 class="section-title"><?php echo esc_html( $nom_prog ); ?></h2>

				<?php if ( $accroche ) : ?>
					<p class="programme-accroche"><strong><?php echo esc_html( $accroche ); ?></strong></p>
				<?php endif; ?>
			</div>

			<!-- IMAGE -->
			<div class="programme-image">
				<?php
				// L'image utilise le champ ACF "image_dillustration" (slug exact ACF)
				$img_url = waicam_image_url( 'image_dillustration', get_the_ID(), 'large', 'girls-ict.webp' );
				?>
				<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $nom_prog ); ?>" loading="lazy" />
			</div>

			<!-- BODY : description, public cible, activités, bouton -->
			<div class="programme-body">
				<?php if ( $description ) : ?>
					<div class="programme-content"><?php echo wp_kses_post( $description ); ?></div>
				<?php endif; ?>

				<?php if ( $public_cible ) : ?>
					<p class="programme-public"><span class="ci-icon"><i class="fa-solid fa-bullseye"></i></span> <strong><?php esc_html_e( 'Public cible :', 'waicam' ); ?></strong> <?php echo esc_html( $public_cible ); ?></p>
				<?php endif; ?>

				<?php if ( $activites ) : ?>
					<h4 class="prog-list-title"><?php esc_html_e( 'Activités proposées', 'waicam' ); ?></h4>
					<div class="programme-tags">
						<?php foreach ( $activites as $tag ) : ?>
							<span class="prog-tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-primary"><?php esc_html_e( 'Participer au programme', 'waicam' ); ?></a>
			</div>

		</div>
	</div>
</section>
<?php
		$index++;
	endwhile;
	wp_reset_postdata();
else :
	// Si aucun programme dans le CPT (ne devrait pas arriver vu que 4 sont créés) → message admin
?>
<section>
	<div style="max-width:700px;margin:0 auto;text-align:center;color:var(--gray);">
		<p><?php esc_html_e( 'Aucun programme à afficher pour le moment.', 'waicam' ); ?></p>
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
