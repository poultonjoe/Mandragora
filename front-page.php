<?php get_header();
/**
 * Homepage template
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>

<main role="main" class="site-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <section class="hero hero-home">
        <h1 class="hero-title"><?php the_title(); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <?php the_content(); ?>
        </div>
    </section>
	<?php endwhile; ?>
    <?php else : ?>
    <section class="hero hero-404">
        <h1 class="hero-title"><?php _e('Oops... 404!', 'mandragora'); ?></h1>
        <div class="hero-content user-defined-markup clearfix">
            <p><?php _e('Page not found, let us redirect you.', 'mandragora'); ?></p>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $current_lang = pll_current_language();
        if ($current_lang == 'en') :
            $servicesCategoryId = 18;
            $services_query = new WP_Query( 'page_id=8' );
        else :
            $servicesCategoryId = 20;
            $services_query = new WP_Query( 'page_id=25' );
        endif;
        while ( $services_query->have_posts() ) :
            $services_query->the_post(); ?>
            <section class="home-section about-mandragora">
                <h1 class="home-section-title"><?php _e('Mandragora?', 'mandragora'); ?></h1>
                <div class="home-section-content user-defined-markup clearfix">
                    <?php the_content(); ?>
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
                        $servicesPageId = $current_lang == 'en' ? 8 : 25;
                        $link = sprintf(
                            wp_kses(
                                __('To view all of our services, please <a href="%1$s" title="click here">click here</a>.', 'mandragora'),
                                array('a' => array('href' => array()))
                            ),
                            get_page_link($servicesPageId)
                        );
                        echo $link;
                    ?></p>
            </section>
    <?php endwhile;
        wp_reset_postdata();
    ?>

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
</main>

<div class="after-content">
    <section class="contact-us clearfix">
        <div class="contact-us-logo"></div>
        <h1 class="contact-us-title"><?php _e('Let\'s work together!', 'mandragora') ?></h1>
        <p class="contact-us-lead-in"><?php
            $contactPageId = $current_lang == 'en' ? 15 : 27;
            $contactHref = get_page_link($contactPageId);
            $emailHref = 'mailto:hello@mandragoratranslations.com';
            $phoneHref = 'tel:+6588888888';
            $link = sprintf(
                wp_kses(
                    __('For any enquiries, please <a href="%1$s" title="Get in touch">get in touch</a> on <a href="%2$s" title="Email us">hello@mandragoratranslations.com</a> or <br><a href="%3$s" title="Call us">+65 8888 8888</a>.', 'mandragora'),
                    array('a' => array('href' => array()))
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