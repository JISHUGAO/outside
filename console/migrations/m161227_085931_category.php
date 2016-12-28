<?php

use yii\db\Migration;

class m161227_085931_category extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%category}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'name' => 'varchar(45) NOT NULL DEFAULT \'\'',
            'sort' => 'int(11) NOT NULL DEFAULT \'0\'',
            'is_show' => 'tinyint(1) NOT NULL DEFAULT \'1\' COMMENT \'是否显示，1=显示\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%category}}',['id'=>'1','name'=>'时事','sort'=>'1','is_show'=>'1']);
        $this->insert('{{%category}}',['id'=>'2','name'=>'国际','sort'=>'2','is_show'=>'1']);
        $this->insert('{{%category}}',['id'=>'3','name'=>'军事','sort'=>'3','is_show'=>'1']);
        $this->insert('{{%category}}',['id'=>'4','name'=>'财经','sort'=>'4','is_show'=>'1']);
        $this->insert('{{%category}}',['id'=>'5','name'=>'科技','sort'=>'5','is_show'=>'1']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%category}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

