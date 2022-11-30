<section class="cinema bg-black">
    <div class="tray-title has-background">
        <h5>
            <a href="{{$item['link']}}">{{$item['label']}}</a>
        </h5>
        <a href="{{$item['link']}}">
            <span class="mark mark-popcorn icon icon-popcorn"></span>
        </a>
    </div>
    <div class="cinema-container">
        <div id="phim-chieu-rap" class="cinema-content">
            <div class="grid-container grid-flow tray-poster phim-chieu-rap">
                @foreach($item['data'] as $movie)
                    <div class="cinema-item">
                        <a href="{{$movie->getUrl()}}" class="card card-inset">
                            <div class="card-image img-responsive">
                                <img src="{{$movie->thumb_url}}" alt="{{$movie->name}}">
                                <div class="solid">
                                    <span class="icon icon-play-png"></span>
                                </div>
                            </div>
                            <div class="card-content bg-gradient">
                                <p style="margin-bottom: 10px;">
                                    <label class="label label-main label-xs">{{$movie->quality}}</label>
                                    <span class="pull-right" style="font-size: 15px; color: rgb(255, 255, 255);">
                                            <i class="icon-star" style="color: rgb(232, 145, 5);"></i> {{number_format($movie->rating_star ?? 0, 1)}}/10 </span>
                                </p>
                                <h3 class="title">{{$movie->name}}</h3>
                                <p class="subtitle text-inline">
                                    @foreach($movie->categories as $category)
                                        <span class="text-inline-item">{{$category->name}}</span>
                                    @endforeach
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
