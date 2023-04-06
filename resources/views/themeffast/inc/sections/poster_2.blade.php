<div class="container padding-10">
    <section class="tray index trailer">
        <div class="tray-title">
            <span class="icon icon-cinema"></span>
            <h5>
                <a href="{{$item['link']}}">{{$item['label']}}</a>
            </h5>
        </div>
        <div class="tray-content carousel">
            @foreach($item['data'] as $movie)
                @if($loop->first)
                    <div class="trailer-item" data-id="{{$movie->id}}">
                        <a href="{{$movie->getUrl()}}" class="card">
                            <div class="trailer-poster card-image img-responsive"><img
                                    src="{{$movie->getPosterUrl()}}"
                                    alt="{{$movie->name}}">
                                <div class="solid solid-visible"><span class="icon icon-play-o"></span></div>
                                <div class="solid"><span class="icon icon-play-png"></span></div>
                            </div>
                            <div class="card-content bg-gradient"></div>
                        </a>
                        <h3 class="trailer-title">{{$movie->name}}</h3>
                    </div>
                @else
                    <div class="trailer-item" data-id="{{$movie->id}}">
                        <a href="{{$movie->getUrl()}}" class="card">
                            <div class="trailer-poster card-image img-responsive"><img
                                    src="{{$movie->getPosterUrl()}}"
                                    alt="{{$movie->name}}">
                                <div class="solid solid-visible"><span class="icon icon-play-o-sm"></span></div>
                                <div class="solid"><span class="icon icon-play-png-sm"></span></div>
                            </div>
                        </a>
                        <h3 class="trailer-title">{{$movie->name}}</h3>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
</div>
