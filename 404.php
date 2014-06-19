<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.7
 *
 * Last Revised: January 22, 2012
 */
get_header(); ?>
  <div class="row">
  <div class="container">
   <?php if (function_exists('bootstrapwp_breadcrumbs')) bootstrapwp_breadcrumbs(); ?>
   </div><!--/.container -->
   </div><!--/.row -->
   <div class="container">

      
 <!-- Masthead
      ================================================== -->
     
	  
        <div class="row content">
					

<div class="well">
 <header class="jumbotron subhead" id="overview">
        <h3><?php _e( 'Not Found!', 'bootstrapwp' ); ?></h3>
        <p class="pull"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help you find what you&rsquo;re looking for.', 'bootstrapwp' ); ?></p>
      </header>
					<?php get_search_form(); ?>

</div><!--/.well -->
<div class="row">
<div class="span4">
					<h2>All Pages</h2>
					<?php wp_page_menu(); ?>
</div><!--/.span4 -->
<div class="span4">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
</div><!--/.span4 -->
<div class="span4">
<h2><?php _e( 'Most Used Categories', 'bootstrapwp' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
</div><!--/.span4 -->
</div><!--/.row -->
</div><!-- .row content -->
<?php get_footer(); ?>