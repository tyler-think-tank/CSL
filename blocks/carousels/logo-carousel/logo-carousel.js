jQuery(function ($) {
  $(".logo-carousel").each(function () {
    var $carousel = $(this).find(".logo-carousel__slider-wrapper");

    $carousel.slick({
      slidesToShow: 1, // Show 1 slide (group) at a time
      slidesToScroll: 1,
      infinite: false,
      arrows: false,
      dots: true, // Enable dots
      appendDots: $(this).find(".logo-carousel__dots"), // Append dots to your custom class
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
});
