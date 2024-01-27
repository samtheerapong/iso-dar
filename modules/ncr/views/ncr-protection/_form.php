<?php

use app\modules\ncr\models\Ncr;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrProtection $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-protection-form">

    <?php $form = ActiveForm::begin(); ?>

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

    <?= $form->field($model, 'ncr_cause_id')->textInput() ?>

    <?= $form->field($model, 'issue')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'action')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'schedule_date')->textInput() ?>

    <?= $form->field($model, 'operator')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
