<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ExUploads $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ex-uploads-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    <div class="col-md-12">
        <div class="form-group field-upload_files">
            <label class="control-label" for="images[]"> <?= Yii::t('app', 'Images') ?> </label>
            <div>
                <?= FileInput::widget([
                    'name' => 'upload_ajax[]',
                    'language' => Yii::$app->language == 'th-TH' ? 'th' : 'en',
                    'options' => ['multiple' => true, 'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                    'pluginOptions' => [
                        'initialPreview' => $initialPreview,
                        'initialPreviewConfig' => $initialPreviewConfig,
                        // 'previewFileType' => 'any',
                        'uploadUrl' => Url::to(['upload-ajax']),
                        'showCancel' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'overwriteInitial' => false,
                        'initialPreviewShowDelete' => true,
                        'uploadExtraData' => [
                            'ref' => $model->ref,
                        ],
                        'maxFileCount' => 10
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'docs[]')->widget(FileInput::class, [
            'options' => [
                'accept' => 'application/*',
                'multiple' => true
            ],
            'pluginOptions' => [
                'initialPreview' => $model->previewDocs($model->docs, 'docs', 'file'),
                'initialPreviewConfig' => $model->previewDocs($model->docs, 'docs', 'config'),
                'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx'],
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
                'overwriteInitial' => false
            ]
        ]); ?>
    </div>
    <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>