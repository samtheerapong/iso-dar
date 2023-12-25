<?php

use app\modules\nfc\models\Department;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\search\DepartmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Departments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        'attribute' => 'code',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:200px;'],
                        'value' => function ($model) {
                            $text = '<span class="badge" style="background-color:' . $model->color . ';"><b>' . $model->code . '</b></span>';
                            return Html::a($text, ['view', 'id' => $model->id]);
                        },
                    ],
                    // 'name',
                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->name ? $model->name : Yii::t('app', 'N/A');
                        },
                    ],
                    // 'detail:ntext',
                    // 'department_head',
                    [
                        'attribute' => 'department_head',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->department_head ? $model->head0->thai_name : Yii::t('app', 'N/A');
                        },
                    ],
                    // 'warehouse_id',
                    [
                        'attribute' => 'warehouse_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->warehouse_id ? $model->warehouse->name : Yii::t('app', 'N/A');
                        },
                    ],
                    //'color',
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