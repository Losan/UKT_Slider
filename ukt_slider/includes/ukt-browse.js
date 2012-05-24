///////////////////////////////////////
jQuery(document).ready(function() {

	//color picker 1
	jQuery('#colordiv').hide();
    jQuery('#colordiv').farbtastic("#color");
	
    jQuery("#color").click(function(){
		jQuery('#colordiv').slideToggle()
	});
	
	//color picker2
	jQuery('#color1div').hide();
    jQuery('#color1div').farbtastic("#color1");
	
    jQuery("#color1").click(function(){
		jQuery('#color1div').slideToggle()
	});
	
	//upload image 1
	jQuery('#upload_image_button').click(function() {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image').val(imgurl);
			tb_remove();
		}		 		 
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	 
	jQuery('#upload_image_button2').click(function() {
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image2').val(imgurl);
			tb_remove();
		}
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
		
	jQuery('#upload_image_button3').click(function() {	
	    window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image3').val(imgurl);
			tb_remove();
		}		 
		tb_show('', 'media-upload.php?post_id=1&amp;type=image&amp;TB_iframe=true');
		return false;
	});
	
	//preview on click
	
	jQuery('#preview').click(function() {
		var left_image_path = jQuery('#upload_image').val();
		var right_image_path = jQuery('#upload_image2').val();
		var vignette_image_path = jQuery('#upload_image3').val();
		
		var left_image_link =  jQuery('#left_image_link').val();
		var right_image_link =  jQuery('#right_image_link').val();
		var vignette_image_link = jQuery('#vignette_image_link').val();
		
		var left_image_text = jQuery('#textarea1').val();
		var right_image_text = jQuery('#textarea2').val();
		
		var left_image_text_color = jQuery('#color').val();
		var right_image_text_color = jQuery('#color1').val();
		
		var left_image_text_x = jQuery('#left_image_text_x').val();
		var left_image_text_y = jQuery('#left_image_text_y').val();
		
		var right_image_text_x = jQuery('#right_image_text_x').val();
		var right_image_text_y = jQuery('#right_image_text_y').val();
		
		
		var link = jQuery('#path_value').val();
		var dir = link.match(/^.*\//);
		var preview = dir+'preview.php';
		
		var espaceRegExp = new RegExp("(\r\n|\r|\n)", "g" );
		
		left_image_text = left_image_text.replace(espaceRegExp, "CHARRET");		
		right_image_text = right_image_text.replace(espaceRegExp, "CHARRET");
		
		left_image_text_color = left_image_text_color.replace("#", "DIEZE");		
		right_image_text_color = right_image_text_color.replace("#", "DIEZE");
		
		var data =  '&left_path='+left_image_path +'&right_path='+ right_image_path + '&vignette_path=' + vignette_image_path + '&left_link=' + left_image_link + '&right_link=' + right_image_link + '&vignette_link=' +  vignette_image_link + '&left_text=' + left_image_text + '&right_text=' + right_image_text + '&left_text_color=' + left_image_text_color + '&right_text_color=' + right_image_text_color + '&left_text_x=' + left_image_text_x + '&left_text_y=' + left_image_text_y + '&right_text_x=' + right_image_text_x + '&right_text_y=' + right_image_text_y + '&dir=' + dir;
				
		jQuery("a.ukt_preview").attr("href", ""+preview + '?preview=full'+data+"");
		jQuery("#ukt_preview_link").show();
		
		jQuery('a.ukt_preview').nyroModal();			
	});

});