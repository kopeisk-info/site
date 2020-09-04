@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2">Каталог церквей</h1>
            @foreach($churchs as $church)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="h5">{{ $church->name }}</div>
                        @if ($church->foundation_date)
                            <div>Дата основания: {{ $church->foundation_date->format() }}</div>
                        @endif
                        @if ($church->registration_date)
                            <div>Зарегистрирована {{ $church->registration_date->translatedFormat('j F Y') }}</div>
                        @endif
                        @if ($ministers = $church->ministers)
                            @foreach ($ministers as $minister)
                                <div>{{ $minister->ordination->ordination }} — {{ $minister->name }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
