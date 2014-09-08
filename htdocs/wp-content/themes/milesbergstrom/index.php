<?php get_header(); ?>

	<script>
	
	function parallax() {
    var ev = {
        scrollTop: document.body.scrollTop || document.documentElement.scrollTop
    };
    ev.ratioScrolled = ev.scrollTop / (document.body.scrollHeight - document.documentElement.clientHeight);
    render(ev);
	}
	
	function render(ev) {
    var t = ev.scrollTop;
    var y = Math.round(t * 2/3) - 0;
    jQuery('#hero-home').css('background-position', '0 ' + y + 'px');
	}
	
	jQuery(window).scroll(function () {
		parallax();
	});
	
		
	</script>

	<div class="hero" id="hero-home">
		<div class="contain centered">
			<a href="#main-content">
				<img class="rocket" src="<?php echo home_url(); ?>/wp-content/uploads/milesbergs_03.png" alt="rocketship" />
			</a>
			<h1> <?php bloginfo('description'); ?> </h1>
		</div>
	</div>

	<div class="small-12 columns" role="main">
		<div class="row content" id="main-content">
			
		<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=9 & category_name=video'.'&paged='.$paged);
				?>
			<?php if ( have_posts() ): ?>
				<ol class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="work-thumb left small-12 medium-6 large-4">
					<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
						
						<div class="thumb-wrap">
							<div class="overlay">
								<h3 class="title"> <?php the_title(); ?> </h3>
								
								<div class="caption">
									<?php
									$category = get_the_category(); 
									echo "<p> posted in ".$category[0]->cat_name."</p>";
									?>
								</div>

								
								
								<p> <?php the_field('description'); ?> </p>
							</div><!--overlay-->
							<?php the_post_thumbnail( array(500,400,true) ); ?>
						</div><!--thumb-wrap-->
						
					</a>
				</li>
			<?php endwhile; ?>
				</ol>
			<?php else: ?>
				<h1>No posts to display</h1>
			<?php endif; ?>
	
		</div><!--row?-->
	</div>
	
	
		<h1 class="text-center"><i class="fa fa-instagram"></i><b> Instagram</b></h1>
		<div id="instagramFeed" class="clearfix">
			<div class="row collapse full-width">
				<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=6 & category_name=instagram'.'&paged='.$paged);
				?>
				<?php if ( have_posts() ): ?>
				<ol>
				<?php while ( have_posts() ) : the_post(); ?>
					<li class="ig_item small-2 columns">
						<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">   
							<?php the_post_thumbnail( array(400,400,true) ); ?>
						</a>
					</li>
				<?php endwhile; ?>
				</ol>
				<?php else: ?>
				<h2 class="centered">No instagram posts</h2>
				<?php endif; ?>
			</div>
		</div><!--instagram feed-->

<?php get_footer(); ?>