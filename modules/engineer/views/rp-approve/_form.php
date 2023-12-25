<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\RpApprove $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rp-approve-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wo_id')->textInput() ?>

    <?= $form->field($model, 'approver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_date')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
