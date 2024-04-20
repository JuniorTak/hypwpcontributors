<?php
/**
 * @package HypContributors
 *
 * Plugin Name: Hyp Contributors
 * Plugin URI: https://github.com/rtlearn/wpcs-JuniorTak
 * Description: Add contributors to blog posts
 * Version: 1.0
 * Author: Hyppolite Takoua Foduop
 * Author URI: https://www.hyppolitetakouafoduop.online
 * License: GPLv2 or later
 * Text Domain: hypcontributors
 */

/**
 * Add a metabox labelled Contributors.
 */
function hyp4rt_contributors_metabox() {
	add_meta_box(
		'hyp4rt_contributors_metabox',  // ID of the metabox.
		'Contributors',                 // Title of the metabox.
		'hyp4rt_metabox_content',       // Callback function.
		'post',                         // Post type.
		'side',                         // Context.
		'default'                       // Priority.
	);
}
add_action( 'add_meta_boxes', 'hyp4rt_contributors_metabox' );

/**
 * Define the callback function for the metabox content.
 */
function hyp4rt_metabox_content( $post ) {
	// Nonce field for security.
	wp_nonce_field( 'contributors_nonce_action', 'contributors_nonce' );

	// Get all users.
	$authors = get_users();
	// Get saved contributors.
	$saved_contributors = get_post_meta( $post->ID, '_contributors', true );
	if ( ! is_array( $saved_contributors ) ) {
		$saved_contributors = array();
	}

	// Display checkboxes for each author.
	foreach ( $authors as $author ) {
		$checked = in_array( $author->ID, $saved_contributors, true ) ? 'checked' : '';
		echo '<p><label>';
		echo '<input type="checkbox" name="contributors[]" value="' . esc_attr( $author->ID ) . '" ' . esc_attr( $checked ) . '> ';
		echo esc_html( $author->display_name );
		echo '</label></p>';
	}
}
