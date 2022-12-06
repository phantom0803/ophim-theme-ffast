@extends('themes::themeffast.layout')

@push('header')
    <link rel="stylesheet" href="/themes/ffast/css/film.css">
@endpush

@section('content')
    <div class="container">
        <div class="player-wrapper" id="player-wrapper">
            @if(!$episode || $episode->link == "")
                <div style="background-image: url('{{$currentMovie->poster_url ?: $currentMovie->thumb_url}}'); background-size: cover;" class="player-error-display">
                    <div style="background: #000000cf;width: 100%;height: 100%">
                        <i class="icon-alert"></i><span class="player-error-message">Phim đang được cập nhật</span>
                    </div>
                </div>
            @endif
        </div>
        @include('themes::themeffast.inc.sidebar')
        @include('themes::themeffast.inc.film_info')
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

    <script src="/themes/ffast/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/ffast/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        jQuery(document).ready(function () {
            jQuery('html, body').animate({
                scrollTop: jQuery('#player-wrapper').offset().top
            }, 'slow');
        });
    </script>

    @if ($episode  && $episode->link != "")
        <script>
            var episode_id = {{$episode->id}};
            const wrapper = document.getElementById('player-wrapper');
            const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

            function chooseStreamingServer(el) {
                const type = el.dataset.type;
                const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
                const id = el.dataset.id;

                const newUrl =
                    location.protocol +
                    "//" +
                    location.host +
                    location.pathname.replace(`-${episode_id}`, `-${id}`);

                history.pushState({
                    path: newUrl
                }, "", newUrl);
                episode_id = id;


                Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                    server.classList.remove('active');
                })
                el.classList.add('active');

                renderPlayer(type, link, id);
            }

            function renderPlayer(type, link, id) {
                if (type == 'embed') {
                    if (vastAds) {
                        wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                        const fake_player = jwplayer("fake_jwplayer");
                        const objSetupFake = {
                            key: "{{ Setting::get('jwplayer_license') }}",
                            aspectratio: "16:9",
                            width: "100%",
                            file: "/themes/ffast/player/1s_blank.mp4",
                            volume: 100,
                            mute: false,
                            autostart: true,
                            advertising: {
                                tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                                client: "vast",
                                vpaidmode: "insecure",
                                skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                                skipmessage: "Bỏ qua sau xx giây",
                                skiptext: "Bỏ qua"
                            }
                        };
                        fake_player.setup(objSetupFake);
                        fake_player.on('complete', function (event) {
                            jQuery("#fake_jwplayer").remove();
                            wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                            fake_player.remove();
                        });

                        fake_player.on('adSkipped', function (event) {
                            jQuery("#fake_jwplayer").remove();
                            wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                            fake_player.remove();
                        });

                        fake_player.on('adComplete', function (event) {
                            jQuery("#fake_jwplayer").remove();
                            wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                            fake_player.remove();
                        });
                    } else {
                        if (wrapper) {
                            wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        }
                    }
                    return;
                }

                if (type == 'm3u8' || type == 'mp4') {
                    wrapper.innerHTML = `<div id="jwplayer"></div>`;
                    const player = jwplayer("jwplayer");
                    const objSetup = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        image: "{{ $currentMovie->poster_url ?: $currentMovie->thumb_url }}",
                        file: link,
                        playbackRateControls: true,
                        playbackRates: [0.25, 0.75, 1, 1.25],
                        sharing: {
                            sites: [
                                "reddit",
                                "facebook",
                                "twitter",
                                "googleplus",
                                "email",
                                "linkedin",
                            ],
                        },
                        volume: 100,
                        mute: false,
                        autostart: true,
                        logo: {
                            file: "{{ Setting::get('jwplayer_logo_file') }}",
                            link: "{{ Setting::get('jwplayer_logo_link') }}",
                            position: "{{ Setting::get('jwplayer_logo_position') }}",
                        },
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };

                    if (type == 'm3u8') {
                        const segments_in_queue = 50;

                        var engine_config = {
                            debug: !1,
                            segments: {
                                forwardSegmentCount: 50,
                            },
                            loader: {
                                cachedSegmentExpiration: 864e5,
                                cachedSegmentsCount: 1e3,
                                requiredSegmentsPriority: segments_in_queue,
                                httpDownloadMaxPriority: 9,
                                httpDownloadProbability: 0.06,
                                httpDownloadProbabilityInterval: 1e3,
                                httpDownloadProbabilitySkipIfNoPeers: !0,
                                p2pDownloadMaxPriority: 50,
                                httpFailedSegmentTimeout: 500,
                                simultaneousP2PDownloads: 20,
                                simultaneousHttpDownloads: 2,
                                // httpDownloadInitialTimeout: 12e4,
                                // httpDownloadInitialTimeoutPerSegment: 17e3,
                                httpDownloadInitialTimeout: 0,
                                httpDownloadInitialTimeoutPerSegment: 17e3,
                                httpUseRanges: !0,
                                maxBufferLength: 300,
                                // useP2P: false,
                            },
                        };
                        if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                            var engine = new p2pml.hlsjs.Engine(engine_config);
                            player.setup(objSetup);
                            jwplayer_hls_provider.attach();
                            p2pml.hlsjs.initJwPlayer(player, {
                                liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                                maxBufferLength: 300,
                                loader: engine.createLoaderClass(),
                            });
                        } else {
                            player.setup(objSetup);
                        }
                    } else {
                        player.setup(objSetup);
                    }


                    const resumeData = 'OPCMS-PlayerPosition-' + id;
                    player.on('ready', function () {
                        if (typeof (Storage) !== 'undefined') {
                            if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                                console.log("No cookie for position found");
                                var currentPosition = 0;
                            } else {
                                if (localStorage[resumeData] == "null") {
                                    localStorage[resumeData] = 0;
                                } else {
                                    var currentPosition = localStorage[resumeData];
                                }
                                console.log("Position cookie found: " + localStorage[resumeData]);
                            }
                            player.once('play', function () {
                                console.log('Checking position cookie!');
                                console.log(Math.abs(player.getDuration() - currentPosition));
                                if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                    5) {
                                    player.seek(currentPosition);
                                }
                            });
                            window.onunload = function () {
                                localStorage[resumeData] = player.getPosition();
                            }
                        } else {
                            console.log('Your browser is too old!');
                        }
                    });

                    player.on('complete', function () {
                        if (typeof (Storage) !== 'undefined') {
                            localStorage.removeItem(resumeData);
                        } else {
                            console.log('Your browser is too old!');
                        }
                    })

                    function formatSeconds(seconds) {
                        var date = new Date(1970, 0, 1);
                        date.setSeconds(seconds);
                        return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                    }
                }
            }
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const episode = '{{$episode->id}}';
                let playing = document.querySelector(`[data-id="${episode}"]`);
                if (playing) {
                    playing.click();
                    return;
                }

                const servers = document.getElementsByClassName('streaming-server');
                if (servers[0]) {
                    servers[0].click();
                }
            });
        </script>

        <script>
            $('.film-report').on('click', function() {
                fetch("{{ route('episodes.report', ['movie' => $currentMovie->slug, 'episode' => $episode->slug, 'id' => $episode->id]) }}", {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        message: ''
                    })
                }).then((response) => {
                    $(this).remove();
                    alert("Báo cáo của bạn đã được gửi đi!");
                });
            })
        </script>
    @endif
    <link href="{{ asset('/themes/ffast/libs/jquery-raty/jquery.raty.css') }}" rel="stylesheet"/>
    <script src="{{ asset('/themes/ffast/libs/jquery-raty/jquery.raty.js') }}"></script>

    <script src="{{ asset('/themes/ffast/js/film.js') }}"></script>
    <script>
        var rated = false;
        jQuery(document).ready(function ($) {
            $('#star').raty({
                number: 10,
                starHalf: '/themes/ffast/libs/jquery-raty/images/star-half.png',
                starOff: '/themes/ffast/libs/jquery-raty/images/star-off.png',
                starOn: '/themes/ffast/libs/jquery-raty/images/star-on.png',
                click: function (score, evt) {
                    if (!rated) {
                        $.ajax({
                            url: '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}',
                            data: JSON.stringify({
                                rating: score
                            }),
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            type: 'post',
                            dataType: 'json',
                            success: function (res) {
                                alert("Đánh giá của bạn đã được gửi đi!");
                                rated = true;
                            }
                        });
                    }
                }
            });
        })
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
