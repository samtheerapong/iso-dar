<?php

use kartik\widgets\Select2;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\TechnicianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Technicians');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-retweet"></i> ' . Yii::t('app', 'Card List'), ['card'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Configs'), ['/engineer/default/setings-menu'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Total : {count} User', ['count' => $dataProvider->totalCount]) ?>
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
                    // 'photo',

                    [
                        'attribute' => 'photo',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:50px;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(Html::img($model->getPhotoViewer(), ['class' => 'img', 'alt' => $model->id, 'height' => '50px']), ['view', 'id' => $model->id]);
                        },
                        'filter' => false,
                    ],

                    [
                        'attribute' => 'code',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:80px;'],
                        'value' => function ($model) {
                            return $model->code;
                        },
                    ],

                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->name;
                        },
                    ],
                    // 'tel',
                    [
                        'attribute' => 'tel',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:80px;'],
                        'value' => function ($model) {
                            return $model->tel;
                        },
                    ],
                    // 'head',
                    [
                        'attribute' => 'email',
                        'format' => 'email',
                        'value' => function ($model) {
                            return $model->email;
                        },
                    ],

                    [
                        'attribute' => 'head',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->head ? $model->head0->thai_name : Yii::t('app', 'N/A');
                        },
                    ],
                    // 'active',
                    [
                        'attribute' => 'active',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:100px;'],
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