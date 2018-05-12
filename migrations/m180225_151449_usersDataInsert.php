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

    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->batchInsert('{{%users}}',
                           ["id", "username", "password"],
                            [
    [
        'id' => '1',
        'username' => 'admin',
        'password' => Yii::$app->security->generatePasswordHash("123"),
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%users}} CASCADE');
    }
}
