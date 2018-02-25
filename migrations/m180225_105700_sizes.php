<?php

use yii\db\Schema;
use yii\db\Migration;

class m180225_105700_sizes extends Migration
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
            '{{%sizes}}',
            [
                'size'=> $this->float()->notNull(),
            ],$tableOptions
        );
        $this->execute("ALTER TABLE `sizes` ADD PRIMARY KEY(`size`);");
    }

    public function safeDown()
    {
        $this->dropTable('{{%sizes}}');
    }
}
