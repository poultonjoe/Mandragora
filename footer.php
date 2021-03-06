<?php
/**
 * The template for displaying the header
 *
 * Displays head and site header
 *
 * @package Mandragora
 * @since Mandragora 1.0
 */
?>
    
    <footer role="contentinfo" class="site-footer">
        <div class="site-footer-inner clearfix">
            <div class="footer-info">
                <div class="footer-info-copyright"><?php printf(pll__('Copyright Mandragora Consulting &copy; %s', 'mandragora'), date_i18n('Y')) ?></div>
                <div class="footer-info-registration"><?php pll_e('Registration number 12341234XXX32D', 'mandragora') ?></div>
            </div>
            <nav role="navigation" class="footer-menu">
                <?php if ( has_nav_menu( 'primary' ) ) : 
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'footer-menu-items',
                        'container'      => null                            
                    ));
                endif; ?>
            </nav>
            <div class="site-credit">
                <p><?php
                    $url = 'http://www.collectivetype.co';
                    $link = sprintf(wp_kses(pll__('Designed by <a class=site-credit-link href=%s >Collective Type Co.</a>', 'mandragora'),
                            array('a' => array('href' => array()))), esc_url($url));
                    echo $link;
                ?></p>
            </div>
        </div>
    </footer>

<?php wp_footer(); ?>
</body>
</html>
