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

	</div>
</div><!--contain-->
		
<?php get_footer(); ?>