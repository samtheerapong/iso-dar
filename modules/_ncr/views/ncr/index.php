<?php

use app\modules\ncr\models\NcrDepartment;
use app\modules\ncr\models\NcrMonth;
use app\modules\ncr\models\NcrProcess;
use app\modules\ncr\models\NcrStatus;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ncrs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Settings'), ['/ncr/ncr/setings-menu'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'class' => LinkPager::class,
                    'options' => ['class' => 'pagination justify-content-center m-1'],
                    'maxButtonCount' => 5,
                    'firstPageLabel' => Yii::t('app', 'First'),
                    'lastPageLabel' => Yii::t('app', 'Last'),
                    'options' => ['class' => 'pagination justify-content-center'],
                    'linkContainerOptions' => ['class' => 'page-item'],
                    'linkOptions' => ['class' => 'page-link'],
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'width:40px;'],
                    ],

                    [
                        'attribute' => 'ncr_number',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->ncr_number ? Html::a($model->ncr_number, ['view', 'id' => $model->id]) : 'N/A';
                        },
                    ],
                    [
                        'attribute' => 'created_date',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->created_date ? Yii::$app->formatter->asDate($model->created_date) : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'month',
                            'data' => ArrayHelper::map(NcrMonth::find()->all(), 'id', 'month'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    // 'month',
                    [
                        'attribute' => 'department',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:120px;'],
                        'value' => function ($model) {
                            return $model->department ? $model->toDepartment->department_code : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'department',
                            'data' => ArrayHelper::map(NcrDepartment::find()->where(['active' => 1])->all(), 'id', 'department_code'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'ncr_process_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->ncr_process_id ? '<span class="text" style="color:' . $model->ncrProcess->color . ';">' . $model->ncrProcess->process_name . '</span>' : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'ncr_process_id',
                            'data' => ArrayHelper::map(NcrProcess::find()->where(['active' => 1])->all(), 'id', 'process_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    //'lot',
                    //'production_date',
                    [
                        'attribute' => 'product_name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->product_name ? $model->product_name : 'N/A';
                        },
                    ],
                    //'customer_name',
                    // [
                    //     'attribute' => 'category_id',
                    //     'format' => 'html',
                    //     'contentOptions' => ['class' => 'text-center','style' => 'width:120px;'],
                    //     'value' => function ($model) {
                    //         return $model->category_id ? '<span class="text" style="color:' . $model->category->color . ';">' . $model->category->category_name . '</span>' : 'N/A';
                    //     },
                    // ],
                    //'sub_category_id',
                    //'datail:ntext',
                    //'department_issue',
                    //'report_by',
                    //'troubleshooting:ntext',
                    //'docs:ntext',
                    [
                        'attribute' => 'ncr_status_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:120px;'],
                        'value' => function ($model) {
                            return $model->ncr_status_id ? '<span class="text" style="color:' . $model->ncrStatus->color . ';">' . $model->ncrStatus->status_name . '</span>' : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'ncr_status_id',
                            'data' => ArrayHelper::map(NcrStatus::find()->where(['active' => 1])->all(), 'id', 'status_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    //'ref',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {solving}</div>',
                        'buttons' => [
                            'solving' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-right-left"></i>', ['solving', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Solving'),
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