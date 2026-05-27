<?php
/**
 * Template Name: WAI-CAM — À propos
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$about_hero_title = get_theme_mod( 'waicam_about_hero_title', __( "Women in AI Cameroon démocratise l'intelligence artificielle : comprendre, décider et innover.", 'waicam' ) );
$about_hero_image_id = (int) get_theme_mod( 'waicam_about_hero_image_id', 0 );
$about_hero_image = $about_hero_image_id ? wp_get_attachment_image_url( $about_hero_image_id, 'full' ) : '';
if ( ! $about_hero_image ) {
	$about_hero_image = waicam_img( 'african-women-ai.webp' );
}
?>

<section class="about-hero-gwc" style="--about-hero-bg:url('<?php echo esc_url( $about_hero_image ); ?>');"> 
	<div class="about-hero-gwc__overlay"></div>
	<div class="about-hero-gwc__inner">
		<h1><?php echo esc_html( $about_hero_title ); ?></h1>
	</div>
</section>


<?php
$about_intro_kicker = get_theme_mod( 'waicam_about_intro_kicker', __( 'IA ET TECHNOLOGIES ÉMERGENTES', 'waicam' ) );
$about_intro_title = get_theme_mod( 'waicam_about_intro_title', __( "BRISER LES BARRIÈRES À L'IA ET AUX TECHNOLOGIES ÉMERGENTES.", 'waicam' ) );
$about_intro_text = get_theme_mod( 'waicam_about_intro_text', __( "Nous menons des programmes de sensibilisation, de formation pratique et d'accompagnement pour que chaque femme comprenne, utilise et bénéficie des opportunités offertes par l'IA : emploi, entrepreneuriat et innovation locale.", 'waicam' ) );
?>

<section class="about-intro-gwc">
	<div class="about-intro-gwc__inner">
		<p class="about-intro-gwc__kicker"><?php echo esc_html( $about_intro_kicker ); ?></p>
		<h2 class="about-intro-gwc__title"><?php echo esc_html( $about_intro_title ); ?></h2>
		<svg class="about-intro-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
		<p class="about-intro-gwc__text"><?php echo esc_html( $about_intro_text ); ?></p>
	</div>
</section>


<?php
$about_stats = array(
	array(
		'number' => get_theme_mod( 'waicam_about_stat_1_number', '500' ),
		'label'  => get_theme_mod( 'waicam_about_stat_1_label', 'FORMATRICES RÉGIONALES' ),
		'text'   => get_theme_mod( 'waicam_about_stat_1_text', "Former 500 formatrices régionales pour multiplier l'impact local.", 'waicam' ),
	),
	array(
		'number' => get_theme_mod( 'waicam_about_stat_2_number', '50 000' ),
		'label'  => get_theme_mod( 'waicam_about_stat_2_label', 'FEMMES SENSIBILISÉES' ),
		'text'   => get_theme_mod( 'waicam_about_stat_2_text', "Sensibiliser 50 000 femmes aux usages et opportunités de l'IA d'ici 2030.", 'waicam' ),
	),
	array(
		'number' => get_theme_mod( 'waicam_about_stat_3_number', '1 M' ),
		'label'  => get_theme_mod( 'waicam_about_stat_3_label', 'BÉNÉFICIAIRES INDIRECTS' ),
		'text'   => get_theme_mod( 'waicam_about_stat_3_text', "Bénéficiaires directs et indirects à travers programmes et projets communautaires.", 'waicam' ),
	),
);
?>

<section class="about-impact-gwc">
	<div class="about-impact-gwc__inner">
		<div class="about-impact-gwc__grid">
			<?php foreach ( $about_stats as $stat ) : ?>
				<article class="about-impact-gwc__item">
					<h3 class="about-impact-gwc__number"><?php echo esc_html( $stat['number'] ); ?></h3>
					<p class="about-impact-gwc__label"><?php echo esc_html( $stat['label'] ); ?></p>
					<p class="about-impact-gwc__text"><?php echo esc_html( $stat['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>


<?php
$about_gap_title = get_theme_mod( 'waicam_about_gap_title', 'LA FRACTURE GENRE EN NUMÉRIQUE RESTE UN DÉFI MAJEUR.' );
$about_gap_text  = get_theme_mod( 'waicam_about_gap_text', "Au Cameroun, l'accès aux outils numériques et à l'IA est encore inégalitaire. WAI-CAM agit pour réduire cette fracture entre zones urbaines et rurales, femmes et jeunes filles.");
$about_gap_p1 = get_theme_mod( 'waicam_about_gap_p1', '37%' );
$about_gap_p2 = get_theme_mod( 'waicam_about_gap_p2', '24%' );
$about_gap_p3 = get_theme_mod( 'waicam_about_gap_p3', '22%' );
$about_gap_y1 = get_theme_mod( 'waicam_about_gap_y1', '1995' );
$about_gap_y2 = get_theme_mod( 'waicam_about_gap_y2', '2017' );
$about_gap_y3 = get_theme_mod( 'waicam_about_gap_y3', '2022' );
?>

<section class="about-gap-gwc">
	<div class="about-gap-gwc__inner">
		<h2 class="about-gap-gwc__title"><?php echo esc_html( $about_gap_title ); ?></h2>
		<svg class="about-gap-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
		<p class="about-gap-gwc__text"><?php echo esc_html( $about_gap_text ); ?></p>

		<div class="about-gap-gwc__chart" aria-label="Évolution de la représentation féminine">
			<div class="about-gap-gwc__point p1"><span><?php echo esc_html( $about_gap_p1 ); ?></span><i></i></div>
			<div class="about-gap-gwc__point p2"><span><?php echo esc_html( $about_gap_p2 ); ?></span><i></i></div>
			<div class="about-gap-gwc__point p3"><span><?php echo esc_html( $about_gap_p3 ); ?></span><i></i></div>
			<div class="about-gap-gwc__area" aria-hidden="true"></div>
			<div class="about-gap-gwc__axis-y">% Femmes en IA et numérique</div>
			<div class="about-gap-gwc__years">
				<span><?php echo esc_html( $about_gap_y1 ); ?></span>
				<span><?php echo esc_html( $about_gap_y2 ); ?></span>
				<span><?php echo esc_html( $about_gap_y3 ); ?></span>
			</div>
		</div>
	</div>
</section>


<?php
$about_change_title = get_theme_mod( 'waicam_about_change_title', 'WAI-CAM TRANSFORME LA DONNE' );
$about_change_text  = get_theme_mod( 'waicam_about_change_text', "Nous accompagnons des actions concrètes : masterclasses, ateliers, mentorat et projets communautaires pour une IA éthique et inclusive.");
$about_change_cta_title = get_theme_mod( 'waicam_about_change_cta_title', 'SOUTENEZ WAI-CAM' );
$about_change_cta_text  = get_theme_mod( 'waicam_about_change_cta_text', "Votre contribution nous aide à former, outiller et accompagner davantage de femmes et de jeunes dans les métiers du numérique et de l'IA." );
$about_change_cta_link_label = get_theme_mod( 'waicam_about_change_cta_link_label', 'Faire un don' );
$about_change_cta_link_url   = get_theme_mod( 'waicam_about_change_cta_link_url', home_url( '/faire-un-don/' ) );
?>

<section class="about-change-gwc">
	<div class="about-change-gwc__inner">
		<div class="about-change-gwc__content">
			<h2 class="about-change-gwc__title"><?php echo esc_html( $about_change_title ); ?></h2>
			<svg class="about-change-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
			</svg>
			<p class="about-change-gwc__text"><?php echo esc_html( $about_change_text ); ?></p>
		</div>
		<aside class="about-change-gwc__support">
			<h3><?php echo esc_html( $about_change_cta_title ); ?></h3>
			<p><?php echo esc_html( $about_change_cta_text ); ?></p>
			<a class="about-change-gwc__donate-link" href="<?php echo esc_url( $about_change_cta_link_url ); ?>">
				<?php echo esc_html( $about_change_cta_link_label ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 30 12" focusable="false" aria-hidden="true">
						<path d="M1 6 C6 2,10 10,14 6 C18 2,22 10,26 6 M22 3 L28 6 L22 9"/>
					</svg>
				</span>
			</a>
		</aside>
	</div>
</section>


<?php
$about_values_title = get_theme_mod( 'waicam_about_values_title', 'NOS VALEURS' );
$about_values_text  = get_theme_mod( 'waicam_about_values_text', "Ces valeurs définissent notre manière d'agir au quotidien." );
$about_values = array(
	array(
		'icon_id' => (int) get_theme_mod( 'waicam_about_value_1_icon_id', 0 ),
		'title'   => get_theme_mod( 'waicam_about_value_1_title', 'BRAVOURE' ),
		'text'    => get_theme_mod( 'waicam_about_value_1_text', "Nous avançons avec résilience, ambition et persévérance pour ouvrir plus d'opportunités." ),
	),
	array(
		'icon_id' => (int) get_theme_mod( 'waicam_about_value_2_icon_id', 0 ),
		'title'   => get_theme_mod( 'waicam_about_value_2_title', 'SORORITÉ' ),
		'text'    => get_theme_mod( 'waicam_about_value_2_text', "Nous croyons qu'une communauté diverse, solidaire et intergénérationnelle est plus forte." ),
	),
	array(
		'icon_id' => (int) get_theme_mod( 'waicam_about_value_3_icon_id', 0 ),
		'title'   => get_theme_mod( 'waicam_about_value_3_title', 'ENGAGEMENT' ),
		'text'    => get_theme_mod( 'waicam_about_value_3_text', "Nous préparons les femmes et les jeunes à transformer durablement leur environnement." ),
	),
);
?>
<section class="about-values-gwc">
	<div class="about-values-gwc__inner">
		<h2 class="about-values-gwc__title"><?php echo esc_html( $about_values_title ); ?></h2>
		<svg class="about-values-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>
		<p class="about-values-gwc__text"><?php echo esc_html( $about_values_text ); ?></p>
		<div class="about-values-gwc__grid">
			<?php foreach ( $about_values as $value ) :
				$icon_url = $value['icon_id'] ? wp_get_attachment_image_url( $value['icon_id'], 'medium' ) : '';
			?>
				<article class="about-values-gwc__item">
					<div class="about-values-gwc__icon<?php echo $icon_url ? ' has-image' : ''; ?>">
						<?php if ( $icon_url ) : ?>
							<img src="<?php echo esc_url( $icon_url ); ?>" alt="" loading="lazy" />
						<?php else : ?>
							<span>Icône</span>
						<?php endif; ?>
					</div>
					<h3><?php echo esc_html( $value['title'] ); ?></h3>
					<p><?php echo esc_html( $value['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>


<?php
$about_statement_title = get_theme_mod( 'waicam_about_statement_title', "WAI-CAM place l'inclusion, l'éthique et l'impact social au cœur de sa mission." );
$about_statement_cta_text = get_theme_mod( 'waicam_about_statement_cta_text', 'Lire notre déclaration d’inclusion' );
$about_statement_cta_url  = get_theme_mod( 'waicam_about_statement_cta_url', home_url( '/a-propos/' ) );
?>
<section class="about-statement-gwc">
	<div class="about-statement-gwc__inner">
		<h2><?php echo esc_html( $about_statement_title ); ?></h2>
		<a class="about-statement-gwc__cta" href="<?php echo esc_url( $about_statement_cta_url ); ?>">
			<?php echo esc_html( $about_statement_cta_text ); ?>
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
$about_reports_title = get_theme_mod( 'waicam_about_reports_title', 'ACTUALITÉS & ÉVÉNEMENTS' );
$reports_q = new WP_Query( array(
	'post_type'           => array( 'post', 'evenement' ),
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
) );
?>
<section class="about-reports-gwc">
	<div class="about-reports-gwc__inner">
		<h2 class="about-reports-gwc__title"><?php echo esc_html( $about_reports_title ); ?></h2>
		<svg class="about-reports-gwc__wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0,8 C6,2 14,14 22,8 C30,2 38,14 46,8 C54,2 62,14 70,8 C78,2 86,14 94,8 C102,2 110,14 118,8 C126,2 134,14 142,8 C150,2 158,14 166,8 C174,2 182,14 190,8 C198,2 206,14 214,8 C222,2 230,14 238,8 C246,2 254,14 262,8 C270,2 278,14 286,8 C294,2 302,14 310,8 C314,6 317,8 320,8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
		</svg>

		<div class="about-reports-gwc__grid">
			<?php if ( $reports_q->have_posts() ) : ?>
				<?php while ( $reports_q->have_posts() ) : $reports_q->the_post(); ?>
					<article class="about-reports-gwc__card">
						<a class="about-reports-gwc__thumb" href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy' ) ); ?>
							<?php else : ?>
								<span class="about-reports-gwc__ph"><?php esc_html_e( 'Image', 'waicam' ); ?></span>
							<?php endif; ?>
							<span class="about-reports-gwc__wavecut" aria-hidden="true"></span>
						</a>
						<div class="about-reports-gwc__year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></div>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Publiez des articles ou événements pour alimenter cette section.', 'waicam' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer();
