<?php
/**
 * Template Name: WAI-CAM — Partenaires
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$partners_hero_title = get_theme_mod( 'waicam_partners_hero_title', 'DEVENEZ PARTENAIRE DE L’IA INCLUSIVE' );
$partners_hero_text_1 = get_theme_mod( 'waicam_partners_hero_text_1', "WAI-CAM réunit institutions publiques, entreprises et acteurs locaux pour porter une IA utile, éthique et accessible aux femmes et aux jeunes du Cameroun.");
$partners_hero_text_2 = get_theme_mod( 'waicam_partners_hero_text_2', "En soutenant nos initiatives, vous renforcez la formation, le mentorat et les projets locaux qui donnent aux femmes les moyens d'innover.");

$partners_cta_title = get_theme_mod( 'waicam_partners_cta_title', 'REJOIGNEZ NOTRE MISSION' );
$partners_cta_text_1 = get_theme_mod( 'waicam_partners_cta_text_1', 'Construisons ensemble un partenariat concret autour de la formation, du recrutement et de l’innovation sociale.' );
$partners_cta_text_2 = get_theme_mod( 'waicam_partners_cta_text_2', 'Contactez-nous pour élaborer une collaboration à impact, terrain et transition digitale.' );
$partners_cta_btn = get_theme_mod( 'waicam_partners_cta_btn', 'FAIRE UNE DEMANDE DE PARTENARIAT' );
$partners_cta_url = get_theme_mod( 'waicam_partners_cta_url', '#form-partenariat' );
$partners_cta_image_id = (int) get_theme_mod( 'waicam_partners_cta_image_id', 0 );
$partners_cta_image = $partners_cta_image_id ? wp_get_attachment_image_url( $partners_cta_image_id, 'large' ) : '';
?>

<section class="partners-page-hero-gwc">
  <div class="partners-page-hero-gwc__inner">
    <h1><?php echo esc_html( $partners_hero_title ); ?></h1>
    <p><?php echo esc_html( $partners_hero_text_1 ); ?></p>
    <p><?php echo esc_html( $partners_hero_text_2 ); ?></p>
  </div>
</section>

<section class="partners-page-cta-gwc">
  <div class="partners-page-cta-gwc__inner">
    <div class="partners-page-cta-gwc__media<?php echo $partners_cta_image ? ' has-image' : ''; ?>">
      <?php if ( $partners_cta_image ) : ?>
        <img src="<?php echo esc_url( $partners_cta_image ); ?>" alt="" loading="lazy" />
      <?php else : ?>
        <span><?php esc_html_e( 'Image partenariat', 'waicam' ); ?></span>
      <?php endif; ?>
    </div>
    <div class="partners-page-cta-gwc__content">
      <h2><?php echo esc_html( $partners_cta_title ); ?></h2>
      <p><?php echo esc_html( $partners_cta_text_1 ); ?></p>
      <p><?php echo esc_html( $partners_cta_text_2 ); ?></p>
      <a href="<?php echo esc_url( $partners_cta_url ); ?>"><?php echo esc_html( $partners_cta_btn ); ?></a>
    </div>
  </div>
</section>


<?php
$partners_impact_title = get_theme_mod( 'waicam_partners_impact_title', 'CRÉER DE L’IMPACT' );
$partners_impact_text = get_theme_mod( 'waicam_partners_impact_text', "En devenant partenaire, vous réduisez la fracture numérique de genre et soutenez l’IA au service de l'éducation, de la santé et du développement durable.");
$partners_impact_cards = array(
  array(
    'title' => get_theme_mod( 'waicam_partners_impact_1_title', 'INSTITUTIONS' ),
    'text'  => get_theme_mod( 'waicam_partners_impact_1_text', 'Universités, centres de recherche et institutions académiques engagées à nos côtés.' ),
    'tone'  => 'dark',
  ),
  array(
    'title' => get_theme_mod( 'waicam_partners_impact_2_title', 'ENTREPRISES' ),
    'text'  => get_theme_mod( 'waicam_partners_impact_2_text', 'Entreprises qui soutiennent nos programmes de formation, mentorat et insertion.' ),
    'tone'  => 'red',
  ),
  array(
    'title' => get_theme_mod( 'waicam_partners_impact_3_title', 'RÉSEAUX' ),
    'text'  => get_theme_mod( 'waicam_partners_impact_3_text', 'Réseaux professionnels et communautés mobilisées pour amplifier l’impact.' ),
    'tone'  => 'dark',
  ),
  array(
    'title' => get_theme_mod( 'waicam_partners_impact_4_title', 'INSTITUTIONS PUBLIQUES' ),
    'text'  => get_theme_mod( 'waicam_partners_impact_4_text', 'Institutions publiques partenaires pour porter une IA responsable et inclusive.' ),
    'tone'  => 'red',
  ),
);
?>
<section class="partners-impact-gwc">
  <div class="partners-impact-gwc__inner">
    <h2><?php echo esc_html( $partners_impact_title ); ?></h2>
    <p><?php echo esc_html( $partners_impact_text ); ?></p>
    <div class="partners-impact-gwc__grid">
      <?php foreach ( $partners_impact_cards as $card ) : ?>
        <article class="partners-impact-gwc__card partners-impact-gwc__card--<?php echo esc_attr( $card['tone'] ); ?>">
          <h3><?php echo esc_html( $card['title'] ); ?></h3>
          <p><?php echo esc_html( $card['text'] ); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<?php
$partners_quote_text = get_theme_mod( 'waicam_partners_quote_text', "En collaborant avec WAI-CAM, nous renforçons notre impact social tout en soutenant l'inclusion des femmes dans les métiers du numérique." );
$partners_quote_author = get_theme_mod( 'waicam_partners_quote_author', 'Partenaire institutionnel — WAI-CAM' );
$partners_quote_role = get_theme_mod( 'waicam_partners_quote_role', 'Direction générale' );
$partners_quote_linkedin = get_theme_mod( 'waicam_partners_quote_linkedin', '#' );
$partners_quote_image_id = (int) get_theme_mod( 'waicam_partners_quote_image_id', 0 );
$partners_quote_image = $partners_quote_image_id ? wp_get_attachment_image_url( $partners_quote_image_id, 'large' ) : '';
?>
<section class="partners-quote-gwc">
  <div class="partners-quote-gwc__inner">
    <div class="partners-quote-gwc__media<?php echo $partners_quote_image ? ' has-image' : ''; ?>">
      <?php if ( $partners_quote_image ) : ?>
        <img src="<?php echo esc_url( $partners_quote_image ); ?>" alt="" loading="lazy" />
      <?php else : ?>
        <span><?php esc_html_e( 'Image partenaire', 'waicam' ); ?></span>
      <?php endif; ?>
    </div>
    <div class="partners-quote-gwc__content">
      <span class="partners-quote-gwc__mark" aria-hidden="true">“</span>
      <blockquote><?php echo esc_html( $partners_quote_text ); ?></blockquote>
      <p class="partners-quote-gwc__author">— <?php echo esc_html( $partners_quote_author ); ?><br><?php echo esc_html( $partners_quote_role ); ?></p>
      <a class="partners-quote-gwc__linkedin" href="<?php echo esc_url( $partners_quote_linkedin ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
        <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</section>


<?php
$partners_stats_title = get_theme_mod( 'waicam_partners_stats_title', 'CONNECTEZ-VOUS À NOTRE COMMUNAUTÉ' );
$partners_stats_text = get_theme_mod( 'waicam_partners_stats_text', "Nos membres sont engagés dans la tech, l'innovation et l'impact social au Cameroun et au-delà." );
$partners_stats_image_id = (int) get_theme_mod( 'waicam_partners_stats_image_id', 0 );
$partners_stats_image = $partners_stats_image_id ? wp_get_attachment_image_url( $partners_stats_image_id, 'large' ) : '';
$partners_stats = array(
  array(
    'number' => get_theme_mod( 'waicam_partners_stats_1_number', '12,800' ),
    'label'  => get_theme_mod( 'waicam_partners_stats_1_label', 'MEMBRES ET COMMUNAUTÉ' ),
  ),
  array(
    'number' => get_theme_mod( 'waicam_partners_stats_2_number', '25-45' ),
    'label'  => get_theme_mod( 'waicam_partners_stats_2_label', 'ÂGE MAJORITAIRE' ),
  ),
  array(
    'number' => get_theme_mod( 'waicam_partners_stats_3_number', '42%' ),
    'label'  => get_theme_mod( 'waicam_partners_stats_3_label', 'DIPLÔMÉES SUPÉRIEUR' ),
  ),
  array(
    'number' => get_theme_mod( 'waicam_partners_stats_4_number', '40%' ),
    'label'  => get_theme_mod( 'waicam_partners_stats_4_label', 'PROFILS SENIORS' ),
  ),
);
?>
<section class="partners-stats-gwc">
  <div class="partners-stats-gwc__inner">
    <h2><?php echo esc_html( $partners_stats_title ); ?></h2>
    <p><?php echo esc_html( $partners_stats_text ); ?></p>

    <div class="partners-stats-gwc__media<?php echo $partners_stats_image ? ' has-image' : ''; ?>">
      <?php if ( $partners_stats_image ) : ?>
        <img src="<?php echo esc_url( $partners_stats_image ); ?>" alt="" loading="lazy" />
      <?php else : ?>
        <span><?php esc_html_e( 'Image communauté', 'waicam' ); ?></span>
      <?php endif; ?>
      <div class="partners-stats-gwc__overlay">
        <?php foreach ( $partners_stats as $item ) : ?>
          <article class="partners-stats-gwc__item">
            <h3><?php echo esc_html( $item['number'] ); ?></h3>
            <i aria-hidden="true"></i>
            <p><?php echo esc_html( $item['label'] ); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<?php
$partners_logos_title = get_theme_mod( 'waicam_partners_logos_title', 'NOS PARTENAIRES' );
$partners_logos_text = get_theme_mod( 'waicam_partners_logos_text', 'Nous remercions nos partenaires pour leur confiance et leur soutien.' );
$partners_loop = waicam_get_partenaires( -1 );
?>
<section class="partners-logos-gwc">
  <div class="partners-logos-gwc__inner">
    <h2><?php echo esc_html( $partners_logos_title ); ?></h2>
    <p><?php echo esc_html( $partners_logos_text ); ?></p>
    <div class="partners-logos-gwc__grid">
      <?php if ( $partners_loop ) : while ( $partners_loop->have_posts() ) : $partners_loop->the_post();
        $nom = waicam_field( 'nom_du_partenaire', get_the_ID(), get_the_title() );
        $url = waicam_field( 'site_web', get_the_ID(), '' );
        $logo = waicam_image_url( 'logo', get_the_ID(), 'medium', '' );
        if ( ! $logo ) {
          $logo = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
        }
      ?>
      <div class="partners-logos-gwc__item">
        <?php if ( $url ) : ?><a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener"><?php endif; ?>
          <?php if ( $logo ) : ?>
            <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $nom ); ?>" loading="lazy" />
          <?php else : ?>
            <span><?php echo esc_html( $nom ); ?></span>
          <?php endif; ?>
        <?php if ( $url ) : ?></a><?php endif; ?>
      </div>
      <?php endwhile; wp_reset_postdata(); else : ?>
      <p><?php esc_html_e( 'Ajoutez des partenaires pour afficher leurs logos ici.', 'waicam' ); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer();
