<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "row" div and all content after.
 *
 * @package OcimPress
 * @subpackage Arsa
 * @since Arsa 1.0
 */
?>
                        </div><!-- end row -->
                </div><!-- end content -->
        </div><!-- end container -->
</div><!-- end wrapper -->

<div id="footer">
	<div class="container">
		<div id="footer-logo">
			<a href="<?php bloginfo('url');?>"><img src="<?php echo get_home_url();?>/oc-content/uploads/logo.png"></a> 
		</div><!-- .footer-logo -->
		<ul>
			<li><a href="/">Privacy</a></li>
			<li><a href="/">TOS</a></li>
			<li><a href="/">About Us</a></li>
		</ul>
		<div id="social-icons">
			<div class="social-size"><a href="/"><i class="step fi-social-facebook"></i></a></div> 
			<div class="social-size"><a href="/"><i class="step fi-social-twitter"></i></a></div> 
			<div class="social-size"><a href="/"><i class="step fi-social-google"></i></a></div>
		</div><!-- .site-footer -->
	</div><!-- .container -->
</div><!-- .footer -->

<?php ocim_footer(); ?>

</BODY>
</html>