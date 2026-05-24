<?php
/**
 * Template Name: WAI-CAM — À propos
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$about_hero_title = get_theme_mod( 'waicam_about_hero_title', __( "NOUS SOMMES EN MISSION POUR RENDRE L'IA ACCESSIBLE AUX FEMMES ET AUX JEUNES DU CAMEROUN.", 'waicam' ) );
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
$about_intro_text = get_theme_mod( 'waicam_about_intro_text', __( "Nous développons des parcours d'apprentissage en IA qui rendent les compétences numériques accessibles aux femmes et aux jeunes, grâce à des programmes concrets, des ateliers terrain et un accompagnement durable.", 'waicam' ) );
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
		'number' => get_theme_mod( 'waicam_about_stat_1_number', '860 000' ),
		'label'  => get_theme_mod( 'waicam_about_stat_1_label', 'PERSONNES TOUCHÉES' ),
		'text'   => get_theme_mod( 'waicam_about_stat_1_text', "WAI-CAM a déjà sensibilisé et accompagné des milliers de femmes et de jeunes à travers ses actions communautaires, éducatives et citoyennes." ),
	),
	array(
		'number' => get_theme_mod( 'waicam_about_stat_2_number', '425 000' ),
		'label'  => get_theme_mod( 'waicam_about_stat_2_label', 'ALUMNI & COMMUNAUTÉ' ),
		'text'   => get_theme_mod( 'waicam_about_stat_2_text', "Une communauté active d'apprenantes, d'enseignantes, d'ambassadrices et de partenaires qui relaient l'adoption responsable de l'IA." ),
	),
	array(
		'number' => get_theme_mod( 'waicam_about_stat_3_number', '10 000' ),
		'label'  => get_theme_mod( 'waicam_about_stat_3_label', 'APPRENANTES IA' ),
		'text'   => get_theme_mod( 'waicam_about_stat_3_text', "Des participantes formées aux bases de l'IA, de la culture numérique et des usages concrets dans l'éducation, l'entrepreneuriat et la vie quotidienne." ),
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
$about_gap_text  = get_theme_mod( 'waicam_about_gap_text', "Au Cameroun comme ailleurs, les femmes restent sous-représentées dans les filières technologiques. WAI-CAM agit en priorité auprès des adolescentes et jeunes femmes pour renforcer l'accès, la confiance et les compétences en intelligence artificielle." );
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
$about_change_text  = get_theme_mod( 'waicam_about_change_text', "Nous mobilisons les femmes et les jeunes à travers des formations, du mentorat et des actions communautaires pour accélérer une adoption inclusive de l'intelligence artificielle au Cameroun." );
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

<!-- PRÉSENTATION -->
<section>
	<div class="about-grid" style="max-width:1100px;margin:0 auto;">
		<div class="about-img-wrap">
			<img src="<?php echo esc_url( waicam_img( 'african-women-ai.webp' ) ); ?>" alt="<?php esc_attr_e( 'Femmes africaines et IA', 'waicam' ); ?>" />
			<div class="about-img-badge">
				<span class="big">2025</span>
				<span class="small"><?php esc_html_e( 'Année de fondation', 'waicam' ); ?></span>
			</div>
		</div>
		<div class="about-content">
			<div class="section-tag"><?php esc_html_e( 'Notre Histoire', 'waicam' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Qui sommes-nous ?', 'waicam' ); ?></h2>
			<p><?php echo wp_kses_post( __( "Women in AI Cameroon (WAI-CAM) est un <strong>mouvement citoyen</strong> qui vise à démystifier l'intelligence artificielle et à la rendre accessible à toutes les femmes, quel que soit leur âge, leur métier ou leur niveau d'éducation.", 'waicam' ) ); ?></p>
			<p><?php echo wp_kses_post( __( "Son ambition : <strong>démocratiser l'IA au Cameroun</strong>, en la rendant accessible, utile et humaine. Le mouvement agit à la croisée du numérique, de l'éducation et de l'entrepreneuriat féminin.", 'waicam' ) ); ?></p>
			<div class="about-quote">
				<?php esc_html_e( "« Quand une femme comprend l'IA, c'est toute une communauté qui apprend à rêver différemment. »", 'waicam' ); ?>
			</div>
			<div class="pillars">
				<div class="pillar-chip"><span class="pi"><i class="fa-solid fa-lock-open"></i></span> <?php esc_html_e( 'Accessibilité', 'waicam' ); ?></div>
				<div class="pillar-chip"><span class="pi"><i class="fa-solid fa-handshake"></i></span> <?php esc_html_e( 'Solidarité', 'waicam' ); ?></div>
				<div class="pillar-chip"><span class="pi"><i class="fa-solid fa-crown"></i></span> <?php esc_html_e( 'Leadership', 'waicam' ); ?></div>
				<div class="pillar-chip"><span class="pi"><i class="fa-solid fa-scale-balanced"></i></span> <?php esc_html_e( 'Éthique', 'waicam' ); ?></div>
				<div class="pillar-chip"><span class="pi"><i class="fa-solid fa-earth-africa"></i></span> <?php esc_html_e( 'Inclusion', 'waicam' ); ?></div>
			</div>
		</div>
	</div>
</section>

<!-- VISION & MISSION -->
<section class="vision-mission-section">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Vision & Mission', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Ce qui nous <span>guide</span>', 'waicam' ) ); ?></h2>
	</div>
	<div class="vm-grid">
		<div class="vm-card vm-card--vision">
			<div class="vm-icon"><i class="fa-solid fa-bullseye"></i></div>
			<h3><?php esc_html_e( 'Notre Vision', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Un Cameroun où chaque femme, du Nord au Sud, de l'Est à l'Ouest, comprend comment l'IA influence son quotidien et sait l'utiliser pour entreprendre, apprendre et décider.", 'waicam' ); ?></p>
		</div>
		<div class="vm-card vm-card--mission">
			<div class="vm-icon"><i class="fa-regular fa-lightbulb"></i></div>
			<h3><?php esc_html_e( 'Notre Mission', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Promouvoir une intelligence artificielle inclusive, éthique et participative au service du développement durable et du leadership féminin au Cameroun et en Afrique.", 'waicam' ); ?></p>
		</div>
	</div>
</section>

<!-- ÉDITO PRÉSIDENTE -->
<section>
	<div style="max-width:900px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Mot de la Présidente', 'waicam' ); ?></div>
			<h2 class="section-title">Armelle <span>FOSSO</span></h2>
		</div>
		<div class="president-block">
			<div class="president-avatar">
				<div class="avatar-circle">A</div>
				<div class="avatar-name">Armelle FOSSO</div>
				<div class="avatar-role"><?php esc_html_e( 'Présidente, WAI-CAM', 'waicam' ); ?></div>
			</div>
			<div class="president-content">
				<div class="president-quote">
					<p><?php esc_html_e( '"L\'intelligence artificielle n\'est pas qu\'une affaire de technologie. C\'est une aventure humaine et sociale."', 'waicam' ); ?></p>
				</div>
				<p><?php esc_html_e( "Aujourd'hui, les femmes africaines doivent être au centre de cette révolution. En lançant Women in AI Cameroon, nous voulons créer un mouvement citoyen où chaque femme comprend l'impact de l'IA dans sa vie et apprend à s'en servir comme un levier d'autonomie et de leadership.", 'waicam' ); ?></p>
				<p><?php echo wp_kses_post( __( "Selon l'UNESCO, près de <strong>70 % des femmes africaines</strong> n'ont pas encore accès à une formation de base sur les outils numériques, encore moins dans les outils liés à l'IA. Au Cameroun, notre ambition est d'inverser cette tendance.", 'waicam' ) ); ?></p>
				<p><?php esc_html_e( "Ensemble, faisons du Cameroun un modèle d'inclusion numérique et d'innovation responsable.", 'waicam' ); ?></p>
			</div>
		</div>
	</div>
</section>

<!-- ODD -->
<section class="odd-bg">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Alignement Stratégique', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Objectifs de Développement <span>Durable</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "WAI-CAM s'inscrit dans les ODD des Nations Unies et la Stratégie Nationale de l'IA du Cameroun (SNIA 2025).", 'waicam' ); ?></p>
	</div>
	<div class="odd-grid" style="max-width:1000px;margin:0 auto;">
		<div class="odd-card o4">
			<div class="odd-num">4</div>
			<div>
				<h3><?php esc_html_e( 'Éducation de qualité', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Sensibilisation, formation et renforcement des capacités des femmes et des jeunes aux outils numériques et à l'IA.", 'waicam' ); ?></p>
			</div>
		</div>
		<div class="odd-card o5">
			<div class="odd-num">5</div>
			<div>
				<h3><?php esc_html_e( 'Égalité entre les sexes', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Favoriser l'autonomisation des femmes, leur accès aux technologies et à l'économie numérique.", 'waicam' ); ?></p>
			</div>
		</div>
		<div class="odd-card o9">
			<div class="odd-num">9</div>
			<div>
				<h3><?php esc_html_e( 'Innovation & Infrastructures', 'waicam' ); ?></h3>
				<p><?php esc_html_e( "Encourager l'innovation responsable, l'entrepreneuriat numérique et l'adoption de solutions technologiques.", 'waicam' ); ?></p>
			</div>
		</div>
	</div>

	<!-- SNIA -->
	<div class="snia-block">
		<div class="snia-flag">🇨🇲</div>
		<div>
			<h3><?php esc_html_e( "Stratégie Nationale de l'IA du Cameroun (SNIA 2025)", 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Les actions de WAI-CAM s'inscrivent pleinement dans la vision portée par la SNIA 2025, qui ambitionne de faire du Cameroun, à l'horizon 2040, un hub africain de référence en intelligence artificielle.", 'waicam' ); ?></p>
			<div class="snia-quote">
				<p><?php esc_html_e( '"Le Cameroun ne doit pas être un simple consommateur de technologies importées. Cette stratégie est un cadre d\'action pour que l\'IA serve notre développement, nos valeurs et notre jeunesse."', 'waicam' ); ?></p>
				<p class="snia-author"><?php esc_html_e( '— Mme Minette Libom Li Likeng, MINPOSTEL', 'waicam' ); ?></p>
			</div>
		</div>
	</div>
</section>

<?php get_footer();
