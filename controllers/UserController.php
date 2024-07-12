<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class UserController extends Controller
{
    // Метод behaviors() возвращает массив настроек поведения контроллера.
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(), // VerbFilter - ограничит доступ к методу delete только через POST-запросы.
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    // Метод actionIndex:
    // - Получает все записи из таблицы users с помощью метода find()->all() модели User.
    // - Передает полученные данные в вид index для отображения.
    public function actionIndex()
    {
        $users = User::find()->all();
        return $this->render('index', [
            'users' => $users,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}