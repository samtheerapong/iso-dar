<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrClosing $model */

$this->title = Yii::t('app', 'Closing'). ' : ' . $model->ncrs->ncr_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Closing'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ncrs->ncr_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ncr-closing-update">

    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>