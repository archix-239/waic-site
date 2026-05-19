<?php
/**
 * Template Name: WAI-CAM — À propos
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'À propos de WAI-CAM', 'waicam' ),
	'subtitle' => __( "Un mouvement citoyen pour démocratiser l'intelligence artificielle au service de toutes les femmes camerounaises.", 'waicam' ),
	'crumb'    => __( 'À propos', 'waicam' ),
) );
?>

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
