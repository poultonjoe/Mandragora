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

    <?php if (is_home()) :
        if (!get_query_var('paged')) :
            $cat = pll_current_language() == 'en' ? 30 : 34;
            $feat_query = new WP_Query('catch='.$cat.'&showposts=1');
            if ($feat_query->have_posts()) : while ($feat_query->have_posts()) : $feat_query->the_post(); ?>
                <article class="post featured-post hero-blog">
                    <div class="post-image-wrap"><?php the_post_thumbnail('blog-post'); ?></div>
                    <div class="post-body">
                        <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <p class="post-text"><?php
                            $content = get_the_content();
                            $content = substr($content, 0, 200);
                            $content = trim($content);
                            echo $content."...";
                        ?></p>
                        <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php _e('Read more', 'mandragora'); ?></a></p>
                    </div>
                </article>
        <?php endwhile; endif; endif;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $the_query = new WP_Query('cat=-18,-20&paged='.$paged);
        if (get_next_posts_link('', $the_query->max_num_pages)) : ?>
            <a href="<?php $npl=explode('"',get_next_posts_link('', $the_query->max_num_pages)); $npl_url=$npl[1]; echo $npl_url ?>" title="<?php _e('Load more', 'mandragora'); ?>" class="load-more-button"><?php _e('Load more', 'mandragora'); ?></a>    
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
                            $content = substr($content, 0, 100);
                            $content = trim($content);
                            echo $content."...";
                    ?></p>
                    <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php _e('Read more', 'mandragora'); ?></a></p>
                </div>
            </article>
        <?php endwhile; ?>
    	</section>
    <?php endif; endif; ?>
</main>
<?php get_footer() ?>
