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

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="background"></div>
    <header role="banner" class="site-header">
        <div class="site-header-inner clearfix">
            <nav role="navigation" class="main-menu" id="main-menu">
                <?php if ( has_nav_menu( 'language_switcher' ) ) : 
                    wp_nav_menu(array(
                        'theme_location' => 'language_switcher',
                        'menu_class'     => 'language-switcher-items',
                        'container'      => null                            
                    ));
                endif; ?>                

                <?php if ( has_nav_menu( 'primary' ) ) : 
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'main-menu-items',
                        'container'      => null                            
                    ));
                endif; ?>
            </nav>
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/'.pll_current_language() ) ); ?>" rel="home" class="logo-link"><?php _e('Mandragora', 'mandragora') ?></a>
            </div>
            <a href="#main-menu" class="menu-button"><span><?php _e('Toggle menu', 'mandragora') ?></span></a>
        </div>
    </header>
    
    <main role="main" class="site-content">
