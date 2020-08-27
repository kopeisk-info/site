<div class="card" style="margin: 15px 0;">
    @if ($image)
        <img src="{{ $image }}" class="card-img-top" alt="{{ $name }}">
    @endif
    <div class="card-body">
        <div class="d-flex justify-content-start">
            <div class="card-photo">
                <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}">
                    <img src="{{ $photo }}" alt="{{ $name }}" class="rounded-circle">
                </a>
            </div>
            <div class="card-info" style="width: 100%; margin-left: 15px; overflow: hidden; text-overflow: ellipsis;">
                <a href="{{ $from_link }}" class="card-title" target="_blank" title="{{ $name }}" style="white-space: nowrap;">{{ $name }}</a>
                <div style="font-size: 13px; margin-top: 5px;">{{ $date->diffForHumans() }}{{ $action ? ', '. $action : '' }}</div>
            </div>
        </div>
        <p class="card-text" style="padding-top: 10px;">{{ $text }}</p>
         @if ($repost)
            <div class="card" style="margin: 15px 0;">
                @if ($repost->image)
                    <img src="{{ $repost->image }}" class="card-img-top" alt="{{ $repost->name }}">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-start">
                        <div class="card-photo">
                            <a href="{{ $repost->from_link }}" class="card-title" target="_blank" title="{{ $repost->name }}">
                                <img src="{{ $repost->photo }}" alt="{{ $repost->name }}" class="rounded-circle">
                            </a>
                        </div>
                        <div class="card-info" style="width: 100%; margin-left: 15px; overflow: hidden; text-overflow: ellipsis;">
                            <a href="{{ $repost->from_link }}" class="card-title" target="_blank" title="{{ $repost->name }}" style="white-space: nowrap;">{{ $repost->name }}</a>
                            <div style="font-size: 13px; margin-top: 5px;">{{ $date->diffForHumans() }}{{ $action ? ', '. $action : '' }}</div>
                        </div>
                    </div>
                    <p class="card-text" style="padding-top: 10px; font-size: 14px">{{ $repost->text }}</p>
                </div>
            </div>
        @endif
        <a href="{{ $post_link }}" target="_blank" title="Посмотреть во Вконтакте">подробнее</a>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-between" style="font-size: 13px">
            @if (!is_null($comments))
                <div>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chat" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                    </svg>
                    {{ $comments }}
                </div>
            @endif
                <div>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart" fill="#c00" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                    </svg>
                    {{ $likes }}
                </div>
            @if (!is_null($reposts))
                <div>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-reply" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9.502 5.013a.144.144 0 0 0-.202.134V6.3a.5.5 0 0 1-.5.5c-.667 0-2.013.005-3.3.822-.984.624-1.99 1.76-2.595 3.876C3.925 10.515 5.09 9.982 6.11 9.7a8.741 8.741 0 0 1 1.921-.306 7.403 7.403 0 0 1 .798.008h.013l.005.001h.001L8.8 9.9l.05-.498a.5.5 0 0 1 .45.498v1.153c0 .108.11.176.202.134l3.984-2.933a.494.494 0 0 1 .042-.028.147.147 0 0 0 0-.252.494.494 0 0 1-.042-.028L9.502 5.013zM8.3 10.386a7.745 7.745 0 0 0-1.923.277c-1.326.368-2.896 1.201-3.94 3.08a.5.5 0 0 1-.933-.305c.464-3.71 1.886-5.662 3.46-6.66 1.245-.79 2.527-.942 3.336-.971v-.66a1.144 1.144 0 0 1 1.767-.96l3.994 2.94a1.147 1.147 0 0 1 0 1.946l-3.994 2.94a1.144 1.144 0 0 1-1.767-.96v-.667z"/>
                    </svg>
                    {{ $reposts }}
                </div>
            @endif
                <div>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
                        <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                    {{ $views }}
                </div>
        </div>
    </div>
</div>
