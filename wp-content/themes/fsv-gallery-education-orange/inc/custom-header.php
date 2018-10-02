<?php
/**
 * Implement an optional custom header for FSV GALLERY
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.0
 */

/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses fsvgallery_header_style() to style front-end.
 * @uses fsvgallery_admin_header_style() to style wp-admin form.
 * @uses fsvgallery_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		// 'default-text-color'     => '515151',
		'default-image'          => get_template_directory_uri() . '/images/header_001.jpg' ,

		// Set height and width, with a maximum value for the width.
		'height'                 => 300,
		'width'                  => 1200,
		'max-width'              => 2000,

		'header-text'            => false,

		// Support flexible height and width.
		'flex-height'            => true,
		'flex-width'             => true,

		// Random image rotation off by default.
		'random-default'         => false,

		// Callbacks for styling the header and the admin preview.
		// 'wp-head-callback'       => 'fsvgallery_header_style',
		'admin-head-callback'    => 'fsvgallery_admin_header_style',
		'admin-preview-callback' => 'fsvgallery_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'fsvgallery_custom_header_setup' );


/**
 * Define the default header image.
 *
 * @since FSV GALLERY 1.0
 */
register_default_headers( array(

	'header001' => array(
		'url' => '%s/images/header_001.jpg',
		'thumbnail_url' => '%s/images/header_001_thumbnail.jpg',
		'description' => __( 'Header Image 001', 'fsvgallery' )
	),

	'header002' => array(
		'url' => '%s/images/header_002.jpg',
		'thumbnail_url' => '%s/images/header_002_thumbnail.jpg',
		'description' => __( 'Header Image 002', 'fsvgallery' )
	),

	'header003' => array(
		'url' => '%s/images/header_003.jpg',
		'thumbnail_url' => '%s/images/header_003_thumbnail.jpg',
		'description' => __( 'Header Image 003', 'fsvgallery' )
	),

	'header004' => array(
		'url' => '%s/images/header_004.jpg',
		'thumbnail_url' => '%s/images/header_004_thumbnail.jpg',
		'description' => __( 'Header Image 004', 'fsvgallery' )
	),

	'header005' => array(
		'url' => '%s/images/header_005.jpg',
		'thumbnail_url' => '%s/images/header_005_thumbnail.jpg',
		'description' => __( 'Header Image 005', 'fsvgallery' )
	),

) );

//define( 'HEADER_IMAGE' , '%s/images/header_001.jpg' );

/**
 * Style the header text displayed on the blog.
 *
 * get_header_textcolor() options: 515151 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since FSV GALLERY 1.0
 */

/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_admin_header_style() {
?>
	<style type="text/css" id="fsvgallery-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg img {
		max-width: 1200px;
		height: auto;
	}
	</style>
<?php
}

/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 *
 * This callback overrides the default markup displayed there.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_admin_header_image() {
	?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
