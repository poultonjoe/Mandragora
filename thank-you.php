<?php get_header();
/**
 * Template Name: Thank You
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
<main role="main" class="site-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-contact-thanks">
        <h1 class="hero-title">
            <?php get_field('header') ? the_field('header') : the_title(); ?>
        </h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
    </section>
	<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>