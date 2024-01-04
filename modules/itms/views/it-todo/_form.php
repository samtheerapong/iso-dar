<?php

use app\models\User;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use Mpdf\Tag\Tr;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItTodo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="it-todo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'todo_date')->widget(
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

                <div class="col-md-6">

                    <?= $form->field($model, 'request_name')->widget(Select2::class, [
                        'data' => ArrayHelper::map(User::find()->where(['status' => 10])->all(), 'id', 'thai_name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true]) ?>
                </div>

                <div class="col-md-8">
                    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>
                </div>

                <div class="col-md-12">
                    <?= $form->field($model, 'photo')->widget(FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'showUpload' => false,
                            'initialPreview' => $model->photo ? [Html::img($model->getPhotoViewer(), ['class' => 'file-preview-image', 'alt' => $model->code, 'title' => $model->code])] : '',
                            'initialCaption' => $model->photo ? basename($model->photo) : '',
                            'overwriteInitial' => false,
                        ],
                    ]) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>