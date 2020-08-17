<?php
/**
 * Registers the `club` post type.
 *
 * @package BC_Student_Clubs.
 */

/**
 * Club custom post type
 */
function club_init() {
	register_post_type(
		'clubs',
		array(
			'labels'                => array(
				'name'                  => __( 'Student Organizations', 'student-club' ),
				'singular_name'         => __( 'Student Organization', 'student-club' ),
				'all_items'             => __( 'All Student Organizations', 'student-club' ),
				'archives'              => __( 'Student Organization Archives', 'student-club' ),
				'attributes'            => __( 'Student Organization Attributes', 'student-club' ),
				'insert_into_item'      => __( 'Insert into Student Organization', 'student-club' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Student Organization', 'student-club' ),
				'featured_image'        => _x( 'Featured Image', 'club', 'student-club' ),
				'set_featured_image'    => _x( 'Set featured image', 'club', 'student-club' ),
				'remove_featured_image' => _x( 'Remove featured image', 'club', 'student-club' ),
				'use_featured_image'    => _x( 'Use as featured image', 'club', 'student-club' ),
				'filter_items_list'     => __( 'Filter Student Organization list', 'student-club' ),
				'items_list_navigation' => __( 'Student Organization list navigation', 'student-club' ),
				'items_list'            => __( 'Student Organization list', 'student-club' ),
				'new_item'              => __( 'New Student Organization', 'student-club' ),
				'add_new'               => __( 'Add New', 'student-club' ),
				'add_new_item'          => __( 'Add New Student Organization', 'student-club' ),
				'edit_item'             => __( 'Edit Student Organization', 'student-club' ),
				'view_item'             => __( 'View Student Organization', 'student-club' ),
				'view_items'            => __( 'View Student Organizations', 'student-club' ),
				'search_items'          => __( 'Search Student Organizations', 'student-club' ),
				'not_found'             => __( 'No Student Organizations found', 'student-club' ),
				'not_found_in_trash'    => __( 'No Student Organizations found in trash', 'student-club' ),
				'parent_item_colon'     => __( 'Parent Student Organization:', 'student-club' ),
				'menu_name'             => __( 'Org. Archive', 'student-club' ),
			),
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => array( 'title', 'editor', 'comments', 'page-attributes' ),
			'has_archive'           => true,
			'rewrite'               => array( 'slug' => 'list' ),
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-admin-post',
			'show_in_rest'          => true,
			'rest_base'             => 'clubs',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'capability_type'       => 'page',
			'taxonomies'            => array( 'status' ),
		)
	);

}
add_action( 'init', 'club_init' );

/**
 * Sets the post updated messages for the `club` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `club` post type.
 */
function club_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['clubs'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Student Organization updated. <a target="_blank" href="%s">View Student Organization</a>', 'student-club' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'student-club' ),
		3  => __( 'Custom field deleted.', 'student-club' ),
		4  => __( 'Student Club updated.', 'student-club' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Student Organization restored to revision from %s', 'student-club' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Student Organization published. <a href="%s">View Student Organization</a>', 'student-club' ), esc_url( $permalink ) ),
		7  => __( 'Student Organization saved.', 'student-club' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Student Organization submitted. <a target="_blank" href="%s">Preview Student Organization</a>', 'student-club' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf(
			__( 'Student Organization scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Student Organization</a>', 'student-club' ),
			date_i18n( __( 'M j, Y @ G:i', 'student-club' ), strtotime( $post->post_date ) ),
			esc_url( $permalink )
		),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Student Organization draft updated. <a target="_blank" href="%s">Preview Student Organization</a>', 'student-club' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'club_updated_messages' );
