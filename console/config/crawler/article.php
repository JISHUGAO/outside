<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 10:48
 */
return [
    'crawler.channel' => [
        [
            'name' => '参考消息',
            'channel_id' => 1,
            'url' => 'http://www.cankaoxiaoxi.com',
            'category_url' => [
                [
                    'category_id' => 1,
                    'urls' => [
                        //国内新闻
                        'http://www.cankaoxiaoxi.com/china/szyw/',//时事要闻
                        'http://www.cankaoxiaoxi.com/china/zgwj/', //外交
                        'http://www.cankaoxiaoxi.com/china/shwx/', // 社会
                    ]
                ],
                [
                    'category_id' => 2,
                    'urls' => [
                        //国际信息
                        'http://www.cankaoxiaoxi.com/world/ytxw/', //亚太
                        'http://www.cankaoxiaoxi.com/world/omxw/', //欧美
                    ]
                ],
                [
                    'category_id' => 3,
                    'urls' => [
                        //军事
                        'http://www.cankaoxiaoxi.com/mil/zgjq/', //中国军情
                        'http://www.cankaoxiaoxi.com/mil/gjjq/', //国际军情
                        'http://www.cankaoxiaoxi.com/mil/wqzb/', //军事装备
                    ]
                ],
                [
                    'category_id' => 4,
                    'urls' => [
                        //财经
                        'http://www.cankaoxiaoxi.com/finance/zgcj/', //中国财经
                        'http://www.cankaoxiaoxi.com/finance/gjcj/', //国际财经
                        'http://www.cankaoxiaoxi.com/finance/sygs/', //商业信息
                    ]
                ],
                [
                    'category_id' => 5,
                    'urls' => [
                        //科技
                        'http://www.cankaoxiaoxi.com/science/jksh/', //健康生活
                        'http://www.cankaoxiaoxi.com/science/tsfx/', //探索发现
                        'http://www.cankaoxiaoxi.com/science/ITyj/', //IT业界
                    ]
                ],

            ],
            'crawl_rule' => [
                'list_rule' => [
                    'list' =>'div.column .inner .txt-list-a li:not(.hr-h10)',
                    'datetime_rule' => 'span.f-r',
                    'title' => 'a'
                ],
                'detail_rule' => [
                    'source' => '#source_baidu a',
                    'content' => '#ctrlfscont'
                ]

            ]
        ]
    ]
];