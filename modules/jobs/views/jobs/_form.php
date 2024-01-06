<?php

use app\modules\jobs\models\JobStatus;
use app\modules\jobs\models\JobType;
use app\modules\jobs\models\JobUrgency;
use app\models\Department;
use app\models\Location;
use app\models\User;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Jobs $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jobs-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'number')->hiddenInput()->label(false); ?>

            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'request_date')->widget(
                        DatePicker::class,
                        [
                            'language' => 'th',
                            'options' => [
                                'placeholder' => Yii::t('app', 'Select...'),
                                // 'required' => true,
                            ],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]
                    ); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'request_by')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'options' => ['placeholder' => ''],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'job_department')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Department::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'location')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Location::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'equipment')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'job_type')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(JobType::find()->all(), 'id', 'name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'urgency')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(JobUrgency::find()->all(), 'id', 'name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'job_status')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(JobStatus::find()->all(), 'id', 'name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'docs[]')->widget(FileInput::class, [
                        'options' => [
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            // 'initialPreview' => $model->listDownloadFiles('docs'),
                            'initialPreview' => $model->initialPreview($model->docs, 'docs', 'file'),
                            'initialPreviewConfig' => $model->initialPreview($model->docs, 'docs', 'config'),
                            'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'odt', 'ods', 'jpg', 'png', 'jpeg'],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false,
                            'overwriteInitial' => false,
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'remask')->textarea(['rows' => 2]) ?>
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