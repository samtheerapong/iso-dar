<?php

use app\modules\engineer\models\Rp;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\RpListSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Rp Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rp-list-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa fa-circle-plus"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-circle-play"></i> ' . Yii::t('app', 'Repair'), ['/engineer/rp/index'], ['class' => 'btn btn-primary']) ?>
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
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
                    ],

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
                        'attribute' => 'request_id',
                        'format' => 'html',
                        'value' => function ($model) {
                             $rpValule = $model->request_id ?
                                $model->request0->repair_code . '  ' .
                                $model->request0->request_title :
                                Yii::t('app', 'N/A');

                                return  Html::a($rpValule , ['/engineer/rp/view', 'id' => $model->request_id]);
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'request_id',
                            'data' => ArrayHelper::map(Rp::find()->where(['en_status_id' => 1])->all(), 'id', function ($dataValue, $defaultValue) {
                                return
                                    $dataValue->repair_code . '  ' .
                                    $dataValue->request_title;
                            }),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],

                    [
                        'attribute' => 'detail_list',
                        'format' => 'html',
                        'value' => function ($model) {
                            $detail = $model->detail_list;
                            $remask = $model->remask;
                            $badge = ($remask !== null && $remask !== '') ? '<span class="badge badge-warning">' . $remask . '</span>' : '';
                            return $detail . '   ' . $badge;
                        },
                    ],
                    // 'request_date',
                    [
                        'attribute' => 'request_date',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->request_date ? Yii::$app->formatter->asDate($model->request_date) : 'N/A';
                        },
                    ],
                    // 'broken_date',
                    [
                        'attribute' => 'broken_date',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:150px;'],
                        'value' => function ($model) {
                            return $model->broken_date ? Yii::$app->formatter->asDate($model->broken_date) : 'N/A';
                        },
                    ],
                    // 'amount',
                    [
                        'attribute' => 'amount',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:60px;'],
                        'value' => function ($model) {
                            return $model->amount ? $model->amount : 'N/A';
                        },
                    ],
                    // 'location',
                    [
                        'attribute' => 'location',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:200px;'],
                        'value' => function ($model) {
                            return $model->location ? $model->location0->name : 'N/A';
                        },
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