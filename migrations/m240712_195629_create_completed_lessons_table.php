<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%completed_lessons}}`.
 */
class m240712_195629_create_completed_lessons_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%completed_lessons}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'lesson_id' => $this->integer()->notNull(),
            'completed_at' => $this->dateTime()->notNull(),
        ]);

        // Создание индексов

        // - Имя индекса: idx-completed_lessons-user_id.
        // - Индекс создается для столбца user_id таблицы completed_lessons.
        $this->createIndex(
            'idx-completed_lessons-user_id',
            '{{%completed_lessons}}',
            'user_id'
        );

        $this->createIndex(
            'idx-completed_lessons-lesson_id',
            '{{%completed_lessons}}',
            'lesson_id'
        );


        // Добавление внешних ключей

        // - Имя внешнего ключа: fk-completed_lessons-user_id
        // - Внешний ключ связывает столбец user_id таблицы completed_lessons со столбцом id таблицы users
        // - CASCADE: Если пользователь будет удален, то все связанные записи в таблице completed_lessons также будут удалены
        $this->addForeignKey(
            'fk-completed_lessons-user_id',
            '{{%completed_lessons}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `lessons`
        $this->addForeignKey(
            'fk-completed_lessons-lesson_id',
            '{{%completed_lessons}}',
            'lesson_id',
            '{{%lessons}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%completed_lessons}}');
    }
}
