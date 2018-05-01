<?php

use yii\db\Migration;

/**
 * Class m180501_085233_products_add_prime_cost
 */
class m180501_085233_products_add_prime_cost extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE `products` ADD COLUMN `prime_cost` DOUBLE NULL DEFAULT '0' AFTER `invoice_transfer_id`;");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("ALTER TABLE `products` DROP COLUMN `prime_cost`;");
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180501_085233_products_add_prime_cost cannot be reverted.\n";

        return false;
    }
    */
}
