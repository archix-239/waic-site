<?php
/**
 * Section Hero de la page Blog
 * Inspirée de Girls Who Code - "SPEAK ON IT"
 */

$hero_title    = get_field('blog_hero_title') ?: "L'IA POUR TOUTES";
$hero_subtitle = get_field('blog_hero_subtitle') ?: "Découvrez les dernières actualités, témoignages et innovations de Women in AI Cameroon.";
$hero_year     = get_field('blog_hero_year') ?: date('Y');
$hero_tag      = get_field('blog_hero_tag') ?: "ACTUALITÉS";
?>

<section class="blog-hero-gwc">
    <div class="blog-hero-gwc__black-box">
        <div class="blog-hero-gwc__content">
            <div class="blog-hero-gwc__title-wrap">
                <h1 class="blog-hero-gwc__title">
                    <span class="blog-hero-gwc__title-shadow"><?php echo esc_html($hero_title); ?></span>
                    <span class="blog-hero-gwc__title-main"><?php echo esc_html($hero_title); ?></span>
                </h1>
                <div class="blog-hero-gwc__logo-overlay">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.png" alt="WAIC Logo" class="blog-hero-gwc__mini-logo">
                </div>
            </div>
        </div>
    </div>
    
    <div class="blog-hero-gwc__white-box">
        <div class="blog-hero-gwc__inner">
            <div class="blog-hero-gwc__badge">
                <div class="blog-hero-gwc__badge-inner">
                    <span><?php echo esc_html($hero_year); ?></span>
                </div>
            </div>
            
            <div class="blog-hero-gwc__intro">
                <div class="blog-hero-gwc__intro-left">
                    <h2 class="blog-hero-gwc__kicker"><?php echo esc_html($hero_tag); ?></h2>
                </div>
                <div class="blog-hero-gwc__intro-right">
                    <p class="blog-hero-gwc__description">
                        <?php echo esc_html($hero_subtitle); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
