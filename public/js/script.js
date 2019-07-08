/**//*================================
		Testimonial Owl Carousel
=================================*/

$("#client-speech").owlCarousel({
    autoPlay: 5000, //Set AutoPlay to 3 seconds
    stopOnHover: true,
    singleItem:true
});

/* -----------------  Secondary Navigation Fixed  ----------------*/
$(document).ready(function(){
    var menu = $('#secondaryNav');
    if(menu.length)
    {
        var origOffsetY = menu.offset().top;
        document.onscroll = scroll;
    }

    function scroll() {
        if ($(window).scrollTop() >= origOffsetY) {
            $('#secondaryNav').addClass('nav-fixed');
            $('.theme-list').addClass('extra-padding-top');
        } else {
            $('#secondaryNav').removeClass('nav-fixed');
            $('.theme-list').removeClass('extra-padding-top');
        }
    }
});
