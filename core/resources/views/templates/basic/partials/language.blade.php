@if (gs('multi_language'))
    @php
        $languages = App\Models\Language::all();
        $selectedLang = $languages->where('code', session('lang'))->first();
    @endphp
    <div class="language__icon">
        <img class="flag"
             src="{{ getImage(getFilePath('language') . '/' . @$selectedLang->image, getFileSize('language')) }}"
             alt="us">
    </div>
    <div class="language__wrapper" data-bs-toggle="dropdown" aria-expanded="false">
        <p class="language__text">
            {{ __(@$selectedLang->name) }}
        </p>
        <span class="language__arrow"><i class="fas fa-chevron-down"></i></span>
    </div>
    <div class="dropdown-menu">
        <ul class="language-list">
            @foreach ($languages as $lang)
                <li class="language-list__item langSel" >
                    <a class="language_text" href="{{ route('lang', $lang->code) }}">
                        <img class="flag"
                             src="{{ getImage(getFilePath('language') . '/' . @$lang->image, getFileSize('language')) }}"
                             alt="@lang('Image')">
                             <p class="text">
                                {{ __(@$lang->name) }}
                             </p>

                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
