<?php

/**
* Directory_Theme_Core
*
* @copyright WMS N@W 2011-2024 {@link https://n3rds.work}
* @author DerN3rd
* @license GNU General Public License (Version 2 - GPLv2) {@link http://www.gnu.org/licenses/gpl-2.0.html}
*/
class DR_Theme_Core {

	public $text_domain = THEME_TEXT_DOMAIN;

	/**
	* Class constructor.
	*/
	function DR_Theme_Core() {
		add_action( 'after_setup_theme', array( &$this, 'theme_setup' ) );
		add_action( 'custom_banner_header', array( &$this, 'ad_banners' ) );


		add_action( 'widgets_init', array( &$this, 'register_sidebars' ) );
		add_filter( 'excerpt_length', array( &$this, 'new_excerpt_length' ) );
		add_filter( 'excerpt_more', array( &$this, 'new_excerpt_more' ) );
	}

	/**
	* Setup theme.
	*
	* @return void
	**/
	function theme_setup() {
		
		load_theme_textdomain(THEME_TEXT_DOMAIN, get_template_directory() . '/languages');

		add_theme_support( 'post-thumbnails', array( 'directory_listing' ) );
		add_theme_support( 'automatic-feed-links', array( 'directory_listing' ) );

		register_nav_menus( array(
		'top_menu' => __( 'Top Menu', 'directory_listing' ),
		) );
		// This theme allows users to set a custom background
		add_custom_background();
	}

	/**
	* Register sidebars by running on the widgets_init hook.
	*
	* @return void
	*/
	function register_sidebars() {

		// Advertising area, located in the header. Empty by default.
		register_sidebar(array(
		'name'	=>	'Advertisement',
		'id' => 'advertise-widget',
		'description' => __( 'Der Widget-Bereich für Header-Werbung', THEME_TEXT_DOMAIN ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		));
		// Area 1, located in the footer. Empty by default.
		register_sidebar( array(
		'name' => __( 'Erster Widget-Fußzeilenbereich', THEME_TEXT_DOMAIN ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'Der erste Fußzeilen-Widgetbereich', THEME_TEXT_DOMAIN ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		// Area 2, located in the footer. Empty by default.
		register_sidebar( array(
		'name' => __( 'Zweiter Fußzeilen-Widget-Bereich', THEME_TEXT_DOMAIN ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Der zweite Fußzeilen-Widgetbereich', THEME_TEXT_DOMAIN ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		// Area 3, located in the footer. Empty by default.
		register_sidebar( array(
		'name' => __( 'Dritter Widget-Fußzeilenbereich', THEME_TEXT_DOMAIN ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'Der dritte Fußzeilen-Widgetbereich', THEME_TEXT_DOMAIN ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );
		// Area 4, located in the footer. Empty by default.
		register_sidebar( array(
		'name' => __( 'Vierter Widget-Fußzeilenbereich', THEME_TEXT_DOMAIN ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'Der vierte Fußzeilen-Widgetbereich', THEME_TEXT_DOMAIN ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		) );


	}

	/**
	* Filter excerpt more link.
	*
	* @global <type> $post
	* @param <type> $more
	* @return void
	*/
	function new_excerpt_more( $more ) {
		global $post;
		return ' ... <br /><a class="view-listing" href="'. get_permalink( $post->ID ) . '">' . __( '{Eintrag anzeigen}', THEME_TEXT_DOMAIN ) . '</a>';
	}

	/**
	* Filter excerpt length.
	*
	* @param int Chracter size of excerpt
	* @return int Chracter size of excerpt
	*/
	function new_excerpt_length( $length ) {
		return 35;
	}

	/**
	* Filter excerpt length.
	*
	* @param int Chracter size of excerpt
	* @return int Chracter size of excerpt
	*/
	function ad_banners(){
		if (is_active_sidebar('advertise-widget')) {
			?>
			<div id="advertise" class="widget-area">
				<ul class="xoxo">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Advertisement') ) : ?><?php endif; ?>
				</ul>
			</div>
			<?php
		}else {
			echo '<span>' .  __( 'Werbe hier', $this->text_domain ) . '</span>';
		}
	}

}

new DR_Theme_Core();
