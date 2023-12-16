jQuery('#record-slider').owlCarousel({
    loop:true,
	arrow:true,
    margin:30,
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
});

    

/************************* Sliders *************************/
    jQuery('#packages-slider2').owlCarousel({
        loop: true,
        margin: 100,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplaySpeed: 1500,
//         slideTransition: 'linear',
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 2
            },
            576: {
                items: 3
            },
            768: {
                items: 5
            },
            992: {
                items: 6
            }

        }
    })

