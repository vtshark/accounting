<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092533_users extends Migration
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
            '{{%users}}',
            [
                'id'=> $this->primaryKey(11),
                'login'=> $this->string(100)->null()->defaultValue(null),
                'password'=> $this->string(100)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
