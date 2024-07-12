<?php

namespace app\controllers;

use Yii;
use app\models\Lesson;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LessonController extends Controller
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

    public function actionIndex()
    {
        $lessons = Lesson::find()->all();
        return $this->render('index', [
            'lessons' => $lessons,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $completedLessons = $model->completedLessons;

        return $this->render('view', [
            'model' => $model,
            'completedLessons' => $completedLessons,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Lesson();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}