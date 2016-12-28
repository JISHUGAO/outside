<?php

use yii\db\Migration;

class m161227_085931_user extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%user}}', [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'account' => 'varchar(45) NOT NULL DEFAULT \'\'',
            'password' => 'varchar(100) NOT NULL DEFAULT \'\'',
            'create_by' => 'int(11) NOT NULL DEFAULT \'0\'',
            'nickname' => 'varchar(45) NOT NULL DEFAULT \'\'',
            'login_times' => 'int(11) NOT NULL DEFAULT \'0\' COMMENT \'登录次数\'',
            'last_login_time' => 'datetime NULL COMMENT \'上次登录时间\'',
            'flag' => 'tinyint(4) NOT NULL DEFAULT \'0\' COMMENT \'管理员标记，1=管理员，0=前台会员\'',
            'avatar' => 'varchar(255) NOT NULL DEFAULT \'\' COMMENT \'头像\'',
            'gender' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'性别\'',
            'birthday' => 'int(11) NOT NULL DEFAULT \'0\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%user}}',['id'=>'1','account'=>'admin','password'=>'$2y$13$hZFQo0ZLCSwbg8UJrvx8Wer0PU8T48iaA.QiXHIbkEI3ducltld.2','create_by'=>'1482817425','nickname'=>'用户1482817425','login_times'=>'0','last_login_time'=>NULL,'flag'=>'1','avatar'=>'','gender'=>'0','birthday'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%user}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

