@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="card custom--card">
        <div class="card-body">
            <form action="{{ route('user.vehicle.update', @$vehicle->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gy-1 mb-3">
                    <div class="col-xl-4 col-lg-5 col-md-4">
                        <label class="form--label">@lang('Image')</label>
                        <div class="profile-thumb p-0 text-center shadow-none">
                            <div class="thumb">
                                <img id="upload-img" src="{{ getImage(getFilePath('vehicle') . '/' . @$vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                <label class="badge badge--icon badge--fill-base update-thumb-icon" for="update-photo"><i class="las la-pen"></i></label>
                            </div>
                            <div class="profile__info">
                                <input class="form-control d-none" id="update-photo" name="image" type="file" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
                        <small class="text--danger">@lang('Supported files:') @lang('.jpeg'), @lang('.jpg')
                            , @lang('.png') @lang('Image will be resized into') {{ getFileSize('vehicle') }} @lang('px')</small>
                    </div>

                    <div class="col-xl-8 col-lg-7 col-md-8">
                        <div class="form-group">
                            <label class="form--label">@lang('Drop Point')</label>
                            <select class="form--control select2-basic" name="drop_point[]" multiple required>
                                @foreach ($zones as $zone)
                                    <option
                                            value="{{ $zone->id }}" @selected(in_array($zone->id, old('drop_point', @$vehicle->locationId) ?? []))>{{ __($zone->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Vehicle Type')</label>
                            <select class="form--control vehicle-type" name="vehicle_type_id" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($vehicleTypes as $vehicleType)
                                    <option data-vehicle_classes="{{ $vehicleType->vehicleClass }}" data-manage_class="{{ $vehicleType->manage_class }}" value="{{ $vehicleType->id }}" @selected(old('vehicle_type_id', @$vehicle->vehicle_type_id) == @$vehicleType->id)>{{ __($vehicleType->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form--label">@lang('Vehicle Class')</label>
                            <select class="form--control select2-basic" name="vehicle_class_id"></select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form--label">@lang('Name')</label>
                        <input class="form--control" name="name" type="text" value="{{ old('name', @$vehicle->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Day Hours')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="day_hours" type="number" value="{{ old('day_hours', @$vehicle->day_hours) }}" required>
                                <span class="input-group-text bg--base border-0 text-white">@lang('H')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Brand')</label>
                            <select class="form--control select2-basic" name="brand_id" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                @foreach ($brands as $brand)
                                    <option
                                            value="{{ $brand->id }}" @selected(old('brand_id', @$vehicle->brand_id) == @$brand->id)>{{ __($brand->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Model')</label>
                            <input class="form--control" name="model" type="text" value="{{ old('model', @$vehicle->model) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('CC (Cubic Centimeters)')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="cc" type="number" value="{{ old('cc', @$vehicle->cc) }}" required>
                                <span class="input-group-text bg--base border-0 text-white">@lang('CC')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('BHP (Brake Horsepower)')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="bhp" type="number" value="{{ old('bhp', @$vehicle->bhp) }}" step="any">
                                <span class="input-group-text bg--base border-0 text-white">@lang('BHP')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Speed')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="speed" type="number" value="{{ old('speed', @$vehicle->speed) }}" required>
                                <span class="input-group-text bg--base border-0 text-white">@lang('Km/h')</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Cylinder')</label>
                            <input class="form--control" name="cylinder" type="number" value="{{ old('cylinder', @$vehicle->cylinder) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Year')</label>
                            <input class="form--control" name="year" type="text" value="{{ old('year', @$vehicle->year) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Color')</label>
                            <input class="form--control" name="color" type="text" value="{{ old('color', @$vehicle->color) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Identification Number')</label>
                            <input class="form--control" name="identification_number" type="text" value="{{ old('identification_number', @$vehicle->identification_number) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Mileage')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="mileage" type="text" value="{{ old('mileage', @$vehicle->mileage) }}" required>
                                <span class="input-group-text bg--base border-0 text-white">@lang('Km/L')</span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Condition')</label>
                            <select class="form--control select2-basic" name="vehicle_condition" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                <option
                                        value="new" @selected(old('vehicle_condition', @$vehicle->vehicle_condition) == 'new')>@lang('New')</option>
                                <option
                                        value="used" @selected(old('vehicle_condition', @$vehicle->vehicle_condition) == 'used')>@lang('Used')</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Transmission Type')</label>
                            <select class="form--control select2-basic" name="transmission_type" required>
                                <option value="" selected disabled>@lang('Select One')</option>
                                <option
                                        value="automatic" @selected(old('transmission_type', @$vehicle->transmission_type) == 'automatic')>@lang('Automatic')</option>
                                <option
                                        value="manual" @selected(old('transmission_type', @$vehicle->transmission_type) == 'manual')>@lang('Manual')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Fuel Type')</label>
                            <select class="form--control select2-basic" name="fuel_type" required>
                                <option value="" disabled>@lang('Select One')</option>
                                <option
                                        value="petrol" @selected(old('fuel_type', @$vehicle->fuel_type) == 'petrol')>@lang('Petrol')</option>
                                <option
                                        value="gasoline" @selected(old('fuel_type', @$vehicle->fuel_type) == 'gasoline')>@lang('Gasoline')</option>
                                <option
                                        value="diesel" @selected(old('fuel_type', @$vehicle->fuel_type) == 'diesel')>@lang('Diesel')</option>
                                <option
                                        value="electric" @selected(old('fuel_type', @$vehicle->fuel_type) == 'electric')>@lang('Electric')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Number of Seats')</label>
                            <input class="form--control" name="seat" type="text" value="{{ old('seat', @$vehicle->seat) }}" required>
                        </div>
                    </div>
                  {{--  <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">@lang('Total Run')</label>
                            <div class="input-group">
                                <input class="form-control form--control" name="total_run" type="number" value="{{ old('total_run', @$vehicle->total_run ? getAmount(@$vehicle->total_run) : '') }}" step="any" required>
                                <span class="input-group-text bg--base border-0 text-white">@lang('KM')</span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form--label">
                                @lang('Rental Price Per Day')
                                <i class="las la-info-circle" data-bs-toggle="tooltip" title="A {{ showAmount(gs('rental_charge'), exceptZeros: true, currencyFormat: false) }}% rental fee will be deducted from the rental price."></i>
                            </label>
                            <div class="input-group">
                                <input class="form-control form--control" name="price" type="number" value="{{ old('price', @$vehicle->price ? getAmount(@$vehicle->price) : '') }}" step="any" required>
                                <span
                                      class="input-group-text bg--base border-0 text-white">{{ __(gs('cur_text')) }}</span>
                            </div>
                        </div>
                    </div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form--label">
            @lang('Security Deposit')
            <i class="las la-info-circle" data-bs-toggle="tooltip" title="An optional refundable amount set by the vendor to cover potential damages or violations. This amount is shown to the renter only if greater than 0"></i>
        </label>
        <select class="form-control form--control" name="security_deposit" required>
            <option value="350" {{ old('security_deposit', @$vehicle->security_deposit) == 350 ? 'selected' : '' }}>350 JD</option>
            <option value="0" {{ old('security_deposit', @$vehicle->security_deposit) == '0' ? 'selected' : '' }}>Bill of Exchange</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="form--label">@lang('Extra Services')</label>
    <div class="row">
        @foreach ($extraServices as $service)
            @php
            if($vehicle&& $vehicle->extraServices->find($service->id)){
            $price=$vehicle->extraServices->find($service->id)?->pivot?->custom_price;
            }else{
            	$price=$service->default_price;
            }
            @endphp
            <div class="col-md-6 mb-2">
                <div class="form-check d-flex align-items-center gap-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="extra_services[{{ $service->id }}][id]"
                        value="{{ $service->id }}"
                        id="service{{ $service->id }}"
                        @checked(array_key_exists($service->id, old('extra_services', ($vehicle && $vehicle->extraServices->pluck('pivot.custom_price', 'id')->toArray()) ?$vehicle->extraServices->pluck('pivot.custom_price', 'id')->toArray(): [])))
                    >
                    <label class="form-check-label me-2" for="service{{ $service->id }}">
                        {{ __($service->name) }}
                    </label>
                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        class="form-control w-50"
                        name="extra_services[{{ $service->id }}][price]"
                        value="{{ old('extra_services.'.$service->id.'.price', $price) }}"
                        placeholder="@lang('Price')"
                    >
                    @if($service->price > 0)
                        <small class="ms-1 text--muted">{{ showAmount($service->price) }} {{ __(gs('cur_text')) }}</small>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

                    <div class="form-group">
                        <label class="form--label">@lang('Description')</label>
                        <textarea class="form-control nicEdit" name="description">@php echo @$vehicle->description @endphp</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form--label">@lang('Images')</label>
                        <p class="text--danger mb-2"><i
                               class="las la-exclamation-circle"></i> @lang('Maximum ') {{ gs('max_image_upload') }} @lang('images can be uploaded')
                            | @lang('File size will be ') {{ getFileSize('vehicle') }} @lang('px')</p>
                        <div class="input-images"></div>
                    </div>
                </div>
                <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <style>
        form .btn {
            padding: 12.5px 20px;
        }
    </style>
@endpush
@push('style-lib')
    <link href="{{ asset($activeTemplateTrue . 'css/image-uploader.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/image-uploader.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/nicEdit.js') }}"></script>
@endpush

@push('style')
    <style>
        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            bkLib.onDomLoaded(function() {
                $(".nicEdit").each(function(index) {
                    $(this).attr("id", "nicEditor" + index);
                    new nicEditor({
                        fullPanel: true
                    }).panelInstance('nicEditor' + index, {
                        hasPanel: true
                    });
                });
            });

            $(".vehicle-type").select2({
                width: "100%",
                templateSelection: (state) => {
                    $('[name=vehicle_class_id]').html('');
                    if (state.element.dataset.vehicle_classes && state.element.dataset.manage_class == 1) {
                        let vehicleClasses = JSON.parse(state.element.dataset.vehicle_classes);
                        let html = `<option value="" selected disabled>@lang('Select One')</option>`
                        $.each(vehicleClasses, function(index, item) {
                            html += `<option value="${item.id}" ${item.vehicle_type_id == state.id ? 'selected' : ''}>${item.name}</option>`
                        });
                        $('[name=vehicle_class_id]').html(html);
                    }
                    return state.text
                }
            })

            $(".select2-basic").select2({
                width: "100%",
            })

            let preloaded = [];

            @if (!empty($images))
                preloaded = @json($images);
            @endif

            $('.input-images').imageUploader({
                extensions: ['.jpg', '.jpeg', '.png'],
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxFiles: "{{ gs('max_image_upload') }}"
            });
        })(jQuery)
    </script>
@endpush
