<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\search\NcrSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ncr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ncr_number') ?>

    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'ncr_process_id') ?>

    <?php // echo $form->field($model, 'lot') ?>

    <?php // echo $form->field($model, 'production_date') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'customer_name') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'sub_category_id') ?>

    <?php // echo $form->field($model, 'datail') ?>

    <?php // echo $form->field($model, 'department_issue') ?>

    <?php // echo $form->field($model, 'report_by') ?>

    <?php // echo $form->field($model, 'troubleshooting') ?>

    <?php // echo $form->field($model, 'docs') ?>

    <?php // echo $form->field($model, 'ncr_status_id') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
