<?php get_header();
/**
 * Template Name: Home
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
<main role="main" class="site-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-home">
        <h1 class="hero-title"><?php get_field('header') ? the_field('header') : the_title(); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
    </section>
	<?php endwhile; endif; ?>

    <?php $servicesCategoryId = pll_get_term(3); ?>
    <section class="home-section about-mandragora">
        <h1 class="home-section-title"><?php the_field('services_section_title') ?></h1>
        <div class="home-section-content user-defined-markup clearfix">
            <?php the_field('services_section_content') ?>
        </div>
    </section>
        
    <section class="home-section about-mandragora">
        <h1 class="home-section-title"><?php the_field('services_section_title_2') ?></h1>
        <div class="home-section-content user-defined-markup clearfix">
            <?php the_field('services_section_content_2') ?>
        </div>

        <?php query_posts('posts_per_page=3&cat='.$servicesCategoryId); if (have_posts()) : ?>
            <div class="home-section-post-list post-list services-list">
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
            </div>
        <?php endif; ?>
        <p class="home-section-text">
            <?php
                $servicesPageId = pll_get_post(8);
                $link = sprintf(
                    wp_kses(
                        pll__('To view all of our services, please <a href=%s>click here</a>.', 'mandragora'),
                        array('a' => array('href' => array()))
                    ),
                    get_page_link($servicesPageId)
                );
                echo $link;
            ?></p>
    </section>

    <?php
    // wp_reset_postdata();
    $featuredCategoryId = pll_get_term(7);
    query_posts(array('cat' => $featuredCategoryId, 'posts_per_page' => 1, 'categorypll__not_in' => array($servicesCategoryId))); if (have_posts()) : ?>
        <section class="home-section whats-new">
            <h1 class="home-section-title"><?php pll_e("What&apos;s new?", 'mandragora') ?></h1>
            <?php while (have_posts()) : the_post(); ?>
                <article class="post featured-post">
                    <div class="post-image-wrap"><?php the_post_thumbnail('blog-post'); ?></div>
                    <div class="post-body">
                        <h1 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                        <p class="post-text"><?php
                            $content = get_the_content();
                            $content = html_cut($content, 200, '...');
                            echo $content;
                        ?></p>
                        <p class="post-read-more"><a href="<?php the_permalink() ?>" title="<?php pll_e('Read more of this post', 'mandragora'); ?>" class="post-read-more-link"><?php pll_e('Read more', 'mandragora'); ?></a></p>
                    </div>
                </article>
            <?php endwhile; ?>
        </section>

    <?php wp_reset_postdata(); ?>
    <?php endif; ?>

</main>

<div class="after-content">
    <section class="contact-us clearfix">
        <div class="contact-us-logo"></div>
        <h1 class="contact-us-title"><?php pll_e("Let&apos;s work together!", 'mandragora') ?></h1>
        <p class="contact-us-lead-in"><?php
            $contactPageId = pll_get_post(15);
            $contactHref = get_page_link($contactPageId);
            $emailHref = 'mailto:hello@mandragoratranslations.com';
            $phoneHref = 'tel:+6590234470';
            $link = sprintf(
                wp_kses(
                    pll__('For any enquiries, please <a href=%1$s>get in touch</a> on <a href=%2$s>hello@mandragoratranslations.com</a> or <br><a href=%3$s>+65 8888 8888</a>.', 'mandragora'),
                    array(
                    	'a' => array(
                    		'href' => array()
                    	),
                    	'br' => array()
                    )
                ),
                esc_url($contactHref),
                esc_url($emailHref),
                esc_url($phoneHref)
            );
            echo $link;
        ?></p>
    </section>
</div>
<?php get_footer(); ?>
