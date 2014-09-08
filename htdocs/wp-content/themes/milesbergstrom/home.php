<?php
/*
Template Name: home
*/
get_header(); ?>

<div class="hero-background">
	<?php if( get_field('hero-background') ): ?>
 		<img src="<?php the_field('hero-background'); ?>" />
	<?php endif; ?>
</div>

<div id="hero-<?php the_title(); ?>" class="hero">
	<?php if( get_field('hero-content') ): ?>
		<?php get_field('hero-content') ?>
	<?php endif ?>
</div><!--hero-->

<?php get_header(); ?>

	<div class="small-12 columns" role="main">
		<div class="contain content clearfix" id="main-content">
			
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
			
			
			<?php echo do_shortcode("[flickr_photostream max_num_photos='50' no_pages='true']"); ?>
			
			<div id="instagramFeed" class="clearfix">
				<?php/*
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=6 & category_name=instagram'.'&paged='.$paged);
				*/
				$instagram = new WP_Query(array(
				'posts_per_page' => 6,
				'category_name' => 'instagram'
			));
				?>
				<?php if ( $instagram->have_posts() ): ?>
				<ol>
				<?php while ( $instagram->have_posts() ) : ?>
				<?php $instagram->the_post(); ?>
					<li class="ig_item small-2 left">
						<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">   
							<?php the_post_thumbnail( array(400,400,true) ); ?>
						</a>
					</li>
				<?php endwhile; ?>
				</ol>
				<?php else: ?>
				<h2 class="centered">No instagram posts</h2>
				<?php endif; ?>
			</div><!--instagram feed-->
	
		</div>
	</div>
		
<?php get_footer(); ?>