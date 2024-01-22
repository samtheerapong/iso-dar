<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrSolvingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-solving-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ncr_id') ?>

    <?= $form->field($model, 'solving_type_id') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'proceed') ?>

    <?php // echo $form->field($model, 'operation_date') ?>

    <?php // echo $form->field($model, 'operation_name') ?>

    <?php // echo $form->field($model, 'ncr_concession_id') ?>

    <?php // echo $form->field($model, 'customer_name') ?>

    <?php // echo $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'cause') ?>

    <?php // echo $form->field($model, 'approve_name') ?>

    <?php // echo $form->field($model, 'approve_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
