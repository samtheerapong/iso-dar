<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrProtectionSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-protection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ncr_id') ?>

    <?= $form->field($model, 'ncr_cause_item') ?>

    <?= $form->field($model, 'issue') ?>

    <?= $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'schedule_date') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
