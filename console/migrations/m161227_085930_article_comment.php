<?php

use yii\db\Migration;

class m161227_085930_article_comment extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%article_comment}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'content' => 'varchar(100) NOT NULL DEFAULT \'\'',
            'create_by' => 'int(11) NOT NULL DEFAULT \'0\'',
            'user_id' => 'int(11) NOT NULL DEFAULT \'0\'',
            'article_id' => 'int(11) NOT NULL DEFAULT \'0\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        $this->createIndex('fk_core_article_comment_core_user1_idx','{{%article_comment}}','user_id',0);
        $this->createIndex('fk_core_article_comment_core_article1_idx','{{%article_comment}}','article_id',0);
        
        
        /* 表数据 */
        $this->insert('{{%article_comment}}',['id'=>'1','content'=>'sdfsdf','create_by'=>'0','user_id'=>'28','article_id'=>'668']);
        $this->insert('{{%article_comment}}',['id'=>'2','content'=>'dfgdfg','create_by'=>'1482750512','user_id'=>'28','article_id'=>'629']);
        $this->insert('{{%article_comment}}',['id'=>'3','content'=>'dfgfdg','create_by'=>'1482800834','user_id'=>'28','article_id'=>'663']);
        $this->insert('{{%article_comment}}',['id'=>'4','content'=>'发的鬼地方个','create_by'=>'1482805917','user_id'=>'28','article_id'=>'632']);
        $this->insert('{{%article_comment}}',['id'=>'5','content'=>'奋斗的','create_by'=>'1482805925','user_id'=>'28','article_id'=>'632']);
        $this->insert('{{%article_comment}}',['id'=>'6','content'=>'dfgfdg','create_by'=>'1482807990','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'7','content'=>'dfgdf ','create_by'=>'1482808035','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'8','content'=>'sdfsdf','create_by'=>'1482808416','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'9','content'=>'dfgfdg','create_by'=>'1482808452','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'10','content'=>'sdfdf','create_by'=>'1482808458','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'11','content'=>'sdfsdf','create_by'=>'1482808481','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'12','content'=>'fffff','create_by'=>'1482808486','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'13','content'=>'sdfsdf','create_by'=>'1482808521','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'14','content'=>'啦啦啦','create_by'=>'1482808569','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'15','content'=>'我是小当家','create_by'=>'1482808575','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'16','content'=>'我是第一','create_by'=>'1482809003','user_id'=>'28','article_id'=>'658']);
        $this->insert('{{%article_comment}}',['id'=>'17','content'=>'dfgfdg','create_by'=>'1482814984','user_id'=>'28','article_id'=>'662']);
        $this->insert('{{%article_comment}}',['id'=>'18','content'=>'好爱好哦','create_by'=>'1482820837','user_id'=>'1','article_id'=>'650']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%article_comment}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

