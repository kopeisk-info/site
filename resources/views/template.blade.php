<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ route('root') }}/favicon.ico">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="yandex-verification" content="bcc575eacccd4972" />

        <title>@yield('title', config('app.name') .' – вестник пробуждения')</title>

        <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700|PT+Sans+Narrow:400,700|PT+Sans:400,400i,700,700i&display=swap&subset=cyrillic" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="logo">Копейск.Инфо</div>
                Здесь будет логотип проекта и основное меню
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/root') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            </div>
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
                            Версия Pre-Alpha <a href="https://github.com/kopeisk-info/site/releases/tag/0.0.1" target="_blank" title="Релиз на GitHub">0.0.1</a> ·
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

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(50408688, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, trackHash:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/50408688" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </body>
</html>
