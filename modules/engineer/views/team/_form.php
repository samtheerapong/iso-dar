<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Team $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'team_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo_team')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'head_team')->textInput() ?>

    <?= $form->field($model, 'technician1')->textInput() ?>

    <?= $form->field($model, 'technician2')->textInput() ?>

    <?= $form->field($model, 'technician3')->textInput() ?>

    <?= $form->field($model, 'technician4')->textInput() ?>

    <?= $form->field($model, 'technician5')->textInput() ?>

    <?= $form->field($model, 'technician6')->textInput() ?>

    <?= $form->field($model, 'technician7')->textInput() ?>

    <?= $form->field($model, 'technician8')->textInput() ?>

    <?= $form->field($model, 'technician9')->textInput() ?>

    <?= $form->field($model, 'technician10')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
