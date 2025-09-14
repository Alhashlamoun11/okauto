@extends($activeTemplate . 'layouts.master')
@section('content')
@php
$MyBlanace='{
  "id": 344,
  "name": "MyBalance",
  "currency": "JOD",
  "symbol": "JD",
  "method_code": 201,
  "gateway_alias": "MyBalance",
  "min_amount": "100.00000000",
  "max_amount": "1000.00000000",
  "percent_charge": "0.00",
  "fixed_charge": "0.00000000",
  "rate": "1.00000000",
  "created_at": "2025-06-23T12:12:58.000000Z",
  "updated_at": "2025-06-23T12:12:58.000000Z",
  "method": {
    "id": 61,
    "form_id": 24,
    "code": "200",
    "name": "MyBalance",
    "alias": "MyBalance",
    "image": "logo_white.png",
    "status": 1,
    "supported_currencies": {
      "SAR": "SAR",
      "USD": "USD",
      "EUR": "EUR",
      "AED": "AED",
      "GBP": "GBP",
      "JOD": "JOD",
      "QAR": "QAR",
      "KWD": "KWD",
      "BHD": "BHD"
    },
    "crypto": 0,
    "description": "",
    "created_at": "2025-06-19T08:19:42.000000Z",
    "updated_at": "2025-06-19T10:31:25.000000Z"
  }
}
'
@endphp
    <div class="card custom--card">
        <div class="card-body">
<!--<form class="deposit-form" action="@if(request()->has('rentId')){{ route('user.deposit.updateRent') }}@else{{ route('user.deposit.insert') }}@endif" method="post">-->
<form class="deposit-form" action="{{ route('user.deposit.insert') }}" method="post">

                @csrf
                <input name="currency" type="hidden">
                <div class="gateway-card">
                    <div class="row justify-content-center gy-sm-4 gy-3">
                        <div class="col-lg-6">
                            <div class="payment-system-list is-scrollable gateway-option-list">

                                    <label class="payment-item gateway-option" for="{{ 'My Balance' }}">
                                        <div class="payment-item__info">
                                            <span class="payment-item__check"></span>
                                            <span class="payment-item__name">{{ __("My Balance") }}</span>
                                        </div>
                                        <div class="payment-item__thumb">
                                            <img class="payment-item__thumb-img" src="https://okauto.app/assets/images/logo_icon/logo_white.png" alt="@lang('payment-thumb')">
                                        </div>
                                        <input class="payment-item__radio gateway-input" id="{{ 'My Balance' }}" data-gateway="@json($MyBlanace)" name="gateway"  data-min-amount="{{ showAmount(100) }}" data-max-amount="{{ showAmount(1000) }}" type="radio" value="{{ 201 }}" hidden @if (old('gateway')) @checked(old('gateway') == 201)  @endif>
                                    </label>

                                @foreach ($gatewayCurrency as $data)
                                    <label class="payment-item @if ($loop->index > 4) d-none @endif gateway-option" for="{{ titleToKey($data->name) }}">
                                        <div class="payment-item__info">
                                            <span class="payment-item__check"></span>
                                            <span class="payment-item__name">{{ __($data->name) }}</span>
                                        </div>
                                        <div class="payment-item__thumb">
                                            <img class="payment-item__thumb-img" src="{{ getImage(getFilePath('gateway') . '/' . $data->method->image) }}" alt="@lang('payment-thumb')">
                                        </div>
                                        <input class="payment-item__radio gateway-input" id="{{ titleToKey($data->name) }}" name="gateway" data-gateway='@json($data)' data-min-amount="{{ showAmount($data->min_amount) }}" data-max-amount="{{ showAmount($data->max_amount) }}" type="radio" value="{{ $data->method_code }}" hidden @if (old('gateway')) @checked(old('gateway') == $data->method_code) @else @checked($loop->first) @endif>
                                    </label>
                                @endforeach
                                @if ($gatewayCurrency->count() > 4)
                                    <button class="payment-item__btn more-gateway-option" type="button">
                                        <p class="payment-item__btn-text">@lang('Show All Payment Options')</p>
                                        <span class="payment-item__btn__icon"><i class="fas fa-chevron-down"></i></span>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="payment-system-list p-3">
                                <div class="deposit-info">
                                    <div class="deposit-info__title">
                                        <p class="text mb-0">@lang('Amount')</p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <div class="deposit-info__input-group input-group">
                                            <span class="deposit-info__input-group-text">{{ gs('cur_sym') }}</span>
                                            <input class="form-control form--control amount" name="amount" type="text" value="{{ getAmount(@$rent->price) }}" readonly placeholder="@lang('00.00')" autocomplete="off">
                                            <input class="form-control form--control final_amount" name="final_amount" type="hidden" value="{{ getAmount(@$rent->price) }}" readonly placeholder="@lang('00.00')" autocomplete="off">
                                            <input class="form-control form--control extra_services_amount" name="extra_services_amount" type="hidden" value="{{ getAmount(@$rent->extra_services_amount) }}" readonly placeholder="@lang('00.00')" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="deposit-info">
                                    <div class="deposit-info__title">
                                        <p class="text has-icon"> @lang('Limit')
                                            <span></span>
                                        </p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span class="gateway-limit">@lang('0.00')</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="deposit-info">
                                    <div class="deposit-info__title">
                                        <p class="text has-icon">@lang('Processing Charge')
                                            <span class="proccessing-fee-info" data-bs-toggle="tooltip" title="@lang('Processing charge for payment gateways')"><i
                                                   class="las la-info-circle"></i> </span>
                                        </p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span class="processing-fee">@lang('0.00')</span>
                                            {{ __(gs('cur_text')) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="deposit-info total-amount pt-3">
                                    <div class="deposit-info__title">
                                        <p class="text">@lang('Discount')</p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span id="discount-amount">@lang('0.00')</span>
                                            {{ __(gs('cur_text')) }}</p>
                                    </div>
                                </div>
                                @foreach($rent->extraServices as $extraService)
                                <div class="deposit-info total-amount pt-3">
                                    <div class="deposit-info__title">
                                        <p class="text">@lang($extraService->extraService->name)</p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span id="extra-service-amount">@lang($extraService->price)</span>
                                            {{ __(gs('cur_text')) }}</p>
                                    </div>
                                </div>

                                @endforeach
                                <div class="deposit-info total-amount pt-3">
                                    <div class="deposit-info__title">
                                        <p class="text">@lang('Tax')</p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span id="tax-amount">@lang('0.00')</span>
                                            {{ __(gs('cur_text')) }}</p>
                                    </div>
                                </div>

                                <div class="deposit-info total-amount pt-3">
                                    <div class="deposit-info__title">
                                        <p class="text">@lang('Total')</p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"><span class="final-amount">@lang('0.00')</span>
                                            {{ __(gs('cur_text')) }}</p>
                                    </div>
                                </div>

                                {{--<div class="deposit-info gateway-conversion d-none total-amount pt-2">
                                    <div class="deposit-info__title">
                                        <p class="text">@lang('Conversion')
                                        </p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text"></p>
                                    </div>
                                </div>--}}
                                <div class="deposit-info conversion-currency d-none total-amount pt-2">
                                    <div class="deposit-info__title">
                                        <p class="text">
                                            @lang('In') <span class="gateway-currency"></span>
                                        </p>
                                    </div>
                                    <div class="deposit-info__input">
                                        <p class="text">
                                            <span class="in-currency"></span>
                                        </p>

                                    </div>
                                    <div style="    box-shadow: 0px 0px 10px 3px #3e62fb;
    padding: 5px 15px;
    margin: 14px 0;" class="deposit-info gateway-conversion total-amount pt-2 from-group">
                                        <p class="text">
                                        <label class="form--label" for="coupon_code">@lang('Do You Have Coupon ?')</label>
                                        <div class="container flex" style="    align-items: center;
    flex-direction: column;
    justify-content: center;
    display: flex;">
                                        <input style="width:auto" class="form--control" id="coupon_code" type='text' placeholder="Coupon Code">
                                        <input value='0' type='hidden' name="coupon_discount" id='coupon_discount'>
                                    	     <br>
                                        <button  class="btn btn--lg btn--gradient" type="button" id="validat_coupon">@lang('Validate')</button>
                                            <span class="coupon_text"></span>

                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-none crypto-message mb-3">
                                    @lang('Conversion with') <span class="gateway-currency"></span> @lang('and final value will Show on next step')
                                </div>
                                <button class="btn btn--base w-100" type="submit" disabled>
                                    @lang('Confirm Payment')
                                </button>
                                <div class="info-text pt-3">
                                    <p class="text">@lang('Ensuring your funds grow safely through our secure deposit process with world-class payment options.')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
		const adminCommissionRate = {{ gs('rental_charge') }};
        "use strict";
        (function($) {

            var amount = parseFloat($('.amount').val() || 0);
            var extra_services_amount = parseFloat($('.extra_services_amount').val() || 0);
            var gateway, minAmount, maxAmount;
            var discountAmount=$('#coupon_discount')
            let verifiedCoupon = null;
            let couponApplied = false;


            $('.amount').on('input', function(e) {
                amount = parseFloat($(this).val());
                if (!amount) {
                    amount = 0;
                }
                calculation();
            });

            $('.gateway-input').on('change', function(e) {
                gatewayChange();
            });

            function gatewayChange() {
                let gatewayElement = $('.gateway-input:checked');
                let methodCode = gatewayElement.val();

                gateway = gatewayElement.data('gateway');
                minAmount = gatewayElement.data('min-amount');
                maxAmount = gatewayElement.data('max-amount');

                let processingFeeInfo =
                    `${parseFloat(gateway.percent_charge).toFixed(2)}% with ${parseFloat(gateway.fixed_charge).toFixed(2)} {{ __(gs('cur_text')) }} charge for payment gateway processing fees`
                $(".proccessing-fee-info").attr("data-bs-original-title", processingFeeInfo);
                calculation();
            }

            gatewayChange();

            $(".more-gateway-option").on("click", function(e) {
                let paymentList = $(".gateway-option-list");
                paymentList.find(".gateway-option").removeClass("d-none");
                $(this).addClass('d-none');
                paymentList.animate({
                    scrollTop: (paymentList.height() - 60)
                }, 'slow');
            });

            function calculation() {
                if (!gateway) return;
                $(".gateway-limit").text(minAmount + " - " + maxAmount);

                let percentCharge = 0;
                let fixedCharge = 0;
                let totalPercentCharge = 0;
                let discount=0;
                if (amount) {
                    percentCharge = parseFloat(gateway.percent_charge);
                    fixedCharge = parseFloat(gateway.fixed_charge);
                    totalPercentCharge = parseFloat(amount * (percentCharge / 100));
                    discount = discountAmount.val()||0
                }

                let totalCharge = parseFloat(totalPercentCharge + fixedCharge);
                let totalAmount = parseFloat((amount || 0) + totalPercentCharge + fixedCharge);
                let origin_total_amount=totalAmount

                totalAmount=parseFloat(totalAmount - parseFloat(totalAmount*parseFloat(discount/100)))

                let after_tax=parseFloat(totalAmount) * parseFloat({{gs('rental_tax')/100}})

                totalAmount=parseFloat(totalAmount)+parseFloat(after_tax.toFixed(2))

                console.log(totalAmount.toFixed(2))
                console.log(extra_services_amount.toFixed(2))
                console.log(parseFloat(totalAmount)+parseFloat(extra_services_amount))
				$(".final-amount").text((parseFloat(totalAmount) + parseFloat(extra_services_amount)).toFixed(2));
                $(".final_amount").val(parseFloat(totalAmount)+parseFloat(extra_services_amount));
                $("#tax-amount").text(after_tax.toFixed(2));
                $("#tax-amount").val(after_tax.toFixed(2));
                $(".processing-fee").text(totalCharge.toFixed(2));
                $("input[name=currency]").val(gateway.currency);
                $(".gateway-currency").text(gateway.currency);
                $('#discount-amount').text(parseFloat(origin_total_amount*parseFloat(discount/100)).toFixed(2))
                if (amount < Number(gateway.min_amount) || amount > Number(gateway.max_amount)) {
                    $(".deposit-form button[type=submit]").attr('disabled', true);
                } else {
                    $(".deposit-form button[type=submit]").removeAttr('disabled');
                }

                if (gateway.currency != "{{ gs('cur_text') }}" && gateway.method.crypto != 1) {
                    $('.deposit-form').addClass('adjust-height')

                    $(".gateway-conversion, .conversion-currency").removeClass('d-none');
                    $(".gateway-conversion").find('.deposit-info__input .text').html(
                        `1 {{ __(gs('cur_text')) }} = <span class="rate">${parseFloat(gateway.rate).toFixed(2)}</span>  <span class="method_currency">${gateway.currency}</span>`
                    );
                    totalAmount=(parseFloat(totalAmount)+parseFloat(extra_services_amount)).toFixed(2)
                    $('.in-currency').text(parseFloat(totalAmount * gateway.rate).toFixed(gateway.method.crypto == 1 ? 8 : 2))
                } else {
                    $(".gateway-conversion, .conversion-currency").addClass('d-none');
                    $('.deposit-form').removeClass('adjust-height')
                }

                if (gateway.method.crypto == 1) {
                    $('.crypto-message').removeClass('d-none');
                } else {
                    $('.crypto-message').addClass('d-none');
                }
            }


//             function calculation() {
//                 if (!gateway) return;

//                 $(".gateway-limit").text(minAmount + " - " + maxAmount);

//                 let percentCharge = 0;
//                 let fixedCharge = 0;
//                 let totalPercentCharge = 0;
//                 let discount = 0;
//                 let discountPercent = parseFloat($('#coupon_discount').val()) || 0;

//                 if (amount) {
//                     percentCharge = parseFloat(gateway.percent_charge);
//                     fixedCharge = parseFloat(gateway.fixed_charge);
//                     totalPercentCharge = amount * (percentCharge / 100);
//                 }

//                 const extra_services_amount = parseFloat($('.extra_services_amount').val() || 0);

//                 const totalCharge = totalPercentCharge + fixedCharge;
//                 const origin_total = parseFloat(amount + totalCharge);

//                 //  Calculate admin commission in value
//                 const adminCommissionAmount = amount * (adminCommissionRate / 100);

//                 console.log("Admin commission (%):", adminCommissionRate + "%");
//                 console.log(" Admin commission (JD):", adminCommissionAmount.toFixed(2));


//                 //  Apply discount only up to admin commission
//                 let discountValue = (origin_total * discountPercent / 100);

//                 if (discountValue > adminCommissionAmount) {
//                     discountValue = adminCommissionAmount;

//                     //  Update the % discount value shown
//                     discountPercent = (adminCommissionAmount / origin_total) * 100;
//                     $('#coupon_discount').val(discountPercent.toFixed(2));
//                 }

//                 const discountedTotal = origin_total - discountValue;

//                 const taxRate = {{ gs('rental_tax') / 100 }};
//                 const taxAmount = discountedTotal * taxRate;
//                 const finalTotal = discountedTotal + taxAmount + extra_services_amount;

//                 // Update UI
//                 $(".processing-fee").text(totalCharge.toFixed(2));
//                 $(".final-amount").text(finalTotal.toFixed(2));
//                 $(".final_amount").val(finalTotal.toFixed(2));
//                 $("#tax-amount").text(taxAmount.toFixed(2));
//                 $("#tax-amount").val(taxAmount.toFixed(2));
//                 $('#discount-amount').text(discountValue.toFixed(2));

//                 $("input[name=currency]").val(gateway.currency);
//                 $(".gateway-currency").text(gateway.currency);

//                 if (amount < Number(gateway.min_amount) || amount > Number(gateway.max_amount)) {
//                     $(".deposit-form button[type=submit]").attr('disabled', true);
//                 } else {
//                     $(".deposit-form button[type=submit]").removeAttr('disabled');
//                 }

//                 // Handle conversion display
//                 if (gateway.currency != "{{ gs('cur_text') }}" && gateway.method.crypto != 1) {
//                     $(".gateway-conversion, .conversion-currency").removeClass('d-none');
//                     $(".gateway-conversion").find('.deposit-info__input .text').html(
//                         `1 {{ __(gs('cur_text')) }} = <span class="rate">${parseFloat(gateway.rate).toFixed(2)}</span> <span class="method_currency">${gateway.currency}</span>`
//                     );
//                     $('.in-currency').text((finalTotal * gateway.rate).toFixed(gateway.method.crypto == 1 ? 8 : 2));
//                 } else {
//                     $(".gateway-conversion, .conversion-currency").addClass('d-none');
//                 }

//                 if (gateway.method.crypto == 1) {
//                     $('.crypto-message').removeClass('d-none');
//                 } else {
//                     $('.crypto-message').addClass('d-none');
//                 }
//                 //  Show warning if coupon was capped by admin commission
//                 const originallyEnteredPercent = parseFloat($('#coupon_discount').data('original')) || discountPercent;

//                 if (originallyEnteredPercent > discountPercent) {
//                     if (!$('.coupon_cap_warning').length) {
//                         $('.coupon_text').append(`<div class="coupon_cap_warning" style="color: #e67e22; font-size: 14px; padding-top: 5px;">
//                         		âš ï¸� Your coupon was capped to <strong>${discountValue.toFixed(2)} JD</strong> due to admin commission limit.
//                         </div>`);
//                     }
//                 } else {
//                     $('.coupon_cap_warning').remove(); // remove warning if no longer capped
//                 }


//             }


            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
            $('.gateway-input').change();

$('#validat_coupon').click(function () {
    const couponCode = $('#coupon_code').val();
    const startDate = $('#start_date').val(); // Assuming you have these fields
    const endDate = $('#end_date').val();

    if (!couponCode) {
        alert("Please enter a coupon code.");
        return;
    }

    $.ajax({
        url: "{{ route('user.coupon.verifyCoupon') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            coupon: couponCode,
            start_date: startDate,
            end_date: endDate
        },
        success: function (result) {
            if (result.status) {
                let discountText = '';
                let typeText = '';
                let unlimitedText = result.unlimited_value_check == 1 ?
                    'This coupon can be used multiple times!' : 'Limited use coupon.';
                let couponName = result.name;
                let value = result.value || 0;

                // Handle different coupon types
                if (result.type === 'period') {

                    typeText = `${value} free days added to your rental period!`;
                    $('#coupon_discount').val(0); // No monetary discount for period coupons
                }
                else if (result.type === 'percentage') {
                    typeText = `${value}% off`;
                    $('#coupon_discount').val(value);
                    $('#coupon_discount').data('original', value); // store original value
                }

                else {
                    typeText = `JD ${value} off`;
                    $('#coupon_discount').val(value);
                }

                discountText = `
                	🎉 Coupon "<strong>${couponName}</strong>" applied successfully!<br>
               	 	🔥 You got <strong>${typeText}</strong><br>
                	📌 ${unlimitedText}
                `;

                $('.coupon_text').html(discountText).css({
                    color: '#2ecc71',
                    fontSize: '16px',
                    fontWeight: '500',
                    paddingTop: '10px',
                    display: 'block'
                });
                    verifiedCoupon = {
                        code: couponCode,
                        type: result.type,
                        value: result.value,
                        discount: result.discount_amount || 0
                    };
                    couponApplied = true;

                // Recalculate totals if needed
                calculation();

            } else {
                    verifiedCoupon = null;
                    couponApplied = false;

                    $('#coupon_discount').val(0);
                    calculation();

                $('.coupon_text').html(result.message).css({
                    color: '#e74c3c',
                    fontSize: '16px',
                    fontWeight: '500',
                    paddingTop: '10px',
                    display: 'block'
                });
            }
        },
        error: function (xhr) {
            alert("An error occurred while verifying the coupon.");
        }
    });
});


    $('.deposit-form').submit(function(e) {
        e.preventDefault();

        // If coupon was verified, add it to form data
        if (couponApplied && verifiedCoupon) {
            $(this).append(`<input type="hidden" name="coupon_code" value="${verifiedCoupon.code}">`);
            $(this).append(`<input type="hidden" name="coupon_discount" value="${verifiedCoupon.value}">`);
        }
        let tax_amount=parseFloat(document.querySelector("#tax-amount").value);
        $(this).append(`<input type="hidden" name="tax_amount" value="${tax_amount}">`);

        // Submit the form
        this.submit();
    });

})(jQuery);
    </script>
    <script>
    </script>
@endpush
@push('style')
    <style>
        .form--control:disabled,
        .form--control[readonly] {
            background: unset;
        }
    </style>
@endpush
