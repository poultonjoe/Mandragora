<?php
/**
 * Mandragora functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package Mandragora
 * @since Madragora 1.0
 */

if ( ! function_exists( 'mandragora_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Mandragora 1.0
 */
function mandragora_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'mandragora', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('blog-thumb', 300, 200, array( 'center', 'center' ) );
	add_image_size('blog-post', 560, 560, array( 'center', 'center' ) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'mandragora' ),
		'language_switcher'  => __( 'Language Switcher Menu', 'mandragora' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif; // mandragora_setup
add_action( 'after_setup_theme', 'mandragora_setup' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Mandragora 1.0
 */
function mandragora_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'mandragora_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Mandragora 1.0
 */
function mandragora_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'mandragora-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'mandragora-script', get_template_directory_uri() . '/dist/index.js', array( 'jquery' ), '20160412', true );
}
add_action( 'wp_enqueue_scripts', 'mandragora_scripts' );

/**
 * Comment layout.
 *
 * @since Mandragora 1.0
 */
function mandragora_comments($comment, $args, $depth) { ?>
   <li <?php comment_class('comment'); ?>>
		<div class="comment-header">
			<div class="comment-author-avatar"><?php echo get_avatar($comment,$size='40'); ?></div>
			<h3 class="comment-author"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?></h3>
			<?php edit_comment_link(__('(Edit)', 'mandragora'),'  ','') ?>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			<time class="comment-date" datetime="<?php echo comment_time('c'); ?>"><?php the_time('l jS F Y'); ?> @ <?php the_time('g:iA'); ?></time>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
			<div class="alert info"><?php _e('Your comment is awaiting moderation.', 'mandragora') ?></div>
		<?php endif; ?>
		<div class="comment-body"><?php comment_text() ?></div>
<?php
}

function html_cut($text, $max_length, $suffix) {
    $tags   = array();
    $result = "";

    $is_open   = false;
    $grab_open = false;
    $is_close  = false;
    $in_double_quotes = false;
    $in_single_quotes = false;
    $tag = "";

    $i = 0;
    $stripped = 0;

    $stripped_text = strip_tags($text);

    while ($i < strlen($text) && $stripped < strlen($stripped_text) && $stripped < $max_length)
    {
        $symbol  = $text{$i};
        $result .= $symbol;

        switch ($symbol)
        {
           case '<':
                $is_open   = true;
                $grab_open = true;
                break;

           case '"':
               if ($in_double_quotes)
                   $in_double_quotes = false;
               else
                   $in_double_quotes = true;

            break;

            case "'":
              if ($in_single_quotes)
                  $in_single_quotes = false;
              else
                  $in_single_quotes = true;

            break;

            case '/':
                if ($is_open && !$in_double_quotes && !$in_single_quotes)
                {
                    $is_close  = true;
                    $is_open   = false;
                    $grab_open = false;
                }

                break;

            case ' ':
                if ($is_open)
                    $grab_open = false;
                else
                    $stripped++;

                break;

            case '>':
                if ($is_open)
                {
                    $is_open   = false;
                    $grab_open = false;
                    array_push($tags, $tag);
                    $tag = "";
                }
                else if ($is_close)
                {
                    $is_close = false;
                    array_pop($tags);
                    $tag = "";
                }

                break;

            default:
                if ($grab_open || $is_close)
                    $tag .= $symbol;

                if (!$is_open && !$is_close)
                    $stripped++;
        }

        $i++;
    }

    while ($tags)
        $result .= "</".array_pop($tags).">";

	if ($suffix)
		$result .= "<span>".$suffix."</span>";

    return $result;
}
