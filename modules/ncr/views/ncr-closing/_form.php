<?php

use app\models\User;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-closing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ncr_id')->textInput() ?>

    <div class="form-check">
        <?= $form->field($model, 'accept')->radioList([
            '1' => Yii::t('app', 'ยอมรับ'),
            '2' => Yii::t('app', 'ไม่ยอมรับ'),
        ], [
            'item' => function ($index, $label, $name, $checked, $value) {
                $html = '<div class="form-check">';
                $html .= '<input type="radio" id="' . $name . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? 'checked' : '') . ' class="form-check-input">';
                $html .= '<label class="form-check-label" for="' . $name . $index . '">' . $label . '</label>';
                $html .= '</div>';
                return $html;
            },
            'unselect' => null,
        ]); ?>
    </div>


    <?= $form->field($model, 'auditor')->widget(Select2::class, [
        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'department_id' => [3, 7]])->all(), 'id', 'thai_name'),
        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'qmr')->widget(Select2::class, [
        'data' => ArrayHelper::map(User::find()->where(['status' => 10, 'role_id' => [5, 13]])->all(), 'id', 'thai_name'),
        // 'options' => ['placeholder' => Yii::t('app', 'Select...')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'accept_date')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>