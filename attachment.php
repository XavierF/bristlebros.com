<?php
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="row">
  <div class="container">
   <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
   </div><!--/.container -->
   </div><!--/.row -->
    <div class="container">
        <div class="row content">
<div class="span11 clearfix">
      <header class="post-title">
        <h3><?php the_title();?></h3>
      </header>
      		<?php add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 4);
function remove_img_width_height( $html, $post_id, $post_image_id,$post_thumbnail) {
    if ($post_thumbnail=='gallery'){
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    }
    return $html;
}?>
     <!--  <?php if (is_attachment()) echo $image_info = getimagesize($post->guid); ?> of hope -->
<img class="lrg-image" src="<?php if (is_attachment()) echo $post->guid; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
            <?php the_content();?>
           <div class="post-meta clearfix">	
				        	<p class="meta"><?php echo bootstrapwp_posted_on();?></p>
				        	<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
<ul class="post-social">
            <li class="fb-like" data-href="http://bristlebros.com/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="tahoma"></li>
			<li style = "width: 80px;"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-via="your_screen_name">Tweet</a></li>
			<li class="g-plus" data-action="share" data-annotation="bubble"></li>
			<li style = "width: 40px;"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" count-layout="true"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></li>
</ul><!-- .social -->  
 </div><!-- .post-meta --> 
<?php endwhile; // end of the loop. ?>
<hr />
 <?php bootstrapwp_content_nav('nav-below');?>
          </div><!-- /.span11 -->
		 </div><!-- /.row .content -->
  </div><!-- .container -->
<?php get_footer(); ?>