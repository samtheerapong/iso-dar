<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\Ncr $model */

$this->title = $model->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ncr-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['/ncr/ncr/index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa-solid fa-house-circle-exclamation"></i> ' . Yii::t('app', 'Reply'), ['/ncr/ncr-reply/index'], ['class' => 'btn btn-info']) ?>
        </p>

        <p style="text-align: right;">
            <?= Html::a('<i class="fa-solid fa-pen"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= $model->ncr_number  . ' | ' . Yii::t('app', 'Status') . ' = ' . $model->ncrStatus->name ?>
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
                                    return $model->ncr_number ? $model->ncr_number : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->created_date ? Yii::$app->formatter->asDate($model->created_date) : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'monthly',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->year  ?  $model->month0->month . ' (' . $model->year0->year . ')' : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->department ? $model->toDepartment->name . ' (' . $model->toDepartment->code . ')' : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'process',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->process ? $model->process : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->lot ? $model->lot : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->production_date ? Yii::$app->formatter->asDate($model->production_date) : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],
                            [
                                'attribute' => 'product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->product_name ? $model->product_name : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->customer_name ? $model->customer_name : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->category_id ? $model->category->name : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                            [
                                'attribute' => 'sub_category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->sub_category_id ? $model->subCategory->name : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],
                            [
                                'attribute' => 'datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->datail ? $model->datail : Yii::t('app', Yii::t('app', 'Pending'));
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
                                    return $model->action ? $model->action : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],
                            [
                                'attribute' => 'ncr_status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_status_id ? $model->ncrStatus->name : Yii::t('app', Yii::t('app', 'Pending'));
                                },
                            ],

                        ],
                    ]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Yii::t('app', 'Files') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= $model->listDownloadFiles('docs', 'auto') ?>
                </div>
            </div>
        </div>
    </div>



    <div class="card border-secondary">
        <div class="card-header text-white bg-warning">
            <?= Yii::t('app', 'Reply') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrReplyItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [
                    // [
                    //     'class' => 'kartik\grid\ActionColumn',
                    //     'header'=>'View',
                    //     'headerOptions' => ['style' => 'width:450px;'],
                    //     'contentOptions' => ['class' => 'text-center'],
                    //     'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                    //     'template' => '<div class="btn-group btn-group-xs" role="group">{view}</div>',
                    //     'buttons' => [
                    //         'view' => function ($url, $model, $key) {
                    //             return Html::a('<i class="fa fa-eye"></i>', ['/ncr/ncr-reply/view', 'id' => $model->id], [
                    //                 'title' => Yii::t('app', 'View'),
                    //                 'class' => 'btn btn-outline-dark btn-sm',
                    //             ]);
                    //         },
                    //     ],
                    // ],


                    [
                        'attribute' => 'reply_type_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->reply_type_id ?  Html::a($model->replyType->name, ['/ncr/ncr-reply/view', 'id' => $model->id])  : Yii::t('app', Yii::t('app', 'Pending'));
                        },
                    ],
                    [
                        'attribute' => 'quantity',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->quantity ? $model->quantity . ' ' . $model->unit : Yii::t('app', Yii::t('app', 'Pending'));
                        },
                    ],
                    [
                        'attribute' => 'method',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->method . ' <i>' . $model->cause . '</i>';
                        },
                    ],
                    // 'operation_name',
                    [
                        'attribute' => 'operation_name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->operation_name ? $model->operator->thai_name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'operation_date',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', Yii::t('app', 'Pending'));
                        },
                    ],
                    // 'approve_name',
                    [
                        'attribute' => 'approve_name',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->approve_name ? $model->approver->thai_name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'approve_date',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->approve_date ? Yii::$app->formatter->asDate($model->approve_date) : Yii::t('app', Yii::t('app', 'Pending'));
                        },
                    ],
                    [
                        'attribute' => 'docs',
                        // 'headerOptions' => ['style' => 'width:10%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->docs ? $model->listDownloadFiles('docs', '100px') : Yii::t('app', Yii::t('app', 'Pending'));
                        },
                    ],

                ],
            ]); ?>


        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-primary">
            <?= Yii::t('app', 'Protection') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrProtectItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [
                    // [
                    //     'class' => 'kartik\grid\ActionColumn',
                    //     'headerOptions' => ['style' => 'width:450px;'],
                    //     'contentOptions' => ['class' => 'text-center'],
                    //     'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                    //     'template' => '<div class="btn-group btn-group-xs" role="group">{view}</div>',
                    //     'buttons' => [
                    //         'view' => function ($url, $model, $key) {
                    //             return Html::a('<i class="fa fa-eye"></i>', ['update', 'id' => $model->id], [
                    //                 'title' => Yii::t('app', 'View'),
                    //                 'class' => 'btn btn-outline-dark btn-sm',
                    //             ]);
                    //         },
                    //     ],
                    // ],

                    [
                        'attribute' => 'ncr_cause_id',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->ncr_cause_id ? $model->ncrCause->name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'issue',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->issue ? $model->issue : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'action',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->action ? $model->action : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'schedule_date',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->schedule_date ? Yii::$app->formatter->asDate($model->schedule_date) : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'operator',
                        'headerOptions' => ['style' => 'width:20%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->operator ? $model->getProtectUser()->thai_name : Yii::t('app', 'Pending');
                        },
                    ],

                ],
            ]); ?>
        </div>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-success">
            <?= Yii::t('app', 'Closing') ?>
        </div>
        <div class="card-body table-responsive">

            <?= GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => $model->getNcrClosingItem(),
                ]),
                'hover' => true,
                'summary' => '',
                'columns' => [
                    // [
                    //     'class' => 'kartik\grid\ActionColumn',
                    //     'headerOptions' => ['style' => 'width:450px;'],
                    //     'contentOptions' => ['class' => 'text-center'],
                    //     'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                    //     'template' => '<div class="btn-group btn-group-xs" role="group">{view}</div>',
                    //     'buttons' => [
                    //         'view' => function ($url, $model, $key) {
                    //             return Html::a('<i class="fa fa-eye"></i>', ['/ncr/ncr-closing/view', 'id' => $model->id], [
                    //                 'title' => Yii::t('app', 'View'),
                    //                 'class' => 'btn btn-outline-dark btn-sm',
                    //             ]);
                    //         },
                    //     ],
                    // ],
                    // 'accept',
                    [
                        'attribute' => 'accept',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->accept == 1 ? Yii::t('app', 'ยอมรับ') : Yii::t('app', 'ไม่ยอมรับ');
                        },
                    ],
                    // 'auditor',
                    // 'qmr',
                    [
                        'attribute' => 'auditor',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->auditor ? $model->auditApprove->thai_name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'qmr',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->qmr ? $model->qmrApprove->thai_name : Yii::t('app', 'Pending');
                        },
                    ],
                    [
                        'attribute' => 'accept_date',
                        'headerOptions' => ['style' => 'width:25%;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $value = $model->accept_date ? Yii::$app->formatter->asDate($model->accept_date) : 'ยังไม่ได้ดำเนินการ';
                            $color = $model->accept_date ? 'black' : 'red';
                            return '<span style="color:' . $color . ';">' . $value . '</span>';
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>

</div>