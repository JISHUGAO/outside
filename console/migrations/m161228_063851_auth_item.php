<?php

use yii\db\Migration;

class m161228_063851_auth_item extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%auth_item}}', [
            'name' => 'varchar(64) NOT NULL',
            'type' => 'int(11) NOT NULL',
            'description' => 'text NULL',
            'rule_name' => 'varchar(64) NULL',
            'data' => 'text NULL',
            'created_at' => 'int(11) NULL',
            'updated_at' => 'int(11) NULL',
            'PRIMARY KEY (`name`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        
        /* 索引设置 */
        $this->createIndex('rule_name','{{%auth_item}}','rule_name',0);
        $this->createIndex('idx-auth_item-type','{{%auth_item}}','type',0);
        
        /* 外键约束设置 */
        $this->addForeignKey('fk_auth_rule_8918_00','{{%auth_item}}', 'rule_name', '{{%auth_rule}}', 'name', 'CASCADE', 'CASCADE' );
        
        /* 表数据 */
        $this->insert('{{%auth_item}}',['name'=>'admin','type'=>'1','description'=>NULL,'rule_name'=>NULL,'data'=>NULL,'created_at'=>'1481509668','updated_at'=>'1481509668']);
        $this->insert('{{%auth_item}}',['name'=>'article/index','type'=>'2','description'=>'Create a post','rule_name'=>NULL,'data'=>NULL,'created_at'=>'1481508420','updated_at'=>'1481508420']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_item}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

