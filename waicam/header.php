<?php
/**
 * Header du thème WAI-CAM
 *
 * @package WAICAM
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu', 'waicam' ); ?></a>

<!-- ========== NAVBAR ========== -->
<nav class="navbar">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
		<?php
		if ( has_custom_logo() ) {
			the_custom_logo();
		} else {
			?>
			<img src="<?php echo esc_url( waicam_img( 'logo-waicam.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" style="height:56px;width:auto;" />
			<?php
		}
		?>
	</a>

	<div class="nav-links">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s',
				'walker'         => new WAICAM_Nav_Walker(),
				'fallback_cb'    => 'waicam_default_menu',
			) );
		} else {
			waicam_default_menu();
		}
		?>
	</div>

	<div class="hamburger" aria-label="<?php esc_attr_e( 'Ouvrir le menu', 'waicam' ); ?>" role="button" tabindex="0">
		<span></span><span></span><span></span>
	</div>
</nav>

<div id="content" class="site-content">
