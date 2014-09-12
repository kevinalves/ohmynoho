<div class="top-bar-container contain-to-grid show-for-medium-up" role="navigation">
    <nav class="top-bar" data-topbar="">
        <ul class="title-area">
            <li class="name">
                <h1 class="title"><!-- <?php bloginfo( 'name' ); ?> -->
                   <a href="<?php echo home_url(); ?>"> <img src="<?php echo home_url(); ?>/wp-content/uploads/logo.svg" alt="logo" /> </a>
                </h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <?php foundationPress_top_bar_l(); ?>
            <?php foundationPress_top_bar_r(); ?>
        </section>
    </nav>
</div>