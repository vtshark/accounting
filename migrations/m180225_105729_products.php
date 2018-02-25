<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_105729_products extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%products}}',
            [
                'id'=> $this->primaryKey(11),
                'name_id'=> $this->integer(11)->null()->defaultValue(null),
                'supplier_id'=> $this->integer(11)->null()->defaultValue(null),
                'manufacturer_id'=> $this->integer(11)->null()->defaultValue(null),
                'store_id'=> $this->integer(11)->null()->defaultValue(null),
                'size'=> $this->float()->null()->defaultValue(null),
                'art'=> $this->string(255)->null()->defaultValue(null),
                'category_id'=> $this->integer(11)->null()->defaultValue(null),
                'weight'=> $this->float()->notNull()->defaultValue("0"),
                'price_sell'=> $this->integer(11)->notNull()->defaultValue(0),
                'price_procur'=> $this->float()->notNull()->defaultValue("0"),
                'probe'=> $this->integer(11)->null()->defaultValue(null),
                'invoice_procur_id'=> $this->integer(11)->null()->defaultValue(null),
                'invoice_sales_id'=> $this->integer(11)->null()->defaultValue(null),
                'invoice_transfer_id'=> $this->integer(11)->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('id','{{%products}}',['id'],true);
        $this->createIndex('name_id','{{%products}}',['name_id'],false);
        $this->createIndex('supplier_id','{{%products}}',['supplier_id'],false);
        $this->createIndex('manufacturer_id','{{%products}}',['manufacturer_id'],false);
        $this->createIndex('store_id','{{%products}}',['store_id'],false);
        $this->createIndex('category_id','{{%products}}',['category_id'],false);
        $this->createIndex('probe','{{%products}}',['probe'],false);
        $this->createIndex('invoice_procur_id','{{%products}}',['invoice_procur_id'],false);
        $this->createIndex('invoice_sales_id','{{%products}}',['invoice_sales_id'],false);
        $this->createIndex('invoice_transfer_id','{{%products}}',['invoice_transfer_id'],false);
        $this->createIndex('size','{{%products}}',['size'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('id', '{{%products}}');
        $this->dropIndex('name_id', '{{%products}}');
        $this->dropIndex('supplier_id', '{{%products}}');
        $this->dropIndex('manufacturer_id', '{{%products}}');
        $this->dropIndex('store_id', '{{%products}}');
        $this->dropIndex('category_id', '{{%products}}');
        $this->dropIndex('probe', '{{%products}}');
        $this->dropIndex('invoice_procur_id', '{{%products}}');
        $this->dropIndex('invoice_sales_id', '{{%products}}');
        $this->dropIndex('invoice_transfer_id', '{{%products}}');
        $this->dropIndex('size', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
