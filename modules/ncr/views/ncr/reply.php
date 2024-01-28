<?php

use yii\helpers\Html;
use kartik\grid\GridView;

?>
<div class="rp-list-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => [$searchModel],
        'summary' => '',
        'columns' => [
            // [
            //     'class' => 'yii\grid\SerialColumn',
            //     'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'],
            // ],
            [
                'attribute' => 'reply_type_id',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->reply_type_id ? $model->replyType->name : Yii::t('app', 'Pending');
                    $color = $model->reply_type_id ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },

            ],
            [
                'attribute' => 'operation_name',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->operation_name ? $model->operator->thai_name : Yii::t('app', 'Pending');
                    $color = $model->operation_name ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },

            ],
            [
                'attribute' => 'operation_date',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', 'Pending');
                    $color = $model->operation_date ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },

            ],
            [
                'attribute' => 'approve_name',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->approve_name ? $model->approver->thai_name : Yii::t('app', 'Pending');
                    $color = $model->approve_name ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },

            ],
            [
                'attribute' => 'approve_date',
                'format' => 'html',
                'value' => function ($model) {
                    $value = $model->approve_date ? Yii::$app->formatter->asDate($model->approve_date) : Yii::t('app', 'Pending');
                    $color = $model->approve_date ? 'black' : 'red';
                    return '<span style="color:' . $color . ';">' . $value . '</span>';
                },

            ],
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