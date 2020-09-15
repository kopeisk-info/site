@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2 mb-1">{{ $news->title }}</h1>
            <div class="mb-3">{{ $news->date_at->diffForHumans() }}</div>
            @if ($news->image)
                <img src="{{ asset('storage/'. $news->image) }}" class="rounded mx-auto d-block img-fluid">
            @endif
            <div>
                {!! $news->text !!}
            </div>
        </div>
    </div>
@endsection
