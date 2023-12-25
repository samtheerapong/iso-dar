<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\PartGroup $model */

$this->title = Yii::t('app', 'Create Part Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Part Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
