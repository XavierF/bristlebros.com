<?php
/**
 * Default Footer
 *
 * @package WP-Bootstrap
 * @subpackage Default_Theme
 * @since WP-Bootstrap 0.1
 *
 * Last Revised: July 16, 2012
 */
?>
    <!-- End Template Content -->
		<footer>
			<div class="container">
		    <p class="footer">&copy; <?php the_time('Y') ?> <?php bloginfo('name'); ?> </p>
		          <?php if ( function_exists('dynamic_sidebar')) dynamic_sidebar("footer-content"); ?>
				<p class="visible-phone"><a href="#">Back to top</a></p>
		  </div> <!-- /container -->
		</footer>
			<?php wp_footer(); ?>
  </body>
</html>