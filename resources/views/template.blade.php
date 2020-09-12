<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ route('root') }}/favicon.ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="yandex-verification" content="bcc575eacccd4972">

        <title>@yield('title', config('app.name') .' – вестник пробуждения')</title>
        <meta name="description" content="@yield('description', 'Проект освещает события грядущего пробуждения в Копейске.')">
        <meta name="keywords" content="@yield('keywords', 'пробуждение, Копейск, пробуждение Копейск, пробуждение в Копейске, пробуждение на Урале')">

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700|PT+Sans+Narrow:400,700|PT+Sans:400,400i,700,700i&display=swap&subset=cyrillic" rel="stylesheet">

        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="header sticky-top">
            <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #c00;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('root') }}"><b>Копейск.Инфо</b></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                            {{--<li class="nav-item active">
                                <a class="nav-link" href="{{ route('root') }}">Главная <span class="sr-only">(current)</span></a>
                            </li>--}}
                            @if (Route::has('news'))
                                <li class="nav-item {{ Route::is('news*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('news') }}">Новости</a>
                                </li>
                            @endif
                            @if (Route::has('events'))
                                <li class="nav-item {{ Route::is('events*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('events') }}">События</a>
                                </li>
                            @endif
                            @if (Route::has('live_feed'))
                                <li class="nav-item {{ Route::is('live_feed*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('live_feed') }}">Прямой эфир</a>
                                </li>
                            @endif
                            @if (Route::has('catalog'))
                                <li class="nav-item {{ Route::is('catalog*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('catalog') }}">Каталог церквей</a>
                                </li>
                            @endif
                        </ul>
                        <ul class="navbar-nav">
                            @if (Route::has('repent'))
                                <li class="nav-item {{ Route::is('repent*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('repent') }}">Молитва покаяния</a>
                                </li>
                            @endif
                            @if (Route::has('about'))
                                <li class="nav-item {{ Route::is('about*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('about') }}">О проекте</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <div class="container">
                @yield('main')
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-place">
                            <div class="footer-place-verse">
                                Когда же приидет Он, Дух истины, то наставит вас на всякую истину ибо не от Себя говорить будет, но будет говорить, что услышит, и будущее возвестит вам.
                                Он прославит Меня, потому что от Моего возьмёт и возвестит вам.
                            </div>
                            <div class="footer-place-index">От Иоанна 16:13–14</div>
                        </div>
                        {{--
                        <div class="footer-contact">
                            <ul class="footer-contact-link">
                                <li>Основатели проекта</li>
                                <li><a href="https://vk.com/sleuthhound" target="_blank">Антон Попов</a></li>
                                <li><a href="https://vk.com/yurijkon" target="_blank">Юрий Контарев</a></li>
                            </ul>
                        </div>
                        --}}
                        <div class="footer-copy">
                            © Проект «{{ config('app.name') }}» – вестник пробуждения, 2020
                        </div>
                        <div class="footer-version">
                            Версия Pre-Alpha <a href="https://github.com/kopeisk-info/site/releases" target="_blank" title="Последная версия на GitHub">0.0.7</a> ·
                            <a href="https://vk.com/kopeisk_info?z=moneysend-100483740" target="_blank" title="Финансовая поддержка, спонсорство">Поддержать</a> или
                            <a href="" title="">стать участником</a> проекта
{{--
    <a href="https://vk.com/kopeisk_info?z=moneysend-100483740" target="_blank" title="Финансовая поддержка проекта, спонсорство">Поддержать проект</a> ·
    Стать участником проекта
--}}

                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ mix('js/app.js') }}"></script>

        @if (!in_array(request()->ip(), ['::1', '127.0.0.1', '217.64.134.223', '95.78.167.221']))
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(50408688, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/50408688" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        @endif
    </body>
</html>
