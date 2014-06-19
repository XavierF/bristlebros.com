<?php
/**
 * Template Name: Isotope and lightbox page
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
<div class="container">
<div id="tiles"><!-- isotope begins here... -->
    <!--  <h1><?php the_title();?></h1>-->
<?php
// The Query
query_posts('cat=3');
?>
<?php 
// The Loop 
if (have_posts()) : while ( have_posts() ) : the_post();?>



<div class="element">
<a href="#" rel="box" class="item" title="<?php the_title();?>"><?php the_content();?></a>
<div id="title"><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><p><?php the_title();?></p></a></div>
</div><!-- .element -->
<?php endwhile; endif; 
// Reset Query
wp_reset_query();
?>  
    </div><!-- .tiles -->
    </div><!-- .container -->
</div><!-- .jumbotron -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/facybox.js"></script>

<script>

$(document).ready(function() {

	    var $container = $('#tiles');
  
    $container.isotope({
      itemSelector : '.element',
      layoutMode : 'cellsByRow',
      cellsByRow: {
    	    columnWidth: 290,
    	    rowHeight: 400
    	  }       
    }); 

 
$("a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']").facybox();

});
</script>

<div class="container">
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
</div><!-- .container -->
<?php get_footer();?>
