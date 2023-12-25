<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\WorkType $model */

$this->title = Yii::t('app', 'Create Work Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-type-create">
    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>