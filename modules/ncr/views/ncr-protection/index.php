<?php

use app\modules\ncr\models\Ncr;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Ncr Protections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-protection-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-location-crosshairs"></i> ', ['/ncr/ncr/index'], ['class' => 'btn btn-secondary btn-sm', 'title' => Yii::t('app', 'NCR'), 'data-toggle' => 'tooltip']) ?>
            <?= Html::a('<i class="fa-solid fa-reply"></i> ', ['/ncr/ncr-reply/index'], ['class' => 'btn btn-secondary btn-sm', 'title' => Yii::t('app', 'Reply'), 'data-toggle' => 'tooltip']) ?>
            <?= Html::a('<i class="fa-solid fa-shield"></i> ', ['/ncr/ncr-protection/index'], ['class' => 'btn btn-secondary btn-sm', 'title' => Yii::t('app', 'Protection'), 'data-toggle' => 'tooltip']) ?>
            <?= Html::a('<i class="fa-solid fa-circle-check"></i> ', ['/ncr/ncr-closing/index'], ['class' => 'btn btn-secondary btn-sm', 'title' => Yii::t('app', 'Closing'), 'data-toggle' => 'tooltip']) ?>
            <?= Html::a('<i class="fa fa-refresh"></i>', ['index'], ['class' => 'btn btn-warning btn-sm', 'title' => Yii::t('app', 'Refresh'), 'data-toggle' => 'tooltip']) ?>
            <?= Html::a('<i class="fa-solid fa-download"></i> ', ['/ncr/export/export-protection'], ['class' => 'btn btn-danger btn-sm', 'title' => Yii::t('app', 'Export'), 'data-toggle' => 'tooltip']) ?>
        </p>
    </div>

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
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
                    ],
                    [
                        'attribute' => 'ncr_id',
                        'format' => 'html',
                        'headerOptions' => ['style' => 'width:450px;'],
                        'value' => function ($model) {
                            $rpValule = $model->ncr_id ?
                                $model->ncrs->ncr_number . ' ' .
                                '<br><span class="badge bg-danger">' . $model->ncrs->process . '</span>' . ' ' .
                                '<span class="badge bg-warning text-dark">' . $model->ncrs->product_name . '</span>'  . ' ' .
                                '<span class="badge bg-dark">' . $model->ncrs->lot . '</span>'   . ' ' .
                                '<span class="badge bg-info text-dark">' .  Yii::$app->formatter->asDate($model->ncrs->production_date) . '</span>' :
                                Yii::t('app', 'N/A');

                            return  Html::a($rpValule, ['/ncr/ncr/view', 'id' => $model->ncrs->id]);
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'ncr_id',
                            'data' => ArrayHelper::map(Ncr::find()->orderBy(['id' => SORT_DESC])->where(['ncr_status_id' => 2])->all(), 'id', function ($dataValue, $defaultValue) {
                                return
                                    $dataValue->ncr_number . ' | ' . $dataValue->product_name . ' (' . Yii::$app->formatter->asDate($dataValue->production_date) . ')';
                            }),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    // 'id',
                    [
                        'attribute' => 'ncr_cause_item',
                        'format' => 'html',
                        // 'headerOptions' => ['style' => 'width:250px;'],
                        'value' => function ($model) {
                            return $model->ncr_cause_item ? $model->ncr_cause_item : Yii::t('app', 'Pending');
                        },
                    ],
                    // [
                    //     'attribute' => 'issue',
                    //     'format' => 'html',
                    //     'value' => function ($model) {
                    //         return $model->issue ? $model->issue : Yii::t('app', 'Pending');
                    //     },
                    // ],
                    // [
                    //     'attribute' => 'action',
                    //     'format' => 'html',
                    //     'value' => function ($model) {
                    //         return $model->action ? $model->action : Yii::t('app', 'Pending');
                    //     },
                    // ],
                    [
                        'attribute' => 'schedule_date',
                        'format' => 'html',
                        // 'headerOptions' => ['style' => 'width:250px;'],
                        'value' => function ($model) {
                            return $model->schedule_date ? Yii::$app->formatter->asDate($model->schedule_date) : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'operator',
                        'format' => 'html',
                        // 'headerOptions' => ['style' => 'width:250px;'],
                        'value' => function ($model) {
                            return $model->operator ? $model->operator0->thai_name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {action}</div>',
                        'buttons' => [
                            'action' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-shield"></i>', ['update', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Action'),
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