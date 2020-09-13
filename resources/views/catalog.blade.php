@extends('template')

@section('title', 'Каталог церквей Копейска и Челябинска')
@section('description', 'Каталог христианских релииозных групп, церквей и объединений города Копейска и Челябинска.')
@section('keywords', 'каталог церквей, справочник церквей, христианские церкви, религиозные группы Копейска, религиозные группы Челябинска, церкви Копейска, церкви Челябинска')

@section('main')
    <div class="row">
        <h1 class="h2">Каталог церквей</h1>
        @foreach($churchs as $church)
            <div class="col-sx-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="h5" style="color: #c00">{{ $church->name }}</div>
                        @if ($church->full_name)
                            <div><b>{{ $church->full_name }}</b></div>
                        @endif
                        <div class="mb-3">{{ $church->city }}{{ $church->district ? ', '. $church->district : '' }}</div>
                        @if ($church->foundation_date)
                            <div>Основана {{ $church->foundation_date->translatedFormat('j F Y') }}</div>
                        @endif
                        @if ($church->registration_date)
                            <div>Зарегистрирована {{ $church->registration_date->translatedFormat('j F Y') }}</div>
                        @endif
                        @if ($church->contact_phone || $church->main_site)
                            <div class="mt-3"><b>Контактная информация</b></div>
                            @if ($church->contact_phone)
                                <div>Номер телефона <a href="tel://{{ $church->contact_phone }}">{{ $church->contact_phone }}</a></div>
                            @endif
                            @if ($church->main_site)
                                <div>Основной сайт <a href="http://{{ $church->main_site }}" target="_blank">{{ $church->main_site }}</a></div>
                            @endif
                        @endif
                        @if ($groups = $church->vkGroups->all())
                            <div class="mt-3"><b>Группы Вконтакте</b></div>
                            @foreach ($groups as $group)
                                <div><a href="https://vk.com/{{ $group->screen_name }}" target="_blank">{{ $group->name }}</a></div>
                            @endforeach
                        @endif
                        @if ($ministers = $church->ministers->all())
                            <div class="mt-3"><b>Служителя церкви</b></div>
                            @foreach ($ministers as $minister)
                                @if ($profile = $minister->vkUsers->first())
                                    <div>{{ $minister->ordination->ordination }} — <a href="https://vk.com/{{ $profile->screen_name }}" target="_blank">{{ $minister->full_name }}</a></div>
                                @else
                                    <div>{{ $minister->ordination->ordination }} — {{ $minister->full_name }}</div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
