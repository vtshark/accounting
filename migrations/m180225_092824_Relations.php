<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092824_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_invoice_procurement_supplier_id',
            '{{%invoice_procurement}}','supplier_id',
            '{{%suppliers}}','id',
            'SET NULL','NO ACTION'
         );
        $this->addForeignKey('fk_invoice_procurement_user_id',
            '{{%invoice_procurement}}','user_id',
            '{{%users}}','id',
            'SET NULL','NO ACTION'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_invoice_procurement_supplier_id', '{{%invoice_procurement}}');
        $this->dropForeignKey('fk_invoice_procurement_user_id', '{{%invoice_procurement}}');
    }
}
