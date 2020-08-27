@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            Центральная часть
        </div>
        <div class="col-sx-12 col-lg-3">
            <div class="wall">
                <div class="wall-title">Прямой эфир</div>
                <div>Функциональный прототип будущего раздела</div>

                @foreach($posts as $post)
                    <x-vk-post :post="$post"/>
                @endforeach

                <div class="wall-notice">
                    Данные прямого эфира формируются на основании открытых источников,
                    доступных для поисковых систем.
                </div>
            </div>
        </div>
    </div>
@endsection
