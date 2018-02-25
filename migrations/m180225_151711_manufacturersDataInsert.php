<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151711_manufacturersDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%manufacturers}}',
                           ["id", "name"],
                            [
    [
        'id' => '1',
        'name' => 'ВКВ',
    ],
    [
        'id' => '2',
        'name' => 'Камея',
    ],
    [
        'id' => '3',
        'name' => 'Агат',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%manufacturers}} CASCADE');
    }
}
