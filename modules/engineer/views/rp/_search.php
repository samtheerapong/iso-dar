<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\RpSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'repair_code') ?>

    <?= $form->field($model, 'priority') ?>

    <?= $form->field($model, 'urgency') ?>

    <?= $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'request_by') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'request_title') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'en_status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
