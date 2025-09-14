@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $contactContent = getContent('contact_us.content', true);
    @endphp

    <section class="contact-us-info py-120">
        <div class="container">
            <div class="contact-info-wrapper">
                <div class="row gy-4">
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Vector-3"></i></div>
                            <h5 class="contact-info-item__title">@lang('Email')</h5>
                            <a class="contact-info-item__text" href="mailto:{{ @$contactContent->data_values->contact_address }}">{{ @$contactContent->data_values->contact_email }}</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Phone"></i></div>
                            <h5 class="contact-info-item__title">@lang('Phone')</h5>
                            <a class="contact-info-item__text" href="tel:{{ @$contactContent->data_values->contact_number }}">{{ @$contactContent->data_values->contact_number }}</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="contact-info-item">
                            <div class="contact-info-item__icon"><i class="icon-Pin"></i></div>
                            <h5 class="contact-info-item__title">@lang('Office')</h5>
                            <a class="contact-info-item__text" href="javascript:void(0)">{{ __(@$contactContent->data_values->contact_address) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section pb-120">
        <div class="container">
            <div class="row g-4 g-md-5">
                <div class="col-lg-6">
                    <div class="contact-map">
                        <iframe src="{{ @$contactContent->data_values->map_embedded_link }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="contact-form-heading">
                            <h2 class="contact-form-heading__title">{{ __(@$contactContent->data_values->title) }}</h2>
                            <p class="contact-form-heading__desc">{{ __(@$contactContent->data_values->short_details) }}</p>
                        </div>
                        <form class="verify-gcaptcha" method="post" action="">
                            @csrf
                            <div class="form-group">
                                <label class="form--label">@lang('Name')</label>
                                <input class="form--control" name="name" type="text" value="{{ old('name', @$user->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Email')</label>
                                <input class="form--control" name="email" type="email" value="{{ old('email', @$user->email) }}" @if ($user) readonly @endif required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Subject')</label>
                                <input class="form--control" name="subject" type="text" value="{{ old('subject') }}" required>
                            </div>
                            <div class="form-group">
                                <label class="form--label">@lang('Message')</label>
                                <textarea class="form--control" name="message" wrap="off" required>{{ old('message') }}</textarea>
                            </div>

                            <x-captcha />

                            <button class="btn btn--gradient w-100" type="submit">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('[name=captcha]').removeClass('form-control').siblings('label').removeClass('form-label').addClass('form--label');
        })(jQuery)
    </script>
@endpush
