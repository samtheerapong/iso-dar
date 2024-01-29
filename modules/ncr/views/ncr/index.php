<?php

use app\models\Department;
use app\modules\ncr\models\NcrMonth;
use app\modules\ncr\models\NcrProcess;
use app\modules\ncr\models\NcrStatus;
use app\modules\ncr\models\search\NcrProtectionSearch;
use app\modules\ncr\models\search\NcrReplySearch;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'NCR');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-index">

    <div class="ncr-index">
        <div style="display: flex; justify-content: space-between;">
            <p>
                <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
            </p>

            <p style="text-align: right;">
                <?= Html::a('<i class="fa-solid fa-location-crosshairs"></i> ', ['/ncr/ncr/index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fa-solid fa-reply"></i> ', ['/ncr/ncr-reply/index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fa-solid fa-shield"></i> ', ['/ncr/ncr-protection/index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fa-solid fa-circle-check"></i> ', ['/ncr/ncr-closing/index'], ['class' => 'btn btn-secondary btn-sm']) ?>
                <?= Html::a('<i class="fa fa-refresh"></i> ', ['index'], ['class' => 'btn btn-warning btn-sm']) ?>
            </p>
        </div>

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
                    ],
                    'columns' => [
                        // [
                        //     'class' => 'kartik\grid\ExpandRowColumn',
                        //     'value' => function ($model, $key, $index, $column) {
                        //         return GridView::ROW_COLLAPSED;
                        //     },
                        //     'detail' => function ($model, $key, $index, $column) {
                        //         $searchModel = new NcrReplySearch();
                        //         $searchModel->ncr_id = $model->id;
                        //         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        //         return Yii::$app->controller->renderPartial('reply', [
                        //             'searchModel' => $searchModel,
                        //             'dataProvider' => $dataProvider,
                        //         ]);
                        //     },
                        //     // 'headerOptions' => ['class' => 'kartik-sheet-style', 'style' => 'color: #337ab7;'], // You can customize the header style here
                        //     // 'header' => 'Reply', // Set the header label here
                        // ],




                        // [
                        //     'class' => 'kartik\grid\ExpandRowColumn',
                        //     'value' => function ($model, $key, $index, $column) {
                        //         return GridView::ROW_COLLAPSED;
                        //     },
                        //     'detail' => function ($model, $key, $index, $column) {
                        //         $searchModel = new NcrProtectionSearch();
                        //         $searchModel->ncr_id = $model->id;
                        //         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        //         return Yii::$app->controller->renderPartial('protection', [
                        //             'searchModel' => $searchModel,
                        //             'dataProvider' => $dataProvider,
                        //         ]);
                        //     },
                        // ],

                        // [
                        //     'class' => 'kartik\grid\ExpandRowColumn',
                        //     'value' => function ($model, $key, $index, $column) {
                        //         return GridView::ROW_COLLAPSED;
                        //     },
                        //     'detail' => function ($model, $key, $index, $column) {
                        //         $searchModel = new NcrProtectionSearch();
                        //         $searchModel->ncr_id = $model->id;
                        //         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                        //         return Yii::$app->controller->renderPartial('closing', [
                        //             'searchModel' => $searchModel,
                        //             'dataProvider' => $dataProvider,
                        //         ]);
                        //     },
                        // ],

                        [
                            'class' => 'yii\grid\SerialColumn',
                            'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
                        ],

                        [
                            'attribute' => 'ncr_number',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:150px;'],
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
                        [
                            'attribute' => 'department',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:160px;'],
                            'value' => function ($model) {
                                return $model->department ? $model->toDepartment->name : 'N/A';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'department',
                                'data' => ArrayHelper::map(Department::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'attribute' => 'process',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:200px;'],
                            'value' => function ($model) {
                                // return $model->process ? '<span class="text" style="color:' . $model->ncrProcess->color . ';">' . $model->ncrProcess->name . '</span>' : 'N/A';
                                return $model->process;
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'process',
                                'data' => ArrayHelper::map(NcrProcess::find()->where(['active' => 1])->all(), 'name', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'attribute' => 'product_name',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->product_name ? $model->product_name : 'N/A';
                            },
                        ],

                        [
                            'attribute' => 'ncr_status_id',
                            'format' => 'html',
                            'headerOptions' => ['style' => 'width:120px;'],
                            'value' => function ($model) {
                                return $model->ncr_status_id ? '<span class="text" style="color:' . $model->ncrStatus->color . ';">' . $model->ncrStatus->name . '</span>' : 'N/A';
                            },
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'ncr_status_id',
                                'data' => ArrayHelper::map(NcrStatus::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])
                        ],
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'headerOptions' => ['style' => 'width:250px;'],
                            'contentOptions' => ['class' => 'text-center'],
                            'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                            'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {reply}</div>',
                            // 'buttons' => [
                            //     'reply' => function ($url, $model, $key) {
                            //         return Html::a('<i class="fa-solid fa-right-left"></i>', ['update', 'id' => $model->id], [
                            //             'title' => Yii::t('app', 'Reply'),
                            //             'class' => 'btn btn-outline-dark btn-sm',
                            //         ]);
                            //     },
                            // ],
                        ],
                    ],
                ]); ?>

            </div>
        </div>
    </div>
</div>