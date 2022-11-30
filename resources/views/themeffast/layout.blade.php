@extends('themes::layout')

@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Ophim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp
@push('header')
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap&subset=vietnamese"
          rel="stylesheet">
@endpush

@section('body')
    @include('themes::themeffast.inc.header')
    @if (get_theme_option('ads_header'))
        <div class="container">
            <div id="sponsor-header" class="banner-masthead hidden">
                {!! get_theme_option('ads_header') !!}
            </div>
        </div>
    @endif

    @yield('content')
@endsection


@section('footer')
    {!! get_theme_option('footer') !!}
    <div class="modal-trailer">
        <div class="modal-trailer-content">
            <div class="modal-trailer-close"><i class="icon-close"></i></div>
            <div class="loading"></div>
            <div class="modal-player"></div>
            <div class="modal-info"></div>
        </div>
    </div>
    <div class="floating-action">
        <div class="action-item action-toggle"><i class="icon-assistive"></i></div>
        <div class="action-item action-home"><i class="icon-home"></i></div>
        <div class="action-item action-menu"><i class="icon-menu"></i></div>
        <div class="action-item action-top"><i class="icon-up"></i></div>
    </div>
    @if (get_theme_option('ads_catfish'))
        {!! get_theme_option('ads_catfish') !!}
    @endif
    {!! setting('site_scripts_google_analytics') !!}
@endsection

@push('scripts')
    <script>
        var _GLOBAL_URL = "{{ request()->root() }}"
    </script>
    <script type="text/javascript" src="/themes/ffast/js/bhome.js"></script>
@endpush
