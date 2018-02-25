<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_105730_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_products_category_id',
            '{{%products}}','category_id',
            '{{%prod_category}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_procur_id',
            '{{%products}}','invoice_procur_id',
            '{{%invoice_procurement}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_sales_id',
            '{{%products}}','invoice_sales_id',
            '{{%invoice_sales}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_transfer_id',
            '{{%products}}','invoice_transfer_id',
            '{{%invoice_transfer}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_manufacturer_id',
            '{{%products}}','manufacturer_id',
            '{{%manufacturers}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_name_id',
            '{{%products}}','name_id',
            '{{%prod_names}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_probe',
            '{{%products}}','probe',
            '{{%probe}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_size',
            '{{%products}}','size',
            '{{%sizes}}','size',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_store_id',
            '{{%products}}','store_id',
            '{{%stores}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_supplier_id',
            '{{%products}}','supplier_id',
            '{{%suppliers}}','id',
            'SET NULL','NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_products_category_id', '{{%products}}');
        $this->dropForeignKey('fk_products_invoice_procur_id', '{{%products}}');
        $this->dropForeignKey('fk_products_invoice_sales_id', '{{%products}}');
        $this->dropForeignKey('fk_products_invoice_transfer_id', '{{%products}}');
        $this->dropForeignKey('fk_products_manufacturer_id', '{{%products}}');
        $this->dropForeignKey('fk_products_name_id', '{{%products}}');
        $this->dropForeignKey('fk_products_probe', '{{%products}}');
        $this->dropForeignKey('fk_products_size', '{{%products}}');
        $this->dropForeignKey('fk_products_store_id', '{{%products}}');
        $this->dropForeignKey('fk_products_supplier_id', '{{%products}}');
    }
}
