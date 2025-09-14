@extends($activeTemplate.'layouts.master')
@section('content')
        <h3>@lang('Complete Your Payment')</h3>
        <div class="row">
            <div class=" mx-auto">
                <!-- MADA Form (First Option) -->
                <form action="{{ $data->val->return }}" class="paymentWidgets" data-brands="VISA MASTER">
                    <button type="submit">Approve Payment</button>
                </form>
        </div>
    </div>

@endsection