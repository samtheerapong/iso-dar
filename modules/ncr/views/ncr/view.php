<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'NCR'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-pen"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= '<i class="fa-solid fa-location-crosshairs"></i> ' . Yii::t('app', 'NCR') . ' : ' . $model->ncr_number. ' ' .'<span class="badge" style="background-color:' . $model->ncrStatus->color . '">' . $model->ncrStatus->name.'</span>' ?>
                </div>
                <div class="card-body table-responsive">

                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_number ? $model->ncr_number  : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_date ? Yii::$app->formatter->asDate($model->created_date) : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'monthly',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->year  ?  $model->month0->month . ' (' . $model->year0->year . ')' : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->department ? $model->toDepartment->name . ' (' . $model->toDepartment->code . ')' : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'process',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->process ? $model->process : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->lot ? $model->lot : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->production_date ? Yii::$app->formatter->asDate($model->production_date) : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->product_name ? $model->product_name : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->customer_name ? $model->customer_name : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->category_id ? $model->category->name : Yii::t('app', 'Pending');
                                },
                            ],

                            [
                                'attribute' => 'sub_category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->sub_category_id ? $model->subCategory->name : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->datail ? $model->datail : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'report_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->report_by ? $model->reporter->thai_name : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'department_issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->department_issue ? $model->fromDepartment->name . ' (' . $model->fromDepartment->code . ')' : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'action',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->action ? $model->action : Yii::t('app', 'Pending');
                                },
                            ],
                            // [
                            //     'attribute' => 'ncr_status_id',
                            //     'format' => 'html',
                            //     'value' => function ($model) {
                            //         return $model->ncr_status_id ? '<span style="color:' . $model->ncrStatus->color . '">' . $model->ncrStatus->name.'</span>' : Yii::t('app', 'Pending');
                            //     },
                            // ],

                        ],
                    ]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-secondary">
                <div class="card-header text-white bg-dark">
                    <?= '<i class="fa-solid fa-file"></i> ' . Yii::t('app', 'Attach file') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= $model->listDownloadFiles('docs', 'auto') ?>
                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-info">
                    <?= '<i class="fa-solid fa-history"></i> ' . Yii::t('app', 'Logs') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 180px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [

                            [
                                'attribute' => 'created_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_by ? $model->reporter->thai_name : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_at ? Yii::$app->formatter->asDate($model->created_at) : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'updated_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->updated_by ? $model->reporter->thai_name : Yii::t('app', 'Pending');
                                },
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->updated_at ? Yii::$app->formatter->asDate($model->updated_at) : Yii::t('app', 'Pending');
                                },
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>



    <div class="card border-secondary">
        <div class="card-header text-white bg-warning">
            <?= '<i class="fa-solid fa-reply"></i> ' . Yii::t('app', 'Reply') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrReplyItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [

                    [
                        'attribute' => 'reply_type_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->reply_type_id ? $model->replyType->name : Yii::t('app', 'Pending');
                            $color = $model->reply_type_id ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->quantity ? $model->quantity . ' ' . $model->unit : Yii::t('app', 'Pending');
                            $color = $model->quantity ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],

                    [
                        'attribute' => 'operation_name',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->operation_name ? $model->operator->thai_name : Yii::t('app', 'Pending');
                            $color = $model->operation_name ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'operation_date',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', 'Pending');
                            $color = $model->operation_date ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    // 'approve_name',
                    [
                        'attribute' => 'approve_name',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->approve_name ? $model->approver->thai_name : Yii::t('app', 'Pending');
                            $color = $model->approve_name ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'approve_date',
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->approve_date ? Yii::$app->formatter->asDate($model->approve_date) : Yii::t('app', 'Pending');
                            $color = $model->approve_date ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'docs',
                        // 'headerOptions' => ['style' => 'width:10%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->docs ? $model->listDownloadFiles('docs', '100px') : Yii::t('app', 'Pending');
                            $color = $model->docs ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],

                ],
            ]); ?>


        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-primary">
            <?= '<i class="fa-solid fa-shield"></i> ' . Yii::t('app', 'Protection') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrProtectItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [

                    [
                        'attribute' => 'ncr_cause_item',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->ncr_cause_item ? $model->ncr_cause_item : Yii::t('app', 'Pending');
                            $color = $model->ncr_cause_item ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'issue',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->issue ? $model->issue : Yii::t('app', 'Pending');
                            $color = $model->issue ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'action',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->action ? $model->action : Yii::t('app', 'Pending');
                            $color = $model->action ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'schedule_date',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->schedule_date ? Yii::$app->formatter->asDate($model->schedule_date) : Yii::t('app', 'Pending');
                            $color = $model->schedule_date ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'operator',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->operator ? $model->operator0->thai_name : Yii::t('app', 'Pending');
                            $color = $model->operator ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],

                ],
            ]); ?>
        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-success">
            <?= '<i class="fa-solid fa-check"></i> ' . Yii::t('app', 'Closing') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrClosingItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [

                    [
                        'attribute' => 'accept',
                        'format' => 'html',
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
                    // 'auditor',
                    // 'qmr',
                    [
                        'attribute' => 'auditor',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->auditor ? $model->auditApprove->thai_name : Yii::t('app', 'Pending');
                            $color = $model->auditor ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'qmr',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->qmr ? $model->qmrApprove->thai_name : Yii::t('app', 'Pending');
                            $color = $model->qmr ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'accept_date',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->accept_date ? Yii::$app->formatter->asDate($model->accept_date) : Yii::t('app', 'Pending');
                            $color = $model->accept_date ? '#000000' : '#DC5F00';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>