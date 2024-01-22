<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrReply $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-reply-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncr_id')->textInput() ?>

    <?= $form->field($model, 'reply_type_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proceed')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'operation_date')->textInput() ?>

    <?= $form->field($model, 'operation_name')->textInput() ?>

    <?= $form->field($model, 'approve_name')->textInput() ?>

    <?= $form->field($model, 'approve_date')->textInput() ?>

    <?= $form->field($model, 'docs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
