<?php

use app\models\User;
use app\modules\engineer\models\Priority;
use app\modules\engineer\models\Rp;
use app\modules\engineer\models\RpList;
use app\modules\engineer\models\search\RpListSearch;
use app\modules\engineer\models\search\RpSearch;
use app\modules\engineer\models\Status;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\RpSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Rps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rp-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Request Repair'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-list"></i> ' . Yii::t('app', 'Repair Lists'), ['/engineer/rp-list/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Configs'), ['/engineer/default/setings-menu'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Total : {count} Works', ['count' => $dataProvider->totalCount]) ?>
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
                        'class' => 'kartik\grid\ExpandRowColumn',
                        'value' => function ($model, $key, $index, $column) {
                            return GridView::ROW_COLLAPSED;
                        },
                        'detail' => function ($model, $key, $index, $column) {
                            $searchModel = new RpListSearch();
                            $searchModel->request_id = $model->id;
                            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                            return Yii::$app->controller->renderPartial('index-list', [
                                'searchModel' => $searchModel,
                                'dataProvider' => $dataProvider,
                            ]);
                        },
                    ],

                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'width:40px;'],
                    ],

                    [
                        'attribute' => 'repair_code',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return Html::a($model->repair_code, ['view', 'id' => $model->id]);
                        },
                    ],
                    [
                        'attribute' => 'request_title',
                        'format' => 'html',
                        'value' => function ($model) {
                            $detail = $model->request_title;
                            $remask = $model->remask;
                            $badge = ($remask !== null && $remask !== '') ? '<span class="badge badge-warning">' . $remask . '</span>' : '';
                            return $detail . '   ' . $badge;
                        },
                    ],
                    [
                        'attribute' => 'request_by',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:230px;'],
                        'value' => function ($model) {
                            return $model->request_by ? $model->requestBy->thai_name : Yii::t('app', 'N/A');
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
                    [
                        'attribute' => 'priority',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center','style' => 'width:100px;'],
                        'value' => function ($model) {
                            return '<span class="badge" style="background-color:' . $model->priority0->color . ';"><b>' . $model->priority0->name . '</b></span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'priority',
                            'data' => ArrayHelper::map(Priority::find()->where(['active' => 1])->all(), 'id', 'name'),
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
                        'contentOptions' => ['class' => 'text-center','style' => 'width:100px;'],
                        'value' => function ($model) {
                            return '<span class="badge" style="background-color:' . $model->urgency0->color . ';"><b>' . $model->urgency0->name . '</b></span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'urgency',
                            'data' => ArrayHelper::map(Priority::find()->where(['active' => 1])->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    //'department',
                    [
                        'attribute' => 'created_at',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->created_at ? Yii::$app->formatter->asDate($model->created_at) : 'N/A';
                        },
                    ],
                    [
                        'attribute' => 'en_status_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center','style' => 'width:180px;'],
                        'value' => function ($model) {
                            return '<span class="badge" style="background-color:' . $model->status0->color . ';"><b>' . $model->status0->name . '</b></span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'en_status_id',
                            'data' => ArrayHelper::map(Status::find()->where(['active' => 1])->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'contentOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {delete}</div>',

                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>