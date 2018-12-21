<?php
/**
 * Register Menus
 *
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */

register_nav_menus( array(
	'primary'  => esc_html__( 'Primary', 'vibrant-life-theme' ),
	'primary-mobile'  => esc_html__( 'Primary (Mobile Only)', 'vibrant-life-theme' ),
	'top-bar-extra' => esc_html__( 'Top Bar', 'vibrant-life-theme' ),
	'four-oh-four' => esc_html__( '404 Page', 'vibrant-life-theme' ),
));


/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'foundationpress_top_bar_r' ) ) {
	function foundationpress_top_bar_r() {
		wp_nav_menu( array(
			'container'      => false,
			'menu_class'     => 'dropdown menu',
			'items_wrap'     => '<ul id="%1$s" class="%2$s desktop-menu" data-dropdown-menu>%3$s</ul>',
			'theme_location' => 'primary',
			'depth'          => 3,
			'fallback_cb'    => false,
			'walker'         => new Foundationpress_Top_Bar_Walker(),
		));
	}
}


/**
 * Mobile navigation - topbar (default) or offcanvas
 */
if ( ! function_exists( 'foundationpress_mobile_nav' ) ) {
	function foundationpress_mobile_nav() {
		wp_nav_menu( array(
			'container'      => false,                         // Remove nav container
			'menu_class'     => 'vertical menu',
			'theme_location' => 'primary-mobile',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'fallback_cb'    => false,
			'walker'         => new Foundationpress_Mobile_Walker(),
		));
	}
}


/**
 * Add support for buttons in the top-bar menu:
 * 1) In WordPress admin, go to Apperance -> Menus.
 * 2) Click 'Screen Options' from the top panel and enable 'CSS CLasses' and 'Link Relationship (XFN)'
 * 3) On your menu item, type 'has-form' in the CSS-classes field. Type 'button' in the XFN field
 * 4) Save Menu. Your menu item will now appear as a button in your top-menu
*/
if ( ! function_exists( 'foundationpress_add_menuclass' ) ) {
	function foundationpress_add_menuclass( $ulclass ) {
		$find = array('/<a rel="button"/', '/<a title=".*?" rel="button"/');
		$replace = array('<a rel="button" class="button"', '<a rel="button" class="button"');

		return preg_replace( $find, $replace, $ulclass, 1 );
	}
	add_filter( 'wp_nav_menu','foundationpress_add_menuclass' );
}

/**
 * Add the Search Button to the 404 Menu
 * 
 * @param       string $items The HTML list content for the menu items
 * @param       object $args  An object containing wp_nav_menu() arguments
 *                                                               
 * @since       1.0.0
 * @return      string The HTML list content for the menu items
 */
add_filter( 'wp_nav_menu_items', 'vibrant_life_add_menu_items', 10, 2 );
function vibrant_life_add_menu_items( $items, $args ) {
    
    if ( $args->theme_location == 'four-oh-four' ) {
		
        $items .= '<li class="search-toggle menu-item"><button class="header-button open-search" data-open-search aria-label="' . __( 'Expand search', 'vibrant-life-theme' ) . '" aria-controls="site-search"><span class="fas fa-fw fa-search" aria-hidden="true"></span></button></li>';
    }
    
    return $items;
    
}