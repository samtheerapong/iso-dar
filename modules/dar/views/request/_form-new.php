<?php

use app\models\Department;
use app\models\User;
use app\modules\dar\models\Request;
use app\modules\dar\models\RequestCategory;
use app\modules\dar\models\RequestType;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\dar\models\Request $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">

                    <?= $form->field($model, 'request_category_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(RequestCategory::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'department_id')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Department::find()->where(['active' => 1])->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'request_name')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => User::STATUS_ACTIVE])->all(), 'id', 'thai_name'), // Get User Status = Active
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'document_age')->textInput() ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'public_date')->widget(
                        DatePicker::class,
                        [
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]
                    ); ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'detail')->textarea(['rows' => 3]) ?>
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