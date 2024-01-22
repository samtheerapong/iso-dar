<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrProtection $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-protection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncr_id')->textInput() ?>

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
