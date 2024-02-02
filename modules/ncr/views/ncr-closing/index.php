<?php

use app\models\User;
use app\modules\ncr\models\Ncr;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Ncr Closings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-closing-index">

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
            <?= Html::a('<i class="fa-solid fa-download"></i> ', ['/ncr/export/export-closing'], ['class' => 'btn btn-danger btn-sm', 'title' => Yii::t('app', 'Export'), 'data-toggle' => 'tooltip']) ?>
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
                        'contentOptions' => ['style' => 'width:450px;'],
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
                            'data' => ArrayHelper::map(Ncr::find()->orderBy(['id' => SORT_DESC])->where(['ncr_status_id' => [3]])->all(), 'id', function ($dataValue, $defaultValue) {
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
                    [
                        'attribute' => 'accept',
                        'format' => 'html',
                        'filter' => [
                            // '' => Yii::t('app', 'Pending'),
                            '1' => Yii::t('app', 'Accepted'),
                            '0' => Yii::t('app', 'Not approved'),
                        ],
                        'value' => function ($model) {
                            if ($model->accept === 1) {
                                $status = '<span style="color: #1A5D1A;">' . Yii::t('app', 'Accepted') . '</span>';
                            } elseif ($model->accept === null) {
                                $status = '<span style="color: #DC5F00;">' . Yii::t('app', 'Pending') . '</span>';
                            } else {
                                $status = '<span style="color: #D80032;">' . Yii::t('app', 'Not approved') . '</span>';
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
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'auditor',
                            'data' => ArrayHelper::map(User::find()->orderBy(['id' => SORT_DESC])->where(['rule_id' => 1])->all(), 'id', function ($dataValue, $defaultValue) {
                                return
                                    $dataValue->thai_name;
                            }),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'qmr',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->auditor ? $model->qmrApprove->thai_name  : Yii::t('app', 'Pending');
                            $color = $model->auditor ? '#0F0F0F' : '#CD5C08';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'qmr',
                            'data' => ArrayHelper::map(User::find()->orderBy(['id' => SORT_DESC])->where(['role_id' => 5])->all(), 'id', function ($dataValue, $defaultValue) {
                                return
                                    $dataValue->thai_name;
                            }),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'language' => 'th',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
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