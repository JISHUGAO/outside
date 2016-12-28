<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 14:37
 */

namespace console\models;

use Yii;

class Article extends \common\models\Article
{
    public static function startCrawl()
    {
        $crawlerConfig = Yii::$app->params['crawler.channel'];
        $list = [];
        foreach ($crawlerConfig as $channel) {
            foreach ($channel['category_url'] as $category) {
                $articleCrawler = new ArticleCrawler(
                    $category['urls'],
                    $channel['crawl_rule'],
                    $category['category_id'],
                    $channel['channel_id']
                );
                $tmpList = $articleCrawler->getArticleDetails();
                $list = array_merge($list, $tmpList);

            }
        }

        foreach ($list as $item) {
            $model = static::getInstance();
            $model->scenario = Article::SCENARIO_CRAWL;
            $item['cover'] = self::extractCoverPicture($item['content']);
            $model->attributes = $item;
            $model->save();
        }
    }

    public static function extractCoverPicture($content)
    {
        $result = preg_match_all('/<img.*?src="(.*?)".*?>/', $content, $matches);
        if ($result && isset($matches[1][0])) {
            return $matches[1][0];
        }
        return '';
    }

}