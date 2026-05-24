<?php
/**
 * Template Name: WAI-CAM — Équipe
 *
 * Cette page utilise le CPT "temoignage" (qui contient les 18 membres de WAI-CAM).
 * - La Présidente est mise en avant dans une carte HERO (gradient, grande taille).
 * - Les autres membres sont affichés en grille classique en dessous.
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$team_hero_kicker = get_theme_mod( 'waicam_team_hero_kicker', 'NOTRE ÉQUIPE' );
$team_hero_title  = get_theme_mod( 'waicam_team_hero_title', "RENCONTREZ L'ÉQUIPE QUI FAIT AVANCER WAI-CAM" );
$team_hero_cta_text = get_theme_mod( 'waicam_team_hero_cta_text', 'Envie de rejoindre l’équipe ? Découvrir les opportunités' );
$team_hero_cta_url  = get_theme_mod( 'waicam_team_hero_cta_url', home_url( '/rejoindre/' ) );
?>
<section class="team-hero-gwc">
	<div class="team-hero-gwc__bg-shape" aria-hidden="true"></div>
	<div class="team-hero-gwc__inner">
		<div class="team-hero-gwc__kicker"><?php echo esc_html( $team_hero_kicker ); ?></div>
		<h1 class="team-hero-gwc__title"><?php echo esc_html( $team_hero_title ); ?></h1>
		<a class="team-hero-gwc__cta" href="<?php echo esc_url( $team_hero_cta_url ); ?>">
			<?php echo esc_html( $team_hero_cta_text ); ?>
			<span class="arrow-anim" aria-hidden="true">
				<span class="arrow-plain">→</span>
				<svg class="arrow-wave" viewBox="0 0 30 12" focusable="false" aria-hidden="true">
					<path d="M1 6 C6 2,10 10,14 6 C18 2,22 10,26 6 M22 3 L28 6 L22 9"/>
				</svg>
			</span>
		</a>
	</div>
</section>

<?php
$equipe = waicam_get_temoignages( -1 );

// Séparer la Présidente du reste
$presidente_id = null;
$autres_ids    = array();

if ( $equipe ) {
	while ( $equipe->have_posts() ) {
		$equipe->the_post();
		$role = waicam_field( 'role__fonction' );
		// On considère "Présidente" / "Président" / "President" / "PRESIDENTE"
		// Comparaison robuste : on retire les accents et on met en minuscules
		$role_normalise = $role ? strtolower( remove_accents( $role ) ) : '';
		if ( $role_normalise && strpos( $role_normalise, 'presiden' ) !== false && ! $presidente_id ) {
			$presidente_id = get_the_ID();
		} else {
			$autres_ids[] = get_the_ID();
		}
	}
	wp_reset_postdata();
}
?>

<?php if ( $presidente_id ) :
	$p_nom      = waicam_field( 'nom_complet', $presidente_id, get_the_title( $presidente_id ) );
	$p_role     = waicam_field( 'role__fonction', $presidente_id );
	$p_profil   = waicam_field( 'profil_professionnel', $presidente_id );
	$p_photo    = waicam_image_url( 'photo', $presidente_id, 'large', '' );
	$p_initiale = mb_strtoupper( mb_substr( $p_nom, 0, 1 ) );
?>
<!-- ============================================
     CARTE PRÉSIDENTE (HERO)
     ============================================ -->
<section class="presidente-section">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Présidence', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'À la tête du <span>mouvement</span>', 'waicam' ) ); ?></h2>
	</div>

	<article class="presidente-card">
		<div class="presidente-card-photo">
			<?php if ( $p_photo ) : ?>
				<img src="<?php echo esc_url( $p_photo ); ?>" alt="<?php echo esc_attr( $p_nom ); ?>" loading="lazy" />
			<?php else : ?>
				<div class="presidente-card-avatar"><?php echo esc_html( $p_initiale ); ?></div>
			<?php endif; ?>
			<div class="presidente-card-badge">
				<i class="fa-solid fa-crown"></i> <?php echo esc_html( $p_role ?: __( 'Présidente', 'waicam' ) ); ?>
			</div>
		</div>
		<div class="presidente-card-body">
			<h3 class="presidente-card-name"><?php echo esc_html( $p_nom ); ?></h3>

			<?php if ( $p_profil ) : ?>
				<p class="presidente-card-profil"><?php echo esc_html( $p_profil ); ?></p>
			<?php endif; ?>
		</div>
	</article>
</section>
<?php endif; ?>

<?php if ( ! empty( $autres_ids ) ) : ?>
<!-- ============================================
     RESTE DE L'ÉQUIPE
     ============================================ -->
<section style="background:var(--gray-light);">
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Bureau & équipes', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Les visages du <span>mouvement</span>', 'waicam' ) ); ?></h2>
		</div>

		<div class="team-grid">
			<?php foreach ( $autres_ids as $member_id ) :
				$nom    = waicam_field( 'nom_complet', $member_id, get_the_title( $member_id ) );
				$role   = waicam_field( 'role__fonction', $member_id );
				$profil = waicam_field( 'profil_professionnel', $member_id );
				$photo  = waicam_image_url( 'photo', $member_id, 'medium', '' );
				$initiale = mb_strtoupper( mb_substr( $nom, 0, 1 ) );
			?>
				<div class="team-card">
					<?php if ( $photo ) : ?>
						<div class="team-photo">
							<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" />
						</div>
					<?php else : ?>
						<div class="team-avatar"><?php echo esc_html( $initiale ); ?></div>
					<?php endif; ?>

					<h3><?php echo esc_html( $nom ); ?></h3>

					<?php if ( $role ) : ?>
						<div class="role"><?php echo esc_html( $role ); ?></div>
					<?php endif; ?>

					<?php if ( $profil ) : ?>
						<p class="profil"><?php echo esc_html( $profil ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php if ( ! $presidente_id && empty( $autres_ids ) ) : ?>
<section>
	<div style="max-width:700px;margin:0 auto;text-align:center;color:var(--gray);">
		<p><?php esc_html_e( 'Les profils de notre équipe seront publiés très prochainement.', 'waicam' ); ?></p>
	</div>
</section>
<?php endif; ?>

<!-- HOMMAGE NELLY -->
<section class="tribute-section">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'In Memoriam', 'waicam' ); ?></div>
		<h2 class="section-title"><?php esc_html_e( 'Hommage à Nelly Chatue-Diop', 'waicam' ); ?></h2>
	</div>
	<div class="tribute-card" style="max-width:780px;margin:0 auto;">
		<div class="quote-icon"><i class="fa-solid fa-quote-left"></i></div>
		<blockquote>
			<?php esc_html_e( '"Toutes les grandes révolutions technologiques nous sont passées sous le nez. Pas question, cette fois, que les Africains ratent le train !"', 'waicam' ); ?>
		</blockquote>
		<div class="author">Nelly Chatue-Diop</div>
		<div class="author-role"><?php esc_html_e( 'Responsable Antenne Littoral / Sud-Ouest · Visionnaire en fintech & blockchain · (†8 janvier 2026)', 'waicam' ); ?></div>
	</div>
</section>

<!-- CTA REJOINDRE -->
<section style="background:var(--light);">
	<div style="max-width:780px;margin:0 auto;text-align:center;">
		<div class="section-tag"><?php esc_html_e( 'Rejoindre', 'waicam' ); ?></div>
		<h2 class="section-title" style="margin-bottom:16px;"><?php echo wp_kses_post( __( 'Vous aussi, faites partie du <span>mouvement</span>', 'waicam' ) ); ?></h2>
		<p style="color:var(--gray);margin-bottom:32px;">
			<?php esc_html_e( "Membre actif, ambassadrice régionale, bénévole ou mentor : il y a une place pour vous au sein de WAI-CAM.", 'waicam' ); ?>
		</p>
		<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-primary" style="background:linear-gradient(135deg,var(--primary),var(--accent));color:white;">
			<?php esc_html_e( 'Rejoindre le mouvement', 'waicam' ); ?>
		</a>
	</div>
</section>

<?php get_footer();
