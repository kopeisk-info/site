@extends('template')

@section('title', 'Молитва покаяния - это возможность пригласить Бога в свою жизнь')
@section('description', 'Если ты хочешь пригласить в свою жизнь Бога, то позволь Иисусу стать Господом твоей жизни. Произнеси от сердца эти простые слова.')
@section('keywords', 'спасение, примирение, раскаивание, пригласить Бога в свою жизнь, примириться с Богом, получить ответ, изменить свою жизнь, будь моим Господом и Спасителем')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2">Молитва покаяния</h1>
            <div class="text-justify">
                {!! $prayer !!}
            </div>
        </div>
        <div class="col-sx-12 col-lg-3">
            <div class="side sticky-top" style="top: 80px">
                <div class="d-flex justify-content-start">
                    <div class="card-photo">
                        <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}">
                            <img src="{{ $photo }}" alt="{{ $name }}" class="rounded-circle">
                        </a>
                    </div>
                    <div class="card-info" style="width: 100%; margin-left: 15px; overflow: hidden; text-overflow: ellipsis;">
                        <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}" style="white-space: nowrap;">{{ $name }}</a>
                        <div style="font-size: 13px;">{{ $ordination }}</div>
                    </div>
                </div>
                <div style="font-size: 13px;" class="mt-2">{{ $church }}</div>
                <div style="font-size: 13px;" class="mb-4">{{ $city ? 'город '. $city : '' }}</div>

                <div class="alert alert-warning" role="alert">
                    <div class="h5" style="color: #c00">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-star" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                            <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                        </svg> Важная информация!
                    </div>
                    <p><strong>Если вы еще не приняли</strong> Иисуса Христа своим господом и спасителем,
                        прямо сейчас вы можете обратиться к Нему с молитвой.</p>
                    <p>Бог даст вашей душе истинную радость, мир и счастье. Только в Боге вы найдете ответы
                        на все вопросы, только Он решит все ваши проблемы.</p>
                    <p>Жить с Богом, верить Богу – это истинное счастье. Бог любит и ждет вас. Вы нужны Ему.</p>
                    <p class="mb-0"><strong>Если вы искренне помолились</strong>, не сомневайтесь, что Бог услышал вас и простил все ваши грехи.
                        Теперь Бог – ваш отец, а Иисус – ваш друг. Читайте Слово, живите с Богом, молитесь.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
