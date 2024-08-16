jQuery(function ($) {
  function countUp(element) {
    var $element = $(element);
    var countTo = $element.text();

    // Calculate the width in ch based on the number of digits in the countTo value
    var chWidth = countTo.length;
    $element.css("min-width", chWidth + "ch");

    $element.text("0");

    $({ countNum: 0 }).animate(
      { countNum: countTo },
      {
        duration: 1800,
        easing: "swing",
        step: function () {
          $element.text(Math.floor(this.countNum));
        },
        complete: function () {
          $element.text(this.countNum);
        },
      }
    );
  }

  var observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          countUp(entry.target);
          observer.unobserve(entry.target); // Stop observing after counting up
        }
      });
    },
    { threshold: 1.0 }
  );

  $(".stat-value").each(function () {
    observer.observe(this);
  });
});
