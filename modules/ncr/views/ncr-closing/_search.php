<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrClosingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-closing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ncr_id') ?>

    <?= $form->field($model, 'accept') ?>

    <?= $form->field($model, 'auditor') ?>

    <?= $form->field($model, 'qmr') ?>

    <?php // echo $form->field($model, 'accept_date') ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
