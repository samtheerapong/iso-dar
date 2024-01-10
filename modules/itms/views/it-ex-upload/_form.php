<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItExUpload $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="it-ex-upload-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'img_ref')->hiddenInput()->label(false) ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Uploads') ?>
        </div>
        <div class="card-body">
            <div class="row">

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <div class="form-group field-upload_files">
                    <label class="control-label" for="upload_image[]"> ภาพถ่าย </label>
                    <div>
                        <?= FileInput::widget([
                            'name' => 'upload_image[]',
                            'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                            'pluginOptions' => [
                                'overwriteInitial' => false,
                                'initialPreviewShowDelete' => true,
                                'initialPreview' => $initialPreview,
                                'initialPreviewConfig' => $initialPreviewConfig,
                                'uploadUrl' => Url::to(['upload-img']),
                                'uploadExtraData' => [
                                    'img_ref' => $model->img_ref,
                                ],
                                'maxFileCount' => 10
                            ]
                        ]);
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>
</div>
</div>