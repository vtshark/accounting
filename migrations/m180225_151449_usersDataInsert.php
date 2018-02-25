<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151449_usersDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%users}}',
                           ["id", "login", "password"],
                            [
    [
        'id' => '1',
        'login' => 'admin',
        'password' => '123',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%users}} CASCADE');
    }
}
