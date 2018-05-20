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
        'id' => \app\models\StoreTypes::TMP_TYPE_ID,
        'name' => 'Временный',
    ],
    [
        'id' => \app\models\StoreTypes::DEFAULT_TYPE_ID,
        'name' => 'Склад',
    ],
    [
        'id' => \app\models\StoreTypes::STORE_TYPE_ID,
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
