    <!-- End Template Content -->
		<footer>
			<div class="container">
        <p class="visible-phone"><a href="#">Back to top</a></p>
		    <p class="footer">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> </p>
		          <?php if ( function_exists('dynamic_sidebar')) dynamic_sidebar("footer-content"); ?>
				</p>
		  </div> <!-- /container -->
		</footer>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
			<?php wp_footer(); ?>

<script>
$(window).load(function() {
   $('.slider').slick({
        autoplay: true,
        dots: true,
        fade: false,
        autoplaySpeed: 3000,
        speed: 1500,
        swipe: true,
        adaptiveHeight: true
        });
    var $container = $('#tiles');
    $container.imagesLoaded( function(){
      $container.isotope({
        itemSelector : '.item',
        layoutMode : 'masonry',
        gutter: 10
      });   
    });
});
  </script>
  </body>
</html>

