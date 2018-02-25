<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151320_prod_namesDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%prod_names}}',
                           ["id", "name"],
                            [
    [
        'id' => '1',
        'name' => 'Кольцо',
    ],
    [
        'id' => '2',
        'name' => 'Серьги',
    ],
    [
        'id' => '3',
        'name' => 'Браслет',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%prod_names}} CASCADE');
    }
}
