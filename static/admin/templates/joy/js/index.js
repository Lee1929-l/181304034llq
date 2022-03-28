jQuery(function(){
	jQuery(".serachBox .sradio").click(function(){
		jQuery(".serachBox .sradio").removeClass("active");
		jQuery(this).addClass("active");
	});
	if(!isMobile){
		jQuery(".banner").bxSlider({
	        auto: true,
			pause: 5000,
	        speed: 800,
	        pager: false,
	        nextText: '<i></i>',
			prevText: '<i></i>'
	    });
	    jQuery(".proimgIbox").bxSlider({
	        auto: true,
			pause: 4000,
	        speed: 500,
	        pager: false,
	        nextText: '<span></span><i></i>',
			prevText: '<span></span><i></i>'
	    });
	}else{
		jQuery(".banner").owlCarousel({
		    items: 1,
		    autoPlay:true,
		    slideSpeed:600,
			singleItem: true,
			navigation: true,
			pagination:false,
			navigationText:["<i></i>", "<i></i>"]
	    });
		jQuery(".proimgIbox").owlCarousel({
		    items: 1,
		    autoPlay:true,
		    slideSpeed:500,
			singleItem: true,
			navigation: true,
			pagination:false,
			navigationText:["<span></span><i></i>", "<span></span><i></i>"]
	    });
	}
    
    jQuery(".encyclopediasIDemo").slick({
	  autoplay: true,	
	  arrows: false,
	  dots:true,
	  infinite: true,
	  speed: 1000,
	  autoplaySpeed: 5000,
	  pauseOnHover: false,
	  fade: true,
	  cssEase: 'linear'
	});
});
