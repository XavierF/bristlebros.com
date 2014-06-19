<?php
/**
 *
 * Default Page Header
 *
 * @package WP-Bootstrap
 * @subpackage Default_Theme
 * @since WP-Bootstrap 0.1
 *
 * Last Revised: August 15, 2012
 */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
   <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;
  wp_title( '|', true, 'right' );
  // Add the blog name.
  bloginfo( 'name' );
  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";
  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'bootstrapwp' ), max( $paged, $page ) );
  ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="San Francisco, Bay Area, Mural Painting, sign painting, scenic painting,  painting,  Residential, Commercial" />
<meta name="description" content="Artists" />
<meta name="URL" content="http://bristlebros.com" />
<meta name="author" content="Wordpress site Developed by Xavier F @ XavierF.Biz, Responsive Web Design Technology" />
<meta property="og:title" content="Bristle Bros." />
<meta property="og:type" content="Artists" />
<meta property="og:url" content="http://bristlebros.com/" />
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/img/bristlebros-logo.jpg" />
<meta property="og:site_name" content="Bristle Brothers.com" />
<meta property="fb:admins" content="1273775628" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="<?php bloginfo( 'template_url' );?>/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'template_url' );?>/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'template_url' );?>/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'template_url' );?>/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_url' );?>/ico/apple-touch-icon-57-precomposed.png">
 <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<?php wp_head(); ?>
     <link href="http://fonts.googleapis.com/css?family=Tinos" rel="stylesheet" type="text/css">
     <?php if( is_page('contact') ){ ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/verif.js"></script>
    <?php }?>
  </head>
<body <?php body_class(); ?>  data-spy="scroll" data-target=".bs-docs-sidebar" data-offset="10" padding-bottom:0;><div id="fb-root"></div>
  <div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="inner-container">     
              <a class="brand" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/img/briscard-hdr.png"></a>
              <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span>Menu</span>
              </button>      
              <?php
               /** Loading WordPress Custom Menu  **/
               wp_nav_menu( array(
                  'menu'            => 'main-menu',
                  'container_class' => 'nav-collapse',
                  'menu_class'      => 'nav',
                  'fallback_cb'     => '',
                  'menu_id' => 'main-menu',
                  'walker' => new Bootstrapwp_Walker_Nav_Menu()
              ) ); ?>
            </div><!-- .inner-container -->
        </div><!-- .container -->
      </div><!-- .navbar-inner -->
    </div><!-- .navbar -->
    <!-- End Header -->
<!-- Begin Template Content -->