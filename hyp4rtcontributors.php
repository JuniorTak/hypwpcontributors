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
 * Load scripts in the site frontend.
 */
function hyp4rt_enqueue() {
	// Enqueue styles.
	wp_enqueue_style( 'hyp4rtcontributors', plugin_dir_url( __FILE__ ) . 'css/hyp4rtcontributors.css', array(), '1.0.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'hyp4rt_enqueue' );

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

/**
 * Save the selected authors when the post is saved.
 */
function hyp4rt_save_metabox_data( $post_id ) {
	// Check if nonce is set.
	if ( ! isset( $_POST['contributors_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['contributors_nonce'] ) ), 'contributors_nonce_action' ) ) {
		return;
	}

	// Check if the current user has permission to edit the post.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save or delete the meta data.
	if ( isset( $_POST['contributors'] ) ) {
		$contributors = array_map( 'sanitize_text_field', wp_unslash( $_POST['contributors'] ) );
		update_post_meta( $post_id, '_contributors', $contributors );
	} else {
		delete_post_meta( $post_id, '_contributors' );
	}
}
add_action( 'save_post', 'hyp4rt_save_metabox_data' );

/**
 * Display Contributors box.
 */
function hyp4rt_display_contributors( $content ) {
	if ( is_single() && is_main_query() ) {
		global $post;
		// Get the stored contributors.
		$contributors = get_post_meta( $post->ID, '_contributors', true );

		if ( ! empty( $contributors ) ) {
			$contributors_html  = '<div class="contributors-box">';
			$contributors_html .= '<h3>Contributors</h3>';
			$contributors_html .= '<ul>';

			foreach ( $contributors as $contributor_id ) {
				$contributor = get_userdata( $contributor_id );
				if ( $contributor ) {
					$avatar           = get_avatar( $contributor_id, 64 );
					$author_url       = get_author_posts_url( $contributor_id );
					$contributor_name = $contributor->display_name;

					$contributors_html .= '<li>' . $avatar . ' <a href="' . esc_url( $author_url ) . '">' . esc_html( $contributor_name ) . '</a></li>';
				}
			}

			$contributors_html .= '</ul>';
			$contributors_html .= '</div>';

			$content .= $contributors_html;
		}
	}

	return $content;
}
add_filter( 'the_content', 'hyp4rt_display_contributors' );
