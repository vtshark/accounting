<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_151240_probeDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%probe}}',
                           ["id"],
                            [
    [
        'id' => '1',
    ],
    [
        'id' => '375',
    ],
    [
        'id' => '500',
    ],
    [
        'id' => '585',
    ],
    [
        'id' => '925',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%probe}} CASCADE');
    }
}
