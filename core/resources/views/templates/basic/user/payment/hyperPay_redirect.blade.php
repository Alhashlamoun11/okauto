@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="container">
        <h3>@lang('Complete Your Payment')</h3>
        <div class="row">
            <div class=" mx-auto">
                <!-- MADA Form (First Option) -->
                <form action="{{ $data->val->return }}" class="paymentWidgets" data-brands="VISA MASTER">
                    <img src="{{ asset('images/gateway/6854112dc95041750339885.jpg') }}" alt="MADA" style="max-width: 100px;">
                </form>
{{--                <!-- VISA Form -->
                <form action="{{ $data->val->return }}" class="paymentWidgets" data-brands="VISA"></form>
                <!-- MasterCard Form -->
                <form action="{{ $data->val->return }}" class="paymentWidgets" data-brands="MASTER"></form>
            --}}</div>
        </div>
    </div>

    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $data->val->checkoutId }}"></script>
    <script type="text/javascript">
        var wpwlOptions = {
            paymentTarget: "_top"
        };
    </script>
    <script src="http://hyperpay-2024.quickconnect.to/d/f/597670674613449940"></script>
@endsection