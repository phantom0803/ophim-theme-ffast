# THEME - FFAST 2022 - OPHIM CMS

## Demo
### Trang Chủ

![Alt text](https://i.ibb.co/Yd8c6c5/FFAST-INDEX.png "Home Page")

### Trang Danh Sách Phim

![Alt text](https://i.ibb.co/YhdfyBy/FFAST-CATALOG.png "Catalog Page")

### Trang Phim

![Alt text](https://i.ibb.co/R4hZSHv/FFAST-FILM.png "Film Page")

## Requirements
https://github.com/hacoidev/ophim-core

## Install
1. Tại thư mục của Project: `composer require ophimcms/theme-ffast`
2. Kích hoạt giao diện trong Admin Panel

## Update
1. Tại thư mục của Project: `composer update ophimcms/theme-ffast`
2. Re-Activate giao diện trong Admin Panel

## Note
- Một vài lưu ý quan trọng của các nút chức năng:
    + `Activate` và `Re-Activate` sẽ publish toàn bộ file js,css trong themes ra ngoài public của laravel.
    + `Reset` reset lại toàn bộ cấu hình của themes

## Document
### List
- Trang chủ: `display_label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_more_url|show_template (poster_1|poster_2|thumb_1|thumb_theater|top)`
    ```
    Phim mới cập nhật||is_copyright|0|updated_at|desc|12|/danh-sach/phim-moi|poster_1
    Phim chiếu rạp||is_shown_in_theater|1|updated_at|desc|10|/danh-sach/phim-chieu-rap|thumb_theater
    Phim bộ mới||type|series|created_at|desc|10|/danh-sach/phim-bo|thumb
    Phim lẻ mới||type|single|created_at|desc|10|/danh-sach/phim-le|thumb
    Bảng xếp hạng||is_copyright|0|view_week|desc|10|/danh-sach/phim-le|thumb_top
    Phim sắp chiếu||status|trailer|created_at|desc|7|/danh-sach/phim-sap-chieu|poster_2
    ```


### Custom View Blade
- File blade gốc trong Package: `/vendor/ophimcms/theme-ffast/resources/views/themeffast`
- Copy file cần custom đến: `/resources/views/vendor/themes/themeffast`
