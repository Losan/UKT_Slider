<?php

/*
	Plugin Name: UKT Slider
	Description: Easily create personalized sliders with WordPress
	Author: UKTelecom
	Version: 1.0
	License: GPL2
*/

function create_ukt_slide_type() {
	$ukt_slider_labels = array(
		'name'               => __( 'UKT Slides'),
		'singular_name'      => __( 'Slide'),
		'add_new'            => __( 'Add New UKT Slide'),
		'add_new_item'       => __( 'Add New UKT Slide'),
		'edit_item'          => __( 'Edit UKT Slide'),
		'new_item'           => __( 'New UKT Slide'),
		'view_item'          => __( 'View UKT Slide'),
		'search_items'       => __( 'Search UKT Slides'),
		'not_found'          => __( '0 slide found'),
		'not_found_in_trash' => __( '0 UKT slide found in Trash'), 
		'parent_item_colon'  => '',
		'menu_name'          => __( 'UKT Slides')
	);
	
	/*$ukt_slider_capabilities = array(		
		'edit_post'          => 'ukt_edit_slide',
		'edit_posts'         => 'ukt_edit_slides',
		'edit_others_posts'  => 'ukt_edit_others_slides',
		'publish_posts'      => 'ukt_publish_slides',
		'read_post'          => 'ukt_read_slide',
		'read_private_posts' => 'ukt_read_private_slides',
		'delete_post'        => 'ukt_delete_slide'
	);*/
	
	$ukt_slider_capabilities = array(
		'edit_post'          => 'edit_post',
		'edit_posts'         => 'edit_posts',
		'edit_others_posts'  => 'edit_others_posts',
		'publish_posts'      => 'publish_posts',
		'read_post'          => 'read_post',
		'read_private_posts' => 'read_private_posts',
		'delete_post'        => 'delete_post'
	);
	
	//icon before changes : ''. plugins_url( '/slides-icon-20x20.png', __FILE__ ),

	
	$ukt_slider_args = array(
    'labels' => $ukt_slider_labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
	'menu_icon' =>  plugins_url( '/includes/images/slides-icon.png', __FILE__ ),
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => 5,
	'taxonomies' => array( 'ukt_slideshow' ),
	'description' => 'A slide is composed of 3 images 2 buttons and 3 links',
    'supports' => array('title'));
	

	register_post_type( 'uktslider', $ukt_slider_args);
	register_taxonomy( 'slider', 'uktslider', array( 'hierarchical' => false, 'label' => 'Slider', 'query_var' => true, 'rewrite' => true ) );
}

function ukt_slide_register_taxonomy() {
	
	$ukt_slide_tax_labels = array(
			
		'name'              => __( 'Sliders'),
		'singular_name'     => __( 'Slider'),
		'search_items'      => __( 'Search Slider'),
		'popular_items'     => __( 'Popular Sliders'),
		'all_items'         => __( 'All Sliders'),
		'parent_item'       => __( 'Parent Slider'),
		'parent_item_colon' => __( 'Parent Slider:'),
		'edit_item'         => __( 'Edit Slider'),
		'update_item'       => __( 'Update Slider'),
		'add_new_item'      => __( 'Add New Slider'),
		'new_item_name'     => __( 'New Slider Name'),
		'menu_name'         => __( 'Sliders')
			
	);
	
	$ukt_slide_tax_capabilities = array(
		'manage_terms' => 'manage_categories',
		'edit_terms'   => 'manage_categories',
		'delete_terms' => 'manage_categories',
		'assign_terms' => 'edit_posts'
	);
	
	$ukt_slide_tax_args = array(
		'labels'            => $ukt_slide_tax_labels,
		'public'            => true,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'slider' ),
		'capabilities'      => $ukt_slide_tax_capabilities	
	);
	
	register_taxonomy( 'slider', 'uktslider', $ukt_slide_tax_args );
}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Adds shortcode to load slideshow in content
	
/*function meteor_slideshow_shortcode( $meteor_atts ) {

	extract( shortcode_atts( array (
	
		'slideshow' => '',
		'metadata'  => '',
		
	), $meteor_atts ) );
	
	$slideshow_att = $slideshow;
	
	$metadata_att = $metadata;

	ob_start();
	
	meteor_slideshow( $slideshow=$slideshow_att, $metadata=$metadata_att );
	$meteor_slideshow_content = ob_get_clean();
	return $meteor_slideshow_content;

}*/

	add_action( 'init', 'create_ukt_slide_type' );
	add_action( 'init', 'ukt_slide_register_taxonomy' );
	if(is_admin())
	{
		require_once(__DIR__.'/includes/ukt-slides-admin.php');
	}
	
	add_shortcode("ukt_slideshow", "uktslide_handler");

	function uktslide_handler($attributes) {
		//run function that actually does the work of the plugin
		$id = $attributes['id'];
		$output = uktslide_function($id);
		//send back text to replace shortcode in post
		return $output;
	}

	function uktslide_function($id) {
		//process plugin
		$output = "Hello World! ";
		ob_start();
				
		$ukt_slideshow_content = ob_get_clean();
		require_once(__DIR__.'/includes/ukt-slideshow.php');
		//send back text to calling function
		return $ukt_slideshow_content;
	}
	
?>