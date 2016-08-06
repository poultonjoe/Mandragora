<?php
/**
 * The template for search results
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
        <h1 class="hero-title"><?php printf( __( 'Search Results for: %s', 'mandragora' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
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
                        $content = substr($content, 0, 100);
                        $content = trim($content);
                        echo $content."...";
                ?></p>
                <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php _e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php _e('Read more', 'mandragora'); ?></a></p>
            </div>
        </article>
    <?php endwhile; ?>
    </section>
    <?php if (get_next_posts_link('')) : ?>
        <a href="<?php $npl=explode('"',get_next_posts_link('')); $npl_url=$npl[1]; echo $npl_url ?>" title="<?php _e('Load more', 'mandragora'); ?>" class="load-more-button"><?php _e('Load more', 'mandragora'); ?></a>    
    <?php endif; endif; 

else : ?>
    <section class="hero hero-blog">
        <h1 class="hero-title"><?php _e('Oops... 404!', 'mandragora') ?></h1>
        <p class="hero-lead-in"><?php _e('Page not found, let us redirect you.', 'mandragora') ?></p>
    </section>
<?php endif; ?>

</main>

<?php get_footer(); ?>
