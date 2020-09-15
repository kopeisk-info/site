@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2">Новости</h1>
            @foreach ($news as $news)
                <div class="news-item mt-5">
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
        </div>
    </div>
@endsection
