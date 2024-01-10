<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItDemo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="it-demo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-md-12">
            <?= $model->getAvatarViewer() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'avatar')->fileInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?= $model->getPhotosViewer() ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'photos[]')->fileInput(['multiple' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>