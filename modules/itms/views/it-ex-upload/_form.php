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
    <?= $form->field($model, 'doc_ref')->hiddenInput()->label(false) ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="col-md-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label" for="img_ref[]"> <?= Yii::t('app', 'Images') ?> </label>
                    <?= FileInput::widget([
                        'name' => 'img_ref[]',
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


                <div class="col-md-6">
                    <label class="control-label" for="doc_ref[]"> <?= Yii::t('app', 'Documents') ?> </label>
                    <?= FileInput::widget([
                        'name' => 'doc_ref[]',  
                        'options' => [
                            'multiple' => true,
                            'accept' => 'application/pdf'
                        ],
                        'pluginOptions' => [
                            'overwriteInitial' => false,
                            'initialPreviewShowDelete' => true,
                            'initialPreview' => $initialPreviewDoc,
                            'initialPreviewConfig' => $initialPreviewConfigDoc,
                            'uploadUrl' => Url::to(['upload-doc']),
                            'uploadExtraData' => [
                                'doc_ref' => $model->doc_ref,
                            ],
                            'maxFileCount' => 10
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="row">
        <div class="form-group">
            <div class="d-grid gap-2">
                <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php ActiveForm::end(); ?>
</div>