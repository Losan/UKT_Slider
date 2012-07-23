<?php
	$css_path = plugins_url('ukt-slides-admin.css' , __FILE__ );
	echo '<link rel="stylesheet" href="'.$css_path.'" type="text/css" />';
	function ukt_slides_section_text() {
		echo "<p>Set up your slideshow using the options below.</p>";
	}
	
	function ukt_slides_slide_height() {	
		$ukt_px      = 'px';
		$ukt_options = get_option('uktslides_options');

		echo "<input id='slide_height' name='uktslides_options[slide_height]' size='20' type='text' value='{$ukt_options['slide_height']}' /> $ukt_px ";
		echo "<span class ='span_error' id='error_height'>ERROR</span>";
	}
	
	function ukt_slides_transition_speed() {
		$ukt_seconds = 'seconds';
		$ukt_options = get_option( 'uktslides_options' );

		echo "<input id='transition_speed' name='uktslides_options[transition_speed]' size='20' type='text' value='{$ukt_options['transition_speed']}' /> $ukt_seconds";
		echo "<span class ='span_error' id='error_speed'>ERROR</span>";
	}
	
	function ukt_slides_slide_duration() {
		$ukt_seconds = 'seconds';
		$ukt_options = get_option( 'uktslides_options' );

		echo "<input id='slide_duration' name='uktslides_options[slide_duration]' size='20' type='text' value='{$ukt_options['slide_duration']}' /> $ukt_seconds";
		echo "<span class ='span_error' id='error_duration'>ERROR</span>";
	}
?>
<div class="wrap">
	
	<div id="icon-edit" class="icon32"><br /></div>
	<h2>UKT Slides Settings</h2>

	<form id="settings-form" action="options.php" method="post">
		<?php // Adds options to settings page
			settings_fields( 'uktslides_options' );
			do_settings_sections( 'uktslides' );
		?>
		<p class="submit">
			<input name="Submit" type="button" class="button-primary" onClick="validate_form()" value="Save Changes" />
		</p>
	</form>
	
	<p>Use <code>[ukt_slideshow id='...']</code> to add it to your Post or Page content</p>
</div><!-- .wrap -->
<script type="text/javascript">
	function validate_form()
	{
		var ukt_quantity = document.getElementById("slideshow_quantity");
		var ukt_height = document.getElementById("slide_height");
		var ukt_speed = document.getElementById("transition_speed");
		var ukt_duration = document.getElementById("slide_duration");
		var reg1 = /^[0-9]{1,3}$/i;
		var reg2 = /^[0-9]{1,4}$/i;
		var bad_field = 0;
		if(!(ukt_height.value.match(reg1))){
			document.getElementById("error_height").style.display = "inline";
			ukt_height.value="";
			bad_field = 1;
		}
		if(!(ukt_speed.value.match(reg2))){
			document.getElementById("error_speed").style.display = "inline";
			ukt_speed.value="";
			bad_field = 1;
		}
		if(!(ukt_duration.value.match(reg1))){
			document.getElementById("error_duration").style.display = "inline";
			ukt_duration.value="";
			bad_field = 1;
		}
			
		if(bad_field == 0){
			document.forms["settings-form"].submit();
		}
	}
</script>