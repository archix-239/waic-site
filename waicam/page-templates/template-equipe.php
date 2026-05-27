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
$team_hero_title  = get_theme_mod( 'waicam_team_hero_title', "Des voix engagées pour une IA inclusive au Cameroun" );
$team_hero_cta_text = get_theme_mod( 'waicam_team_hero_cta_text', 'Envie de rejoindre l’équipe ? Découvrez les opportunités' );
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
$team_spotlight_kicker = get_theme_mod( 'waicam_team_spotlight_kicker', 'NOTRE PRÉSIDENCE' );
$team_spotlight_title  = get_theme_mod( 'waicam_team_spotlight_title', 'Leadership féminin pour une IA inclusive' );
$team_spotlight_text   = get_theme_mod( 'waicam_team_spotlight_text', "Portée par une présidence engagée, WAI‑CAM agit pour réduire les inégalités d'accès au numérique, renforcer les compétences des femmes et promouvoir une IA éthique au service du développement local.", 'waicam' );
$team_spotlight_cta_text = get_theme_mod( 'waicam_team_spotlight_cta_text', 'Découvrir notre gouvernance' );
$team_spotlight_cta_url  = get_theme_mod( 'waicam_team_spotlight_cta_url', home_url( '/about/' ) );
$team_spotlight_image_id = (int) get_theme_mod( 'waicam_team_spotlight_image_id', 0 );
$team_spotlight_image = $team_spotlight_image_id ? wp_get_attachment_image_url( $team_spotlight_image_id, 'large' ) : '';
?>
<section class="team-spotlight-gwc">
	<div class="team-spotlight-gwc__shape" aria-hidden="true"></div>
	<div class="team-spotlight-gwc__inner">
		<div class="team-spotlight-gwc__content">
			<h2 class="team-spotlight-gwc__title"><?php echo esc_html( $team_spotlight_kicker ); ?></h2>
			<svg class="team-spotlight-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
			<p class="team-spotlight-gwc__intro"><?php echo esc_html( $team_spotlight_title ); ?></p>
			<p class="team-spotlight-gwc__text"><?php echo esc_html( $team_spotlight_text ); ?></p>
			<a class="team-spotlight-gwc__cta" href="<?php echo esc_url( $team_spotlight_cta_url ); ?>">
				<?php echo esc_html( $team_spotlight_cta_text ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 30 12" focusable="false" aria-hidden="true">
						<path d="M1 6 C6 2,10 10,14 6 C18 2,22 10,26 6 M22 3 L28 6 L22 9"/>
					</svg>
				</span>
			</a>
		</div>
		<div class="team-spotlight-gwc__media<?php echo $team_spotlight_image ? ' has-image' : ''; ?>">
			<?php if ( $team_spotlight_image ) : ?>
				<img src="<?php echo esc_url( $team_spotlight_image ); ?>" alt="" loading="lazy" />
			<?php else : ?>
				<span><?php esc_html_e( 'Image présidence', 'waicam' ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</section>



<?php
$team_quote_text   = get_theme_mod( 'waicam_team_quote_text', "L’intelligence artificielle n’est pas qu’une affaire de technologie. C’est une aventure humaine et sociale." );
$team_quote_author = get_theme_mod( 'waicam_team_quote_author', 'Armelle Fosso — Présidente' );
?>
<section class="team-quote-gwc">
	<div class="team-quote-gwc__shape" aria-hidden="true"></div>
	<div class="team-quote-gwc__inner">
		<blockquote class="team-quote-gwc__text">“<?php echo esc_html( $team_quote_text ); ?>”</blockquote>
		<p class="team-quote-gwc__author">
			<span class="team-quote-gwc__author-wave" aria-hidden="true"></span>
			<?php echo esc_html( $team_quote_author ); ?>
		</p>
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


<?php if ( ! empty( $autres_ids ) ) : ?>
<?php
$groups = array(
	'presidence' => array( 'label' => 'PRÉSIDENCE', 'color' => 'neutral', 'items' => array() ),
	'projet_jeune' => array( 'label' => 'RESPONSABLE PROJET JEUNE', 'color' => 'cream', 'items' => array() ),
	'regionaux' => array( 'label' => 'RESPONSABLES RÉGIONAUX', 'color' => 'neutral', 'items' => array() ),
	'antenne' => array( 'label' => 'RESPONSABLES ANTENNE', 'color' => 'cream', 'items' => array() ),
	'leadership' => array( 'label' => 'LEADERSHIP & FONCTIONS SUPPORT', 'color' => 'neutral', 'items' => array() ),
);
foreach ( $autres_ids as $member_id ) {
	$role_raw = (string) waicam_field( 'role__fonction', $member_id );
	$role = strtolower( remove_accents( $role_raw ) );
	$key = 'leadership';
	if ( strpos( $role, 'presiden' ) !== false ) { $key = 'presidence'; }
	elseif ( strpos( $role, 'projet jeune' ) !== false ) { $key = 'projet_jeune'; }
	elseif ( strpos( $role, 'regional' ) !== false || strpos( $role, 'region' ) !== false ) { $key = 'regionaux'; }
	elseif ( strpos( $role, 'antenne' ) !== false ) { $key = 'antenne'; }
	$groups[$key]['items'][] = $member_id;
}
?>
<?php foreach ( $groups as $group_key => $group_cfg ) : if ( empty( $group_cfg['items'] ) ) { continue; } ?>
<section class="team-group-gwc team-group-gwc--<?php echo esc_attr( $group_cfg['color'] ); ?>">
	<div class="team-group-gwc__inner">
		<h2 class="team-group-gwc__title"><?php echo esc_html( $group_cfg['label'] ); ?></h2>
		<svg class="team-group-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
		<div class="team-grid team-grid--gwc">
			<?php foreach ( $group_cfg['items'] as $member_id ) :
				$nom    = waicam_field( 'nom_complet', $member_id, get_the_title( $member_id ) );
				$role   = waicam_field( 'role__fonction', $member_id );
				$profil = waicam_field( 'profil_professionnel', $member_id );
				$photo  = waicam_image_url( 'photo', $member_id, 'large', '' );
				$linkedin = '';
				// Utilisation d'une fonction helper dédiée pour LinkedIn
				$linkedin = waicam_get_linkedin_url( $member_id );

				$initiale = mb_strtoupper( mb_substr( $nom, 0, 1 ) );
			?>
			<div class="team-card team-card--gwc">
				<?php if ( $photo ) : ?>
					<div class="team-photo"><img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" /></div>
				<?php else : ?>
					<div class="team-avatar"><?php echo esc_html( $initiale ); ?></div>
				<?php endif; ?>
				<?php if ( $linkedin ) : ?>
					<a class="team-card--gwc__linkedin" href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn <?php echo esc_attr( $nom ); ?>">
						<i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
					</a>
				<?php endif; ?>
				<h3><?php echo esc_html( $nom ); ?></h3>
				<?php if ( $role ) : ?><div class="role"><?php echo esc_html( $role ); ?></div><?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endforeach; ?>
<?php endif; ?>


<?php if ( ! $presidente_id && empty( $autres_ids ) ) : ?>
<section>
	<div style="max-width:700px;margin:0 auto;text-align:center;color:var(--gray);">
		<p><?php esc_html_e( 'Les profils de notre équipe seront publiés très prochainement.', 'waicam' ); ?></p>
	</div>
</section>
<?php endif; ?>


<?php get_footer();
