<?php

use app\modules\engineer\models\Rp;
use app\modules\nfc\models\Location;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\RpList $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rp-list-form">

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
                    <?= $form->field($model, 'request_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Rp::find()->where(['en_status_id' => 1])->all(), 'id', function ($dataValue, $defaultValue) {
                            return
                                $dataValue->repair_code
                                . '  ' . $dataValue->request_title
                                . '  ' . $dataValue->requestBy->thai_name
                                . '  ' . Yii::$app->formatter->asDate($dataValue->created_at);
                        }),
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Select...'),
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'detail_list')->textInput(['required' => true,]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'type' => 'number', 'value' => '1']) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'request_date')->widget(
                        DatePicker::class,
                        [
                            'language' => 'th',
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
                                'required' => true,
                            ],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]
                    ); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'broken_date')->widget(
                        DatePicker::class,
                        [
                            'language' => 'th',
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
                                'required' => true,
                            ],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]
                    ); ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'location')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Location::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Select...'),
                            'required' => true,
                        ],
                        'pluginOptions' => [
                            'initialize' => true,
                        ],
                    ]) ?>
                </div>

                <div class="col-md-8">
                    <?= $form->field($model, 'remask')->textInput() ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'photo')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => false
                        ],
                        'pluginOptions' => [
                            'initialPreview' => $model->photo ? Html::img($model->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $model->photo]) : [],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="d-grid gap-2">
            <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

</div>