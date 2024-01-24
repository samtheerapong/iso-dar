<?php

use app\modules\engineer\models\RpList;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrReply;
use app\modules\ncr\models\NcrReplyType;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

?>
<div class="rp-list-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
            ],

            [
                'attribute' => 'reply_type_id',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->reply_type_id ? $model->replyType->name : 'ยังไม่ได้ดำเนินการ';
                    $color = $model->reply_type_id ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'reply_type_id',
                    'data' => ArrayHelper::map(NcrReplyType::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Select...')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],

            [
                'attribute' => 'quantity',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->quantity ? $model->quantity . ' ' . $model->unit  : 'N/A';
                    $color = $model->quantity ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'quantity',
                    'data' => ArrayHelper::map(NcrReply::find()->all(), 'quantity', 'quantity'),
                    'options' => ['placeholder' => Yii::t('app', 'Select...')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            // 'method',
            'operation_name',
            'operation_date:date',
            'approve_name',
            'approve_date:date',
           
            [
                'class' => 'kartik\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:250px;'],
                'contentOptions' => ['class' => 'text-center'],
                'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                'template' => '<div class="btn-group btn-group-xs" role="group">{view} {action} {approve}</div>',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i>', ['/ncr/ncr-reply/view', 'id' => $model->id], [
                            'title' => Yii::t('app', 'View'),
                            'class' => 'btn btn-outline-dark btn-sm',
                        ]);
                    },
                    'action' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-location-arrow"></i>', ['/ncr/ncr-reply/update', 'id' => $model->id], [
                            'title' => Yii::t('app', 'Action'),
                            'class' => 'btn btn-outline-dark btn-sm',
                        ]);
                    },
                    'approve' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-check-circle"></i>', ['/ncr/ncr-reply/approve', 'id' => $model->id], [
                            'title' => Yii::t('app', 'Approve'),
                            'class' => 'btn btn-outline-dark btn-sm',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>