@extends($activeTemplate . 'layouts.master')
@section('content')
    @php
        $storeContent = getContent('vehicle_store.content', true);
    @endphp
    <div class="card custom--card">
        <div class="card-body">
            @if ($user->store == Status::STORE_APPROVED)
                <div class="d-flex justify-content-center align-items-center mb-4 store-alert-message gap-2">
                    <i class="las la-exclamation-circle text--success"></i>
                    <p class="text--success">{{ __(@$storeContent->data_values->store_approved_content) }}</p>
                </div>
            @endif
            @if ($user->store == Status::STORE_PENDING)
                <div class="d-flex justify-content-center align-items-center mb-4 store-alert-message gap-2">
                    <i class="las la-exclamation-circle text--warning"></i>
                    <p class="text--warning">{{ __(@$storeContent->data_values->store_pending_content) }}</p>
                </div>
            @endif
            @if ($user->store_data)
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="fw-bold">@lang('Zone')</span>
                        <span>{{ __(@$user->zone->name) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="fw-bold">@lang('Location')</span>
                        <span>{{ __(@$user->location->name) }}</span>
                    </li>
                    @foreach ($user->store_data as $key => $val)
                        @if ($key == 'store_form_data')
                            @foreach ($val ?? [] as $data)
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="fw-bold">{{ __($data->name) }}</span>
                                    <span>
                                        @if ($data->type == 'checkbox')
                                            {{ implode(',', $val->value) }}
                                        @elseif($data->type == 'file')
                                            <a href="{{ route('user.download.attachment', encrypt(getFilePath('verify') . '/' . $data->value)) }}" class="text--base"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                        @else
                                            {{ __($data->value) }}
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="fw-bold">{{ __(ucwords(str_replace('_', ' ', $key))) }}</span>
                                <span>
                                    @if ($key == 'store_image')
                                        <a href="{{ route('user.download.attachment', encrypt(getFilePath('vehicleStore') . '/' . $val)) }}" class="text--base"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                    @else
                                        {{ __($val) }}
                                    @endif
                                </span>
                            </li>
                        @endif
                    @endforeach

                </ul>
<form method="post" action="{{route('user.vehicle.store.update_settings')}}" class="cancellation-form">
  @csrf
  

  <div class="form-group">
    <label class="form-label">@lang('Time Allowed For Cancellation')</label>
    <div class="input-group">
      <input type="number" name="cancelation_hours" placeholder="{{auth()->user()->cancelation_hours??0}}" min="0" class="form-input">
      <span class="input-suffix">hours</span>
    </div>
  </div>
  <div class="form-group">
    <label class="form-label">@lang('Age Allowed For Rent')</label>
    <div class="input-group">
      <input type="number" name="allowed_age" placeholder="{{auth()->user()->allowed_age??18}}" min="18" class="form-input">
      <span class="input-suffix">hours</span>
    </div>
  </div>
  <button type="submit" class="submit-btn">@lang('Submit')</button>
</form>

<style>
  .cancellation-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
    font-size: 14px;
  }
  
  .input-group {
    display: flex;
    align-items: center;
  }
  
  .form-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 4px 0 0 4px;
    font-size: 14px;
    transition: border-color 0.3s;
  }
  
  .form-input:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
  }
  
  .input-suffix {
    padding: 10px 12px;
    background: #f5f5f5;
    border: 1px solid #ddd;
    border-left: none;
    border-radius: 0 4px 4px 0;
    font-size: 14px;
    color: #666;
  }
  
  .submit-btn {
    width: 100%;
    padding: 12px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .submit-btn:hover {
    background-color: #3a7bc8;
  }
</style>            @else
                <h5 class="text-center">@lang('Vehicle store data not found')</h5>
            @endif
        </div>
    </div>
@endsection
