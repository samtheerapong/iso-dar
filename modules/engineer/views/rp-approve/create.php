<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\RpApprove $model */

$this->title = Yii::t('app', 'Create Rp Approve');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rp Approves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rp-approve-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
