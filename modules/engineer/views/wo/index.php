<?php

use app\modules\engineer\models\Wo;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\widgets\Select2;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\WoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Wos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wo-index">
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

                    // 'id',
                    [
                        'attribute' => 'rp_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:150px;'],
                        'value' => function ($model) {
                            return Html::a($model->rp->repair_code, ['view', 'id' => $model->id]);
                        },
                    ],
                    [
                        'attribute' => 'work_code',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:150px;'],
                        'value' => function ($model) {
                            return Html::a($model->work_code, ['view', 'id' => $model->id]);
                        },
                    ],
                    // 'rp_id',
                    [
                        'attribute' => 'title',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a($model->title, ['view', 'id' => $model->id]);
                        },
                    ],
                    // 'description:ntext',
                    [
                        'attribute' => 'work_date',
                        'format' => 'date',
                        'contentOptions' => ['style' => 'width:140px;'],
                        'value' => function ($model) {
                            return $model->work_date;
                        },
                    ],
                    // 'machine_id',
                    [
                        'attribute' => 'machine_id',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:140px;'],
                        'value' => function ($model) {
                            return $model->machine_id;
                        },
                    ],
                    // 'location',
                    [
                        'attribute' => 'location',
                        'format' => 'html',
                        'contentOptions' => ['style' => 'width:140px;'],
                        'value' => function ($model) {
                            return $model->location;
                        },
                    ],
                    //'work_type_id',
                    //'work_start',
                    //'work_end',
                    //'ref:ntext',
                    //'category_id',
                    //'work_method:ntext',
                    //'service_date',
                    //'frequency',
                    //'remask:ntext',
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