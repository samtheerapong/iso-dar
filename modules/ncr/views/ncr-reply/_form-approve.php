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

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'ncrs.ncr_number',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_id ? $model->ncrs->ncr_number : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.process',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_id ? $model->ncrs->process : 'N/A';
                                },
                            ],
                            [
                                'attribute' => 'ncrs.product_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->ncr_id ? $model->ncrs->product_name : 'N/A';
                                },
                            ],
                            'reply_type_id',
                            'quantity',
                            'unit',
                            'method:ntext',
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
                        ],
                    ]) ?>
                </div>

                <div class="col-md-4">
                    <div class="row">

                        <div class="alert alert-light" role="alert">
                            <?= $model->docs ?>
                        </div>


                        <div class="alert alert-light" role="alert">
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
        </div>

        <div class="card-footer">
            <div class="d-grid gap-2">
                <?= Html::submitButton('<i class="fas fa-check"></i> ' . Yii::t('app', 'Approve'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>