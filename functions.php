<?php
/**
 * Functions and definitions.
 *
 * @package stmark
 */

add_action( 'wp_enqueue_scripts', 'stmark_styles' );
add_filter( 'post_class', 'smcs_post_classes', 10, 3 );

function stmark_styles() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'child-styles', get_theme_file_uri( "style{$suffix}.css" ), array( 'avada-stylesheet' ) );

	wp_register_style( 'sm-form-styles', get_theme_file_uri( 'css/' . sm_get_asset_rev( 'sm-forms' ) . '.css' ), array( 'child-styles' ) );

	if ( is_singular( array( 'registration_pages', 'smcs_athletics', 'gravityview' ) ) ) {
		wp_enqueue_style( 'sm-form-styles' );
	}
}

function smcs_post_classes( $classes, $class, $post_id ) {

	if ( is_admin() ) {
		return $classes;
	}

	if ( is_singular( array( 'registration_pages', 'smcs_athletics', 'gravityview' ) ) ) {
			$classes[] = 'smcs-post';
	}

	return $classes;
}


/**
 * Append Hash to assets filename to purge the browser cache when changed.
 */
function sm_get_asset_rev( $filename ) {

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		return $filename;
	}

	$version = 'version';

	// Cache the decoded manifest so that we only read it in once.
	static $manifest = null;
	if ( null === $manifest ) {
		$manifest_path = get_theme_file_path( 'package.json' );
		$manifest      = file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
	}

	// If the manifest contains the requested file, return the hashed name.
	if ( array_key_exists( $version, $manifest ) ) {
		return $filename . $manifest[ $version ];
	}

	// File hash wasn't found.
	return $filename;
}
