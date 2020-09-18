@extends('template')

@section('title', $news->title)
@section('description', $news->description)
@section('keywords', 'новости, новости церквей, новости о пробуждении, последние новости')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2 mb-1">{{ $news->title }}</h1>
            <div class="mb-3">{{ $news->date_at->translatedFormat('j F Y') .' в '. $news->date_at->format('H:i') }}</div>
            <p><strong>{{ $news->description }}</strong></p>
            @if ($news->image)
                <img src="{{ asset('storage/'. $news->image) }}" class="rounded mx-auto d-block img-fluid img-thumbnail mb-4">
            @endif
            <div>
                {!! $news->text !!}
            </div>
        </div>
    </div>
@endsection
