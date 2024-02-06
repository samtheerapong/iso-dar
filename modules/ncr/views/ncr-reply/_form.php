<?php

use app\models\User;
use app\modules\ncr\models\Ncr;
use app\modules\ncr\models\NcrConcession;
use app\modules\ncr\models\NcrReplyType;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrReply $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-reply-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'ncr_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Ncr::find()->where(['ncr_status_id' => [1, 2]])->all(), 'id', function ($dataValue, $defaultValue) {
                            return
                                $dataValue->ncr_number
                                . ' | ' . $dataValue->process
                                . ' | ' . $dataValue->product_name
                                . '  | Lot: ' . $dataValue->lot
                                . '  | ' . Yii::$app->formatter->asDate($dataValue->production_date);
                        }),
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => Yii::t('app', 'Select...'),
                            'disabled' => !$model->isNewRecord, // ถ้าไม่ใช่การเพิ่มข้อมูลใหม่ให้ disable
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                
                <div class="col-md-3">
                    <?= $form->field($model, 'reply_type_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(NcrReplyType::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'concession')->widget(Select2::class, [
                        'data' => ArrayHelper::map(NcrConcession::find()->where(['active' => 1])->all(), 'id', 'concession_name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-1">
                    <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>
                </div>

                <div class="col-md-1">
                    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'operation_name')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'role_id' => [3, 4, 5, 6, 10]])->all(), 'id', 'thai_name'),
                        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'operation_date')->widget(
                        DatePicker::class,
                        [
                            'options' => [
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

                <div class="col-md-6">
                    <?= $form->field($model, 'method')->textarea(['rows' => 2]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'cause')->textarea(['rows' => 2]) ?>
                </div>



                <div class="col-md-12">
                    <?= $form->field($model, 'docs[]')->widget(FileInput::class, [
                        'options' => [
                            //'accept' => 'image/*',
                            'multiple' => true
                        ],
                        'pluginOptions' => [
                            'initialPreview' => $model->initialPreview($model->docs, 'docs', 'file'),
                            'initialPreviewConfig' => $model->initialPreview($model->docs, 'docs', 'config'),
                            'allowedFileExtensions' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'png', 'jpeg', 'png', 'gif'],
                            'showPreview' => true,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false,
                            'overwriteInitial' => false
                        ]
                    ]); ?>
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