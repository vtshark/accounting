<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092932_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_invoice_sales_store_id',
            '{{%invoice_sales}}','store_id',
            '{{%stores}}','id',
            'SET NULL','NO ACTION'
         );
        $this->addForeignKey('fk_invoice_sales_user_id',
            '{{%invoice_sales}}','user_id',
            '{{%users}}','id',
            'SET NULL','NO ACTION'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_invoice_sales_store_id', '{{%invoice_sales}}');
        $this->dropForeignKey('fk_invoice_sales_user_id', '{{%invoice_sales}}');
    }
}
