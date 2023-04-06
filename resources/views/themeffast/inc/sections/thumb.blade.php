<div class="container">
    <section class="tray index">
        <div class="tray-title">
            <span class="icon icon-cinema"></span>
            <h5>
                <a href="{{$item['link']}}">{{$item['label']}}</a>
            </h5>
            <a href="{{$item['link']}}" class="more">Xem tất cả &nbsp; <i class="icon icon-film-none"></i>
            </a>
        </div>
        <div class="tray-content carousel">
            @foreach($item['data'] as $movie)
                <div class="tray-item" id="film-id-{{$movie->id}}">
                    <a href="{{$movie->getUrl()}}">
                        <img class="tray-item-thumbnail"
                             src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                             data-src="{{$movie->getThumbUrl()}}" alt="{{$movie->name}}">
                        <div class="tray-item-description">
                            <span class="tray-item-quality">{{$movie->quality}}</span>
                            <div class="tray-item-title">{{$movie->name}}</div>
                            <div class="tray-item-meta-info">
                                <div class="tray-film-views">{{ffast_format_view($movie->view_total)}} xem</div>
                                <div class="tray-film-likes">
                                    @if($movie->type == 'single')
                                        {{$movie->episode_time ?? 'N/A'}}
                                    @else
                                        {{$movie->episode_current }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tray-item-play-button">
                            <i class="icon-play"></i>
                        </div>
                        <div class="tray-item-audio">{{$movie->language}}</div>
                    </a>
                    @if($movie->trailer_url && $movie->trailer_url != "")
                        <div class="tray-item-trailer" data-id="{{$movie->id}}" title="Xem trailer">
                            <i class="icon-youtube"></i>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
</div>
