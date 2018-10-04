<?php
/**
 * FSV GALLERY functions and definitions
 *
 * @package WordPress
 * @subpackage FSV GALLERY
 * @since FSV GALLERY 1.2
 */

/**
 * FSV GALLERY setup.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_setup() {
	/*
	 * Makes FSV GALLERY available for translation.
	 */
	load_theme_textdomain( 'fsvgallery', get_template_directory() . '/languages' );

	// Load up our theme options page and related code.
	require( get_template_directory() . '/inc/theme-options.php' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This feature allows themes to add document title tag to HTML <head>.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'fsvgallery' ) );

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( 'css/editor-style.css' );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'eeeeee',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

}
add_action( 'after_setup_theme', 'fsvgallery_setup' );

/**
 * This setting is for cutting the image to fit the theme.
 *
 * @since FSV GALLERY 1.0
 */
require_once( get_template_directory() .'/inc/aqua-resizer.php' );

if ( ! function_exists( 'fsvgallery_img_resize' ) ) :

function fsvgallery_img_resize( $args ) {

	// Archive Image Size
	if( $args == 'img_archive_width' ) return '484';
	if( $args == 'img_archive_height' ) return '550';
	if( $args == 'img_archive_crop' ) return true;

	// Single or Page Image Size
	if( $args == 'img_post_width' ) return '1200';
	if( $args == 'img_post_height' ) return '1200';
	if( $args == 'img_post_crop' ) return false;

}

endif;

/**
 * Add support for a custom header image.
 *
 * @since FSV GALLERY 1.0
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since FSV GALLERY 1.1
 */
function fsvgallery_scripts_styles() {
	global $wp_styles;
	
	// WordPress本体のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	// jQueryの読み込み
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');

	// Adds JavaScript to pages with the comment form to support
	// sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'fsvgallery-style', get_stylesheet_uri() );

	// Add the script / style sheet for the responsive navigation menu.
	wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/js/jquery.mmenu.min.js', array('jquery'), true );
	wp_enqueue_style( 'jquery-mmenu-styles', get_template_directory_uri() . '/css/jquery.mmenu.css' );

	// Add the script to make entire site responsive.
	wp_enqueue_script( 'jquery-responsive', get_template_directory_uri() . '/js/responsive.js', array('jquery'), true );

	// Loads the overwrite stylesheet.
	wp_enqueue_style( 'fsvgallery-overwrite', get_template_directory_uri() . '/css/overwrite.css' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'fsvgallery-ie', get_template_directory_uri() . '/css/ie.css', array( 'fsvgallery-style' ), '20141001' );
	$wp_styles->add_data( 'fsvgallery-ie', 'conditional', 'lt IE 10' );
	
	wp_enqueue_style('jquery-bxslider-styles', get_template_directory_uri() . '/css/jquery.bxslider.css');
	wp_enqueue_script('jquery-bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), true );
}
add_action( 'wp_enqueue_scripts', 'fsvgallery_scripts_styles' );

/**
 * Filter the page menu arguments.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_page_menu_args( $args ) {

	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;

	return $args;

}
add_filter( 'wp_page_menu_args', 'fsvgallery_page_menu_args' );

/**
 * Register sidebars.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Widget Area 1 (left)', 'fsvgallery' ),
		'id' => 'sidebar-1',
		'description' => __( 'This area is used to set the widget to footer', 'fsvgallery' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Widget Area 2 (center)', 'fsvgallery' ),
		'id' => 'sidebar-2',
		'description' => __( 'This area is used to set the widget to footer', 'fsvgallery' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Widget Area 3 (right)', 'fsvgallery' ),
		'id' => 'sidebar-3',
		'description' => __( 'This area is used to set the widget to footer', 'fsvgallery' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'fsvgallery_widgets_init' );

/**
 * These codes are to display breadcrumb navigations.
 *
 * @since FSV GALLERY 1.0
 */
if ( ! function_exists( 'fsvgallery_breadcrumb' ) ) :

function fsvgallery_breadcrumb() {

	global $post;

	$connector = '&nbsp;&gt;&nbsp;&nbsp;' ;
?>

<div id="breadcrumb">

	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">TOP</a>

	<?php if ( is_404() ) : 

		echo $connector; ?><span class="currentpage"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'fsvgallery' ); ?></span>

	<?php elseif ( is_search() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Search Results for : %s', 'fsvgallery' ), get_search_query() ); ?></span>

	<?php elseif ( is_day() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Daily Archives : %s', 'fsvgallery' ), get_the_date() ); ?></span>

	<?php elseif ( is_month() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Monthly Archives : %s', 'fsvgallery' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'fsvgallery' ) ) ); ?></span>

	<?php elseif ( is_year() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Yearly Archives : %s', 'fsvgallery' ), get_the_date( _x( 'Y', 'yearly archives date format', 'fsvgallery' ) ) ); ?></span>

	<?php elseif ( is_author() ) :

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Author Archives : %s', 'fsvgallery' ), get_the_author() ); ?></span>

	<?php elseif ( is_tag() ) : 

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Tag Archives : %s', 'fsvgallery' ), single_tag_title( '', false ) ); ?></span>

	<?php elseif ( is_category() ) :

		$cat = get_queried_object();

		if ( $cat->parent != 0 ):

			$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) ); // get parent categories

			foreach( $ancestors as $ancestor ) : // parent categories loop

			echo $connector; ?><a href="<?php echo get_category_link( $ancestor ); ?>"><?php echo get_cat_name( $ancestor ); ?></a>

			<?php endforeach;

		endif;

		echo $connector; ?><span class="currentpage"><?php printf( __( 'Category Archives : %s', 'fsvgallery' ) , $cat->cat_name );  ?></span>

	<?php elseif ( is_attachment() ) :

		if($post -> post_parent != 0 ):

			echo $connector; ?><a href="<?php echo get_permalink( $post->post_parent); ?>"><?php echo get_the_title( $post->post_parent ); ?></a>

		<?php endif;

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php elseif ( is_single() ) :

		$categories = get_the_category( $post->ID );
		$cat = $categories[0];

		if( $cat->parent != 0 ) :

			$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) ) ; // get parent categories

			foreach($ancestors as $ancestor): // parent categories loop

				echo $connector; ?><a href="<?php echo get_category_link( $ancestor ); ?>"><?php echo get_cat_name( $ancestor ); ?></a>

			<?php endforeach;

		endif; ?>

		<?php echo $connector; ?><a href="<?php echo get_category_link( $cat->cat_ID ); ?>"><?php echo $cat->cat_name ; ?></a>

		<?php echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php elseif ( is_page() ) :

		if( $post->post_parent != 0 ) : 

			$ancestors = array_reverse( $post->ancestors );

			foreach($ancestors as $ancestor):

				echo $connector; ?><a href="<?php echo get_permalink( $ancestor ); ?>"><?php echo get_the_title( $ancestor ); ?></a>

			<?php endforeach;

		endif;

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php else :

		echo $connector; ?><span class="currentpage"><?php echo $post->post_title; ?></span>

	<?php endif; ?>

</div><!-- #breadcrumb -->

<?php
}

endif;

/**
 * These codes are used to display the pager in the archive page.
 *
 * @since FSV GALLERY 1.0
 */
if ( ! function_exists( 'fsvgallery_pagination' ) ) :

function fsvgallery_pagination( $pages = '' , $range = 1 ) {

	$showitems = ( $range * 2 ) + 1 ;

	$tmp_dir = get_template_directory_uri();

	global $paged;

	if ( empty( $paged ) ) { $paged = 1; }

	if ( $pages == '' ) :

		global $wp_query;
		$pages = $wp_query->max_num_pages;

		if ( ! $pages ) { $pages = 1; }

	endif;

	if ( 1 != $pages ) :

		echo '<div class="pagination">' . "\n" ;

		// echo '<div class="component-inner">' . "\n" ;

		// if ( $paged > 2 && $paged > $range + 1 ) echo '<a href="' . get_pagenum_link( 1 ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03l.png" alt="Previous" /></a>' . "\n" ;

		if ( $paged == 1 ) :

			echo '<div class="nav-previous"><a href="' . get_pagenum_link( $pages ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03l.png" alt="Previous" /></a></div>' . "\n" ;

		elseif ( $paged > 1 ) :

			echo '<div class="nav-previous"><a href="' . get_pagenum_link( $paged - 1 ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03l.png" alt="Previous" /></a></div>' . "\n"  ;

		endif;

		echo '<div class="pagenum-group">' . "\n" ;

		for ( $i = 1 ; $i <= $pages ; $i++ ) {

			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems - 1 ) ) {

				echo ( $paged == $i )? "<span class='current pagenum'>".$i."</span>" . "\n" : "<span class='pagenum'><a href='".get_pagenum_link( $i )."' class='active-link' >".$i."</a></span>" . "\n" ;

			}

		}

		echo '</div>' . "\n"  ;

		if ( $paged < $pages ) :

			echo '<div class="nav-next"><a href="' .get_pagenum_link( $paged + 1 ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03r.png" alt="Next" /></a></div>' . "\n" ;

		elseif ( $paged == $pages ) :

			echo '<div class="nav-next"><a href="' .get_pagenum_link( 1 ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03r.png" alt="Next" /></a></div>' . "\n" ;

		endif;

		//if ( $paged < $pages - 1 && $paged + $rang - 1 < $pages ) echo '<a href="' . get_pagenum_link( $pages ) . '"><img src="' . $tmp_dir . '/images/arrow-pagenation-03r.png" alt="Next" /></a>' . "\n" ;

		// echo '</div>' . "\n"  ;

		echo '</div>' . "\n"  ;

	endif;
}

endif;


/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own fsvgallery_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since FSV GALLERY 1.0
 */
if ( ! function_exists( 'fsvgallery_comment' ) ) :

function fsvgallery_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback : ', 'fsvgallery' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'fsvgallery' ), '| ', '' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-id-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );

					echo "\n" ;

					printf( '<p><b class="fn"><a href="%1$s">%4$s</a></b> <time datetime="%2$s">%3$s</time> %5$s</p>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'fsvgallery' ), get_comment_date(), get_comment_time() ),
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span class="post-author">' . __( 'Post author', 'fsvgallery' ) . '</span>' : ''
					);

					echo "\n" ;

				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fsvgallery' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">

				<?php comment_text(); ?>

				<p class="comment-meta"><?php edit_comment_link( __( 'Edit', 'fsvgallery' ), '', ' | ' ); ?><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'fsvgallery' ), 'before' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></p>

			</section><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;


/**
 * Set up post entry meta.
 *
 * @since FSV GALLERY 1.0
 */
if ( ! function_exists( 'fsvgallery_entry_meta' ) ) :

function fsvgallery_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'fsvgallery' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'fsvgallery' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'fsvgallery' ), get_the_author() ) ),
		get_the_author()
	);

	$utility_text = __( '<span class="meta-title">- Category -</span> <span class="meta-category">%1$s</span>', 'fsvgallery' );

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * @since FSV GALLERY 1.0
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function fsvgallery_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'eee', 'eeeeee' ) ) )
			$classes[] = 'custom-background-default';
	}

	return $classes;
}
add_filter( 'body_class', 'fsvgallery_body_class' );

/**
 * These codes are used to include the number of posts in <a> tag in the category widget.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_num_categories( $output ) {
  $output = preg_replace('/<\/a>\s*\((\d+)\)/',' <span class="articles_count">($1)</span></a>',$output);
  return $output;
}
add_filter( 'wp_list_categories', 'fsvgallery_num_categories', 10, 2 );

/**
 * These codes are used to include the number of posts in <a> tag in the archives widget.
 *
 * @since FSV GALLERY 1.0
 */
function fsvgallery_num_archives( $output ) {
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' <span class="articles_count">($2)</span></a>',$output);
  return $output;
}
add_filter( 'get_archives_link', 'fsvgallery_num_archives' );

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 1200;

?>
