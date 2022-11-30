<?php

namespace Ophim\ThemeFfast;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeFfastServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        try {
            foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
                require_once $filename;
            }
        } catch (\Exception $e) {
            //throw $e;
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/ffast')
        ], 'ffast-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'ffast' => [
                'name' => 'Theme Ffast',
                'author' => 'opdlnf01@gmail.com',
                'package_name' => 'ophimcms/theme-ffast',
                'publishes' => ['ffast-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommendations Limit',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 9,
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_more_url|show_template (poster_1|poster_2|thumb_1|thumb_theater|top)',
                        'value' => <<<EOT
                        Phim mới cập nhật||is_copyright|0|updated_at|desc|12|/danh-sach/phim-moi|poster_1
                        Phim chiếu rạp||is_shown_in_theater|1|updated_at|desc|10|/danh-sach/phim-chieu-rap|thumb_theater
                        Phim bộ mới||type|series|created_at|desc|10|/danh-sach/phim-bo|thumb
                        Phim lẻ mới||type|single|created_at|desc|10|/danh-sach/phim-le|thumb
                        Bảng xếp hạng||is_copyright|0|view_week|desc|10|/danh-sach/phim-le|thumb_top
                        Phim sắp chiếu||status|trailer|created_at|desc|7|/danh-sach/phim-sap-chieu|poster_2
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <section class="bg-black collection">
                            <div class="tray-title has-background"><h5>bộ sưu tập</h5></div>
                            <div class="container">
                                <div class="tray">
                                    <div id="tu-khoa" class="tray-collection">
                                        <div class="grid-container grid-flow tray-poster tu-khoa">
                                            <div class="collection-item"><a href="/tu-khoa/disney-plus"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2021/03/08/a0d904ad483598b6_bcaf2bb0f6a9f95a_55737161520379431.jpg"
                                                        alt="Disney+"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/phim-kinh-dien"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2019/10/26/0c2f054dbbcc519e_f5ea1f644016067e_36993157209593121.jpg"
                                                        alt="phim kinh điển"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/phim-bom-tan"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2019/10/26/aa4cf62a8a41a8d0_a1bf98941af6ad02_40433157209595111.jpg"
                                                        alt="phim bom tấn"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/dc-comics"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2019/10/26/f0de54c9fa04599a_31bb313de0a7d8e2_46641157209606931.jpg"
                                                        alt="DC Comics"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/marvel"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2019/10/26/59cd8f092f6dd6fc_3aaacac701101d2a_49148157209609171.jpg"
                                                        alt="Marvel"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/phim-bom-xit"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2019/10/26/49b4e06978defb37_8c148f128dc8d81e_41562157209621361.jpg"
                                                        alt="phim bom xịt"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/phim-doat-giai-oscar"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2020/12/21/910d5cd341d55be1_e1c9d72b3465ab77_9058160852063491.jpg"
                                                        alt="phim đoạt giải oscar"></a>
                                            </div>
                                            <div class="collection-item"><a href="/tu-khoa/netflix-original"
                                                                            class="grid-item img-responsive"><img
                                                        src="https://s198.imacdn.com/ff/2020/04/25/24875423cf93c11c_7d846b3e82c05490_29652158779284741.jpg"
                                                        alt="Netflix Original"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tray">
                                    Xem phim online miễn phí chất lượng cao với phụ đề tiếng việt - thuyết minh - lồng tiếng. Mọt phim có nhiều thể loại phim phong phú, đặc sắc, nhiều bộ phim hay nhất - mới nhất.<br />
                                    Website với giao diện trực quan, thuận tiện, tốc độ tải nhanh, thường xuyên cập nhật các bộ phim mới hứa hẹn sẽ đem lại những trải nghiệm tốt cho người dùng.
                                </div>
                            </div>
                        </section>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
