<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092823_invoice_procurement extends Migration
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
            '{{%invoice_procurement}}',
            [
                'id'=> $this->primaryKey(11),
                'supplier_id'=> $this->integer(11)->null()->defaultValue(null),
                'description'=> $this->string(255)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
                'user_id'=> $this->integer(11)->null()->defaultValue(null),
                'is_closed' => $this->integer(1)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('user_id','{{%invoice_procurement}}',['user_id'],false);
        $this->createIndex('store_id','{{%invoice_procurement}}',['supplier_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('user_id', '{{%invoice_procurement}}');
        $this->dropIndex('store_id', '{{%invoice_procurement}}');
        $this->dropTable('{{%invoice_procurement}}');
    }
}
