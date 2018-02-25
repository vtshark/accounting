<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151422_suppliersDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%suppliers}}',
                           ["id", "name_full", "name_short"],
                            [
    [
        'id' => '1',
        'name_full' => 'ВКВ',
        'name_short' => 'ВКВ',
    ],
    [
        'id' => '2',
        'name_full' => 'Агат',
        'name_short' => 'Агат',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%suppliers}} CASCADE');
    }
}
