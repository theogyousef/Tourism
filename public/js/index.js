$(document).ready(function() {
    $(".slider").slick({
        arrows: true,
        dots: false,
        slidesToShow: 4, // Display 4 products
        autoplay: false,
        speed: 900,
        autoplaySpeed: 700,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2 // Display 2 products on smaller screens (tablet)
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1 // Display 1 product on even smaller screens (mobile)
                }
            }
        ]
    });

    $(".slick-next").html('<i class="fas fa-arrow-right"></i>');
    $(".slick-prev").html('<i class="fas fa-arrow-left"></i>');
});