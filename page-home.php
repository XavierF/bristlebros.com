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


<div class="jumbotron">
  <div class="container clearfix">
    <div class="slider">

<?php if ( have_rows('slide' ) ) :?>

    <?php while ( have_rows( 'slide' ) ) : the_row();
         
        $image = wp_get_attachment_image_src(get_sub_field('slide_img'), 'large');
         //$url = $thumb['0'];
        // width = $image[1];
        // height = $image[2]; ?>
      
        <div><img src="<?php echo $image[0]; ?>"  /></div>
      

    <?php endwhile; endif; ?>
    </div><!-- .slides -->
  </div><!-- .container -->
</div><!-- .jumbotron -->

<section id="category">
  <div class="container panels">
    <div class="row">

      <div class="span4 panel">
        <a href="<?php the_field('mural_link'); ?>">
          <img src="<?php the_field('mural_img'); ?>" class="thumb">
          <h3><?php the_field('mural_text'); ?></h3>
        </a>
      </div><!-- .span4 -->

      <div class="span4 panel">
        <a href="<?php the_field('scenic_link'); ?>">
          <img src="<?php the_field('scenic_img'); ?>" class="thumb">
          <h3><?php the_field('scenic_text'); ?></h3>
        </a>
      </div><!-- .span4 -->

      <div class="span4 panel">
        <a href="<?php the_field('sign_link'); ?>">
          <img src="<?php the_field('sign_img'); ?>" class="thumb">
          <h3><?php the_field('sign_text'); ?></h3>
        </a>
      </div><!-- .span4 -->

    </div><!-- .row -->
  </div><!-- .container -->
</section>

<?php get_footer();?>
