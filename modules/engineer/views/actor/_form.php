<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Actor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="actor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'en_wo_list_id')->textInput() ?>

    <?= $form->field($model, 'technician_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
