<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092712_probe extends Migration
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
            '{{%probe}}',
            [
                'id'=> $this->primaryKey(3),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%probe}}');
    }
}
