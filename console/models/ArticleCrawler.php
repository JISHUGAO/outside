<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/14 0014
 * Time: 14:40
 */

namespace console\models;


class ArticleCrawler extends BaseCrawler
{
    public $client;
    public $urlSet;
    public $rules;
    public $list = [];
    public $today;
    public $categoryId;
    public $channelId;

    public function __construct($urlSet, $rules, $categoryId, $channelId)
    {
        $this->client = static::getClient();
        $this->urlSet = is_string($urlSet) ? [$urlSet] : $urlSet;
        $this->rules = $rules;
        $this->today = date('Y-m-d');
        $this->categoryId = $categoryId;
        $this->channelId = $channelId;
    }

    public function getArticleDetails()
    {
        try {
            foreach ($this->urlSet as $url) {
                $this->getContent($url);
            }
        } catch (\Exception $e) {
            //echo "error\n";
            echo $e->getFile()."\n";
            echo $e->getLine()."\n";
            echo $e->getMessage()."\n";
            exit(1);
        }

        return $this->list;
    }


    protected function getContent($url, $pager = 1)
    {
        $isContinue = true;
        $fullUrl = $url.'/'.$pager.'.shtml';
        $crawler = $this->client->request('Get', $fullUrl);
        if ($crawler) {
            //var_dump($crawler->html());die;
            $c = $crawler->filter($this->rules['list_rule']['list']);
            //遍历本页
            $c->each(function ($node) use (&$isContinue, $url, $pager) {
                if (!$isContinue) {
                    return '';
                }
                $publishTime = $node->filter($this->rules['list_rule']['datetime_rule'])->text();
                if ($publishTime) {
                    list($date, $time) = explode(' ', $publishTime);
                    $isContinue = $this->today == date('Y-m-d', strtotime($date)) ? true : false;
                    if (!$isContinue) {
                        return '';
                    }
                }
                $href = $node->filter($this->rules['list_rule']['title'])->attr('href');
                $article = [
                    'title' => $node->filter($this->rules['list_rule']['title'])->text(),
                    'description' => '',
                    'content' => '',
                    'sort' => 0,
                    'category_id' => $this->categoryId,
                    'channel_id' => $this->channelId,
                ];
                if ($href) {
                    $article['crawl_source_url'] = $href;
                    $client = self::getClient();
                    $crawler = $client->request('Get', $href);
                    $httpCode = $client->getResponse()->getStatus();
                    if ($httpCode < 200 && $httpCode >= 300) {
                        //页面返回状态不正确，直接返回
                        return;
                    }

                    $count = $crawler->filter($this->rules['detail_rule']['content'])->count();
                    if ($count) {
                        $content = $crawler->filter($this->rules['detail_rule']['content'])->html();
                        //$output = iconv('utf-8', 'gbk//IGNORE', $output);
                        $article['description'] = mb_substr(strip_tags($content), 0, 50);
                        $article['content'] = $content;
                        $article['source_name'] = $crawler->filter($this->rules['detail_rule']['source'])->text();
                        $article['source_url'] = $crawler->filter($this->rules['detail_rule']['source'])->attr('href');
                    }
                }
                //var_dump($article);die;
                $this->list[] = $article;
            });

            if ($isContinue) {
                $this->getContent($url, 2);
            }
        }

        return $isContinue;
    }
}