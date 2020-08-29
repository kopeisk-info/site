@extends('template')

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
                        <div style="font-size: 13px; margin-top: 5px;">{{ $city }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
