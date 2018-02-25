<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_110706_sizesDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%sizes}}',
                           ["size"],
                            [
    [
        'size' => '0',
    ],
    [
        'size' => '12',
    ],
    [
        'size' => '12.5',
    ],
    [
        'size' => '13',
    ],
    [
        'size' => '13.5',
    ],
    [
        'size' => '14',
    ],
    [
        'size' => '14.5',
    ],
    [
        'size' => '15',
    ],
    [
        'size' => '15.5',
    ],
    [
        'size' => '16',
    ],
    [
        'size' => '16.5',
    ],
    [
        'size' => '17',
    ],
    [
        'size' => '17.5',
    ],
    [
        'size' => '18',
    ],
    [
        'size' => '18.5',
    ],
    [
        'size' => '19',
    ],
    [
        'size' => '19.5',
    ],
    [
        'size' => '20',
    ],
    [
        'size' => '20.5',
    ],
    [
        'size' => '21',
    ],
    [
        'size' => '21.5',
    ],
    [
        'size' => '22',
    ],
    [
        'size' => '22.5',
    ],
    [
        'size' => '23',
    ],
    [
        'size' => '23.5',
    ],
    [
        'size' => '24',
    ],
    [
        'size' => '24.5',
    ],
    [
        'size' => '25',
    ],
    [
        'size' => '40',
    ],
    [
        'size' => '45',
    ],
    [
        'size' => '50',
    ],
    [
        'size' => '55',
    ],
    [
        'size' => '60',
    ],
    [
        'size' => '65',
    ],
    [
        'size' => '70',
    ],
    [
        'size' => '75',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%sizes}} CASCADE');
    }
}
