<?php
/**
 * Functions and definitions.
 *
 * @package stmark
 */

add_action( 'wp_enqueue_scripts', 'stmark_enqueue_styles' );

function stmark_enqueue_styles() {
	wp_enqueue_style( 'child-style', get_theme_file_uri( 'style.css' ), array( 'avada-stylesheet' ) );
}
