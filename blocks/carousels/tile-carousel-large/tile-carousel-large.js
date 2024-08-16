jQuery(function ($) {
  $(".tile-carousel-large .tile-slider-lg .slider").each(function () {
    const slider = $(this);
    slider
      .slick({
        centerMode: true,
        centerPadding: "12%",
        slidesToShow: 1,
        infinite: true,
        arrows: true,
        prevArrow:
          '<button type="button" class="slick-prev" aria-label="Projects previous navigation">' +
          '<svg xmlns="http://www.w3.org/2000/svg" width="22.914" height="41.013" viewBox="0 0 22.914 41.013">' +
          '<path id="Path_100" data-name="Path 100" d="M586.127,751.289l-3.509-3.5,16.017-16.071L582.52,713.565l3.705-3.289,19.209,21.641Z" transform="translate(605.435 751.289) rotate(180)" fill="#fff"/>' +
          "</svg>" +
          "</button>",
        nextArrow:
          '<button type="button" class="slick-next" aria-label="Projects next navigation">' +
          '<svg xmlns="http://www.w3.org/2000/svg" width="22.914" height="41.013" viewBox="0 0 22.914 41.013">' +
          '<path id="Path_100" data-name="Path 100" d="M586.127,751.289l-3.509-3.5,16.017-16.071L582.52,713.565l3.705-3.289,19.209,21.641Z" transform="translate(-582.52 -710.276)" fill="#fff"/>' +
          "</svg>" +
          "</button>",
        margin: "15px",
      })
      .on("afterChange", function (event, slick, currentSlide) {
        $(this).find(".slick-slide .aos-init").removeClass("aos-animate");

        $(this)
          .find(
            '.slick-slide[data-slick-index="' + currentSlide + '"] .aos-init'
          )
          .addClass("aos-animate");
      })
      .on("click", ".slide", function (event) {
        event.stopPropagation();
        $(this).find("a")[0].click();
      });

    let observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          slider.slick("slickSetOption", "autoplay", true, true);
          observer.unobserve(entry.target);
        }
      });
    });

    observer.observe(slider[0]);
  });
});
