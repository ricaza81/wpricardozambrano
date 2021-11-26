jQuery(window).load(function(){
    jQuery(".rt-portfolio-box.element-five.isotope").each(function(){
        var $RTPortfolioBoxElementFive = jQuery(this).isotope({
            layoutMode: 'masonry',
        });
        jQuery(this).parent().children(".rt-portfolio-box-filter > button:last-child").addClass("current-menu-item");
        jQuery(this).parent().children(".rt-portfolio-box-filter").on( 'click', 'button', function(){
            jQuery(this).parent().find("button").removeClass("current-menu-item");
            jQuery(this).attr("class","current-menu-item");
            $RTPortfolioBoxElementFive.isotope({
                filter: jQuery(this).attr("data-filter"),
            });
        });
        if ( jQuery(this).hasClass("has-fancybox") ) {
            jQuery(this).find(".fancybox").fancybox({
                animationEffect: "zoom-in-out",
                animationDuration: 500,
                zoomOpacity: "auto",
            });
        }
    });
});