(function($){

    // Preloader
    $(window).on("load", () => {
		$(".preloader-wrapper").fadeOut();
	});

    $(document).ready(function(){
        // Initiate Bootstrap Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Mobile Navigation
		$(".primary-nav").meanmenu({
			meanMenuContainer   : '#mobile-nav',
			meanScreenWidth     : '992',
			meanMenuOpen        : '<span></span><span></span><span></span>',
			meanMenuClose       : '<i class="fa-solid fa-close"></i>',
		});
        
        // Sticky Menu
        $(window).on("scroll", function(){
            var scrollHeight = $( document ).scrollTop();
            if( scrollHeight > 50 ){
               $('.site-header').addClass('nav-fixed');
           }else{
               $('.site-header').removeClass('nav-fixed');
           }

           // Scroll To Top Apearing
            if(scrollHeight > 150){
                $('.scroll-top').fadeIn();
            }else{
                $('.scroll-top').fadeOut();
            }
        });
    });
}(jQuery))