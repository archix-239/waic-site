<?php
/**
 * Template Name: WAI-CAM — Partenaires
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Partenariats & Collaboration', 'waicam' ),
	'subtitle' => __( "Rejoignez le mouvement et contribuez à une IA inclusive et accessible pour toutes les femmes camerounaises.", 'waicam' ),
	'crumb'    => __( 'Partenaires', 'waicam' ),
) );
?>

<!-- APPEL À PARTENARIAT -->
<section>
	<div style="max-width:1100px;margin:0 auto;">
		<div class="partner-intro">
			<div>
				<div class="section-tag" style="text-align:left;"><?php esc_html_e( 'Appel à partenariats', 'waicam' ); ?></div>
				<h2 class="section-title" style="text-align:left;margin-bottom:20px;"><?php echo wp_kses_post( __( "Ensemble, <span>construisons l'avenir</span>", 'waicam' ) ); ?></h2>
				<p><?php esc_html_e( "Women in AI Cameroon invite les institutions publiques et privées, les entreprises, les organisations de la société civile, les médias et les partenaires techniques à rejoindre le mouvement en faveur d'une intelligence artificielle inclusive et accessible.", 'waicam' ); ?></p>
				<p><?php esc_html_e( "Rejoindre Women in AI Cameroon, c'est participer à une dynamique collective qui place l'innovation au service de l'inclusion, de l'autonomisation et de l'avenir du Cameroun.", 'waicam' ); ?></p>
				<a href="#form-partenariat" class="btn-primary"><?php esc_html_e( 'Devenir partenaire', 'waicam' ); ?></a>
			</div>
			<div>
				<img src="<?php echo esc_url( waicam_img( 'ai-africa.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Partenariat IA Afrique', 'waicam' ); ?>" loading="lazy" />
			</div>
		</div>
	</div>
</section>

<!-- CONTRIBUTIONS -->
<section style="background:var(--gray-light);">
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Impact', 'waicam' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'En devenant partenaire, vous contribuez à…', 'waicam' ); ?></h2>
		</div>
		<div class="partner-benefits">
			<?php
			$benefits = array(
				array( '<i class="fa-solid fa-graduation-cap"></i>', __( 'Formation des femmes', 'waicam' ),         __( "La formation et l'autonomisation de milliers de femmes à travers le Cameroun.", 'waicam' ) ),
				array( '<i class="fa-solid fa-globe"></i>',          __( 'Réduction du fossé numérique', 'waicam' ), __( "La réduction de la fracture numérique de genre dans les zones urbaines et rurales.", 'waicam' ) ),
				array( '<i class="fa-solid fa-scale-balanced"></i>', __( 'IA éthique & africaine', 'waicam' ),       __( "La promotion d'une IA éthique, responsable et au service des valeurs africaines.", 'waicam' ) ),
				array( '<i class="fa-solid fa-rocket"></i>',         __( 'Innovation locale', 'waicam' ),            __( "Le développement de solutions IA adaptées aux réalités et besoins locaux.", 'waicam' ) ),
			);
			foreach ( $benefits as $b ) :
			?>
				<div class="benefit-card">
					<div class="b-icon"><?php echo wp_kses_post( $b[0] ); ?></div>
					<h3><?php echo esc_html( $b[1] ); ?></h3>
					<p><?php echo esc_html( $b[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- LOGOS PARTENAIRES (CPT) -->
<?php
$partenaires = waicam_get_partenaires( -1 );
if ( $partenaires ) :
?>
<section>
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Nos partenaires', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Ils nous <span>soutiennent</span>', 'waicam' ) ); ?></h2>
		</div>
		<div class="partners-logo-grid">
			<?php while ( $partenaires->have_posts() ) : $partenaires->the_post();
				$nom         = waicam_field( 'nom_du_partenaire', get_the_ID(), get_the_title() );
				$type        = waicam_field( 'type_de_partenariat' );
				$lien        = waicam_field( 'site_web', get_the_ID(), '#' );
				$description = waicam_field( 'description_du_partenariat' );
			?>
				<a href="<?php echo esc_url( $lien ); ?>" target="_blank" rel="noopener" class="partner-logo-item" title="<?php echo esc_attr( $description ); ?>">
					<?php
					$logo_url = waicam_image_url( 'logo', get_the_ID(), 'medium', 'logo-waicam.png' );
					?>
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" />
					<span><?php echo esc_html( $nom ); ?></span>
					<?php if ( $type ) : ?>
						<small class="partner-type"><?php echo esc_html( $type ); ?></small>
					<?php endif; ?>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>

<!-- BÉNÉFICES PARTENAIRES -->
<section>
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Avantages', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Ce que vous <span>gagnez</span>', 'waicam' ) ); ?></h2>
		</div>
		<div class="partner-perks">
			<div class="perk-card perk-card--violet">
				<div class="perk-icon"><i class="fa-solid fa-earth-africa"></i></div>
				<h3><?php esc_html_e( 'Visibilité nationale & internationale', 'waicam' ); ?></h3>
				<p><?php esc_html_e( 'Votre marque associée à un mouvement citoyen reconnu au Cameroun et dans la diaspora africaine mondiale.', 'waicam' ); ?></p>
			</div>
			<div class="perk-card perk-card--orange">
				<div class="perk-icon"><i class="fa-solid fa-users"></i></div>
				<h3><?php esc_html_e( 'Réseau de femmes leaders', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Accès privilégié à un réseau de femmes leaders du numérique, ambassadrices et professionnelles engagées.", 'waicam' ); ?></p>
			</div>
			<div class="perk-card perk-card--green">
				<div class="perk-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
				<h3><?php esc_html_e( 'Impact social mesurable', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Contribution directe à l'impact social de l'IA inclusive avec des rapports d'impact réguliers.", 'waicam' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- NIVEAUX DE PARTENARIAT -->
<section style="background:var(--gray-light);">
	<div style="max-width:1000px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Niveaux de partenariat', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Choisissez votre <span>engagement</span>', 'waicam' ) ); ?></h2>
		</div>
		<div class="tier-grid">
			<div class="tier-card tier-card--bronze">
				<div class="tier-icon"><i class="fa-solid fa-medal" style="color:#CD7F32"></i></div>
				<h3><?php esc_html_e( 'Partenaire Bronze', 'waicam' ); ?></h3>
				<div class="tier-level"><?php esc_html_e( 'Soutien', 'waicam' ); ?></div>
				<p class="tier-desc"><?php esc_html_e( 'Contribution de base', 'waicam' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Logo sur le site web', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Mention dans les rapports', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Invitation aux événements', 'waicam' ); ?></li>
				</ul>
				<a href="#form-partenariat" class="tier-cta"><?php esc_html_e( 'Choisir ce niveau', 'waicam' ); ?></a>
			</div>
			<div class="tier-card tier-card--silver tier-card--featured">
				<div class="tier-badge"><?php esc_html_e( 'POPULAIRE', 'waicam' ); ?></div>
				<div class="tier-icon"><i class="fa-solid fa-medal" style="color:#C0C0C0"></i></div>
				<h3><?php esc_html_e( 'Partenaire Silver', 'waicam' ); ?></h3>
				<div class="tier-level"><?php esc_html_e( 'Engagement', 'waicam' ); ?></div>
				<p class="tier-desc"><?php esc_html_e( 'Partenariat actif', 'waicam' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Tout le niveau Bronze', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Co-branding sur les formations', 'waicam' ); ?></li>
					<li><?php esc_html_e( "Accès au réseau d'ambassadrices", 'waicam' ); ?></li>
					<li><?php esc_html_e( "Rapport d'impact semestriel", 'waicam' ); ?></li>
				</ul>
				<a href="#form-partenariat" class="tier-cta tier-cta--primary"><?php esc_html_e( 'Choisir ce niveau', 'waicam' ); ?></a>
			</div>
			<div class="tier-card tier-card--gold">
				<div class="tier-icon"><i class="fa-solid fa-medal" style="color:#FFD700"></i></div>
				<h3><?php esc_html_e( 'Partenaire Gold', 'waicam' ); ?></h3>
				<div class="tier-level"><?php esc_html_e( 'Stratégique', 'waicam' ); ?></div>
				<p class="tier-desc"><?php esc_html_e( 'Partenariat premium', 'waicam' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Tout le niveau Silver', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Siège au comité consultatif', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Co-création de programmes', 'waicam' ); ?></li>
					<li><?php esc_html_e( 'Communications dédiées', 'waicam' ); ?></li>
				</ul>
				<a href="#form-partenariat" class="tier-cta"><?php esc_html_e( 'Choisir ce niveau', 'waicam' ); ?></a>
			</div>
		</div>
	</div>
</section>

<!-- FORMULAIRE PARTENARIAT -->
<section id="form-partenariat">
	<div style="max-width:700px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Devenir partenaire', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( "Demande de <span>partenariat</span>", 'waicam' ) ); ?></h2>
		</div>
		<div class="form-card">
			<?php
			$ff_id = get_theme_mod( 'waicam_form_partenariat', '' );
			if ( $ff_id ) {
				echo do_shortcode( '[fluentform id="' . esc_attr( $ff_id ) . '"]' );
			} else {
				echo '<p style="text-align:center;color:var(--gray);padding:24px;">';
				esc_html_e( 'Formulaire à connecter dans Apparence → Personnaliser → WAI-CAM → ID du formulaire partenariat', 'waicam' );
				echo '</p>';
			}
			?>
		</div>
	</div>
</section>

<?php get_footer();
