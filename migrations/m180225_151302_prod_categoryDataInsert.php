<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151302_prod_categoryDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%prod_category}}',
                           ["id", "name"],
                            [
    [
        'id' => '1',
        'name' => 'Золото',
    ],
    [
        'id' => '2',
        'name' => 'Серебро',
    ],
    [
        'id' => '3',
        'name' => 'Золото/натур',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%prod_category}} CASCADE');
    }
}
