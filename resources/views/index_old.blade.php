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




                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
                <div class="row">
                    @foreach($items as $item)
                        @if ($item->owner && !isset($item->copy_history))
                            <div class="col-sx-12">
                                <div class="wall-post">
                                    <div class="wall-avatar">
                                        <img src="{{ $item->owner->photo_50 }}" alt="{{ $item->owner->screen_name }}">
                                    </div>
                                    <div class="wall-content">
                                        @if (isset($item->copy_history))
                                            репост
                                        @else
                                            @if ('group' === $item->owner->type)
                                                <div>
                                                    В сообществе
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}" target="_balnk">
                                                        {{ $item->owner->name }}
                                                    </a>
                                                    опубликован пост
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}?w=wall-{{ $item->owner->id }}_{{ $item->id }}" target="_balnk">
                                                        {{ $item->date->diffForHumans() }}
                                                    </a>
                                                </div>
                                            @elseif ('page' === $item->owner->type)
                                                <div>
                                                    На странице
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}" target="_balnk">
                                                        {{ $item->owner->name }}
                                                    </a>
                                                    размещена запись
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}?w=wall-{{ $item->owner->id }}_{{ $item->id }}" target="_balnk">
                                                        {{ $item->date->diffForHumans() }}
                                                    </a>
                                                </div>
                                            @elseif ('event' === $item->owner->type)
                                                <div>
                                                    Мероприятие
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}" target="_balnk">
                                                        {{ $item->owner->name }}
                                                    </a>
                                                    опубликовало
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}?w=wall-{{ $item->owner->id }}_{{ $item->id }}" target="_balnk">
                                                        {{ $item->date->diffForHumans() }}
                                                    </a>
                                                </div>
                                            @else
                                                <div>
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}" target="_balnk">
                                                        {{ $item->owner->first_name .' '. $item->owner->last_name }}
                                                    </a> {{ 1 == $item->owner->sex ? 'написала' : 'написал' }}
                                                    <a href="https://vk.com/{{ $item->owner->screen_name }}?w=wall-{{ $item->owner->id }}_{{ $item->id }}" target="_balnk">
                                                        {{ $item->date->diffForHumans() }}
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="text">
                                                {{ preg_replace('/\s+?(\S+)?$/', '', substr($item->text . ' ', 0, 500)) }}
                                            </div>
                                            @if (isset($item->attachments))
                                                @foreach ($item->attachments as $attachment)
                                                    @if ('photo' === $attachment['type'])
                                                        <img src="{{ $attachment['photo']['sizes']['7']['url'] }}" class="img-fluid" style="max-width: 100%" alt="">
                                                        @break
                                                    @elseif ('video' === $attachment['type'])
                                                        <img src="{{ $attachment['video']['image']['7']['url'] }}" class="img-fluid" style="max-width: 100%" alt="">
                                                        @break
                                                    @elseif ('link' === $attachment['type'])
                                                        <div><a href="{{ $attachment['link']['url'] }}">{{ $attachment['link']['url'] }}</a></div>
                                                        @if (isset($attachment['link']['photo']))
                                                            <img src="{{ $attachment['link']['photo']['sizes']['7']['url'] }}" class="img-fluid" style="max-width: 100%" alt="">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
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
