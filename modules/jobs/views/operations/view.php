<?php

use dominus77\sweetalert2\Alert;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Operations $model */

$this->title = $modelJobs->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="operations-view">
    <?php echo Alert::widget() ?>
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fas fa-plug"></i> ' . Yii::t('app', 'Operate'), ['update', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header text-white bg-info">
                    <?= Yii::t('app', 'Number') . " : " . $modelJobs->number; ?>
                </div>
                <div class="card-body">

                    <?= DetailView::widget([
                        'model' => $modelJobs,
                        'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'job_status',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobStatus->color . ';"><b>'
                                        . $modelJobs->jobStatus->name
                                        . ' </b></span>';
                                },
                            ],
                            'number',
                            'request_date:date',
                            'title',
                            [
                                'attribute' => 'equipment',
                                'format' => 'html',
                                'visible' => !empty($modelJobs->equipment),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->equipment;
                                },
                            ],
                            [
                                'attribute' => 'description',
                                'format' => 'ntext',
                                'visible' => !empty($modelJobs->description),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->description;
                                },
                            ],
                            [
                                'attribute' => 'request_by',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return $modelJobs->requestBy->thai_name;
                                },
                            ],

                            [
                                'attribute' => 'job_department',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobDepartment->color . ';"><b>'
                                        . $modelJobs->jobDepartment->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'location',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->location0->color . ';"><b>'
                                        . $modelJobs->location0->name
                                        . ' </b></span>';
                                },
                            ],
                            [
                                'attribute' => 'job_type',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobType->color . ';"><b>'
                                        . $modelJobs->jobType->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'urgency',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->urgency0->color . ';"><b>'
                                        . $modelJobs->urgency0->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'docs',
                                'format' => 'html',
                                'value' => $modelJobs->listDownloadFiles('docs')
                            ],

                            [
                                'attribute' => 'remask',
                                'format' => 'ntext',
                                'visible' => !empty($modelJobs->remask),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->remask;
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'Operations') ?>

                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 200px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            // 'id',
                                                     
                            [
                                'attribute' => 'operator_by',
                                'format' => 'html',
                                'visible' => !empty($model->operator_by),
                                'value' => function ($model) {
                                    return $model->actorBy->thai_name;
                                },
                            ],

                            [
                                'attribute' => 'details',
                                'visible' => !empty($model->details),
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->details;
                                },
                            ],
                            [
                                'attribute' => 'sparepart_list',
                                'visible' => !empty($model->sparepart_list),
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->sparepart_list;
                                },
                            ],
                            [
                                'attribute' => 'cost',
                                'visible' => !empty($model->cost),
                                'format' => ['html'],
                                'value' => function ($model) {
                                    return $model->cost;
                                },
                            ],
                       
                            [
                                'attribute' => 'start_date',
                                'format' => 'html',
                                'visible' => !empty($model->start_date),
                                'value' => function ($model) {
                                    return $model->start_date !== null ? $model->formatDateTime(strtotime($model->start_date)) : '';
                                },
                            ],
                            [
                                'attribute' => 'end_date',
                                'format' => 'html',
                                'visible' => !empty($model->end_date),
                                'value' => function ($model) {
                                    return $model->end_date !== null ? $model->formatDateTime(strtotime($model->end_date)) : '';
                                },
                            ],
                            [
                                'attribute' => 'remask',
                                'visible' => !empty($model->remask),
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->remask;
                                },
                            ],
                            // [
                            //     'attribute' => 'docs',
                            //     'visible' => !empty($model->docs),
                            //     'format' => 'ntext',
                            //     'value' => function ($model) {
                            //         return $model->docs;
                            //     },
                            // ],
                            [
                                'attribute' => 'docs',
                                'format' => 'html',
                                'visible' => !empty($model->docs),
                                'value' => $model->listDownloadFiles('docs')
                            ],

                        ],
                    ]) ?>

                </div>
            </div>
        </div>
    </div>
</div>