<?php
/**
 * The template for displaying Archive pages.
 *
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.6
 */

get_header();
if (have_posts() ) ;?>
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
			</header>		
			<div id="tiles"><!-- isotope begins here... -->
					<?php while ( have_posts() ) : the_post(); ?>
					<?php
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
					$url = $thumb['0'];
					?>
				<div class="item">
	  			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
	  			<div class="img-title">
	    		<p><a href="<?php the_permalink(); ?>"><?php the_title();?></a></p>
	  		</div><!-- end of .item -->
			</div><!-- /.tiles -->
				<?php endwhile; ?>
	
				</div><!-- /.span11 -->
 	</div><!-- /.row .content -->
</div><!-- container -->

<?php get_footer(); ?>