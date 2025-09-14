@php
    $blogContent = getContent('blog.content', true);
    $blogs = getContent('blog.element', false, 4, true);
@endphp

<section class="blog py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$blogContent->data_values->heading) }}</p>
            <h2 class="section-heading__title">{{ __(@$blogContent->data_values->subheading) }}</h2>
        </div>
        <div class="blog-slider">
            @include($activeTemplate . 'partials.blog')
        </div>
    </div>
</section>

@push('script')
    <script>
        (function ($) {
            "use strict";
            // blog slider
            $(".blog-slider").slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                speed: 1500,
                dots: true,
                rows: 2,
                pauseOnHover: true,
                arrows: true,
                prevArrow:
                    '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow:
                    '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            arrows: false,
                            slidesToShow: 2,
                            dots: true,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2,
                            rows: 1,
                        },
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            rows: 1,
                        },
                    },
                ],
            });
        })(jQuery);
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
