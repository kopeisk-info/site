@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <div class="sticky-top" style="top: 75px;">
            @if (Route::has('news'))
                <h2><a href="{{ route('news') }}">Последние новости</a></h2>
                    @foreach ($news as $news)
                        <div class="news-item mb-4">
                            @if ($news->image)
                                <div class="row">
                                    <div class="col-sm-12 col-lg-4">
                                        <img src="{{ asset('storage/'. $news->image) }}" class="rounded img-fluid">
                                    </div>
                                    <div class="col-sm-12 col-lg-8">
                                        <h2 class="h4 mb-1">
                                            <a href="{{ route('news.show', $news->date_at->timestamp . $news->id) }}" title="{{ $news->title }}">{{ $news->title }}</a>
                                        </h2>
                                        <div>{{ $news->date_at->diffForHumans() }}</div>
                                        <div class="mt-2">{{ $news->description }}</div>
                                    </div>
                                </div>
                            @else
                                <h2 class="h4 mb-1">
                                    <a href="{{ route('news.show', $news->date_at->timestamp . $news->id) }}" title="{{ $news->title }}">{{ $news->title }}</a>
                                </h2>
                                <div>{{ $news->date_at->diffForHumans() }}</div>
                                <div class="mt-2">{{ $news->description }}</div>
                            @endif
                        </div>
                    @endforeach
                    <a href="{{ route('live_feed') }}" title="Перейти в раздел новостей">Посмотреть все новости</a>
            @endif
            </div>
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
