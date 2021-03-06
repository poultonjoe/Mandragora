<?php
/**
 * The template for archives
 *
 * Displays body content and includes header and footer
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */

get_header(); ?>
<main role="main" class="site-content">

<?php if ( have_posts() ) : ?>
    <section class="hero hero-blog">
        <?php
            the_archive_title( '<h1 class="hero-title">', '</h1>' );
            the_archive_description( '<div class="hero-content">', '</div>' );
        ?>
    </section>

    <?php if (have_posts()) : ?>
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
    <?php if (get_next_posts_link('')) : ?>
        <a href="<?php $npl=explode('"',get_next_posts_link('')); $npl_url=$npl[1]; echo $npl_url ?>" title="<?php pll_e('Load more', 'mandragora'); ?>" class="load-more-button"><?php pll_e('Load more', 'mandragora'); ?></a>    
    <?php endif; endif; 

else : ?>
    <section class="hero hero-404">
        <h1 class="hero-title"><?php pll_e('Oops... 404!', 'mandragora') ?></h1>
        <div class="hero-content"><p><?php pll_e('Page not found, let us redirect you.', 'mandragora') ?></p></div>
    </section>
<?php endif; ?>

</main>

<?php get_footer(); ?>
