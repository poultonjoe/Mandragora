<?php
/**
 * The template for main content
 *
 * Displays body content and includes header and footer
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */
get_header() ?>
<main role="main" class="site-content">
    <?php get_search_form(); ?>

    <?php if (is_home()) :_e
        if (!get_query_var('paged')) :
            $cat = pll_get_term(7);
            $feat_query = new WP_Query('cat='.$cat.'&showposts=1');
            if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
                <article class="post featured-post hero-blog">
                    <div class="post-image-wrap"><?php the_post_thumbnail('blog-post'); ?></div>
                    <div class="post-body">
                        <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <p class="post-text"><?php
                            $content = get_the_content();
                            $content = html_cut($content, 100, '...');
                            echo $content;
                        ?></p>
                        <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php pll('Load more', 'mandragora'); ?></a>    
        <?php wp_reset_postdata(); endif;
    else :
        if (have_posts()) : ?>
        <section class="post-list">
        <?php while (have_posts()) : the_post(); ?>
            <article class="post">
                <div class="post-image-wrap"><?php the_post_thumbnail('blog-thumb'); ?></div>
                <div class="post-body">
                    <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                    <p class="post-text"><?php
                            $content = get_the_content();
                            $content = html_cut($content, 100, '...');
                            echo $content;
                    ?></p>
                    <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php pll_e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php pll_e('Read more', 'mandragora'); ?></a></p>
                </div>
            </article>
        <?php endwhile; ?>
    	</section>
        <?php else : ?>
        <section class="hero hero-404">
            <h1 class="hero-title"><?php pll_e('Oops... 404!', 'mandragora') ?></h1>
            <p class="hero-lead-in"><?php pll_e('Page not found, let us redirect you.', 'mandragora') ?></p>
        </section>
    <?php endif; endif; ?>
</main>
<?php get_footer() ?>
