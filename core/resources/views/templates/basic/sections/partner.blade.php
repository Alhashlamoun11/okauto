@php
    $partnerElement = getContent('partner.element', false, null, true);
@endphp
<div class="py-120 brand-section bg-white">
    <div class="container">
        <div class="brand-section__slider">
            <div class="brand-slider">
                @foreach ($partnerElement as $partner)
                    <div class="brand-slider-item">
                        <img src="{{ frontendImage('partner' , @$partner->data_values->image, '155x85') }}" alt="image" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        (function ($) {
            "use strict";
            $(".brand-slider").slick({
                slidesToShow: 6,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 1000,
                pauseOnHover: true,
                speed: 2000,
                dots: false,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 5,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 3,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 400,
                        settings: {
                            slidesToShow: 2,
                            dots: false,
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
