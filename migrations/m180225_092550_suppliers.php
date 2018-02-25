<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092550_suppliers extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%suppliers}}',
            [
                'id'=> $this->primaryKey(11),
                'name_full'=> $this->string(255)->null()->defaultValue(null),
                'name_short'=> $this->string(30)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%suppliers}}');
    }
}
