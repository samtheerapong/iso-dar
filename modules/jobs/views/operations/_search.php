<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\OperationsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="operations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'operator_by') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'sparepart_list') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
