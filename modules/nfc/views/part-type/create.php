<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\nfc\models\PartType $model */

$this->title = Yii::t('app', 'Create Part Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Part Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
