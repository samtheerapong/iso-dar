<?php

use app\modules\dar\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\dar\models\search\Request $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'New Document'), ['create-new'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Document Request '), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Configs'), ['/engineer/default/setings-menu'], ['class' => 'btn btn-warning']) ?>
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
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['style' => 'width:40px;'],
                    ],

                    // 'id',
                    // 'document_code',
                    [
                        'attribute' => 'document_code',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return Html::a($model->document_code, ['view', 'id' => $model->id]);
                        },
                    ],
                    // 'rev',
                    [
                        'attribute' => 'rev',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center',  'style' => 'width:80px;'],
                        'value' => function ($model) {
                            return $model->rev;
                        },
                    ],
                    // 'request_status_id',
                    [
                        'attribute' => 'request_type_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center','style' => 'width:180px;'],
                        'value' => function ($model) {
                            return '<span class="text" style="color:' . $model->requestType->color . ';">' . $model->requestType->name . '</span>';
                        },
                    ],
                    // 'request_category_id',
                    //'department_id',
                    //'created_at',
                    //'updated_at',
                    //'created_by',
                    //'updated_by',
                    // 'title',
                    [
                        'attribute' => 'title',
                        'format' => 'ntext',
                        'value' => function ($model) {
                            return $model->title;
                        },
                    ],
                    // 'request_name',
                    [
                        'attribute' => 'request_name',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:200px;'],
                        'value' => function ($model) {
                            return $model->requestName->thai_name;
                        },
                    ],
                    //'detail:ntext',
                    //'document_age',
                    //'public_date',
                    // 'request_status_id',
                    [
                        'attribute' => 'request_status_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center','style' => 'width:120px;'],
                        'value' => function ($model) {
                            return '<span class="text" style="color:' . $model->requestStatus->color . ';">' . $model->requestStatus->name . '</span>';
                        },
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        // 'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {delete}</div>',
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view}</div>',

                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>