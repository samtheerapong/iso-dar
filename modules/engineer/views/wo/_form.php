<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Wo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="wo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rp_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'work_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_date')->textInput() ?>

    <?= $form->field($model, 'machine_id')->textInput() ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_type_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'work_start')->textInput() ?>

    <?= $form->field($model, 'work_end')->textInput() ?>
    
    <?= $form->field($model, 'ref')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'workclass_id')->textInput() ?>

    <?= $form->field($model, 'work_method')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'service_date')->textInput() ?>

    <?= $form->field($model, 'frequency')->textInput() ?>

    <?= $form->field($model, 'remask')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
