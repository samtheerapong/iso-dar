<?php

use app\modules\nfc\models\Location;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="moromi-form-addlist">
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $this->render('_view', [
                        'model' => $model,
                    ]) ?>
                </div>
                <div class="col-md-8">
                    <?php $form = ActiveForm::begin(['id' => 'dynamic-form',]); ?>
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
                                'image',
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
                                                <?= Yii::t('app', 'Lists') ?>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelList->isNewRecord) {
                                            echo Html::activeHiddenInput($modelList, "[{$i}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <?= $form->field($modelList, "[{$i}]request_id")->hiddenInput()->label(false) ?>

                                            <div class="col-md-4">
                                                <?= $form->field($modelList, "[{$i}]detail_list")->textInput(['required' => true,]) ?>
                                            </div>

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

                                            <div class="col-md-4">
                                                <?= $form->field($modelList, "[{$i}]remask")->textInput() ?>
                                            </div>

                                            <div class="col-md-4">
                                                <?= $form->field($modelList, "[{$i}]image")->widget(FileInput::class, [
                                                    'options' => [
                                                        'accept' => 'image/*',
                                                        'multiple' => false
                                                    ],
                                                    'pluginOptions' => [
                                                        // 'initialPreview' => Html::img($model->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $model->id]),
                                                        'showPreview' => false,
                                                        'showUpload' => false,
                                                        'showCancel' => false,
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
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>