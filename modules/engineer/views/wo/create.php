<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\engineer\models\Wo $model */

$this->title = Yii::t('app', 'Create Wo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
