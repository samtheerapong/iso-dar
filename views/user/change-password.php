<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-change-password">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currentPassword')->passwordInput() ?>

    <?= $form->field($model, 'newPassword')->passwordInput() ?>

    <?= $form->field($model, 'confirmPassword')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
