<?php

use app\modules\nfc\models\PartDoc;
use app\modules\nfc\models\PartGroup;
use app\modules\nfc\models\PartType;
use app\modules\nfc\models\Unit;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\Part $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="part-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?= $form->field($model, 'code')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'ref')->hiddenInput()->label(false) ?>

                <div class="col-md-5">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-5">
                    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'old_code')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-8">
                    <?= $form->field($model, 'description')->textInput() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'en_part_doc_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(PartDoc::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'en_part_group_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(PartGroup::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'en_part_type_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(PartType::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'unit_lg')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Unit::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'unit_sm')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Unit::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '00.01']) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'cost')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '00.01']) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'last_date')->widget(
                        DatePicker::class,
                        [
                            'language' => 'th',
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]
                    ); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'imported')->dropDownList(
                        [
                            '2' => Yii::t('app', 'NO'),
                            '1' => Yii::t('app', 'YES')
                        ]
                    ) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'status')->dropDownList(
                        [
                            '1' => Yii::t('app', 'CREATED'),
                            '2' => Yii::t('app', 'APPROVED')
                        ]
                    ) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'active')->dropDownList(
                        [
                            '1' => Yii::t('app', 'YES'),
                            '2' => Yii::t('app', 'NO')
                        ]
                    ) ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'remask')->textInput() ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'photo')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                            'multiple' => false
                        ],
                        'pluginOptions' => [
                            'initialPreview' => Html::img($model->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $model->id]),
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