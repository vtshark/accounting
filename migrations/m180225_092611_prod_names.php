<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092611_prod_names extends Migration
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
            '{{%prod_names}}',
            [
                'id'=> $this->primaryKey(11),
                'name'=> $this->string(255)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%prod_names}}');
    }
}
