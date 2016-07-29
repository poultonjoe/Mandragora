<?php get_header();
/**
 * Template Name: Home
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-home">
        <h1 class="hero-title"><?php get_field('header') ? the_field('header') : the_title(); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
    </section>
	<?php endwhile; endif; ?>

    <?php
        $current_lang = pll_current_language();
        if ($current_lang == 'en') :
            $servicesCategoryId = 18;
        else :
            $servicesCategoryId = 20;
        endif; ?>
            <section class="home-section about-mandragora">
                <h1 class="home-section-title"><?php the_field('services_section_title') ?></h1>
                <div class="home-section-content user-defined-markup clearfix">
                    <?php the_field('services_section_content') ?>
                </div>

                <?php query_posts('posts_per_page=3&cat='.$servicesCategoryId); if (have_posts()) : ?>
                    <div class="home-section-post-list post-list services-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="post services-post">
                                <div class="post-image-wrap services-post-image-wrap"></div>
                                <h1 class="post-title services-post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                                <p class="post-text services-post-text"><?php
                                    $content = get_the_content();
                                    $content = substr($content, 0, 100);
                                    $content = trim($content);
                                    echo $content."...";
                                ?></p>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <p class="home-section-text">
                    <?php
                        $slug = pll_current_language() == 'en' ? 'services' : 'servicios';
                        $page = get_page_by_path($slug);
                        $link = sprintf(
                            wp_kses(
                                __('To view all of our services, please <a href="%1$s" title="click here">click here</a>.', 'mandragora'),
                                array('a' => array('href' => array()))
                            ),
                            get_page_link($page->ID)
                        );
                        echo $link;
                    ?></p>
            </section>
    <?php wp_reset_postdata();?>

    <?php query_posts(array('posts_per_page' => 1, 'category__not_in' => array($servicesCategoryId))); if (have_posts()) : ?>
        <section class="home-section whats-new">
            <h1 class="home-section-title"><?php _e('What\'s new?', 'mandragora') ?></h1>
            <?php while (have_posts()) : the_post(); ?>
                <article class="post featured-post">
                    <div class="post-image-wrap"></div>
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
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

<?php get_footer(); ?>