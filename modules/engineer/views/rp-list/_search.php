<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\RpListSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rp-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'request_id') ?>

    <?= $form->field($model, 'detail_list') ?>

    <?= $form->field($model, 'request_date') ?>

    <?= $form->field($model, 'broken_date') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
