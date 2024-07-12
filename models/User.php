<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    // Связываем модель с таблицей базы данных

    // Метод tableName() возвращает имя таблицы, с которой связана данная модель. В данном случае это таблица users.
    public static function tableName()
    {
        return 'users';
    }

    // Определяем правила валидации

    // Метод rules() возвращает массив правил валидации для атрибутов модели:
    // - Поля first_name и last_name обязательны для заполнения (required).
    // - Поля first_name и last_name должны быть строками (string) и иметь максимальную длину 50 символов (max).
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
        ];
    }

    // Определяем метки атрибутов

    // Метод attributeLabels() возвращает массив меток атрибутов, которые будут использоваться в пользовательском
    // интерфейсе. Эти метки помогают лучше описать поля для пользователей.
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

}