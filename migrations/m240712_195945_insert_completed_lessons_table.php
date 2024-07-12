<?php

use yii\db\Migration;

/**
 * Class m240712_195945_insert_completed_lessons_table
 */
class m240712_195945_insert_completed_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%completed_lessons}}', ['user_id', 'lesson_id', 'completed_at'], [
            [1, 1, '2024-07-01 10:00:00'],
            [1, 2, '2024-07-02 11:00:00'],
            [1, 3, '2024-07-03 12:00:00'],
            [2, 1, '2024-07-01 10:00:00'],
            [2, 4, '2024-07-04 13:00:00'],
            [3, 5, '2024-07-05 14:00:00'],
            [3, 6, '2024-07-06 15:00:00'],
            [4, 7, '2024-07-07 16:00:00'],
            [4, 8, '2024-07-08 17:00:00'],
            [5, 9, '2024-07-09 18:00:00'],
            [5, 2, '2024-07-10 19:00:00'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%completed_lessons}}', ['user_id' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240712_195945_insert_completed_lessons_table cannot be reverted.\n";

        return false;
    }
    */
}
