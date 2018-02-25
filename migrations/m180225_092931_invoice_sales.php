<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092931_invoice_sales extends Migration
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
            '{{%invoice_sales}}',
            [
                'id'=> $this->primaryKey(11),
                'store_id'=> $this->integer(11)->null()->defaultValue(null),
                'description'=> $this->string(255)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
                'user_id'=> $this->integer(11)->null()->defaultValue(null),
                'is_closed' => $this->integer(1)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('store_id','{{%invoice_sales}}',['store_id'],false);
        $this->createIndex('user_id','{{%invoice_sales}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('store_id', '{{%invoice_sales}}');
        $this->dropIndex('user_id', '{{%invoice_sales}}');
        $this->dropTable('{{%invoice_sales}}');
    }
}
