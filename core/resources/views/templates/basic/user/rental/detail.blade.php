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
    <div class="dashboard-table">
        <div class="custom--card card">
            <div class="card-body">
                <div class="row gy-4 mb-none-30 justify-content-center flex-lg-row-reverse">
                    <div class="col-lg-12 col-xl-6">
                        @if (auth()->user()->role=='vendor' && $rent->status == Status::RENT_PENDING)
                            <div class="product-action mb-4">
                                <h5 class="product-action-title">@lang('Take Action')</h5>
                                <div class="product-action-btn">
                                    <button class="btn btn-sm btn btn-primary confirmationBtn" data-action="{{ route('user.rental.approve.status', $rent->id) }}" data-question="@lang('Are you sure to approve this rental request?')" type="button"><i class="las la-lg la-check-circle"></i>@lang('Approve')</button>
{{--                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('user.rental.cancel.status', $rent->id) }}" data-question="@lang('Are you sure to cancel this rental request?')" type="button"><i class="las la-lg la-times-circle"></i>@lang('Cancel')</button>--}}
<button class="btn btn-sm btn-outline--danger cancel-with-reason"
    data-action="{{ route('user.rental.cancel.status', $rent->id) }}"
    data-question="@lang('Are you sure to cancel this rental request?')"
    type="button">
    @csrf
    <i class="las la-lg la-times-circle"></i>@lang('Cancel')
</button>

                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->role=='vendor' && $rent->status == Status::RENT_APPROVED)
                            <div class="product-action mb-4">
                                <h5 class="product-action-title">@lang('Take Action')</h5>
                                <div class="product-action-btn">
                                    <button class="btn btn-sm btn-outline--info VerifyConfirmationBtn" 
        data-action="{{ route('user.rental.ongoing.status', $rent->id) }}" 
        data-question="@lang('Are you sure this rental will be ongoing?')"
        data-verify-url="{{ route('user.rental.ongoing.sendVerify', $rent->id) }}"
        data-verification="true"
        type="button">
                                        @csrf
    <i class="las la-lg la-check-circle"></i> @lang('On going')
</button>

                                    <button class="btn btn-sm btn-outline--danger cancel-with-reason"
data-action="{{ route('user.rental.cancel.status', $rent->id) }}"
                                    
                                     data-question="@lang('Are you sure to cancel this rental request?')" type="button"><i class="las la-lg la-times-circle"></i>@lang('Cancel')</button>
                                </div>
                            </div>
                        @endif

                        @if (auth()->user()->role=='vendor' && $rent->status == Status::RENT_ON_GOING)
                            <div class="product-action mb-4">
                                <h5 class="product-action-title">@lang('Take Action')</h5>
                                <div class="product-action-btn">
                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('user.rental.complete.status', $rent->id) }}" data-question="@lang('Are you sure this rental will be completed?')" type="button"><i class="las la-lg la-check-circle"></i>@lang('Complete')</button>
                                </div>
                            </div>
                        @endif

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
                                            {{ showAmount($rent->price) }}
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

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Rental Number')
                                <span class="fw-bold">{{ @$rent->rent_no }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Requested for rent ')
                                <span class="fw-bold">{{ __(@$rent->user->fullname) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Email')
                                <span class="fw-bold">{{ @$rent->user->email }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Mobile')
                                <span class="fw-bold">{{ @$rent->user->mobile }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Zone')
                                <span class="fw-bold">{{ __(@$rent->pickupZone->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pick Up Location')
                                <span class="fw-bold">{{ __(@$rent->pickupPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Pickup Store')
                                <span class="fw-bold">{{ __(@$rent->vehicle->user->store_data->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Off Location')
                                <span class="fw-bold">{{ __(@$rent->dropPoint->name) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                @lang('Drop Store')
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
                                @lang('Paid Amount')
                                <span class="fw-bold">{{ number_format($deposit->final_amount??0,2)}} @lang('JD')</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
document.querySelectorAll('.VerifyConfirmationBtn').forEach(button => {
    button.addEventListener('click', async function() {
        const actionUrl = this.getAttribute('data-action');
        const verifyUrl = this.getAttribute('data-verify-url');
        const question = this.getAttribute('data-question');
        const token = document.querySelector(".VerifyConfirmationBtn > input[type=hidden]").value;

        const { value: formValues } = await Swal.fire({
            title: '@lang("Verification Required")',
            html: `
                <p>@lang("Please enter the verification code sent to the customer")</p>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <input type="text" id="verificationCode" class="swal2-input" 
                               placeholder="@lang('6-digit code')" maxlength="6"
                               style="flex: 1 1 auto; min-width: 100px;">
                        <button id="sendCodeBtn" class="btn btn-primary"
                                style="flex: 0 0 auto; white-space: nowrap;">
                            @lang("Send Code")
                        </button>
                    </div>
                    <p class="text-muted small mb-0">@lang("Check the customer's email for the code")</p>
                    <div id="codeStatus" class="small mt-2"></div>
                </div>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: '@lang("Verify & Approve")',
            cancelButtonText: '@lang("Cancel")',
            allowOutsideClick: false,
            focusConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const code = document.getElementById('verificationCode').value;
                if (!code || code.length !== 6) {
                    Swal.showValidationMessage('@lang("Please enter a valid 6-digit code")');
                    return false;
                }
                return code;
            },
            didOpen: () => {
                const sendCodeBtn = document.getElementById('sendCodeBtn');
                const codeStatus = document.getElementById('codeStatus');
                
                sendCodeBtn.addEventListener('click', async () => {
                    sendCodeBtn.disabled = true;
                    codeStatus.textContent = '@lang("Sending code...")';
                    codeStatus.style.color = 'var(--bs-primary)';

                    try {
                        const response = await fetch(verifyUrl, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            codeStatus.textContent = '@lang("Verification code sent successfully!")';
                            codeStatus.style.color = 'var(--bs-success)';
                        } else {
                            throw new Error(result.message || 'Failed to send code');
                        }
                    } catch (error) {
                        codeStatus.textContent = error.message;
                        codeStatus.style.color = 'var(--bs-danger)';
                    } finally {
                        sendCodeBtn.disabled = false;
                        setTimeout(() => {
                            codeStatus.textContent = '@lang("Didn\'t receive code? You can request another.")';
                            codeStatus.style.color = 'var(--bs-secondary)';
                        }, 30000);
                    }
                });
            }
        });

        if (formValues) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = actionUrl;

            const inputs = {
                '_token': token,
                '_method': 'POST',
                'verification_code': formValues
            };

            for (const [name, value] of Object.entries(inputs)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name;
                input.value = value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }
    });
});
</script>
    <x-confirmation-modal :isFrontendSubmit="true" />
@endsection

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
            font-weight: 500;
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
            font-weight: 500;
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
