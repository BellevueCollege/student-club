<?php
/**
 * Status Taxonomy
 *
 * @package BC_Student_Clubs.
 */

/**
 * Registers the `status` taxonomy,
 * for use with 'clubs'.
 */
function status_init() {
	register_taxonomy(
		'status',
		array( 'clubs' ),
		array(
			'hierarchical'          => true,
			'public'                => true,
			'show_in_nav_menus'     => true,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => true,
			'capabilities'          => array(
				'manage_terms' => 'edit_posts',
				'edit_terms'   => 'edit_posts',
				'delete_terms' => 'edit_posts',
				'assign_terms' => 'edit_posts',
			),
			'labels'                => array(
				'name'                       => __( 'Statuses', 'student-club' ),
				'singular_name'              => _x( 'Status', 'taxonomy general name', 'student-club' ),
				'search_items'               => __( 'Search Statuses', 'student-club' ),
				'popular_items'              => __( 'Popular Statuses', 'student-club' ),
				'all_items'                  => __( 'All Statuses', 'student-club' ),
				'parent_item'                => __( 'Parent Status', 'student-club' ),
				'parent_item_colon'          => __( 'Parent Status:', 'student-club' ),
				'edit_item'                  => __( 'Edit Status', 'student-club' ),
				'update_item'                => __( 'Update Status', 'student-club' ),
				'view_item'                  => __( 'View Status', 'student-club' ),
				'add_new_item'               => __( 'Add New Status', 'student-club' ),
				'new_item_name'              => __( 'New Status', 'student-club' ),
				'separate_items_with_commas' => __( 'Separate statuses with commas', 'student-club' ),
				'add_or_remove_items'        => __( 'Add or remove statuses', 'student-club' ),
				'choose_from_most_used'      => __( 'Choose from the most used statuses', 'student-club' ),
				'not_found'                  => __( 'No statuses found.', 'student-club' ),
				'no_terms'                   => __( 'No statuses', 'student-club' ),
				'menu_name'                  => __( 'Statuses', 'student-club' ),
				'items_list_navigation'      => __( 'Statuses list navigation', 'student-club' ),
				'items_list'                 => __( 'Statuses list', 'student-club' ),
				'most_used'                  => _x( 'Most Used', 'status', 'student-club' ),
				'back_to_items'              => __( '&larr; Back to Statuses', 'student-club' ),
			),
			'show_in_rest'          => true,
			'rest_base'             => 'bc_club_status',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		)
	);

}
add_action( 'init', 'status_init' );

/**
 * Sets the post updated messages for the `status` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `status` taxonomy.
 */
function status_updated_messages( $messages ) {

	$messages['status'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Status added.', 'student-club' ),
		2 => __( 'Status deleted.', 'student-club' ),
		3 => __( 'Status updated.', 'student-club' ),
		4 => __( 'Status not added.', 'student-club' ),
		5 => __( 'Status not updated.', 'student-club' ),
		6 => __( 'Statuses deleted.', 'student-club' ),
	);

	return $messages;
}
add_filter( 'term_updated_messages', 'status_updated_messages' );
