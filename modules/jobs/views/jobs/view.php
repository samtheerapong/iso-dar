<?php

use yii2mod\alert\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Jobs $model */

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jobs-view">
    <?php echo Alert::widget() ?>
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fas fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>

            <?= Html::a('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

        </p>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title . '  ' . $model->title) ?>
        </div>
        <div class="card-body">

            <?= DetailView::widget([
                'model' => $model,
                'template' => '<tr><th style="width: 300px;">{label}</th><td> {value}</td></tr>',
                'attributes' => [
                    [
                        'attribute' => 'job_status',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:'
                                . $model->jobStatus->color . ';"><b>'
                                . $model->jobStatus->name
                                . ' </b></span>';
                        },
                    ],
                    'number',
                    'request_date:date',
                    'title',
                    [
                        'attribute' => 'equipment',
                        'format' => 'html',
                        'visible' => !empty($model->equipment),
                        'value' => function ($model) {
                            return $model->equipment;
                        },
                    ],
                    [
                        'attribute' => 'description',
                        'format' => 'ntext',
                        'visible' => !empty($model->description),
                        'value' => function ($model) {
                            return $model->description;
                        },
                    ],
                    [
                        'attribute' => 'request_by',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->requestBy->thai_name;
                        },
                    ],

                    [
                        'attribute' => 'job_department',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:'
                                . $model->jobDepartment->color . ';"><b>'
                                . $model->jobDepartment->name
                                . ' </b></span>';
                        },
                    ],

                    [
                        'attribute' => 'location',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:'
                                . $model->location0->color . ';"><b>'
                                . $model->location0->name
                                . ' </b></span>';
                        },
                    ],
                    [
                        'attribute' => 'job_type',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:'
                                . $model->jobType->color . ';"><b>'
                                . $model->jobType->name
                                . ' </b></span>';
                        },
                    ],

                    [
                        'attribute' => 'urgency',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:'
                                . $model->urgency0->color . ';"><b>'
                                . $model->urgency0->name
                                . ' </b></span>';
                        },
                    ],

                    [
                        'attribute' => 'docs',
                        'format' => 'html',
                        'value' => $model->listDownloadFiles('docs')
                    ],

                    [
                        'attribute' => 'remask',
                        'format' => 'ntext',
                        'visible' => !empty($model->remask),
                        'value' => function ($model) {
                            return $model->remask;
                        },
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.image-link').on('click', function() {
        var largeImage = $(this).find('img[data-large-image]');
        largeImage.show(); // แสดงรูปภาพขนาดใหญ่เมื่อคลิกที่รูปภาพขนาดเล็ก
    });
});
</script>