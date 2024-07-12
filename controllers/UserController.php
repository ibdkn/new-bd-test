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
    // - Получает все записи из таблицы users с помощью метода find()->all() модели User
    // - Передает полученные данные в вид index для отображения
    public function actionIndex()
    {
        // Запрос к базе данных для получения всех записей из таблицы User

        // - Метод find() создает новый объект запроса для модели User
        // - Метод all() выполняет запрос и возвращает массив все найденные записи
        $users = User::find()->all();

        // Рендерит представление 'index' и передает в него массив пользователей в качестве параметра
        // - В представлении index.php можно будет получить доступ к массиву пользователей через переменную $users и
        // отобразить данные в удобном формате.
        return $this->render('index', [
            'users' => $users,
        ]);
    }

    // Функция actionView: используется для отображения страницы с подробной информацией о конкретной модели.
    public function actionView($id)
    {
        // // Находит модель по переданному идентификатору
        $model = $this->findModel($id);

        // // Возвращает представление 'view' и передает в него найденную модель
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('update', [
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