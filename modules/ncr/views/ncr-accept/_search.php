<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrAcceptSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-accept-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ncr_id') ?>

    <?= $form->field($model, 'ncr_concession_id') ?>

    <?= $form->field($model, 'customer_name') ?>

    <?= $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'cause') ?>

    <?php // echo $form->field($model, 'approve_name') ?>

    <?php // echo $form->field($model, 'approve_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
