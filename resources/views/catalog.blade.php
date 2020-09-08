@extends('template')

@section('main')
    <div class="row">

            <h1 class="h2">Каталог церквей</h1>
            @foreach($churchs as $church)
            <div class="col-sx-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="h5">{{ $church->name }}</div>
                        @if ($church->full_name)
                            <div class="mb-3">{{ $church->full_name }}</div>
                        @endif
                        @if ($church->foundation_date)
                            <div>Дата основания: {{ $church->foundation_date->translatedFormat('j F Y') }}</div>
                        @endif
                        @if ($church->registration_date)
                            <div>Зарегистрирована {{ $church->registration_date->translatedFormat('j F Y') }}</div>
                        @endif
                        @if ($church->contact_phone)
                            <div>Контактный номер телефона {{ $church->contact_phone }}</div>
                        @endif
                        @if ($ministers = $church->ministers)
                            <div class="mt-3"><b>Служителя церкви</b></div>
                            @foreach ($ministers as $minister)
                                <div>{{ $minister->ordination->ordination }} — {{ $minister->name }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
    </div>
@endsection
