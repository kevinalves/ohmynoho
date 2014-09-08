</section>
	
	<div class="content clearfix" id="contact">
		<div class="small-11 large-8 columns small-centered">
		<h1>What's your story?</h1>
			<?php echo do_shortcode('[contact-form-7 id="30" title="Contact form 1"]'); ?>
		</div>
	</div>

<footer class="clearfix">
	<?php dynamic_sidebar("footer-widgets"); ?>
	
	<div class="small-12 medium-6 columns left small-centered">
		<p>&copy; <?php echo the_date(Y); ?> Miles Bergstrom, all rights reserved
	</div>

	<div class="small-12 medium-6 columns right text-right small-centered socialmedia">
		<h2>
			<a href="https://www.linkedin.com/pub/miles-bergstrom/21/225/789"> <i class="fa fa-linkedin"></i> </a>
			<a href="http://instagram.com/milesbergs"> <i class="fa fa-instagram"></i>
			<a href="https://twitter.com/milesbergs_"> <i class="fa fa-twitter"></i> </a>
			<a href="https://vimeo.com/mberg"> <i class="fa fa-vimeo-square"></i> </a>
		</h2>
	</div>
	
</footer>
<a class="exit-off-canvas"></a>
	
	
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>