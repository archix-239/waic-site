<?php
/**
 * Template Name: WAI-CAM — Partenaires
 *
 * @package WAICAM
 */

get_header(); ?>

<?php
$partners_hero_title = get_theme_mod( 'waicam_partners_hero_title', 'DEVENEZ PARTENAIRE' );
$partners_hero_text_1 = get_theme_mod( 'waicam_partners_hero_text_1', "Women in AI Cameroon (WAI-CAM) est un mouvement citoyen qui promeut une IA inclusive, utile et accessible aux femmes et aux jeunes à travers le Cameroun." );
$partners_hero_text_2 = get_theme_mod( 'waicam_partners_hero_text_2', "En soutenant nos initiatives, vous contribuez au renforcement des compétences, à l'innovation locale et à une meilleure représentation des femmes dans les métiers du numérique et de l'IA." );

$partners_cta_title = get_theme_mod( 'waicam_partners_cta_title', 'REJOIGNEZ NOTRE MISSION' );
$partners_cta_text_1 = get_theme_mod( 'waicam_partners_cta_text_1', 'Nous développons des opportunités de partenariat institutionnel, éducatif, média et entreprise.' );
$partners_cta_text_2 = get_theme_mod( 'waicam_partners_cta_text_2', 'Soumettez votre demande de partenariat dès aujourd’hui.' );
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

<?php get_footer();
