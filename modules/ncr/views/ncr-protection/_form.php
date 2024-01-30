<?php

use app\models\User;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrCause;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrProtection $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-protection-form">

    <?php $form = ActiveForm::begin(); ?>

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
                <div class="col-md-6">
                    <?= $form->field($model, 'ncr_cause_item')->widget(Select2::class, [
                        // 'theme' => Select2::THEME_KRAJEE_BS5,
                        'data' => ArrayHelper::map(NcrCause::find()->where(['active' => 1])->all(), 'name', 'name'),
                        'options' => ['multiple' => true, 'placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'issue')->textarea(['rows' => 3]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'action')->textarea(['rows' => 3]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'schedule_date')->widget(
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
                <div class="col-md-6">
                    <?= $form->field($model, 'operator')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'role_id' => [3, 4, 5, 6, 10]])->all(), 'id', 'thai_name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
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