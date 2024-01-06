<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\JobsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jobs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'request_date') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'request_by') ?>

    <?php // echo $form->field($model, 'job_department') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'equipment') ?>

    <?php // echo $form->field($model, 'job_type') ?>

    <?php // echo $form->field($model, 'urgency') ?>

    <?php // echo $form->field($model, 'job_status') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
