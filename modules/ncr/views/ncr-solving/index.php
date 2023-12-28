<?php

use app\modules\ncr\models\NcrConcession;
use app\modules\ncr\models\NcrSolving;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrSolving $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Ncr Solvings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-solving-index">
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

                    // 'id',
                    // 'ncr_id',
                    [
                        'attribute' => 'ncr_id',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->ncr_id ? Html::a($model->ncr->ncr_number, ['view', 'id' => $model->id]) : Yii::t('app', 'N/A');
                        },
                    ],
                    [
                        'attribute' => 'solving_type_id',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->solving_type_id ? $model->solvingType->type_name : Yii::t('app', 'N/A');
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:80px;'],
                        'value' => function ($model) {
                            return $model->quantity ? $model->quantity : Yii::t('app', 'N/A');
                        },
                    ],
                    [
                        'attribute' => 'unit',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:80px;'],
                        'value' => function ($model) {
                            return $model->unit ? $model->unit : Yii::t('app', 'N/A');
                        },
                    ],
                    'proceed:ntext',
                    [
                        'attribute' => 'operation_date',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', 'N/A');
                        },
                        'filter' => DatePicker::widget([
                            // 'language' => 'th',
                            'model' => $searchModel,
                            'attribute' => 'operation_date',
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'orientation' => 'bottom', // Set the orientation to bottom
                            ]
                        ]),

                    ],
                    //'operation_name',
                    [
                        'attribute' => 'ncr_concession_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:120px;'],
                        'value' => function ($model) {
                            return $model->ncr_concession_id ? $model->ncrConcession->concession_name : Yii::t('app', 'N/A');
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'ncr_concession_id',
                            'data' => ArrayHelper::map(NcrConcession::find()->all(), 'id', 'concession_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                    ],
                    //'customer_name',
                    //'process',
                    //'cause',
                    // 'approve_name',
                    //'approve_date',
                    //'docs:ntext',
                    //'ref',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{item} {view} {update} {delete}</div>',
                        // 'buttons' => [
                        //     'item' => function ($url, $model, $key) {
                        //         return Html::a('<i class="fa fa-list"></i>', ['item', 'id' => $model->id], [
                        //             'title' => Yii::t('app', 'Add List of Memo'),
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