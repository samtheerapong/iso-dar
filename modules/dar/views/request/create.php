<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\dar\models\Request $model */

$this->title = Yii::t('app', 'Create Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
