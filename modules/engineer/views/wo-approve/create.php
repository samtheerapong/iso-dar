<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\WoApprove $model */

$this->title = Yii::t('app', 'Create Wo Approve');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wo Approves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wo-approve-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
