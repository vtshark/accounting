<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092947_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_invoice_transfer_store_id',
            '{{%invoice_transfer}}','store_id',
            '{{%stores}}','id',
            'SET NULL','NO ACTION'
         );
        $this->addForeignKey('fk_invoice_transfer_user_id',
            '{{%invoice_transfer}}','user_id',
            '{{%users}}','id',
            'SET NULL','NO ACTION'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_invoice_transfer_store_id', '{{%invoice_transfer}}');
        $this->dropForeignKey('fk_invoice_transfer_user_id', '{{%invoice_transfer}}');
    }
}
