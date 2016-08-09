<?php get_header();
/**
 * 404 template
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
<main role="main" class="site-content">
    <section class="hero hero-404">
        <h1 class="hero-title"><?php pll_e('Oops... 404!', 'mandragora') ?></h1>
        <p class="hero-lead-in"><?php pll_e('Page not found, let us redirect you.', 'mandragora') ?></p>
    </section>
</main>

<?php get_footer(); ?>