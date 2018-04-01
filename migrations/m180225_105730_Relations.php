<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_105730_Relations extends Migration
{
    const TABLE = '{{%products}}';

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_products_category_id',
            self::TABLE,'category_id',
            '{{%prod_category}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_procur_id',
            self::TABLE,'invoice_procur_id',
            '{{%invoice_procurement}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_sales_id',
            self::TABLE,'invoice_sales_id',
            '{{%invoice_sales}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_invoice_transfer_id',
            self::TABLE,'invoice_transfer_id',
            '{{%invoice_transfer}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_manufacturer_id',
            self::TABLE,'manufacturer_id',
            '{{%manufacturers}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_name_id',
            self::TABLE,'name_id',
            '{{%prod_names}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_probe',
            self::TABLE,'probe',
            '{{%probe}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_size',
            self::TABLE,'size',
            '{{%sizes}}','size',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_store_id',
            self::TABLE,'store_id',
            '{{%stores}}','id',
            'SET NULL','NO ACTION'
        );
        $this->addForeignKey('fk_products_supplier_id',
            self::TABLE,'supplier_id',
            '{{%suppliers}}','id',
            'SET NULL','NO ACTION'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_products_category_id', self::TABLE);
        $this->dropForeignKey('fk_products_invoice_procur_id', self::TABLE);
        $this->dropForeignKey('fk_products_invoice_sales_id', self::TABLE);
        $this->dropForeignKey('fk_products_invoice_transfer_id', self::TABLE);
        $this->dropForeignKey('fk_products_manufacturer_id', self::TABLE);
        $this->dropForeignKey('fk_products_name_id', self::TABLE);
        $this->dropForeignKey('fk_products_probe', self::TABLE);
        $this->dropForeignKey('fk_products_size', self::TABLE);
        $this->dropForeignKey('fk_products_store_id', self::TABLE);
        $this->dropForeignKey('fk_products_supplier_id', self::TABLE);
    }
}
