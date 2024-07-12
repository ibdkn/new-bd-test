<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class CompletedLesson extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%completed_lessons}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'lesson_id', 'completed_at'], 'required'],
            [['user_id', 'lesson_id'], 'integer'],
            [['completed_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'lesson_id' => 'Lesson ID',
            'completed_at' => 'Completed At',
        ];
    }

    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['id' => 'lesson_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}