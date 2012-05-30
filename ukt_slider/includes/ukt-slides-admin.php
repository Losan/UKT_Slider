<?php
define( 'MYPLUGINNAME_PATH', plugin_dir_path(__FILE__) );



add_action('init', 'load_script');
function load_script() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
  wp_enqueue_style( 'nyro_test', plugins_url('/nyro/nyro.css' , __FILE__ ));
  wp_enqueue_script( 'nyro_test', plugins_url('/nyro/nyro.js' , __FILE__ ));
}

$meta_box = array(
	'id' => 'ukt-slide-meta',
	'title' => 'Slide Configuration',
	'page' => 'uktslider',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Left',
			'desc' => 'Select a Left Image',
			'id' => 'upload_image',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => '',
			'desc' => '',
			'id' => 'upload_image_button',
			'type' => 'button',
			'std' => 'Browse'
		),
		array(
			'name' => 'Left link',
			'desc' => 'Input a Left Image Link',
			'id' => 'left_image_link',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Color Picker for left image text',
			'desc' => '',
			'id' => 'color',
			'type' => 'color',
			'std' => 'Pick a color'
		),
		array(
			'name' => 'Left Image Text',
			'desc' => '',
			'id' => 'textarea1',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'X and Y Position in pixel for the left image text',
			'desc' => '',
			'id' => 'left_image_text_x',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => '',
			'desc' => '',
			'id' => 'left_image_text_y',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Right',
			'desc' => 'Select an Right Image',
			'id' => 'upload_image2',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => '',
			'desc' => '',
			'id' => 'upload_image_button2',
			'type' => 'button',
			'std' => 'Browse'
		),
		array(
			'name' => 'Right link',
			'desc' => 'Input a Right Image Link',
			'id' => 'right_image_link',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Color Picker for right image text',
			'desc' => '',
			'id' => 'color1',
			'type' => 'color',
			'std' => 'Pick a color'
		),
		array(
			'name' => 'Right Image Text',
			'desc' => '',
			'id' => 'textarea2',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'X and Y Position in pixel for the right image text',
			'desc' => '',
			'id' => 'right_image_text_x',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => '',
			'desc' => '',
			'id' => 'right_image_text_y',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Vignette',
			'desc' => 'Select a Vignette Image',
			'id' => 'upload_image3',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => '',
			'desc' => '',
			'id' => 'upload_image_button3',
			'type' => 'button',
			'std' => 'Browse'
		),
		array(
			'name' => 'More Info',
			'desc' => 'Input the More Info Button Link',
			'id' => 'more_info_link',
			'type' => 'text',
			'std' => ''
		),
		array(
			'name' => 'Order Now',
			'desc' => 'Input the Order Now Button Link',
			'id' => 'order_now_link',
			'type' => 'text',
			'std' => ''
		)
	
	)
);

add_action('add_meta_boxes', 'mytheme_add_box');
 
// Add meta box
function mytheme_add_box() {
	global $meta_box; 	
	add_meta_box($meta_box['id'], $meta_box['title'], 'show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}
 
// Callback function to show fields in meta box
function show_box() {
	global $meta_box, $post;
	echo '<table class="form-table">';
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	echo '<input type="hidden" id="path_value" value="', plugins_url('preview.php' , __FILE__ ), '" />';
	
	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		if ( ($field['id'] != 'left_image_text_y') && ($field['id'] != 'right_image_text_y') )
		{
			echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		}
		
		switch ($field['type']) {
			// If Text		
			case 'text':
				if ( ($field['id'] != 'left_image_text_y') && ($field['id'] != 'right_image_text_y') && ($field['id'] != 'right_image_text_x') && ($field['id'] != 'left_image_text_x') )
				{
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				}
				else
				{	
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" />';
				}
				break;
 
// If Text Area			
			case 'textarea':
				echo '<textarea style="resize: none;" name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;	 
 
// If Button	 
			case 'button':
				echo '<input type="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
				break;
				
			case 'color':
				echo '<label for="', $field['id'] ,'"><input type="text" STYLE="background-color: ',$meta ? $meta : $field['std'],';" id="', $field['id'] ,'" name="',  $field['id'] ,'" value="',$meta ? $meta : $field['std'],'" /> Click here to show or hide colorpicker</label>';
				echo '<div id="', $field['id']."div" ,'"></div>';
				break;
		}
		if ( ($field['id'] != 'left_image_text_x') && ($field['id'] != 'right_image_text_x') )
		{
			echo 	'</td>',
				'</tr>';
		}
	}
	echo '</table>';
	
	echo '<input type="button" name="preview" id="preview" value="Build Preview Link" />';
	echo '<span style="margin-left: 30px; display:none;" id="ukt_preview_link">';
		echo '<a class="ukt_preview" href="" title="Slide Preview">Click here to preview</a>';
	echo '</span>';
	
		
	
}

add_action('save_post', 'mytheme_save_data');
 
// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box;
 
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}
 
function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('my-upload', plugins_url('ukt-browse.js' , __FILE__ ), array('jquery','media-upload','thickbox'));
wp_enqueue_script('my-upload');
}
function my_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');


function ukt_slides_settings_link( $ukt_links, $ukt_file ) {
		if ( $ukt_file == plugin_basename( 'test_plug/test_plug.php' ) ) {
			$ukt_links[] = '<a href="edit.php?post_type=slide&page=uktslider_settings">Settings</a>';
		}
		return $ukt_links;
	}

	function ukt_slides_menu(){
		add_submenu_page( 'edit.php?post_type=uktslider', 'Slides Settings', 'Settings', 'manage_options',  'uktslider_settings', 'ukt_slides_settings_page' );
	}
	
	function ukt_slides_settings_page(){
		
		require_once(__DIR__.'/ukt-slides-settings.php');
		//require_once( '/ukt-slides-settings.php' );
	}
	
	function ukt_slides_register_settings(){
		register_setting( 'uktslides_options', 'uktslides_options' );
		add_settings_section( 'ukt_slideshow', 'Configure Slideshow', 'ukt_slides_section_text', 'uktslides' );
		add_settings_field( 'slide_height', 'Slide Height', 'ukt_slides_slide_height', 'uktslides', 'ukt_slideshow' );
		add_settings_field( 'slide_width', 'Slide Width', 'ukt_slides_slide_width', 'uktslides', 'ukt_slideshow' );
		add_settings_field( 'transition_speed', 'Transition Speed', 'ukt_slides_transition_speed', 'uktslides', 'ukt_slideshow' );
		add_settings_field( 'slide_duration', 'Slide Duration', 'ukt_slides_slide_duration', 'uktslides', 'ukt_slideshow' );
	}
	
	
	add_filter( 'plugin_action_links', 'ukt_slides_settings_link', 10, 2 );
	add_action( 'admin_menu', 'ukt_slides_menu' );
	add_action( 'admin_init', 'ukt_slides_register_settings' );

?>