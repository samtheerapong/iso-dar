<?php

use app\models\User;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrReplyType;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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


                <div class="col-md-6">
                    <?= $form->field($model, 'ncr_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Ncr::find()->where(['ncr_status_id' => [1, 2]])->all(), 'id', function ($dataValue, $defaultValue) {
                            return
                                $dataValue->ncr_number
                                . '  (' . $dataValue->process
                                . ') : ' . $dataValue->product_name
                                . '  Lot: ' . $dataValue->lot;
                            // . '  | ' . Yii::$app->formatter->asDate($dataValue->created_at);
                        }),
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Select...'),
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'reply_type_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(NcrReplyType::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-1">
                    <?= $form->field($model, 'quantity')->textInput() ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'method')->textarea(['rows' => 2]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'operation_name')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10])->all(), 'id', 'thai_name'),
                        'options' => ['value' => Yii::$app->user->identity->id],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'operation_date')->widget(
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

                <div class="col-md-12">
                    <?= $form->field($model, 'docs')->textarea(['rows' => 1]) ?>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-grid gap-2">
                <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>