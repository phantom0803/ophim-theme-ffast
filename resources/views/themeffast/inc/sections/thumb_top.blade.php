<div class="container padding-10">
    <section class="tray index ranking">
        <div class="tray-title">
            <span class="icon icon-cinema"></span>
            <h5>
                <a href="{{$item['link']}}">{{$item['label']}}</a>
            </h5>
        </div>
        <div class="tray-content carousel">
            @foreach($item['data'] as $movie)
                <div class="ranking-item">
                    <a href="{{$movie->getUrl()}}">
                        <div class="ranking-item-thumbnail">
                            <img src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
                                 data-src="{{$movie->thumb_url}}" alt="{{$movie->name}}"></img>
                        </div>
                        <div class="ranking-item-top top{{$loop->index + 1}}">{{$loop->index + 1}}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</div>
