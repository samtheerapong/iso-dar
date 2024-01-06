<?php

use app\modules\jobs\models\Jobs;
use app\modules\jobs\models\JobStatus;
use app\modules\system\models\Department;
use app\modules\system\models\User;
use app\modules\system\models\Operators;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\bootstrap4\LinkPager;
use kartik\grid\GridView;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\OperationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Operations');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="operations-index">
    <div style="display: flex; justify-content: space-between;">
        <div class="mb-3">
            <?= Html::a(
                '<span class="fa fa-plus"></span> ' . Yii::t('app', 'Create Job'),
                ['/jobs/jobs/create'],
                ['class' => 'btn btn-danger']
            ) ?>
            <?= Html::a(
                '<span class="fa fa-retweet"></span> ',
                ['index'],
                ['class' => 'btn btn-warning']
            ) ?>
        </div>
        <div class="mb-3" style="text-align: right;">

            <?php
            echo ExportMenu::widget([
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_PDF => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_EXCEL => false,
                    ExportMenu::FORMAT_EXCEL_X => false,
                ],
                'dataProvider' => $dataProvider,
                'columns' => [],
            ]) ?>
        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'class' => LinkPager::class,
                    'options' => ['class' => 'pagination justify-content-center m-1'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'job_id',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        // 'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            return  Html::a(
                                $model->job->number, // Access the Jobs model associated with Operations
                                ['view', 'id' => $model->id]
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'job_id',
                            'data' => ArrayHelper::map(Jobs::find()->all(), 'id', 'number'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'title',
                        'options' => ['style' => 'width:200px;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->generateTitleLink();
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'title',
                            'data' => ArrayHelper::map(Jobs::find()->all(), 'title', 'title'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'request_by',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 240px;'],
                        // 'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            return Html::a(
                                $model->job->requestBy->thai_name,
                                ['view', 'id' => $model->id],
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'request_by',
                            'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'job_department',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 80px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            $values = '<span class="text-justify" style="color:' . $model->job->jobDepartment->color . ';"><b>' . $model->job->jobDepartment->code . '</b></span>';
                            return Html::a(
                                $values,
                                ['view', 'id' => $model->id],
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'job_department',
                            'data' => ArrayHelper::map(Department::find()->all(), 'id', 'code'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'operator_by',
                        'format' => 'html',
                        'options' => ['style' => 'width:240px'],
                        'value' => function ($model) {
                            if ($model->operator_by !== null) {
                                return $model->actorBy->thai_name;
                            }
                            return '';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'operator_by',
                            'data' => ArrayHelper::map(Operators::find()->all(), 'id', 'thai_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'start_date',
                        'options' => ['style' => 'width:220px'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->start_date !== null ? $model->formatDateTime(strtotime($model->start_date)) : '';
                        },
                    ],
                    [
                        'attribute' => 'end_date',
                        'options' => ['style' => 'width:220px'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->end_date !== null ? $model->formatDateTime(strtotime($model->end_date)) : '';
                        },
                    ],

                    [
                        'attribute' => 'cost',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-right'],
                        'options' => ['style' => 'width:100px'],
                        'value' => function ($model) {
                            return $model->formattedCost;
                        },

                    ],

                    [
                        'attribute' => 'job_status',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 140px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'value' => function ($model) {
                            return $model->getFormattedJobStatus();
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'job_status',
                            'data' => ArrayHelper::map(JobStatus::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'options' => ['style' => 'width:80px'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group"> {update} </div>',
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="fa fa-tools"></span>', $url, [
                                    'title' => Yii::t('app', 'Actions'),
                                    'class' => 'btn btn-outline-dark btn-sm',
                                ]);
                            },

                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>