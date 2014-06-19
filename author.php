<?php
/**
 * The template for displaying Author Archive pages.
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 */
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php
	/* Queue the first post, that way we know
	 * what author we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	the_post();
	?>
	<div class="row">
		<div class="container">
			<?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
		</div><!--/.container -->
	</div><!--/.row -->
	<div class="container">
		<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
					?>
					<div class="row content">
					<div class="span11 clearfix">
		<header class="overview">
			<h3 class="page-title author"><?php printf( __( 'Posts by: %s', 'bootstrapwp' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
		</header>
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>
							<div <?php post_class(); ?>>
								<a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><h3><?php the_title();?></h3></a>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ></a>
									        	<?php the_content();?>
<div class="post-meta clearfix">	
<p class="meta"><?php echo bootstrapwp_posted_on();?><span> <?php if (is_author() ) echo the_tags('see more of '); ?></span></p>
<ul class="post-social">
<li class="fb-like" data-href="http://bristlebros.com/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="tahoma"></li>
			<li style = "width: 80px;"><a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-via="your_screen_name">Tweet</a></li>
			<li class="g-plus" data-action="share" data-annotation="bubble"></li>
			<li style = "width: 40px;"><a data-pin-config="beside" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" count-layout="true"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></li>
</ul><!-- .social -->  
 </div><!-- .post-meta --> 
</div><!-- /.post_class -->
<hr />
								<?php endwhile; ?>
							<?php endif; ?>
						</div><!-- /.span11 -->
 					</div><!-- /.row .content -->
						<?php get_footer(); ?>