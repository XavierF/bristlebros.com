<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.6
 */

get_header();
if (have_posts() ) ;?>
<div class="row">
	<div class="container">
		<?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
	</div><!--/.container -->
</div><!--/.row -->
<div class="container">
<div class="row content">
	<div class="span11 clearfix">
		<header class="overview">
		<h3><?php
		if ( is_day() ) {
			printf( __( 'Daily Archives: %s', 'bootstrapwp' ), '<span>' . get_the_date() . '</span>' );
		} elseif ( is_month() ) {
			printf( __( 'Monthly Archives: %s', 'bootstrapwp' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bootstrapwp' ) ) . '</span>' );
		} elseif ( is_year() ) {
			printf( __( 'Yearly Archives: %s', 'bootstrapwp' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bootstrapwp' ) ) . '</span>' );
		} elseif ( is_tag() ) {
			printf( __( '%s', 'bootstrapwp' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					// Show an optional tag description
			$tag_description = tag_description();
			if ( $tag_description )
				echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
		} elseif ( is_category() ) {
			printf( __( ' %s', 'bootstrapwp' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					// Show an optional category description
			$category_description = category_description();
			if ( $category_description )
				echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
		} else {
			_e( 'Blog Archives', 'bootstrapwp' );
		}
		?></h3>
		
		<?php
		add_filter('wp_get_attachment_link', 'remove_img_width_height', 10, 4);
function remove_img_width_height( $html, $post_id, $post_image_id,$post_thumbnail) {
    if ($post_thumbnail=='gallery'){
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    }
    return $html;
}
	 ?>	
</header>		
		<?php while ( have_posts() ) : the_post(); ?>

		<div <?php post_class(); ?>>
			<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title();?></a></h3>
				  <?php the_content();?>
<div class="post-meta clearfix">	
		<p class="meta"><?php echo bootstrapwp_posted_on();?></p>
		<div id="fb-root"></div>
		 <ul class="post-social">
		 <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
		  <li class="fb-like"><fb:like href="<?php echo get_permalink(); ?>" show_faces="false" width="450"></fb:like></li>
		   
			<li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-via="your_screen_name" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>">Tweet</a></li>
			<li class="g-plus" data-action="share" data-annotation="bubble"></li>
			<li style = "width: 40px;display:inline-block;"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" count-layout="true"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></li>
		 </ul><!-- .social -->  
		 </div><!-- .post-meta --> 
</div><!-- /.post_class -->
<hr/>
			<?php endwhile; ?>
			<?php bootstrapwp_content_nav('nav-below');?>
</div><!-- /.span11 -->

 </div><!-- /.row .content -->
 </div><!-- container -->
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
<script>/*jQuery("dt.gallery-icon a").addClass("fancybox").attr("rel","fancybox").getTitle();*/</script>
		<?php get_footer(); ?>