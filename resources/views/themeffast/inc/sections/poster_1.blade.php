<div class="container">
    <section class="tray index episode">
        <div class="tray-title">
            <span class="icon icon-cinema"></span>
            <h5>
                <a href="{{$item['link']}}">{{$item['label']}}</a>
            </h5>
            <a href="{{$item['link']}}" class="more">Xem tất cả &nbsp; <i
                    class="icon icon-film-none"></i>
            </a>
        </div>
        <div class="tray-content carousel index">
            @foreach($item['data'] as $movie)
                <div class="tray-item">
                    <a href="{{$movie->getUrl()}}">
                        <img class="tray-item-thumbnail"
                             src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                             data-src="{{$movie->poster_url ?: $movie->thumb_url}}"
                             alt="{{$movie->name}} {{$movie->episode_current}}">
                        <div class="tray-item-description">
                            <div class="tray-episode-name">{{$movie->episode_current}}</div>
                            <div class="tray-item-title">{{$movie->name}}</div>
                        </div>
                        <div class="tray-item-audio"></div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
