<?php
/*
Plugin Name: Student Club
Plugin URI: https://github.com/BellevueCollege/student-club/
Description: This plugin provides the user to create custom post for student clubs for Bellevue college
Author: Bellevue College Information Technology Services
Version: 1.0.0.0
Author URI: http://www.bellevuecollege.edu
*/


add_action( 'init', 'create_club_post_type' );

function create_club_post_type() {
	//global $post;
	//$meta = "";
	///if($post)
	 	//$meta = get_post_meta($post->ID, 'meeting_date', true);
  register_post_type( 'clubs',
    array(
      'labels'				=> array(
      									'name' => __( 'Student Club' ),
      									'singular_name' => __( 'Student Club' ) ,
    									'add_new' => 'Add New Student Club',
    									'add_new_item' => 'Add New Student Club',
    									'edit_item' => 'Edit Student Club',
    									'menu_name' => 'Student Club Archive',
    								),
      'public' 				=> true,
      'supports'            => array( 'title', 'editor', 'comments','page-attributes',),
      'has_archive' 		=> 'clubs',
      'capability_type' 	=> 'page',
      'rewrite' 			=> array( 'slug' => "clubs" ),
      'taxonomies'			=> array('status'),
    )
  );
  flush_rewrite_rules();
}

add_action( 'init', 'create_clubs_taxonomies', 0 );

function create_clubs_taxonomies()
{
	$labels = array(
		'name'              => _x( 'Status', 'taxonomy general name' ),
		'singular_name'     => _x( 'Status', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Statuses' ),
		'all_items'         => __( 'All Statuses' ),
		'parent_item'       => __( 'Parent Status' ),
		'parent_item_colon' => __( 'Parent Status:' ),
		'edit_item'         => __( 'Edit Status' ),
		'update_item'       => __( 'Update Status' ),
		'add_new_item'      => __( 'Add New Status' ),
		'new_item_name'     => __( 'New Status Name' ),
		'menu_name'         => __( 'Status' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'status' ),
	);

	register_taxonomy( 'status', array( 'clubs' ), $args );

}


// Add the Meta Box
function add_club_custom_meta_box() {
    add_meta_box(
        'custom_meta_box', // $id
        'Custom Meta Box', // $title
        'show_club_custom_meta_box', // $callback
        'clubs', // $page
        'normal', // $context
        'high'); // $priority
   
}
add_action('add_meta_boxes', 'add_club_custom_meta_box');



//$prefix = 'custom_';
$custom_club_meta_fields = array(

    array(
        'label'=> 'URL',
        'desc'  => 'Club Website',
        'name'  => 'club_url',
        'id'    => 'club_url',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Advisor Email',
        'desc'  => '',
        'name'  => 'club_advisor_email',
        'id'    => 'club_advisor_email',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Advisor Phone Number',
        'desc'  => '',
        'name'  => 'club_advisor_phone',
        'id'    => 'club_advisor_phone',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Club Contact Name',
        'desc'  => '',
        'name'  => 'club_contact_name',
        'id'    => 'club_contact_name',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Club Contact Email',
        'desc'  => '',
        'name'  => 'club_contact_email',
        'id'    => 'club_contact_email',
        'type'  => 'text'
    ),
     array(
        'label'=> 'Meeting Location',
        'desc'  => '',
        'name'  => 'club_meeting_location',
        'id'    => 'club_meeting_location',
        'type'  => 'text'
    ),
      array(
        'label'=> 'Meeting Time',
        'desc'  => '',
        'name'  => 'club_meeting_time',
        'id'    => 'club_meeting_time',
        'type'  => 'text'
    ),
      array(
        'label'=> 'Budget Document Link',
        'desc'  => '',
        'name'  => 'budget_document_link',
        'id'    => 'budget_document_link',
        'type'  => 'text'
    ),
   

);

// The Callback
function show_club_custom_meta_box() {
global $custom_club_meta_fields, $post;

// Use nonce for verification
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($custom_club_meta_fields as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                    // case items will go here
                		case 'checkbox':
							    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
							        <label for="'.$field['id'].'">'.$field['desc'].'</label>';
								break;
						// text
						case 'text':							

				    			echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
				        		<br /><span class="description">'.$field['desc'].'</span>';
						    	
						break;

                } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}

// Save the Data
function save_clubs($post_id) {
    global $custom_club_meta_fields;

    // verify nonce
    if(isset($_POST['custom_meta_box_nonce']))
    {
    	if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
        	return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return $post_id;
    // check permissions
    if(isset($_POST['post_type']))
    {
	    if ('page' == $_POST['post_type']) {
	        if (!current_user_can('edit_page', $post_id))
	            return $post_id;
	        } elseif (!current_user_can('edit_post', $post_id)) {
	            return $post_id;
	    }
	}

    // loop through fields and save the data
    foreach ($custom_club_meta_fields as $field) {
    	if(isset($field['id']))
    	{
	        $old = get_post_meta($post_id, $field['id'], true);
	        if(isset($_POST[$field['id']]))
	        {
               $new = $_POST[$field['id']];
		        if ($new && $new != $old) {
		            update_post_meta($post_id, $field['id'], $new);
		        } elseif ('' == $new && $old) {
		            delete_post_meta($post_id, $field['id'], $old);
		        }
		    }
	    }
    } // end foreach


}
add_action('save_post_clubs', 'save_clubs',10);