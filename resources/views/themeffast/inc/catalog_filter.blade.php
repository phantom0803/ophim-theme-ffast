<div class="filterMovies">
    <form id="form-search" class="filterForm" method="GET" action="/">
        <div class="filterItems">
            <select class="filterSelect" id="category" name="filter[category]" form="form-search">
                <option value="">Tất cả thể loại</option>
                @foreach (\Ophim\Core\Models\Category::fromCache()->all() as $item)
                    <option value="{{ $item->id }}" @if ((isset(request('filter')['category']) && request('filter')['category'] == $item->id) ||
                            (isset($category) && $category->id == $item->id)) selected @endif>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filterItems">
            <select class="filterSelect" name="filter[region]" form="form-search">
                <option value="">Tất cả quốc gia</option>
                @foreach (\Ophim\Core\Models\Region::fromCache()->all() as $item)
                    <option value="{{ $item->id }}" @if ((isset(request('filter')['region']) && request('filter')['region'] == $item->id) ||
                            (isset($region) && $region->id == $item->id)) selected @endif>
                        {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="filterItems">
            <select class="filterSelect" name="filter[year]" form="form-search">
                <option value="">Tất cả năm</option>
                @foreach ($years as $year)
                    <option value="{{ $year }}"
                            @if (isset(request('filter')['year']) && request('filter')['year'] == $year) selected @endif>
                        {{ $year }}</option>
                @endforeach
            </select>
        </div>
        <div class="filterItems">
            <select class="filterSelect" id="sort" name="filter[sort]" form="form-search">
                <option value="">Sắp xếp</option>
                <option value="update"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'update') selected @endif>
                    Thời gian cập nhật
                </option>
                <option value="create"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'create') selected @endif>
                    Thời gian đăng
                </option>
                <option value="year"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'year') selected @endif>
                    Năm sản xuất
                </option>
                <option value="view"
                        @if (isset(request('filter')['sort']) && request('filter')['sort'] == 'view') selected @endif>
                    Lượt xem
                </option>
            </select>
        </div>
        <div class="filterItems">
            <select class="filterSelect" id="type" name="filter[type]" form="form-search">
                <option value="">Mọi định dạng</option>
                <option value="series"
                        @if (isset(request('filter')['type']) && request('filter')['type'] == 'series') selected @endif>
                    Phim bộ
                </option>
                <option value="single"
                        @if (isset(request('filter')['type']) && request('filter')['type'] == 'single') selected @endif>
                    Phim lẻ
                </option>
            </select>
        </div>
        <div class="filterItems">
            <button class="filterButtonSubmit" form="form-search" type="submit">Lọc Phim</button>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
