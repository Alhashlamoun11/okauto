"use strict";
(function ($) {
  // ==========================================
  //      Start Document Ready function
  // ==========================================
  $(document).ready(function () {
    $(window).on("scroll", function () {
      if ($(window).scrollTop() >= 45) {
        $(".header").addClass("fixed-header");
      } else {
        $(".header").removeClass("fixed-header");
      }
    });
    // // ========================= Header Sticky Js End===================

    // //============================ Scroll To Top Icon Js Start =========
    var btn = $(".scroll-top");

    $(window).scroll(function () {
      if ($(window).scrollTop() > 300) {
        btn.addClass("show");
      } else {
        btn.removeClass("show");
      }
    });

    btn.on("click", function (e) {
      e.preventDefault();
      $("html, body").animate(
        {
          scrollTop: 0,
        },
        "300"
      );
    });

    // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js Start =====================
    $(".dropdown-item").on("click", function () {
      $(this).closest(".dropdown-menu").addClass("d-block");
    });
    // ========================== Small Device Header Menu On Click Dropdown menu collapse Stop Js End =====================

    // ========================== Add Attribute For Bg Image Js Start =====================
    $(".bg-img").css("background", function () {
      var bg = "url(" + $(this).data("background-image") + ")";
      return bg;
    });
    // ========================== Add Attribute For Bg Image Js End =====================

    // ========================== add active class to ul>li top Active current page Js Start =====================
    function dynamicActiveMenuClass(selector) {
      let fileName = window.location.pathname.split("/").reverse()[0];
      selector.find("li").each(function () {
        let anchor = $(this).find("a");
        if ($(anchor).attr("href") == fileName) {
          $(this).addClass("active");
        }
      });
      // if any li has active element add class
      selector.children("li").each(function () {
        if ($(this).find(".active").length) {
          $(this).addClass("active");
        }
      });
      // if no file name return
      if ("" == fileName) {
        selector.find("li").eq(0).addClass("active");
      }
    }
    if ($("ul.sidebar-menu-list").length) {
      dynamicActiveMenuClass($("ul.sidebar-menu-list"));
    }
    // ========================== add active class to ul>li top Active current page Js End =====================

    // ================== Password Show Hide Js Start ==========
    $(".toggle-password").on("click", function () {
      $(this).toggleClass(" fa-eye-slash");
      var input = $($(this).attr("id"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    // =============== Password Show Hide Js End =================

    // ========================= Slick Slider Js Start ==============

    // banner slider

    // ========================= Slick Slider Js End ===================

    // ========================= brand Slider Js Start ===============

    // ========================= brand Slider Js End ===================

    // Sidebar Icon & Overlay js
    $(".dashboard-body__bar-icon").on("click", function () {
      $(".sidebar-menu").addClass("show-sidebar");
      $(".sidebar-overlay").addClass("show");
      $("body").addClass("scroll-hide");
    });
    $(".sidebar-menu__close, .sidebar-overlay").on("click", function () {
      $(".sidebar-menu").removeClass("show-sidebar");
      $(".sidebar-overlay").removeClass("show");
      $("body").removeClass("scroll-hide");
    });
    // Sidebar Icon & Overlay js
    // ===================== Sidebar Menu Js End =================

    // ==================== Dashboard User Profile Dropdown Start ==================
    $(".user-info__button").on("click", function () {
      $(".user-info-dropdown").toggleClass("show");
    });
    $(".user-info__button").attr("tabindex", -1).focus();

    $(".user-info__button").on("focusout", function () {
      $(".user-info-dropdown").removeClass("show");
    });
    // ==================== Dashboard User Profile Dropdown End ==================

    // ========================= Odometer Counter Up Js End ==========
    $(".counterup-item").each(function () {
      $(this).isInViewport(function (status) {
        if (status === "entered") {
          for (
            var i = 0;
            i < document.querySelectorAll(".odometer").length;
            i++
          ) {
            var el = document.querySelectorAll(".odometer")[i];
            el.innerHTML = el.getAttribute("data-odometer-final");
          }
        }
      });
    });
    // ========================= Odometer Up Counter Js End =====================
  });
  // ==========================================
  //      End Document Ready function
  // ==========================================

  // ========================= Preloader Js Start =====================
  $(window).on("load", function () {
    $(".preloader").fadeOut();
  });
  // ========================= Preloader Js End=====================

  // date picker

  ("use strict");

  // header bottom bars

  updateNavBarPosition();
  $(".header .nav-item").hover(
    function () {
      var width = $(this).outerWidth();
      var position = $(this).position().left;
      $(".navbar-nav__bar").css({
        width: width + "px",
        left: position + "px",
      });
    },
    function () {
      updateNavBarPosition();
    }
  );

  function updateNavBarPosition() {
    var activeNavItem = $("header .nav-item.active");
    if (activeNavItem.length > 0) {
      var width = activeNavItem.outerWidth();
      var position = activeNavItem.position().left;
      $(".navbar-nav__bar").css({
        width: width + "px",
        left: position + "px",
      });
    }
  }

  // tab

  $(document).ready(function () {
    updateBar();
    $(".custom--tab .nav-link").on("click", function () {
      var width = $(this).outerWidth();
      var position = $(this).position().left;
      $(".tab__bar").css({
        width: width + "px",
        left: position + "px",
      });
      updateBar();
    });

    function updateBar() {
      var activeNavItem = $(".custom--tab .nav-link.active");
      if (activeNavItem.length > 0) {
        var width = activeNavItem.outerWidth();
        var position = activeNavItem.position().left;
        $(".tab__bar").css({
          width: width + "px",
          left: position + "px",
        });
      }
    }
  });

  // lightcase
  $("a[data-rel^=lightcase]").lightcase();

  $(".has-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if ($(this).parent().hasClass("active")) {
      $(".has-dropdown").removeClass("active");
      $(this).parent().removeClass("active");
    } else {
      $(".has-dropdown").removeClass("active");
      $(this).next(".sidebar-submenu").slideDown(200);
      $(this).parent().addClass("active");
    }
  });

  $("#update-photo").change(function () {
    var file = this.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function () {
        var result = reader.result;
        $("#upload-img").attr("src", result);
      };
      reader.readAsDataURL(file);
    }
  });

  // language
  const curElement = {
    mainCurrency: $(".language-list"),
  };

  const mainCurrency = curElement.mainCurrency;
  const currencyItem = mainCurrency.children();

  currencyItem.each(function () {
    const innerItem = $(this);
    const languageText = innerItem.find(".language_text");

    innerItem.on("click", function () {
      $(".language__text").text(languageText.text());
    });
  });
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
})(jQuery);
