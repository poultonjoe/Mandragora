<?php
/**
 * The template for main content
 *
 * Displays body content and includes header and footer
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
<form role="search" class="form search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="form-field">
        <label for="s" class="form-label search-label"><?php _e('Search', 'mandragora'); ?></label>
        <input id="search" class="form-input search-input" value="<?php echo get_search_query(); ?>" name="s" >
        <button type="submit" class="button search-button"><?php _e('Submit', 'mandragora'); ?></button>
    </div>
</form>
