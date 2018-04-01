<?php

use yii\db\Migration;

/**
 * Class m180401_154947_products_tmp
 */
class m180401_154947_products_tmp extends Migration
{
    const TABLE = '{{%products_tmp}}';
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            self::TABLE,
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
        $this->createIndex('id',self::TABLE,['id'],true);
        $this->createIndex('name_id',self::TABLE,['name_id'],false);
        $this->createIndex('supplier_id',self::TABLE,['supplier_id'],false);
        $this->createIndex('manufacturer_id',self::TABLE,['manufacturer_id'],false);
        $this->createIndex('store_id',self::TABLE,['store_id'],false);
        $this->createIndex('category_id',self::TABLE,['category_id'],false);
        $this->createIndex('probe',self::TABLE,['probe'],false);
        $this->createIndex('invoice_procur_id',self::TABLE,['invoice_procur_id'],false);
        $this->createIndex('invoice_sales_id',self::TABLE,['invoice_sales_id'],false);
        $this->createIndex('invoice_transfer_id',self::TABLE,['invoice_transfer_id'],false);
        $this->createIndex('size',self::TABLE,['size'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('id', self::TABLE);
        $this->dropIndex('name_id', self::TABLE);
        $this->dropIndex('supplier_id', self::TABLE);
        $this->dropIndex('manufacturer_id', self::TABLE);
        $this->dropIndex('store_id', self::TABLE);
        $this->dropIndex('category_id', self::TABLE);
        $this->dropIndex('probe', self::TABLE);
        $this->dropIndex('invoice_procur_id', self::TABLE);
        $this->dropIndex('invoice_sales_id', self::TABLE);
        $this->dropIndex('invoice_transfer_id', self::TABLE);
        $this->dropIndex('size', self::TABLE);
        $this->dropTable(self::TABLE);
    }

}
