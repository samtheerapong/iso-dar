<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\ColorInput;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\JobType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="job-type-form">

   
<?php $form = ActiveForm::begin(); ?>

<div class="card border-secondary">
    <div class="card-header text-white bg-secondary">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="card-body">

        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'color')->widget(ColorInput::class, ['options' => ['placeholder' => Yii::t('app', 'Select...')],]); ?>
    </div>

    <div class="card-footer">
        <div class="form-group">
            <div class="d-grid gap-2">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>

</div>
