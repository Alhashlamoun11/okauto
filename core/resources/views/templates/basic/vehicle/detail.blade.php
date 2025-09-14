@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="product-details pt-120 pb-60">
        <div class="container">
            <div class="row g-4 g-md-5">
                <div class="col-lg-7">
                    <div class="product-slider">
                        <div class="slick-item">
                            <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . $vehicle->image, getFileSize('vehicle')) }}" alt="">
                        </div>
                        @foreach (@$vehicle->images ?? [] as $vehicleImage)
                            <div class="slick-item">
                                <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/' . $vehicleImage, getFileSize('vehicle')) }}" alt="@lang('image')">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('Brand')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-31">
                                            <span class="path1"></span><span class="path2"></span>
                                        </i>
                                    </p>
                                    <span class="details-info-item__desc">{{ __(@$vehicle->brand->name) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('Model Year')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-60"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ $vehicle->year }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('CC (Cubic Centimeters)')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-fi_10156100"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ getAmount($vehicle->cc) }} {{__('CC')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('Seater')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Vector-5"></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ __($vehicle->seat) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('Total Run')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-svgexport-6"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span><span
                                                class="path6"></span><span class="path7"></span><span
                                                class="path8"></span><span class="path9"></span><span
                                                class="path10"></span><span class="path11"></span>
                                        </i>
                                    </p>
                                    <span class="details-info-item__desc">{{ getAmount($vehicle->total_run) }} {{__('KM')}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="details-info-item">
                                <span class="details-info-item__title">{{__('Fuel Type')}}</span>
                                <div class="details-info-item__content">
                                    <p class="details-info-item__icon">
                                        <i class="icon-Group-62"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span><span
                                                class="path4"></span><span class="path5"></span></i>
                                    </p>
                                    <span class="details-info-item__desc">{{ __(@$vehicle->fuel_type) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="details-info">
                                <div class="details-info__left">
                                    <span class="icon">
                                        <i class="icon-fi_1437"></i>
                                    </span>
                                    <div class="text">{{__('Rental Price')}}</div>
                                </div>
                                {{--<small>Day => ({{$vehicle->day_hours}} H)</small>--}}
                                <div class="details-info__right">
                                    <div class="details-info-content">
                                        <div class="details-info-content__top">
                                            <span class="text">{{__('PRICE FOR A')}}</span>
                                            <span class="time">{{__('1 Day')}}</span>
                                        </div>
                                        <h5 class="details-info-content__price">{{ showAmount($vehicle->price) }}/ {{$vehicle->day_hours}} H</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            @auth

                                @if (@$vehicle->user_id != auth()->id())
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#rentReserveModal" class="btn btn--gradient btn--lg w-100 ">@lang('Reserve Now')</button>
                                @endif
                            @else
                                <button type="button" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn--gradient btn--lg w-100 ">@lang('Login Now')</button>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="details-tab pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <ul class="nav custom--tab">
                        <li class="tab__bar"></li>
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#rental" type="button">@lang('Rental Details')</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#description" type="button">{{__('Description')}}</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" type="button">{{__('Reviews')}}</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="rental" tabindex="0">
                            <div class="tab-rental-desc">
                                <div class="how-rental__wrapper">
                                    <div class="row g-3 g-xl-5">
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Brand')}}</p>
                                                <p class="how-rental-item__desc">{{ __(ucfirst(@$vehicle->brand->name)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Type')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->vehicleType->name) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Class')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->vehicleClass->name ?? 'N/A') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Pick-up Point & Zone')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->user->location->name) }} <br> {{ __(@$vehicle->user->zone->name) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Drop Point')}}</p>
                                                <p class="how-rental-item__desc">{{ implode(',', @$vehicle->locationName) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Color')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->color) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Mileage')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->mileage) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Model Year')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->year) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Identification Number')}}</p>
                                                <p class="how-rental-item__desc">{{ @$vehicle->identification_number }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Transmission Type')}}</p>
                                                <p class="how-rental-item__desc">{{ __(@$vehicle->transmission_type) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Condition')}}</p>
                                                <p class="how-rental-item__desc">{{ __(ucfirst($vehicle->vehicle_condition)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xsm-6 col-sm-4">
                                            <div class="how-rental-item">
                                                <p class="how-rental-item__title">{{__('Security Deposit')}}</p>
                                                <p class="how-rental-item__desc">{{__($vehicle->security_deposit=='0.00'?"Bill of Exchange":($vehicle->security_deposit.gs('cur_sym'))) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="description" tabindex="0">
                            <div class="tab-rental-desc">
                                <div class="how-rental__wrapper">
                                    @if (@$vehicle->description)
                                        <p>
                                            @php
                                                echo @$vehicle->description;
                                            @endphp
                                        </p>
                                    @else
                                        <p>@lang('No Description Yet!')</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="reviews" tabindex="0">
                            <div class="review-wrapper">
                                @if (!blank(@$vehicle->reviewData))
                                    @foreach ($vehicle->reviewData as $review)
                                        <div class="review-item">
                                            <ul class="rating-list">
                                                @php
                                                    echo showRatings($review->star);
                                                @endphp
                                            </ul>
                                            <q class="review-item__desc">{{ @$review->review }}</q>

                                            <div class="review-item-auth">
                                                <div class="review-item-auth__thumb">
                                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . @$review->user->image, getFileSize('userProfile'), true) }}" alt="avatar">
                                                </div>
                                                <div class="review-item-auth__info">
                                                    <p class="review-item-auth__name">{{ __(@$review->user->fullname) }}</p>
                                                    <p class="review-item-auth__designation">{{ @$review->user->username }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="review-item">
                                        <ul class="rating-list">
                                            <li>@lang('No Review Yet!')</li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-5">
                <h3 class="">@lang('Extra Services')</h3>

                    @foreach ($vehicle->extraServices as $service)
        @php
            if($vehicle->extraServices->find($service->id)){
            $price=$vehicle->extraServices->find($service->id)?->pivot?->custom_price;
            }else{
            	$price=$service->default_price;
            }

@endphp

            <div class="col-md-6 mb-2">
                <div class="form-check d-flex align-items-center gap-2">
                    <label class="form-check-label me-2" for="service{{ $service->id }}">
                        {{ __($service->name) }}
                    </label>
                    <small class="ms-1 text--muted">{{ showAmount($price) }} </small>
                </div>
            </div>
        @endforeach

            </div>
            </div>
        </div>
    </section>


    <div class="modal custom--modal fade" id="rentReserveModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <h5>{{ __(@$vehicle->brand->name) }}</h5>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h6>{{ __(@$vehicle->name) }} - {{ $vehicle->model }}</h6>
                            <h6>@lang('Total') :
                                <span class="total-price">{{ showAmount($vehicle->price) }}</span>
                            </h6>
                        </div>
                    </div>

<form action="{{ route('user.rental.vehicle', $vehicle->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label class="form--label">@lang('Pick Up')</label>
        <select class="form--control select2-basic" name="pick_up_location_id" required>
            <option value="{{ @$vehicle->user->location_id }}">{{ __($vehicle->user->location->name) }}</option>
        </select>
        @error('pick_up_location_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label class="form--label">@lang('Date')</label>
        <input name="date" id="date" data-range="true" data-multiple-dates-separator=" - "
               type="text" data-language="en" class="datepicker-here form--control"
               data-position="bottom right" placeholder="@lang('Start Date - End Date')" required autocomplete="off"
               value="{{ old('date', session('booking_details.date')) }}" />
        @error('date')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label class="form--label">@lang('Pick Up Time')</label>
        <input name="pickup_time" type="time" class="form--control" placeholder="@lang('HH:MM')" required
               value="{{ old('pickup_time', session('booking_details.pickup_time')) }}" />
        @error('pickup_time')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label class="form--label">@lang('Drop Off Time')</label>
        <input name="dropoff_time" type="time" class="form--control" placeholder="@lang('HH:MM')" required
               value="{{ old('dropoff_time', session('booking_details.dropoff_time')) }}" />
        @error('dropoff_time')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label class="form--label">@lang('Drop Off')</label>
        <select readonly class="form--control select2-basic" name="drop_off_zone_id" required>
                <option  value="{{ $vehicle->user->zone->id }}"
                       selected>
                    {{ __($vehicle->user->zone->name) }}
                </option>
        </select>
        @error('drop_off_zone_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label class="form--label">@lang('Store Location')</label>
        <select readonly class="form--control select3-basic" name="drop_off_location_id" required>
                    <option value="{{ $vehicle->user->location->id }}" selected
                            >
                        {{ $vehicle->user->location->name }}
                    </option>
        </select>
        @error('drop_off_location_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
        <div class="form-group">
    <label class="form--label">@lang('Extra Services')</label>
    <div class="row">
        @foreach ($vehicle->extraServices as $service)
        @php
            if($vehicle->extraServices->find($service->id)){
            $price=$vehicle->extraServices->find($service->id)?->pivot?->custom_price;
            }else{
            	$price=$service->default_price;
            }

@endphp

            <div class="col-md-6 mb-2">
                <div class="form-check d-flex align-items-center gap-2">
                    <input
                        class="form-check-input extra-service-checkbox"
                        type="checkbox"
                        name="extra_services[{{ $service->id }}][price]"
                        value="{{ $price }}"
                        id="service{{ $service->id }}"
                        data-price="{{ $price }}"
                    >
                    <label class="form-check-label me-2" for="service{{ $service->id }}">
                        {{ __($service->name) }}
                    </label>
                    <small class="ms-1 text--muted">{{ showAmount($price) }} </small>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <div class="form-group">
        <label class="form--label">@lang('Note')</label>
        <textarea name="note" class="form--control" rows="2">{{ old('note') }}</textarea>
        @error('note')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


    @auth
        <button class="btn btn--lg btn--gradient w-100 mt-3" type="submit">@lang('Confirm Reservation')</button>
    @else
        <button class="btn btn--lg btn--gradient w-100 mt-3" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">@lang('Login Now')</button>
    @endauth
</form>
            </div>
    </div>
        </div>
        </div>

<!-- Login Modal (unchanged) -->
<div class="modal custom--modal fade" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>@lang('Login to Your Account')</h5>
                <form action="{{ route('user.login') }}" method="POST" class="verify-gcaptcha">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ route('vehicle.detail', $vehicle->id) }}">
                    <div class="form-group">
                        <label for="email" class="form--label">@lang('Username or Email')</label>
                        <input type="text" id="email" name="username" value="{{ old('username') }}" class="form--control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form--label">@lang('Password')</label>
                        <div class="position-relative">
                            <input id="password" type="password" class="form--control" name="password" required>
                            <span class="password-show-hide fas fa-eye toggle-password fa-eye-slash" id="#password"></span>
                        </div>
                    </div>
                    <x-captcha />
                    <div class="form-group">
                        <button type="submit" id="recaptcha" class="btn btn--gradient w-100">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/global/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/datepicker.en.js') }}"></script>
@endpush

@push('style')
    <style>
        .datepickers-container {
            z-index: 99999 !important;
        }
    </style>
@endpush



@push('script')

    <script>
        (function($) {
            "use strict";
            $(".product-slider").on("init", function (event, slick) {
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

            $(".product-slider").slick({
                dots: true,
                autoplay: true,
                focusOnSelect: true,
                infinite: true,
                arrows: true,
                // fade: true,
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

            $(".select2-basic").select2({
                width: "100%",
                dropdownParent: $('#rentReserveModal')
            });

            $(".select3-basic").select2({
                width: "100%",

                dropdownParent: $('#rentReserveModal')
            });
            $(".select2-basic").prop("readonly", true);
            $(".select3-basic").prop("readonly", true);
            $(".select1-basic").prop("readonly", true);

            $(".select2-basic").on("select2:opening select2:unselecting", function(e) {
                e.preventDefault();
            });
            $(".select3-basic").on("select3:opening select3:unselecting", function(e) {
                e.preventDefault();
            });
            $(".select1-basic").on("select1:opening select1:unselecting", function(e) {
                e.preventDefault();
            });

            {{-- function populateLocations() {
                const zoneId = $('[name=drop_off_zone_id]').val();
                const $locationSelect = $('[name=drop_off_location_id]');

                // Clear current options
                $locationSelect.empty().append('<option value="" selected disabled>@lang('Select One')</option>');

                if (!zoneId) return;

                // Get locations from selected option's data attribute
                const selectedZone = $('[name=drop_off_zone_id] option:selected');
                const locations = selectedZone.data('locations');

                if (locations && locations.length) {
                    $.each(locations, function(index, location) {
                        $locationSelect.append(
                            $('<option></option>').val(location.id).text(location.name)
                        );
                    });
                }

                // Trigger change to update select2 UI
                $locationSelect.trigger('change');
            }--}}

            // Initialize locations if zone is already selected
//             if ($('[name=drop_off_zone_id]').val()) {
//                 populateLocations();
//             }

            // Handle zone change event
//             $('[name=drop_off_zone_id]').on('change', function() {
//                 populateLocations();
//             });


//             $('[name=drop_off_zone_id]').on('change', function(e) {
//                 populateLocations();
//             });

//             if ("{{ session('booking_details.drop_off_zone_id') }}") {
//                 populateLocations();
//             }

            // Datepicker Initialization
            // Function to get URL parameter


            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

//             function convertDateRange(input) {
//                 const [start, end] = input.split(' - ');

//                 function formatAndSubtract(dateStr, daysToSubtract) {
//                     const [month, day, year] = dateStr.split('-');
//                     const date = new Date(`${year}-${month}-${day}`);
//                     date.setDate(date.getDate() - daysToSubtract);

//                     return date.toISOString().split('T')[0];
//                 }

//                 const newStart = formatAndSubtract(start, 2);
//                 const newEnd = formatAndSubtract(end, 2);

//                 return `${newStart} - ${newEnd}`;
//             }


            // Get values from URL
            var urlDate = getUrlParameter('date');
            console.log(urlDate)
            var urlPickupTime = getUrlParameter('pickup_time');
            var urlDropoffTime = getUrlParameter('dropoff_time');

            let rentPrice = Number("{{ getAmount($vehicle->price) }}");
            let dayHours = Number("{{ $vehicle->day_hours }}");
            let hourlyRate = rentPrice / dayHours;

            $('.datepicker-here').datepicker({
                language: 'en',
                dateFormat: 'yyyy-mm-dd',
                range: true,
                multipleDatesSeparator: ' - ',
                changeYear: true,
                changeMonth: true,
                minDate: new Date(),
                position: 'bottom right',
                onSelect: function(formattedDate, date, inst) {
                    calculateTotalPrice();
                }
            });
            // Set date from URL if available
//             if (urlDate) {
//                 console.log($('#date'))
//                     let dateValue=urlDate.replaceAll('/','-');

//             const converted = convertDateRange(dateValue);
//                 setTimeout(()=>{

//                 	$('.datepicker-here').val(converted);
//                     console.log(converted)

//                 	calculateTotalPrice();
//                     },200)
//                 }
            // after $('.datepicker-here').datepicker({...});
            // Normalize date format from URL if needed
            function normalizeDateFormat(dateStr) {
                // Detect MM/DD/YYYY and convert to YYYY-MM-DD
                if (dateStr.includes('/')) {
                    return dateStr.replace(/(\d{2})\/(\d{2})\/(\d{4})/g, '$3-$1-$2');
                }
                return dateStr;
            }

            if (urlDate) {
                const normalizedRange = urlDate
                    .split(' - ')
                    .map(normalizeDateFormat)
                    .join(' - ');
                setDateFromUrl(normalizedRange);
            }

//             if (urlDate) setDateFromUrl(urlDate);

            function setDateFromUrl(rangeStr){
              const parts = rangeStr.split(' - ').map(s => s.trim());
              const s = parts[0];
              const e = parts[1] || parts[0];

              const [y1,m1,d1] = s.split('-').map(Number);
              const [y2,m2,d2] = e.split('-').map(Number);

              const start = new Date(y1, m1-1, d1);
              const end   = new Date(y2, m2-1, d2);

              const $el = $('.datepicker-here');
              const dp  = $el.data('datepicker');

              if (dp) {
                dp.selectDate([start, end]);     // set widget state
                $el.val(rangeStr);               // keep text in sync
                calculateTotalPrice();
              } else {
                // datepicker not attached yet; try after a tick
                setTimeout(() => setDateFromUrl(rangeStr), 50);
              }
            }


            // Set time values from URL if available
            if (urlPickupTime) {
                $('[name=pickup_time]').val(urlPickupTime);
                calculateTotalPrice();
            }

            if (urlDropoffTime) {
                $('[name=dropoff_time]').val(urlDropoffTime);
                calculateTotalPrice();
            }

            function parseLocalYMDHM(dateStr, timeStr) {
                if (!dateStr) return null;
                const [y,m,d] = dateStr.split('-').map(Number);
                const [H=0,Min=0] = (timeStr||'00:00').split(':').map(Number);
                const dt = new Date(y, (m||1)-1, d||1, H, Min, 0, 0);
                return isNaN(dt.getTime()) ? null : dt;
            }


            // Calculate total price on time input changes
//             function calculateTotalPrice() {
//                 let dates = $('.datepicker-here').val().split(' - ');
//                 let pickupTime = $('[name=pickup_time]').val();
//                 let dropoffTime = $('[name=dropoff_time]').val();
//                 let totalPrice = rentPrice;
//                 console.log(dates)
//                 if (dates.length > 1 && pickupTime && dropoffTime) {
//                     let startDateTime = new Date(`${dates[0]}T${pickupTime}`);
//                     let endDateTime = new Date(`${dates[1]}T${dropoffTime}`);
//                     let timeDiff = Math.abs(endDateTime.getTime() - startDateTime.getTime());
//                     let totalHours = timeDiff / (1000 * 3600);

//                     // Calculate full days and remaining hours
//                     let fullDays = Math.floor(totalHours / dayHours);
//                     let remainingHours = totalHours % dayHours;

//                     // Apply pricing logic
//                     if (totalHours <= dayHours) {
//                         totalPrice = rentPrice; // Minimum one-day charge
//                     } else {
//                         totalPrice = fullDays * rentPrice;
//                         if (remainingHours > 0) {
//                             totalPrice += Math.ceil(remainingHours) * hourlyRate;
//                         }
//                     }
//                 }
//                 // Sum up selected extra services
//                 let extraServicesTotal = 0;
//                 $('.extra-service-checkbox:checked').each(function(){
//                     extraServicesTotal += parseFloat($(this).data('price'));
//                 });

//                 // Add extra services to total price
//                 totalPrice += extraServicesTotal;

//                 $('.total-price').text(`{{ gs('cur_sym') }}` + totalPrice.toFixed(2));
//             }
            function calculateTotalPrice() {
                const raw = $('.datepicker-here').val().trim();
                const parts = raw ? raw.split(' - ') : [];
                const pickupTime  = $('[name=pickup_time]').val();
                const dropoffTime = $('[name=dropoff_time]').val();

                let totalPrice = rentPrice;

                if (parts.length >= 2 && pickupTime && dropoffTime) {
                    const start = parseLocalYMDHM(parts[0], pickupTime);
                    const end   = parseLocalYMDHM(parts[1], dropoffTime);
                    if (start && end && end > start) {
                        const minutes = Math.abs(end - start) / 60000;
                        const totalHours = minutes / 60;

                        const fullDays = Math.floor(totalHours / dayHours);
                        const remainingHours = totalHours % dayHours;

                        if (totalHours <= dayHours) {
                            totalPrice = rentPrice;
                        } else {
                            totalPrice = fullDays * rentPrice;
                            if (remainingHours > 0) totalPrice += Math.ceil(remainingHours) * hourlyRate;
                        }
                    }
                }

                // extras
                let extraServicesTotal = 0;
                $('.extra-service-checkbox:checked').each(function(){
                    extraServicesTotal += parseFloat($(this).data('price')) || 0;
                });
                totalPrice += extraServicesTotal;

                $('.total-price').text(`{{ gs('cur_sym') }}` + totalPrice.toFixed(2));
            }

            // Bind extra services checkboxes to price calculation
            $('.extra-service-checkbox').on('change', calculateTotalPrice);

            // Bind time inputs to price calculation
            $('[name=pickup_time], [name=dropoff_time]').on('change', calculateTotalPrice);
            calculateTotalPrice();
            console.log("calculation") // Initial calculation


            // Set the date value from session if available
            {{--            var sessionDateValue = "{{ old('date', session('booking_details.date')) }}";
            if (sessionDateValue) {
                let sessionDates = sessionDateValue.split(' - ');
                let startDate = new Date(sessionDates[0]);
                let endDate = sessionDates[1] ? new Date(sessionDates[1]) : startDate;
                datepickerElement.selectDate([startDate, endDate]);
            }--}}
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

