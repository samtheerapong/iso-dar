<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\WoList $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="wo-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'workorder_id')->textInput() ?>

    <?= $form->field($model, 'working_date')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'problem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'images')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lock_out')->textInput() ?>

    <?= $form->field($model, 'tag_out')->textInput() ?>

    <?= $form->field($model, 'checker')->textInput() ?>

    <?= $form->field($model, 'recheck_electric')->textInput() ?>

    <?= $form->field($model, 'recheck_mechanics')->textInput() ?>

    <?= $form->field($model, 'rechecker')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
