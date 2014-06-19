<?php
/**
 * The template for displaying all pages.
 *
 * Template Name:Press Page
 * Description: Page template with a content container and right sidebar
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 *
 * Last Revised: July 16, 2012
 */
get_header(); ?>
<?php
// The Query
query_posts('cat=16');
?>

  
  <div class="container">

<div class="row content">
  <div class="span11">
  <header class="overview">
		<h3><?php
		if ( is_category() ) {
			printf( __( ' %s', 'bootstrapwp' ), '<span>' . single_cat_title( '', false ) . '</span>' );
		} else {
			_e( 'Blog Archives', 'bootstrapwp' );
		}
		?></h3>
</header><!-- overview -->	
 <?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
<header class="single-post-header"><h3><?php the_title();?></h3></header>
    <?php the_content(); ?>
    </article><!-- .post-class -->
    <hr />


 <?php endwhile; // end of the loop
// Reset Query
wp_reset_query(); // resetting the loop
?> 
</div><!-- /.span11 -->
</div><!-- /.row -->
 <?php bootstrapwp_content_nav('nav-below');?>

<?php get_footer(); ?>