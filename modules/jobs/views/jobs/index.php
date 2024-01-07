<?php

use app\models\Department;
use app\modules\jobs\models\Jobs;
use app\modules\jobs\models\JobType;
use app\modules\jobs\models\JobUrgency;
use app\models\User;
use app\modules\jobs\models\JobStatus;
use kartik\export\ExportMenu;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\JobsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobs-index">
    <div style="display: flex; justify-content: space-between;">
        <div class="mb-3">
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
            <?= Html::a('<span class="fa fa-retweet"></span> ', ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
        <div class="mb-3" style="text-align: right;">


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
                    ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width: 45px;']],

                    // 'id',
                    // 'number',
                    [
                        'attribute' => 'number',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 120px;'],
                        'value' => function ($model) {
                            return  Html::a(
                                $model->number,
                                ['view', 'id' => $model->id]
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'number',
                            'data' => ArrayHelper::map(Jobs::find()->all(), 'number', 'number'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'title',
                        // 'headerOptions' => ['style' => 'width:350px;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $truncatedSupplierName = mb_substr($model->title, 0, 35, 'UTF-8');
                            if (mb_strlen($model->title, 'UTF-8') > 35) {
                                $truncatedSupplierName .= '...';
                            }

                            $tooltipContent = $model->title . " " . $model->description;
                            $tooltipLink = '<span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="' . $tooltipContent . '">'
                                . $truncatedSupplierName
                                . '</span>';

                            return Html::a(
                                $tooltipLink,
                                ['view', 'id' => $model->id],
                            );
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
                        'attribute' => 'request_date',
                        'format' => 'date',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'value' => function ($model) {
                            return $model->request_date;
                        },
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'request_date',
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'autoclose' => true,
                            ]
                        ]),
                    ],
                    // 'description:ntext',
                    [
                        'attribute' => 'request_by',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 250px;'],
                        'value' => function ($model) {
                            return $model->requestBy->thai_name;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'request_by',
                            'data' => ArrayHelper::map(User::find()->where(['status' => 10])->all(), 'id', 'thai_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    // 'job_department',
                    [
                        'attribute' => 'job_department',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 100px;'],
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:' . $model->jobDepartment->color . ';"><b>' . $model->jobDepartment->code . '</b></span>';
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
                    //'location',
                    //'equipment',
                    [
                        'attribute' => 'job_type',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 140px;'],
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:' . $model->jobType->color . ';"><b>' . $model->jobType->code . '</b></span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'job_type',
                            'data' => ArrayHelper::map(JobType::find()->all(), 'id', 'code'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'urgency',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 140px;'],
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:' . $model->urgency0->color . ';"><b>' . $model->urgency0->name . '</b></span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'urgency',
                            'data' => ArrayHelper::map(JobUrgency::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'job_status',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width: 140px;'],
                        'value' => function ($model) {
                            return '<span class="text-justify" style="color:' . $model->jobStatus->color . ';"><b>' . $model->jobStatus->name . '</b></span>';
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
                    //'remask:ntext',
                    //'docs:ntext',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width: 150px;'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group"> {operate} {view} {update} {delete}</div>',
                        'urlCreator' => function ($action, $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>