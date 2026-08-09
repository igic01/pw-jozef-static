<?php
/**
 * Plugin Name: Paint & Wine Media Tags
 * Description: Adds Gallery Tags to Media Library attachments for filtered galleries and shortcodes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'paint_wine_register_media_tags' );

function paint_wine_register_media_tags() {
	if ( taxonomy_exists( 'paint_wine_media_tag' ) ) {
		return;
	}

	register_taxonomy(
		'paint_wine_media_tag',
		array( 'attachment' ),
		array(
			'labels'                => array(
				'name'                       => 'Gallery Tags',
				'singular_name'              => 'Gallery Tag',
				'search_items'               => 'Search Gallery Tags',
				'popular_items'              => 'Popular Gallery Tags',
				'all_items'                  => 'All Gallery Tags',
				'edit_item'                  => 'Edit Gallery Tag',
				'update_item'                => 'Update Gallery Tag',
				'add_new_item'               => 'Add New Gallery Tag',
				'new_item_name'              => 'New Gallery Tag Name',
				'separate_items_with_commas' => 'Separate gallery tags with commas',
				'add_or_remove_items'        => 'Add or remove gallery tags',
				'choose_from_most_used'      => 'Choose from the most used gallery tags',
				'not_found'                  => 'No gallery tags found.',
				'menu_name'                  => 'Gallery Tags',
			),
			'public'                => false,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'show_in_quick_edit'    => true,
			'show_in_rest'          => true,
			'hierarchical'          => false,
			'rewrite'               => false,
			'query_var'             => false,
			'meta_box_cb'           => 'post_tags_meta_box',
			'update_count_callback' => '_update_generic_term_count',
		)
	);
}
