<?php
/**
 * Bootstrap functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 *
 */

if (!defined('BOOTSTRAPWP_VERSION')) {
    define('BOOTSTRAPWP_VERSION', '.91');
}

if (!isset($content_width)) {
    $content_width = 1170;
} /* pixels */

/**
 * Setup Theme Functions
 * Loads theme's textdomain for translation
 * Adds theme support for post-formats, post-thumbnails & automatic-feed-links
 * Uses register_nav_menus to register theme's custom menu
 */
add_action('after_setup_theme', 'bootstrapwp_theme_setup');
if (!function_exists('bootstrapwp_theme_setup')):
    function bootstrapwp_theme_setup()
    {
        load_theme_textdomain('bootstrapwp', get_template_directory() . '/lang');
        add_theme_support('automatic-feed-links');
        add_theme_support('post-thumbnails');
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'gallery',
                'link',
                'quote',
                'status',
                'video',
                'audio',
                'chat'
            )
        );
        register_nav_menus(
            array(
                'main-menu' => __('Main Menu', 'bootstrapwp'),
            )
        );
    }
endif;

function bootstrapwp_head_cleanup() {
    // category feeds
    // remove_action( 'wp_head', 'feed_links_extra', 3 );
    // post and comment feeds
    // remove_action( 'wp_head', 'feed_links', 2 );
    // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
    // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // index link
    remove_action( 'wp_head', 'index_rel_link' );
    // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
    // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
    // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    // WP version
    remove_action( 'wp_head', 'wp_generator' );
    // remove WP version from css
    add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
    // remove Wp version from scripts
    add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bootstrap head cleanup */

// remove WP version from RSS
function bootstrapwp_rss_version() { return ''; }

// remove WP version from scripts
function bootstrapwp_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function bootstrapwp_remove_wp_widget_recent_comments_style() {
   if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function bootstrapwp_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function bootstrapwp_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}

/**
 * remove inline gallery styles
 */
add_filter( 'use_default_gallery_style', '__return_false' );
/**
 * Setup image sizes
 * Declares size of post thumbnails
 * Adds two additional image sizes
 */

function bootstrapwp_images()
{
    set_post_thumbnail_size(160, 120); // 160 pixels wide by 120 pixels high
    add_image_size('bootstrap-small', 260, 180); // 260 pixels wide by 180 pixels high
    add_image_size('bootstrap-medium', 360, 270); // 360 pixels wide by 270 pixels high
    add_image_size('bootstrap-large', 800, 1170); // 360 pixels wide by 270 pixels high
}

/**
 * Load CSS Styles & JavaScript Files
 * Uses wp_enqueue_script()
 */
function bootstrapwp_scripts_styles_loader()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script(
        'bootstrapjs',
        get_template_directory_uri() . '/library/js/bootstrap.min.js',
        array('jquery'),
        '0.91',
        true
    );
    wp_enqueue_script(
        'flexsiderjs',
        get_template_directory_uri() . '/library/js/slick.min.js',
        array('jquery'),
        '0.91',
        true
    );
    wp_enqueue_script(
        'isotopejs',
        get_template_directory_uri() . '/library/js/jquery.isotope.min.js',
        array('jquery'),
        '0.91',
        true
    );


     wp_enqueue_style(
        'bootstrap-style',
        get_template_directory_uri() . '/library/css/bootstrap.min.css',
        false,
        '0.91',
        'all'
    );
    wp_enqueue_style(
        'bootstrap-responsive-style',
        get_template_directory_uri() . '/library/css/bootstrap-responsive.min.css',
        false,
        '0.91',
        'all'
    );

    wp_enqueue_style(
        'bootstrapwp-child-style ', 
        get_template_directory_uri() . '/library/css/child.css',
        false,
        '0.91',
        'all'
    );

 
}

add_action('wp_enqueue_scripts', 'bootstrapwp_scripts_styles_loader');

/*
| -------------------------------------------------------------------
| Top Navigation Bar Customization
| -------------------------------------------------------------------

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function bootstrapwp_page_menu_args($args)
{
    $args['show_home'] = true;

    return $args;
}

add_filter('wp_page_menu_args', 'bootstrapwp_page_menu_args');

/**
 * Get file 'includes/class-bootstrap_walker_nav_menu.php' with Custom Walker class methods
 * */

include 'includes/class-bootstrapwp_walker_nav_menu.php';

/*
| -------------------------------------------------------------------
| Registering Widget Sections
| -------------------------------------------------------------------
| */
function bootstrapwp_widgets_init()
{
    register_sidebar(
        array(
            'name'          => __('Page Sidebar', 'bootstrapwp'),
            'id'            => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Posts Sidebar', 'bootstrapwp'),
            'id'            => 'sidebar-posts',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => "</div>",
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Left', 'bootstrapwp'),
            'id'            => 'home-left',
            'description'   => __('Left textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Middle', 'bootstrapwp'),
            'id'            => 'home-middle',
            'description'   => __('Middle textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Home Right', 'bootstrapwp'),
            'id'            => 'home-right',
            'description'   => __('Right textbox on homepage', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name'          => __('Footer Content', 'bootstrapwp'),
            'id'            => 'footer-content',
            'description'   => __('Footer text or acknowledgements', 'bootstrapwp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>'
        )
    );
}

add_action('init', 'bootstrapwp_widgets_init');

if (!function_exists('bootstrapwp_excerpt')):
    /*
    | -------------------------------------------------------------------
    | Revising Default Excerpt
    | -------------------------------------------------------------------
    | Adding filter to post excerpts to contain ...Continue Reading link
    | */
    function bootstrapwp_excerpt($more)
    {
        global $post;

        return '&nbsp; &nbsp;<a href="' . get_permalink($post->ID) . '">' . __(
            '...Continue Reading',
            'bootstrapwp'
        ) . '</a>';
    }

    add_filter('excerpt_more', 'bootstrapwp_excerpt');
endif;

if (!function_exists('bootstrapwp_content_nav')):
    /**
     * Display navigation to next/previous pages when applicable
     */
    function bootstrapwp_content_nav($nav_id)
    {
        global $wp_query;

        if ($wp_query->max_num_pages > 1) : ?>
        <nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
            <h3 class="assistive-text"><?php _e('Post navigation', 'bootstrapwp'); ?></h3>

            <div class="nav-previous alignleft"><?php next_posts_link(
                __('<span class="meta-nav">&larr;</span> Older posts', 'bootstrapwp')
            ); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link(
                __('Newer posts <span class="meta-nav">&rarr;</span>', 'bootstrapwp')
            ); ?></div>
        </nav><!-- #<?php echo $nav_id; ?> .navigation -->
        <?php endif;
    }
endif; // bootstrapwp_content_nav

if (!function_exists('bootstrapwp_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since WP-Bootstrap .5
     */
    function bootstrapwp_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
  <li class="comment media" id="comment-<?php comment_ID(); ?>">
    <div class="media-body">
        <p><?php _e('Pingback:', 'bootstrapwp'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(
            __('(Edit)', 'bootstrapwp'),
            '<span class="edit-link">',
            '</span>'
        ); ?></p>
    </div><!--/.media-body -->
                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>
                <li class="comment-media" id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment">
                        <a href="<?php echo $comment->comment_author_url;?>" class="pull-left">
                            <?php echo get_avatar($comment, 64); ?>
                        </a>
                        <div class="media-body">

                            <header class="comment-meta comment-author vcard">
                                <h4 class="media-heading">
                                    <?php
                                    printf(
                                        '<cite class="fn">%1$s %2$s</cite>',
                                        get_comment_author_link(),
                                        // If current post author is also comment author, make it known visually.
                                        ($comment->user_id === $post->post_author) ? '<span class="label"> ' . __(
                                            'Post author',
                                            'bootstrapwp'
                                        ) . '</span> ' : ''
                                    );
                                    printf(
                                        '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                        esc_url(get_comment_link($comment->comment_ID)),
                                        get_comment_time('c'),
                                        /* translators: 1: date, 2: time */
                                        sprintf(
                                            __('%1$s at %2$s', 'bootstrapwp'),
                                            get_comment_date(),
                                            get_comment_time()
                                        )
                                    );
                                    ?>
                                    </h4>
                               <span class="comment-awaiting-moderation"><?php _e(
                                'Your comment is awaiting moderation.',
                                'bootstrapwp'
                            ); ?></span>
                            </header>
                            <!-- .comment-meta -->

                            <?php if ('0' == $comment->comment_approved) : ?>

                            
                            <?php endif; ?>

                            <section class="comment-content">
                                <?php comment_text(); ?>
                                <?php edit_comment_link(__('Edit', 'bootstrapwp'), '<p class="edit-link">', '</p>'); ?>
                               

                            </section>
                            <!-- .comment-content -->
 <p class="reply">
                                    <?php comment_reply_link(
                                    array_merge(
                                        $args,
                                        array(
                                            'reply_text' => __('Reply <span>&darr;</span>', 'bootstrapwp'),
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                        )
                                    )
                                ); ?>
                                </p><!-- .reply -->
                        </div>
                        <!--/.media-body -->

                    </article>
                    <!-- #comment-## -->
                <?php
                break;
        endswitch;
    }
endif; // ends check for bootstrapwp_comment()

if (!function_exists('bootstrapwp_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     * Create your own bootstrap_posted_on to override in a child theme
     *
     * @since WP-Bootstrap .5
     */
    function bootstrapwp_posted_on()
    {
        printf(
            __(
                '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>',
                'bootstrap'
            ),
            esc_url(get_permalink()),
            esc_attr(get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_attr(sprintf(__('View all posts by %s', 'bootstrap'), get_the_author())),
            esc_html(get_the_author())
        );
    }
endif;

/**
 * Adds custom classes to the array of body classes.
 *
 * @since WP-Bootstrap .5
 */

function bootstrapwp_body_classes($classes)
{
    // Adds a class of single-author to blogs with only 1 published author
    if (!is_multi_author()) {
        $classes[] = 'single-author';
    }

    return $classes;
}

add_filter('body_class', 'bootstrapwp_body_classes');

/**
 * Returns true if a blog has more than 1 category
 *
 * @since WP-Bootstrap .5
 */
function bootstrapwp_categorized_blog()
{
    if (false === ($all_the_cool_cats = get_transient('all_the_cool_cats'))) {
        // Create an array of all the categories that are attached to posts
        $all_the_cool_cats = get_categories(
            array(
                'hide_empty' => 1,
            )
        );

        // Count the number of categories that are attached to the posts
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('all_the_cool_cats', $all_the_cool_cats);
    }

    if ('1' != $all_the_cool_cats) {
        // This blog has more than 1 category so bootstrap_categorized_blog should return true
        return true;
    } else {
        // This blog has only 1 category so bootstrap_categorized_blog should return false
        return false;
    }
}

/**
 * Flush out the transients used in bootstrapwp_categorized_blog
 *
 * @since bootstrap 1.2
 */
function bootstrapwp_category_transient_flusher()
{
    // Like, beat it. Dig?
    delete_transient('all_the_cool_cats');
}

add_action('edit_category', 'bootstrapwp_category_transient_flusher');
add_action('save_post', 'bootstrapwp_category_transient_flusher');

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function bootstrapwp_enhanced_image_navigation($url)
{
    global $post;

    if (wp_attachment_is_image($post->ID)) {
        $url = $url . '#main';
    }

    return $url;
}

add_filter('attachment_link', 'bootstrapwp_enhanced_image_navigation');

/*
| -------------------------------------------------------------------
| Checking for Post Thumbnail
| -------------------------------------------------------------------
|
| */
function bootstrapwp_post_thumbnail_check()
{
    global $post;
    if (get_the_post_thumbnail()) {
        return true;
    } else {
        return false;
    }
}

/*
| -------------------------------------------------------------------
| Setting Featured Image (Post Thumbnail)
| -------------------------------------------------------------------
| Will automatically add the first image attached to a post as the Featured Image if post does not have a featured image previously set.
| */
function bootstrapwp_autoset_featured_img()
{
    global $post;

    $post_thumbnail = bootstrapwp_post_thumbnail_check();
    if ($post_thumbnail == true) {
        return the_post_thumbnail();
    }
    if ($post_thumbnail == false) {
        $image_args     = array(
            'post_type'      => 'attachment',
            'numberposts'    => 1,
            'post_mime_type' => 'image',
            'post_parent'    => $post->ID,
            'order'          => 'desc'
        );
        $attached_image = get_children($image_args);
        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }

            return the_post_thumbnail();
        } else {
            return " ";
        }
    }
} //end function

/*
| -------------------------------------------------------------------
| Formatting Page Title Elements
| -------------------------------------------------------------------
| Conditionally determines default title to display.
| */
function bootstrapwp_wp_title($title, $sep)
{
    global $paged, $page;

    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page())) {
        $title = "$title $sep $site_description";
    }

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2) {
        $title = "$title $sep " . sprintf(__('Page %s', 'bootstrapwp'), max($paged, $page));
    }

    return $title;
}

add_filter('wp_title', 'bootstrapwp_wp_title', 10, 2);
/*
| -------------------------------------------------------------------
| Adding Breadcrumbs
| -------------------------------------------------------------------
|
| */
function bootstrapwp_breadcrumbs()
{
    $delimiter = '<span class="divider">/</span>';
    $home      = 'Home'; // text for the 'Home' link
    $before    = '<li class="active">'; // tag before the current crumb
    $after     = '</li>'; // tag after the current crumb

    if (!is_home() && !is_front_page() || is_paged()) {

        echo '<ul class="breadcrumb">';

        global $post;
        $homeLink = home_url();
        echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

        if (is_category()) {
            global $wp_query;
            $cat_obj   = $wp_query->get_queried_object();
            $thisCat   = $cat_obj->term_id;
            $thisCat   = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) {
                echo get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
            }
            echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;

        } elseif (is_day()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                'Y'
            ) . '</a></li> ' . $delimiter . ' ';
            echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time(
                'F'
            ) . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('d') . $after;

        } elseif (is_month()) {
            echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time(
                'Y'
            ) . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_time('F') . $after;

        } elseif (is_year()) {
            echo $before . get_the_time('Y') . $after;

        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug      = $post_type->rewrite;
                echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
                echo $before . get_the_title() . $after;
            }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;

        } elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            $cat    = $cat[0];
            echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
            echo '<li><a href="' . get_permalink(
                $parent
            ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;

        } elseif (is_page() && !$post->post_parent) {
            echo $before . get_the_title() . $after;

        } elseif (is_page() && $post->post_parent) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page          = get_page($parent_id);
                $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title(
                    $page->ID
                ) . '</a></li>';
                $parent_id     = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb . ' ' . $delimiter . ' ';
            }
            echo $before . get_the_title() . $after;

        } elseif (is_search()) {
            echo $before . 'Search results for "' . get_search_query() . '"' . $after;

        } elseif (is_tag()) {
            echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif (is_404()) {
            echo $before . 'Error 404' . $after;
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            ) {
                echo ' (';
            }
            echo __('Page', 'bootstrapwp') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()
            ) {
                echo ')';
            }
        }

        echo '</ul>';

    }
} // end bootstrapwp_breadcrumbs()


function getTinyUrl($url) { 
    $tinyurl = file_get_contents("http://tinyurl.com/api-create.php?url=".$url); 
    return $tinyurl; 
}
/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a bootstrap.
 */

 ?>