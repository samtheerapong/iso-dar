<?php

use app\models\Department;
use app\models\User;
use app\modules\ncr\models\NcrCategory;
use app\modules\ncr\models\NcrMonth;
use app\modules\ncr\models\NcrProcess;
use app\modules\ncr\models\NcrSubCategory;
use app\modules\ncr\models\NcrYear;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="ncr-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'month')->widget(Select2::class, [
                        'data' => ArrayHelper::map(NcrMonth::find()->where(['active' => 1])->all(), 'id', 'month'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'year')->widget(Select2::class, [
                        'data' => ArrayHelper::map(NcrYear::find()->where(['active' => 1])->all(), 'id', 'year'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'department')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Department::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-5">
                    <?= $form->field($model, 'process')->widget(Select2::class, [
                        'theme' => Select2::THEME_KRAJEE_BS5,
                        'data' => ArrayHelper::map(NcrProcess::find()->where(['active' => 1])->all(), 'name', 'name'),
                        'options' => ['multiple' => true, 'placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-2">
                    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'production_date')->widget(
                        DatePicker::class,
                        [
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
                    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'datail')->textarea(['rows' => 2]) ?>
                </div>
            </div>

            <div class="row">
                <div class="card-header text-white bg-warning">
                    <?= Yii::t('app', 'Reporter'); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?= $form->field($model, 'report_by')->widget(Select2::class, [
                                'data' => ArrayHelper::map(User::find()->where(['status' => 10])->all(), 'id', 'thai_name'),
                                'options' => ['value' => Yii::$app->user->identity->id],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'department_issue')->widget(Select2::class, [
                                'data' => ArrayHelper::map(Department::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['value' => Yii::$app->user->identity->department_id],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(NcrCategory::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>

                        <div class="col-md-3">
                            <?= $form->field($model, 'sub_category_id')->widget(Select2::class, [
                                'data' => ArrayHelper::map(NcrSubCategory::find()->where(['active' => 1])->all(), 'id', 'name'),
                                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'action')->textarea(['rows' => 2]) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $form->field($model, 'docs')->textarea(['rows' => 1]) ?>

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