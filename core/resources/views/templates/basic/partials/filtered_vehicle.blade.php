    @forelse ($vehicles as $vehicle)
    <div class="col-lg-4 col-sm-6 col-xsm-6 vehicle-item" 
         data-transmission="{{ $vehicle->transmission_type }}" 
         data-fuel="{{ $vehicle->fuel_type }}" 
         data-day_hours="{{ $vehicle->day_hours }}"  
         data-price="{{ $vehicle->price }}" 
         data-hourly-rate="{{ $vehicle->hourly_rate ?? $vehicle->price / $vehicle->day_hours }}"
         data-seats="{{ $vehicle->seat }}">
            <div class="product-card">
                <div class="product-card__thumb">
                    <img class="fit-image" src="{{ getImage(getFilePath('vehicle') . '/thumb_' . @$vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                </div>
                <div class="product-card__body">
                    <h5 class="product-card__title">
                        <a class=" rent-now-btn" 
           href="{{ route('vehicle.detail', $vehicle->id) }}" 
           data-vehicle-id="{{ $vehicle->id }}">{{ __($vehicle->name) }} - {{ __($vehicle->model) }}</a>
                        <span style="font-size: 12px">(Or Similar Vehicle)</span>
                    </h5>
                    <ul class="product-card-list">
                        <li class="product-card-list__item">
                            <span class="product-card-list__icon">
                                <i class="icon-Group-60"></i>
                            </span>
                            <span class="product-card-list__text">{{ $vehicle->year }}</span>
                        </li>
                        <li class="product-card-list__item">
                            <span class="product-card-list__icon">
                                <i class="icon-fi_10156100"></i>
                            </span>
                            <span class="product-card-list__text">{{ getAmount($vehicle->cc) }}</span>
                        </li>
                        <li class="product-card-list__item">
                            <span class="product-card-list__icon">
                                <i class="icon-Vector-5"></i>
                            </span>
                            <span class="product-card-list__text">{{ $vehicle->seat }}</span>
                        </li>
                        <li class="product-card-list__item">
                            <span class="product-card-list__icon">
                                <i class="icon-fi_483497"></i>
                            </span>
                            <span class="product-card-list__text">{{ __($vehicle->fuel_type) }}</span>
                        </li>
                        <li class="product-card-list__item">
                            <span class="product-card-list__icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <span class="product-card-list__text">{{ __($vehicle->user->zone->name) }}</span>
                        </li>
                        
                        <li>
                <b><small class="calculated-price" style="display: none;">
                    Total: <span class="total-price-value"></span>
                </small></b>

                        </li>
                    </ul>
                    <div class="product-info">

                        <div class="product-info__wrapper">
                            <div class="product-info__icon">
                                <span class="icon-fi_1437"></span>
                            </div>
                            <div class="product-info__content">
                                <span class="product-info__title">@lang('Rental Price')</span>
            <p class="product-info__price">
                <span class="base-price">{{ showAmount($vehicle->price) }}</span> / {{$vehicle->day_hours}} @lang('H')
                <br>
            </p>
                            </div>
                        </div>
        <a class="btn btn--gradient product-info__btn rent-now-btn" 
           href="{{ route('vehicle.detail', $vehicle->id) }}" 
           data-vehicle-id="{{ $vehicle->id }}">
            @lang('Rent Now')
        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
            <div  class="text-center">
            <div class="emtpty-image">
                <img src="{{ getImage($activeTemplateTrue . 'images/empty.png') }}" alt="@lang('image')">
            </div>
        </div>

    @endforelse
            <div style="display:none;" class="text-center emtpty-image-container">
            <div class="emtpty-image">
                <img src="{{ getImage($activeTemplateTrue . 'images/empty.png') }}" alt="@lang('image')">
            </div>
        </div>
    
{{ paginateLinks($vehicles) }}


<style>
.row {
    display: flex;
    flex-wrap: wrap;
}
.vehicle-item {
    transition: all 0.3s ease;
}
</style>