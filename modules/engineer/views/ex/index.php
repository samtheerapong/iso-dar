<?php

use app\modules\engineer\models\EnCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\EnCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="en-category-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="bi bi-plus-circle"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="bi bi-gear"></i> ' . Yii::t('app', 'Configs'), ['/engineer/configs'], ['class' => 'btn btn-warning']) ?>
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
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'category_id',
                    'code',
                    'name',
                    'detail:ntext',
                    'color',
                    //'avtive',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{list} {view} {update} {delete}</div>',
                        'buttons' => [
                            'list' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-list"></i>', ['list', 'category_id' => $model->category_id], [
                                    'title' => Yii::t('app', 'Add List'),
                                    'class' => 'btn btn-outline-dark btn-sm',
                                ]);
                            },
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-eye"></i>', ['view', 'category_id' => $model->category_id], [
                                    'title' => Yii::t('app', 'View'),
                                    'class' => 'btn btn-outline-dark btn-sm',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-pencil"></i>', ['update', 'category_id' => $model->category_id], [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-outline-dark btn-sm',
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="fa fa-trash-can"></i>', ['delete', 'category_id' => $model->category_id], [
                                    'title' => Yii::t('app', 'Delete'),
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