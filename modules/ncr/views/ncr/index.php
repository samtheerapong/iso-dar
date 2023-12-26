<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap5\LinkPager;

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
                        'contentOptions' => ['style' => 'width:100px;'],
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
                    ],
                    // 'month',
                    [
                        'attribute' => 'department',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:120px;'],
                        'value' => function ($model) {
                            return $model->department ? $model->toDepartment->department_code : 'N/A';
                        },
                    ],
                    [
                        'attribute' => 'ncr_process_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:120px;'],
                        'value' => function ($model) {
                            return $model->ncr_process_id ? '<span class="text" style="color:' . $model->ncrProcess->color . ';">' . $model->ncrProcess->process_name . '</span>' : 'N/A';
                        },
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
                    ],
                    //'ref',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {delete}</div>',
                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>