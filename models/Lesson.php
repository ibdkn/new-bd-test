<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Lesson extends ActiveRecord
{
    // Связываем модель с таблицей базы данных

    // Метод tableName() возвращает имя таблицы, с которой связана данная модель. В данном случае это таблица lessons.
    public static function tableName()
    {
        return 'lessons';
    }

    // Определяем правила валидации

    // Метод rules() возвращает массив правил валидации для атрибутов модели:
    public function rules()
    {
        return [
            [['title', 'description', 'video_link', 'created_at'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['video_link'], 'string', 'max' => 512],
        ];
    }

    // Определяем метки атрибутов

    // Метод attributeLabels() возвращает массив меток атрибутов, которые будут использоваться в пользовательском
    // интерфейсе. Эти метки помогают лучше описать поля для уроков.
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'video_link' => 'Video URL',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }

    public function getFormattedCreatedAt()
    {
        return Yii::$app->formatter->asDate($this->created_at, 'php:d.m.Y');
    }

    public function getCompletedLessons()
    {
        return $this->hasMany(CompletedLesson::class, ['lesson_id' => 'id']);
    }

}