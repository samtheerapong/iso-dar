<?php

use app\modules\jobs\models\JobStatus;
use app\modules\system\models\Operators;
use app\models\User;
use kartik\widgets\DatePicker;
use kartik\widgets\DateTimePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\jobs\models\Operations $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="operations-form">
    <div class="row">

       

        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header text-white bg-info">
                    <?= Yii::t('app', 'Job') . " - " . $modelJobs->number; ?>
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $modelJobs,
                        'template' => '<tr><th style="width: 150px;">{label}</th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'job_status',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobStatus->color . ';"><b>'
                                        . $modelJobs->jobStatus->name
                                        . ' </b></span>';
                                },
                            ],

                            'number',

                            'request_date:date',

                            'title',

                            [
                                'attribute' => 'equipment',
                                'format' => 'html',
                                'visible' => !empty($modelJobs->equipment),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->equipment;
                                },
                            ],

                            [
                                'attribute' => 'description',
                                'format' => 'ntext',
                                'visible' => !empty($modelJobs->description),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->description;
                                },
                            ],

                            [
                                'attribute' => 'request_by',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return $modelJobs->requestBy->thai_name;
                                },
                            ],

                            [
                                'attribute' => 'job_department',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobDepartment->color . ';"><b>'
                                        . $modelJobs->jobDepartment->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'location',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->location0->color . ';"><b>'
                                        . $modelJobs->location0->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'job_type',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->jobType->color . ';"><b>'
                                        . $modelJobs->jobType->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'urgency',
                                'format' => 'html',
                                'value' => function ($modelJobs) {
                                    return '<span class="text-justify" style="color:'
                                        . $modelJobs->urgency0->color . ';"><b>'
                                        . $modelJobs->urgency0->name
                                        . ' </b></span>';
                                },
                            ],

                            [
                                'attribute' => 'docs',
                                'format' => 'html',
                                'value' => $modelJobs->listDownloadFiles('docs')
                            ],

                            [
                                'attribute' => 'remask',
                                'format' => 'ntext',
                                'visible' => !empty($modelJobs->remask),
                                'value' => function ($modelJobs) {
                                    return $modelJobs->remask;
                                },
                            ],
                        ],
                    ]) ?>

                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-secondary">
                <div class="card-header text-white bg-secondary">
                    <?= Html::encode($this->title) ?>
                </div>
                <div class="card-body">
                    
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                    <?= $form->field($model, 'job_id')->hiddenInput()->label(false); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($modelJobs, 'job_status')->widget(Select2::class, [
                                'language' => 'th',
                                'data' => ArrayHelper::map(JobStatus::find()->all(), 'id', 'name'),
                                'options' => [
                                    'placeholder' => '',
                                    'required' => true,
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                            ?>
                        </div>

                        <div class="col-md-8">
                            <?= $form->field($model, 'operator_by')->widget(Select2::class, [
                                'language' => 'th',
                                'data' => ArrayHelper::map(User::find()->all(), 'id', 'thai_name'),
                                'options' => [
                                    'placeholder' => '',
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'start_date')->widget(
                                DateTimePicker::class,
                                [
                                    'options' => ['placeholder' => 'Start date'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd HH:ii',
                                        'todayHighlight' => true,
                                        'autoclose' => true,
                                        'required' => true,
                                    ]
                                ]
                            ); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'end_date')->widget(
                                DateTimePicker::class,
                                [
                                    'options' => ['placeholder' => 'End date'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd HH:ii',
                                        'todayHighlight' => true,
                                        'autoclose' => true,
                                        'required' => true,
                                    ]
                                ]
                            ); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'details')->textarea(['rows' => 3]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'sparepart_list')->textarea(['rows' => 3]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($model, 'remask')->textarea(['rows' => 1]) ?>
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

                    <div class="form-group">
                        <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-md btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>