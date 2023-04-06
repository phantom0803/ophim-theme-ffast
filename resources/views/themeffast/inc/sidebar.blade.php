<div class="related-block">
    <div id="sponsor-right" class="ff-banner hidden"></div>
    @foreach($movie_related as $movie)
        <div class="related-item">
            <a href="{{$movie->getUrl()}}">
                <img class="related-item-thumbnail"
                     src="{{$movie->getPosterUrl()}}"
                     data-src="{{$movie->getPosterUrl()}}"
                     alt="{{$movie->name}}">
            </a>
            <div class="related-item-meta">
                <a href="{{$movie->getUrl()}}">
                    <div class="related-item-title">{{$movie->name}}</div>
                </a>
                <span class="related-item-update">{{$movie->episode_current}}</span>
                <span class="related-item-views">{{ffast_format_view($movie->view_total)}} lượt xem</span>
            </div>
        </div>
    @endforeach
</div>
