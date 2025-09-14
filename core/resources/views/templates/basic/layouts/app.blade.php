<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title> {{ gs()->siteName(__($pageTitle)) }} </title>
        @include('partials.seo')
        <meta name="mobile-web-app-capable" content="yes">
        <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/global/css/line-awesome.min.css') }}" rel="stylesheet" />

        <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/global/css/select2.min.css') }}" rel="stylesheet">

        <link href="{{ asset($activeTemplateTrue . 'css/iconmoon.css') }}" rel="stylesheet" />
        <link href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}" rel="stylesheet" />
        <link href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}" rel="stylesheet" />

        @stack('style-lib')

        <link href="{{ asset($activeTemplateTrue . 'css/main.css') }}" rel="stylesheet" />
        <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet" />

        @stack('style')

        <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ gs('base_color') }}&secondColor={{ gs('secondary_color') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const userLang = navigator.language || navigator.userLanguage;
  const lang = userLang.startsWith("ar") ? "ar" : "en";
  document.documentElement.lang = lang;

  const manifest = document.createElement('link');
  manifest.rel = 'manifest';
  manifest.href = `/manifest-${lang}.json`;
  document.head.appendChild(manifest);
</script>


<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker
        .register('/service-worker.js')
        // .then(reg => console.log('✅ Service Worker registered:', reg.scope))
        // .catch(err => console.error('❌ Service Worker registration failed:', err));
    });
  }
  </script>

 {{-- 
  <script type="module">
  // Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyAbfBhGif9jZMknXq0VgmlCpNyJQxEndAU",
    authDomain: "my-project-1571431207759.firebaseapp.com",
    databaseURL: "https://my-project-1571431207759-default-rtdb.firebaseio.com",
    projectId: "my-project-1571431207759",
    storageBucket: "my-project-1571431207759.firebasestorage.app",
    messagingSenderId: "766106166614",
    appId: "1:766106166614:web:5f6508543f7bba15c522f7"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

navigator.serviceWorker.register('/firebase-messaging-sw.js')
.then((registration) => {
  const messaging = getMessaging(app);
  getToken(messaging, {
    vapidKey: "BHpXnMyCWIJ7nbxsDai_8-5YDNFsgMvqV5Xl94lhSS5gIqMR-YDni9jk0TCkpvCGTmwJJLUsqPASQj8DKYOlc1w",
    serviceWorkerRegistration: registration,
  }).then((currentToken) => {
    if (currentToken) {
        console.log(currentToken)
      // أرسل التوكن للسيرفر
    } else {
      console.warn('No token available.');
    }
  }).catch((err) => {
    console.error('Error getting token:', err);
  });
});


</script>

--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        @include('partials.push_script')

<meta name="google-site-verification" content="PqlLav6qqkkEKmxTjYt2pNvQVXBy878Fe1q0PvW1l5I" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CMJD7BRWSW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CMJD7BRWSW');
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-CMJD7BRWSW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-CMJD7BRWSW');
</script>
    </head>
    @php echo loadExtension('google-analytics') @endphp

    <body>

        @stack('fbComment')

        <div class="preloader">
            <div class="loader-p"></div>
        </div>
        <div class="body-overlay"></div>
        <div class="sidebar-overlay"></div>
        <a class="scroll-top"><i class="fas fa-angle-double-up"></i></a>

        @yield('app')

        @php
            $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
        @endphp
        @if ($cookie->data_values->status == Status::ENABLE && !\Cookie::get('gdpr_cookie'))
            <div class="cookies-card hide text-center">
                <div class="cookies-card__icon bg--base">
                    <i class="las la-cookie-bite"></i>
                </div>
                <p class="cookies-card__content mt-4">{{ __($cookie->data_values->short_desc) }} <a
                       class="text--base" href="{{ route('cookie.policy') }}" target="_blank">@lang('learn more')</a></p>
                <div class="cookies-card__btn mt-4">
                    <a class="btn btn--base w-100 policy" href="javascript:void(0)">@lang('Allow')</a>
                </div>
            </div>
        @endif

        <script src="{{ asset('assets/global/js/jquery-3.7.1.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>

        @stack('script-lib')
        @php echo loadExtension('tawk-chat') @endphp
        @include('partials.notify')
        <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/viewport.jquery.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/lightcase.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>

        @stack('script')

        <script>
            (function($) {
                "use strict";
                $(".langSel").on("click", function() {
                    window.location.href = "{{ route('home') }}/change/" + $(this).data('lang_code');
                });

                $('.policy').on('click', function() {
                    $.get('{{ route('cookie.accept') }}', function(response) {
                        $('.cookies-card').addClass('d-none');
                    });
                });

                setTimeout(function() {
                    $('.cookies-card').removeClass('hide')
                }, 2000);

                var inputElements = $('[type=text],select,textarea');
                $.each(inputElements, function(index, element) {
                    element = $(element);
                    element.closest('.form-group').find('label').attr('for', element.attr('name'));
                    element.attr('id', element.attr('name'))
                });

                $.each($('input, select, textarea'), function(i, element) {
                    var elementType = $(element);
                    if (elementType.attr('type') != 'checkbox') {
                        if (element.hasAttribute('required')) {
                            $(element).closest('.form-group').find('label').addClass('required');
                        }
                    }
                });
            })(jQuery);
        </script>
    </body>

</html>
