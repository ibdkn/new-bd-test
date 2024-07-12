<?php

use yii\db\Migration;

/**
 * Class m240712_170348_insert_users_data
 */
class m240712_170348_insert_users_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%users}}', ['id', 'first_name', 'last_name'], [
            [1, 'Anna', 'Pratt'],
            [2, 'George', 'Donovan'],
            [3, 'Alice', 'Cooper'],
            [4, 'Bob', 'Dilan'],
            [5, 'Carol', 'Burnett'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240712_170348_insert_users_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240712_170348_insert_users_data cannot be reverted.\n";

        return false;
    }
    */
}
