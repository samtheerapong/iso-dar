<?php

use app\models\User;
use app\modules\nfc\models\Warehouse;
use kartik\widgets\ColorInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\Department $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'department_head')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'warehouse_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Warehouse::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-8">
                    <?= $form->field($model, 'detail')->textInput() ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'color')->widget(ColorInput::class, ['options' => ['placeholder' => Yii::t('app', 'Select...')],]); ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'active')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="form-group">
                <div class="d-grid">
                    <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

    </div>


    <?php ActiveForm::end(); ?>

</div>