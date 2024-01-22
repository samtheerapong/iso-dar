<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ncr\models\NcrAccept $model */

$this->title = Yii::t('app', 'Create Ncr Accept');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ncr Accepts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ncr-accept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
