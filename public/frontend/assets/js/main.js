"use strict";
$(document).ready(function () {
  $(".loaders").delay(600).fadeOut();

  $(".modal").on("shown.bs.modal", function () {
    $("body, html").trigger("focus");
  });

  /*****************  Login  ****************/
  $(".btnLogins").click(function () {
    $(".menu-logins").slideToggle();
  });
  $(document).mouseup((e) => {
    if (
      !$(".menu-logins").is(e.target) && // if the target of the click isn't the container...
      $(".menu-logins").has(e.target).length === 0
    ) {
      // ... nor a descendant of the container
      $(".menu-logins").fadeOut();
    }
  });


    // $(".has-dropdown > a").on('mouseenter', function (e) {
    //   e.preventDefault();
    //   $(this).parent().find(".mega_menu").slideToggle();
    // });
    // $(document).on("mouseleave", function (event) {
    //   var $trigger = $(".has-dropdown");
    //   if ($trigger !== event.target && !$trigger.has(event.target).length) {
    //     $(".mega_menu").hide();
    //   }
    // });
    
    // $(".has_dropdown > a").on('mouseenter', function (e) {
    //     e.preventDefault();
    //     $(this).parent().find(".dropdown_menu").slideToggle();
    // });
    // $(document).on("mouseleave", function (event) {
    //     var $trigger = $(".has_dropdown");
    //     if ($trigger !== event.target && !$trigger.has(event.target).length) {
    //       $(".dropdown_menu").hide();
    //     }
    // });
    
//   if ($(window).innerWidth() <= 767.98) {
//     /*****************  Mega Menu  ****************/
//     $(".has-dropdown > a").click(function (e) {
//       e.preventDefault();
//       $(this).parent().find(".mega_menu").slideToggle();
//     });
//     $(document).on("mouseup", function (event) {
//       var $trigger = $(".has-dropdown");
//       if ($trigger !== event.target && !$trigger.has(event.target).length) {
//         $(".mega_menu").hide();
//       }
//     });
//   } else {
//     /*****************  Sidebar Menu  ****************/
//     $(".has-dropdown > a").click(function (e) {
//       e.preventDefault();
//       $(this).parent().find(".sidemenu-shop").slideToggle();
//     });
//     $(document).on("mouseup", function (event) {
//       var $trigger = $(".has-dropdown");
//       if ($trigger !== event.target && !$trigger.has(event.target).length) {
//         $(".sidemenu-shop").hide();
//       }
//     });
//   }
  

  /*****************  Cart  ****************/
  $(".cartsho-link").click(function () {
    $(".menu-cart").slideToggle();
  });
  $(document).mouseup((e) => {
    if (
      !$(".menu-cart").is(e.target) && // if the target of the click isn't the container...
      $(".menu-cart").has(e.target).length === 0
    ) {
      // ... nor a descendant of the container
      $(".menu-cart").fadeOut();
    }
  });

  /*****************  Search  ****************/
  $(".searchs-link").click(function () {
    $(".form-search-header").toggleClass("show");
    $("body").toggleClass("overlay");
    $( ".form-search-header input" ).focus();
  });
  $(".close-search").click(function () {
    $(".form-search-header").removeClass("show");
    $("body").removeClass("overlay");
      $("#searchList").fadeOut('fast');
  });
  $(document).mouseup((e) => {
    if (
      !$(".form-search-header").is(e.target) && // if the target of the click isn't the container...
      $(".form-search-header").has(e.target).length === 0
    ) {
      // ... nor a descendant of the container
      $(".form-search-header").removeClass("show");
      $("body").removeClass("overlay");
      $("#searchList").fadeOut('fast');

    }
  });

  // $('.dropdown-toggle').click(function() {
  //   location.href = this.href;
  // });
  // $('.dropdown-toggle').mouseover(function() {
  //   $('.dropdown-menu').show();
  // });
  // $('.dropdown-toggle').mouseout(function() {
  //   t = setTimeout(function() {
  //       $('.dropdown-menu').hide();
  //   }, 100);
  //   $('.dropdown-menu').on('mouseenter', function() {
  //       $('.dropdown-menu').show();
  //       clearTimeout(t);
  //   }).on('mouseleave', function() {
  //       $('.dropdown-menu').hide();
  //   })
  // });

  /* Smooth On Scroll */
  $(document).on("click", ".smooth-scroll", function (e) {
    // target element id
    var id = $(this).attr("href");

    // target element
    var $id = $(id);
    if ($id.length === 0) {
      return;
    }

    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();

    // top position relative to the document
    var pos = $id.offset().top;

    // animated top scrolling
    $("body, html").animate(
      {
        scrollTop: pos,
      },
      600
    );
  });

  // $('.parallax-window ').parallax({});

  // WOW JS
  new WOW().init();

  // Button Toggle Menu On Mobile
  $(".toggle-menu").on("click", function () {
    $("nav").toggleClass("show");
  });
  // $(".close-menu-mobile").on('click', function () {
  //   $(this).parent('.nav-header').fadeOut();
  // });
  $(document).on("click", function (event) {
    var trigger = $(".toggle-menu")[0];
    var dropdown = $("nav");
    if (
      dropdown !== event.target &&
      !dropdown.has(event.target).length &&
      trigger !== event.target
    ) {
      dropdown.removeClass("show");
    }
  });

  // Button Toggle Filter
  $(".btn-filter-mobile").on("click", function () {
    $(".sidebar").toggleClass("show");
  });
  $(".btn-close-filter ").on("click", function () {
    $(".sidebar").removeClass("show");
  });
  $(document).on("click", function (event) {
    var trigger = $(".btn-filter-mobile")[0];
    var dropdown = $(".sidebar");
    if (
      dropdown !== event.target &&
      !dropdown.has(event.target).length &&
      trigger !== event.target
    ) {
      dropdown.removeClass("show");
    }
  });

  $('[data-fancybox="gallery"]').fancybox({
    thumbs: {
      autoStart: true,
    },
    // Close existing modals
    // Set this to false if you do not need to stack multiple instances
    closeExisting: false,

    // Enable infinite gallery navigation
    loop: true,

    // Enable keyboard navigation
    keyboard: true,

    // Should display navigation arrows at the screen edges
    arrows: true,

    // Open/close animation type
    // Possible values:
    //   false            - disable
    //   "zoom"           - zoom images from/to thumbnail
    //   "fade"
    //   "zoom-in-out"
    //
    animationEffect: "zoom-in-out",

    // Duration in ms for open/close animation
    animationDuration: 366,

    // Should image change opacity while zooming
    // If opacity is "auto", then opacity will be changed if image and thumbnail have different aspect ratios
    zoomOpacity: "auto",

    // Transition effect between slides
    //
    // Possible values:
    //   false            - disable
    //   "fade'
    //   "slide'
    //   "circular'
    //   "tube'
    //   "zoom-in-out'
    //   "rotate'
    //
    transitionEffect: "zoom-in-out",

    // Duration in ms for transition animation
    transitionDuration: 366,

    // Container is injected into this element
    parentEl: "body",

    // Hide browser vertical scrollbars; use at your own risk
    hideScrollbar: true,

    fullScreen: {
      autoStart: false,
    },

    // Set `touch: false` to disable panning/swiping
    touch: {
      vertical: true, // Allow to drag content vertically
      momentum: true, // Continue movement after releasing mouse/touch when panning
    },

    slideShow: {
      autoStart: false,
      speed: 3000,
    },
    protect: true,
  });

  // $('.jarallax').jarallax({
  //   speed: 0.5
  // });

  // Home Slider
  var owl = $("#slider-home");
  // Carousel initialization
  owl.owlCarousel({
    loop: true,
    margin: 0,
    navSpeed: 500,
    nav: true,
    navText: [
      "<i class='fas fa-lg fa-arrow-left'></i>",
      "<i class='fas fa-lg fa-arrow-right'></i>",
    ],
    dots: true,
    // dotsData: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: false,
    smartSpeed: 500,
    items: 1,
    /* info: true,
    onInitialized: counter, //When the plugin has initialized.
    onTranslated: counter //When the translation of the stage has finished. */
    responsiveClass: true,
    responsive: {
      0: {
        dots: false,
        nav: true,
      },
      767: {
        dots: false,
        nav: true,
      },
    },
  });
  // add animate.css class(es) to the elements to be animated
  function setAnimation(_elem, _InOut) {
    // Store all animationend event name in a string.
    // cf animate.css documentation
    var animationEndEvent =
      "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";

    _elem.each(function () {
      var $elem = $(this);
      var $animationType = "animated " + $elem.data("animation-" + _InOut);

      $elem.addClass($animationType).one(animationEndEvent, function () {
        $elem.removeClass($animationType); // remove animate.css Class at the end of the animations
      });
    });
  }
  // Fired before current slide change
  owl.on("change.owl.carousel", function (event) {
    var $currentItem = $(".owl-item", owl).eq(event.item.index);
    var $elemsToanim = $currentItem.find("[data-animation-out]");
    setAnimation($elemsToanim, "out");
  });
  // Fired after current slide has been changed
  owl.on("changed.owl.carousel", function (event) {
    var $currentItem = $(".owl-item", owl).eq(event.item.index);
    var $elemsToanim = $currentItem.find("[data-animation-in]");
    setAnimation($elemsToanim, "in");
  });

  $(".slides-partner").owlCarousel({
    dots: false,
    nav: false,
    loop: true,
    slideTransition: "linear",
    margin: 10,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: false,
    autoplaySpeed: 500,
    navText: [
      "<i class='fa fa-chevron-left fa-lg'></i>",
      "<i class='fa fa-chevron-right fa-lg'></i>",
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
      },
      500: {
        items: 3,
      },
      600: {
        items: 4,
      },
      800: {
        items: 5,
      },
      1200: {
        items: 7,
      },
    },
  });

  $(".slides-related").owlCarousel({
    dots: false,
    nav: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: false,
    navText: [
      "<i class='fas fa-chevron-left'></i>",
      "<i class='fas fa-chevron-right'></i>",
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 5,
      },
    },
  });

  // $(".button-filters button").click(function () {
  //   var value = $(this).attr("data-filter");
  //   if (value == "all") {
  //     $(".element-item").show("1000");
  //   } else {
  //     $(".element-item").not("." + value).hide("1000");
  //     $(".element-item").filter("." + value).show("1000");
  //   }
  // });
  // $(".button-filters button").click(function () {
  //   $(this).addClass("active").siblings().removeClass("active");
  // });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
      $(".scrollToTop").fadeIn();
    } else {
      $(".scrollToTop").fadeOut();
    }
  });
  $(".scrollToTop").click(function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });

  // $(".dish-desc .title").on('click', function() {
  //   $(this).next('.dish-desc .txt').slideToggle();
  //   $(this).toggleClass('active');
  // });

  // Select
  $("select").selectric({
      disableOnMobile: false,
        nativeOnMobile: false
  });

  // Select QTY
  $(".add").click(function (e) {
    e.preventDefault();
    if ($(this).prev().val() < 200) {
      $(this)
        .prev()
        .val(+$(this).prev().val() + 1);
    }
  });
  $(".sub").click(function (e) {
    e.preventDefault();
    if ($(this).next().val() > 0) {
      if ($(this).next().val() > 0)
        $(this)
          .next()
          .val(+$(this).next().val() - 1);
    }
  });

  // $(".btn_show_acc").on("click", function () {
  //   if ($(this).hasClass("active")) {
  //     $(this).removeClass("active");
  //     $(this).siblings(".items .desc, .desc2").slideUp(200);
  //     $(".btn_show_acc > i").removeClass("fa-minus").addClass("fa-plus");
  //   } else {
  //     $(".btn_show_acc > i").removeClass("fa-minus").addClass("fa-plus");
  //     $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
  //     $(".btn_show_acc").removeClass("active");
  //     $(this).addClass("active");
  //     $(".items .desc, .desc2").slideUp(200);
  //     $(this).siblings(".items .desc, .desc2").slideDown(200);
  //   }
  // });

  $(".btn_show_acc").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).siblings(".desc2").slideUp(200);
      $(".btn_show_acc > i").removeClass("fa-minus").addClass("fa-plus");
    } else {
      $(".btn_show_acc > i").removeClass("fa-minus").addClass("fa-plus");
      $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
      $(".btn_show_acc").removeClass("active");
      $(this).addClass("active");
      $(".desc2").slideUp(200);
      $(this).siblings(".desc2").slideDown(200);
    }
  });
  $(".btn_show_acc2").on("click", function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this).siblings(".desc_sup").slideUp(200);
      $(".btn_show_acc2 > i").removeClass("fa-minus").addClass("fa-plus");
    } else {
      $(".btn_show_acc2 > i").removeClass("fa-minus").addClass("fa-plus");
      $(this).find("i").removeClass("fa-plus").addClass("fa-minus");
      $(".btn_show_acc").removeClass("active");
      $(this).addClass("active");
      $(".desc_sup").slideUp(200);
      $(this).siblings(".desc_sup").slideDown(200);
    }
  });

  $(".btn-toggle-menu").on("click", function () {
    $(".sidebar-profile ul").slideToggle();
  });
}); // END jQuery

function onLoadPage() {
  // Sticky Header
  window.onscroll = () => {
    stickyHeader();
  };
  let header = document.querySelector("header");
  let sticky = header.offsetTop;

  function stickyHeader() {
    if (window.pageYOffset > sticky) {
      header.classList.add("fixed");
    } else {
      header.classList.remove("fixed");
    }
  }

  // Happ Clients
  var swiperSecond = new Swiper(".swiper-tistimonilas", {
    allowTouchMove: true,
    preventClicks: false,
    slidesPerColumn: 1,
    spaceBetween: 0,
    keyboard: {
      enabled: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination-second",
      clickable: true,
    },
    on: {
      resize: function () {
        swiperSecond.update();
      },
    },
    breakpoints: {
      640: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      768: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
      1024: {
        slidesPerView: 1,
        spaceBetween: 0,
      },
    },
  });

  var containerEl2 = document.getElementById("container-gallery"),
    mixer2;
  if (containerEl2) {
    mixer2 = mixitup(containerEl2, {
      selectors: {
        target: ".mix",
      },
      animation: {
        // "duration": 250,
        // "nudge": true,
        animateResizeContainer: false,
        effects: "fade scale",
      },
    });
  }

  var galleryThumbs = new Swiper(".gallery-thumbs", {
    spaceBetween: 5,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  var galleryTop = new Swiper(".gallery-top", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    thumbs: {
      swiper: galleryThumbs,
    },
  });

  // Range Price
  var parent = document.querySelector(".range-slider");
  if (!parent) return;
  var rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");
  rangeS.forEach(function (el) {
    el.oninput = function () {
      var slide1 = parseFloat(rangeS[0].value),
        slide2 = parseFloat(rangeS[1].value);
      if (slide1 > slide2) {
        [slide1, slide2] = [slide2, slide1];
        // var tmp = slide2;
        // slide2 = slide1;
        // slide1 = tmp;
      }
      numberS[0].value = slide1;
      numberS[1].value = slide2;
    };
  });
  numberS.forEach(function (el) {
    el.oninput = function () {
      var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value);
      if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
      }
      rangeS[0].value = number1;
      rangeS[1].value = number2;
    };
  });
}
onLoadPage();

let btnContacts = document.querySelector(".showContacts");
let contactsUl = document.querySelector(".contacts ul");
if (btnContacts, contactsUl) {
  btnContacts.onclick = () => {
    contactsUl.classList.toggle("show");
    if (contactsUl.classList.contains("show")) {
      btnContacts.classList.add("currents");
    } else {
      btnContacts.classList.remove("currents");
    }
  };
}







const btnNavSidebar = document.querySelector(".toggle-nav-desc");
const btnDescBack = document.querySelector(".desc-back");
const navSidebar = document.querySelector("#main-menu2");
const menuWrapper = document.querySelector("#main-nav2");
const bodyOverflowHidden = document.querySelector("body");
const onClickOutSide = document.querySelector(".layer_overlay");
if (btnNavSidebar, navSidebar, btnDescBack, menuWrapper) {
  btnNavSidebar.addEventListener('click', ()=> {
    navSidebar.classList.toggle('show');
    menuWrapper.classList.add('overlay')
    bodyOverflowHidden.style.overflow = "hidden";
  });
  btnDescBack.addEventListener('click', ()=> {
    navSidebar.classList.remove('show');
    menuWrapper.classList.remove('overlay')
    bodyOverflowHidden.style.overflow = "auto";
  });
  onClickOutSide.addEventListener('click', ()=> {
    navSidebar.classList.remove('show');
    menuWrapper.classList.remove('overlay')
    bodyOverflowHidden.style.overflow = "auto";
  });
  
}

const hasCollapsible = document.querySelectorAll(".has-collapsible");
const supDown = document.querySelectorAll(".sup_menu");

// Collapsible Menu
hasCollapsible.forEach(function (collapsible) {
	collapsible.addEventListener("click", function () {
		collapsible.classList.toggle("showing");

		// Close Other Collapsible
		hasCollapsible.forEach(function (otherCollapsible) {
			if (otherCollapsible !== collapsible) {
				otherCollapsible.classList.remove("showing");
			}
		});
	});
});



