@extends($activeTemplate . 'layouts.master')
@section('content')
@if($rent->status!=Status::RENT_CANCELLED && $rent->status!=Status::RENT_INITIATE)
<a href="{{ route('user.reservation.invoice', $rent->id) }}" class="btn btn--info btn-sm" target="_blank">
    <i class="fas fa-file-invoice"></i> @lang('View Invoice')
</a>

<a href="{{ route('user.reservation.invoice.download', $rent->id) }}" class="btn btn--dark btn-sm">
    <i class="fas fa-download"></i> @lang('Download Invoice')
</a>
@endif
<!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="dashboard-table">
        <div class="custom--card card">
            <div class="card-body">
                <div class="row gy-4 mb-none-30 justify-content-center flex-lg-row-reverse">
                    <div class="col-lg-12 col-xl-6">
                        <div class="product-info">
                            <div class="row gy-4 align-items-center">
                                <div class="col-md-6">
                                    <div class="product-info-top">
                                        <div class="product-info-brand-title">{{ __(ucfirst(@$rent->vehicle->name)) }}</div>
                                        <p class="product-info-brand-model">{{ __(@$rent->vehicle->model) }}</p>
                                    </div>
                                    <div class="product-info-thumb">
                                        <img src="{{ getImage(getFilePath('vehicle') . '/thumb_' . @$rent->vehicle->image, getFileSize('vehicle')) }}" alt="@lang('image')">
                                    </div>
                                    <div class="product-info-bottom">
                                        <p class="product-info-bottom-title">@lang('Rental Price')</p>
                                        <h6 class="product-info-bottom-price">
                                            {{ showAmount($rent->price) }} <small class="currrency">{{ __(gs('cur_text')) }}</small>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product-info-card-wrapper">
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-gavel"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->cc) }} @lang('CC')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-level-up-alt"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->bhp) }} @lang('BHP')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-tint"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->speed) }} @lang('Speed')</div>
                                        </div>
                                        <div class="product-info-card">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-gas-pump"></i>
                                            </div>
                                            <div class="product-info-card-text">{{ getAmount($rent->vehicle->cylinder) }} @lang('Cylinder')</div>
                                        </div>
                                        <div class="product-info-card style-two">
                                            <div class="product-info-card-icon">
                                                <i class="fas fa-car-side"></i>
                                            </div>
                                            <div class="product-info-card-text"> <strong>@lang('Total Run') : </strong> <span>{{ getAmount($rent->vehicle->total_run) }} @lang('km')</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       <div class="col-lg-12 col-xl-12">
                            <h4>@lang('Extra Services')</h4>
                                <uL class="list-group list-group-flush">
                    @foreach($rent->extraServices as $extraService)
                    	<li class="list-group-item d-flex justify-content-between align-items-center px-0">{{$extraService->extraService->name}} - {{$extraService->price}}</li>
                    @endforeach
</uL>
                        </div>
                        
                    </div>
                    <div class="col-lg-12 col-xl-6">
                                    @php
                                        echo @$rent->statusBadge;
                                    @endphp
                                                @if($rent->status==Status::RENT_CANCELLED)
                            	<p>Cancelation Reason: {{$rent->cancellation_reason}}</p>
                            @endif
                    <hr>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Vehicle Owner')
                                <span class="fw-bold">{{ __(@$rent->vehicle->user->fullname) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Email')
                                <span class="fw-bold">{{ @$rent->vehicle->user->email }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Mobile')
                                <span class="fw-bold">{{ @$rent->vehicle->user->mobile }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Zone')
                                <span class="fw-bold">{{ __(@$rent->pickupZone->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Location')
                                <span class="fw-bold">{{ __(@$rent->pickupPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Store')
                                <span class="fw-bold">{{ __(@$rent->vehicle->user->store_data->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Zone')
                                <span class="fw-bold">{{ __(@$rent->dropZone->name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Location')
                                <span class="fw-bold">{{ __(@$rent->dropPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Store')
                                <span class="fw-bold">{{ __(@$rent->dropPoint->user->store_data->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Start Date')
                                <span class="fw-bold">{{ @$rent->start_date }}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('PickUp Time')
                                <span class="fw-bold">{{ @$rent->pickup_time??"00:00" }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('End Date')
                                <span class="fw-bold">{{ @$rent->end_date }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('DropOff Time')
                                <span class="fw-bold">{{ @$rent->dropoff_time??"00:00"}}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Total')
                                <span class="fw-bold">{{ Carbon\Carbon::parse($rent->start_date)->diffInDays($rent->end_date) + 1 }} @lang('Days')</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Paid Amount')
                                <span class="fw-bold">{{ number_format($deposit->final_amount??0,2)}} @lang('JD')</span>
                            </li>
                        </ul>
                    </div>
<div class="button--group">
    @if($rent->update_date_status!=1 && ($rent->status==Status::RENT_ON_GOING || $rent->status==Status::RENT_APPROVED || $rent->status==Status::RENT_PENDING))
        @csrf
            <button type="button" class="btn btn--warning btn--sm" 
                    onclick="showEditModal({{ $rent->id }},'{{$rent->end_date}}','{{$rent->dropoff_time}}')">
                <i class="las la-lg la-times-circle"></i> @lang('Edit Booking')
            </button>
        @endif
        @if ($canCancel)
        @csrf
<button class="btn btn-sm btn-outline--danger cancel-with-reason"
    data-action="{{ route('user.rental.cancel.status', $rent->id) }}"
    data-question="@lang('Are you sure to cancel this rental request?')"
    type="button">
    @csrf
    <i class="las la-lg la-times-circle"></i>@lang('Cancel')
</button>
        @endif
</div>            </div>
        </div>
    </div>

    <x-confirmation-modal closeBtn="btn btn--danger btn--sm" submitBtn="btn btn--base btn--sm" />
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.cancel-with-reason').forEach(button => {
        button.addEventListener('click', function () {
            const actionUrl = this.dataset.action;
            const question = this.dataset.question || "Are you sure?";

            Swal.fire({
                title: question,
                html: `
                    <label for="cancel_reason_select" class="swal2-label" style="display:block; margin-bottom:0.25em;">@lang('Reason for Cancellation') <span style="color:red">*</span></label>
                    <select name="reason" id="cancel_reason_select" class="swal2-select" required>
                        <option value="" selected disabled>@lang('Select a reason')</option>
                        <option value="Vehicle Issue">@lang('Vehicle issue or malfunction')</option>
                        <option value="Late Pickup">@lang('Renter was late for pickup')</option>
                        <option value="Wrong Info">@lang('Incorrect reservation details')</option>
                        <option value="Personal Emergency">@lang('Personal emergency')</option>
                        <option value="Duplicate Booking">@lang('Duplicate booking')</option>
                        <option value="Payment Issue">@lang('Payment issue')</option>
                        <option value="Better Offer">@lang('Found a better offer')</option>
                        <option value="Vendor Cancelled">@lang('Vendor is unavailable')</option>
                        <option value="Other">@lang('Other')</option>
                    </select>

                    <label for="cancel_reason_textarea" class="swal2-label" style="display:block; margin-bottom:0.25em;">@lang('Additional Details (optional)')</label>
                    <textarea id="cancel_reason_textarea" class="swal2-textarea" placeholder="@lang('Enter additional details here...')" ></textarea>
                `,
                showCancelButton: true,
                confirmButtonText: '@lang("Submit")',
                cancelButtonText: '@lang("Cancel")',
                preConfirm: () => {
                    const select = document.getElementById('cancel_reason_select');
                    if (!select.value) {
                        Swal.showValidationMessage('@lang("You must select a reason!")');
                        return false;
                    }
                    return {
                        reason: select.value,
                        details: document.getElementById('cancel_reason_textarea').value.trim()
                    };
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const { reason, details } = result.value;

                    // Create and submit a hidden form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = actionUrl;

                    const token = document.querySelector("input[name='_token']").value; // safer selector
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = token;
                    form.appendChild(csrf);

                    const reasonInput = document.createElement('input');
                    reasonInput.type = 'hidden';
                    reasonInput.name = 'reason';
                    reasonInput.value = reason +", Addintion Info: "+ details;
                    form.appendChild(reasonInput);

                    const detailsInput = document.createElement('input');
                    detailsInput.type = 'hidden';
                    detailsInput.name = 'cancellation_details';
                    detailsInput.value = details;
                    form.appendChild(detailsInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
</script>

<script>

function showEditModal(rentId, end_date, end_time) {
    const currentEndDateTime = new Date(`${end_date}T${end_time}`);
    const minDateTime = new Date(currentEndDateTime);
    minDateTime.setHours(minDateTime.getHours() + 1); // يمكنك تغييره حسب المدة الدنيا المطلوبة

    const currentDateFormatted = end_date;
    const minDateFormatted = minDateTime.toISOString().split('T')[0];

    Swal.fire({
        title: '@lang('Change End Date')',
        html: `
            <div class="text-start">
                <p>@lang('Current end:') <strong>${formatDateTime(currentEndDateTime)}</strong></p>
                <input 
                    type="date" 
                    id="newEndDate" 
                    class="swal2-input" 
                    min="${minDateFormatted}"
                    value="${currentDateFormatted}"
                    required
                >
                <input 
                    type="time"
                    id="newEndTime"
                    class="swal2-input"
                    value="${end_time}"
                    required
                    onchange="validateDateSelection('${end_date}', '${end_time}')"
                >
                <p id="dateError" class="text-danger small mt-2 d-none"></p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '@lang('Update Date')',
        cancelButtonText: '@lang('Cancel')',
        reverseButtons: true,
        focusConfirm: false,
        didOpen: () => {
            document.getElementById('newEndDate').addEventListener('change', () => {
                validateDateSelection(end_date, end_time);
            });
            document.getElementById('newEndTime').addEventListener('change', () => {
                validateDateSelection(end_date, end_time);
            });
            Swal.getConfirmButton().disabled = true;
        },
        preConfirm: () => {
            const date = document.getElementById('newEndDate').value;
            const time = document.getElementById('newEndTime').value;
            return `${date} ${time}`;
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            updateEndDate(rentId, result.value); // Send full datetime string
        }
    });
}

// ✅ التحقق بالتاريخ والوقت معًا
function validateDateSelection(currentDateStr, currentTimeStr) {
    const dateInput = document.getElementById('newEndDate');
    const timeInput = document.getElementById('newEndTime');
    const errorElement = document.getElementById('dateError');
    const confirmButton = Swal.getConfirmButton();

    const selectedDate = dateInput.value;
    const selectedTime = timeInput.value;

    if (!selectedDate || !selectedTime) {
        errorElement.textContent = 'يرجى تحديد التاريخ والوقت معًا.';
        errorElement.classList.remove('d-none');
        confirmButton.disabled = true;
        return;
    }

    const selectedDateTime = new Date(`${selectedDate}T${selectedTime}`);
    const currentDateTime = new Date(`${currentDateStr}T${currentTimeStr}`);

    if (selectedDateTime <= currentDateTime) {
        errorElement.textContent = 'يجب أن يكون التاريخ والوقت الجديد بعد الحالي مباشرة.';
        errorElement.classList.remove('d-none');
        confirmButton.disabled = true;
    } else {
        errorElement.classList.add('d-none');
        confirmButton.disabled = false;
    }
}

// ✅ تنسيق التاريخ والوقت
function formatDateTime(date) {
    return date.toLocaleString(undefined, {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function updateEndDate(rentId, newEndDate) {
    // Show loading state
    Swal.fire({
        title: '@lang('Updating...')',
        html: '@lang('Please wait while we update the end date')',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // CSRF token setup
const token = document.querySelector("div.button--group > input[type=hidden]").value;

function formatDate(date) {
    const d = new Date(date);
    const month = (d.getMonth() + 1).toString().padStart(2, '0');
    const day = d.getDate().toString().padStart(2, '0');
    const year = d.getFullYear();
    return `${month}/${day}/${year}`;
}

// Format both dates
const oldEndDateFormatted = formatDate('{{$rent->end_date}}'); // from Blade
const newEndDateFormatted = formatDate(newEndDate); // from JS variable

const combinedDate = `${oldEndDateFormatted} - ${newEndDateFormatted}`;

// Create and submit the form
const form = document.createElement('form');
form.method = 'POST';
form.action = `/user/rental/vehicle/{{$rent->vehicle->id}}`;

const inputs = {
    new_end_date: newEndDate,
    drop_off_zone_id: '{{$rent->drop_off_zone_id}}',
    date: combinedDate,
    extend: true,
    pickup_time:"{{$rent->pickup_time}}",
    dropoff_time:"{{$rent->dropoff_time}}",
    end_date:"{{$rent->end_date}}",
    note:"extend request of rent: {{$rent->id}}", 
    pick_up_location_id: '{{$rent->pick_up_location_id}}',
    _token: token,
    _method: 'post'
};

for (const name in inputs) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = inputs[name];
    form.appendChild(input);
}

// Append and submit the form
document.body.appendChild(form);
form.submit();
}

</script>
@push('style')
    <style>
        .product-info-top {
            margin-bottom: 12px;
        }

        .product-info-brand-title {
            font-weight: 600;
            color: hsl(var(--black));
            line-height: 1;
        }

        .product-info-brand-model {
            font-size: 12px;
            font-weight: 300;
        }

        .product-info-thumb {
            width: 100%;
        }

        .product-info-thumb img {
            border-radius: 16px;
        }

        .product-info-bottom {
            margin-top: 12px;
        }

        .product-info-bottom-title {
            font-size: 12px;
            font-weight: 300;
        }

        .product-info-bottom-price {
            color: hsl(var(--black));
            font-weight: 600;
        }

        .product-info-bottom-price .currrency {
            font-size: 12px;
            font-weight: 400;
        }

        .product-info-card-wrapper {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 6px;
            flex-wrap: wrap;
        }

        .product-info-card {
            padding: 16px 12px;
            border-radius: 16px;
            width: calc(100% / 2 - 3px);
            background-color: rgb(247 246 249);
            text-align: center;
        }

        .product-info-card.style-two {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-info-card-icon {
            height: 36px;
            width: 36px;
            display: grid;
            place-content: center;
            margin: 0 auto 12px;
            background-color: #e5e3e7;
            border-radius: 50%;
            font-size: 14px;
        }

        .product-info-card.style-two .product-info-card-icon {
            margin: 0;
            margin-right: 12px;
        }

        .product-info-card-text {
            font-size: 13px;
            font-weight: 500;
            line-height: 1;
        }

        @media (max-width: 1299px) {
            .product-info-card.style-two .product-info-card-text {
                font-size: 12px;
            }
        }

        .product-action {}

        .product-action-title {
            text-align: right;
            margin-bottom: 12px;
        }

        .product-action-btn {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: flex-end;
        }

        .form-control:focus {
            box-shadow: none;
        }
    </style>
@endpush
