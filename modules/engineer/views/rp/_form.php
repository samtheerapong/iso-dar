<?php

use app\models\User;
use app\modules\engineer\models\Priority;
use app\modules\engineer\models\Status;
use app\modules\engineer\models\Urgency;
use app\modules\nfc\models\Department;
use app\modules\nfc\models\Location;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Rp $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rp-form">


    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]); ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">

                <?= $form->field($model, 'repair_code')->hiddenInput(['maxlength' => true])->label(false) ?>

                <div class="col-md-8">
                    <?= $form->field($model, 'request_title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'priority')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Priority::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'urgency')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Urgency::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'created_date')->widget(
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
                    <?= $form->field($model, 'request_by')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'department')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Department::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-10">
                    <?= $form->field($model, 'remask')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'en_status_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Status::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsList[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'request_id',
                    'detail_list',
                    'request_date',
                    'broken_date',
                    'amount',
                    'location',
                    'photo',
                    'remask',
                ],
            ]);
            ?>
            <div class="container-items">
                <?php foreach ($modelsList as $i => $modelList) : ?>
                    <div class="item card">
                        <div class="card-header text-white bg-warning">
                            <div class="card-title float-left">
                                <div class="float-left">
                                    <?= Yii::t('app', 'Repair Lists') ?>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-body">
                            <?php if (!$modelList->isNewRecord) {echo Html::activeHiddenInput($modelList, "[{$i}]id");}?>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?= $form->field($modelList, "[{$i}]request_id")->hiddenInput()->label(false) ?>
                                            <?= $form->field($modelList, "[{$i}]detail_list")->textInput(['required' => true,]) ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <?= $form->field($modelList, "[{$i}]amount")->textInput(['maxlength' => true, 'type' => 'number', 'value' => '1']) ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?= $form->field($modelList, "[{$i}]request_date")->widget(
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
                                            <?= $form->field($modelList, "[{$i}]broken_date")->widget(
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
                                            <?= $form->field($modelList, "[{$i}]location")->widget(Select2::class, [
                                                'language' => 'th',
                                                'data' => ArrayHelper::map(Location::find()->all(), 'id', 'name'),
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <?= $form->field($modelList, "[{$i}]remask")->textInput() ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <?= $form->field($modelList, "[{$i}]photo")->widget(FileInput::class, [
                                        'options' => [
                                            'accept' => 'image/*',
                                            'multiple' => false
                                        ],
                                        'pluginOptions' => [
                                            'initialPreview' => $modelList->photo ? Html::img($modelList->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $modelList->photo]) : [],
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
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>

            <div class="card-footer">
                <div class="d-grid gap-2">
                    <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>