<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\Ncr $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncr_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'department')->textInput() ?>

    <?= $form->field($model, 'ncr_process_id')->textInput() ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'production_date')->textInput() ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'sub_category_id')->textInput() ?>

    <?= $form->field($model, 'datail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'department_issue')->textInput() ?>

    <?= $form->field($model, 'report_by')->textInput() ?>

    <?= $form->field($model, 'action')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'docs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ncr_status_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
