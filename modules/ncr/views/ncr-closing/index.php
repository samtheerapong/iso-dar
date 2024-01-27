<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Ncr Closings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-closing-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'NCR Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-screwdriver-wrench"></i> ' . Yii::t('app', 'Settings'), ['/ncr/ncr/setings-menu'], ['class' => 'btn btn-warning']) ?>
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
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'accept',
                        'format' => 'html',
                        'value' => function ($model) {
                            if ($model->accept === 1) {
                                $status = '<span style="color: #004225;">' . Yii::t('app', 'Accepted') . '</span>';
                            } elseif ($model->accept === null) {
                                $status = '<span style="color: #CD5C08;">' . Yii::t('app', 'Pending') . '</span>';
                            } else {
                                $status = '<span style="color: #FE0000;">' . Yii::t('app', 'Not approved') . '</span>';
                            }
                            return $status;
                        },
                    ],
                
                    [
                        'attribute' => 'auditor',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->auditor ? $model->auditApprove->thai_name  : Yii::t('app', 'Pending');
                            $color = $model->auditor ? '#0F0F0F' : '#CD5C08';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'qmr',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->auditor ? $model->qmrApprove->thai_name  : Yii::t('app', 'Pending');
                            $color = $model->auditor ? '#0F0F0F' : '#CD5C08';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'accept_date',
                        'headerOptions' => ['style' => 'width:200px;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->accept_date ? Yii::$app->formatter->asDate($model->accept_date) : Yii::t('app', 'Pending');
                            $color = $model->accept_date ? '#0F0F0F' : '#CD5C08';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;', 'class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group btn-group-xs" role="group">{view} {action}</div>',
                        'buttons' => [
                            'action' => function ($url, $model, $key) {
                                return Html::a('<i class="fas fa-location-arrow"></i>', ['/ncr/ncr-closing/update', 'id' => $model->id], [
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