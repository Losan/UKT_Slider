
<style>
	a.button-link:hover{
		text-decoration:underline;
	}
</style>

<?php
	// Settings for slideshow loop

	global $post;
	
	$ukt_posttemp = $post;
	$ukt_options  = get_option( 'uktslides_options' );
	$ukt_count    = 1;
	$ukt_loop     = new WP_Query( array(
		'post_type'      => 'uktslider',
		'slider'      => $id
	) );
?>
		<?php 
			if($ukt_loop->found_posts>1)
			{
					  wp_enqueue_script('jquery');
					  wp_enqueue_script('slide_js', plugins_url('/ukt-slideshow.js' , __FILE__ ));
			}
		?>
		<br />
		<!--<div style="height:357px;width:922px;overflow: hidden; z-index:5; margin-left:-170px;">$ukt_options['slide_height']-->
		<div style="height:<?php echo $ukt_options['slide_height']; ?>;width:922px;overflow: hidden; z-index:5; margin-left:-170px;">
		<ul class="ul_slideshow" style="position:relative;z-index:1;width:99999px;list-style-type: none;margin: 0;padding: 0;" >
		<?php
			
			$i=0;
			while ( $ukt_loop->have_posts() )
			{
				$i++;
				$ukt_loop->the_post();
				
				$left_path = get_post_custom_values('upload_image');	
				$right_path = get_post_custom_values('upload_image2');
				
				$left_link = get_post_custom_values('left_image_link');
				$right_link = get_post_custom_values('right_image_link');				
				
				$left_text_color = get_post_custom_values('color');
				$right_text_color = get_post_custom_values('color1');
				
				$left_text = get_post_custom_values('textarea1');
				$right_text = get_post_custom_values('textarea2');
				
				$left_text_x = get_post_custom_values('left_image_text_x');
				$left_text_y = get_post_custom_values('left_image_text_y');
				
				$right_text_x = get_post_custom_values('right_image_text_x');
				$right_text_y = get_post_custom_values('right_image_text_y');
				
				$more_info_link = get_post_custom_values('more_info_link');
				$order_now_link = get_post_custom_values('order_now_link');

				$more_info = plugins_url('' , __DIR__ ).'/includes/images/more-info-button.png';
				$order_now = plugins_url('' , __DIR__ ).'/includes/images/order-now-button.png';
		?>
			<li class="li_slideshow active" id="image_<?php echo $i; ?>" style="float:left;height:357px;width:922px;margin-left:<?php if($i==1) echo "170"; else echo "-2";?>px;">
				<ul style="list-style-type: none;margin: 0;padding: 0;width:800px;">
					<li style="float:left;margin-right: -12px;margin-left:-167px;">
						<div onclick = "window.location.href='http://<?php echo $left_link[0] ?>';" style="cursor:pointer;">
								<div>
									<div id="testest" style="position:absolute;margin-top:<?php echo $left_text_y[0];?>px;text-align: center;margin-left:<?php echo $left_text_x[0]; ?>px;"> <pre style="background:none;font-weight:bold;font-family:sans-serif;color:<?php echo $left_text_color[0]; ?>;"><?php echo $left_text[0]; ?></pre></div>
									<div style="width:467px;height:357px;background-image:url('<?php echo $left_path[0]; ?>');"></div>
								</div>
						</div>
					</li>
					<li style="float:left;margin-right: -12px">
							<div onclick = "window.location.href='http://<?php echo $right_link[0] ?>';" style="cursor:pointer; width:467px;height:357px;background-image:url('<?php echo $right_path[0]; ?>');">
								<div id="testest" style="position:absolute;margin-top:<?php echo $right_text_y[0];?>px;text-align: center;margin-left:<?php echo $right_text_x[0]; ?>px;">
									<pre style="background:none;font-weight:bold;font-family:sans-serif;color:<?php echo $right_text_color[0];?>"><?php echo $right_text[0]; ?></pre>
								</div>
								
								<a href="http://<?php echo $more_info_link[0] ?>" target="_top">
									<div style="position:absolute;background-image:url('<?php echo $more_info; ?>');width:180px;height:42px;margin-top: 269px;margin-left: 55px;">
										<span class="button-link" style="color:white;line-height: 18px;padding: 12px 30px 12px 48px;display: block;width: 120px;font-weight:bold;">MORE INFO</a>
									</div>
								</a>
								<a href="http://<?php echo $order_now_link[0] ?>" target="_top">
									<div style="position:absolute;background-image:url('<?php echo $order_now;?>');width:180px;height:42px;margin-top: 269px;margin-left: 244px;">
										<span class="button-link" style="color:white;line-height: 18px;padding: 12px 30px 12px 43px;display: block;width: 120px;font-weight:bold;">ORDER NOW</a>
									</div>
								</a>
							</div>
					</li>
				</ul>
			</li>
			<?php } ?>
		</ul>
		</div>
			
		
		<ul style="list-style-type: none;margin: 0;padding: 0;width:931px;margin-left:-170px;">
		<?php	
			$i=0;
			while ( $ukt_loop->have_posts() )
			{
				$i++;
				$ukt_loop->the_post();
				$vignette_path = get_post_custom_values('upload_image3');
				$vignette_link = get_post_custom_values('vignette_image_link');
		?>
			<li id="image_<?php echo $i; ?>" class="small-pictures" style="float:left;">
				<a>
					<img src="<?php echo $vignette_path[0]; ?>">
				</a>
			</li>
		<?php } ?>
			
	
