<?php
/**
 * Hero d'une page intérieure (breadcrumb + titre + sous-titre)
 *
 * Args attendus (passés via get_template_part('template-parts/page-hero', null, $args)):
 * - title    (string)  Titre H1
 * - subtitle (string)  Sous-titre / description
 * - crumb    (string)  Dernier élément du breadcrumb (par défaut = title)
 *
 * @package WAICAM
 */

$title    = $args['title']    ?? get_the_title();
$subtitle = $args['subtitle'] ?? '';
$crumb    = $args['crumb']    ?? $title;
?>

<div class="page-hero">
	<div class="breadcrumb">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Accueil', 'waicam' ); ?></a>
		<span>/</span>
		<span><?php echo esc_html( $crumb ); ?></span>
	</div>
	<h1><?php echo esc_html( $title ); ?></h1>
	<?php if ( $subtitle ) : ?>
		<p><?php echo esc_html( $subtitle ); ?></p>
	<?php endif; ?>
</div>
