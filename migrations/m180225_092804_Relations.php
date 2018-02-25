<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092804_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_stores_store_type_id',
            '{{%stores}}','store_type_id',
            '{{%store_types}}','id',
            'SET NULL','NO ACTION'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_stores_store_type_id', '{{%stores}}');
    }
}
