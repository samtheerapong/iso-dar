<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\search\TeamSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="team-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'team_name') ?>

    <?= $form->field($model, 'logo_team') ?>

    <?= $form->field($model, 'head_team') ?>

    <?= $form->field($model, 'technician1') ?>

    <?php // echo $form->field($model, 'technician2') ?>

    <?php // echo $form->field($model, 'technician3') ?>

    <?php // echo $form->field($model, 'technician4') ?>

    <?php // echo $form->field($model, 'technician5') ?>

    <?php // echo $form->field($model, 'technician6') ?>

    <?php // echo $form->field($model, 'technician7') ?>

    <?php // echo $form->field($model, 'technician8') ?>

    <?php // echo $form->field($model, 'technician9') ?>

    <?php // echo $form->field($model, 'technician10') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
