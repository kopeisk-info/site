@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            @if (Route::has('news'))
                <h2><a href="{{ route('news') }}">Последние новости</a></h2>
                <div class="alert alert-secondary" role="alert">
                    Раздел находится в стадии разработки и наполнения начальной информацией.
                    Если у вас есть желание присоеденится к проекту или оказать любую посильную помощь,
                    <a href="https://vk.com/write35177946" target="_blank">напишите мне об этом</a> в личном сообщении.
                </div>
            @endif
        </div>
        <div class="col-sx-12 col-lg-3">
            @if (Route::has('live_feed'))
                <div class="wall">
                    <h2><a href="{{ route('live_feed') }}" title="Перейти в раздел">Прямой эфир</a></h2>

                    @foreach($posts as $post)
                        <x-vk-post :post="$post"/>
                    @endforeach

                    <a href="{{ route('live_feed') }}" title="Перейти в раздел">Посмотреть все записи «Прямого эфира»</a>
                </div>
            @endif
        </div>
    </div>
@endsection
