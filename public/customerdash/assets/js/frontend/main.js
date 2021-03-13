/*  ---------------------------------------------------
    Template Name: Ogani
    Description:  Ogani eCommerce  HTML Template
    Author: Colorlib
    Author URI: https://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Humberger Menu
    $(".humberger__open").on('click', function () {
        $(".humberger__menu__wrapper").addClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").addClass("active");
        $("body").addClass("over_hid");
    });

    $(".humberger__menu__overlay").on('click', function () {
        $(".humberger__menu__wrapper").removeClass("show__humberger__menu__wrapper");
        $(".humberger__menu__overlay").removeClass("active");
        $("body").removeClass("over_hid");
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*-----------------------
        Categories Slider
    ------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            0: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 3,
            },

            992: {
                items: 4,
            }
        }
    });


    $('.hero__categories__all').on('click', function () {
        $('.hero__categories ul').slideToggle(400);
    });

    /*--------------------------
        Latest Product Slider
    ----------------------------*/
    $(".latest-product__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------------
        Product Discount Slider
    -------------------------------*/
    $(".product__discount__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 3,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {

            320: {
                items: 1,
            },

            480: {
                items: 2,
            },

            768: {
                items: 2,
            },

            992: {
                items: 3,
            }
        }
    });

    /*---------------------------------
        Product Details Pic Slider
    ----------------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: true,
        margin: 20,
        items: 4,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-----------------------
        Price Range Slider
    ------------------------ */
    // var rangeSlider = $(".price-range"),
    //     minamount = $("#minamount"),
    //     maxamount = $("#maxamount"),
    //     minPrice = rangeSlider.data('min'),
    //     maxPrice = rangeSlider.data('max');
    // rangeSlider.slider({
    //     range: true,
    //     min: minPrice,
    //     max: maxPrice,
    //     values: [minPrice, maxPrice],
    //     slide: function (event, ui) {
    //         minamount.val('$' + ui.values[0]);
    //         maxamount.val('$' + ui.values[1]);
    //     }
    // });
    // minamount.val('$' + rangeSlider.slider("values", 0));
    // maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*------------------
        Single Product
    --------------------*/
    $('.product__details__pic__slider img').on('click', function () {

        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__details__pic__item--large').attr('src');
        if (imgurl != bigImg) {
            $('.product__details__pic__item--large').attr({
                src: imgurl
            });
        }
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $('.pro-qty');
    proQty.prepend('<span class="dec qtybtn">-</span>');
    proQty.append('<span class="inc qtybtn">+</span>');
    proQty.on('click', '.qtybtn', function () {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });

})(jQuery);




(function ($) {
    "use strict";

    $('.popup-youtube, .popup-vimeo').magnificPopup({
        // disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });



    var review = $('.textimonial_iner');
    if (review.length) {
        review.owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            nav: false,
            responsive: {
                0: {
                    margin: 15,

                },
                600: {
                    margin: 10,
                },
                1000: {
                    margin: 10,
                }
            }
        });
    }
    var best_product_slider = $('.best_product_slider');
    if (best_product_slider.length) {
        best_product_slider.owlCarousel({
            items: 4,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            nav: true,
            navText: ["next", "previous"],
            responsive: {
                0: {
                    margin: 15,
                    items: 1,
                    nav: false
                },
                576: {
                    margin: 15,
                    items: 2,
                    nav: false
                },
                768: {
                    margin: 30,
                    items: 3,
                    nav: true
                },
                991: {
                    margin: 30,
                    items: 4,
                    nav: true
                }
            }
        });
    }

    //product list slider
    // var product_list_slider = $('.product_list_slider');
    // if (product_list_slider.length) {
    //     product_list_slider.owlCarousel({
    //         items: 1,
    //         loop: true,
    //         dots: false,
    //         autoplay: true,
    //         autoplayHoverPause: true,
    //         autoplayTimeout: 5000,
    //         nav: true,
    //         navText: ["next", "previous"],
    //         smartSpeed: 1000,
    //         responsive: {
    //             0: {
    //                 margin: 15,
    //                 nav: false,
    //                 items: 1
    //             },
    //             600: {
    //                 margin: 15,
    //                 items: 1,
    //                 nav: false
    //             },
    //             768: {
    //                 margin: 30,
    //                 nav: true,
    //                 items: 1
    //             }
    //         }
    //     });
    // }

    //single banner slider
    // var banner_slider = $('.banner_slider');
    // if (banner_slider.length) {
    //   banner_slider.owlCarousel({
    //     items: 1,
    //     loop: true,
    //     dots: false,
    //     autoplay: true,
    //     autoplayHoverPause: true,
    //     autoplayTimeout: 5000,
    //     nav: true,
    //     navText: ["next","previous"],
    //     smartSpeed: 1000,
    //   });
    // }

    if ($('.img-gal').length > 0) {
        $('.img-gal').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }


    //single banner slider
    $('.banner_slider').on('initialized.owl.carousel changed.owl.carousel', function (e) {
        function pad2(number) {
            return (number < 10 ? '0' : '') + number
        }
        var carousel = e.relatedTarget;
        $('.slider-counter').text(pad2(carousel.current()));

    }).owlCarousel({
        items: 1,
        loop: true,
        dots: false,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: 5000,
        nav: true,
        navText: ["next", "previous"],
        smartSpeed: 1000,
        responsive: {
            0: {
                nav: false
            },
            600: {
                nav: false
            },
            768: {
                nav: true
            }
        }
    });



    // niceSelect js code
    $(document).ready(function () {
        $('select').niceSelect();
    });

    // menu fixed js code
    // $(window).scroll(function () {
    //   var window_top = $(window).scrollTop() + 1;
    //   if (window_top > 50) {
    //     $('.main_menu').addClass('menu_fixed animated fadeInDown');
    //   } else {
    //     $('.main_menu').removeClass('menu_fixed animated fadeInDown');
    //   }
    // });


    $('.counter').counterUp({
        time: 2000
    });

    $('.slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        speed: 300,
        infinite: true,
        asNavFor: '.slider-nav-thumbnails',
        autoplay: true,
        pauseOnFocus: true,
        dots: true,
    });

    $('.slider-nav-thumbnails').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider',
        focusOnSelect: true,
        infinite: true,
        prevArrow: false,
        nextArrow: false,
        centerMode: true,
        responsive: [{
            breakpoint: 480,
            settings: {
                centerMode: false,
            }
        }]
    });


    // Search Toggle
    $("#search_input_box").hide();
    $("#search_1").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function () {
        $('#search_input_box').slideUp(500);
    });

    //------- Mailchimp js --------//  
    function mailChimp() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();

    //------- makeTimer js --------//  
    function makeTimer() {

        //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");	
        var endTime = new Date("27 Sep 2019 12:56:00 GMT+01:00");
        endTime = (Date.parse(endTime) / 1000);

        var now = new Date();
        now = (Date.parse(now) / 1000);

        var timeLeft = endTime - now;

        var days = Math.floor(timeLeft / 86400);
        var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
        var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
        var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

        if (hours < "10") {
            hours = "0" + hours;
        }
        if (minutes < "10") {
            minutes = "0" + minutes;
        }
        if (seconds < "10") {
            seconds = "0" + seconds;
        }

        $("#days").html("<span>Days</span>" + days);
        $("#hours").html("<span>Hours</span>" + hours);
        $("#minutes").html("<span>Minutes</span>" + minutes);
        $("#seconds").html("<span>Seconds</span>" + seconds);

    }
    // click counter js
    (function () {

        window.inputNumber = function (el) {

            var min = el.attr('min') || false;
            var max = el.attr('max') || false;

            var els = {};

            els.dec = el.prev();
            els.inc = el.next();

            el.each(function () {
                init($(this));
            });

            function init(el) {

                els.dec.on('click', decrement);
                els.inc.on('click', increment);

                function decrement() {
                    var value = el[0].value;
                    value--;
                    if (!min || value >= min) {
                        el[0].value = value;
                    }
                }

                function increment() {
                    var value = el[0].value;
                    value++;
                    if (!max || value <= max) {
                        el[0].value = value++;
                    }
                }
            }
        }
    })();

    inputNumber($('.input-number'));



    setInterval(function () {
        makeTimer();
    }, 1000);

    // click counter js


    // var a = 0;
    // $('.increase').on('click', function(){



    //   console.log(  $(this).innerHTML='Product Count: '+ a++ );
    // });

    var product_overview = $('#vertical');
    if (product_overview.length) {
        product_overview.lightSlider({
            gallery: true,
            item: 1,
            vertical: true,
            verticalHeight: 450,
            thumbItem: 3,
            slideMargin: 0,
            speed: 600,
            autoplay: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        item: 1,

                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        item: 1,
                        slideMove: 1,
                        verticalHeight: 350,
                    }
                }
            ]
        });
    }




}(jQuery));

$(document).ready(function () {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        animateOut: 'fadeOut',
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });
})



$('.arrow-next').click(function () {
    var currentSlide = $('.active-slide'),
        nextSlide = currentSlide.next(),
        currentDot = $('.active-dot'),
        nextDot = currentDot.next();

    if (nextSlide.length === 0) {
        nextSlide = $('.slide').first();
        nextDot = $('.dot').first();
    }

    currentSlide.fadeOut(600).removeClass('active-slide');
    nextSlide.fadeIn(600).addClass('active-slide');

    currentDot.removeClass('active-dot');
    nextDot.addClass('active-dot');
});

$('.arrow-prev').click(function () {
    var currentSlide = $('.active-slide'),
        prevSlide = currentSlide.prev(),
        currentDot = $('.active-dot'),
        prevDot = currentDot.prev();

    if (prevSlide.length === 0) {
        prevSlide = $('.slide').last();
        prevDot = $('.dot').last();
    }

    currentSlide.fadeOut(600).removeClass('active-slide');
    prevSlide.fadeIn(600).addClass('active-slide');

    currentDot.removeClass('active-dot');
    prevDot.addClass('active-dot');
});

// this bit will resize the sliders height to make it responsive
$(window).on('load resize', function () {
    var x = $('.active-slide img').height() + "px";

    $('.slider').css('min-height', x);
    $('p').text(x);
});

//this part will add a dot for each slider item, then assign a class name to the first child to get the active state
$('section').each(function () {
    var a = $('.slide').length;
    for (i = 0; i < a; i++) {
        $('.slider-dots').append('<li class="dot">&bull;</li>');
    }
});

$('.slider div:first').addClass('active-slide');
$('.slider-dots li:first').addClass('active-dot');




$(document).ready(function () {
    var base_color = "rgb(230,230,230)";
    var active_color = "rgb(237, 40, 70)";



    var child = 1;
    var length = $("section").length - 1;
    $("#prev").addClass("disabled");
    $("#submit").addClass("disabled");

    $("section").not("section:nth-of-type(1)").hide();
    $("section").not("section:nth-of-type(1)").css('transform', 'translateX(100px)');

    var svgWidth = length * 200 + 24;
    $("#svg_wrap").html(
        '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
        svgWidth +
        ' 24" xml:space="preserve"></svg>'
    );

    function makeSVG(tag, attrs) {
        var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
        for (var k in attrs) el.setAttribute(k, attrs[k]);
        return el;
    }

    for (i = 0; i < length; i++) {
        var positionX = 12 + i * 200;
        var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
        document.getElementById("svg_form_time").appendChild(rect);
        // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
        var circle = makeSVG("circle", {
            cx: positionX,
            cy: 12,
            r: 12,
            width: positionX,
            height: 6
        });
        document.getElementById("svg_form_time").appendChild(circle);
    }

    var circle = makeSVG("circle", {
        cx: positionX + 200,
        cy: 12,
        r: 12,
        width: positionX,
        height: 6
    });
    document.getElementById("svg_form_time").appendChild(circle);

    $('#svg_form_time rect').css('fill', base_color);
    $('#svg_form_time circle').css('fill', base_color);
    $("circle:nth-of-type(1)").css("fill", active_color);


    $(".button").click(function () {
        $("#svg_form_time rect").css("fill", active_color);
        $("#svg_form_time circle").css("fill", active_color);
        var id = $(this).attr("id");
        if (id == "next") {
            $("#prev").removeClass("disabled");
            if (child >= length) {
                $(this).addClass("disabled");
                $('#submit').removeClass("disabled");
            }
            if (child <= length) {
                child++;
            }
        } else if (id == "prev") {
            $("#next").removeClass("disabled");
            $('#submit').addClass("disabled");
            if (child <= 2) {
                $(this).addClass("disabled");
            }
            if (child > 1) {
                child--;
            }
        }
        var circle_child = child + 1;
        $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
            "fill",
            base_color
        );
        $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
            "fill",
            base_color
        );
        var currentSection = $("section:nth-of-type(" + child + ")");
        currentSection.fadeIn();
        currentSection.css('transform', 'translateX(0)');
        currentSection.prevAll('section').css('transform', 'translateX(-100px)');
        currentSection.nextAll('section').css('transform', 'translateX(100px)');
        $('section').not(currentSection).hide();
    });

});