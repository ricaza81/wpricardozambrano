jQuery(window).load(function(){
    jQuery(".rt-portfolio-box.element-nine.isotope").each(function(){
        var $RTPortfolioBoxElementNine = jQuery(this).isotope({
            layoutMode: 'masonry',
        });
        jQuery(this).parent().children(".rt-portfolio-box-filter > button:first-child").addClass("current-menu-item");
        jQuery(this).parent().children(".rt-portfolio-box-filter").on( 'click', 'button', function(){
            jQuery(this).parent().find("button").removeClass("current-menu-item");
            jQuery(this).attr("class","current-menu-item");
            $RTPortfolioBoxElementNine.isotope({
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