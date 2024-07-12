<?php

use yii\helpers\Html;

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['user/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" class="form-control" id="full_name" value="<?= Html::encode($model->first_name . ' ' . $model->last_name) ?>" disabled>
    </div>

    <p>
        <?= Html::a('Update', ['user/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h2 class="pt-5">Completed Lessons</h2>
    <?php if(!empty($completedLessons)):?>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Video URL</th>
                <th>Completed At</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($completedLessons as $completedLesson): ?>
                <tr>
                    <td><?= Html::encode($completedLesson->lesson->id) ?></td>
                    <td><?= Html::encode($completedLesson->lesson->title) ?></td>
                    <td><?= Html::encode($completedLesson->lesson->description) ?></td>
                    <td><?= Html::a(Html::encode($completedLesson->lesson->video_link), $completedLesson->lesson->video_link, ['target' => '_blank']) ?></td>
                    <td><?= Html::encode(Yii::$app->formatter->asDatetime($completedLesson->completed_at, 'php:d.m.Y H:i:s')) ?></td>
                    <td class="action"><?= Html::a('<i class="fa fa-eye"></i>', ['lesson/view', 'id' => $completedLesson->lesson->id], ['class' => 'btn btn-info btn-sm']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p><?=Html::encode($model->first_name.' '.$model->last_name) ?> have not completed any lesson yet.</p>
    <?php endif; ?>


</div>