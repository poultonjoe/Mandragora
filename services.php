<?php get_header();
/**
 * Template Name: Services
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
<main role="main" class="site-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-services">
        <h1 class="hero-title"><?php get_field('header') ? the_field('header') : the_title(); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
    </section>
	<?php endwhile; endif; ?>

    <?php
        $servicesCategoryId = pll_get_term(3);
    ?>
    <?php query_posts('cat='.$servicesCategoryId); if (have_posts()) : ?>
        <section class="post-list services-list">
            <?php while (have_posts()) : the_post(); ?>
                <article class="post services-post">
                    <div class="post-image-wrap services-post-image-wrap"><?php the_post_thumbnail('blog-thumb'); ?></div>
                    <h1 class="post-title services-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <p class="post-text services-post-text"><?php
                        $content = get_the_content();
                        $content = html_cut($content, 200, '...');
                        echo $content;
                    ?></p>
                    <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php pll_e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php pll_e('Read more', 'mandragora'); ?></a></p>
                </article>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>
    <?php wp_reset_postdata();?>
</main>
<?php get_footer(); ?>