@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<header>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a href="/" title="{{ $title }}" class="logo" rel="home">
                        @if ($logo)
                            {!! $logo !!}
                        @else
                            {!! $brand !!}
                        @endif
                    </a>
                </div>
                <div class="navbar-menu-toggle" id="navbar-toggle">
                    <i class="icon-menu"></i>
                </div>
            </div>
            <div class="navbar-left" id="navbar-left">
                <form method="GET" id="form-search" action="/" >
                    <div class="navbar-search">
                        <div class="search-box">
                            <input type="text" name="search" placeholder="Tìm kiếm phim..." value="{{ request('search') }}" autocomplete="off">
                            <i class="icon icon-search"></i>
                        </div>
                    </div>
                </form>
                <div class="navbar-menu">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                            <li class="navbar-menu-item navbar-menu-has-sub">
                                <a href="javascript:void(0);">
                                    <i class="icon icon-book"></i> {{ $item['name'] }} </a>
                                <ul class="navbar-submenu">
                                    @foreach ($item['children'] as $children)
                                        <li class="navbar-submenu-item">
                                            <a class="navbar-menu-ditem"
                                                href="{{ $children['link'] }}">{{ $children['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li class="navbar-menu-item">
                                <a href="{{ $item['link'] }}">
                                    <i class="icon icon-ribbon"></i> {{ $item['name'] }} </a>
                            </li>
                        @endif
                    @endforeach
                </div>
                <div class="navbar-close">
                    <i class="icon-close"></i>
                </div>
            </div>
        </div>
    </nav>
</header>
