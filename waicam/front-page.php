<?php
/**
 * Page d'accueil — Front page WAI-CAM
 *
 * @package WAICAM
 */

get_header(); ?>

<!-- ========== HERO ========== -->
<section class="hero" id="hero">

	<!-- Diaporama de fond (3 slides) -->
	<div class="hero-slides">
		<div class="hero-slide active" style="background-image:url('<?php echo esc_url( waicam_img( 'hero-terrain.jpg' ) ); ?>')"></div>
		<div class="hero-slide" style="background-image:url('<?php echo esc_url( waicam_img( 'hero-musee.jpg' ) ); ?>')"></div>
		<div class="hero-slide" style="background-image:url('<?php echo esc_url( waicam_img( 'hero-dargala.jpg' ) ); ?>')"></div>
	</div>

	<!-- Overlay sombre -->
	<div class="hero-overlay"></div>

	<!-- Contenu principal -->
	<div class="hero-content">
		<h1><?php echo wp_kses_post( get_theme_mod( 'waicam_hero_title', __( "Nous sommes<br><span>Women in AI Cameroon</span>", 'waicam' ) ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'waicam_hero_text', __( "Women in AI Cameroon autonomise, soutient et élève les femmes dans le domaine de l'intelligence artificielle. Un mouvement citoyen où chaque femme peut trouver des opportunités, partager ses idées et diriger sa communauté.", 'waicam' ) ) ); ?></p>
		<div class="hero-cta">
			<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-hero-primary">
				<?php esc_html_e( 'Rejoindre le mouvement', 'waicam' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn-hero-outline">
				<?php esc_html_e( 'Découvrir WAI-CAM', 'waicam' ); ?>
			</a>
		</div>
	</div>

	<!-- Indicateurs de slide -->
	<div class="hero-dots" id="hero-dots">
		<button class="hero-dot active" data-slide="0" aria-label="Slide 1"></button>
		<button class="hero-dot" data-slide="1" aria-label="Slide 2"></button>
		<button class="hero-dot" data-slide="2" aria-label="Slide 3"></button>
	</div>

</section>

<!-- ========== HOME — SECTION POST-HERO (STYLE INSTITUTIONNEL) ========== -->
	<section class="home-posthero-gwc">
		<div class="home-posthero-inner">
				<div class="home-posthero-top">
					<?php
					$posthero_img_id  = absint( get_theme_mod( 'waicam_home_posthero_media_id', 0 ) );
					$posthero_img_url = $posthero_img_id ? wp_get_attachment_image_url( $posthero_img_id, 'large' ) : '';
					$posthero_img_alt = $posthero_img_id ? get_post_meta( $posthero_img_id, '_wp_attachment_image_alt', true ) : '';
					?>
					<div class="home-posthero-media<?php echo $posthero_img_url ? ' has-image' : ''; ?>">
						<?php if ( $posthero_img_url ) : ?>
							<img src="<?php echo esc_url( $posthero_img_url ); ?>" alt="<?php echo esc_attr( $posthero_img_alt ?: 'Visuel de section' ); ?>" loading="lazy" />
						<?php endif; ?>
					</div>
					<div class="home-posthero-highlight">
					<h2><?php echo esc_html( get_theme_mod( 'waicam_home_posthero_title', '5 MILLIONS D’ICI 2030' ) ); ?></h2>
					<svg class="home-posthero-wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
						<path d="M0 8 Q8 0 16 8 T32 8 T48 8 T64 8 T80 8 T96 8 T112 8 T128 8 T144 8 T160 8 T176 8 T192 8 T208 8 T224 8 T240 8 T256 8 T272 8 T288 8 T304 8 T320 8"></path>
					</svg>
					<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_posthero_cta_url', home_url( '/about' ) ) ); ?>" class="home-posthero-link">
						<?php echo esc_html( get_theme_mod( 'waicam_home_posthero_cta_text', 'En savoir plus sur notre plan stratégique' ) ); ?>
						<span class="arrow-anim" aria-hidden="true">
							<span class="arrow-plain">→</span>
							<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
								<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
								<path d="M69 4 L77 8 L69 12"></path>
							</svg>
						</span>
					</a>
				</div>
			</div>

		<div class="home-posthero-cards">
			<?php
			$cards = array(
				array(
					'badge' => 'AXE 01',
					'title' => get_theme_mod( 'waicam_home_axis_1_title', 'Former' ),
					'text'  => get_theme_mod( 'waicam_home_axis_1_text', 'Former les jeunes filles et femmes aux compétences numériques et à l’IA appliquée.' ),
					'url'   => get_theme_mod( 'waicam_home_axis_1_url', home_url( '/formations' ) ),
				),
				array(
					'badge' => 'AXE 02',
					'title' => get_theme_mod( 'waicam_home_axis_2_title', 'Accompagner' ),
					'text'  => get_theme_mod( 'waicam_home_axis_2_text', 'Accompagner les femmes vers des parcours concrets : leadership, entrepreneuriat et innovation.' ),
					'url'   => get_theme_mod( 'waicam_home_axis_2_url', home_url( '/programmes' ) ),
				),
			);
			foreach ( $cards as $card ) : ?>
				<article class="home-posthero-card">
					<div class="home-posthero-badge"><?php echo esc_html( $card['badge'] ); ?></div>
					<h3><?php echo esc_html( $card['title'] ); ?></h3>
					<p><?php echo esc_html( $card['text'] ); ?></p>
						<a href="<?php echo esc_url( $card['url'] ); ?>" class="home-posthero-link">
							En savoir plus
							<span class="arrow-anim" aria-hidden="true">
								<span class="arrow-plain">→</span>
								<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
									<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
									<path d="M69 4 L77 8 L69 12"></path>
								</svg>
							</span>
						</a>
					</article>
				<?php endforeach; ?>
			</div>
	</div>
</section>

<!-- ========== HOME — SECTION IMPACT (RÉFÉRENCE GWC) ========== -->
<section class="home-impact-gwc">
	<div class="home-impact-inner">
		<div class="home-impact-intro">
			<div class="home-impact-kicker"><?php echo esc_html( get_theme_mod( 'waicam_home_impact_kicker', 'INTELLIGENCE ARTIFICIELLE & INCLUSION' ) ); ?></div>
			<h2><?php echo esc_html( get_theme_mod( 'waicam_home_impact_title', 'BRISER LES BARRIÈRES À L’IA ET AUX TECHNOLOGIES ÉMERGENTES.' ) ); ?></h2>
			<svg class="home-impact-wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
				<path d="M0 8 Q8 0 16 8 T32 8 T48 8 T64 8 T80 8 T96 8 T112 8 T128 8 T144 8 T160 8 T176 8 T192 8 T208 8 T224 8 T240 8 T256 8 T272 8 T288 8 T304 8 T320 8"></path>
			</svg>
			<p><?php echo esc_html( get_theme_mod( 'waicam_home_impact_text', 'Women in AI Cameroon développe des parcours de formation, de sensibilisation et d’accompagnement pour permettre aux femmes et aux jeunes filles de participer pleinement à la révolution de l’intelligence artificielle.' ) ); ?></p>
				<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_impact_cta_url', waicam_events_archive_url() ) ); ?>" class="home-impact-link">
					<?php echo esc_html( get_theme_mod( 'waicam_home_impact_cta_text', 'Découvrir nos actions' ) ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
						<path d="M69 4 L77 8 L69 12"></path>
					</svg>
				</span>
			</a>
		</div>

		<div class="home-impact-stats">
			<?php
			$impact_stats = array(
				array(
					'number' => get_theme_mod( 'waicam_home_impact_stat_1_number', '860 000' ),
					'label'  => get_theme_mod( 'waicam_home_impact_stat_1_label', 'PERSONNES SENSIBILISÉES' ),
					'text'   => get_theme_mod( 'waicam_home_impact_stat_1_text', 'Des femmes et jeunes filles touchées par des campagnes de sensibilisation et des ateliers.' ),
				),
				array(
					'number' => get_theme_mod( 'waicam_home_impact_stat_2_number', '425 000' ),
					'label'  => get_theme_mod( 'waicam_home_impact_stat_2_label', 'COMMUNAUTÉ ENGAGÉE' ),
					'text'   => get_theme_mod( 'waicam_home_impact_stat_2_text', 'Une communauté active autour du mentorat, du leadership et de l’apprentissage collaboratif.' ),
				),
				array(
					'number' => get_theme_mod( 'waicam_home_impact_stat_3_number', '10 000' ),
					'label'  => get_theme_mod( 'waicam_home_impact_stat_3_label', 'APPRENANTES IA' ),
					'text'   => get_theme_mod( 'waicam_home_impact_stat_3_text', 'Des participantes formées sur des usages concrets de l’IA dans leurs secteurs.' ),
				),
			);
			foreach ( $impact_stats as $stat ) : ?>
				<article class="home-impact-stat">
					<div class="home-impact-stat-number"><?php echo esc_html( $stat['number'] ); ?></div>
					<h3><?php echo esc_html( $stat['label'] ); ?></h3>
					<p><?php echo esc_html( $stat['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ========== HOME — SECTION VIDÉO ========== -->
<section class="home-video-section">
	<?php
	$home_video_url   = trim( (string) get_theme_mod( 'waicam_home_video_url', '' ) );
	$home_video_title = get_theme_mod( 'waicam_home_video_title', 'Regards croisés sur nos actions terrain' );
	$home_video_text  = get_theme_mod( 'waicam_home_video_text', 'Découvrez nos initiatives, nos formations et nos témoignages en vidéo.' );
	$home_video_url_sanitized = esc_url_raw( $home_video_url );
	?>
	<div class="home-video-inner">
		<div class="home-video-head">
			<h2><?php echo esc_html( $home_video_title ); ?></h2>
			<p><?php echo esc_html( $home_video_text ); ?></p>
		</div>

		<div class="home-video-frame-wrap">
			<?php if ( $home_video_url ) :
				$embed_html = wp_oembed_get( $home_video_url_sanitized, array( 'width' => 1280 ) );
				if ( $embed_html ) : ?>
						<div class="home-video-embed">
							<?php echo $embed_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
				<?php
				else :
					$is_facebook_video_like = strpos( $home_video_url_sanitized, 'facebook.com' ) !== false
						|| strpos( $home_video_url_sanitized, 'fb.watch' ) !== false;

					if ( $is_facebook_video_like ) :
						$fb_embed = 'https://www.facebook.com/plugins/video.php?href='
							. rawurlencode( $home_video_url_sanitized )
							. '&show_text=false&width=1280'; ?>
							<div class="home-video-embed home-video-embed--facebook">
								<iframe
									src="<?php echo esc_url( $fb_embed ); ?>"
								width="1280"
								height="720"
								style="border:none;overflow:hidden"
								scrolling="no"
								frameborder="0"
								allowfullscreen="true"
								allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
							</iframe>
						</div>
					<?php else : ?>
						<div class="home-video-placeholder">
							<span><?php esc_html_e( 'Lien vidéo non reconnu. Vérifiez l’URL (YouTube / Vimeo / Facebook vidéo publique).', 'waicam' ); ?></span>
						</div>
					<?php endif; ?>
					<?php endif;
				else : ?>
				<div class="home-video-placeholder">
					<span><?php esc_html_e( 'Ajoutez un lien vidéo dans Apparence → Personnaliser → WAI-CAM → Accueil — Section vidéo.', 'waicam' ); ?></span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ========== HOME — INITIATIVE PHARE WAI-CAM ========== -->
<section class="home-featured-initiative">
	<div class="home-featured-initiative__inner">
		<?php
		$featured_img_id  = absint( get_theme_mod( 'waicam_home_featured_media_id', 0 ) );
		$featured_img_url = $featured_img_id ? wp_get_attachment_image_url( $featured_img_id, 'large' ) : '';
		$featured_img_alt = $featured_img_id ? get_post_meta( $featured_img_id, '_wp_attachment_image_alt', true ) : '';
		?>
		<div class="home-featured-initiative__media<?php echo $featured_img_url ? ' has-image' : ''; ?>">
			<?php if ( $featured_img_url ) : ?>
				<img src="<?php echo esc_url( $featured_img_url ); ?>" alt="<?php echo esc_attr( $featured_img_alt ?: 'Visuel initiative phare' ); ?>" loading="lazy" />
			<?php endif; ?>
		</div>

		<div class="home-featured-initiative__content">
			<div class="home-featured-initiative__kicker">
				<?php echo esc_html( get_theme_mod( 'waicam_home_featured_kicker', 'INITIATIVE PHARE WAI-CAM' ) ); ?>
			</div>
			<h2><?php echo esc_html( get_theme_mod( 'waicam_home_featured_title', 'Nos actions terrain pour démocratiser l’IA au Cameroun' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'waicam_home_featured_text', 'Formations, ateliers, conférences et rencontres institutionnelles : WAI-CAM agit sur le terrain pour rendre l’intelligence artificielle accessible, inclusive et utile aux femmes et aux jeunes filles.' ) ); ?></p>
			<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_featured_cta_url', waicam_events_archive_url() ) ); ?>" class="home-featured-initiative__link">
				<?php echo esc_html( get_theme_mod( 'waicam_home_featured_cta_text', 'Découvrir nos actualités' ) ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
						<path d="M69 4 L77 8 L69 12"></path>
					</svg>
				</span>
			</a>
		</div>
	</div>
</section>

<!-- ========== HOME — NEWSLETTER (RÉFÉRENCE GWC) ========== -->
<section class="home-newsletter-gwc">
	<div class="home-newsletter-gwc__inner">
		<div class="home-newsletter-gwc__content">
			<h2><?php echo esc_html( get_theme_mod( 'waicam_home_newsletter_title', 'Restez informé(e) de nos actualités' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'waicam_home_newsletter_text', 'Recevez les mises à jour sur nos formations, événements, ressources et actions de terrain portées par Women in AI Cameroon.' ) ); ?></p>
		</div>
		<div class="home-newsletter-gwc__form">
			<?php
			$newsletter_form_id = absint( get_theme_mod( 'waicam_form_newsletter', 0 ) );
			if ( $newsletter_form_id ) {
				echo do_shortcode( '[fluentform id="' . $newsletter_form_id . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				?>
				<div class="home-newsletter-gwc__placeholder">
					<?php esc_html_e( 'Configurez le formulaire newsletter dans Apparence → Personnaliser → WAI-CAM → Formulaires Fluent Forms.', 'waicam' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<svg class="home-newsletter-gwc__wave-divider" viewBox="0 0 1440 28" preserveAspectRatio="none" aria-hidden="true" focusable="false">
		<path d="M0 14 Q10 2 20 14 T40 14 T60 14 T80 14 T100 14 T120 14 T140 14 T160 14 T180 14 T200 14 T220 14 T240 14 T260 14 T280 14 T300 14 T320 14 T340 14 T360 14 T380 14 T400 14 T420 14 T440 14 T460 14 T480 14 T500 14 T520 14 T540 14 T560 14 T580 14 T600 14 T620 14 T640 14 T660 14 T680 14 T700 14 T720 14 T740 14 T760 14 T780 14 T800 14 T820 14 T840 14 T860 14 T880 14 T900 14 T920 14 T940 14 T960 14 T980 14 T1000 14 T1020 14 T1040 14 T1060 14 T1080 14 T1100 14 T1120 14 T1140 14 T1160 14 T1180 14 T1200 14 T1220 14 T1240 14 T1260 14 T1280 14 T1300 14 T1320 14 T1340 14 T1360 14 T1380 14 T1400 14 T1420 14 T1440 14"></path>
	</svg>
</section>

<!-- ========== HOME — TÉMOIGNAGE CADRÉ (RÉFÉRENCE GWC) ========== -->
<section class="home-quote-gwc">
	<div class="home-quote-gwc__frame">
		<div class="home-quote-gwc__wave-desktop" aria-hidden="true">
			<img src="<?php echo esc_url( waicam_img( 'profile-cta-wave.svg' ) ); ?>" alt="" loading="lazy" />
		</div>
		<div class="home-quote-gwc__panel">
			<blockquote class="home-quote-gwc__text">
				<?php echo esc_html( get_theme_mod( 'waicam_home_quote_text', 'Women in AI Cameroon a changé ma trajectoire professionnelle en me donnant les outils, la confiance et la communauté nécessaires pour agir concrètement.' ) ); ?>
			</blockquote>
			<p class="home-quote-gwc__meta">
				<span class="home-quote-gwc__meta-wave" aria-hidden="true">~</span>
				<?php echo esc_html( get_theme_mod( 'waicam_home_quote_author', 'MEMBRE WAI-CAM' ) ); ?>,
				<?php echo esc_html( get_theme_mod( 'waicam_home_quote_role', 'Programme Leadership & Mentorat' ) ); ?>
			</p>
		</div>
		<?php
		$quote_img_id  = absint( get_theme_mod( 'waicam_home_quote_media_id', 0 ) );
		$quote_img_url = $quote_img_id ? wp_get_attachment_image_url( $quote_img_id, 'large' ) : '';
		$quote_img_alt = $quote_img_id ? get_post_meta( $quote_img_id, '_wp_attachment_image_alt', true ) : '';
		?>
		<div class="home-quote-gwc__media<?php echo $quote_img_url ? ' has-image' : ''; ?>">
			<?php if ( $quote_img_url ) : ?>
				<img src="<?php echo esc_url( $quote_img_url ); ?>" alt="<?php echo esc_attr( $quote_img_alt ?: 'Portrait témoignage WAI-CAM' ); ?>" loading="lazy" />
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ========== HOME — GRAND CHIFFRE + CTA (RÉFÉRENCE GWC) ========== -->
<section class="home-bigstat-gwc">
	<div class="home-bigstat-gwc__inner">
		<h2><?php echo esc_html( get_theme_mod( 'waicam_home_bigstat_title', '860 000 femmes et jeunes touchées par nos actions au Cameroun' ) ); ?></h2>
		<div class="home-bigstat-gwc__bottom">
			<p><?php echo esc_html( get_theme_mod( 'waicam_home_bigstat_text', 'WAI-CAM accélère l’inclusion numérique des femmes grâce à des programmes de formation, de mentorat et d’accompagnement sur le terrain.' ) ); ?></p>
			<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_bigstat_cta_url', home_url( '/don' ) ) ); ?>" class="home-bigstat-gwc__cta">
				<?php echo esc_html( get_theme_mod( 'waicam_home_bigstat_cta_text', 'Soutenir nos actions' ) ); ?>
			</a>
		</div>
	</div>
	<svg class="home-bigstat-gwc__wave-divider" viewBox="0 0 1440 28" preserveAspectRatio="none" aria-hidden="true" focusable="false">
		<path d="M0 14 Q10 2 20 14 T40 14 T60 14 T80 14 T100 14 T120 14 T140 14 T160 14 T180 14 T200 14 T220 14 T240 14 T260 14 T280 14 T300 14 T320 14 T340 14 T360 14 T380 14 T400 14 T420 14 T440 14 T460 14 T480 14 T500 14 T520 14 T540 14 T560 14 T580 14 T600 14 T620 14 T640 14 T660 14 T680 14 T700 14 T720 14 T740 14 T760 14 T780 14 T800 14 T820 14 T840 14 T860 14 T880 14 T900 14 T920 14 T940 14 T960 14 T980 14 T1000 14 T1020 14 T1040 14 T1060 14 T1080 14 T1100 14 T1120 14 T1140 14 T1160 14 T1180 14 T1200 14 T1220 14 T1240 14 T1260 14 T1280 14 T1300 14 T1320 14 T1340 14 T1360 14 T1380 14 T1400 14 T1420 14 T1440 14"></path>
	</svg>
</section>

<!-- ========== HOME — ACTUALITÉS (RÉFÉRENCE GWC) ========== -->
<section class="home-news-grid-gwc">
	<div class="home-news-grid-gwc__inner">
		<div class="home-news-grid-gwc__kicker"><?php echo esc_html( get_theme_mod( 'waicam_home_news_kicker', 'ACTUALITÉS' ) ); ?></div>
		<h2><?php echo esc_html( get_theme_mod( 'waicam_home_news_title', 'Restez connectés à nos actions' ) ); ?></h2>
		<svg class="home-news-grid-gwc__title-wave" viewBox="0 0 320 16" role="presentation" aria-hidden="true" focusable="false">
			<path d="M0 8 Q8 0 16 8 T32 8 T48 8 T64 8 T80 8 T96 8 T112 8 T128 8 T144 8 T160 8 T176 8 T192 8 T208 8 T224 8 T240 8 T256 8 T272 8 T288 8 T304 8 T320 8"></path>
		</svg>

		<div class="home-news-grid-gwc__cards">
			<?php
			$news_query = new WP_Query( array(
				'post_type'      => array( 'post', 'evenement' ),
				'posts_per_page' => 3,
				'post_status'    => 'publish',
			) );
			if ( $news_query->have_posts() ) :
				while ( $news_query->have_posts() ) :
					$news_query->the_post();
					$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					?>
					<article class="home-news-grid-gwc__card">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="home-news-grid-gwc__card-media<?php echo $thumb_url ? ' has-image' : ''; ?>">
							<?php if ( $thumb_url ) : ?>
								<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" />
							<?php endif; ?>
						</div>
					</article>
				<?php
				endwhile;
				wp_reset_postdata();
			else :
				for ( $i = 0; $i < 3; $i++ ) : ?>
					<article class="home-news-grid-gwc__card">
						<h3><?php esc_html_e( 'Titre actualité à venir', 'waicam' ); ?></h3>
						<div class="home-news-grid-gwc__card-media"></div>
					</article>
				<?php endfor;
			endif;
			?>
		</div>

		<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_news_cta_url', home_url( '/blog' ) ) ); ?>" class="home-news-grid-gwc__cta">
			<?php echo esc_html( get_theme_mod( 'waicam_home_news_cta_text', 'Voir toutes nos actualités' ) ); ?>
			<span class="arrow-anim" aria-hidden="true">
				<span class="arrow-plain">→</span>
				<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
					<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
					<path d="M69 4 L77 8 L69 12"></path>
				</svg>
			</span>
		</a>
	</div>
</section>

<!-- ========== HOME — PARTENAIRES (RÉFÉRENCE GWC) ========== -->
<section class="home-partners-gwc">
	<div class="home-partners-gwc__inner">
		<div class="home-partners-gwc__content">
			<h2><?php echo esc_html( get_theme_mod( 'waicam_home_partners_title', 'Devenez partenaire Women in AI Cameroon' ) ); ?></h2>
			<p><?php echo esc_html( get_theme_mod( 'waicam_home_partners_text', 'Chaque année, des entreprises et institutions soutiennent nos programmes de formation, mentorat et inclusion numérique au Cameroun.' ) ); ?></p>
		</div>
		<div class="home-partners-gwc__logos">
			<?php
			$partners = waicam_get_partenaires( 6 );
			if ( $partners ) :
				while ( $partners->have_posts() ) :
					$partners->the_post();
					$logo = '';
					if ( has_post_thumbnail( get_the_ID() ) ) {
						$logo = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
					}
					if ( ! $logo ) {
						$logo = waicam_image_url( 'logo_partenaire', get_the_ID(), 'medium', '' );
						if ( ! $logo || strpos( $logo, '/assets/images/' ) !== false ) {
							$logo = '';
						}
					}
					?>
					<div class="home-partners-gwc__logo-item">
						<?php if ( $logo ) : ?>
							<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" />
						<?php else : ?>
							<span><?php the_title(); ?></span>
						<?php endif; ?>
					</div>
				<?php
				endwhile;
				wp_reset_postdata();
			else :
				$fallbacks = array( 'MINPOSTEL', 'UNESCO', 'SENADI', 'ONU Femmes', 'CNPS', 'Vision 4' );
				foreach ( $fallbacks as $f ) : ?>
					<div class="home-partners-gwc__logo-item"><span><?php echo esc_html( $f ); ?></span></div>
				<?php endforeach;
			endif;
			?>
			<a href="<?php echo esc_url( get_theme_mod( 'waicam_home_partners_cta_url', home_url( '/partenaires' ) ) ); ?>" class="home-partners-gwc__cta">
				<?php echo esc_html( get_theme_mod( 'waicam_home_partners_cta_text', 'Voir nos partenaires' ) ); ?>
				<span class="arrow-anim" aria-hidden="true">
					<span class="arrow-plain">→</span>
					<svg class="arrow-wave" viewBox="0 0 96 16" focusable="false" role="presentation" aria-hidden="true">
						<path d="M1 8 Q7 2 13 8 T25 8 T37 8 T49 8 T61 8 T73 8"></path>
						<path d="M69 4 L77 8 L69 12"></path>
					</svg>
				</span>
			</a>
		</div>
	</div>
</section>

<!-- Icônes réseaux sociaux — fixes au scroll -->
<div class="social-float" id="social-float">
	<a href="<?php echo esc_url( get_theme_mod( 'waicam_social_linkedin', '#' ) ); ?>"
	   class="social-float-btn social-float-linkedin"
	   title="LinkedIn" target="_blank" rel="noopener noreferrer">
		<img src="<?php echo esc_url( waicam_img( 'logo-linkedin.webp' ) ); ?>" alt="LinkedIn" width="26" height="26" />
	</a>
	<a href="<?php echo esc_url( get_theme_mod( 'waicam_social_twitter', '#' ) ); ?>"
	   class="social-float-btn social-float-x"
	   title="Twitter / X" target="_blank" rel="noopener noreferrer">
		<img src="<?php echo esc_url( waicam_img( 'logo-twitter.webp' ) ); ?>" alt="Twitter / X" width="26" height="26" />
	</a>
	<a href="<?php echo esc_url( get_theme_mod( 'waicam_social_facebook', '#' ) ); ?>"
	   class="social-float-btn social-float-fb"
	   title="Facebook" target="_blank" rel="noopener noreferrer">
		<img src="<?php echo esc_url( waicam_img( 'logo-facebook.webp' ) ); ?>" alt="Facebook" width="26" height="26" />
	</a>
</div>

<!-- ========== BANDE MISSION ========== -->
<section class="mission-strip">
	<div class="mission-grid">
		<?php
		$mission_items = array(
			array( '🎯', __( 'Notre Vision', 'waicam' ),   __( "Un Cameroun où chaque femme comprend et utilise l'IA pour entreprendre, apprendre et décider.", 'waicam' ) ),
			array( '💡', __( 'Notre Mission', 'waicam' ),  __( "Promouvoir une IA inclusive, éthique et participative au service du développement durable et du leadership féminin.", 'waicam' ) ),
			array( '🤝', __( 'Notre Approche', 'waicam' ), __( "Des femmes qui forment et inspirent d'autres femmes, à la croisée du numérique, de l'éducation et de l'entrepreneuriat.", 'waicam' ) ),
			array( '🌱', __( 'Notre Impact', 'waicam' ),   __( "Réduire la fracture numérique de genre et faire du Cameroun un modèle d'inclusion numérique en Afrique.", 'waicam' ) ),
		);
		foreach ( $mission_items as $m ) : ?>
			<div class="mission-card">
				<div class="mission-icon"><?php echo esc_html( $m[0] ); ?></div>
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
						<?php foreach ( array_slice( array_filter( array_map( 'trim', explode( ',', $activites ) ) ), 0, 3 ) as $tag ) : ?>
							<span class="prog-tag"><?php echo esc_html( $tag ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php
			endwhile;
			wp_reset_postdata();
		else :
			$programmes_default = array(
				array( 'c1', '🚀', 'Youth & AI',            "Sensibiliser les jeunes à l'IA et encourager la création d'emplois dans le numérique.",          array( 'Masterclasses', 'Bootcamps', 'Mentorat' ) ),
				array( 'c2', '🏛️', 'IA & Service Public',   "Accompagner les femmes du secteur public à utiliser l'IA pour améliorer leurs performances.",     array( 'Ateliers', 'Kits numériques', 'Formations' ) ),
				array( 'c3', '👑', 'Women Leaders for AI',  "Former des ambassadrices régionales au leadership numérique et à la vulgarisation de l'IA.",       array( 'Leadership', 'Storytelling', 'Plaidoyer' ) ),
				array( 'c4', '🌿', 'AI for Communities',    "Développer des micro-projets locaux où l'IA répond à des besoins concrets des communautés.",       array( 'Santé maternelle', 'Agriculture', 'Éducation' ) ),
			);
			foreach ( $programmes_default as $p ) : ?>
			<div class="program-card <?php echo esc_attr( $p[0] ); ?>">
				<div class="prog-icon"><?php echo esc_html( $p[1] ); ?></div>
				<h3><?php echo esc_html( $p[2] ); ?></h3>
				<p><?php echo esc_html( $p[3] ); ?></p>
				<div class="prog-tags">
					<?php foreach ( $p[4] as $tag ) : ?>
						<span class="prog-tag"><?php echo esc_html( $tag ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>

	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( home_url( '/programmes' ) ); ?>" class="btn-primary">
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
			array( 70,    '%', __( 'Femmes africaines sans accès au numérique', 'waicam' ) ),
		);
		foreach ( $counters as $c ) : ?>
			<div class="counter-item">
				<span class="counter-num" data-target="<?php echo esc_attr( $c[0] ); ?>" data-suffix="<?php echo esc_attr( $c[1] ); ?>">0</span>
				<div class="counter-label"><?php echo esc_html( $c[2] ); ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- ========== ACTIONS RÉCENTES ========== -->
<section>
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Actualités', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Nos actions <span>récentes</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Formations, conférences, ateliers : les derniers rendez-vous WAI-CAM sur le terrain.", 'waicam' ); ?></p>
	</div>

	<div class="news-grid" style="max-width:1100px;margin:0 auto;">
		<?php
		$evts = waicam_get_evenements( 3, 'a-venir' );
		if ( $evts && $evts->have_posts() ) :
			while ( $evts->have_posts() ) : $evts->the_post();
				$lieu = waicam_event_venue();
		?>
			<div class="news-card">
				<a href="<?php the_permalink(); ?>">
					<img src="<?php echo esc_url( waicam_event_image_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
				</a>
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
			$evts_default = array(
				array( 'training-1.jpg', '24 Janvier 2026',   'Session de formation IA — Yaoundé',          "Comprendre l'IA sans jargon technique, découvrir des outils accessibles et identifier des usages concrets." ),
				array( 'training-2.jpg', '9 Février 2026',    'Dargala s\'éveille à l\'IA — Extrême-Nord',  "Sous le patronage du Sous-Préfet de Dargala, WAI-CAM forme la jeunesse de l'Extrême-Nord." ),
				array( 'conference.jpg', 'Fête Jeunesse 2026', 'La jeunesse au cœur des espérances numériques', "WAI-CAM organise des formations IA en phase avec les enjeux d'innovation et d'emploi." ),
			);
			foreach ( $evts_default as $a ) : ?>
			<div class="news-card">
				<img src="<?php echo esc_url( waicam_img( $a[0] ) ); ?>" alt="<?php echo esc_attr( $a[2] ); ?>" loading="lazy" />
				<div class="news-card-body">
					<div class="news-date"><?php echo esc_html( $a[1] ); ?></div>
					<h3><?php echo esc_html( $a[2] ); ?></h3>
					<p><?php echo esc_html( $a[3] ); ?></p>
					<a href="<?php echo esc_url( waicam_events_archive_url() ); ?>" class="read-more"><?php esc_html_e( 'En savoir plus →', 'waicam' ); ?></a>
				</div>
			</div>
		<?php endforeach; endif; ?>
	</div>

	<div style="text-align:center;margin-top:40px;">
		<a href="<?php echo esc_url( waicam_events_archive_url() ); ?>" class="btn-primary">
			<?php esc_html_e( 'Toutes les actualités →', 'waicam' ); ?>
		</a>
	</div>
</section>

<!-- ========== PARTENAIRES ========== -->
<section class="partners-strip" style="background:var(--gray-light);">
	<div style="max-width:1100px;margin:0 auto;">
		<div class="section-header">
			<div class="section-tag"><?php esc_html_e( 'Partenaires & Soutiens', 'waicam' ); ?></div>
			<h2 class="section-title"><?php echo wp_kses_post( __( 'Ils nous font <span>confiance</span>', 'waicam' ) ); ?></h2>
		</div>
		<!-- Bandeau logos partenaires -->
		<div class="partners-logos">
			<?php
			$partners = array(
				'MINPOSTEL', 'UNESCO', 'ONU Femmes', 'SENADI',
				'CNPS', 'Vision 4', 'CJC', 'UDM',
				'MINPROFF', 'MINJEC', 'JFN',
			);
			foreach ( $partners as $p ) : ?>
				<div class="partner-logo-placeholder">
					<span><?php echo esc_html( $p ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
		<div style="text-align:center;margin-top:36px;">
			<a href="<?php echo esc_url( home_url( '/partenaires' ) ); ?>" class="btn-primary">
				<?php esc_html_e( 'Devenir partenaire →', 'waicam' ); ?>
			</a>
		</div>
	</div>
</section>

<!-- ========== TÉMOIGNAGES ========== -->
<?php $temoignages = waicam_get_temoignages( 3 ); if ( $temoignages && $temoignages->have_posts() ) : ?>
<section>
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Témoignages', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Elles <span>témoignent</span>', 'waicam' ) ); ?></h2>
	</div>
	<div class="testimonials-grid" style="max-width:1100px;margin:0 auto;">
		<?php while ( $temoignages->have_posts() ) : $temoignages->the_post();
			$nom      = waicam_field( 'nom_complet', get_the_ID(), get_the_title() );
			$role     = waicam_field( 'role__fonction' );
			$citation = waicam_field( 'citation' );
			$photo    = waicam_image_url( 'photo', get_the_ID(), 'medium', '' );
			$initiale = mb_strtoupper( mb_substr( $nom, 0, 1 ) );
		?>
			<div class="testimonial-card">
				<div class="testimonial-header">
					<?php if ( $photo ) : ?>
						<div class="testimonial-photo"><img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" /></div>
					<?php else : ?>
						<div class="testimonial-avatar"><?php echo esc_html( $initiale ); ?></div>
					<?php endif; ?>
					<div class="testimonial-author-info">
						<strong class="testimonial-author-name"><?php echo esc_html( $nom ); ?></strong>
						<?php if ( $role ) : ?><span class="testimonial-author-role"><?php echo esc_html( $role ); ?></span><?php endif; ?>
					</div>
				</div>
				<p class="testimonial-text"><?php echo esc_html( waicam_excerpt( $citation, 220 ) ); ?></p>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>

<!-- ========== APPEL À L'ACTION FINAL ========== -->
<section class="cta-section">
	<div style="max-width:800px;margin:0 auto;text-align:center;">
		<h2 class="section-title" style="color:white;margin-bottom:16px;">
			<?php echo wp_kses_post( __( 'Rejoignez le mouvement <span style="color:var(--primary)">WAI-CAM</span>', 'waicam' ) ); ?>
		</h2>
		<p style="color:rgba(255,255,255,.85);margin-bottom:36px;font-size:1.05rem;">
			<?php esc_html_e( "WAI-CAM invite les institutions, entreprises et organisations à contribuer à une IA inclusive et accessible pour toutes les femmes camerounaises.", 'waicam' ); ?>
		</p>
		<div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( home_url( '/rejoindre' ) ); ?>" class="btn-hero-primary">
				<?php esc_html_e( 'Rejoindre le mouvement', 'waicam' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-hero-outline">
				<?php esc_html_e( 'Nous contacter', 'waicam' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer();
