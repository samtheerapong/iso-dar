<?php

use app\modules\nfc\models\Department;
use app\models\UserRoles;
use app\models\UserRules;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Yii::t('app', 'Search') ?> 
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'thai_name') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'role_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(UserRoles::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'department_id')->widget(Select2::class, [
                        'language' => 'th',
                        'data' => ArrayHelper::map(Department::find()->all(), 'department_id', 'name'),
                        'options' => ['placeholder' => Yii::t('app', 'Select...')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-search"></i> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fas fa-refresh"></i> ' . Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>