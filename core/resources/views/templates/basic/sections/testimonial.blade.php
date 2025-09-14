@php
    $testimonialContent = getContent('testimonial.content', true);
    $testimonialElement = getContent('testimonial.element', orderById: true);
@endphp

<section class="testimonials py-120">
    <div class="container">
        <div class="section-heading">
            <p class="section-heading__name">{{ __(@$testimonialContent->data_values->heading) }}</p>
            <h2 class="section-heading__title text-dark">{{ __(@$testimonialContent->data_values->subheading) }}</h2>
        </div>

        <div class="testimonial-slider">
            @foreach (@$testimonialElement as $testimonial)
                <div class="testimonial-item">
                    <q class="testimonial-item__desc">{{ __(@$testimonial->data_values->quotes) }}</q>
                    <div class="testimonial-item__info">
                        <div class="testimonial-item__thumb">
                            <img src="{{ frontendImage('testimonial' , @$testimonial->data_values->image, '60x60') }}" class="fit-image" alt="@lang('image')" />
                        </div>
                        <div class="testimonial-item__details">
                            <p class="testimonial-item__name">{{ __(@$testimonial->data_values->name) }}</p>
                            <span class="testimonial-item__designation">{{ __(@$testimonial->data_values->designation) }}, {{ __(@$testimonial->data_values->company_name) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@push('script')
    <script>
        (function ($) {
         "use strict";
         // banner slider
        $(".testimonial-slider").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            speed: 1500,
            dots: true,
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
                    breakpoint: 991,
                    settings: {
                        arrows: false,
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 520,
                    settings: {
                        arrows: false,
                        slidesToShow: 1,
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
