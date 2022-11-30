<div class="film-info">
    <div class="film-info-header">
        @if($episode && $episode->link != "")
            <div class="film-info-action">
                @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                    <a data-id="{{ $server->id }}" data-link="{{ $server->link }}" data-type="{{ $server->type }}"
                       onclick="chooseStreamingServer(this)" class="film-info-server streaming-server">
                        <i class="icon icon-action icon-play"></i>
                        <span>Server #{{ $loop->index + 1 }}</span>
                    </a>
                @endforeach
            </div>
            <div class="film-report">
                <i class="icon icon-help"></i>
                Báo lỗi
            </div>
        @endif
        @if($episode && $episode->name != "")
            <h1 class="film-info-title">{{ $currentMovie->name }} {{ strpos(strtolower($episode->name), 'tập') ? $episode->name : "Tập {$episode->name}" }}</h1>
        @else
            <h1 class="film-info-title">{{ $currentMovie->name }}</h1>
        @endif
        <div class="film-info-views">
            <span class="hidden-sx">Lượt xem: {{ ffast_format_view($currentMovie->view_total) }} </span>
            <span class="display-sx">{{ ffast_format_view($currentMovie->view_total) }} xem</span>
        </div>
        <div class="film-raty">
            <input id="hint_current" type="hidden" value=""/>
            <input id="score_current" type="hidden" value="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"/>
            <div id="star" data-score="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"
                 style="cursor: pointer;"></div>
            <span id="hint"></span>
            <div id="div_average" style="">
                (<span class="average" id="average">{{ number_format($currentMovie->rating_star ?? 0, 1) }}</span>
                đ/<span id="rate_count"> / {{ $currentMovie->rating_count ?? 0 }}</span> lượt)
            </div>
            <span class="hidden" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="{{ number_format($currentMovie->rating_star ?? 0, 1) }}"/>
                <meta itemprop="ratingcount" content="{{ $currentMovie->rating_count ?? 0 }}"/>
                <meta itemprop="bestRating" content="10"/>
                <meta itemprop="worstRating" content="1"/>
            </span>
        </div>

    </div>
    <div class="film-info-tab">
        <div class="info-tab-item tab-information {{ !$episode ? 'activated' : '' }}">Thông tin</div>
        <div
            class="info-tab-item tab-episode {{ $episode ? 'activated' : '' }}">{{ $episode ? 'Danh sách tập' : '' }}</div>
        <div class="info-tab-item tab-comment">Bình luận</div>
    </div>
    <div class="film-content {{ !$episode ? '' : 'hidden' }}">
        <div class="film-info-genre">
            Quốc gia:
            {!! $currentMovie->regions->map(function ($region) {
                    return '<a href="' .
                        $region->getUrl() .
                        '" title="' .
                        $region->name .
                        '" rel="region tag">' .
                        $region->name .
                        '</a>';
                })->implode(', ') !!}
        </div>
        <div class="film-info-genre">
            Năm phát hành: {{ $currentMovie->publish_year }}
        </div>
        <div class="film-info-genre">
            Chất lượng:
            {{ $currentMovie->quality }}
        </div>
        <div class="film-info-genre">
            Âm thanh:
            {{ $currentMovie->language }}
        </div>
        <div class="film-info-genre">
            Cập nhật:
            {{ $currentMovie->episode_current }}
        </div>
        <div class="film-info-genre">Tên khác: {{ $currentMovie->origin_name }}</div>
        <div class="film-info-genre">
            Thể loại:
            {!! $currentMovie->categories->map(function ($category) {
                                            return '<a href="' .
                                                $category->getUrl() .
                                                '" title="' .
                                                $category->name .
                                                '" rel="category tag">' .
                                                $category->name .
                                                '</a>';
                                        })->implode(', ') !!}
        </div>
        <div class="film-info-genre">
            Đạo diễn:
            {!! $currentMovie->directors->map(function ($director) {
                                            return '<a href="' .
                                                $director->getUrl() .
                                                '" title="' .
                                                $director->name .
                                                '" rel="director tag">' .
                                                $director->name .
                                                '</a>';
                                        })->implode(', ') !!}
        </div>
        <div class="film-info-genre">
            Diễn viên:
            {!! $currentMovie->actors->map(function ($actor) {
                                            return '<a href="' .
                                                $actor->getUrl() .
                                                '" title="' .
                                                $actor->name .
                                                '" rel="actor tag">' .
                                                $actor->name .
                                                '</a>';
                                        })->implode(', ') !!}
        </div>
        <div class="film-info-description">
            {!! $currentMovie->content !!}
        </div>
        <div class="film-info-tag">
            @foreach ($currentMovie->tags as $tag)
                <span><a href="{{ $tag->getUrl() }}" rel="tag">{{ $tag->name }}</a></span>
            @endforeach
        </div>
    </div>

    <div class="film-episode {{ $episode ? '' : 'hidden' }}">
        <div class="episode-list-header">
            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                <div
                    class="episode-group-tab tab-{{$loop->index}} {{$episode->server == $server ? 'activated' : ''}}"
                    data-tab="{{$loop->index}}">
                    {{$server}}
                </div>
            @endforeach
        </div>
        <div class="episode-list">
            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
                <div
                    class="episode-group group-{{$loop->index}} {{$episode->server == $server ? '' : 'hidden'}}"
                    data-group="{{$loop->index}}">
                    @foreach ($data->sortByDesc('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                        <a class="episode-item episode-{{$item->sortByDesc('type')->first()->id}} {{$episode->server == $item->first()->server && $episode->slug == $item->first()->slug ? 'activated' : ''}}"
                           href="{{ $item->sortByDesc('type')->first()->getUrl() }}">
                            <span
                                class="episode-name">{{ (strpos(strtolower($name), 'tập')) ? $name : 'Tập ' . $name }}</span>
                            <span class="episode-detail-name">{{$server}}</span>
                            <div class="episode-play"><i class="icon-play"></i></div>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <div class="film-comment hidden">
        <div id="comments" class="extcom">
            <div class="fb-comments" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                 data-colorscheme="dark" data-numposts="5" data-order-by="reverse_time" data-lazy="true"></div>
        </div>
    </div>
</div>
