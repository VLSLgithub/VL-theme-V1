<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package VibrantLifeTheme2018
 * @since FoundationPress 1.0.0
 */


if ( ! function_exists( 'foundationpress_scripts' ) ) :

	// Check to see if rev-manifest exists for CSS and JS static asset revisioning
	//https://github.com/sindresorhus/gulp-rev/blob/master/integration.md
	function css_asset_path($filename) {
		$manifest_path = dirname(dirname(__FILE__)) . '/dist/assets/css/rev-manifest.json';

		if (file_exists($manifest_path)) {
			$manifest = json_decode(file_get_contents($manifest_path), TRUE);
		} else {
			$manifest = [];
		}

		if (array_key_exists($filename, $manifest)) {
			return $manifest[$filename];
		}

		return $filename;
	}

	function js_asset_path($filename) {
		$manifest_path = dirname(dirname(__FILE__)) . '/dist/assets/js/rev-manifest.json';

		if (file_exists($manifest_path)) {
			$manifest = json_decode(file_get_contents($manifest_path), TRUE);
		} else {
			$manifest = [];
		}

		if (array_key_exists($filename, $manifest)) {
			return $manifest[$filename];
		}

		return $filename;
	}

	function foundationpress_register_scripts() {

		// Enqueue Founation scripts
		wp_register_script(
			'foundation',
			get_template_directory_uri() . '/dist/assets/js/' . js_asset_path('app.js'),
			array( 'jquery' ),
			defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER,
			true
		);

	}

	function foundationpress_scripts() {

		// Enqueue the main Stylesheet.
		wp_enqueue_style(
			'main-stylesheet', 
			get_template_directory_uri() . '/dist/assets/css/' . css_asset_path('app.css'),
			array(),
			defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VER,
			'all'
		);

		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script( 'jquery' );

		// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
		wp_enqueue_script(
			'jquery',
			'//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
			array(),
			'3.2.1', // jQuery version, not Theme version
			false
		);

		// Enqueue Founation scripts
		wp_enqueue_script( 'foundation' );

		$store = vibrant_life_get_asl_store_locator_store( (string) get_the_ID() );
	
		// Not a Store "Post", try to find one
		if ( ! $store ) {
			
			$location_id = vibrant_life_get_associated_location( get_the_ID() );
			
			$post_id = vibrant_life_get_field( 'store', $location_id );
			
			$store = vibrant_life_get_asl_store_locator_store( (string) $post_id );
			
		}

		wp_localize_script( 'foundation', 'vibrantLife', array(
			'asl_google_maps_api_key' => get_asl_google_maps_api_key(),
			'current_store' => $store,
			'asl_url' => ( defined( 'AGILESTORELOCATOR_URL_PATH' ) ) ? AGILESTORELOCATOR_URL_PATH : false,
			'i18n' => array(
				'directions' => __( 'Directions', 'vibrant-life-theme' ),
			),
		) );

		// Enqueue FontAwesome from CDN. Uncomment the line below if you don't need FontAwesome.
		wp_enqueue_script(
			'fontawesome',
			'//use.fontawesome.com/releases/v5.8.2/js/all.js',
			array(),
			'5.8.2',
			false
		);

		// Add the comment-reply library on pages where it is necessary
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

	add_action( 'init', 'foundationpress_register_scripts' );

	add_action( 'wp_enqueue_scripts', 'foundationpress_scripts' );

endif;
