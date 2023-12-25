<?php

use app\models\User;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Technician $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="technician-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                <?= $form->field($model, 'photo')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => false
                        ],
                        'pluginOptions' => [
                            'initialPreview'=> $model->photo ? Html::img($model->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $model->id]) : [],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                        ],
                    ]); ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'manday')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '0.01']) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'head')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
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