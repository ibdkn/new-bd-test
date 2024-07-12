<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $lessons app\models\User[] */

$this->title = 'Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('<i class="fa fa-plus"></i> Create new lesson', ['create'], ['class' => 'btn btn-success mb-3']) ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Video link</th>
            <th>Data of creation</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($lessons as $index => $lesson): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= Html::encode($lesson->title) ?></td>
                <td><?= Html::encode($lesson->description) ?></td>
                <td><?= Html::a(Html::encode($lesson->video_link), $lesson->video_link, ['target' => '_blank']) ?></td>
                <td><?= Html::encode($lesson->created_at) ?></td>
                <td class="actions-column">
                    <?= Html::a('<i class="fa fa-eye"></i>', ['view', 'id' => $lesson->id], ['class' => 'btn btn-info btn-sm']) ?>
                    <?= Html::a('<i class="fas fa-pencil-alt"></i>', ['update', 'id' => $lesson->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $lesson->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>