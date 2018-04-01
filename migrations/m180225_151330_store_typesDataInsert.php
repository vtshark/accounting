<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151330_store_typesDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%store_types}}',
                           ["id", "name"],
                            [
    [
        'id' => '1',
        'name' => 'Временный',
    ],
    [
        'id' => '2',
        'name' => 'Склад',
    ],
    [
        'id' => '3',
        'name' => 'Магазин',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%store_types}} CASCADE');
    }
}
