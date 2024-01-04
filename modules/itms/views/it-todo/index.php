<?php

use app\models\User;
use app\modules\itms\models\ItTodo;
use app\modules\itms\models\ItTodoStatus;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

//
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\ItTodoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'To Do');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-todo-index">
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
                        'attribute' => 'photo',
                        'contentOptions' => ['style' => 'width:50px;'], // กำหนด ความกว้างของ #
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->photo ? Html::a(Html::img($model->getUploadUrl() . $model->photo, ['width' => '80px']), ['view', 'id' => $model->id]) : Html::img('https://www.survivorsuk.org/wp-content/uploads/2017/01/no-image.jpg', ['width' => '80px']);
                        },
                        'filter' => false,
                    ],


                    [
                        'attribute' => 'code',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:160px;'],
                        'value' => function ($model) {
                            return $model->code ? Html::a($model->code, ['view', 'id' => $model->id]) : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'code',
                            'data' => ArrayHelper::map(ItTodo::find()->all(), 'id', 'code'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'todo_date',
                        'format' => 'html',
                        'headerOptions' => ['class' => 'text-center', 'style' => 'width:160px;'],
                        'value' => function ($model) {
                            return $model->todo_date ? Yii::$app->formatter->asDate($model->todo_date) : 'N/A';
                        },
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'html',
                        'headerOptions' => ['class' => 'text-center', 'style' => 'width:auto;'],
                        'value' => function ($model) {
                            return $model->title ? $model->title : 'N/A';
                        },
                    ],

                    [
                        'attribute' => 'request_name',
                        'format' => 'html',
                        'headerOptions' => ['class' => 'text-center', 'style' => 'width:250px;'],
                        'value' => function ($model) {
                            return $model->request_name ? $model->requestName->thai_name : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'request_name',
                            'data' => ArrayHelper::map(User::find()->where(['status' => 10])->all(), 'id', 'thai_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    //'photo:ntext',
                    // 'status_id',
                    [
                        'attribute' => 'status_id',
                        'format' => 'html',
                        'headerOptions' => ['class' => 'text-center', 'style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->status_id ? '<span class="text" style="color:' . $model->status->color . ';">' . $model->status->name . '</span>' : 'N/A';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'status_id',
                            'data' => ArrayHelper::map(ItTodoStatus::find()->where(['active' => 1])->all(), 'id', 'name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    //'ref',
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