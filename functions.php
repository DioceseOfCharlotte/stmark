<?php
/**
 * Functions and definitions.
 *
 * @package stmark
 */

add_action( 'wp_enqueue_scripts', 'stmark_styles' );

function stmark_styles() {
	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'child-styles', get_theme_file_uri( 'style.css' ), array( 'avada-stylesheet' ) );

	wp_register_style( 'sm-form-styles', get_theme_file_uri( "css/sm-forms{$suffix}.css" ), array( 'child-styles' ) );

	if ( is_singular( array( 'registration_pages', 'smcs_athletics', 'gravityview' ) ) ) {
		wp_enqueue_style( 'sm-form-styles' );
	}
}
