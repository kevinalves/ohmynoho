<?php get_header(); ?>

<div class="contain content">
	<div class="small-12" role="main">
	
	<?php while (have_posts()) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<!--<?php FoundationPress_entry_meta(); ?>-->
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<div class="post-footer">
				<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
				<p><?php the_tags(); ?></p>
			</div>
		</article>
	<?php endwhile;?>
	
	<!------------------------------------------------------------------->
	
	<div class="content clearfix" id="main-content">
		<h1 class="entry-title">Also posted in photo</h1>
		<?php
				$temp = $wp_query;
				$wp_query= null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=18 & category_name=photo'.'&paged='.$paged);
				?>
			<?php if ( have_posts() ): ?>
				<ol class="clearfix">
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="work-thumb left small-12 medium-6 large-4">
					<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark">
						
						<div class="thumb-wrap">
							<div class="overlay">
								<h3 class="title"> <?php the_title(); ?> </h3>
								
								<?php
								$category = get_the_category(); 
								echo "<h5>posted in ".$category[0]->cat_name."</h5>";
								?>

								
								
								<p> <?php the_field('description'); ?> </p>
							</div><!--overlay-->
							<?php the_post_thumbnail( array(500,400,true) ); ?>
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
		</div><!--related work-->

	</div>
</div><!--contain-->
		
<?php get_footer(); ?>