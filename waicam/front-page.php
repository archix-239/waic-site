<?php
/**
 * Page d'accueil — Front page WAI-CAM
 *
 * @package WAICAM
 */

get_header(); ?>

<!-- ========== HERO ========== -->
<section class="hero">
	<canvas id="particles-canvas" style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;z-index:1;"></canvas>
	<div class="hero-content">
		<div class="hero-badge">
			<span class="dot"></span>
			<?php echo esc_html( get_theme_mod( 'waicam_hero_badge', __( 'Mouvement citoyen · Cameroun', 'waicam' ) ) ); ?>
		</div>
		<h1><?php echo wp_kses_post( get_theme_mod( 'waicam_hero_title', __( "L'IA pour <span>toutes</span>,<br>l'avenir entre nos mains", 'waicam' ) ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'waicam_hero_text', __( "Women in AI Cameroon démocratise l'intelligence artificielle pour chaque femme camerounaise, quel que soit son âge, son métier ou son niveau d'éducation.", 'waicam' ) ) ); ?></p>
		<div class="hero-cta">
			<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-primary">
				<i class="fa-solid fa-wand-magic-sparkles"></i> <?php esc_html_e( 'Rejoindre le mouvement', 'waicam' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn-outline">
				▶ <?php esc_html_e( 'Découvrir WAI-CAM', 'waicam' ); ?>
			</a>
		</div>
		<div class="hero-stats">
			<div class="stat-item">
				<div class="num"><?php echo esc_html( get_theme_mod( 'waicam_stat_1_num', '500+' ) ); ?></div>
				<div class="lbl"><?php echo esc_html( get_theme_mod( 'waicam_stat_1_lbl', __( 'Ambassadrices', 'waicam' ) ) ); ?></div>
			</div>
			<div class="stat-item">
				<div class="num"><?php echo esc_html( get_theme_mod( 'waicam_stat_2_num', '1M' ) ); ?></div>
				<div class="lbl"><?php echo esc_html( get_theme_mod( 'waicam_stat_2_lbl', __( "Femmes visées d'ici 2030", 'waicam' ) ) ); ?></div>
			</div>
			<div class="stat-item">
				<div class="num"><?php echo esc_html( get_theme_mod( 'waicam_stat_3_num', '10' ) ); ?></div>
				<div class="lbl"><?php echo esc_html( get_theme_mod( 'waicam_stat_3_lbl', __( 'Régions couvertes', 'waicam' ) ) ); ?></div>
			</div>
		</div>
	</div>
	<div class="hero-image-wrap">
		<?php
		$hero_image = get_theme_mod( 'waicam_hero_image' );
		if ( $hero_image ) {
			echo '<img src="' . esc_url( $hero_image ) . '" alt="" />';
		} else {
			echo '<img src="' . esc_url( waicam_img( 'hero-women.jpg' ) ) . '" alt="' . esc_attr__( 'Women in AI Cameroon', 'waicam' ) . '" />';
		}
		?>
		<div class="floating-card card-1">
			<span class="icon"><i class="fa-solid fa-graduation-cap"></i></span>
			<div>
				<strong><?php esc_html_e( 'Formation IA', 'waicam' ); ?></strong><br>
				<small><?php echo esc_html( get_theme_mod( 'waicam_floating_1', '24 Jan 2026 · Yaoundé' ) ); ?></small>
			</div>
		</div>
		<div class="floating-card card-2">
			<span class="icon"><i class="fa-solid fa-earth-africa"></i></span>
			<div>
				<strong><?php esc_html_e( '10 régions', 'waicam' ); ?></strong><br>
				<small><?php esc_html_e( 'Présence nationale', 'waicam' ); ?></small>
			</div>
		</div>
	</div>
</section>

<!-- ========== MISSION RAPIDE ========== -->
<section class="mission-strip">
	<div class="mission-grid">
		<?php
		$mission_items = array(
			array( '<i class="fa-solid fa-bullseye"></i>', __( 'Notre Vision', 'waicam' ), __( "Un Cameroun où chaque femme comprend et utilise l'IA pour entreprendre, apprendre et décider.", 'waicam' ) ),
			array( '<i class="fa-regular fa-lightbulb"></i>', __( 'Notre Mission', 'waicam' ), __( "Promouvoir une IA inclusive, éthique et participative au service du développement durable et du leadership féminin.", 'waicam' ) ),
			array( '<i class="fa-solid fa-handshake"></i>', __( 'Notre Approche', 'waicam' ), __( "Des femmes qui forment et inspirent d'autres femmes, à la croisée du numérique, de l'éducation et de l'entrepreneuriat.", 'waicam' ) ),
			array( '<i class="fa-solid fa-seedling"></i>', __( 'Notre Impact', 'waicam' ), __( "Réduire la fracture numérique de genre et faire du Cameroun un modèle d'inclusion numérique en Afrique.", 'waicam' ) ),
		);
		foreach ( $mission_items as $m ) :
		?>
			<div class="mission-card">
				<div class="mission-icon"><?php echo wp_kses_post( $m[0] ); ?></div>
				<div>
					<h3><?php echo esc_html( $m[1] ); ?></h3>
					<p><?php echo esc_html( $m[2] ); ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- ========== PROGRAMMES ========== -->
<section class="programs-bg">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Nos Programmes', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Quatre programmes <span>structurants</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Pour concrétiser sa vision, WAI-CAM déploie des programmes adaptés à chaque profil de femme.", 'waicam' ); ?></p>
	</div>

	<div class="programs-grid" style="max-width:1100px;margin:0 auto;">
		<?php
		$query = waicam_get_programmes( 4 );
		if ( $query ) :
			while ( $query->have_posts() ) : $query->the_post();
				$nom_prog  = waicam_field( 'nom_programme', get_the_ID(), get_the_title() );
				$accroche  = waicam_field( 'accroche_courte' );
				$activites = waicam_field( 'activites' );
				$couleur   = waicam_programme_color( $nom_prog );
				$icone     = waicam_programme_icone( $nom_prog );
		?>
			<div class="program-card <?php echo esc_attr( $couleur ); ?>">
				<div class="prog-icon"><?php echo wp_kses_post( $icone ); ?></div>
				<h3><?php echo esc_html( $nom_prog ); ?></h3>
				<p><?php echo esc_html( waicam_excerpt( $accroche, 140 ) ); ?></p>
				<?php if ( $activites ) : ?>
					<div class="prog-tags">
						<?php
						$tags = array_filter( array_map( 'trim', explode( ',', $activites ) ) );
						$tags = array_slice( $tags, 0, 3 ); // max 3 tags
						foreach ( $tags as $tag ) : ?>
							<span class="prog-tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			// ────────── Fallback statique si CPT vide ──────────
			$programmes_default = array(
				array( 'c1', '<i class="fa-solid fa-rocket"></i>', 'YOUTH & AI', "Sensibiliser les jeunes à l'IA et encourager la création d'emplois dans le numérique.", array( 'Masterclasses', 'Bootcamps', 'Mentorat' ) ),
				array( 'c2', '<i class="fa-solid fa-landmark"></i>', 'IA & PUBLIC SERVICE', "Accompagner les femmes du secteur public à utiliser l'IA pour améliorer leurs performances.", array( 'Ateliers', 'Kits numériques', 'Formations' ) ),
				array( 'c3', '<i class="fa-solid fa-crown"></i>', 'WOMEN LEADERS FOR AI', "Former des ambassadrices régionales au leadership numérique et à la vulgarisation de l'IA.", array( 'Leadership', 'Storytelling', 'Plaidoyer' ) ),
				array( 'c4', '<i class="fa-solid fa-leaf"></i>', 'AI FOR COMMUNITIES', "Développer des micro-projets locaux où l'IA répond à des besoins concrets des communautés.", array( 'Santé maternelle', 'Agriculture', 'Éducation' ) ),
			);
			foreach ( $programmes_default as $p ) :
		?>
			<div class="program-card <?php echo esc_attr( $p[0] ); ?>">
				<div class="prog-icon"><?php echo wp_kses_post( $p[1] ); ?></div>
				<h3><?php echo esc_html( $p[2] ); ?></h3>
				<p><?php echo esc_html( $p[3] ); ?></p>
				<div class="prog-tags">
					<?php foreach ( $p[4] as $tag ) : ?>
						<span class="prog-tag"><?php echo esc_html( $tag ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php
			endforeach;
		endif;
		?>
	</div>

	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( home_url( '/programmes' ) ); ?>" class="btn-primary" style="display:inline-flex;background:linear-gradient(135deg,var(--primary),var(--accent));color:white;">
			<?php esc_html_e( 'Voir tous les programmes →', 'waicam' ); ?>
		</a>
	</div>
</section>

<!-- ========== COMPTEURS ========== -->
<section class="counters-section">
	<div class="counters-grid" style="max-width:1000px;margin:0 auto;">
		<?php
		$counters = array(
			array( 500,   '+', __( 'Ambassadrices formées', 'waicam' ) ),
			array( 50000, '',  __( 'Femmes sensibilisées', 'waicam' ) ),
			array( 10,    '',  __( 'Régions couvertes', 'waicam' ) ),
			array( 4,     '',  __( 'Programmes actifs', 'waicam' ) ),
			array( 70,    '%', __( "Femmes africaines sans accès au numérique", 'waicam' ) ),
		);
		foreach ( $counters as $c ) :
		?>
			<div class="counter-item">
				<span class="counter-num" data-target="<?php echo esc_attr( $c[0] ); ?>" data-suffix="<?php echo esc_attr( $c[1] ); ?>">0</span>
				<div class="counter-label"><?php echo esc_html( $c[2] ); ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- ========== HOMMAGE NELLY ========== -->
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
		<p style="margin-top:24px;font-size:.9rem;opacity:.8;line-height:1.7;">
			<?php esc_html_e( "Visionnaire dans le domaine de l'innovation et de l'inclusion financière, Nelly s'était illustrée par son engagement à démocratiser l'accès aux technologies et aux services numériques pour les populations africaines. Son implication et sa vision continueront d'inspirer nos actions en faveur d'une intelligence artificielle inclusive et humaine.", 'waicam' ); ?>
		</p>
	</div>
</section>

<!-- ========== ÉVÈNEMENTS À VENIR ========== -->
<section>
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Évènements', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Nos prochaines <span>actions</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Formations, conférences, ateliers : retrouvez les rendez-vous WAI-CAM.", 'waicam' ); ?></p>
	</div>

	<div class="news-grid" style="max-width:1100px;margin:0 auto;">
		<?php
		$evts = waicam_get_evenements( 3, 'a-venir' );
		if ( $evts ) :
			while ( $evts->have_posts() ) : $evts->the_post();
				$lieu = waicam_event_venue();
		?>
			<div class="news-card">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( waicam_event_image_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" /></a>
				<div class="news-card-body">
					<div class="news-date"><?php echo esc_html( waicam_event_date() ); ?><?php if ( $lieu ) echo ' · ' . esc_html( $lieu ); ?></div>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo esc_html( waicam_event_excerpt( get_the_ID(), 140 ) ); ?></p>
					<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'En savoir plus →', 'waicam' ); ?></a>
				</div>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			// ────────── Fallback statique (si Events Calendar pas configuré) ──────────
			$evts_default = array(
				array( 'training-1.jpg', '24 Janvier 2026',         "Session de formation IA pour femmes et jeunes à Yaoundé", "Comprendre l'IA sans jargon technique, découvrir des outils accessibles et identifier des usages concrets pour le quotidien professionnel." ),
				array( 'training-2.jpg', '15 Mai 2026',             "Masterclass IA & Entrepreneuriat Féminin",                "Une masterclass exclusive pour les femmes entrepreneures qui souhaitent intégrer l'IA dans leurs activités." ),
				array( 'conference.jpg', '12 Juillet 2026',         "Conférence nationale Femmes & IA 2026",                  "Le grand rendez-vous annuel de WAI-CAM à l'Hôtel Hilton de Yaoundé." ),
			);
			foreach ( $evts_default as $a ) :
		?>
			<div class="news-card">
				<img src="<?php echo esc_url( waicam_img( $a[0] ) ); ?>" alt="<?php echo esc_attr( $a[2] ); ?>" loading="lazy" />
				<div class="news-card-body">
					<div class="news-date"><?php echo esc_html( $a[1] ); ?></div>
					<h3><?php echo esc_html( $a[2] ); ?></h3>
					<p><?php echo esc_html( $a[3] ); ?></p>
					<a href="<?php echo esc_url( waicam_events_archive_url() ); ?>" class="read-more"><?php esc_html_e( 'En savoir plus →', 'waicam' ); ?></a>
				</div>
			</div>
		<?php
			endforeach;
		endif;
		?>
	</div>

	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( waicam_events_archive_url() ); ?>" class="btn-primary" style="display:inline-flex;background:linear-gradient(135deg,var(--primary),var(--accent));color:white;">
			<?php esc_html_e( 'Tous les évènements →', 'waicam' ); ?>
		</a>
	</div>
</section>

<!-- ========== TÉMOIGNAGES ========== -->
<?php
$temoignages = waicam_get_temoignages( 3 );
if ( $temoignages ) :
?>
<section style="background:var(--gray-light);">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Témoignages', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Elles & ils <span>témoignent</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Les voix de celles et ceux qui font WAI-CAM au quotidien.", 'waicam' ); ?></p>
	</div>
	<div class="testimonials-grid" style="max-width:1100px;margin:0 auto;">
		<?php
		while ( $temoignages->have_posts() ) : $temoignages->the_post();
			$nom      = waicam_field( 'nom_complet', get_the_ID(), get_the_title() );
			$role     = waicam_field( 'role__fonction' );
			$citation = waicam_field( 'citation' );
			$photo    = waicam_image_url( 'photo', get_the_ID(), 'medium', '' );
			$initiale = mb_strtoupper( mb_substr( $nom, 0, 1 ) );
		?>
			<div class="testimonial-card">
				<div class="testimonial-header">
					<?php if ( $photo ) : ?>
						<div class="testimonial-photo">
							<img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" />
						</div>
					<?php else : ?>
						<div class="testimonial-avatar"><?php echo esc_html( $initiale ); ?></div>
					<?php endif; ?>
					<div class="testimonial-author-info">
						<strong class="testimonial-author-name"><?php echo esc_html( $nom ); ?></strong>
						<?php if ( $role ) : ?>
							<span class="testimonial-author-role"><?php echo esc_html( $role ); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="testimonial-quote"><i class="fa-solid fa-quote-left"></i></div>
				<p class="testimonial-text"><?php echo esc_html( waicam_excerpt( $citation, 220 ) ); ?></p>
			</div>
		<?php
		endwhile;
		wp_reset_postdata();
		?>
	</div>
	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( home_url( '/temoignages' ) ); ?>" class="btn-primary" style="display:inline-flex;background:linear-gradient(135deg,var(--primary),var(--accent));color:white;">
			<?php esc_html_e( 'Tous les témoignages →', 'waicam' ); ?>
		</a>
	</div>
</section>
<?php endif; ?>

<!-- ========== APPEL PARTENARIAT ========== -->
<section style="background:var(--light);">
	<div style="max-width:900px;margin:0 auto;text-align:center;">
		<div class="section-tag"><?php esc_html_e( 'Partenariats', 'waicam' ); ?></div>
		<h2 class="section-title" style="margin-bottom:16px;"><?php echo wp_kses_post( __( 'Rejoignez le mouvement <span>ensemble</span>', 'waicam' ) ); ?></h2>
		<p style="color:var(--gray);margin-bottom:40px;font-size:1rem;">
			<?php esc_html_e( "WAI-CAM invite les institutions, entreprises, organisations de la société civile et médias à contribuer à une IA inclusive et accessible pour toutes les femmes camerounaises.", 'waicam' ); ?>
		</p>
		<div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( home_url( '/partenaires' ) ); ?>" class="btn-primary" style="background:linear-gradient(135deg,var(--primary),var(--accent));color:white;">
				<?php esc_html_e( 'Devenir partenaire', 'waicam' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-outline" style="border-color:var(--primary);color:var(--primary);">
				<?php esc_html_e( 'Nous contacter', 'waicam' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer();
