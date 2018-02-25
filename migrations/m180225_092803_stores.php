<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092803_stores extends Migration
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
            '{{%stores}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->null()->defaultValue(null),
                'status'=> $this->integer(11)->null()->defaultValue(null),
                'store_type_id'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('store_type_id','{{%stores}}',['store_type_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('store_type_id', '{{%stores}}');
        $this->dropTable('{{%stores}}');
    }
}
