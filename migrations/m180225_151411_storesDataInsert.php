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
                    'name' => 'Склад-Киев',
                    'status' => '1',
                    'store_type_id' => '2',
                ],
                [
                    'id' => '2',
                    'name' => 'Склад-Донецк',
                    'status' => '1',
                    'store_type_id' => '2',
                ],
                [
                    'id' => '3',
                    'name' => 'Ашан',
                    'status' => '1',
                    'store_type_id' => '1',
                ],
                [
                    'id' => '4',
                    'name' => 'Марио',
                    'status' => '1',
                    'store_type_id' => '1',
                ],
            ]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%stores}} CASCADE');
    }
}