@php
    $socialLinks = getContent('social_icon.element', orderById: true);
    $footerContent = getContent('footer.content', true);
    $policyPages = getContent('policy_pages.element', orderById: true);
    $contactContent = getContent('contact_us.content', true);
@endphp
<style>
body{
    overflow-x: hidden;
}
    .install-banner.hidden {
        display: none;
    }
    .hidden{
        display: none!important;
    }

@keyframes blink {
  0% {
    opacity: 1;
  }
  50% {
    opacity: 0.6;
  }
  100% {
    opacity: 1;
  }
}

</style>

<style>
.install-banner {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: #489efd;
  color: white;
  padding: 16px 24px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 9999;
  transform: translateY(100%);
  opacity: 0;
  transition: transform 0.5s ease, opacity 0.5s ease;
  border-radius: 12px 12px 0 0;
  box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.2);
  flex-wrap: wrap;
  animation: blink 1s ease-in-out infinite; /* تطبيق الأنيميشن للوميض */
}

.install-banner.show {
  transform: translateY(0);
  opacity: 1;
  animation: none; /* إيقاف الوميض عندما يظهر البانر */
}

  .install-banner.hidden {
    display: none;
  }

  .install-banner .icon-text {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-grow: 1;
  }

  .install-banner .icon-text i {
    font-size: 32px;
    color: #fff;
  }

  .install-banner .icon-text .info {
    line-height: 1.2;
  }

  .install-banner .icon-text .info strong {
    display: block;
    font-size: 1.1rem;
  }

  .install-banner .btn-install {
    background-color: white;
    color: #007bff;
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 14px;
    border: none;
    transition: 0.2s ease;
  }

  .install-banner .btn-install:hover {
    background-color: #f1f1f1;
  }

  .install-banner .close-btn {
    background: none;
    border: none;
    font-size: 20px;
    color: white;
    cursor: pointer;
    padding: 0;
    line-height: 0;
  }
    #logo-icon{
        width: 130px;
    }

  @media (max-width: 576px) {
    .install-banner {
      flex-direction: column;
      align-items: flex-start;
      padding: 1rem;
      bottom: 10px;
      left: 10px;
      right: 10px;
    }

    .install-banner .btn-install {
      width: 100%;
      text-align: center;
    }

    .install-banner .close-btn {
      align-self: flex-end;
    }
    
    #logo-icon{
        width: 65px;
    }
  }
  /* تأثير الحركة عند غلق الشريط */
#installBanner.closing {
  opacity: 0;
  transform: translateY(100%); /* حركه للخارج */
}
/* زر "عرض الشريط" بعد الإغلاق */
#showBannerBtn {
  position: fixed;
  bottom: 20px;
  left: 20px;
  background-color: #489efd;
  color: white;
  padding: 10px;
  border-radius: 50px;
  border: none;
  font-size: 16px;
  cursor: pointer;
  z-index: 9999;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
  display: none; /* مخفي بشكل افتراضي */
  transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
}

/* تأثير عند مرور الماوس */
#showBannerBtn:hover {
  background-color: #ff6f61; /* تغيير اللون عند المرور */
  transform: translateY(-5px); /* رفع الزر قليلًا */
  box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3); /* إضافة تأثير الظل عند المرور */
}

/* إضافة أيقونة (السهم) داخل الزر */
#showBannerBtn i {
  margin: 3px;
  font-size: 18px;
  transition: transform 0.3s ease;
}

/* إضافة حركة للأيقونة عند المرور بالماوس */
#showBannerBtn:hover i {
  transform: translateX(5px); /* تحريك الأيقونة قليلاً */
}

</style>

<div id="installBanner" class="install-banner hidden">
  <button id="closeBanner" class="close-btn" aria-label="Close">&times;</button>
  <div class="icon-text">
    <div><img id="logo-icon"></div>
        <!--<i class="fas fa-download"></i>-->
    <div class="info">
      <strong>{{ __('Install OK AUTO APP') }}</strong>
      <small>{{ __('Enjoy faster access & full experience!') }}</small>
    </div>
  </div>
  <button id="installBtn" class="btn-install">{{ __('Install Now') }}</button>
</div>
<button id="showBannerBtn" class="btn-show-banner hidden">
  <i class="fas fa-download"></i>
</button>

<!-- iOS Install Banner -->
<div id="iosInstallBanner" class="ios-install-banner hidden">
  <div class="banner-content">
    <div class="banner-icon">📲</div>
    <div class="banner-text">
      <strong>أضف OK AUTO إلى شاشتك الرئيسية!</strong><br>
      <small>لتحصل على تجربة أفضل، اضغط على زر المشاركة <span class="share-icon">🔗</span> واختر "إضافة إلى الشاشة الرئيسية".</small>
    </div>
    <button id="dismissIosBanner" class="close-btn" aria-label="إغلاق">&times;</button>
  </div>
</div>


<footer class="footer-area">
    <div class="footer-wrapper bg-img py-120" data-background-image="{{ frontendImage('footer', @$footerContent->data_values->image, '1905x535') }}">
        <div class="container">
            
            <div class="row justify-content-between gy-5">
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item__logo">
                            <a href="{{ route('home') }}"><img src="{{ siteLogo('white') }}" alt="@lang('image')" /></a>
                        </div>
                        <p class="footer-item__desc">{{ __(@$footerContent->data_values->description) }}</p>
                        <ul class="footer-contact-menu">
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="icon-Vector-4"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <a href="tel:{{ @$contactContent->data_values->contact_number }}">{{ @$contactContent->data_values->contact_number }}</a>
                                </div>
                            </li>
                            <li class="footer-contact-menu__item">
                                <div class="footer-contact-menu__item-icon">
                                    <i class="icon-Vector-3"></i>
                                </div>
                                <div class="footer-contact-menu__item-content">
                                    <a href="mailto:{{ @$contactContent->data_values->contact_email }}">{{ @$contactContent->data_values->contact_email }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Quick Links')</h5>
                        <ul class="footer-menu">
                            @foreach (@$policyPages as $policy)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('policy.pages', slug(@$policy->data_values->title)) }}">{{ __(@$policy->data_values->title) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-xsm-6">
                    <div class="footer-item">
                        <h5 class="footer-item__title">@lang('Vehicles')</h5>
                        <ul class="footer-menu">
                            @foreach (@$vehicleTypes->take(4) as $vehicleType)
                                <li class="footer-menu__item">
                                    <a class="footer-menu__link" href="{{ route('vehicles', $vehicleType->slug) }}">{{ __($vehicleType->name) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="footer-item">
                        <div class="footer-item-social">
                            <p class="footer-item-social__title">@lang('Contact With Us')</p>
                            <ul class="social-list mt-0">
                                @foreach (@$socialLinks as $socialLink)
                                    <li class="social-list__item">
                                        <a class="social-list__link flex-center" href="{{ @$socialLink->data_values->url }}" target="_blank">
                                            @php
                                                echo @$socialLink->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="footer-newsletter">
                        <h5 class="footer-newsletter__title">{{ __(@$footerContent->data_values->subscribe_title) }}</h5>
                        <p class="footer-newsletter__desc">{{ __(@$footerContent->data_values->subscribe_subtitle) }}</p>
                    </div>
                    <form class="footer-newsletter-form">
                        <input class="form--control" name="email" type="email" placeholder="@lang('Email Address')" autocomplete="off" />
                        <button class="btn btn--gradient subscribeBtn" type="button">@lang('Subscribe')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-footer py-3">
        <div class="container">
            <div class="row gy-3">
                <div class="col-md-12 text-center">
                    <div class="bottom-footer-text text-white">
                        @lang('Copyright') &copy; @php echo date('Y') @endphp @lang('All rights reserved.')
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const installBanner = document.getElementById('installBanner');
  const closeBtn = document.getElementById('closeBanner');
  const showBannerBtn = document.getElementById('showBannerBtn');
  
  // عرض الشريط عند تحميل الصفحة
  setTimeout(function () {
    installBanner.classList.add('show');
  }, 500); // تأخير بسيط لبدء العرض
  
  // إغلاق الشريط عند النقر على زر الإغلاق
  closeBtn.addEventListener('click', function () {
    installBanner.classList.add('closing');
    setTimeout(function () {
            showBannerBtn.classList.remove('hidden');

      installBanner.style.display = 'none';  // إخفاء الشريط بعد إغلاقه
      showBannerBtn.style.display = 'block'; // إظهار زر "عرض الشريط"
    }, 300); // وقت يتناسب مع مدة التأثير
  });
  
  // عند النقر على زر "عرض الشريط"، قم بعرض الشريط مجددًا
  showBannerBtn.addEventListener('click', function () {
    installBanner.style.display = 'flex'; // إظهار الشريط مرة أخرى
    installBanner.classList.remove('hidden');
    installBanner.classList.remove('closing');
    installBanner.classList.add('show');
    showBannerBtn.style.display = 'none'; // إخفاء زر "عرض الشريط" بعد العرض
  });
});

    // iOS Banner Logic
document.addEventListener('DOMContentLoaded', function () {
  const isIos = /iphone|ipad|ipod/.test(navigator.userAgent.toLowerCase());
  const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
  const isInStandaloneMode = ('standalone' in window.navigator) && window.navigator.standalone;

  if (isIos && isSafari && !isInStandaloneMode) {
    const banner = document.getElementById('iosInstallBanner');
    banner.classList.remove('hidden');
    banner.classList.add('show');
    installBanner.classList.add('hidden');
    showBannerBtn.classList.add('hidden');

    document.getElementById('dismissIosBanner').addEventListener('click', () => {
      banner.classList.remove('show');
      banner.classList.add('hidden');
    });
  }
});

</script>

<script>
    let icon =document.querySelector("#header > div > nav > a > img").src;
    let logoIcon=document.querySelector("#logo-icon")
    logoIcon.src=icon;
    
    let deferredPrompt;
    const banner = document.getElementById('installBanner');
    const installBtn = document.getElementById('installBtn');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        if (!localStorage.getItem('okauto_installed')) {
            banner.classList.remove('hidden');
        }
    });

    installBtn.addEventListener('click', () => {
        banner.classList.add('hidden');
        if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    localStorage.setItem('okauto_installed', 'true');
                    console.log('PWA Installed');
                }
                deferredPrompt = null;
            });
        }
    });

    window.addEventListener('appinstalled', () => {
        console.log('✅ App was installed');
        banner.classList.add('hidden');
        localStorage.setItem('okauto_installed', 'true');
    });
    document.getElementById('closeBanner').addEventListener('click', () => {
    document.getElementById('installBanner').classList.add('hidden');
    localStorage.setItem('installBannerClosed', 'true'); // لتخزين حالة إغلاق الـ banner
});

// التحقق إذا تم إغلاق الـ banner من قبل
if (localStorage.getItem('installBannerClosed')) {
    document.getElementById('installBanner').classList.add('hidden');
}

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // التحقق إذا كان التطبيق يعمل كـ PWA أو تم تثبيته
    const isPWA = (window.matchMedia('(display-mode: standalone)').matches || navigator.standalone === true);
    
    // إذا كان التطبيق مثبتًا أو يعمل كـ PWA، إخفاء الـ banner
    if (isPWA || localStorage.getItem('installBannerClosed')) {
        document.getElementById('installBanner').classList.add('hidden');
        document.getElementById('showBannerBtn').classList.add('hidden');
    }

    // عند النقر على زر الإغلاق
    document.getElementById('closeBanner').addEventListener('click', () => {
        document.getElementById('installBanner').classList.add('hidden');
        localStorage.setItem('installBannerClosed', 'true'); // لتخزين حالة الإغلاق
    });
});
document.addEventListener('DOMContentLoaded', function () {
    // التحقق من وجود "/user/" في URL الصفحة
    if (!window.location.pathname.includes('/user/')) {
        // إذا لم تكن الصفحة تحتوي على "/user/", إظهار الـ install banner
        document.getElementById('installBanner').classList.remove('hidden');
    }

    // التحقق إذا كان التطبيق يعمل كـ PWA أو تم تثبيته
    const isPWA = (window.matchMedia('(display-mode: standalone)').matches || navigator.standalone === true);
    
    // إذا كان التطبيق مثبتًا أو يعمل كـ PWA، إخفاء الـ banner
    if (isPWA || localStorage.getItem('installBannerClosed')) {
        document.getElementById('installBanner').classList.add('hidden');
    }

    // عند النقر على زر الإغلاق
    document.getElementById('closeBanner').addEventListener('click', () => {
        document.getElementById('installBanner').classList.add('hidden');
        localStorage.setItem('installBannerClosed', 'true'); // لتخزين حالة الإغلاق
    });
});

</script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.subscribeBtn').on('click', function(e) {
                e.preventDefault()
                var email = $('[name=email]').val();
                if (!email) {
                    return;
                }
                $.ajax({
                    url: "{{ route('subscribe') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(response) {
                        if (response.success) {
                            $('[name=email]').val('')
                            notify('success', response.success);
                        } else {
                            notify('error', response.error);
                        }
                    }
                });
            });
        })(jQuery)
    </script>

@endpush
