@extends('template')

@section('title', 'Новости пробуждения в Копейске')
@section('description', 'Все последние новости о пробуждении в одном месте.')
@section('keywords', 'новости, новости церквей, новости о пробуждении, последние новости')

@section('main')
    <div class="row">
        <div class="col-sx-12 col-lg-9">
            <h1 class="h2">Новости</h1>
            @foreach ($news as $item)
                <div class="news-item mt-5">
                    @if ($item->image)
                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <img src="{{ asset('storage/'. $item->image) }}" class="rounded img-fluid img-thumbnail">
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                <h2 class="h4 mb-1">
                                    <a href="{{ route('news.show', $item->date_at->timestamp . $item->id) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                                </h2>
                                <div>{{ $item->date_at->diffForHumans() }}</div>
                                <div class="mt-2">{{ $item->description }}</div>
                            </div>
                        </div>
                    @else
                        <h2 class="h4 mb-1">
                            <a href="{{ route('news.show', $item->date_at->timestamp . $item->id) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                        </h2>
                        <div>{{ $item->date_at->diffForHumans() }}</div>
                        <div class="mt-2">{{ $item->description }}</div>
                    @endif
                </div>
            @endforeach
            {{ $news->onEachSide(1)->links() }}
        </div>
        <div class="col-sx-12 col-lg-3">
            <div class="side sticky-top" style="top: 75px;">
                <div class="alert alert-warning" role="alert">
                    <div class="h5" style="color: #c00">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-alarm" fill="#c00" xmlns="http://www.w3.org/2000/svg" style="margin-top: -8px;">
                            <path fill-rule="evenodd" d="M8 15A6 6 0 1 0 8 3a6 6 0 0 0 0 12zm0 1A7 7 0 1 0 8 2a7 7 0 0 0 0 14z"/>
                            <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.053.224l-1.5 3a.5.5 0 1 1-.894-.448L7.5 8.882V5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
                            <path fill-rule="evenodd" d="M11.646 14.146a.5.5 0 0 1 .708 0l1 1a.5.5 0 0 1-.708.708l-1-1a.5.5 0 0 1 0-.708zm-7.292 0a.5.5 0 0 0-.708 0l-1 1a.5.5 0 0 0 .708.708l1-1a.5.5 0 0 0 0-.708zM5.5.5A.5.5 0 0 1 6 0h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                            <path d="M7 1h2v2H7V1z"/>
                        </svg> Обратите внимание!
                    </div>
                    Автор, он же — редактор новостей, имеет низкую итоговую оценку (трояк) по русскому языку!
                    Потому отнеситесь с терпимостью и пониманием, а еще лучше напишите о замеченных вами ошибках в
                    <a href="https://vk.com/im?sel=35177946" target="_blank" title="Сообщить об ошибке">личном сообщении</a>.<br><br>
                    — Обещаю учесть все замечания и исправить ошибки.
                </div>
            </div>
        </div>
    </div>
@endsection
