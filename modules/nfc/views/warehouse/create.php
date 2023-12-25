<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\Warehouse $model */

$this->title = Yii::t('app', 'Create Warehouse');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">
    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>