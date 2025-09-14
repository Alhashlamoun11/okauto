@extends($activeTemplate . 'layouts.frontend')
@section('content')

    <!-- Compact Search Hero Section -->
<div class="search-hero">
<div  style="color:white;" class="page-header pt-60 pb-60 text-center">
    <div class="container">
        <!--<h2 style="color:white;" class="page-title">{{ __(strstr(ucfirst($pageHead), '-', true)) }}</h2> -->
        @if(!empty($pageHead))
            <h2 style="color:white;" class="page-title">{{ $pageHead }}</h2>
        @else
            <h2 style="color:white;" class="page-title">{{ $pageTitle }}</h2>
        @endif

        <p class="page-description">
            {{ __($pageDesc??"Explore the full specifications and rental information for this vehicle. Find the details you need before reserving.") }}
        </p>
    </div>
</div>

    <div class="search-container">
        <form class="search-form" action="{{ route('vehicles') }}" method="GET">
            <div class="form-grid">
                <!-- Pick Up -->
                <div class="form-group">
                    <label class="form-label">@lang('Pick Up')</label>
                    <select class="form-select" name="pick_up_zone_id" >
                        <option value="" selected disabled>@lang('Select One')</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" @selected($zone->id == request()->pick_up_zone_id)>{{ __($zone->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Vehicle Type -->
                <div class="form-group">
                    <label class="form-label">@lang('Vehicle Type')</label>
                    <select class="form-select" name="vehicle_type_id">
                        <option value="" selected disabled>@lang('Select One')</option>
                        @foreach ($vehicleTypes as $vehicleType)
                            <option value="{{ $vehicleType->id }}" data-slug="{{ Str::slug($vehicleType->name) }}" @selected($vehicleType->id == request()->vehicle_type_id)>{{ __($vehicleType->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand -->
              {{--  <div class="form-group">
                    <label class="form-label">@lang('Brand')</label>
                    <select class="form-select" name="brand_id">
                        <option value="" selected disabled>@lang('Select One')</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @selected($brand->id == request()->brand_id)>{{ __($brand->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Model -->
                <div class="form-group">
                    <label class="form-label">@lang('Model')</label>
                    <select class="form-select" name="model">
                        <option value="" selected disabled>@lang('Select One')</option>
                        @foreach ($models as $model)
                            <option value="{{ $model}}" @selected($model == request()->model)>{{ __($model) }}</option>
                        @endforeach
                    </select>
                </div>
                --}}

                <!-- Date -->
                <div class="form-group">
                    <label class="form-label">@lang('Date')</label>
                    <input name="date" id=date data-range="true" data-multiple-dates-separator=" - "
                           type="text" data-language="en" class="date-filter form--control form-datepicker"
                           data-position="bottom right" placeholder="@lang('Start Date - End Date')"
                            autocomplete="off" />
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Pick Up Time')</label>
                    <input style="background: white!important" name="pickup_time" id="pickup_time"
                           type="time" class=" form--control" />
                </div>
                <div class="form-group">
                    <label class="form-label">@lang('Drop Off Time')</label>
                    <input style="background: white!important" name="dropoff_time" id="dropoff_time"
                           type="time" class="form--control"/>
                </div>


                <!-- Search Button -->
                <div style="align-items:center;margin-top:16px" class="form-submit">

<!--                     <button type="button" class=" search-button"> -->
<!--                         <span class="search-icon"></span> -->
<!--                         @lang('Search') -->
<!--                     </button> -->
<button type="button" class="search-button">Search</button>

                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Main Content Area -->
    <section class="product-section pt-60 pb-120">
        <div class="container">
            <div class="row">
                <!-- Filter Sidebar Column (Left) -->
                <div class="col-lg-3 order-1 order-lg-0">
                    <div class="filter-sidebar">
                        <div class="filter-header d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">@lang('Filter Vehicles')</h5>
                            <button class="btn btn-sm btn--base d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                                <i class="las la-filter"></i> @lang('Filters')
                            </button>
                        </div>

<div class="collapse d-lg-block" id="filterCollapse">
    <form action="" method="GET" id="filterForm">
        @if ($slug)
            <div class="form-group mb-3">
                <label class="form--label">@lang('Transmission Type')</label>
                <select class="form--control" name="transmission_type">
                    <option value="">@lang('All')</option>
                    <option value="automatic" @selected(request()->transmission_type == 'automatic')>@lang('Automatic')</option>
                    <option value="manual" @selected(request()->transmission_type == 'manual')>@lang('Manual')</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label class="form--label">@lang('Fuel Type')</label>
                <select class="form--control" name="fuel_type">
                    <option value="">@lang('All')</option>
                    <option value="gasoline" @selected(request()->fuel_type == 'gasoline')>@lang('Gasoline')</option>
                    <option value="diesel" @selected(request()->fuel_type == 'diesel')>@lang('Diesel')</option>
                    <option value="electric" @selected(request()->fuel_type == 'electric')>@lang('Electric')</option>
                    <option value="petrol" @selected(request()->fuel_type == 'petrol')>@lang('Petrol')</option>
                </select>
            </div>

           {{-- <div class="form-group mb-3">
                <label class="form--label">@lang('Price Range')</label>
                <select class="form--control" name="price">
                    <option value="">@lang('All')</option>
                    <option value="price_asc" @selected(request()->price == 'price_asc')>@lang('Low to High')</option>
                    <option value="price_desc" @selected(request()->price == 'price_desc')>@lang('High to Low')</option>
                </select>
            </div>--}}
        @endif

        <div class="form-group mb-3">
            <label class="form--label">@lang('Seating Capacity')</label>
            <select class="form--control" name="seats">
                <option value="">@lang('All')</option>
                <option value="2" @selected(request()->seats == '2')>2 @lang('Seats')</option>
                <option value="4" @selected(request()->seats == '4')>4 @lang('Seats')</option>
                <option value="5" @selected(request()->seats == '5')>5 @lang('Seats')</option>
                <option value="7" @selected(request()->seats == '7')>7+ @lang('Seats')</option>
            </select>
        </div>

        <button type="button" class="btn btn--base w-100 mt-3" id="applyFilters">@lang('Apply Filters')</button>
        <a href="#" class="btn btn--secondary w-100 mt-2" id="resetFilters">@lang('Reset Filters')</a>
    </form>
</div>                    </div>
                </div>

                <!-- Main Content Column -->
                <div class="col-lg-9 order-0 order-lg-1">
                    <div id="vehicle-results" class="row g-3 g-md-4">
                        @include($activeTemplate . 'partials.filtered_vehicle')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
    <!-- Include Flatpickr CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush

@push('script-lib')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    <script src="{{ asset('assets/global/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/datepicker.en.js') }}"></script>
@endpush

@push('style')

    <style>
        /* Search Hero Section */
        .search-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin-bottom: 30px;
            padding: 20px 0;
        }

        .search-form__wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            align-items: flex-end;
        }

        .search-form-item {
            margin-bottom: 0;
        }

        .search-form__button {
            grid-column: 1 / -1;
        }

        @media (min-width: 768px) {
            .search-form__wrapper {
                grid-template-columns: repeat(3, 1fr);
            }
            .search-form__button {
                grid-column: auto;
            }
        }

        @media (min-width: 992px) {
            .search-form__wrapper {
                grid-template-columns: repeat(6, 1fr);
            }
        }

        /* Filter Sidebar */
        .filter-sidebar {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
            margin-bottom: 30px;
        }

        /* Form Controls */
        .form--control:focus {
            box-shadow: none;
            border-color: #667eea;
        }

        .select2-container--default .select2-selection--single {
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 45px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }

        /* Buttons */
        .btn--gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            transition: all 0.3s ease;
            padding: 10px 20px;
            height: 45px;
        }

        .btn--gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn--base {
            background-color: #667eea;
            color: white;
        }

        .btn--secondary {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
        }

        /* Datepicker */
        .datepicker {
            z-index: 9999 !important;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .filter-sidebar {
                position: static;
                margin-top: 20px;
            }

            .col-lg-3 {
                order: 2;
            }

            .col-lg-9 {
                order: 1;
            }
        }

        /* Mobile View */
        @media (max-width: 767.98px) {
            .search-form__wrapper {
                grid-template-columns: 1fr;
            }

            .search-form-item {
                margin-bottom: 15px;
            }

            .search-form__button {
                margin-top: 10px;
            }
        }
    </style>
    <style>
    /* Base Styles */
    :root {
        --border-color: #ddd;
        --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        --border-radius: 8px;
        --transition: all 0.3s ease;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .search-hero {
        padding: 1rem 1rem;
        width: 100%;
    }

    .search-container {
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
    }

    /* Form Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    /* Form Elements */
    .form-group {
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: white;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .form-select,
    .form-datepicker {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius);
        background-color: white;
        font-size: 0.95rem;
        color: var(--text-color);
        appearance: none;
        transition: var(--transition);
    }

    .form-select:focus,
    .form-datepicker:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
    }

    .select-arrow {
        position: absolute;
        right: 1rem;
        top: 2.2rem;
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #666;
        pointer-events: none;
    }

    /* Button Styles */
    .form-submit {
        display: flex;
        align-items: flex-end;
    }

    .search-button {
        background-color: #2921fd;
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .search-button:hover {
        background-color: -webkit-gradient(linear, right top, left top, from(hsl(var(--secondary))), to(hsl(var(--base))));
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .search-icon {
        display: inline-block;
        width: 16px;
        height: 16px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: center;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-submit {
            margin-top: 0.5rem;
        }

        .search-button {
            padding: 1rem;
        }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-submit {
            grid-column: span 2;
        }
    }

    /* Datepicker adjustments */
    .form-datepicker {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23666'%3E%3Cpath d='M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM9 10H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 18px;
        padding-right: 2.5rem;
    }
</style>

@endpush

@push('script')
<script>
// $(document).ready(function() {
//     // Initialize components
//     initializeDatePickers();
//     initializeTimePickers();

//     // Set up event handlers
//     $('.search-form').on('change', 'select, input, .date-filter', function(e) {
//         e.preventDefault();
//         calculateAllVehiclePrices();
//         performSearch();
//     });

//     // Initialize filters and prices if dates exist
//     if ($('#date').val()) {
//         calculateAllVehiclePrices();
//     }

//     // Apply filters button
//     $('#applyFilters').on('click', applyFilters);

//     // Reset filters button
//     $('#resetFilters').on('click', resetFilters);
// });
$(document).ready(function() {
    // --- First block content ---
    initializeDatePickers();
    initializeTimePickers();

    $('.search-form').on('change', 'select, input, .date-filter', function(e) {
        e.preventDefault();
        calculateAllVehiclePrices();
        performSearch();
    });

    if ($('#date').val()) {
        calculateAllVehiclePrices();
    }

//     $('#applyFilters').on('click', applyFilters);
    // cache items and auto-apply when any filter changes
    window.vehicleItems = document.querySelectorAll('.vehicle-item');
    $('#applyFilters').on('click', applyFilters);
    $('#filterForm').on('change', 'select, input', applyFilters);

    $('#resetFilters').on('click', resetFilters);

//     $('.search-button').on('click', function(e) {
//         e.preventDefault();
//         $('.search-form').trigger('submit');
//     });
    $('.search-button').on('click', function(e){
        e.preventDefault();
        applyFilters(e);      // filter instantly
        performSearch();      // then AJAX search
    });


    $('.search-form').on('submit', function(e) {
        e.preventDefault();
        calculateAllVehiclePrices();
        performSearch();
    });

    // --- Second block content ---
    $(document).on('click', '.rent-now-btn', function(e) {
        e.preventDefault();
        const baseUrl = $(this).attr('href');
        const searchParams = $('.search-form').serialize();
        const separator = baseUrl.includes('?') ? '&' : '?';
        const newUrl = baseUrl + separator + searchParams;
        window.location.href = newUrl;
    });
});


function initializeDatePickers() {
    $('#date').datepicker({
        range: true,
        multipleDatesSeparator: ' - ',
        minDate: new Date(),
        dateFormat: 'yyyy-mm-dd',
        onSelect: function() {
            calculateAllVehiclePrices();
        }
    });

    // Set initial date if in URL
    const urlDate = getQueryParam('date');
    if (urlDate) {
        $('#date').val(urlDate);
        console.log(urlDate)
    }
}

function initializeTimePickers() {
    const getNowTime = () => {
        const now = new Date();
        return now.getHours().toString().padStart(2, '0') + ':' +
               now.getMinutes().toString().padStart(2, '0');
    };
    const getFutureTime = (hoursToAdd) => {
        const future = new Date();
        future.setHours(future.getHours() + hoursToAdd);
        return future.getHours().toString().padStart(2, '0') + ':' +
               future.getMinutes().toString().padStart(2, '0');
    };

    const pickupTime = getQueryParam('pickup_time') || "00:00";
    const dropoffTime = getQueryParam('dropoff_time') || "00:00";

    flatpickr("#pickup_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 5,
        defaultDate: pickupTime,
        onChange: calculateAllVehiclePrices
    });

    flatpickr("#dropoff_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 5,
        defaultDate: dropoffTime,
        onChange: calculateAllVehiclePrices
    });
}

function calculateAllVehiclePrices() {
    const dateRange = $('#date').val();
    if (!dateRange) {
        $('.calculated-price').hide();
        return;
    }

    const dates = dateRange.split(' - ');
    const pickupTime = $('[name=pickup_time]').val();
    const dropoffTime = $('[name=dropoff_time]').val();

    if (dates.length === 2 && pickupTime && dropoffTime) {
        try {
            const startDateStr = dates[0] + ' ' + pickupTime;
            const endDateStr = dates[1] + ' ' + dropoffTime;

            const startDateTime = new Date(startDateStr);
            const endDateTime = new Date(endDateStr);

            if (isNaN(startDateTime.getTime()) || isNaN(endDateTime.getTime())) {
                throw new Error('Invalid date format');
            }

            const timeDiff = Math.abs(endDateTime.getTime() - startDateTime.getTime());
            const totalHours = timeDiff / (1000 * 3600);

            $('.vehicle-item').each(function() {
                const dayHours = parseFloat($(this).data('day_hours')) || 24;
                const rentPrice = parseFloat($(this).data('price')) || 0;
                const hourlyRate = parseFloat($(this).data('hourly-rate')) || (rentPrice / dayHours);

                let totalPrice = rentPrice; // Default to daily price

                if (totalHours > dayHours) {
                    const fullDays = Math.floor(totalHours / dayHours);
                    const remainingHours = totalHours % dayHours;

                    totalPrice = fullDays * rentPrice;
                    if (remainingHours > 0) {
                        totalPrice += Math.ceil(remainingHours) * hourlyRate;
                    }
                }

                // Update the display
                const priceElement = $(this).find('.calculated-price');
                if (priceElement.length) {
                    priceElement.show();
                    priceElement.find('.total-price-value').text('{{ gs("cur_sym") }}' + totalPrice.toFixed(2));
                }
            });
        } catch (e) {
            console.error('Error calculating prices:', e);
            $('.calculated-price').hide();
        }
    } else {
        $('.calculated-price').hide();
    }
}

function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

function performSearch() {
    const form = $('.search-form');
    const data = form.serialize();

    $.ajax({
        url: form.attr('action'),
        type: 'GET',
        data: data,
        beforeSend: function() {
            $('#vehicle-results').html('<p>Loading...</p>');
        },
        success: function(response) {
            const $html = $(response);
            const newContent = $html.find('#vehicle-results').html();
            $('#vehicle-results').html(newContent);

            reinitializeFilters();
            calculateAllVehiclePrices();
        },
        error: function(xhr) {
            console.error(xhr);
            $('#vehicle-results').html('<p style="color:red">An error occurred while searching.</p>');
        }
    });
}

function reinitializeFilters() {
    window.vehicleItems = document.querySelectorAll('.vehicle-item');
    updateEmptyState();
}

function updateEmptyState() {
    const visibleItems = document.querySelectorAll('.vehicle-item[style="display: block;"], .vehicle-item:not([style])');
    const emptyContainer = document.querySelector('.emtpty-image-container');
    emptyContainer.style.display = visibleItems.length === 0 ? 'block' : 'none';
}

// function applyFilters(e) {
//     e.preventDefault();
//     const filterForm = document.getElementById('filterForm');
//     const transmission = filterForm.transmission_type.value.toLowerCase();
//     const fuel = filterForm.fuel_type.value.toLowerCase();
//     const seats = filterForm.seats.value;

//     const itemsArray = Array.from(vehicleItems);

//     itemsArray.forEach(item => {
//         const itemTransmission = item.getAttribute('data-transmission')?.toLowerCase() || '';
//         const itemFuel = item.getAttribute('data-fuel')?.toLowerCase() || '';
//         const itemSeats = item.getAttribute('data-seats') || '';

//         let show = true;

//         if (transmission && transmission !== '' && itemTransmission !== transmission) {
//             show = false;
//         }
//         if (fuel && fuel !== '' && itemFuel !== fuel) {
//             show = false;
//         }
//         if (seats && seats !== '' && itemSeats !== seats) {
//             show = false;
//         }

//         item.style.display = show ? 'block' : 'none';
//     });

//     updateEmptyState();
// }

// $('.search-button').on('click',()=>{
// 	performSearch();
// })
function applyFilters(e) {
    if (e) e.preventDefault();

    const filterForm = document.getElementById('filterForm');
    const transmission = (filterForm.transmission_type?.value || '').toLowerCase();
    const fuel = (filterForm.fuel_type?.value || '').toLowerCase();
    const seats = filterForm.seats?.value || '';

    const itemsArray = Array.from(window.vehicleItems || document.querySelectorAll('.vehicle-item'));

    itemsArray.forEach(item => {
        const itemTransmission = (item.getAttribute('data-transmission') || '').toLowerCase();
        const itemFuel = (item.getAttribute('data-fuel') || '').toLowerCase();
        const itemSeats = item.getAttribute('data-seats') || '';

        let show = true;

        if (transmission && itemTransmission !== transmission) show = false;
        if (fuel && itemFuel !== fuel) show = false;
        if (seats && itemSeats !== seats) show = false;

        item.style.display = show ? 'block' : 'none';
    });

    updateEmptyState();
}


function resetFilters(e) {
    e.preventDefault();
    document.getElementById('filterForm').reset();
    vehicleItems.forEach(item => {
        item.style.display = 'block';
    });
    updateEmptyState();
}    </script>
<script>
$(document).ready(function() {
    // Handle Rent Now button clicks
    $(document).on('click', '.rent-now-btn', function(e) {
        e.preventDefault();

        // Get the base URL
        const baseUrl = $(this).attr('href');

        // Serialize the search form data
        const searchParams = $('.search-form').serialize();

        // Build the new URL with search parameters
        const separator = baseUrl.includes('?') ? '&' : '?';
        const newUrl = baseUrl + separator + searchParams;

        // Redirect to the new URL
        window.location.href = newUrl;
    });
});</script>
<script>
$(document).ready(function() {
    let vehicleTypeId = "{{ request()->vehicle_type_id ?? '' }}";

    if (!vehicleTypeId) {
        const pathParts = window.location.pathname.split('/');
        const lastPart = pathParts.pop() || pathParts.pop();
        const slug = lastPart.split('-')[0];

        const option = $(`select[name="vehicle_type_id"] option[data-slug="${slug}"]`);
        if (option.length) {
            vehicleTypeId = option.val();
        }
    }

    if (vehicleTypeId) {
        $('select[name="vehicle_type_id"]').val(vehicleTypeId).trigger('change');
    }
});
</script>



@endpush
