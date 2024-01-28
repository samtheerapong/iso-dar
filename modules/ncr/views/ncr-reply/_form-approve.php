<?php

use app\models\User;
use app\modules\ncr\models\NcrProcess;
use app\modules\ncr\models\NcrStatus;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrReply $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-reply-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-info">
                    <?= Yii::t('app', 'NCR') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 190px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'ncrs.ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->ncr_number ? $model->ncrs->ncr_number : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.created_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->created_date ? Yii::$app->formatter->asDate($model->ncrs->created_date) : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.monthly',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->year  ?  $model->ncrs->month0->month . ' (' . $model->ncrs->year0->year . ')' : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.department',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->department ? $model->ncrs->toDepartment->name . ' (' . $model->ncrs->toDepartment->code . ')' : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.process',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->process ? $model->ncrs->process : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.lot',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->lot ? $model->ncrs->lot : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.production_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->production_date ? Yii::$app->formatter->asDate($model->ncrs->production_date) : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->product_name ? $model->ncrs->product_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.customer_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->customer_name ? $model->ncrs->customer_name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->category_id ? $model->ncrs->category->name : Yii::t('app', 'N/A');
                                },
                            ],

                            [
                                'attribute' => 'ncrs.sub_category_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->sub_category_id ? $model->ncrs->subCategory->name : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.datail',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncrs->datail ? $model->ncrs->datail : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.report_by',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->report_by ? $model->ncrs->reporter->thai_name : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.department_issue',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->department_issue ? $model->ncrs->fromDepartment->name . ' (' . $model->ncrs->fromDepartment->code . ')' : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.action',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->ncrs->action ? $model->ncrs->action : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.ncr_status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->ncr_status_id ? $model->ncrs->ncrStatus->name : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'ncrs.docs',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncrs->docs ? $model->ncrs->listDownloadFiles('docs', 'auto') : Yii::t('app', 'N/A');
                                },
                            ],

                        ],
                    ]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-secondary">
                <div class="card-header text-white bg-primary">
                    <?= Yii::t('app', 'Reply') ?>
                </div>
                <div class="card-body table-responsive">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 190px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'reply_type_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->reply_type_id ? $model->replyType->name : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'quantity',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->quantity ? $model->quantity . ' ' . $model->unit : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'method',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    return $model->method ? $model->method : Yii::t('app', 'N/A');
                                },
                            ],
                            // 'operation_name',
                            [
                                'attribute' => 'operation_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->operation_name ? $model->operator->thai_name : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'operation_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->operation_date ? Yii::$app->formatter->asDate($model->operation_date) : Yii::t('app', 'N/A');
                                },
                            ],
                            // 'approve_name',
                            [
                                'attribute' => 'approve_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->approve_name ? $model->approver->thai_name : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'approve_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->approve_date ? Yii::$app->formatter->asDate($model->approve_date) : Yii::t('app', 'N/A');
                                },
                            ],
                            [
                                'attribute' => 'docs',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->docs ? $model->listDownloadFiles('docs', '100px') : Yii::t('app', 'N/A');
                                },
                            ],
                            // 'docs:ntext',
                            // 'ref',
                        ],
                    ]) ?>

                </div>
            </div>

            <div class="card border-secondary">
                <div class="card-header text-white bg-danger">
                    <?= Yii::t('app', 'Approve') ?>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $optionValue = $model->approve_name ? ['value' => Yii::$app->user->identity->id] : ['placeholder' => Yii::t('app', 'Select...')];
                            echo $form->field($model, 'approve_name')->widget(Select2::class, [
                                'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'role_id' => [3, 4, 5]])->all(), 'id', 'thai_name'),
                                // 'options' => $optionValue,
                                'options' => [$optionValue],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'approve_date')->widget(
                                DatePicker::class,
                                [
                                    'options' => [
                                        'required' => true,
                                    ],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        'autoclose' => true,
                                    ]
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-grid gap-2">
                        <?= Html::submitButton('<i class="fas fa-check"></i> ' . Yii::t('app', 'Approve'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>