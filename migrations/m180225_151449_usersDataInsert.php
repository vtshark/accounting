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
                           ["id", "username", "password"],
                            [
    [
        'id' => '1',
        'username' => 'admin',
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
