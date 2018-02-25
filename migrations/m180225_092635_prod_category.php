<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092635_prod_category extends Migration
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
            '{{%prod_category}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%prod_category}}');
    }
}
