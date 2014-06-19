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
<?php
// The Query
query_posts('cat=15');
?>
<div class="jumbotron">
  <div class="container clearfix">
    <div class="flexslider">
      <ul class="slides">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $url = $thumb['0'];
        ?>
        <li>
          <?php the_post_thumbnail('large'); ?>
        </li>
        <?php endwhile; endif; 
        // Reset Query
        wp_reset_query();
        ?>  
       </ul>
    </div><!-- .flexslider -->
  </div><!-- .container -->
</div><!-- .jumbotron -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script>
$(window).load(function() {
    $('.flexslider').flexslider({
          animation: "slide",
          easing: "swing",
          slideshow: true
    });
});
  </script>
</div>
<?php get_footer();?>
