<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ItDemo $model */

$this->title = Yii::t('app', 'Create It Demo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'It Demos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-demo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
