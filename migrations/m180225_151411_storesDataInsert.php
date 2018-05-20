<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151411_storesDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%stores}}',
            ["id", "name", "status", "store_type_id"],
            [
                [
                    'id' => '1',
                    'name' => 'Временный',
                    'status' => '1',
                    'store_type_id' => \app\models\StoreTypes::TMP_TYPE_ID,
                ],
                [
                    'id' => '2',
                    'name' => 'Склад-Киев',
                    'status' => '1',
                    'store_type_id' => \app\models\StoreTypes::DEFAULT_TYPE_ID,
                ],
                [
                    'id' => '3',
                    'name' => 'Склад-Донецк',
                    'status' => '1',
                    'store_type_id' => \app\models\StoreTypes::DEFAULT_TYPE_ID,
                ],
                [
                    'id' => '4',
                    'name' => 'Ашан',
                    'status' => '1',
                    'store_type_id' => \app\models\StoreTypes::STORE_TYPE_ID,
                ],
                [
                    'id' => '5',
                    'name' => 'Марио',
                    'status' => '1',
                    'store_type_id' => \app\models\StoreTypes::STORE_TYPE_ID,
                ],
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%stores}} CASCADE');
    }
}
