<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Technician $model */

$this->title = Yii::t('app', 'Create Technician');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Technicians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
