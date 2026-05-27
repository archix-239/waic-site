<?php
/**
 * ACF Field Registration for the "Rejoindre" Page.
 *
 * @package WAICAM
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group( array(
		'key'    => 'group_join_bigstat',
		'title'  => __( 'Rejoindre — Grand chiffre', 'waicam' ),
		'fields' => array(
			array(
				'key'           => 'field_join_bigstat_title',
				'label'         => __( 'Titre principal', 'waicam' ),
				'name'          => 'join_bigstat_title',
				'type'          => 'text',
				'default_value' => __( '1 Million de femmes bénéficiaires de l’IA d’ici 2030', 'waicam' ),
			),
			array(
				'key'           => 'field_join_bigstat_text',
				'label'         => __( 'Texte', 'waicam' ),
				'name'          => 'join_bigstat_text',
				'type'          => 'textarea',
				'default_value' => __( 'WAI-CAM inverse la tendance en formant des ambassadrices régionales pour un impact durable sur tout le territoire camerounais.', 'waicam' ),
			),
			array(
				'key'           => 'field_join_bigstat_cta_text',
				'label'         => __( 'Texte bouton', 'waicam' ),
				'name'          => 'join_bigstat_cta_text',
				'type'          => 'text',
				'default_value' => __( 'Soutenir nos actions', 'waicam' ),
			),
			array(
				'key'           => 'field_join_bigstat_cta_url',
				'label'         => __( 'URL bouton', 'waicam' ),
				'name'          => 'join_bigstat_cta_url',
				'type'          => 'text',
				'default_value' => home_url( '/faire-un-don' ),
			),
		),
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-templates/template-rejoindre.php',
				),
			),
		),
		'menu_order' => 10,
		'position'   => 'normal',
		'style'      => 'default',
	) );

endif;
