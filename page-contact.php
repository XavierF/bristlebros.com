<?php
/**
 * The template for displaying contact.
 *
 * Template Name: Contact
 * Description: Contact Page template with a content container 
 *
 * @package WordPress
 * @subpackage WP-Bootstrap
 * @since WP-Bootstrap 0.1
 *
 * Last Revised: July 16, 2012
 */
?>
<?php
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('xavierf424@gmail.com');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('xavierf424@gmail.com');
		}
		$subject = 'Email message From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <div class="row">
  <div class="container">
   </div><!--/.container -->
   </div><!--/.row -->
   <div class="container">
        <div class="row content">
<div class="span11 clearfix">
	 <header class="page-title">
        <h3><?php the_title();?></h3>
     </header>
            <!-- contact form starts here! -->
  <?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="success">
								<p>Thank you, your message has been sent. We will reply to you shortly.</p>
								<img src="<?php bloginfo('template_directory'); ?>/img/briscard-hdr.png">
							</div>
						<?php } else { ?>
							<?php the_content(); ?>
 <form class="form-horizontal" action="<?php the_permalink(); ?>" method="post" >
  		<p class="require">Contact us using the form below ( <span>*</span> Indicates required fields )</p>
  		<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error">Please fill in the required fields indicated below.<p>
							<?php } ?>
  				<div class="control-group">
      					<label class="control-label" for="contactName">Name: <span>*</span></label>
 					<div class="controls">
 						<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" />
								<?php if($nameError != '') { ?><span class="error"><?=$nameError;?></span><?php } ?>
 					</div><!-- .controls -->
 				</div><!-- .control-group -->
 				<div class="control-group">
    					<label class="control-label" for="email">Email <span>*</span></label>
    				<div class="controls">
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
								<?php if($emailError != '') { ?><span class="error"><?=$emailError;?></span><?php } ?>
					</div><!-- .controls -->
				</div><!-- .control-group -->
				<div class="control-group">
    					<label class="control-label" for="commentsText">Message: <span>*</span></label>
    				<div class="controls">
								<textarea name="comments" id="commentsText" rows="10"  class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
								<?php if($commentError != '') { ?><span class="error"><?=$commentError;?></span><?php } ?>
					</div><!-- .controls -->
				</div><!-- .control-group -->
    		<div class="control-group">
    		<div class="controls">
    			<button class="btn" type="submit">Send</button> <span class="no-share"> Your information will not be shared</span>
    		</div><!-- .controls -->
				</div><!-- .control-group -->
     <input type="hidden" name="submitted" id="submitted" value="true" />
  </form>
 
  <?php } ?>
<?php endwhile; // end of the loop. ?>
 </div><!-- /.span11 -->
</div><!-- /.row .content -->
</div><!-- .container -->
<?php get_footer(); ?>