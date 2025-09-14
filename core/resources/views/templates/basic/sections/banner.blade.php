@php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element', orderById: true);
@endphp
<section class="banner-section py-60">
    <div class="container">
        {{--<div class="banner-section__shape">
             <img src="{{ frontendImage('banner', @$bannerContent->data_values->background_image, '1010x715') }}" alt="@lang('image')" /> 
        </div>--}}
        <div class="row align-items-center flex-lg-row-reverse gy-4 gy-sm-5">
            <div class="col-xl-7 col-lg-6">
                <div class="banner-slider">
                    @foreach (@$bannerElement as $banner)
                        <div class="slick-item">
                            <img src="{{ frontendImage('banner', @$banner->data_values->slider_image, '670x395') }}" alt="@lang('image')" />
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="banner-content">
                    <h4 class="banner-content__heading">{{ __(@$bannerContent->data_values->heading) }}</h4>
                    <h1 class="banner-content__title highlight" data-length="4">{{ __(@$bannerContent->data_values->subheading) }}</h1>
                    <p class="banner-content__desc">{{ __(@$bannerContent->data_values->short_description) }}</p>
                    <div class="banner-content__button">
                        <a class="btn btn--lg btn--gradient" href="{{ url(@$bannerContent->data_values->button_link) }}">{{ __(@$bannerContent->data_values->button_name) }}
                            <span class="icon"><i class="las la-chevron-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script')
    <script>
        (function($) {
            "use strict";
            // Banner slider
            $(".banner-slider").on("init", function (event, slick) {
                var dots = $(".slick-dots li");

                dots.each(function (k) {
                    $(this)
                        .find("button")
                        .addClass("image" + k);
                });

                var items = slick.$slides;
                items.each(function (k, v) {
                    $(".image" + k).html(`<img src="${$(this).find("img").attr("src")}">`);
                });
            });

            $(".banner-slider").slick({
                dots: true,
                autoplay: true,
                focusOnSelect: true,
                infinite: true,
                arrows: true,
                fade: true,
                speed: 300,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow:
                    '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow:
                    '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></i></button>',

                responsive: [
                    {
                        breakpoint: 577,
                        settings: {
                            arrows: false,
                            dots: true,
                        },
                    },
                ],
            });
            $(window).on('load', function(e) {
                let hightlightContent = $('.highlight');
                let content = hightlightContent.text();
                let splitContent = content.split(' ');
                let length = hightlightContent.data('length');
                let htmlContent = ``;
                for (let i = 0; i < splitContent.length; i++) {
                    if (i === (length - 1)) {
                        htmlContent += ' ' + `<span class="text--base px-1">${splitContent[i]}</span>`
                    } else {
                        htmlContent += ' ' + splitContent[i];
                    }
                }
                hightlightContent.html(htmlContent);
            });
        })(jQuery)
    </script>
@endpush
@if (!app()->offsetExists('slick_asset'))
    @push('style-lib')
        <link href="{{ asset('assets/global/css/slick.css') }}" rel="stylesheet">
    @endpush
    @push('script-lib')
        <script src="{{ asset('assets/global/js/slick.min.js') }}"></script>
    @endpush
    @php app()->offsetSet('slick_asset',true) @endphp
@endif
