<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lesson-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'video_link',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y'],
            ],
        ],
    ]) ?>

    <h2 class="pt-5">Users who completed this lesson</h2>
    <?php
    if (!empty($completedLessons)):
        ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Completed At</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($completedLessons as $index => $completedLesson): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($completedLesson->user->first_name) ?></td>
                    <td><?= Html::encode($completedLesson->user->last_name) ?></td>
                    <td><?= Html::encode(Yii::$app->formatter->asDatetime($completedLesson->completed_at, 'php:d.m.Y H:i:s')) ?></td>
                    <td class="action"><?= Html::a('<i class="fa fa-eye"></i>', ['user/view', 'id' => $completedLesson->user->id], ['class' => 'btn btn-info btn-sm']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users have completed this lesson yet.</p>
    <?php endif; ?>

</div>
