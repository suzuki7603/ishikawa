<?php
/**
 * FSV GALLERY Theme Options
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.1
 */

/**
 * Register the form setting for our fsvgallery_options array.
 * This function is attached to the admin_init action hook.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_theme_options_init() {

	register_setting(
		'fsvgallery_options',       // Options group
		'fsvgallery_theme_options', // Database option, see fsvgallery_get_theme_options()
		'fsvgallery_theme_options_validate' // The sanitization callback, see fsvgallery_theme_options_validate()
	);

}
add_action( 'admin_init', 'fsvgallery_theme_options_init' );

/**
 * Change the capability required to save the 'fsvgallery_options' options group.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function fsvgallery_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_fsvgallery_options', 'fsvgallery_option_page_capability' );

/**
 * Return an array of color schemes registered for FSV GALLERY.
 *
 * @since FSV GALLERY 1.0
 */
/*function fsvgallery_color_schemes() {
	$color_scheme_options = array(
		'light' => array(
			'value' => 'light',
			'label' => __( 'Light', 'fsvgallery' ),
		),
		'dark' => array(
			'value' => 'dark',
			'label' => __( 'Dark', 'fsvgallery' ),
		),
		'pastel' => array(
			'value' => 'pastel',
			'label' => __( 'Pastel', 'fsvgallery' ),
		),
	);

	return apply_filters( 'fsvgallery_color_schemes', $color_scheme_options );
}*/

/**
 * Return the default options for FSV GALLERY.
 *
 * @return array An array of default theme options.
 *
 * @since FSV GALLERY 1.1
 */
function fsvgallery_get_default_theme_options() {
	$default_theme_options = array(
		/* 'color_scheme' => 'light', */
		'header_logo' => '',
		'foot_text' => 'Copyright',
	);
	return apply_filters( 'fsvgallery_default_theme_options', $default_theme_options );
}
/**
 * Return the options array for FSV GALLERY.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_get_theme_options() {
	return get_option( 'fsvgallery_eo_theme_options', fsvgallery_get_default_theme_options() );
}

/**
 * Sanitize and validate form input.
 *
 * @see fsvgallery_theme_options_init()
 * @todo set up Reset Options action
 *
 * @since FSV GALLERY 1.1
 */
function fsvgallery_theme_options_validate( $input ) {

	$output = $defaults = fsvgallery_get_default_theme_options();

	// Color scheme must be in our array of color scheme options
	/*if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], fsvgallery_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];*/

	$output['header_logo'] = $input['header_logo'];
	$output['foot_text'] = $input['foot_text'];

	return apply_filters( 'fsvgallery_theme_options_validate', $output, $input, $defaults );
}

/**
 * Enqueue the styles for the current color scheme.
 *
 * @since FSV GALLERY 1.0
 */
/*function fsvgallery_enqueue_color_scheme() {
	$options = fsvgallery_get_theme_options();
	$color_scheme = $options['color_scheme'];

	if ( 'dark' == $color_scheme ) :

		wp_enqueue_style( 'dark', get_template_directory_uri() . '/css/dark.css', array(), null );

	elseif ( 'pastel' == $color_scheme ) :

		wp_enqueue_style( 'pastel', get_template_directory_uri() . '/css/pastel.css', array(), null );

	endif;

	do_action( 'fsvgallery_enqueue_color_scheme', $color_scheme );
}
add_action( 'wp_enqueue_scripts', 'fsvgallery_enqueue_color_scheme' );*/

/**
 * Register postMessage support.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since FSV GALLERY 1.1
 */
function fsvgallery_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$options  = fsvgallery_get_theme_options();
	$defaults = fsvgallery_get_default_theme_options();

	// This function will be implemented in the future.

	/* $wp_customize->add_setting( 'fsvgallery_eo_theme_options[color_scheme]', array(
		'default'    => $defaults['color_scheme'],
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	) );

	$schemes = fsvgallery_color_schemes();
	$choices = array();

	foreach ( $schemes as $scheme ) {
		$choices[ $scheme['value'] ] = $scheme['label'];
	}

	$wp_customize->add_control( 'fsvgallery_color_scheme', array(
		'label'    => __( 'Color Scheme', 'fsvgallery' ),
		'section'  => 'colors',
		'settings' => 'fsvgallery_eo_theme_options[color_scheme]',
		'type'     => 'radio',
		'choices'  => $choices,
		'priority' => 5,
	) ); */

	// Header Logo Setting
	$wp_customize->add_section( 'fsvgallery_header_logo' , array(
		'title'		=> __( 'Logo', 'fsvgallery' ),
		'priority'	=> 41,
	) );

	$wp_customize->add_setting( 'fsvgallery_eo_theme_options[header_logo]' , array(
		'default'   => '',
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fsvgallery_header_logo', array(
		'label'		=> __('Image Logo','fsvgallery'),
		'section'	=> 'fsvgallery_header_logo',
		'settings'	=> 'fsvgallery_eo_theme_options[header_logo]',
	) ) );

	// Footer Area Component
	$wp_customize->add_section( 'fsvgallery_footer_settings' , array(
		'title'    => __( 'Footer', 'fsvgallery' ),
		'priority' => 500,
	) );

	$wp_customize->add_setting( 'fsvgallery_eo_theme_options[foot_text]' , array(
		'default'   => 'Copyright',
		'type'      => 'option',
		'capability'=> 'edit_theme_options',
		'sanitize_callback' => 'fsvgallery_text_sanitize',
	) );

	$wp_customize->add_control( 'fsvgallery_foot_text' , array(
		'label'    => __('Footer Text', 'fsvgallery'),
		'section'  => 'fsvgallery_footer_settings',
		'settings' => 'fsvgallery_eo_theme_options[foot_text]',
		'type'     => 'text',
		'priority' => 4,
	) );

}
add_action( 'customize_register', 'fsvgallery_customize_register' );

/**
 * Sanitizing Input Text.
 *
 * @since FSV GALLERY 1.2
 */
function fsvgallery_text_sanitize( $value ) {

	$args = array(
		'a' => array(
			'href' => array(),
			'title' => array()
		),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
		'img' => array(
			'src' => array(),
			'height' => array(),
			'width' => array(),
			'alt' => array()
		),
	);

	return wp_kses( $value , $args );

}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_customize_preview_js() {
	wp_enqueue_script( 'fsvgallery-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141001', true );
}
add_action( 'customize_preview_init', 'fsvgallery_customize_preview_js' );
