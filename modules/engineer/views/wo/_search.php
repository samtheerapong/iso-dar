<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\WoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="wo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'rp_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'work_code') ?>

    <?php // echo $form->field($model, 'work_date') ?>

    <?php // echo $form->field($model, 'machine_id') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'work_type_id') ?>

    <?php // echo $form->field($model, 'work_start') ?>

    <?php // echo $form->field($model, 'work_end') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'work_method') ?>

    <?php // echo $form->field($model, 'service_date') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
