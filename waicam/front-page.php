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
			$partners = new WP_Query( array(
				'post_type'      => 'partenaire',
				'posts_per_page' => 8,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
				'meta_query'     => array(
					'relation' => 'OR',
					array(
						'key'     => 'show_on_home',
						'value'   => '1',
						'compare' => '=',
					),
					array(
						'key'     => 'show_on_home',
						'value'   => 'true',
						'compare' => '=',
					),
					array(
						'key'     => 'show_on_home',
						'value'   => 'True',
						'compare' => '=',
					),
				),
			) );
			if ( $partners->have_posts() ) :
				while ( $partners->have_posts() ) :
					$partners->the_post();
					$logo = '';
					if ( has_post_thumbnail( get_the_ID() ) ) {
						$logo = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
					}
					if ( ! $logo ) {
						$logo = waicam_image_url( 'logo_partenaire', get_the_ID(), 'medium', '' );
						if ( ! $logo || strpos( $logo, '/assets/images/' ) !== false ) {
							$logo = waicam_image_url( 'logo', get_the_ID(), 'medium', '' );
						}
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
				if ( current_user_can( 'edit_theme_options' ) ) : ?>
					<div class="home-partners-gwc__empty">
						<?php esc_html_e( 'Aucun partenaire à afficher. Cochez “Afficher sur l’accueil” (show_on_home) sur les fiches partenaires concernées et ajoutez un logo.', 'waicam' ); ?>
					</div>
				<?php
				endif;
			endif;
			?>
			<div class="home-partners-gwc__cta-wrap">
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
	</div>
</section>

<?php get_footer();
