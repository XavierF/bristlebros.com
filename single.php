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
 
    <div class="container">
        <div class="row content">
		<div class="span11 clearfix">
      <header class="post-title"><h3><?php the_title();?></h3></header>
      		<?php add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 4);
function remove_img_width_height( $html, $post_id, $post_image_id,$post_thumbnail) {
    if ($post_thumbnail=='gallery'&&'size-full'){
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    }
    return $html;
}?>
            <?php the_content();?>
<div class="post-meta clearfix">	
	<p class="meta"><?php echo bootstrapwp_posted_on();?></p>
				        	<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?> 
 </div><!-- .post-meta -->         
<?php endwhile; // end of the loop. ?>
 <?php bootstrapwp_content_nav('nav-below');?>
          </div><!-- /.span11 -->
		 </div><!-- /.row .content -->
  </div><!-- .container -->
<?php get_footer(); ?>