<?php

use app\modules\nfc\models\Unit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\search\UnitSearcn $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Units');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-index">

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
                            return Html::a($model->code, ['view', 'id' => $model->id]);
                        },
                    ],

                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->name;
                        },
                    ],
                    [
                        'attribute' => 'active',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:100px;'],
                        'value' => function ($model) {
                            return $model->active === 1 ? '<span class="badge" style="background-color:#1A5D1A">Yes</span>' : '<span class="badge" style="background-color:#FE0000">No</span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'active',
                            'data' => ['1' => 'Yes', '0' => 'No'],
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
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {update} {delete}</div>',

                    ],
                ],
            ]); ?>

        </div>
    </div>
</div>