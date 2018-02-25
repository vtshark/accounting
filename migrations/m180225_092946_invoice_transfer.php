<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_092946_invoice_transfer extends Migration
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
            '{{%invoice_transfer}}',
            [
                'id'=> $this->primaryKey(11),
                'store_id'=> $this->integer(11)->null()->defaultValue(null),
                'description'=> $this->string(255)->null()->defaultValue(null),
                'created_at'=> $this->integer(11)->null()->defaultValue(null),
                'user_id'=> $this->integer(11)->null()->defaultValue(null),
                'is_closed' => $this->integer(1)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('store_id','{{%invoice_transfer}}',['store_id'],false);
        $this->createIndex('user_id','{{%invoice_transfer}}',['user_id'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('store_id', '{{%invoice_transfer}}');
        $this->dropIndex('user_id', '{{%invoice_transfer}}');
        $this->dropTable('{{%invoice_transfer}}');
    }
}
