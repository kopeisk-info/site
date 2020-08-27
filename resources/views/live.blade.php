@extends('template')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-12">
            <div class="wall">
                <div class="wall-title">Прямой эфир</div>
                <div>Функциональный прототип будущего раздела</div>
                <div class="row row-cols-1 row-cols-md-3">
                    @foreach($posts as $post)
                    <div class="col mb-4">
                        <x-vk-post :post="$post"/>
                    </div>
                    @endforeach
                </div>

                <div class="wall-notice">
                    Данные прямого эфира формируются на основании открытых источников,
                    доступных для поисковых систем.
                </div>
            </div>
        </div>
    </div>
@endsection
