<?php
/**
 * Template Name: Home Hero Template with 3 widget areas
 *
 *
 * @package WP-Bootstrap
 * @subpackage Default_Theme
 * @since WP-Bootstrap 0.5
 *
 * Last Revised: July 16, 2012
 */
get_header(); ?>
<div class="jumbotron masthead">
<div id="iso" class="container">
    <div id="tiles"><!-- isotope begins here... -->
    <!--  <h1><?php the_title();?></h1>-->
<?php
// The Query
query_posts('cat=3');
?>
<?php 
// The Loop 
if (have_posts()) : while ( have_posts() ) : the_post(); ?>

<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="element">
  <a href="<?=$url?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('large'); ?></a>
  <div class="img-title">
    <p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
  </div>
</div><!-- .element -->

<?php endwhile; endif; 
// Reset Query
wp_reset_query();
?>  
    </div><!-- .tiles -->
    </div><!-- container -->
</div><!-- .jumbotron -->

<div class="container">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.isotope.min.js"></script>
<script>
  $(function(){
    var $container = $('#tiles');
    $container.imagesLoaded( function(){
      $container.isotope({
        itemSelector : '.element',
        layoutMode : 'masonry'
      });   
    });
  });
</script>
  <div class="marketing">
  <div class="row-fluid">
    <div class="span4">
      <?php
if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( "home-left" );
?>
    </div>
    <div class="span4">
      <?php
if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( "home-middle" );
?>
    </div>
    <div class="span4">
      <?php
if ( function_exists( 'dynamic_sidebar' ) ) dynamic_sidebar( "home-right" );
?>
    </div>
  </div>
</div><!-- /.marketing -->
</div>
<?php get_footer();?>
