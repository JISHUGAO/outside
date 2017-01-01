<?php

use yii\db\Migration;

class m161228_063851_menu extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%menu}}', [
            'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT \'文档ID\'',
            'title' => 'varchar(50) NOT NULL DEFAULT \'\' COMMENT \'标题\'',
            'pid' => 'int(10) unsigned NOT NULL COMMENT \'上级分类ID\'',
            'sort' => 'int(10) unsigned NOT NULL COMMENT \'排序（同级有效）\'',
            'url' => 'char(255) NOT NULL DEFAULT \'\' COMMENT \'链接地址\'',
            'hide' => 'tinyint(1) unsigned NOT NULL DEFAULT \'0\' COMMENT \'是否隐藏\'',
            'group' => 'varchar(50) NULL DEFAULT \'\' COMMENT \'分组\'',
            'status' => 'tinyint(1) NOT NULL DEFAULT \'0\' COMMENT \'状态\'',
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8");
        
        /* 索引设置 */
        $this->createIndex('pid','{{%menu}}','pid',0);
        $this->createIndex('status','{{%menu}}','status',0);
        
        
        /* 表数据 */
        $this->insert('{{%menu}}',['id'=>'1','title'=>'内容','pid'=>'0','sort'=>'0','url'=>'article/index','hide'=>'0','group'=>'','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'2','title'=>'用户','pid'=>'0','sort'=>'0','url'=>'user/admin','hide'=>'0','group'=>'','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'3','title'=>'系统','pid'=>'0','sort'=>'0','url'=>'system/index','hide'=>'0','group'=>'','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'4','title'=>'文章管理','pid'=>'1','sort'=>'0','url'=>'article/index','hide'=>'0','group'=>'文章管理|fa fa-file-text-o','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'5','title'=>'分类管理','pid'=>'1','sort'=>'0','url'=>'category/index','hide'=>'0','group'=>'文章管理|fa fa-file-text-o','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'6','title'=>'管理员管理','pid'=>'2','sort'=>'0','url'=>'user/admin','hide'=>'0','group'=>'后台用户|fa fa-user','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'7','title'=>'权限管理','pid'=>'2','sort'=>'0','url'=>'auth/index','hide'=>'0','group'=>'后台用户|fa fa-user','status'=>'0']);
        $this->insert('{{%menu}}',['id'=>'8','title'=>'前台用户','pid'=>'2','sort'=>'0','url'=>'user/index','hide'=>'0','group'=>'前台用户|fa fa-users','status'=>'0']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%menu}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

