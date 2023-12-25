<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Urgency $model */

$this->title = Yii::t('app', 'Create Urgency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Urgencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="urgency-create">
    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>