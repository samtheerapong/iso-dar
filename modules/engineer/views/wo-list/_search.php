<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\WoListSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="wo-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'workorder_id') ?>

    <?= $form->field($model, 'working_date') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'problem') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'lock_out') ?>

    <?php // echo $form->field($model, 'tag_out') ?>

    <?php // echo $form->field($model, 'checker') ?>

    <?php // echo $form->field($model, 'recheck_electric') ?>

    <?php // echo $form->field($model, 'recheck_mechanics') ?>

    <?php // echo $form->field($model, 'rechecker') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
