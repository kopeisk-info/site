<div class="card" style="width: 18rem;">
    <img src="" class="card-img-top" alt="">
    <div class="card-body">
        <div class="d-flex justify-content-start">
            <div class="card-photo">
                <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}">
                    <img src="{{ $photo }}" alt="{{ $name }}" class="rounded-circle">
                </a>
            </div>
            <div class="card-info" style="width: 100%; margin-left: 15px; overflow: hidden; text-overflow: ellipsis;">
                <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}" style="white-space: nowrap;">{{ $name }}</a>
                <div class="card-action" style="font-size: 13px; margin-top: 5px;">
                    <div class="d-flex justify-content-between">
                        <div>{{ $action }}</div>
                        <div>{{ $date->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <p class="card-text" style="padding-top: 10px;">{{ $text }}</p>
    </div>
</div>
