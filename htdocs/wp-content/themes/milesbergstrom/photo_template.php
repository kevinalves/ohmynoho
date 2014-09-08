<?php
/*
Template Name: photo template
*/

get_header(); ?>

<div class="contain content clearfix">
	<div class="small-12" role="main">
	
		<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=18 & category_name=photo'.'&paged='.$paged);
				?>
			<?php if ( have_posts() ): ?>
				<ol>
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="work-thumb left small-12 medium-6 large-4">
					<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
						
						<div class="thumb-wrap">
							<div class="overlay">
								<h2 class="title"> <?php the_title(); ?> </h1>
								<p> <?php the_field('description'); ?> </p>
							</div><!--overlay-->
							<?php the_post_thumbnail( array(600,350,true) ); ?>
						</div><!--thumb-wrap-->
						
					</a>
				</li>
			<?php endwhile; ?>
				</ol>
					<div class="alignleft"> <h3><?php previous_posts_link('&laquo; Previous Entries') ?></h3> </div>
		 			<div class="alignright"> <h3><?php next_posts_link('Next Entries &raquo;','') ?></h3> </div>
			<?php else: ?>
				<h1>No posts to display</h1>
			<?php endif; ?>

	</div><!--main-->
</div><!--contain-->
		
<?php get_footer(); ?>