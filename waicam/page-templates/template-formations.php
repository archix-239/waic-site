<?php
/**
 * Template Name: WAI-CAM — Formations
 *
 * Affiche le catalogue des formations WAIC.
 * Source : CPT "tribe_events" (The Events Calendar) filtré sur les
 * catégories Formation / Masterclass / Atelier / Bootcamp.
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
get_template_part( 'template-parts/page-hero', null, array(
	'title'    => __( 'Nos Formations', 'waicam' ),
	'subtitle' => __( "Apprenez l'IA avec des parcours concrets, solidaires et accessibles à toutes les femmes et jeunes filles du Cameroun.", 'waicam' ),
	'crumb'    => __( 'Formations', 'waicam' ),
) );
?>

<!-- INTRO + CHIFFRES -->
<section class="formations-intro">
	<div class="formations-intro-grid">
		<div class="formation-stat">
			<div class="num"><i class="fa-solid fa-graduation-cap"></i></div>
			<h3><?php esc_html_e( 'Formations pratiques', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Du concret, sans jargon. L'IA expliquée pour que toutes les femmes comprennent, décident et innovent.", 'waicam' ); ?></p>
		</div>
		<div class="formation-stat">
			<div class="num"><i class="fa-solid fa-earth-africa"></i></div>
			<h3><?php esc_html_e( 'En présentiel & en ligne', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Partout au Cameroun : en présentiel ou en ligne, pour rapprocher l'IA des territoires et des réalités locales.", 'waicam' ); ?></p>
		</div>
		<div class="formation-stat">
			<div class="num"><i class="fa-solid fa-heart" style="color:var(--primary)"></i></div>
			<h3><?php esc_html_e( 'Accompagnement humain', 'waicam' ); ?></h3>
			<p><?php esc_html_e( "Des formatrices et mentors engagés pour accompagner chaque participante vers plus d’autonomie numérique.", 'waicam' ); ?></p>
		</div>
	</div>
</section>

<!-- ===========================================
     FORMATIONS À VENIR
     =========================================== -->
<section class="formations-section">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Calendrier', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Prochaines <span>formations</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Toutes les formations à venir — inscris-toi avant que les places ne soient prises.", 'waicam' ); ?></p>
	</div>

	<?php
	// Formations actives (à venir + en cours) — The Events Calendar gère
	// nativement la séparation par date.
	$formations_actives = waicam_get_formations( -1, 'a-venir' );
	$formations_passees = waicam_get_formations( -1, 'passe' );
	?>

	<?php if ( $formations_actives ) : ?>
		<div class="formations-grid">
			<?php while ( $formations_actives->have_posts() ) : $formations_actives->the_post();
				$post_id   = get_the_ID();
				$type      = waicam_event_type( $post_id );
				$lieu      = waicam_event_venue( $post_id );
				$heure     = waicam_event_time_range( $post_id );
				$niveau    = waicam_format_select( get_post_meta( $post_id, 'niveau', true ) );
				$formateur = get_post_meta( $post_id, 'formateur', true );
				$lien_inscr = get_post_meta( $post_id, 'lien_inscription', true );
				$img_url   = waicam_event_image_url( $post_id, 'medium_large' );
				$permalink = get_permalink( $post_id );

				// URL de destination du bouton "S'inscrire" (lien externe si défini, sinon page détail)
				$cta_url = $lien_inscr ? esc_url( $lien_inscr ) : esc_url( $permalink );
				$cta_target = $lien_inscr ? ' target="_blank" rel="noopener"' : '';
			?>
				<article class="formation-card">
					<a href="<?php echo esc_url( $permalink ); ?>" class="formation-card-img">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
						<?php if ( $type ) : ?>
							<span class="formation-card-type"><?php echo esc_html( $type ); ?></span>
						<?php endif; ?>
						<?php if ( $niveau ) : ?>
							<span class="formation-card-niveau"><?php echo esc_html( $niveau ); ?></span>
						<?php endif; ?>
					</a>
					<div class="formation-card-body">
						<h3>
							<a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a>
						</h3>

						<ul class="formation-card-meta">
							<li><span class="ico"><i class="fa-regular fa-calendar"></i></span> <?php echo esc_html( waicam_event_date( $post_id ) ); ?></li>
							<?php if ( $heure ) : ?>
								<li><span class="ico"><i class="fa-regular fa-clock"></i></span> <?php echo esc_html( $heure ); ?></li>
							<?php endif; ?>
							<?php if ( $lieu ) : ?>
								<li><span class="ico"><i class="fa-solid fa-location-dot"></i></span> <?php echo esc_html( $lieu ); ?></li>
							<?php endif; ?>
							<?php if ( $formateur ) : ?>
								<li><span class="ico"><i class="fa-solid fa-chalkboard-user"></i></span> <?php echo esc_html( $formateur ); ?></li>
							<?php endif; ?>
						</ul>

						<p class="formation-card-desc"><?php echo esc_html( waicam_event_excerpt( $post_id, 160 ) ); ?></p>

						<div class="formation-card-actions">
							<a href="<?php echo esc_url( $permalink ); ?>" class="btn-outline btn-sm">
								<?php esc_html_e( 'Voir le détail', 'waicam' ); ?>
							</a>
							<a href="<?php echo $cta_url; ?>"<?php echo $cta_target; ?> class="btn-primary btn-sm">
								<i class="fa-solid fa-graduation-cap"></i> <?php esc_html_e( "S'inscrire", 'waicam' ); ?>
							</a>
						</div>
					</div>
				</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
	<?php else : ?>
		<div class="formations-empty">
			<p><?php esc_html_e( "Aucune formation programmée pour le moment. Reviens vite, le calendrier s'enrichit chaque mois.", 'waicam' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-outline">
				<?php esc_html_e( 'Suggérer une formation', 'waicam' ); ?>
			</a>
		</div>
	<?php endif; ?>
</section>

<!-- ===========================================
     POURQUOI SE FORMER AVEC NOUS
     =========================================== -->
<section class="formations-why" style="background:var(--gray-light);">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Pourquoi WAI-CAM', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Une approche <span>concrète</span>', 'waicam' ) ); ?></h2>
	</div>
	<div class="formations-why-grid">
		<div class="why-card">
			<div class="why-icon"><i class="fa-solid fa-brain"></i></div>
			<h4><?php esc_html_e( 'Sans jargon', 'waicam' ); ?></h4>
			<p><?php esc_html_e( "L'IA expliquée avec des mots simples, des exemples concrets, des cas d'usage du quotidien.", 'waicam' ); ?></p>
		</div>
		<div class="why-card">
			<div class="why-icon"><i class="fa-solid fa-briefcase"></i></div>
			<h4><?php esc_html_e( 'Pratique & utile', 'waicam' ); ?></h4>
			<p><?php esc_html_e( "Tu repars avec des outils que tu peux utiliser dès le lendemain dans ton activité.", 'waicam' ); ?></p>
		</div>
		<div class="why-card">
			<div class="why-icon"><i class="fa-solid fa-handshake"></i></div>
			<h4><?php esc_html_e( 'Communauté', 'waicam' ); ?></h4>
			<p><?php esc_html_e( "Tu rejoins un réseau de femmes engagées qui se soutiennent et se mentorent.", 'waicam' ); ?></p>
		</div>
		<div class="why-card">
			<div class="why-icon"><i class="fa-solid fa-graduation-cap"></i></div>
			<h4><?php esc_html_e( 'Certifiée', 'waicam' ); ?></h4>
			<p><?php esc_html_e( "Une attestation WAI-CAM à l'issue de chaque formation pour valoriser ton parcours.", 'waicam' ); ?></p>
		</div>
	</div>
</section>

<!-- ===========================================
     FORMATIONS PASSÉES (référence)
     =========================================== -->
<?php if ( $formations_passees ) : ?>
<section class="formations-section">
	<div class="section-header">
		<div class="section-tag"><?php esc_html_e( 'Archives', 'waicam' ); ?></div>
		<h2 class="section-title"><?php echo wp_kses_post( __( 'Formations <span>passées</span>', 'waicam' ) ); ?></h2>
		<p class="section-desc"><?php esc_html_e( "Retour sur nos sessions précédentes — pour voir notre impact sur le terrain.", 'waicam' ); ?></p>
	</div>

	<div class="formations-past-list">
		<?php while ( $formations_passees->have_posts() ) : $formations_passees->the_post();
			$post_id = get_the_ID();
			$type    = waicam_event_type( $post_id );
			$lieu    = waicam_event_venue( $post_id );
			$nb      = get_post_meta( $post_id, 'nombre_de_participantes', true );
		?>
			<a href="<?php the_permalink(); ?>" class="formation-past-item">
				<div class="formation-past-date"><?php echo esc_html( waicam_event_date( $post_id ) ); ?></div>
				<div class="formation-past-body">
					<h4><?php the_title(); ?></h4>
					<div class="formation-past-meta">
						<?php if ( $type ) : ?><span><?php echo esc_html( $type ); ?></span><?php endif; ?>
						<?php if ( $lieu ) : ?><span><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( $lieu ); ?></span><?php endif; ?>
						<?php if ( $nb ) : ?><span><i class="fa-solid fa-users"></i> <?php echo esc_html( number_format_i18n( $nb ) ); ?> participantes</span><?php endif; ?>
					</div>
				</div>
				<span class="formation-past-arrow">→</span>
			</a>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</section>
<?php endif; ?>

<!-- ===========================================
     CTA — SUGGÉRER UNE FORMATION
     =========================================== -->
<section class="formations-cta">
	<div class="formations-cta-inner">
		<div class="cta-icon"><i class="fa-regular fa-lightbulb"></i></div>
		<h3><?php esc_html_e( "Tu cherches une formation qu'on ne propose pas encore ?", 'waicam' ); ?></h3>
		<p><?php esc_html_e( "Dis-nous ce dont tu as besoin. Si plusieurs femmes le demandent, on l'organise.", 'waicam' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary">
			<?php esc_html_e( 'Suggérer une formation', 'waicam' ); ?>
		</a>
	</div>
</section>

<?php get_footer();
