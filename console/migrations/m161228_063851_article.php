<?php

use yii\db\Migration;

class m161228_063851_article extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%article}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'title' => 'varchar(45) NOT NULL DEFAULT \'\'',
            'content' => 'text NULL COMMENT \'内容\'',
            'cover' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'封面\'',
            'create_by' => 'int(11) NOT NULL DEFAULT \'0\'',
            'category_id' => 'int(11) NOT NULL DEFAULT \'0\'',
            'description' => 'varchar(100) NOT NULL DEFAULT \'\' COMMENT \'文章描述\'',
            'source_name' => 'varchar(20) NOT NULL DEFAULT \'\' COMMENT \'来源名称\'',
            'source_url' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'文章来源url\'',
            'update_by' => 'timestamp NULL DEFAULT CURRENT_TIMESTAMP',
            'sort' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'排序\'',
            'view_count' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'查看次数\'',
            'comment_count' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'评论次数\'',
            'channel_id' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'渠道id\'',
            'crawl_source_url' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'抓取url\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='文章表'");
        
        /* 索引设置 */
        $this->createIndex('fk_core_article_core_category_idx','{{%article}}','category_id',0);
        
        
        /* 表数据 */
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%article}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

