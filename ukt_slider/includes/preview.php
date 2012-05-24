<?php

if ( (isset($_GET['preview'])) && ($_GET['preview'] != '') )
{

	$left_path = $_GET['left_path'];
	$right_path = $_GET['right_path'];
	$vignette_path = $_GET['vignette_path'];
	$left_link = $_GET['left_link'];
	$right_link = $_GET['right_link'];
	$vignette_link = $_GET['vignette_link'];
	$left_text = $_GET['left_text'];
	$right_text = $_GET['right_text'];
	$left_text_color = $_GET['left_text_color'];
	$right_text_color = $_GET['right_text_color'];
	$left_text_x = $_GET['left_text_x'];
	$left_text_y = $_GET['left_text_y'];
	$right_text_x = $_GET['right_text_x'];
	$right_text_y = $_GET['right_text_y'];
	$dir = $_GET['dir'];
	
	$left_text = str_replace( "CHARRET", "<br />", $left_text);
	$right_text = str_replace( "CHARRET", "<br />", $right_text);
	
	$right_text_color = str_replace( "DIEZE", "#", $right_text_color);
	$left_text_color = str_replace( "DIEZE", "#", $left_text_color);
	
	$more_info = $dir.'/images/more-info-button.png';
	$order_now = $dir.'/images/order-now-button.png';
		
	echo '<div style="height:357px;width:922px;overflow: hidden;">';
		echo '<ul class="ul_slideshow" style="position:relative;z-index:1; list-style-type: none;margin: 0;padding: 0;" >';
			echo '<div style="width:50%">';
			echo '<li class="li_slideshow active" id="image1" style="position:absolute;float:left;height:357px;width:922px;margin-left:170px;">';
				echo '<ul style="list-style-type: none;margin: 0;padding: 0;width:800px;">';
					echo '<li style="float:left;margin-right: -12px;margin-left:-167px;">';
						echo '<div>';
							echo '<div id="testest" style="position:absolute;margin-top: ',$left_text_y,'px;text-align: center;font-weight:bold;font-family:sans-serif;color:',$left_text_color,';margin-left:',$left_text_x,'px;">',$left_text,'</div>';
							echo '<div style="width:467px;height:357px;background-image:url(',$left_path,');"></div>';
						echo '</div>';
					echo '</li>';
					echo '<li style="float:left;margin-right: -12px">';
						echo '<div style="width:467px;height:357px;background-image:url(',$right_path,');">';
							echo '<div style="position:absolute;margin-top: ',$right_text_y,'px;text-align: center;font-weight:bold;font-family:sans-serif;color:',$right_text_color,';margin-left: ',$right_text_x,'px;">',$right_text,'</div>';
							echo '<div style="position:absolute;background-image:url(',$more_info,');width:180px;height:42px;margin-top: 269px;margin-left: 55px;">';
								echo '<a href="" class="button-link" style="color:white;line-height: 18px;padding: 12px 30px 12px 48px;display: block;width: 120px;font-weight:bold;">MORE INFO</a>';
							echo '</div>';
							echo '<div style="position:absolute;background-image:url(',$order_now,');width:180px;height:42px;margin-top: 269px;margin-left: 244px;">';
								echo '<a href="#" class="button-link" style="color:white;line-height: 18px;padding: 12px 30px 12px 43px;display: block;width: 120px;font-weight:bold;">ORDER NOW</a>';
							echo '</div>';
						echo '</div>';
					echo '</li>';
					
				echo '</ul>';
			echo '</li>';
			echo '</div>';
		echo '</ul>';
	echo '</div>';
}
else
{
	echo 'Error while getting preview slide';
}



?>