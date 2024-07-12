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
        // Получение модели по идентификатору ($id):
        $model = $this->findModel($id);

        // Возвращает представление 'view' и передает в него найденную модель
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        // Получение модели по идентификатору ($id):
        $model = $this->findModel($id);

        // Загрузка данных и сохранение модели:

        //  - load загружает данные из POST-запроса в модель. Если данные были успешно загружены, возвращается true
        //	- save сохраняет модель в базе данных. Если сохранение прошло успешно, возвращается true
        //	- Весь условный оператор проверяет, были ли данные успешно загружены и сохранены
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Если данные были успешно загружены и сохранены, происходит перенаправление пользователя на страницу
            // index. Метод redirect создает HTTP-заголовок для перенаправления на указанное действие
            return $this->redirect(['index']);
        }
        return $this->render('update', [

            // Если данные не были загружены или сохранены, метод render отображает представление update, передавая в
            // него модель User как переменную model. Это позволяет пользователю увидеть форму обновления и, при необходимости, повторить попытку
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
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