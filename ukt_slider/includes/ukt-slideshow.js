// Get the slideshow options
var slidespeed      = parseInt( uktsettings.uktslideshowspeed );
var slidetimeout    = parseInt( uktsettings.uktslideshowduration );
var slideheight     = parseInt( uktsettings.uktslideshowheight );

jQuery(document).ready(function(){
	var slideWidth = 923;
	var currentPosition = 0;
	var interval;
	var slides = jQuery('.li_slideshow');
	var numberOfSlides = slides.length;
	
	start();  
		
	function start()
	{
		interval = setInterval(next, slidetimeout);
	}
  
    function next(){
		currentPosition = currentPosition+1;
		if (currentPosition == 1)
		{
			jQuery('.ul_slideshow').stop(true).animate({
			  'marginLeft' : slideWidth*(-currentPosition)
			},slidespeed);
		}
		else if(currentPosition == (numberOfSlides))
		{
			currentPosition = 0;
			jQuery('.ul_slideshow').stop(true).animate({
			  'marginLeft' : '0px'
			},slidespeed);
		}
		else
		{		
			jQuery('.ul_slideshow').stop(true).animate({
			  'marginLeft' : slideWidth*(-currentPosition)
			},slidespeed);
		}

	}
	
	jQuery('.small-pictures').click(function(){
		clearInterval(interval);
		var slideActive = jQuery(this).attr('id').split('_');
		currentPosition = slideActive[1] - 1;
		jQuery('.ul_slideshow').stop(true).animate({marginLeft: slideWidth*(-currentPosition)}, slidespeed);
		if(currentPosition == (numberOfSlides-1))
		{
			currentPosition = 0;
		}
		start();
	});

});