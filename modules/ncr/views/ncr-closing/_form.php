<?php

use app\models\User;
use app\modules\ncr\models\Ncr;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-closing-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'ncr_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Ncr::find()->all(), 'id', function ($dataValue, $defaultValue) {
                            return
                                $dataValue->ncr_number
                                . ' | ' . $dataValue->process
                                . ' | ' . $dataValue->product_name
                                . '  | Lot: ' . $dataValue->lot
                                . '  | ' . Yii::$app->formatter->asDate($dataValue->production_date);
                        }),
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Select...'),
                            'disabled' => !$model->isNewRecord, // ถ้าไม่ใช่การเพิ่มข้อมูลใหม่ให้ disable
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>

                <div class="col-md-4 form-check">
                    <?= $form->field($model, 'accept')->dropDownList([
                        '1' => Yii::t('app', 'ยอมรับ'),
                        '2' => Yii::t('app', 'ไม่ยอมรับ'),
                    ], [
                        // 'prompt' => Yii::t('app', 'Select...'),
                        'required' => true,
                    ]); ?>

                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'auditor')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'department_id' => [3, 7]])->all(), 'id', 'thai_name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'qmr')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'role_id' => [5, 13]])->all(), 'id', 'thai_name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'accept_date')->widget(
                        DatePicker::class,
                        [
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
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
                <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>