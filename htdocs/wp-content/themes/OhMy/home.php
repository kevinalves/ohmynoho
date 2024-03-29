<?php
/*
Template Name: Home
*/
get_header(); ?>

<header id="homepage-hero" role="banner">
	<?php get_template_part('parts/top-bar'); ?>
	<?php echo do_shortcode('[smartslider2 slider="2"]'); ?>
</header>

<div class="section bg-purple">
	<div class="row">
		<div class="small-12 large-8 columns" role="main">

		<?php do_action('foundationPress_before_content'); ?>

		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<!-- <header>
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header> -->
				<?php do_action('foundationPress_page_before_entry_content'); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer>
					<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'FoundationPress'), 'after' => '</p></nav>' )); ?>
					<p><?php the_tags(); ?></p>
				</footer>
			</article>
		<?php endwhile;?>

		<?php do_action('foundationPress_after_content'); ?>

		</div>

	<?php get_sidebar(); ?>
</div>
</div><!--section-->

<div class="section">
	<div class="row">
	<ul class="products">
		<?php
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 12
				);
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
				while ( $loop->have_posts() ) : $loop->the_post();
					woocommerce_get_template_part( 'content', 'product' );
				endwhile;
			} else {
				echo __( 'No products found' );
			}
			wp_reset_postdata();
		?>
	</ul><!--/.products-->
</div><!--row-->
</div>
<?php get_footer(); ?>


