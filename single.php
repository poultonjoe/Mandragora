<?php
/**
 * The template for blog/services posts
 *
 * Displays body content and includes header and footer
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */

get_header() ?>
<main role="main" class="site-content">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="blog-post">
    <div class="blog-post-image-wrap"><?php the_post_thumbnail('blog-post'); ?></div>
    <header class="blog-post-header">
        <h1 class="blog-post-title"><?php the_title(); ?></h1>
        <div class="blog-post-author"><em>By <?php the_author_link(); ?></em></div>
        <ul class="blog-post-metadata">
            <li class="blog-post-metadata-item">
                <time datetime="<?php the_time('c'); ?>"><?php the_time('l jS F Y'); ?> @ <?php the_time('g:iA'); ?></time>
            </li>
            <li class="blog-post-metadata-item"><?php the_category( ', ' ); ?></li>
        </ul>
    </header>
    <div class="blog-post-body user-defined-markup">
        <?php the_content(); ?>
    </div>
</article>

<nav class="blog-post-navigation clearfix">
<?php
    $category = pll_get_term(3);
    if (in_category($category)) {
        $newer_post = get_next_post(true);
        $older_post = get_previous_post(true);
    } else {
        $newer_post = get_next_post(false, $category);
        $older_post = get_previous_post(false, $category);
    }
    
    if ($newer_post) {
        $newer_title = strip_tags(str_replace('"', '', $newer_post->post_title));
        echo '
            <div class="blog-post-navigation-item blog-post-navigation-item-newer">
                <a rel="next" href="'.get_permalink($newer_post->ID).'" title="'.$newer_title.'" class="blog-post-navigation-link">&lt; '.pll__('Newer Post', 'mandragora').'</a>
                <div class="blog-post-navigation-title">'.$newer_title.'</div>
            </div>
        ';
    }

    if ($older_post) {
        $older_title = strip_tags(str_replace('"', '', $older_post->post_title));
        echo '
            <div class="blog-post-navigation-item blog-post-navigation-item-older">
                <a rel="prev" href="'.get_permalink($older_post->ID).'" title="'.$older_title.'" class="blog-post-navigation-link">'.pll__('Older Post', 'mandragora').' &gt;</a>
                <div class="blog-post-navigation-title">'.$older_title.'</div>
            </div>
        ';
    }
?>
    
</nav>

<?php comments_template(); ?>

<?php endwhile; endif; ?>
</main>
<?php get_footer() ?>
