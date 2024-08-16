const AOS = require("aos");
require("select2");
const lottie = require("lottie-web/build/player/lottie");

jQuery(document).ready(function ($) {
  const selectOptions = {
    minimumResultsForSearch: Infinity,
    placeholder: "Select",
  };
  $("select").select2(selectOptions);

  // Define your SVG HTML as a string
  var customSvgArrow = `
    <svg xmlns="http://www.w3.org/2000/svg" width="28.743" height="18.243" viewBox="0 0 28.743 18.243" style="transform: rotate(90deg); margin-left: auto;">
      <g transform="translate(2788.121 -800.379)">
        <line x2="14" y2="14" transform="translate(802.5 2761.5)" fill="none" stroke="currentColor" stroke-width="6"/>
        <line x1="14" y2="14" transform="translate(802.5 2772)" fill="none" stroke="currentColor" stroke-width="6"/>
      </g>
    </svg>
  `;

  // Delay appending the SVG to ensure Select2 elements are fully initialized
  setTimeout(function () {
    $(
      ".select2-container--default .select2-selection--single, .select2-container--default .select2-selection--multiple"
    ).each(function () {
      var wrapper = document.createElement("div");
      wrapper.innerHTML = customSvgArrow;
      wrapper.style.position = "absolute";
      wrapper.style.top = "50%";
      wrapper.style.right = "8px";
      wrapper.style.transform = "translateY(-50%)";

      // Ensures the custom arrow is correctly positioned within Select2
      this.style.position = "relative";
      this.appendChild(wrapper);
    });
  }, 100); // Adjust delay as necessary
});

jQuery(window).on("load", function () {
  AOS.init({
    duration: 600,
    once: true,
  });

  if (jQuery(".lottie").length > 0) {
    observeLottieElements();
  }

  // Function to initialize Lottie animation on a target element
  function initializeLottieAnimation(element) {
    lottie.loadAnimation({
      container: element,
      renderer: "svg",
      loop: false,
      autoplay: true,
      path: jQuery(element).data("path"), // assuming data-path attribute contains the JSON file URL
    });
    element.classList.add("lottie-initialized");
  }

  // Setup Intersection Observer to initialize animations when they come into view
  function observeLottieElements() {
    const observerOptions = {
      root: null, // relative to document viewport
      rootMargin: "0px", // margin around root. Values are similar to css margin
      threshold: 0.5, // visible amount of item shown in relation to root
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (
          entry.isIntersecting &&
          !entry.target.classList.contains("lottie-initialized")
        ) {
          initializeLottieAnimation(entry.target);
          observer.unobserve(entry.target); // Stop observing the target so it isn't re-initialized
        }
      });
    }, observerOptions);

    // Observe all elements with the class 'lottie'
    document.querySelectorAll(".lottie").forEach((element) => {
      observer.observe(element);
    });
  }
});

jQuery(function ($) {
  function mobileHeaderInit() {
    var burgerButton = $(".burger-button");

    // Existing burger button functionality
    $(burgerButton).on("click", function () {
      $(this).toggleClass("open");
      $(this).closest(".header").toggleClass("active");
      $(this).closest(".header").find(".mobile-nav--wrapper").slideToggle();
      $("body").toggleClass("overflow-hidden");
    });

    // Hide all sub-menus initially
    $(".mobile-nav--wrapper .sub-menu").hide();

    // Handling clicks on menu items with children
    $(".mobile-nav--wrapper").on(
      "click",
      ".menu-item-has-children > a",
      function (e) {
        e.preventDefault();

        // Hide all menus except for the direct children of the clicked item
        $(this).closest("ul").children("li").hide();
        $(this).parent("li").show().css("padding-top", "0");
        $(this).parent("li").find("> a").hide();
        $(this).next(".sub-menu").show();
      }
    );

    // Handling clicks on the "Back" button
    $(".mobile-nav--wrapper").on("click", ".menu-item-back > a", function (e) {
      e.preventDefault();

      var currentSubMenu = $(this).closest(".sub-menu");

      // Hide the current sub-menu
      currentSubMenu.hide();

      // Traverse up to the parent menu item and show its sibling items
      currentSubMenu
        .parent()
        .closest("ul")
        .children("li")
        .show()
        .css("padding-top", "10px");
      currentSubMenu.parent().closest("ul").children("li").find("> a").show();
    });
  }

  // Initialize the mobile header functionality
  $(document).ready(function () {
    mobileHeaderInit();
  });

  // on scroll past 20px from the top, add .active class to header
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 20) {
      $(".header").addClass("active");
    } else {
      $(".header").removeClass("active");
    }
  });

  $('a[href^="#"]').on("click", function (event) {
    var target = this.hash;
    var $target = $(target);

    var offset = $target.offset().top;
    if (window.innerWidth < 992) {
      offset -= $("header").height();
    }

    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: offset,
        },
        700,
        "swing",
        function () {
          window.location.hash = target;
        }
      );
  });

  $(document).ready(function () {
    $('input[type="file"]').each(function () {
      var $fileInput = $(this);
      var $fileInputWrapper = $fileInput.closest(".wpcf7-form-control-wrap");

      // Create the custom label element
      var $customFileLabel = $(
        '<label class="custom-file-label"><span>Browse Files</span></label>'
      );

      // Append the custom label to the wrapper
      $fileInputWrapper.append($customFileLabel);

      // Hide the original file input
      $fileInput.css({
        position: "absolute",
        left: "-9999px",
      });

      $customFileLabel.on("click", function () {
        $fileInput.click();
      });

      // Update the label text when a file is selected
      $fileInput.on("change", function () {
        if ($fileInput[0].files.length > 0) {
          $customFileLabel.text($fileInput[0].files[0].name);
          $customFileLabel.addClass("active");
        } else {
          $customFileLabel.text("Browse Files");
          $customFileLabel.removeClass("active");
        }
      });
    });
  });
});
