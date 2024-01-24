<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-closing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncr_id')->textInput() ?>

    <?= $form->field($model, 'accept')->textInput() ?>

    <?= $form->field($model, 'auditor')->textInput() ?>

    <?= $form->field($model, 'qmr')->textInput() ?>

    <?= $form->field($model, 'accept_date')->textInput() ?>

    <?= $form->field($model, 'ncr_closingcol')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
