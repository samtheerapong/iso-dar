<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\Ncr $model */

$this->title = Yii::t('app', 'Solvings : {name}', [
    'name' => $model->ncr_number,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncrs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Solvings');
?>
<div class="ncr-solvings">
    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form-solving', [
        'model' => $model,
        'solvingModel' => $solvingModel,
    ]) ?>

</div>