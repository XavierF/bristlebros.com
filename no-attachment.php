<?php
/**
 * The template for displaying all posts.
 *
 * Default Post Template
 *
 * Page template with a fixed 940px container and right sidebar layout
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

  <div class="row">
  <div class="container">
   <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
   </div><!--/.container -->
   </div><!--/.row -->
    <div class="container">
        <div class="row content">
<div class="span10 offset1">
      <header class="post-title">
        <h3><?php the_title();?></h3>
      </header>
<p>out of time</p>
<!--  -->
      <?php echo $image_info = getimagesize($post->guid); ?>
<img class="lrg-image" src="<?php echo $post->guid; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
             <p class="meta"><?php echo bootstrapwp_posted_on();?></p>
            <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
<?php endwhile; // end of the loop. ?>
<hr />

 <?php bootstrapwp_content_nav('nav-below');?>

 <?php comments_template(); ?>

          </div><!-- /.span11 -->
		 </div><!-- /.row .content -->
  </div><!-- .container -->
<?php get_footer(); ?>