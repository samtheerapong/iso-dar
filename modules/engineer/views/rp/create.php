<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Rp $model */

$this->title = Yii::t('app', 'Create Rp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rp-create">

    <p>
        <?= Html::a('<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsList' => $modelsList,
    ]) ?>

</div>