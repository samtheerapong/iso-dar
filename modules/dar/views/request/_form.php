<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\dar\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'document_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rev')->textInput() ?>

    <?= $form->field($model, 'request_type_id')->textInput() ?>

    <?= $form->field($model, 'request_category_id')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'request_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'document_age')->textInput() ?>

    <?= $form->field($model, 'public_date')->textInput() ?>

    <?= $form->field($model, 'request_status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
