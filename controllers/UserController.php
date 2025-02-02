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
        $completedLessons = $model->completedLessons;

        // Возвращает представление 'view' и передает в него найденную модель
        return $this->render('view', [
            'model' => $model,
            'completedLessons' => $completedLessons,
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
        // Создание новой модели User

        // Создается новый экземпляр модели User. Эта строка инициализирует новую запись, которую можно будет заполнить и сохранить в базу данных.
        $model = new User();

        // Метод load загружает данные из POST-запроса в модель. Если данные из формы были отправлены и успешно
        // загружены в модель, метод возвращает true.
        // Если данные были успешно загружены в модель, вызывается метод save, который сохраняет данные в базу данных.
        // Если сохранение успешно, метод также возвращает true.
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // Если данные успешно загружены и сохранены, пользователь перенаправляется на страницу со списком записей
            // (actionIndex), что обычно означает успешное создание новой записи.
            return $this->redirect(['index']);
        }

        // Если данные не были отправлены или не прошли валидацию, метод render отображает представление create,
        // передавая в него модель User. Это позволяет представлению отобразить форму для ввода данных, а также показать
        // возможные ошибки валидации.
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        // Метод findModel ищет модель User в базе данных по переданному идентификатору $id. Если модель не найдена,
        // метод выбрасывает исключение NotFoundHttpException.
        // После того как модель найдена, вызывается метод delete, который удаляет соответствующую запись из базы
        $this->findModel($id)->delete();

        // После удаления записи происходит перенаправление на страницу со списком записей
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}