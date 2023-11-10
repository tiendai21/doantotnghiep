(function ($) {
    var _duration = 1000,
        _easing = "easeOutCubic",
        _width = window.innerWidth,
        _windowWidth = window.innerWidth,
        _windowHeight = window.innerHeight,
        _spmode = 960,
        _speed = 1000;

    if (_width <= _spmode) {
        slideNavList();
    }
    scrollInAnime(window, ".anime", "animated");
    scrollInAnime(window, ".anime2", "animated");
    // loading after
    window.onload = function () {
        toggleMenuSp();
        toggleMenuFooter();
        toggleSearch();
        openIntro();
        faq();
        scrollAnimation("#header #nav_list a", 100);
        scrollAnimation("#program ul li a", 100);
        scrollAnimation(".faq .tab_content_faq a", 100);
        scrollAnimation(".broadcast_schedule a", 100);
        scrollAnimation(".list_year ul li a", 167);
        handleSlide(".slide_top", false, false, true, true);
        slideBrand(".slide_brand ul", false);
        slideProgram(".slide_air", false, false);
        slideProgram(".slide_history", false, false);
        slideProgram(".slide_news", false, false);
        slideProgram(".slide_recommend", false, false);
        slideProgram(".slide_chinese", false, false);
        slideProgram(".slide_korean", false, false);
        slideProgram(".slide_ranking", false, false);
        slideProgram(".side_brand", false, false);
        slideProgram(".brand_schedule", false, false);
        slideProgram(".brand_korea", false, false);
        slideProgram(".brand_drama", false, false);
        slideProgram(".brand_china", false, false);
        slideProgram(".brand_sports", false, false);
        slideProgram(".brand_tabi", false, false);
        slideProgram(".brand_variety",false, false);
        slideProgram(".brand_documentary",false, false);
        slideProgram(".brand_music", false, false);
        slideProgram(".brand_anime",false,false);
        slideProgram(".brand_entertainment",false,false);
        slideProgram(".brand_qvc",false,false);
        slideNavList(".side_header", false, false);
        slideList(".slide_list", false, false);
        voiceList(".voice_list", false, false);
        synopsisList(".synopsis_list", false, false);
        showPopUp();
        toggleReadMore();
        // categorry
        slideProgram(".dramas_top", false, false);
        slideProgram(".dramas_bottom", false, false);
        slideProgram(".broadcast_slide", false, false);
        slideProgram(".ranking_slide", false, false);
        slideBanner(".slide_top_odd", "15%");
        slideBanner(".slide_top_even", "45%");
        sliderVideo(".slider_main", ".slider_video");
        $(".slide_next_time").slick();
        let itemFaq = $(".item_faq h3");
        itemFaq.click(function () {
            $(this).siblings(".content").stop().slideToggle();
            itemFaq.not($(this)).siblings(".content").slideUp();
            $(this).toggleClass("active");
            itemFaq.not($(this)).removeClass("active");
        });

        var topBtn = $(".btn_to_top");
        topBtn.click(function (event) {
            event.preventDefault();
            $("body,html").animate(
                {
                    scrollTop: 0,
                },
                500
            );
            return false;
        });
    };

    function toggleMenuSp() {
        $(".hamburger").click(function () {
            $(this).toggleClass("active");
            $(".nav_sp").toggleClass("active");
            $(".start_header").toggleClass("active");
            $(".end_header").toggleClass("active");
            $(".md_overlay").toggleClass("active");
            $("#main").toggleClass("active");
        });
    }

    /*
    *   Handle HomePage modal
    * */
    function showPopUp() {
        $(".btn_more").click(function () {
            if (!$(this).find('a').attr("href")) {
                $(this).parents("section").find(".inner .wrapper_modal").toggleClass("active");
                $("body").css("overflow", "hidden");
                $(".close").on("click", function () {
                    $(".wrapper_modal").removeClass("active");
                    $("body").removeAttr("style");
                });
            }
        });
    }

    function toggleSearch() {
        if ($(window).width() < 900) {
            $(".box_search_sp").click(function () {
                $(this).addClass("active");
                // $(".box_search").slideToggle("active");
                $("#___gcse_0").toggle("slide");
                $(".header_link ul").addClass("active");
            });
        }
    }
    function clickOutSite() {
        $(document).click(function (event) {
            if ($(event.target).closest("#___gcse_0").length === 0) {
                $(".box_search_sp").removeClass("active");
                $("#___gcse_0").toggle("slide");
                $(".header_link ul").removeClass("active");
            }
        });
    }
    function toggleReadMore() {
        $(".list_episode ul li:not(:nth-child(-n + 4))").hide();
        $("#episode .btn_more").click(function () {
            if (!$(this).hasClass("show_detail")) {
                $(this).siblings(".list_episode").find("ul li:not(:nth-child(-n + 4))").fadeIn(1000).show();
                $(this).addClass('show_detail');
                $("body").css("overflow", "auto");
            }else  {
                $(this).siblings(".list_episode").find("ul li:not(:nth-child(-n + 4))").fadeIn(1000).hide();
                $(this).removeClass('show_detail');
            }
        });
    }
    function toggleMenuFooter() {
        if (_width <= _spmode) {
            $(".nav_footer h3").click(function () {
                $_sibling = $(this).siblings();
                $_sibling.stop().slideToggle();
                $_sibling.find("ul").show();
                $(this).toggleClass("active");
            });
        }
    }

    function scrollAnimation(selector, offsetTop) {
        $(selector).click(function (e) {
            const targetPage = $(this).attr("href");
            if (targetPage.includes("#")) {
                e.preventDefault();
                const currentPage = $(targetPage);
                $("html, body").animate(
                    { scrollTop: currentPage.offset().top - offsetTop },
                    1000
                );
            }
        });
    }

    /*
        scroll In Animation
    */
    function scrollInAnime(_container, _animecontainer, _addclass) {
        if ($(_animecontainer).length) {
            $(_animecontainer).each(function () {
                var _imgPos = $(this).offset().top;
                var _scroll = $(_container).scrollTop();
                var _windowHeight = $(_container).height();
                if (_scroll > _imgPos - (_windowHeight - 100)) {
                    $(this).addClass(_addclass);
                }
            });
            _container.addEventListener(
                "scroll",
                function () {
                    $(_animecontainer).each(function () {
                        var _imgPos = $(this).offset().top;
                        var _scroll = $(_container).scrollTop();
                        var _windowHeight = $(_container).height();
                        if (
                            _scroll >
                            _imgPos - _windowHeight + _windowHeight / 5
                        ) {
                            $(this).addClass(_addclass);
                        } else {
                        }
                    });
                },
                { passive: true }
            );
        }
    }

    /*
        Slide Top
    */
    function handleSlide(_sliderElm, _fade, _autoplay, _arrow, _mode) {
        if ($(_sliderElm).length) {
            $(_sliderElm).slick({
                fade: _fade,
                slidesToShow: 2,
                focusOnSelect: true,
                speed: 500,
                centerMode: _mode,
                centerPadding: "10%",
                touchMove: false,
                autoplay: _autoplay,
                arrows: _arrow,
                infinite: true,
                adaptiveHeight: false,
                responsive: [
                    {
                        breakpoint: 960,
                        settings: {
                            centerPadding: false,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            swipe: true,
                            arrows: _arrow,
                        },
                    },
                ],
            });
        }
    }

    /*
        Slide Slick Program
    */
    function slideProgram(_sliderElm, _fade, _centerMode) {
        $(_sliderElm).slick({
            adaptiveHeight: true,
            centerMode: _centerMode,
            focusOnSelect: true,
            swipe: true,
            speed: 500,
            fade: _fade,
            touchMove: false,
            slidesToShow: 5,
            variableWidth: true,
            infinite: true,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 2,
                    },
                },
            ],
            // initialSlide: 1,
        });
        $(".slick-next").click(function () {
            $(this).siblings(".slick-prev").addClass("active");
        });

        $(_sliderElm).each(function () {
            if($(this).attr('class').includes('slide_ranking')) {
                if ($(this).find(".item_slide").length < 5) {
                    $(this).addClass('no-slide');
                }
            }
            else {
                if ($(this).find(".item_slide").length < 7) {
                    $(this).addClass('no-slide');
                }
            }
        });
    }

    function slideList(_sliderElm, _fade, _centerMode) {
        $(_sliderElm).slick({
            adaptiveHeight: true,
            centerMode: _centerMode,
            focusOnSelect: true,
            swipe: true,
            speed: 500,
            fade: _fade,
            touchMove: false,
            variableWidth: true,
            slidesToShow: 5,
            centerPadding: "3%",
            infinite: true,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }

    function slideBanner(_sliderElm, _padding) {
        $(_sliderElm).slick({
            centerMode: true,
            centerPadding: _padding,
            infinite: true,
            vertical: true,
            verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 0,
            arrows: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            speed: 7000,
            cssEase: "linear",
            focusOnSelect: true,
        });
    }

    function synopsisList(_sliderElm, _fade, _centerMode) {
        $(_sliderElm).slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            adaptiveHeight: true,
            variableWidth: true,
        });
    }

    function voiceList(_sliderElm, _fade, _centerMode) {
        $(_sliderElm).slick({
            adaptiveHeight: true,
            centerMode: _centerMode,
            focusOnSelect: true,
            swipe: true,
            speed: 500,
            fade: _fade,
            touchMove: false,
            variableWidth: true,
            slidesToShow: 3,
            centerPadding: "7%",
            infinite: true,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    }

    function slideNavList(_sliderElm, _fade, _centerMode) {
        $(_sliderElm).slick({
            adaptiveHeight: true,
            centerMode: _centerMode,
            focusOnSelect: true,
            swipe: true,
            speed: 500,
            fade: _fade,
            touchMove: false,
            variableWidth: true,
            slidesToShow: 5,
            infinite: false,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    },
                },
                {
                    breakpoint: 1921,
                    settings: "unslick",
                },
            ],
        });
    }

    /*
       Slide Slick Brand
   */
    function slideBrand(_sliderElm, _fade) {
        $(_sliderElm).slick({
            adaptiveHeight: true,
            focusOnSelect: true,
            swipe: true,
            speed: 500,
            fade: _fade,
            touchMove: false,
            slidesToShow: 2,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 2,
                        arrows: true,
                    },
                },
            ],
        });
    }

    function openIntro() {
        $('.list_introduce ul li ul:not(:first-child)').hide();
        $('.list_introduce ul li h3').click(function () {
            $(this).siblings('.list_introduce ul li ul').stop().slideToggle();
            $(this).parent().toggleClass('active');
        });
    }

    function faq() {
        $('.faq .answer:not(:first-child)').hide();
        $('.faq .question').click(function () {
            $(this).siblings('.faq .answer').stop().slideToggle();
            $(this).toggleClass('active');
        });
    }

    /*
        slider video
    */
    function sliderVideo(_mainSlider, _sliderVideo) {
        $(_mainSlider).slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: _sliderVideo,
        });
        $(_mainSlider).on('beforeChange', function (event, slick, currentSlide) {
            var currentSlideElement = slick.$slides.eq(currentSlide);
            var videoElement = currentSlideElement.find('video')[0];
            videoElement.pause();
        });
        $(_sliderVideo).slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: _mainSlider,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 960,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        asNavFor: _mainSlider,
                        focusOnSelect: true,
                    }
                },
            ]
        });
    }

    //resize after
    window.onresize = function () {
        _width = $(window).width();
    };
    window.onscroll = function () {
    };

    document.addEventListener("DOMContentLoaded", function () {
        $(".section-hidden").addClass("visibility")
    });
})(jQuery);
