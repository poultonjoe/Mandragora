<?php if (comments_open() || have_comments()) : ?>
<section class="comments clearfix">
    <h1 class="h2 comments-count"><?php comments_number(pll__('0 Comments', 'mandragora'), pll__('1 Comment', 'mandragora'), pll__('% Comments', 'mandragora') ); ?></h1>
    <p><?php pll_e('Join the discussion and tell us your opinion', 'mandragora'); ?></p>

    <?php if ( have_comments() ) : ?>
        <ol class="comments-list">
            <?php wp_list_comments('type=comment&callback=mandragora_comments'); ?>
        </ol>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
        <h2 class="comments-form-title" id="respond"><?php comment_form_title( pll__('Leave a Reply', 'mandragora'), pll__('Leave a Reply to %s', 'mandragora' )); ?></h2>
        <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
            <div class="alert help"><?php printf( pll__('You must be %1$slogged in%2$s to post a comment.', 'mandragora'), '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>' ); ?></div>
        <?php else : ?>
            <form class="form comments-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <?php if ( is_user_logged_in() ) : ?>
                    <p class="comments-logged-in-as"><?php pll_e("Logged in as", "mandragora"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php pll_e('Log out of this account', 'mandragora'); ?>"><?php pll_e("Log out", "mandragora"); ?> &raquo;</a></p>
                <?php else : ?>
                    <div class="form-field">
                        <label class="form-label form-label-hidden" for="author"><?php pll_e("Name", "mandragora"); ?> <?php if ($req) pll_e('(required)', 'mandragora'); ?></label>
                        <input class="form-input" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php pll_e('Name', 'mandragora'); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                    </div>
                    <div class="form-field">
                        <label class="form-label form-label-hidden" for="email"><?php pll_e("Email address", "mandragora"); ?> <?php if ($req) pll_e('(required)', 'mandragora'); ?></label>
                        <input class="form-input" type="email" name="email" id="email" value="<?php echo esc_attr($comment_authorpll_email); ?>" placeholder="<?php pll_e('Email address', 'mandragora'); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                    </div>
                <?php endif; ?>

                <div class="form-field">
                    <label for="comment" class="form-label"><?php pll_e('Comment', 'mandragora'); ?></label>
                    <textarea id="comment" name="comment" class="form-textarea"></textarea>
                </div>

                <button type="submit" name="submit" class="button button-large submit-comment-button"><?php pll_e('Submit', 'mandragora'); ?></button>
                <?php comment_id_fields(); ?>

                <div id="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></div>

                <?php do_action('comment_form', $post->ID); ?>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php endif; ?>
